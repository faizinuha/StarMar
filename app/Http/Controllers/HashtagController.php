<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hashtag;
class HashtagController extends Controller
{
    public function suggest(Request $request)
    {
        $query = $request->input('query');

        // Validasi input kosong
        if (!$query) {
            return response()->json([]);
        }

        // Cari hashtag yang cocok
        $hashtags = Hashtag::where('name', 'LIKE', '%' . $query . '%')->take(10)->get();

        // Kembalikan JSON
        return response()->json($hashtags);
    }
}
