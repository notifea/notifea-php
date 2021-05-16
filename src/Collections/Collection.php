<?php

declare(strict_types=1);

namespace Notifea\Collections;

use Notifea\Entities\Email;
use Notifea\Entities\Sms;
use Notifea\Entities\SmsSender;

class Collection
{
    protected $data;

    protected $paginatedMetadata;

    /**
     * Add a new entry into collection.
     *
     * @param Email|Sms|SmsSender $entry
     *
     * @return $this
     */
    public function add($entry)
    {
        $this->data[] = $entry;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function hasData()
    {
        return \count($this->data) > 0;
    }

    /**
     * @return mixed
     */
    public function getPaginatedMetadata()
    {
        return $this->paginatedMetadata;
    }

    /**
     * @param mixed $paginatedMetadata
     */
    public function setPaginatedMetadata($paginatedMetadata)
    {
        $this->paginatedMetadata = $paginatedMetadata;
    }
}
