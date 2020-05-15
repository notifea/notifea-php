<?php

declare(strict_types=1);

namespace Notifea\Tests\Emails;

use GuzzleHttp\Psr7\Response;
use Notifea\Clients\NotifeaClient;
use Notifea\Collections\Collection;
use Notifea\Entities\Email;
use Notifea\Entities\Sms;
use Notifea\Services\EmailService;
use Notifea\Services\SmsService;
use PHPUnit\Framework\TestCase;
use function GuzzleHttp\Psr7\stream_for;

class EmailsTest extends TestCase
{
    /**
     * @test
     */
    public function if_get_emails_work()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('getEmails')
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "paginated_data": [
                                {
                                    "uuid": "8fc2c850-81c0-4424-823a-aa4727441864",
                                    "subject": "Subject :)",
                                    "recipient": "test@notifea.com",
                                    "cc": "cc@notifea.com",
                                    "bcc": "bcc@notifea.com",
                                    "reply_to": "reply_to@notifea.com",
                                    "html_body": "<h1>Awesome content of my email!<\/h1>",
                                    "text_body": "Awesome content of my email",
                                    "result": "success",
                                    "created_at": "2020-04-19T04:41:25.000000Z",
                                    "delete_at": "2020-05-19T04:41:25.000000Z",
                                    "email_recipients_results": [
                                        {
                                            "recipient": "test@notifea.com",
                                            "status": "sent"
                                        },
                                        {
                                            "recipient": "cc@notifea.com",
                                            "status": "sent"
                                        },
                                        {
                                            "recipient": "bcc@notifea.com",
                                            "status": "sent"
                                        }
                                    ],
                                    "domain": {
                                        "uuid": "59634971-e57f-44af-b530-038e27e7064e",
                                        "domain": "test.notifea.com",
                                        "emails_live_time": 30,
                                        "periodic_check_enabled": 1,
                                        "spf_record_passed": 0,
                                        "spf_record_passed_last_check": "2020-04-19T04:43:41.000000Z",
                                        "dkim_record_passed": 0,
                                        "dkim_record_passed_last_check": "2020-04-19T04:43:42.000000Z",
                                        "sign_with_dkim": 1,
                                        "dkim_public_key": null,
                                        "dmarc_record_passed": 0,
                                        "dmarc_record_passed_last_check": "2020-04-19T04:43:41.000000Z",
                                        "created_at": "2020-04-05T15:34:36.000000Z",
                                        "mailserver": {
                                            "uuid": "e2629d4f-df0d-48d8-90f7-687b9367c65c",
                                            "ip": "123.123.123.123",
                                            "hostname": "mail.notifea.com"
                                        }
                                    },
                                    "domain_address": {
                                        "uuid": "68b12c2d-aaf4-42ba-8b8b-9ac610672f50",
                                        "address": "notifea.com",
                                        "full_address": "myaddress@notifea.com",
                                        "created_at": "2020-04-19T04:39:50.000000Z"
                                    }
                                }
                            ],
                            "paginated_metadata": {
                                "current_page": 1,
                                "first_page_url": "http:\/\/api.notifea\/emails?page=1",
                                "from": 1,
                                "last_page": 142,
                                "last_page_url": "http:\/\/api.notifea\/emails?page=142",
                                "next_page_url": "http:\/\/api.notifea\/emails?page=2",
                                "path": "http:\/\/api.notifea\/emails",
                                "per_page": "2",
                                "prev_page_url": null,
                                "to": 2,
                                "total": 283
                            }
                        },
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            })
        ;

        $emailService = new EmailService($notifeaClient);

        $collection = $emailService->getEmails();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertTrue($collection->hasData());
    }

    /**
     * @test
     */
    public function if_get_email_work()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('getEmail')
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "uuid": "8fc2c850-81c0-4424-823a-aa4727441864",
                            "subject": "Subject :)",
                            "recipient": "test@notifea.com",
                            "cc": "cc@notifea.com",
                            "bcc": "bcc@notifea.com",
                            "reply_to": "reply_to@notifea.com",
                            "html_body": "<h1>Awesome content of my email!<\/h1>",
                            "text_body": "Awesome content of my email",
                            "result": "success",
                            "created_at": "2020-04-19T04:41:25.000000Z",
                            "delete_at": "2020-05-19T04:41:25.000000Z",
                            "email_recipients_results": [
                                {
                                    "recipient": "test@notifea.com",
                                    "status": "sent"
                                },
                                {
                                    "recipient": "cc@notifea.com",
                                    "status": "sent"
                                },
                                {
                                    "recipient": "bcc@notifea.com",
                                    "status": "sent"
                                }
                            ],
                            "domain": {
                                "uuid": "59634971-e57f-44af-b530-038e27e7064e",
                                "domain": "test.notifea.com",
                                "emails_live_time": 30,
                                "periodic_check_enabled": 1,
                                "spf_record_passed": 0,
                                "spf_record_passed_last_check": "2020-04-19T04:43:41.000000Z",
                                "dkim_record_passed": 0,
                                "dkim_record_passed_last_check": "2020-04-19T04:43:42.000000Z",
                                "sign_with_dkim": 1,
                                "dkim_public_key": null,
                                "dmarc_record_passed": 0,
                                "dmarc_record_passed_last_check": "2020-04-19T04:43:41.000000Z",
                                "created_at": "2020-04-05T15:34:36.000000Z",
                                "mailserver": {
                                    "uuid": "e2629d4f-df0d-48d8-90f7-687b9367c65c",
                                    "ip": "123.123.123.123",
                                    "hostname": "mail.notifea.com"
                                }
                            },
                            "domain_address": {
                                "uuid": "68b12c2d-aaf4-42ba-8b8b-9ac610672f50",
                                "address": "notifea.com",
                                "full_address": "myaddress@notifea.com",
                                "created_at": "2020-04-19T04:39:50.000000Z"
                            }
                        },
                        "code": "ok"
                    }

                ');

                return new Response(200, [], $body);
            })
        ;

        $emailService = new EmailService($notifeaClient);

        $email = $emailService->getEmail('8fc2c850-81c0-4424-823a-aa4727441864');

        $this->assertInstanceOf(Email::class, $email);
        $this->assertEquals($email->getUuid(), '8fc2c850-81c0-4424-823a-aa4727441864');
    }

    /**
     * @test
     */
    public function if_send_email_work()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('sendEmail')
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "uuid": "8fc2c850-81c0-4424-823a-aa4727441864",
                            "subject": "Subject :)",
                            "recipient": "test@notifea.com",
                            "cc": "cc@notifea.com",
                            "bcc": "bcc@notifea.com",
                            "reply_to": "reply_to@notifea.com",
                            "html_body": "<h1>Awesome content of my email!<\/h1>",
                            "text_body": "Awesome content of my email",
                            "result": "success",
                            "created_at": "2020-04-19T04:41:25.000000Z",
                            "delete_at": "2020-05-19T04:41:25.000000Z",
                            "email_recipients_results": [
                                {
                                    "recipient": "test@notifea.com",
                                    "status": "sent"
                                },
                                {
                                    "recipient": "cc@notifea.com",
                                    "status": "sent"
                                },
                                {
                                    "recipient": "bcc@notifea.com",
                                    "status": "sent"
                                }
                            ],
                            "domain": {
                                "uuid": "59634971-e57f-44af-b530-038e27e7064e",
                                "domain": "test.notifea.com",
                                "emails_live_time": 30,
                                "periodic_check_enabled": 1,
                                "spf_record_passed": 0,
                                "spf_record_passed_last_check": "2020-04-19T04:43:41.000000Z",
                                "dkim_record_passed": 0,
                                "dkim_record_passed_last_check": "2020-04-19T04:43:42.000000Z",
                                "sign_with_dkim": 1,
                                "dkim_public_key": null,
                                "dmarc_record_passed": 0,
                                "dmarc_record_passed_last_check": "2020-04-19T04:43:41.000000Z",
                                "created_at": "2020-04-05T15:34:36.000000Z",
                                "mailserver": {
                                    "uuid": "e2629d4f-df0d-48d8-90f7-687b9367c65c",
                                    "ip": "123.123.123.123",
                                    "hostname": "mail.notifea.com"
                                }
                            },
                            "domain_address": {
                                "uuid": "68b12c2d-aaf4-42ba-8b8b-9ac610672f50",
                                "address": "notifea.com",
                                "full_address": "myaddress@notifea.com",
                                "created_at": "2020-04-19T04:39:50.000000Z"
                            }
                        },
                        "code": "ok"
                    }
                ');

                return new Response(200, [], $body);
            })
        ;

        $emailService = new EmailService($notifeaClient);

        $email = new Email();
        $email->setFrom('test@notifea.com');

        $email = $emailService->sendEmail($email);

        $this->assertInstanceOf(Email::class, $email);
        $this->assertEquals($email->getUuid(), '8fc2c850-81c0-4424-823a-aa4727441864');
    }

    /**
     * @test
     */
    public function if_delete_email_work()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('deleteEmail')
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

        $emailService = new EmailService($notifeaClient);

        $result = $emailService->deleteEmail('8fc2c850-81c0-4424-823a-aa4727441864');

        $this->assertTrue($result);
    }
}
