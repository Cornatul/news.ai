<?php
declare(strict_types=1);
namespace Cornatul\Social\Http;



use Cornatul\Social\Objects\Message;
use Cornatul\Social\Service\GoogleMBNService;
use Cornatul\Social\Service\GoogleMBService;
use Cornatul\Social\Service\LinkedInService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\LinkedIn;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

use League\OAuth2\Client\Provider\Google;

class GoogleMBController extends Controller
{
    private Google $provider;

    private GoogleMBService $service;

    public function __construct()
    {
        $this->provider = new Google([
            'clientId' => config('social.google.clientId'),
            'clientSecret' => config('social.google.clientSecret'),
            'redirectUri' => config('social.google.redirectUri'),
        ]);

        $this->service = new GoogleMBService($this->provider);
    }



    public function index()
    {
        return view('social::google.index');
    }

    public function login(Request $request)
    {
        if (!$request->has('code')) {
            $authUrl = $this->service->getAuthUrl();
            return redirect($authUrl);
        }
    }


    //generate callback function

    public function callback(Request $request)
    {
        $accessToken = $this->service->getAccessToken($request->input('code'));
        session()->put('google_access_token', $accessToken);
        return redirect()->route('social.google.index');
    }


    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     * @throws GuzzleException
     * @throws IdentityProviderException
     * @throws \JsonException
     */
    public function shareAction(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'summary' => 'required',
            'message' => 'required',
            'image' => 'required',
        ]);

        $accessToken = session()->get('google_access_token');

        $message = new Message();

        $message->setTitle($request->input('title'));
        $message->setUrl($request->input('url'));
        $message->setSummary($request->input('summary'));
        $message->setBody($request->input('message'));
        $message->setImage($request->input('image'));

        $this->service->shareOnWall($accessToken, $message);

        return redirect(route('social.google.index'))->with('success', 'Post shared successfully.');
    }
}
