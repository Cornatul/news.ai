<?php

namespace Cornatul\Social\Actions;

use Cornatul\Social\Contracts\ShareContract;
use Cornatul\Social\Service\GithubService;
use Cornatul\Social\Service\LinkedInService;
use League\OAuth2\Client\Token\AccessTokenInterface;

class ShareAction
{
    protected $services = [
        'linkedin' => LinkedInService::class,
        'github' => GithubService::class
    ];

    public function share(AccessTokenInterface $accessToken, Message $message): void
    {
        /** @var ShareContract $service */
        foreach ($this->services as $service) {
            $service->shareOnWall($accessToken, $message);
        }
    }
}
