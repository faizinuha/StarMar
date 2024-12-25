<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::whereNotNull('image')
            ->orWhereNotNull('video')
            ->latest()
            ->get();

        return view('users.view.explorer', compact('posts'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request) //search
    {
        $query = $request->input('q');

        $users = [];
        $posts = Post::query();

        if ($query) {
            $users = User::where('first_name', 'LIKE', "%{$query}%")
                ->orWhere('last_name', 'LIKE', "%{$query}%")
                ->select('id', 'first_name', 'last_name', 'photo_profile')
                ->get();

            $posts = $posts->where('content', 'LIKE', "%{$query}%");
        }

        $posts = $posts->whereNotNull('image')
            ->orWhereNotNull('video')
            ->latest()
            ->get();

        return view('users.view.explorer', compact('users', 'posts', 'query'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}