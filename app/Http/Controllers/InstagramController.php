<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\FetchInstagramPostsJob;

class InstagramController extends Controller
{
    public function import(Request $req)
    {
        $req->validate([
            'username' => 'required|string'
        ]);

        FetchInstagramPostsJob::dispatch($req->username);

        return response()->json([
            'status' => 'import_started'
        ]);
    }
}
