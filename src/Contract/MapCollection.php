<?php

namespace Salar\Contract;

interface MapCollection
{
    // Create new
    public static function new(): Collection;

    // Create with default value
    public static function from(array $data): Collection;

    // Insert Node
    public function insert(mixed $key, mixed $value): void;

    public function multi_insert(array $items): void;


    // Clear DataStruct
    public function clear(): void;

    // Get first Node
    public function first_value(): mixed;

    // Is Btree empty?
    public function is_empty(): bool;

        // Get last Node
    public function last_value(): mixed;

    // return length of DataStruct
    public function len(): int;

    public function pop_first(): mixed;
    public function pop_last(): mixed;
    public function remove(mixed $value);
    public function values(): array;
}