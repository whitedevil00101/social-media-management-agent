<?php

namespace App\Services\Instagram;

class InstagramParser
{
    public function parsePosts(string $html): array
    {
        $posts = [];

        preg_match('/window\._sharedData = (.*);<\/script>/', $html, $m);

        if (!isset($m[1])) {
            return [];
        }

        $json = json_decode($m[1], true);

        $edges = $json['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ?? [];

        foreach ($edges as $edge) {
            $node = $edge['node'];

            $posts[] = [
                'instagram_post_id' => $node['id'],
                'caption' => $node['edge_media_to_caption']['edges'][0]['node']['text'] ?? '',
                'media_url' => $node['display_url'],
                'media_type' => $node['__typename'],
                'likes' => $node['edge_liked_by']['count'],
                'comments' => $node['edge_media_to_comment']['count'],
                'posted_at' => date('Y-m-d H:i:s', $node['taken_at_timestamp']),
            ];
        }

        return $posts;
    }
}
