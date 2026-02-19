<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;

class ScaleDownClient
{
    protected string $endpoint;
    protected string $apiKey;

    public function __construct()
    {
        $this->endpoint = "https://api.scaledown.xyz/compress/raw/";
        $this->apiKey = config('services.scaledown.key');
    }

    public function generate(string $context, string $prompt, string $model = "gpt-4o"): array
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'Content-Type' => 'application/json'
        ])->post($this->endpoint, [
            "context" => $context,
            "prompt" => $prompt,
            "model" => $model,
            "scaledown" => [
                "rate" => "auto"
            ]
        ]);

        if (!$response->ok()) {
            throw new \Exception("ScaleDown API error");
        }

        return $response->json();
    }
}
