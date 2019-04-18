<?php

namespace SpaceDB\Astrometry;

use SpaceDB\Exceptions\AstrometryException;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AstrometryInterface
{
    public function __construct()
    {
        # ...
    }

    private function get($url)
    {
        return $this->submit($url, array(), 'GET');
    }

    private function post($url, $data)
    {
        return $this->submit($url, $data, 'POST');
    }

    private function submit($url, $data, $type)
    {
        Log::info('[AstrometryInterface] submit(' . $type . '): ' . $url);
        $response = with(new HttpClient())->request($type, $url, array(
                'form_params' => array('request-json' => json_encode($data, JSON_UNESCAPED_SLASHES)))
        );
        return json_decode($response->getBody()->getContents());
    }

    public function login()
    {
        // Test if an API key is specified
        if (strlen(trim(config('astrometry.api.key'))) === 0) {
            Log::error('The astrometry interface has no API key configured');
            throw new AstrometryException('The astrometry interface has no API key configured');
        }

        // Make the request
        $response = $this->post(config('astrometry.urls.login'), ['apikey' => config('astrometry.api.key')]);

        if ($response->status === 'success') {
            Cache::put('astrometry_session', $response->session, 60);
            $this->tries = 5;
        } else {
            Log::error('Login to astrometry service failed: ' . $response->errormessage);
            throw new AstrometryException('Login to astrometry service failed, ' . $response->errormessage);
        }
    }

    public function getSubmissionStatus($submissionId)
    {
        $submissionStatusUrl = config('astrometry.urls.submissions') . '/' . $submissionId;
        return $this->get($submissionStatusUrl);
    }

    public function getJobStatus($jobId)
    {
        $jobStatusUrl = config('astrometry.urls.jobs') . '/' . $jobId;
        return $this->get($jobStatusUrl);
    }

    public function getJobInfo($jobId)
    {
        $jobInfoUrl = config('astrometry.urls.jobs') . '/' . $jobId . '/info';
        return $this->get($jobInfoUrl);
    }

    public function getKnowObjects($jobId)
    {
        $knowObjectsUrl = config('astrometry.urls.jobs') . '/' . $jobId . '/objects_in_field/';
        return $this->get($knowObjectsUrl);
    }

    public function isReachable()
    {
        // Test if the astrometry service is reachable
        $result = with(new HttpClient())->get(config('astrometry.urls.login'))->getStatusCode() === 200;
        Log::info('Testing if astrometry service is reachable: ' . ($result == 1 ? 'Successful' : 'Failed'));
        return $result;
    }

    public function uploadFromUrl($url)
    {
        // Test if there is a saved astrometry session key available in the cache, if not, login and get one
        if (!Cache::has('astrometry_session')) {
            Log::warning('There is no cached astrometry session, trying to login now.');
            $this->login();
        }

        // The data needed to upload an image, will be rounded up with data from the astrometry configuration file
        $data = [
            'session' => Cache::get('astrometry_session'),
            'url' => $url
        ];

        // Making the request to the API
        $submissionPayload = array_merge(config('astrometry.upload_data'), $data);
        Log::info('Submitting image to astrometry.net, payload: ' . json_encode($submissionPayload));
        $response = $this->post(config('astrometry.urls.url_upload'), $submissionPayload);

        // Test for submission response
        if ($response->status == 'error' && starts_with($response->errormessage, 'no session')) {
            // The submission failed due to an invalid session key, clearing cache. The submission job will be running again with a new session key soon
            Cache::pull('astrometry_session');
            Log::warn('Invalid astrometry session was used for submitting an image, clearing cached session key');
            throw new AstrometryException('Invalid astrometry session was used for submitting an image, clearing cached session key');
        } elseif ($response->status == 'success') {
            // The image has been submitted successfully
            return $response;
        } else {
            // The submission returned an unexpected response status
            Log::error('Astrometry submission returned an unexpected status');
            throw new AstrometryException('Astrometry submission returned an unexpected status');
        }
    }
}