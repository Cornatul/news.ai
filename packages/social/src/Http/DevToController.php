<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;



use Cornatul\Social\Objects\Message;
use Cornatul\Social\Service\DevToService;
use Cornatul\Social\Service\GithubService;
use Cornatul\Social\Service\MediumService;
use Cornatul\Social\Service\TwitterService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use PHPUnit\TextUI\RuntimeException;
use Smolblog\OAuth2\Client\Provider\Twitter;


class DevToController extends Controller
{

    private DevToService $service;

    public function __construct(DevToService $service)
    {
        $this->service = $service;
    }



    public function index()
    {
        return view('social::devto.index');
    }

    /**
     * @throws \Exception
     * @throws GuzzleException
     */
    public function shareAction(Request $request): RedirectResponse
    {

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required',
            'tags' => 'required',
        ]);

        $message = new Message();
        $message->setTitle($request->input('title'));
        $message->setBody($request->input('body'));
        $message->setImage($request->input('image'));
        $tags = explode(',', $request->input('tags'));

        $message->setTagsAsArray($tags);

        $this->service->shareOnWall($message);

        return redirect(route('social.devto.index'))->with('success', 'Post shared successfully.');
    }
}
