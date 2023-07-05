<?php

namespace Cornatul\Social\Tests\Unit;

use Cornatul\Social\Contracts\ShareContract;
use Cornatul\Social\DTO\TwitterTrendingDTO;
use Cornatul\Social\Objects\Message;
use Cornatul\Social\Service\TumblrService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Mockery;


class SocialTest extends \Cornatul\Social\Tests\TestCase
{


    public function test_can_get_twitter_trends(): void
    {
        $social = Mockery::mock(ShareContract::class);

        $social->shouldReceive('getTwitterTrends')
            ->once()
            ->andReturn(new TwitterTrendingDTO());

        $this->assertInstanceOf(TwitterTrendingDTO::class, $social->getTwitterTrends());
    }

    public function testShareOnWall()
    {
        $accessTokenMock = Mockery::mock(new AccessToken($options = [
            'access_token' => 'test_access_token',
            'access_token_secret' => 'test_access_token_secret',
            'resource_owner_id' => 'test_resource_owner_id',
            'resource_owner_secret' => 'test_resource_owner_secret',
        ]));


        $messageMock = $this->createMock(Message::class);
        $messageMock->method('getTitle')->willReturn('test_title');
        $messageMock->method('getTagsAsArray')->willReturn(['test_tag']);
        $messageMock->method('getBody')->willReturn('test_body');

        $mockHandler = new MockHandler([
            new Response(200, [], '{"response":{"id":"1234567890"}}')
        ]);

        $handlerStack = HandlerStack::create($mockHandler);

        $clientMock = new Client(['handler' => $handlerStack]);

        $service = new TumblrService($clientMock);

        $response = $service->shareOnWall($accessTokenMock, $messageMock);

        $this->assertJson($response);
        $this->assertStringContainsString('"id":"1234567890"', $response);
    }
}
