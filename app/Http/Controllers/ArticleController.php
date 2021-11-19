<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Author;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        if($articles->isEmpty()) {
            return response()->json([
                'error' => '404',
                'message' => 'Articles not found',
            ], 404);
        }
        return response()->json($articles);
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
                'title' => 'required',
                'content' => 'required',
                'authorId' => 'required',
            ],
            [
                'title.required' => 'Enter a title',
                'content.email' => 'Enter a content',
                'authorId.email' => 'Enter a author'
            ]
        );
        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if(!$article) {
            return response()->json([
                'error' => '404',
                'message' => 'Article not found',
            ], 404);
        }
        return response()->json($article);
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
                'title' => 'required',
                'content' => 'required',
                'authorId' => 'required',
            ],
            [
                'title.required' => 'Enter a title',
                'content.email' => 'Enter a content',
                'authorId.email' => 'Enter a author'
            ]
        );
        Article::whereId($id)->update($request->all());
        return response()->json(Article::find($id), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $deleted = $article->delete();
        if(!$deleted) {
            return response()->json([
                'error' => '304',
                'message'   => 'Undeleted article',
            ], 304);
        }
        return response()->json([
            'error' => '200',
            'message'   => 'Deleted article',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showArticlesByAuthorId($authorId)
    {
        $articles = Author::with('article')->findOrFail($authorId);  
        if($articles->article->isEmpty()) {
            return response()->json([
                'error' => '404',
                'message' => 'Author has no articles ',
            ], 404);
        }
        return response()->json($articles);
    }
    
}
