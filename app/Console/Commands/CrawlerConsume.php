<?php

declare(strict_types=1);

namespace App\Console\Commands;


use Cornatul\Social\Service\TwitterService;
use Illuminate\Database\Console\Migrations\BaseCommand;
use Illuminate\Support\Facades\Queue;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class CrawlerConsume extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts the crawler queue';

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $connection = new AMQPStreamConnection(
            '172.16.238.210',
            5672,
            'guest',
            'guest',
            'my_vhost'
        );

        $channel = $connection->channel();

        $channel->queue_declare('consumer', false, true, false, false);

        $this->info('Waiting for messages . To exit press CTRL + C');

        $callback = function (AMQPMessage $message)
        {
            $payload = $message->getBody();

            $this->info('Received message: ' . $payload);

            $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
        };

        $channel->basic_consume('consumer', '', false, false, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
