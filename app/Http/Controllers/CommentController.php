<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id', // Menangani balasan
        ]);

        // Menyimpan komentar
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id(); // Pastikan pengguna login
        $comment->content = $request->content;
        $comment->parent_id = $request->parent_id; // Menyimpan parent_id jika balasan
        $comment->save();

        // Pastikan untuk memuat relasi user dan balasan
        $comment->load('user', 'replies'); // Memuat relasi untuk user dan replies

        // Mengembalikan respons JSON yang lebih lengkap
        return response()->json([
            'content' => $comment->content,
            'user' => $comment->user->name,
            'created_at' => $comment->created_at->diffForHumans(),
            'replies' => $comment->replies, // Mengirim balasan komentar
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}