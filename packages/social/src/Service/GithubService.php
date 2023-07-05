<?php
declare(strict_types=1);

namespace Cornatul\Social\Service;

use Cornatul\Social\Objects\Message;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Provider\LinkedIn;
use League\OAuth2\Client\Token\AccessTokenInterface;

class GithubService
{
    private Github $provider;

    public function __construct(Github $provider)
    {
        $this->provider = $provider;
    }

    public function getAuthUrl(array $options = []): string
    {
        $options = array_merge([
            'scope' => [
                'gist'
            ],
        ], $options);

        return $this->provider->getAuthorizationUrl($options);
    }

    /**
     * @throws IdentityProviderException
     * @return AccessTokenInterface
     */
    public function getAccessToken(string $code): AccessTokenInterface
    {
        return $this->provider->getAccessToken('authorization_code', [
            'code' => $code,
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function createGist(AccessTokenInterface $accessToken, Message $message):Collection
    {
        $client = new Client();

        $response = $client->post('https://api.github.com/gists', [
            'headers' => [
                'Accept' => 'application/vnd.github.v3+json',
                'Authorization' => 'token ' . $accessToken->getToken(),
            ],
            'body' => json_encode([
                'description' => 'Gist created by https://lzomedia.com',
                'public' => true,
                'files' => [
                   Str::slug($message->getTitle()) => [
                        'content' => $message->getBody(),
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
        ]);

        return collect(
            json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR)
        );
    }
}
