<?php

declare(strict_types=1);

namespace Notifea\Services;

use Notifea\Classes\ExceptionParser;
use Notifea\Collections\Collection;
use Notifea\Entities\SmsSender;

class SmsSenderService extends Service
{

    /**
     * Get all sms senders as paginated Collection response.
     *
     * @return Collection
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function getSmsSenders()
    {
        $response = $this->client->getSmsSenders();

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            $collection = new Collection();
            foreach ($content->data->paginated_data as $smsData) {
                $collection->add(new SmsSender($smsData));
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
     * Get sms sender by given $smsSenderUuid.
     *
     * @return SmsSender
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function getSmsSender(string $smsSenderUuid)
    {
        $response = $this->client->getSmsSender($smsSenderUuid);

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            return new SmsSender($content->data);
        // on failure
        } else {
            // try to parse response and return instance of NotifeaException
            throw ExceptionParser::parse($response);
        }
    }

    /**
     * Create sms sender
     *
     * @return SmsSender
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function createSmsSender(SmsSender $smsSender)
    {
        $response = $this->client->createSmsSender($smsSender->getSenderName());

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            return new SmsSender($content->data);
        // on failure
        } else {
            // try to parse response and return instance of NotifeaException
            throw ExceptionParser::parse($response);
        }
    }

    public function updateSmsSender(SmsSender $smsSender)
    {
        $response = $this->client->updateSmsSender(
            $smsSender->getUuid(),
            $smsSender->getSenderName(),
            $smsSender->getSmsLiveTime()
        );

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            return new SmsSender($content->data);
            // on failure
        } else {
            // try to parse response and return instance of NotifeaException
            throw ExceptionParser::parse($response);
        }
    }

    /**
     * Delete sms sender by given $smsSenderUuid.
     *
     * @return bool
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function deleteSmsSender(string $smsSenderUuid)
    {
        $response = $this->client->deleteSmsSender($smsSenderUuid);

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
