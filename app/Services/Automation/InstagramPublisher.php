<?php

namespace App\Services\Automation;

use App\Models\ScheduledPost;

class InstagramPublisher
{
    public function publish(ScheduledPost $post): bool
    {
        // FUTURE: Graph API integration
        // For MVP we simulate success

        return true;
    }
}
