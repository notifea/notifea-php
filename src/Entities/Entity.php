<?php

declare(strict_types=1);

namespace Notifea\Entities;

abstract class Entity
{
    /**
     * Entity constructor.
     */
    public function __construct(\stdClass $entity = null)
    {
        if (null !== $entity) {
            foreach (get_object_vars($entity) as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     */
    public function getAttributesForMultipart()
    {
        $data = [];

        foreach ($this->getAttributes() as $key => $value) {
            if (\is_array($value)) {
                foreach ($value as $valueInnerValue) {
                    // we only know how to add attachments
                    // everything else is ignored
                    if ($valueInnerValue instanceof Attachment) {
                        $data[] = [
                            'name' => $key . '[]',
                            'contents' => $valueInnerValue->getContent(),
                            'filename' => $valueInnerValue->getFilename(),
                        ];
                    }
                }
            } else {
                $data[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        return $data;
    }
}
