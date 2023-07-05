<?php

declare(strict_types=1);

namespace App\Console\Commands;


use Cornatul\Social\Service\TwitterService;
use Illuminate\Database\Console\Migrations\BaseCommand;
use Illuminate\Support\Facades\Queue;

class CrawlerProducer extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:produce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts the crawler queue';

    public function handle(): int
    {

        $this->info('✓ Welcome to the crawler queue !');

        $this->info('✓ Starting the crawler...');


        $data = [
            'url' => 'https://www.youtube.com/watch?v=QH2-TGUlwu4',
            'type' => 'youtube',
        ];

        Queue::connection('rabbitmq')->push('crawler', $data, 'producer');


        return 0;
    }
}
