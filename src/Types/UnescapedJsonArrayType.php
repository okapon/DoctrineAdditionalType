<?php

namespace Okapon\DoctrineAdditionalType\Types;

use Doctrine\DBAL\Types\JsonArrayType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Array Type which can be used to generate json arrays.
 *
 * @author Yuichi Okada <yuuichi177@gmail.com>
 */
class UnescapedJsonArrayType extends JsonArrayType
{
    const UNESCAPED_JSON_ARRAY = 'unescaped_json_array';

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::UNESCAPED_JSON_ARRAY;
    }
}
