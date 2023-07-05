<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;



use Cornatul\Social\Objects\Message;
use Cornatul\Social\Service\GithubService;
use Cornatul\Social\Service\TwitterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use PHPUnit\TextUI\RuntimeException;
use Smolblog\OAuth2\Client\Provider\Twitter;


class TwitterController extends Controller
{

    private TwitterService $service;

    public function __construct()
    {
        $this->service = new TwitterService();
    }



    public function index(TwitterService $service)
    {
        $trends = $service->getTrends();

        return view('social::twitter.index', compact('trends'));
    }

    /**
     * @throws \Exception
     */
    public function shareAction(Request $request): RedirectResponse
    {

        $request->validate([
            'message' => 'required',
            'url' => 'required',
        ]);

        $message = new Message();
        $body = $request->input('message');
        $message->setBody($body);
        $message->setUrl($request->input('url'));

        $this->service->shareOnWall($message);

        return redirect(route('social.twitter.index'))->with('success', 'Post shared successfully.');
    }
}
