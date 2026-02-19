<?php

namespace App\Services\Analysis;

use App\Services\AI\ScaleDownClient;

class PostAnalyzerAI
{
    public function __construct(protected ScaleDownClient $ai) {}

    public function analyze(array $post): array
    {
        $context = "You are an expert social media analyst.";

        $prompt = <<<TXT
                Analyze this Instagram post and return JSON:

                Caption: {$post['caption']}
                Media type: {$post['media_type']}

                Return JSON:
                {
                "summary": "",
                "topic": "",
                "content_type": "",
                "intent": "",
                "tone": "",
                "keywords": []
                }
                TXT;

        $result = $this->ai->generate($context, $prompt);

        $compressed = $result['compressed_prompt'] ?? "{}";

        return json_decode($compressed, true) ?? [];
    }
}
