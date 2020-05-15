<?php

declare(strict_types=1);

namespace Notifea\Services;

use Notifea\Clients\NotifeaClient;

abstract class Service
{
    /** @var NotifeaClient */
    protected $client;

    /**
     * Service constructor.
     */
    public function __construct(NotifeaClient $client)
    {
        $this->client = $client;
    }
}
