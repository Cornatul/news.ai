<?php

namespace Cornatul\Social\DTO;

use Spatie\LaravelData\Data;

class TwitterTrendingDTO extends Data
{
    public string $name;
    public string $url;
    public ?string $promoted_content;
    public string $query;
    public ?int $tweet_volume;
}
