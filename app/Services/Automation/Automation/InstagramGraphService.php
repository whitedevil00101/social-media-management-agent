<?php

namespace App\Services\Automation;

use Illuminate\Support\Facades\Http;

class InstagramGraphService
{
    public function createMediaContainer($igId, $token, $imageUrl, $caption)
    {
        $url = "https://graph.facebook.com/v19.0/{$igId}/media";

        $response = Http::post($url, [
            'image_url' => $imageUrl,
            'caption' => $caption,
            'access_token' => $token
        ]);

        if (!$response->ok()) {
            throw new \Exception("IG container error: " . $response->body());
        }

        return $response->json()['id'] ?? null;
    }

    public function publishContainer($igId, $token, $creationId)
    {
        $url = "https://graph.facebook.com/v19.0/{$igId}/media_publish";

        $response = Http::post($url, [
            'creation_id' => $creationId,
            'access_token' => $token
        ]);

        if (!$response->ok()) {
            throw new \Exception("IG publish error: " . $response->body());
        }

        return $response->json()['id'] ?? null;
    }
}
