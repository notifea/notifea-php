<?php

declare(strict_types=1);

namespace Notifea\Entities;

class Sms extends Entity
{
    protected $uuid;

    protected $sms_sender_id;

    protected $content;

    protected $recipient;

    protected $result;

    protected $created_at;

    protected $delete_at;

    protected $country;

    /**
     * @return mixed
     */
    public function getSmsSenderid()
    {
        return $this->sms_sender_id;
    }

    /**
     * @param mixed $sms_sender_id
     *
     * @return Sms
     */
    public function setSmsSenderid($sms_sender_id)
    {
        $this->sms_sender_id = $sms_sender_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return Sms
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param mixed $recipient
     *
     * @return Sms
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getDeleteAt()
    {
        return $this->delete_at;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }
}
