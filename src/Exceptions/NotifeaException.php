<?php

declare(strict_types=1);

namespace Notifea\Exceptions;

use Throwable;

class NotifeaException extends \Exception implements \Throwable
{
    protected $notifeaCode;

    public function __construct($message = '', $code = 0, $notifeaCode = '', Throwable $previous = null)
    {
        $this->notifeaCode = $notifeaCode;
        parent::__construct($message, $code, $previous);
    }

    public function getNotifeaCode()
    {
        return $this->notifeaCode;
    }
}
