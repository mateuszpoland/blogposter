<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        dd($request->all());
        exit;
        */
        $this->validate($request, [
            'new_tag' => 'required',
        ]);
        $tag = Tag::create([
            'tag' => $request->new_tag,
        ]);

        return redirect()->back()
                        ->with('success', 'Dodano tag:' . $tag->tag);
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

    /**
    *  @todo - dorzucić modal w JSie, który bedzie korzystał z tej metody
    */
    public function edit($id)
    {
        $tag = Tag::find($id);
        if($tag)
        {
            return view('admin.tags.edit')->with('tag', $tag);
        }
        return redirect()->route('admin.tags.index');
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
        $tag = Tag::find($id);
        $this->validate($request, [
            'tag' => 'required'
        ]);

        $tag->tag = $request->tag;

        $tag->save();

        return redirect()->back()
                        ->with('success', 'Zaktualizowano tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if($tag = Tag::find($id))
        Tag::destroy($id);
        return redirect()->back()
                        ->with('success', 'Tag ' . $tag->tag . ' został usunięty');
    }
}
