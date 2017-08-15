<?php

namespace Empari\MailFinder\Services;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Facades\Log;

class MailFinderIOService implements MailFinderServiceInterface
{

    /**
     * @var Guzzle
     */
    protected $client;

    /**
     * @var string
     */
    protected $endpoint = 'http://api.mailfinder.io/v1/verify/email=%s&apikey=%s&maxtime=%s';

    /**
     * EmailFinderIOService constructor.
     *
     * @param Guzzle $client
     */
    public function __construct(Guzzle $client)
    {
        $this->client = $client;
    }

    /**
     * Verify if email is valid
     *
     * @param string $email
     * @return bool
     * @throws \Exception
     */
    public function isValid(string $email)
    {
        $request = $this->makeRequest($email);
        $response = json_decode($request->getBody()->getContents(), true);

        Log::info(sprintf('%s, checked if email is valid', $email));

        if (!isset($response['result'])) {
            return true;
        }

        if (strpos($response['result'], 'send') !== FALSE) {
            return true;
        }

        if (strpos($response['result'], 'risky') !== FALSE) {
            return true;
        }

        if (strpos($response['result'], 'suspicious') !== FALSE) {
            return true;
        }

        return false;
    }

    /**
     * Make the URL Request
     *
     * @param $email
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function makeRequest($email)
    {
        return $this->client->request('GET', sprintf($this->endpoint, $email, config('services.mailfinder-io.secret'), config('services.mailfinder-io.limit')));
    }
}