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
        return $this->get('/emails');
    }

    /**
     * Get single email by given $emailUuid.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getEmail(string $emailUuid)
    {
        return $this->get("/emails/$emailUuid");
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
            return $this->request('POST', "/emails$queryParameters", [
                    'multipart' => $email->getAttributesForMultipart(),
                ])
            ;
        } else {
            return $this->post("/emails$queryParameters", [
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
        return $this->delete("/emails/$emailUuid");
    }

    /**
     * Get paginated sms.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getSmss()
    {
        return $this->get('/sms');
    }

    /**
     * Get single sms by given $smsUuid.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getSms(string $smsUuid)
    {
        return $this->get("/sms/$smsUuid");
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

        return $this->post("/sms$queryParameters", [
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
        return $this->delete("/sms/$smsUuid");
    }
}
