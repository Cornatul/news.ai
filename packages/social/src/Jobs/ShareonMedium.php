<?php

namespace Cornatul\Social\Jobs;

use Cornatul\Social\Objects\Message;
use Cornatul\Social\Service\LinkedInService;
use Cornatul\Social\Service\MediumService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ShareonMedium implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected MediumService $linkedInService;
    protected Message $message;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(Message $message)
    {
        /**
         * @var MediumService
         */
        $this->linkedInService = app()->make(MediumService::class);
        $this->message = $message;
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws GuzzleException
     * @throws \JsonException
     * @throws IdentityProviderException
     */
    public function handle(): void
    {
        $accessToken = session()->get('linkedin_access_token');

        $response = $this->linkedInService->shareOnWall($accessToken, $this->message);

        info($response->getStatusCode());

        if ($response->getStatusCode() === 201) {
            $this->delete();
        }
    }
}
