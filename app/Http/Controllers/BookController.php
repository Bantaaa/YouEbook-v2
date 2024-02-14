<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBook;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function index()
    {
        $books= Book::all();
        return view('homeme',['books' => $books]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         // Validate the form data
      $validatedData = $request->validate([
        'title' => 'required',
        'prix' => 'required',
        'qte' => 'required',
    ]);

        $books = ['title','prix','qte',`updated_at`, `created_at` ];

        $book = Book::create($request->only($books));
        session()->flash('status', 'book creer avec succes');
        return redirect()->route("books.index");
    }

    
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view("show" , ["book" => $book]);
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view("edit", ["book" => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(request $request, $id)
    {
         // Validate the form data
      $validatedData = $request->validate([
        'title' => 'required',
        'prix' => 'required',
    ]);

        $book = Book::findOrFail($id);
        $book->title = $request->input("title");
        $book->prix = $request->input("prix");
        $book->save();
        session()->flash('status', 'book modifier avec succes');
        return redirect()->route("books.index");
    }

    
    public function destroy(Request $request,$id)
    {
        // $book = Book::findOrFail($id);
        // $book->delete();
        Book::destroy($id);
        session()->flash('status', 'book supprimer avec succes');
        return redirect()->back();
    }

}
