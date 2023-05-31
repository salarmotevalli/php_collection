<?php

namespace Salar\Maps\BST;

use Salar\Contract\Collection;
use Salar\Contract\MapCollection;
use Salar\Contract\Node;

class BSTMap implements MapCollection, Collection
{
    public ?Node $root = null;

    private function __construct()
    {
    }

    public static function new(): Collection
    {
        return new static();
    }

    public static function from(array $data): Collection
    {
        // TODO: Implement from() method.
    }

    public function insert(mixed $key, mixed $value): void
    {
        // TODO: Implement insert() method.
    }

    public function multi_insert(array $values): void
    {
        // TODO: Implement multi_insert() method.
    }

    public function clear(): void
    {
        // TODO: Implement clear() method.
    }

    public function first_value(): mixed
    {
        // TODO: Implement first_value() method.
    }

    public function is_empty(): bool
    {
        // TODO: Implement is_empty() method.
    }

    public function last_value(): mixed
    {
        // TODO: Implement last_value() method.
    }

    public function len(): int
    {
        // TODO: Implement len() method.
    }

    public function pop_first(): mixed
    {
        // TODO: Implement pop_first() method.
    }

    public function pop_last(): mixed
    {
        // TODO: Implement pop_last() method.
    }

    public function remove(mixed $value)
    {
        // TODO: Implement remove() method.
    }

    public function values(): array
    {
        // TODO: Implement values() method.
    }
}