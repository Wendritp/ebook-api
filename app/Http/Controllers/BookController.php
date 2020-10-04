<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Book;

class BookController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Menampilkan Data
       $book = Book::all();
       if($book && $book->count() >0){
            return response(['message' => 'Show data succes.' , 'data' => $book], 200);
       }else{
            return response(['message' => 'Data not found.' , 'data' => null], 404);
       }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //buat data
       $book = Book::create([
            "title" => $request->title,
            "description" => $request->description,
            "author" => $request->author,
            "publisher" => $request->publisher,
            "date_of_issue" => $request->date_of_issue
        ]);
        return response(['message' => 'Create data succes.' , 'data' => $book], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if($book && $book->count() >0){
            return response(['message' => 'Show data succes.' , 'data' => $book], 200);
       }else{
            return response(['message' => 'Data not found.' , 'data' => null], 404);
       }
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
        $book = Book::find($id);
        if($book){
            $book->title = $request->title;
            $book->description = $request->description;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->date_of_issue = $request->date_of_issue;

            $book->save();

            //return response([], 204); //tanpa body
            return response(['message' => 'Update data succes.' , 'data' => $book], 200);
        }else{
            return response(['message' => 'Update data failed.' , 'data' => null], 406);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book){
            $book->delete();
            
            return response([], 204);
        }else{
            return response(['message' => 'Remove data failed.' , 'data' => null], 406);
        }
    }
}
