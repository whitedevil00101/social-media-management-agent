<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Post;
use App\Models\ScheduledPost;

class DashboardController extends Controller
{
    public function profile($id)
    {
        $profile = Profile::with('insight')->findOrFail($id);

        $posts = Post::where('profile_id', $id)
            ->latest()
            ->take(12)
            ->get();

        $schedule = ScheduledPost::where('profile_id', $id)
            ->orderBy('scheduled_at')
            ->get();

        return view('dashboard.profile', compact(
            'profile',
            'posts',
            'schedule'
        ));
    }
}
