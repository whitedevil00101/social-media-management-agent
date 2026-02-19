<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledPost;
use App\Models\InstagramAccount;

class ScheduledPostController extends Controller
{
    public function create()
    {
        $accounts = InstagramAccount::all();
        return view('schedule.create', compact('accounts'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'instagram_account_id' => 'required',
            'caption' => 'nullable|string',
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4',
            'scheduled_at' => 'required|date'
        ]);

        $path = $req->file('media')->store('scheduled_posts', 'public');

        ScheduledPost::create([
            'instagram_account_id' => $data['instagram_account_id'],
            'caption' => $data['caption'],
            'media_path' => $path,
            'scheduled_at' => $data['scheduled_at'],
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Post scheduled');
    }
}
