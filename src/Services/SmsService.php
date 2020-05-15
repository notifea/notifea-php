<?php

declare(strict_types=1);

namespace Notifea\Services;

use Notifea\Classes\ExceptionParser;
use Notifea\Classes\RequestOptions;
use Notifea\Collections\Collection;
use Notifea\Entities\Sms;

class SmsService extends Service
{
    /**
     * Get all sms as paginated Collection response.
     *
     * @return Collection
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function getSmss()
    {
        $response = $this->client->getSmss();

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            $collection = new Collection();
            foreach ($content->data->paginated_data as $smsData) {
                $collection->add(new Sms($smsData));
            }

            $collection->setPaginatedMetadata($content->data->paginated_metadata);

            return $collection;
        // on failure
        } else {
            // try to parse response and return instance of NotifeaException
            throw ExceptionParser::parse($response);
        }
    }

    /**
     * Get sms by given $smsUuid.
     *
     * @return Sms
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function getSms(string $smsUuid)
    {
        $response = $this->client->getSms($smsUuid);

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            return new Sms($content->data);

        // on failure
        } else {
            // try to parse response and return instance of NotifeaException
            throw ExceptionParser::parse($response);
        }
    }

    /**
     * Send sms.
     *
     * @return Sms
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function sendSms(Sms $sms, RequestOptions $requestOptions = null)
    {
        $response = $this->client->sendSms($sms, $requestOptions);

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            return new Sms($content->data);
        // on failure
        } else {
            // try to parse response and return instance of NotifeaException
            throw ExceptionParser::parse($response);
        }
    }

    /**
     * Delete sms by given $smsUuid.
     *
     * @return bool
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function deleteSms(string $smsUuid)
    {
        $response = $this->client->deleteSms($smsUuid);

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return true;
        // on failure
        } else {
            // try to parse response and return instance of NotifeaException
            throw ExceptionParser::parse($response);
        }
    }
}
