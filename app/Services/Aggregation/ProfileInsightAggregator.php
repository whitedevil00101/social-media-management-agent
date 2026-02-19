<?php

namespace App\Services\Aggregation;

use App\Models\PostInsight;
use App\Models\ProfileInsight;
use App\Services\AI\ScaleDownClient;

class ProfileInsightAggregator
{
    public function __construct(protected ScaleDownClient $ai) {}

    public function build(int $profileId): void
    {
        $postInsights = PostInsight::where('profile_id', $profileId)->get();

        if ($postInsights->isEmpty()) return;

        $patterns = $this->computePatterns($postInsights);

        $strategy = $this->aiSynthesize($patterns);

        ProfileInsight::updateOrCreate(
            ['profile_id' => $profileId],
            [
                'insight_json' => $strategy,
                'version' => 1
            ]
        );
    }

    protected function computePatterns($insights): array
    {
        $topics = [];
        $types = [];
        $tones = [];

        foreach ($insights as $i) {
            $data = $i->insight_json;

            $topics[] = $data['topic'] ?? null;
            $types[] = $data['content_type'] ?? null;
            $tones[] = $data['tone'] ?? null;
        }

        return [
            'top_topics' => array_values(array_count_values(array_filter($topics))),
            'content_types' => array_values(array_count_values(array_filter($types))),
            'tones' => array_values(array_count_values(array_filter($tones))),
            'posts_analyzed' => count($insights)
        ];
    }

    protected function aiSynthesize(array $patterns): array
    {
        $context = "You are a social media strategist analyzing an Instagram profile.";

        $prompt = "Given these aggregated post patterns:\n" .
            json_encode($patterns, JSON_PRETTY_PRINT) .
            "\nReturn JSON:\n" .
            '{
              "profile_summary": "",
              "content_pillars": [],
              "brand_voice": "",
              "audience_type": "",
              "strategy_recommendations": []
            }';

        $result = $this->ai->generate($context, $prompt);

        return json_decode($result['compressed_prompt'] ?? "{}", true) ?? [];
    }
}
