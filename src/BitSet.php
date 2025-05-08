<?php

declare(strict_types=1);

namespace Cpp\Std;

class BitSet
{
    protected string $bits;

    /**
     * @var array<int|string>
     */
    protected array $bitList = [];

    protected const ACTIVE = '1';
    protected const INACTIVE = '0';

    public function __construct(int $bits)
    {
        for ($i = 0; $i < $bits; ++$i) {
            $this->bitList[] = self::INACTIVE;
        }

        $this->bits = implode($this->bitList);
    }

    public static function fromString(int $bits, ?string $initializers = null): BitSet
    {
        $bitSet = new BitSet($bits);
        if (!$initializers) {
            return $bitSet;
        }

        if (strlen($initializers) == $bits) {
            for ($i = 0; $i < $bits; ++$i) {
                if (self::ACTIVE == $initializers[$i]) {
                    $bitSet->bitList[$i] = self::ACTIVE;
                }
            }

            $bitSet->bits = implode($bitSet->bitList);
        } else {
            $bitSet->bits = str_pad($initializers, $bits, self::INACTIVE, STR_PAD_LEFT);
        }

        return $bitSet;
    }

    public function set(int $bit): void
    {
        $this->bitList[strlen($this->bits) - ($bit + 1)] = self::ACTIVE;
        $this->bits = implode($this->bitList);
    }

    public function reset(int $bit): void
    {
        $this->bitList[strlen($this->bits) - ($bit + 1)] = self::INACTIVE;
        $this->bits = implode($this->bitList);
    }

    public function test(int $bit): bool
    {
        return self::ACTIVE == $this->bitList[strlen($this->bits) - ($bit + 1)];
    }

    public function count(): int
    {
        return (int) array_count_values($this->bitList)[self::ACTIVE];
    }

    public function __toString(): string
    {
        return $this->bits;
    }
}
