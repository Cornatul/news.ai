<?php
declare(strict_types=1);

namespace Cornatul\Social\Service;

use Atymic\Twitter\Facade\Twitter;
use Cornatul\Social\Contracts\ShareContract;
use Cornatul\Social\Objects\Message;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use League\OAuth1\Client\Credentials\TokenCredentials;
use League\OAuth1\Client\Server\Tumblr;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessTokenInterface;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class TumblrService
{
    public function shareOnWall(AccessTokenInterface $accessToken, Message $message)
    {
        $client = new Client();

        $oauth = new Oauth1([
            'consumer_key' => config('social.tumblr.identifier'),
            'consumer_secret' => config('social.tumblr.secret'),
            'token' => $accessToken->getIdentifier(),
            'token_secret' => $accessToken->getSecret(),
        ]);

        $handlerStack = HandlerStack::create();

        $handlerStack->push($oauth);

        try {
            $response = $client->post('https://api.tumblr.com/v2/blog/' .config('social.tumblr.blog') . '/post', [
                'auth' => 'oauth',
                'handler' => $handlerStack,
                'json' => [
                    "type" => "text",
                    "format" => "html",
                    "title" => $message->getTitle(),
                    "native_inline_images" => "true",
                    "state" => "published",
                    'tags' => $message->getTagsAsArray(),
                    "body" => $message->getBody() . Message::SIGNATURE,
                ],
            ]);
        } catch (RequestException $e) {
            info($e->getResponse()?->getBody()->getContents());
        }

        return ($response->getBody()->getContents());
    }
}
