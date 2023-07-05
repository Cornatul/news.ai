<?php
declare(strict_types=1);
namespace Cornatul\Social\Console;

use Cornatul\Feeds\Connectors\FeedlyConnector;
use Cornatul\Feeds\Connectors\NlpConnector;
use Cornatul\Feeds\Requests\FeedlyTopicRequest;
use Cornatul\Feeds\Requests\GetArticleRequest;
use Cornatul\Social\Jobs\ShareonLinkedIn;
use Cornatul\Social\Objects\Message;
use Cornatul\Social\Service\LinkedInService;
use Cornatul\Social\Service\MediumService;
use Illuminate\Console\Command;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class LinkedInPublishCommand extends Command
{

    protected $signature = 'publish:linkedin';

    protected $description = 'Publish to linked a post';

    private LinkedInService $linkedInService;

    public function __construct(LinkedInService $linkedInService)
    {
        parent::__construct();
        $this->linkedInService = $linkedInService;
    }
    /**
     * @throws \ReflectionException
     * @throws InvalidResponseClassException
     * @throws PendingRequestException
     * @throws \JsonException
     */
    public function handle(): void
    {

        $this->info('Publishing to linkedin');

        $message = new Message();
        $message->setTitle('Test');
        $message->setBody('Test');
        $message->setUrl('https://lzomedia.com');
        $message->setSummary('Test');

        $message->setImage('https://lzomedia.com');

        $accessToken = session()->get('linkedin_access_token');

        dispatch(new ShareonLinkedIn($message));

        $this->info('Done');
    }

}
