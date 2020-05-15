<?php

declare(strict_types=1);

namespace Notifea\Tests\Exceptions;

use GuzzleHttp\Psr7\Response;
use Notifea\Clients\NotifeaClient;
use Notifea\Exceptions\NotifeaException;
use Notifea\Services\EmailService;
use PHPUnit\Framework\TestCase;
use function GuzzleHttp\Psr7\stream_for;

class ExceptionMappingTest extends TestCase
{
    /**
     * @test
     */
    public function if_exception_mapping_works()
    {
        $notifeaClient = \Mockery::mock(NotifeaClient::class);
        $notifeaClient
            ->shouldReceive('getEmails')
            ->andReturnUsing(function () {
                $body = stream_for('
                    {
                        "data": {
                            "message": "Unauthorized",
                            "metadata": []
                        },
                        "code": "unauthorized"
                    }
                ');

                return new Response(401, [], $body);
            })
        ;

        $emailService = new EmailService($notifeaClient);

        $this->expectException(NotifeaException::class);
        $this->expectExceptionCode(401);
        $this->expectExceptionMessage('Unauthorized');

        $emailService->getEmails();
    }
}
