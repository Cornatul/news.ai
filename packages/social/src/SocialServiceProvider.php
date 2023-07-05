<?php
declare(strict_types=1);
namespace Cornatul\Social;


use Cornatul\Social\Console\LinkedInPublishCommand;
use Cornatul\Social\Console\MediumPublishCommand;

class SocialServiceProvider extends \Illuminate\Support\ServiceProvider
{


    public function boot(): void
    {

        $this->loadRoutesFrom(__DIR__ . '/../routes/social.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'social');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

        $this->mergeConfigFrom(
            __DIR__ . '/Config/social.php', 'social'
        );
        $this->commands([
            MediumPublishCommand::class,
            LinkedInPublishCommand::class,
        ]);
    }

    public function register(): void
    {

    }
}
