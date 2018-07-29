<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Kategoria;
use Session;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postlist = Post::all();
        //$tags = DB::select("SELECT ")
        return view('admin.posts.index')
                ->with('posts', $postlist);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function trashed()
    {
            $trashed = Post::onlyTrashed()->get();
        return view('admin.posts.trashed')
                ->with('trashed', $trashed);
    }
    public function create()
    {
        if(Kategoria::all()->count() == 0)
        {
            return redirect()->route('category.create')
                             ->with(['info' => 'Musisz utworzyć kategorię dla posta']);
        }

        return view('admin.posts.create')
                //dodaj liste wszystkich kategorii do widoku
                ->with('categories', Kategoria::all())
                //tagi
                ->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if(!null == $request->category_added)
        {
            htmlentities($request->category_added);

            //@todo - dorobić walidacje czy kategoria istnieje - cos a'la create if not exists
            //@todo - sprawdzic, nowy request nie jest "" bo nazwa musi byc
            $new_category =  Kategoria::create([
                'nazwa' => $request->category_added,
            ]);

        }
        $this->validate($request, [
            'title' => 'required|max:255',
            'picture' => 'required|image',
            'content' => 'required',
            'category_id'=> 'required',
            'tags' => 'required',
        ]);
        //dd($request->all());
        $picture = $request->picture;
        $picture_new_name = time().$picture->getCLientOriginalName();

        //przenies plik do folderu uploads
        $picture->move('public/uploads/posts', $picture_new_name);
        //sciezka do pliku
        $pic_path = '/public/uploads/posts/'.$picture_new_name;
        //stworz nowy post
        $post = Post::create([
            'tytul' => $request->title,
            'tresc' => $request->content,
            'kategoria_id' => isset($new_category) ? $new_category->id : $request->category_id,
            'featured' => $pic_path,
            'slug' => str_slug($request->title),
        ]);

        //dodaj tagi do tabeli post_tag
        $post->tags()->attach($request->tags);
        
        return redirect()->back()
            ->with('success', 'Utworzono nowy post  '.$post['tytul']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        $categories = Kategoria::all();
        $post_tags = array();
        foreach($post->tags as $tag)
        {
            $post_tags[] = $tag->tag;
        }
        return view('admin.posts.edit')
                    ->with([
                        'post' => $post,
                        'categories' => $categories,
                        'tags' => $tags,
                        'post_tags' => $post_tags,
                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255', 
            'content' => 'required', 
            'category_id' => 'required',
            'tags'
        ]);
        $post = Post::find($id);

        //czy user zaladowal obrazek
        if($request->hasFile('picture'))
        {
            $picture = $request->picture;
            $picture_new_name = time() . $picture->getClientOriginalName();
            $picture->move('public/uploads/posts', $picture_new_name);

            $post->featured = '/public/uploads/posts/' . $picture_new_name;
        }

        $post->tytul = $request->title;
        $post->tresc = $request->content;
        $post->kategoria_id = $request->category_id;
        $post->tags()->attach($request->tags);

        $post->save();
        return redirect()->back()
                         ->with('success', 'Post' . $post->tytul . ' został zmodyfikowany.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($post = Post::find($id))
        {
            $post->delete();
            return redirect()->route('posts.index')
                              ->with(['success' => 'Przeniesiono do kosza: ' . $post->tytul]);
        }
        Throw new ArgumentNotFindException('Nie znaleziono posta.');
    }


    public function kill($id)
    {
        $post_to_kill = Post::withTrashed()
                        ->where('id', $id)
                        ->first();
        if($post_to_kill)
        {
            Session::flash('success', 'Usunięto post: ' .$post_to_kill->tytul);
            $post_to_kill->forceDelete();
            return redirect()->route('posts.trash');
                                
        }
        return false;
    }

    public function restore($id)
    {
        $post_to_restore = Post::withTrashed()
                            ->where('id', $id)
                            ->first();
        if($post_to_restore)
        {
            $post_to_restore->restore();
            Session::flash('success', 'Przywrócono post: '.$post_to_restore->tytul);
            return redirect()->route('posts.index');
                            
        }
        return false;
    }
}
