<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        if($authors->isEmpty()) {
            return response()->json([
                'error' => '404',
                'message' => 'Authors not found',
            ], 404);
        }
        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'email',
            ],
            [
                'name.required' => 'Enter a name ',
                'email.email' => 'Enter a valid email'
            ]
        );
        $author = Author::create($request->all());
        return response()->json($author, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        if(!$author) {
            return response()->json([
                'error' => '404',
                'message' => 'Author not found',
            ], 404);
        }
        return response()->json($author);
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
        $request->validate(
            [
                'name' => 'required',
                'email' => 'email',
            ],
            [
                'name.required' => 'Enter a name ',
                'email.email' => 'Enter a valid email'
            ]
        );
        Author::whereId($id)->update($request->all());
        return response()->json(Author::find($id), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        $deleted = $author->delete();
        if(!$deleted) {
            return response()->json([
                'error' => '304',
                'message'   => 'Undeleted Author',
            ], 304);
        }
        return response()->json([
            'error' => '200',
            'message'   => 'Deleted Author',
        ], 200);
    }
}
