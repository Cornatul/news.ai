<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;



use Cornatul\Social\Objects\Message;
use Cornatul\Social\Service\GithubService;
use Cornatul\Social\Service\MediumService;
use Cornatul\Social\Service\TwitterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use PHPUnit\TextUI\RuntimeException;
use Smolblog\OAuth2\Client\Provider\Twitter;


class MediumController extends Controller
{

    private MediumService $service;

    public function __construct()
    {
        $this->service = new MediumService();
    }



    public function index()
    {
        return view('social::medium.index');
    }

    /**
     * @throws \Exception
     */
    public function shareAction(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required',
            'tags' => 'required',
            'url' => 'required',
        ]);

        $message = new Message();
        $message->setTitle($request->input('title'));
        $message->setImage($request->input('image'));
        $message->setBody($request->input('body'));
        $message->setUrl($request->input('url'));

        $tags = explode(',', $request->input('tags'));

        $message->setTagsAsArray($tags);

        $this->service->shareOnWall($message);

        return redirect(route('social.medium.index'))->with('success', 'Post shared successfully.');
    }
}
