<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        if($comments->isEmpty()) {
            return response()->json([
                'error' => '404',
                'message' => 'Comments not found',
            ], 404);
        }
        return response()->json($comments);
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
                'grade' => 'required',
                'comment' => 'required',
                'articleId' => 'required',
            ],
            [
                'grade.required' => 'Enter a grade',
                'comment.email' => 'Enter a comment',
                'articleId.email' => 'Enter a article'
            ]
        );
        $comment = Comment::create($request->all());
        return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        if(!$comment) {
            return response()->json([
                'error' => '404',
                'message' => 'comment not found',
            ], 404);
        }
        return response()->json($comment);
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
                'grade' => 'required',
                'comment' => 'required',
                'articleId' => 'required',
            ],
            [
                'grade.required' => 'Enter a grade',
                'comment.email' => 'Enter a comment',
                'articleId.email' => 'Enter a article'
            ]
        );
        Comment::whereId($id)->update($request->all());
        return response()->json(Comment::find($id), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $deleted = $comment->delete();
        if(!$deleted) {
            return response()->json([
                'error' => '304',
                'message'   => 'Undeleted comment',
            ], 304);
        }
        return response()->json([
            'error' => '200',
            'message'   => 'Deleted comment',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCommentsByArticleId($articleId)
    {
        $comments = Article::with('comment')->findOrFail($articleId);  
        if($comments->comment->isEmpty()) {
            return response()->json([
                'error' => '404',
                'message' => 'Author has no articles ',
            ], 404);
        }
        return response()->json($comments);
    }
}
