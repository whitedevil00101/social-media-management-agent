<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstagramAccount;

class InstagramAuthController extends Controller
{
    public function store(Request $req)
    {
        $data = $req->validate([
            'instagram_business_id' => 'required',
            'page_id' => 'required',
            'username' => 'required',
            'access_token' => 'required'
        ]);

        $account = InstagramAccount::updateOrCreate(
            ['instagram_business_id' => $data['instagram_business_id']],
            $data
        );

        return response()->json([
            'status' => 'connected',
            'account' => $account
        ]);
    }
}
