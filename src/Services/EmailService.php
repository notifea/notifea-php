<?php

declare(strict_types=1);

namespace Notifea\Services;

use Notifea\Classes\ExceptionParser;
use Notifea\Classes\RequestOptions;
use Notifea\Collections\Collection;
use Notifea\Entities\Email;

class EmailService extends Service
{
    /**
     * Get all emails as paginated Collection response.
     *
     * @return Collection
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function getEmails()
    {
        $response = $this->client->getEmails();

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            $collection = new Collection();
            foreach ($content->data->paginated_data as $emailData) {
                $collection->add(new Email($emailData));
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
     * Get email by given $emailUuid.
     *
     * @return Email
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function getEmail(string $emailUuid)
    {
        $response = $this->client->getEmail($emailUuid);

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            return new Email($content->data);

        // on failure
        } else {
            // try to parse response and return instance of NotifeaException
            throw ExceptionParser::parse($response);
        }
    }

    /**
     * Send email.
     *
     * @return Email
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function sendEmail(Email $email, RequestOptions $requestOptions = null)
    {
        $response = $this->client->sendEmail($email, $requestOptions);

        // on success
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $content = json_decode($response->getBody()->getContents());

            return new Email($content->data);

        // on failure
        } else {
            // try to parse response and return instance of NotifeaException
            throw ExceptionParser::parse($response);
        }
    }

    /**
     * Delete email by given $emailUuid.
     *
     * @return bool
     *
     * @throws \Notifea\Exceptions\NotifeaException
     */
    public function deleteEmail(string $emailUuid)
    {
        $response = $this->client->deleteEmail($emailUuid);

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
