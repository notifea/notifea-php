<?php

declare(strict_types=1);

namespace Notifea\Entities;

class Email extends Entity
{
    protected $uuid;
    protected $subject;
    protected $from;
    protected $from_name;
    protected $recipient;
    protected $cc;
    protected $bcc;
    protected $reply_to;
    protected $html_body;
    protected $text_body;
    protected $attachments = [];
    protected $result;
    protected $created_at;
    protected $delete_at;

    /**
     * @param mixed $subject
     *
     * @return Email
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @param $from
     * @param null $fromName
     * @return $this
     */
    public function setFrom($from, $fromName = null)
    {
        $this->from = $from;
        $this->from_name = $fromName;

        return $this;
    }

    /**
     * @param mixed $fromName
     * @return Email
     */
    public function setFromName($fromName)
    {
        $this->from_name = $fromName;
        return $this;
    }

    /**
     * @param mixed $recipient
     *
     * @return Email
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * @param mixed $cc
     *
     * @return Email
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * @param mixed $bcc
     *
     * @return Email
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * @param mixed $reply_to
     *
     * @return Email
     */
    public function setReplyTo($reply_to)
    {
        $this->reply_to = $reply_to;

        return $this;
    }

    /**
     * @param mixed $html_body
     *
     * @return Email
     */
    public function setHtmlBody($html_body)
    {
        $this->html_body = $html_body;

        return $this;
    }

    /**
     * @param mixed $text_body
     *
     * @return Email
     */
    public function setTextBody($text_body)
    {
        $this->text_body = $text_body;

        return $this;
    }

    /**
     * @return $this
     */
    public function addAttachment(Attachment $emailAttachment)
    {
        $this->attachments[] = $emailAttachment;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasAttachments()
    {
        return \count($this->attachments) > 0;
    }

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
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function getFromName()
    {
        return $this->from_name;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return mixed
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @return mixed
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @return mixed
     */
    public function getReplyTo()
    {
        return $this->reply_to;
    }

    /**
     * @return mixed
     */
    public function getHtmlBody()
    {
        return $this->html_body;
    }

    /**
     * @return mixed
     */
    public function getTextBody()
    {
        return $this->text_body;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
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
}
