<?php

declare(strict_types=1);

namespace Notifea\Classes;

class RequestOptions
{
    protected $data = [];

    /**
     * @return $this
     */
    public function withLiveResult()
    {
        $this->data['live_result'] = true;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function hasData()
    {
        return \count($this->getData()) > 0;
    }
}
