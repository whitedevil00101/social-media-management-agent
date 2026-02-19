<?php

namespace App\Services\Instagram;

use Illuminate\Support\Facades\Http;

class InstagramScraper
{
    public function fetchProfileHtml(string $username): string
    {
        $url = "https://www.instagram.com/{$username}/";

        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0',
            'Accept-Language' => 'en-US,en;q=0.9',
        ])->get($url);

        if (!$response->ok()) {
            throw new \Exception("Failed to fetch Instagram profile");
        }

        return $response->body();
    }
}
