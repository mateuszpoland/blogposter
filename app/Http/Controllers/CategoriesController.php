<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategoria;
use Session;

class CategoriesController extends Controller
{
    protected $request_type;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategorie = Kategoria::all();
        return view('admin.categories.index')->with('categories', $kategorie);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //zwroc widok do tworzenia kategorii
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //jezeli request nie przyszedl z formularza na stronie dodawania postu
        if(!$request->name_from_post)
        {
          $this->validate($request, [
            'name' => 'required'
        ]);  
        }
        else
        {
            $this->validate($request, [
                'name_from_post' => 'required'
            ]);
           
        }

        $category = new Kategoria();

        if($request->name_from_post)
        {

            $category->nazwa = $request->name_from_post;
            $category->save();
            return $category->id;
        }
        else
        {
            $category->nazwa = $request->name;
            $category->save();
        }
        
        //zwroc wiadomość o utworzeniu nowej kategorii
        //mozna to tez zrobic:
        //Session::flash('success', 'Dodano nową kategorię');
        return redirect()->route('categories')->with('success', 
           'Dodano nową kategorię: '.$category->nazwa
        );
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
        //edytuj kategorię
        $category = Kategoria::find($id);
        //zwroc kategorie do widoku, by mozna bylo ja tam edytowac
        return view('admin.categories.edit')->with([
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //id kategorii pobiore z Requestu
        $this->validate($request, [
            'name' => 'required'
        ]);
        $id_kat = $request->id;
        $kategoria = Kategoria::find($id_kat);
        $kategoria_stara = $kategoria->nazwa;
        $kategoria->nazwa = $request->name;
        $kategoria->save();
        return redirect()->route('categories')->with([
            'success' => 'Zmieniono nazwę kategorii '. $kategoria_stara .' na ' . $kategoria->nazwa
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $kategoria = Kategoria::find($id);
        $kategoria->delete();

        return redirect()->back()->with([
            'notify-delete' => 'Usunięto Kategorię: '.$kategoria->nazwa
        ]);
    }

    public function request_type()
    {

    }
}
