<?php

declare(strict_types=1);

namespace Notifea\Tests\SMS;

use GuzzleHttp\Psr7\Response;
use Notifea\Clients\NotifeaClient;
use Notifea\Collections\Collection;
use Notifea\Entities\Sms;
use Notifea\Services\SmsService;
use PHPUnit\Framework\TestCase;
use function GuzzleHttp\Psr7\stream_for;

class SmsTest extends TestCase
{
    /**
     * @test
     */
    public function if_get_smss_works()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('getSmss')
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "paginated_data": [
                                {
                                    "uuid": "e8ad60a3-d63c-447a-b2c6-2c2851709e67",
                                    "recipient": "+421902739429",
                                    "content": "Hello. I am using awesome Notifea services!",
                                    "result": 1,
                                    "delete_at": "2020-05-21T20:33:38.000000Z",
                                    "created_at": "2020-04-21T20:33:38.000000Z",
                                    "user_sms_sender": {
                                        "uuid": "c6a319b0-9a4d-4d50-823c-966eb9d28c99",
                                        "sender_name": "Notifea",
                                        "sms_live_time": 30,
                                        "created_at": "2020-03-21T19:03:40.000000Z"
                                    },
                                    "country": {
                                        "id": 1,
                                        "nice_name": "Slovakia"
                                    }
                                }
                            ],
                            "paginated_metadata": {
                                "current_page": 1,
                                "first_page_url": "http://api.notifea/sms?page=1",
                                "from": 1,
                                "last_page": 17,
                                "last_page_url": "http://api.notifea/sms?page=17",
                                "next_page_url": "http://api.notifea/sms?page=2",
                                "path": "http://api.notifea/sms",
                                "per_page": "1",
                                "prev_page_url": null,
                                "to": 1,
                                "total": 17
                            }
                        },
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            })
        ;

        $smsService = new SmsService($notifeaClient);

        $collection = $smsService->getSmss();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertTrue($collection->hasData());
    }

    /**
     * @test
     */
    public function if_get_sms_works()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('getSms')
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "uuid": "e8ad60a3-d63c-447a-b2c6-2c2851709e67",
                            "recipient": "+421902739429",
                            "content": "Hello. I am using awesome Notifea services!",
                            "result": 1,
                            "delete_at": "2020-05-21T20:33:38.000000Z",
                            "created_at": "2020-04-21T20:33:38.000000Z",
                            "user_sms_sender": {
                                "uuid": "c6a319b0-9a4d-4d50-823c-966eb9d28c99",
                                "sender_name": "Notifea",
                                "sms_live_time": 30,
                                "created_at": "2020-03-21T19:03:40.000000Z"
                            },
                            "country": {
                                "id": 1,
                                "nice_name": "Slovakia"
                            }
                        },
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            })
        ;

        $smsService = new SmsService($notifeaClient);

        $sms = $smsService->getSms('e8ad60a3-d63c-447a-b2c6-2c2851709e67');

        $this->assertInstanceOf(Sms::class, $sms);
        $this->assertEquals($sms->getUuid(), 'e8ad60a3-d63c-447a-b2c6-2c2851709e67');
    }

    /**
     * @test
     */
    public function if_send_sms_works()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('sendSms')
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "uuid": "e8ad60a3-d63c-447a-b2c6-2c2851709e67",
                            "recipient": "+421902739429",
                            "content": "Hello. I am using awesome Notifea services!",
                            "result": 1,
                            "delete_at": "2020-05-21T20:33:38.000000Z",
                            "created_at": "2020-04-21T20:33:38.000000Z",
                            "user_sms_sender": {
                                "uuid": "c6a319b0-9a4d-4d50-823c-966eb9d28c99",
                                "sender_name": "Notifea",
                                "sms_live_time": 30,
                                "created_at": "2020-03-21T19:03:40.000000Z"
                            },
                            "country": {
                                "id": 1,
                                "nice_name": "Slovakia"
                            }
                        },
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            })
        ;

        $smsService = new SmsService($notifeaClient);

        $sms = new Sms();
        $sms->setSmsSenderid('c6a319b0-9a4d-4d50-823c-966eb9d28c99')
            ->setRecipient('+421902739429')
            ->setContent('Hello. I am using awesome Notifea services!')
        ;

        $sms = $smsService->sendSms($sms);

        $this->assertInstanceOf(Sms::class, $sms);
        $this->assertEquals($sms->getUuid(), 'e8ad60a3-d63c-447a-b2c6-2c2851709e67');
        $this->assertEquals($sms->getRecipient(), '+421902739429');
        $this->assertEquals($sms->getContent(), 'Hello. I am using awesome Notifea services!');
    }

    /**
     * @test
     */
    public function if_delete_sms_works()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('deleteSms')
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": [],
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            })
        ;

        $smsService = new SmsService($notifeaClient);

        $result = $smsService->deleteSms('8fc2c850-81c0-4424-823a-aa4727441864');

        $this->assertTrue($result);
    }
}
