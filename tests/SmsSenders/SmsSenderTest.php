<?php


namespace Notifea\Tests\SmsSenders;


use GuzzleHttp\Psr7\Response;
use Notifea\Clients\NotifeaClient;
use Notifea\Collections\Collection;
use Notifea\Entities\SmsSender;
use Notifea\Services\SmsSenderService;
use PHPUnit\Framework\TestCase;
use function GuzzleHttp\Psr7\stream_for;

class SmsSenderTest extends TestCase
{

    /**
     * @test
     */
    public function if_get_sms_senders_works()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('getSmsSenders')
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "paginated_data": [
                                {
                                    "uuid": "e6bd8388-664b-4025-95db-e72d114c5d56",
                                    "sender_name": "Notifea 2",
                                    "sms_live_time": 30,
                                    "created_at": "2021-03-21T19:13:49.000000Z"
                                },
                                {
                                    "uuid": "c6a319b0-9a4d-4d50-823c-966eb9d28c99",
                                    "sender_name": "Notifea",
                                    "sms_live_time": 24,
                                    "created_at": "2021-03-21T19:03:40.000000Z"
                                }
                            ],
                            "paginated_metadata": {
                                "current_page": 1,
                                "first_page_url": "http:\/\/api.notifea\/v1\/user-sms-senders?page=1",
                                "from": 1,
                                "last_page": 1,
                                "last_page_url": "http:\/\/api.notifea\/v1\/user-sms-senders?page=1",
                                "next_page_url": null,
                                "path": "http:\/\/api.notifea\/v1\/user-sms-senders",
                                "per_page": 10,
                                "prev_page_url": null,
                                "to": 2,
                                "total": 2
                            }
                        },
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            });

        $smsSenderService = new SmsSenderService($notifeaClient);

        $collection = $smsSenderService->getSmsSenders();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertTrue($collection->hasData());

        /** @var SmsSender $firstSmsSender */
        $firstSmsSender = $collection->getData()[0];

        $this->assertInstanceOf(SmsSender::class, $firstSmsSender);
        $this->assertEquals('e6bd8388-664b-4025-95db-e72d114c5d56', $firstSmsSender->getUuid());
        $this->assertEquals('Notifea 2', $firstSmsSender->getSenderName());
        $this->assertEquals(30, $firstSmsSender->getSmsLiveTime());
        $this->assertEquals('2021-03-21T19:13:49.000000Z', $firstSmsSender->getCreatedAt());
    }

    /**
     * @test
     */
    public function if_get_sms_sender_works() {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('getSmsSender')
            ->withAnyArgs()
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "uuid": "c6a319b0-9a4d-4d50-823c-966eb9d28c99",
                            "sender_name": "Notifea",
                            "sms_live_time": 24,
                            "created_at": "2020-03-21T19:03:40.000000Z"
                        },
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            });

        $smsSenderService = new SmsSenderService($notifeaClient);

        $smsSender = $smsSenderService->getSmsSender('c6a319b0-9a4d-4d50-823c-966eb9d28c99');

        $this->assertInstanceOf(SmsSender::class, $smsSender);
        $this->assertEquals('c6a319b0-9a4d-4d50-823c-966eb9d28c99', $smsSender->getUuid());
        $this->assertEquals('Notifea', $smsSender->getSenderName());
        $this->assertEquals(24, $smsSender->getSmsLiveTime());
        $this->assertEquals('2020-03-21T19:03:40.000000Z', $smsSender->getCreatedAt());
    }

    /**
     * @test
     */
    public function if_create_sms_sender_works() {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('createSmsSender')
            ->withAnyArgs()
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "uuid": "c6a319b0-9a4d-4d50-823c-966eb9d28c99",
                            "sender_name": "Notifea4",
                            "sms_live_time": 25,
                            "created_at": "2020-03-21T19:03:40.000000Z"
                        },
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            });

        $smsSenderService = new SmsSenderService($notifeaClient);

        $smsSender = (new SmsSender())->setSenderName('Notifea');

        $smsSender = $smsSenderService->createSmsSender($smsSender);

        $this->assertInstanceOf(SmsSender::class, $smsSender);
        $this->assertEquals('c6a319b0-9a4d-4d50-823c-966eb9d28c99', $smsSender->getUuid());
        $this->assertEquals('Notifea4', $smsSender->getSenderName());
        $this->assertEquals(25, $smsSender->getSmsLiveTime());
        $this->assertEquals('2020-03-21T19:03:40.000000Z', $smsSender->getCreatedAt());
    }

    /**
     * @test
     */
    public function if_update_sms_sender_works() {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('updateSmsSender')
            ->withAnyArgs()
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "uuid": "c6a319b0-9a4d-4d50-823c-966eb9d28c99",
                            "sender_name": "Notifea4",
                            "sms_live_time": 25,
                            "created_at": "2020-03-21T19:03:40.000000Z"
                        },
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            });

        $smsSenderService = new SmsSenderService($notifeaClient);

        $smsSender = (new SmsSender())
            ->setSenderName('Notifea')
            ->setUuid('c6a319b0-9a4d-4d50-823c-966eb9d28c99')
            ->setSmsLiveTime(25)
        ;

        $smsSender = $smsSenderService->updateSmsSender($smsSender);

        $this->assertInstanceOf(SmsSender::class, $smsSender);
        $this->assertEquals('c6a319b0-9a4d-4d50-823c-966eb9d28c99', $smsSender->getUuid());
        $this->assertEquals('Notifea4', $smsSender->getSenderName());
        $this->assertEquals(25, $smsSender->getSmsLiveTime());
        $this->assertEquals('2020-03-21T19:03:40.000000Z', $smsSender->getCreatedAt());
    }

    /**
     * @test
     */
    public function if_delete_sms_sender_works()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('deleteSmsSender')
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

        $smsSenderService = new SmsSenderService($notifeaClient);

        $result = $smsSenderService->deleteSmsSender('8fc2c850-81c0-4424-823a-aa4727441864');

        $this->assertTrue($result);
    }
}
