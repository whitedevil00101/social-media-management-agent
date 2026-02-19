<?php

namespace App\Services\Automation;

use App\Models\ProfileInsight;
use App\Services\AI\ScaleDownClient;

class ContentGenerator
{
    public function __construct(protected ScaleDownClient $ai) {}

    public function generateForProfile(int $profileId): array
    {
        $profileInsight = ProfileInsight::where('profile_id', $profileId)->first();

        if (!$profileInsight) return [];

        $strategy = $profileInsight->insight_json;

        $context = "You are a social media content creator.";

        $prompt = "Generate Instagram post ideas and captions based on this strategy:\n" .
            json_encode($strategy, JSON_PRETTY_PRINT) .
            "\nReturn JSON array:\n" .
            '[
              {
                "topic": "",
                "caption": "",
                "hashtags": []
              }
            ]';

        $result = $this->ai->generate($context, $prompt);

        return json_decode($result['compressed_prompt'] ?? "[]", true) ?? [];
    }
}
