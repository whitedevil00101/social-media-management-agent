<?php

namespace App\Services\Instagram;

class InstagramService
{
    public function __construct(
        protected InstagramScraper $scraper,
        protected InstagramParser $parser
    ) {}

    public function fetchPosts(string $username): array
    {
        $html = $this->scraper->fetchProfileHtml($username);

        return $this->parser->parsePosts($html);
    }
}
