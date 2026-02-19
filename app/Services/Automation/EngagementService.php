<?php

namespace App\Services\Automation;

use App\Services\AI\ScaleDownClient;

class EngagementService
{
    public function __construct(protected ScaleDownClient $ai) {}

    public function generateReply(string $comment): string
    {
        $context = "You are a helpful brand social media manager.";

        $prompt = "Reply politely to this Instagram comment:\n" . $comment;

        $result = $this->ai->generate($context, $prompt);

        return $result['compressed_prompt'] ?? "";
    }
}
