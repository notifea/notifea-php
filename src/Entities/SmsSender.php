<?php

declare(strict_types=1);

namespace Notifea\Entities;

class SmsSender extends Entity
{

    protected $uuid;

    protected $sender_name;

    protected $sms_live_time;

    protected $created_at;

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getSenderName()
    {
        return $this->sender_name;
    }

    /**
     * @return mixed
     */
    public function getSmsLiveTime()
    {
        return $this->sms_live_time;
    }

    /**
     * @param mixed $uuid
     * @return SmsSender
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @param mixed $sender_name
     * @return SmsSender
     */
    public function setSenderName($sender_name)
    {
        $this->sender_name = $sender_name;
        return $this;
    }

    /**
     * @param mixed $sms_live_time
     * @return SmsSender
     */
    public function setSmsLiveTime($sms_live_time)
    {
        $this->sms_live_time = $sms_live_time;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

}
