<?php

namespace Enum;

use PHPUnit\Framework\TestCase;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 *
 * @group Enum
 */
class EnumTest extends TestCase
{
    const NAME_NONE = 'NONE';
    const NAME_NOTEXIST = '';

    protected $enum;

    public function setUp()
    {
        $this->enum = $this->getMockForAbstractClass('\Enum\Enum');
    }

    /**
     * @test
     */
    public function testIsValidNameNone()
    {
        $this->assertTrue($this->enum->isValidName(self::NAME_NONE));
        $this->assertFalse($this->enum->isValidName(strtolower(self::NAME_NONE), true));
    }

    /**
     * @test
     */
    public function testGetByNameNone()
    {
        $value = $this->enum->getByName(self::NAME_NONE);
        $this->assertNull($value);
        return $value;
    }

    /**
     * @test
     * @depends testGetByNameNone
     *
     * @param string $value
     */
    public function testIsValidValueNone($value)
    {
        $this->assertTrue($this->enum->isValidValue($value));
    }

    /**
     * @test
     * @depends testGetByNameNone
     *
     * @param string $value
     */
    public function testGetNameNone($value)
    {
        $this->assertEquals(self::NAME_NONE, $this->enum->getName($value));
    }

    /**
     * @test
     */
    public function testGetByNameNotExist()
    {
        $this->assertNull($this->enum->getByName(self::NAME_NOTEXIST));
    }
}
