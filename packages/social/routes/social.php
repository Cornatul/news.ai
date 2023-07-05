<?php

use Cornatul\Social\Http\DevToController;
use Cornatul\Social\Http\GithubController;
use Cornatul\Social\Http\GoogleMBController;
use Cornatul\Social\Http\LinkedInController;
use Cornatul\Social\Http\MediumController;
use Cornatul\Social\Http\SocialController;
use Cornatul\Social\Http\TumblrController;
use Cornatul\Social\Http\TwitterController;

Route::group(['middleware' => ['web','auth'],'prefix' => 'social', 'as' => 'social.'], static function () {
    //generate the index page
    Route::get('/', [SocialController::class, 'index'])->name('index');


    //LinkedIN
    Route::get('/linkedin', [LinkedInController::class, 'index'])->name('linkedin.index');
    Route::get('/linkedin/login', [LinkedInController::class, 'login'])->name('linkedin.login');
    Route::get('/linkedin/callback', [LinkedInController::class, 'callback'])->name('linkedin.callback');
    Route::post('/linkedin/shareAction', [LinkedInController::class, 'shareAction'])->name('linkedin.shareAction');

    //Google
    Route::get('/google', [GoogleMBController::class, 'index'])->name('google.index');
    Route::get('/google/login', [GoogleMBController::class, 'login'])->name('google.login');
    Route::get('/google/callback', [GoogleMBController::class, 'callback'])->name('google.callback');
    Route::post('/google/shareAction', [GoogleMBController::class, 'shareAction'])->name('google.shareAction');



    //Twitter
    Route::get('/twitter', [TwitterController::class, 'index'])->name('twitter.index');
    Route::get('/twitter/share', [TwitterController::class, 'share'])->name('twitter.share');
    Route::post('/twitter/shareAction', [TwitterController::class, 'shareAction'])->name('twitter.shareAction');

    //Github
    Route::get('/github', [GithubController::class, 'index'])->name('github.index');
    Route::get('/github/login', [GithubController::class, 'login'])->name('github.login');
    Route::get('/github/callback', [GithubController::class, 'callback'])->name('github.callback');
    Route::post('/github/shareAction', [GithubController::class, 'shareAction'])->name('github.shareAction');


    //Medium
    Route::get('/medium', [MediumController::class, 'index'])->name('medium.index');
    Route::post('/medium/shareAction', [MediumController::class, 'shareAction'])->name('medium.shareAction');

    //DevTo
    Route::get('/devto', [DevToController::class, 'index'])->name('devto.index');
    Route::post('/devto/shareAction', [DevToController::class, 'shareAction'])->name('devto.shareAction');


    //Tumblr
    Route::get('/tumblr', [TumblrController::class, 'index'])->name('tumblr.index');
    Route::get('/tumblr/login', [TumblrController::class, 'login'])->name('tumblr.login');
    Route::get('/tumblr/callback', [TumblrController::class, 'callback'])->name('tumblr.callback');
    Route::post('/tumblr/shareAction', [TumblrController::class, 'shareAction'])->name('tumblr.shareAction');

    //To add more social media, just copy the above code and change the name of the social media

});
