<?php
declare(strict_types=1);

namespace Cornatul\Social\Service;

use Atymic\Twitter\Facade\Twitter;
use Cornatul\Social\Contracts\ShareContract;
use Cornatul\Social\DTO\TwitterTrendingDTO;
use Cornatul\Social\Objects\Message;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessTokenInterface;

/**
 */
class TwitterService
{
    /**
     * @throws \Exception
     */
    public function shareOnWall(Message $message)
    {
        return Twitter::postTweet([
            'status' => $message->getBody() . ' ' .$message->getUrl(),
            'lat' => 51.5072,
            'long' => 0.1275,
            'display_coordinates' => true,
            'place_id'=> 44418,
            'response_format' => 'json']);
    }

    public function getTrends(int $locationID = 44418):Collection
    {
        $cacheKey = "twitter_trends_{$locationID}";

        $data = Cache::get($cacheKey);

        if (!$data) {
            $first =  Twitter::getTrendsPlace(['id' => $locationID]);

            $collection =  collect($first[0]);

            $data = collect();

            collect($collection->get('trends'))->each(function ($item) use ($data) {
                $data->push(TwitterTrendingDTO::from($item));
            });

            Cache::put($cacheKey, $data, $minutes = 60);
        }
        return $data;
    }


    public function getGeoLocations():Collection
    {
        $locations = Twitter::getTrendsAvailable();

        $data = collect();

        collect($locations)->each(function ($item) use ($data) {
            $data->push(TwitterTrendingDTO::from($item));
        });

        return $data;
    }
}
