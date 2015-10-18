# DoctrineAdditionalType

Provide additional mapping types for Doctrine2.

[![Build Status](https://travis-ci.org/okapon/DoctrineAdditionalType.svg?branch=master)](https://travis-ci.org/okapon/DoctrineAdditionalType)

Additional type

| type | explain |
|:--:|:---------:|
| `unescaped_json` | This is dangerous type. PHP's array always converted to no UTF-8 encoded JSON using PHP’s `json_decode($value, JSON_UNESCAPED_SLASHES)` function. |

## Usage

Register Type

```php
\Doctrine\DBAL\Types\Type::addType('unescaped_json', 'Okapon\DoctrineAdditionalType\Types\UnescapedJsonArrayType');
```

For symfony configuration

```yml
# config.yml
doctrine:
    dbal:
        # ....
        types:
            unescaped_json: Okapon\DoctrineAdditionalType\Types\UnescapedJsonArrayType
```

Entity configuration (annotation)

```php
class User
{
    /**
     * @var array
     *
     * @ORM\Column(name="attr", type="unescaped_json", nullable=true)
     */
    private $attr;
}
```

