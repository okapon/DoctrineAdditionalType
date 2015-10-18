<?php

namespace DoctrineExtensions\Tests\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Okapon\DoctrineAdditionalType\Types\UnescapedJsonArrayType;

class UnescapedJsonArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        Type::addType('unescaped_json_array', UnescapedJsonArrayType::class);
    }

    public function setUp()
    {
        $this->platform = $this->getMockForAbstractClass(AbstractPlatform::class);
        $this->type     = Type::getType('unescaped_json_array');
    }

    public function testReturnsName()
    {
        $this->assertSame(UnescapedJsonArrayType::UNESCAPED_JSON_ARRAY, $this->type->getName());
    }

    public function testPHPValueNullConvertsToJson()
    {
        $this->assertSame(null, $this->type->convertToDatabaseValue(null, $this->platform));
    }

    public function testPHPValueEmptyStringConvertsToJson()
    {
        $this->assertSame('""', $this->type->convertToDatabaseValue('', $this->platform));
    }

    public function testArrayCovertToUnescapedJson()
    {
        $value         = ['foo' => 'あ', 'bar' => 'い', 'buz' => ['qux' => 'う', 'quux' => 'え']];
        $databaseValue = '{"foo":"あ","bar":"い","buz":{"qux":"う","quux":"え"}}';
        $this->assertSame($databaseValue, $this->type->convertToDatabaseValue($value, $this->platform));
    }

}
