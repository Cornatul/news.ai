<?php

namespace Cornatul\Social\Service;
use Cornatul\Social\Objects\Message;
use GuzzleHttp\Exception\GuzzleException;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Google;

class GoogleMBService
{
    private Google $provider;

    public function __construct(Google $provider)
    {
        $this->provider = $provider;
    }

    public function getAuthUrl(): string
    {
        $options = [
            'scope' => [
                'https://www.googleapis.com/auth/userinfo.profile',
                'https://www.googleapis.com/auth/userinfo.email'
            ],
        ];

        return $this->provider->getAuthorizationUrl($options);
    }

    /**
     * @throws IdentityProviderException
     */
    public function getAccessToken($code)
    {
        return $this->provider->getAccessToken('authorization_code', [
            'code' => $code,
        ]);
    }

    /**
     * @throws IdentityProviderException
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function shareOnWall($accessToken, Message $message): void
    {
        dd($accessToken, $message);
    }
}
