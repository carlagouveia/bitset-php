<?php

declare(strict_types=1);

namespace Cpp\Std;

use PHPUnit\Framework\TestCase;

class BitSetTest extends TestCase
{
    public function testIsInitializing(): void
    {
        $bitSet = new BitSet(8);
        $this->assertEquals('00000000', (string) $bitSet);
    }

    public function testIsInitializingWithString(): void
    {
        $bitSet = BitSet::fromString(8, '1111');
        $this->assertInstanceOf(BitSet::class, $bitSet);
        $this->assertEquals('00001111', (string) $bitSet);

        $bitSet2 = BitSet::fromString(8, '1010');
        $this->assertInstanceOf(BitSet::class, $bitSet2);
        $this->assertEquals('00001010', (string) $bitSet2);
    }

    public function testIsInitializingWithOtherSizes(): void
    {
        $bitSet = new BitSet(16);
        $this->assertEquals('0000000000000000', (string) $bitSet);

        $bitSet = new BitSet(64);
        $this->assertEquals('0000000000000000000000000000000000000000000000000000000000000000', (string) $bitSet);

        $bitSet = new BitSet(136);
        $this->assertEquals('0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000', (string) $bitSet);
    }

    public function testIsSettingByIndex(): void
    {
        $bitSet = new BitSet(8);
        $bitSet->set(1);
        $this->assertEquals('00000010', (string) $bitSet);
    }

    public function testIsSettingMultipleByIndex(): void
    {
        $bitSet = new BitSet(8);
        $bitSet->set(1);
        $bitSet->set(4);
        $this->assertEquals('00010010', (string) $bitSet);
    }

    public function testIsResettingByIndex(): void
    {
        $bitSet = new BitSet(8);
        $bitSet->set(1);
        $bitSet->reset(1);
        $this->assertEquals('00000000', (string) $bitSet);
    }

    public function testIsResettingMultipleByIndex(): void
    {
        $bitSet = new BitSet(8);
        $bitSet->set(1);
        $bitSet->set(4);
        $bitSet->reset(1);
        $bitSet->reset(4);
        $this->assertEquals('00000000', (string) $bitSet);
    }

    public function testIsTestingBit(): void
    {
        $bitSet = new BitSet(8);
        $bitSet->set(1);

        $this->assertFalse($bitSet->test(0));
        $this->assertTrue($bitSet->test(1));
        $this->assertFalse($bitSet->test(2));
    }

    public function testIsCountingSetBits(): void
    {
        $bitSet = new BitSet(8);
        $bitSet->set(1);
        $bitSet->set(4);
        $this->assertEquals(2, $bitSet->count());
    }

    public function testIsInitializingAndTesting(): void
    {
        $b1 = new BitSet(16);
        $b1->set(2);
        $b1->set(3);
        $b1->set(4);
        $b1->set(5);
        $b1->set(10);
        $b1->set(15);

        $this->assertEquals('1000010000111100', (string) $b1);

        $b2 = BitSet::fromString(16, '1000010000111100');
        $this->assertFalse($b2->test(1));
        $this->assertTrue($b2->test(2));
        $this->assertTrue($b2->test(3));
        $this->assertTrue($b2->test(4));
    }
}
