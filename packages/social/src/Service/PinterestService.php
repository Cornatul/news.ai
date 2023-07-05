<?php
declare(strict_types=1);

namespace Cornatul\Social\Service;

use Cornatul\Social\Objects\Message;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\LinkedIn;
use League\OAuth2\Client\Token\LinkedInAccessToken;

class PinterestService
{
    private LinkedIn $provider;

    public function __construct(LinkedIn $provider)
    {
        $this->provider = $provider;
    }

    public function getAuthUrl()
    {
        $options = [
            'state' => bin2hex(random_bytes(16)),
            'scope' => 'r_liteprofile w_member_social',
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
    public function shareOnWall(LinkedInAccessToken $accessToken, Message $message)
    {
        $user = $this->provider->getResourceOwner($accessToken);

        $client = new Client();

        $headers = [
            'Authorization' => 'Bearer ' . $accessToken->getToken(),
            'Content-Type' => 'application/json',
            'X-Restli-Protocol-Version' => '2.0.0',
        ];

        $body = [
            'author' => 'urn:li:person:' . $user->getId(),
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $message->getBody(),
                    ],
                    'shareMediaCategory' => 'ARTICLE',
                    'media' => [
                        [
                            'status' => 'READY',
                            'description' => [
                                'text' => $message->getSummary(),
                            ],
                            'originalUrl' => $message->getUrl(),
                            'title' => [
                                'text' => $message->getTitle(),
                            ],
                            'thumbnails' => [
                                [
                                    'image' => $message->getImage(),
                                    'resolvedUrl' => $message->getImage(),
                                ],
                            ],
                        ],
                    ],

                ],
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
            ],
        ];

        return $client->request('POST', 'https://api.linkedin.com/v2/ugcPosts', [
            'headers' => $headers,
            'json' => $body,
        ]);
    }
}
