<?php

declare(strict_types=1);

namespace Notifea\Entities;

class Attachment
{
    /** @var string */
    protected $content;

    /** @var string */
    protected $filename;

    /**
     * Attachment constructor.
     *
     * @param string $content
     * @param string $filename
     */
    public function __construct($content, $filename)
    {
        $this->content = $content;
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $content
     *
     * @return Attachment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param mixed $filename
     *
     * @return Attachment
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }
}
