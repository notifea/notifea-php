<?php

declare(strict_types=1);

namespace Notifea\Clients;

use GuzzleHttp\Client;
use Notifea\Classes\RequestOptions;
use Notifea\Entities\Email;
use Notifea\Entities\Sms;

class NotifeaClient extends Client
{
    /**
     * NotifeaClient constructor.
     *
     * @param string $notifeaPublicApiHost
     * @param string $notifeaAuthorization
     * @param int    $connectTimeout
     * @param int    $timeout
     */
    public function __construct(
        $notifeaPublicApiHost,
        $notifeaAuthorization,
        $connectTimeout = 10,
        $timeout = 10
    ) {
        parent::__construct([
            'base_uri' => $notifeaPublicApiHost,
            'headers' => [
                'Authorization' => $notifeaAuthorization,
            ],
            'http_errors' => false,
            'connect_timeout' => $connectTimeout,
            'timout' => $timeout,
        ]);
    }

    /**
     * Get paginated emails.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getEmails()
    {
        return $this->get('/v1/emails');
    }

    /**
     * Get single email by given $emailUuid.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getEmail(string $emailUuid)
    {
        return $this->get("/v1/emails/$emailUuid");
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendEmail(Email $email, RequestOptions $requestOptions = null)
    {
        $queryParameters = '';
        if ($requestOptions instanceof RequestOptions && $requestOptions->hasData()) {
            $queryParameters .= '?' . http_build_query($requestOptions->getData());
        }

        // if email has attachments we have to send it as a multipart request option
        if ($email->hasAttachments()) {
            return $this->request('POST', "/v1/emails$queryParameters", [
                    'multipart' => $email->getAttributesForMultipart(),
                ])
            ;
        } else {
            return $this->post("/v1/emails$queryParameters", [
                    'json' => $email->getAttributes(),
                ])
            ;
        }
    }

    /**
     * Delete single email by given $emailUuid.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteEmail(string $emailUuid)
    {
        return $this->delete("/v1/emails/$emailUuid");
    }

    /**
     * Get paginated sms.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getSmss()
    {
        return $this->get('/v1/sms');
    }

    /**
     * Get single sms by given $smsUuid.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getSms(string $smsUuid)
    {
        return $this->get("/v1/sms/$smsUuid");
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendSms(Sms $sms, RequestOptions $requestOptions = null)
    {
        $queryParameters = '';
        if ($requestOptions instanceof RequestOptions && $requestOptions->hasData()) {
            $queryParameters .= '?' . http_build_query($requestOptions->getData());
        }

        return $this->post("/v1/sms$queryParameters", [
                'json' => $sms->getAttributes(),
            ])
        ;
    }

    /**
     * Delete single sms by given $smsUuid.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteSms(string $smsUuid)
    {
        return $this->delete("/v1/sms/$smsUuid");
    }

    /**
     * GET paginated sms senders
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getSmsSenders() {
        return $this->get('/v1/user-sms-senders');
    }

    /**
     * GET single sms sender by given uuid
     *
     * @param string $smsSenderUuid
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getSmsSender(string $smsSenderUuid)
    {
        return $this->get("/v1/user-sms-senders/$smsSenderUuid");
    }

    /**
     * CREATE new sms sender
     *
     * @param string $senderName
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createSmsSender(string $senderName)
    {
        return $this->post("/v1/user-sms-senders", [
                'json' => [
                    'sender_name' => $senderName,
                ]
            ])
        ;
    }

    /**
     * UPDATE existing sms sender
     *
     * @param string $smsSenderUuid
     * @param string $senderName
     * @param int $smsLiveTime
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateSmsSender(string $smsSenderUuid, string $senderName, int $smsLiveTime)
    {
        return $this->put("/v1/user-sms-senders/$smsSenderUuid", [
                'json' => [
                    'sender_name' => $senderName,
                    'sms_live_time' => $smsLiveTime
                ]
            ])
        ;
    }

    /**
     * DELETE sms sender by given uuid
     *
     * @param string $smsSenderUuid
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteSmsSender(string $smsSenderUuid)
    {
        return $this->delete("/v1/user-sms-senders/$smsSenderUuid");
    }

}
