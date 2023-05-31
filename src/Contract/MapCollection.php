<?php

namespace Salar\Contract;

interface MapCollection
{
    // Create new
    public static function new(): Collection;

    // Create with default value
    public static function from(array $items): Collection;

    // Insert Node
    public function insert(mixed $key, mixed $value): void;

    public function multi_insert(array $items): void;

    // Clear DataStruct
    public function clear(): void;

    // Get first Node
    public function first_value(): mixed;    // Get last Node
    public function last_value(): mixed;
    public function first_key(): mixed;
    public function last_key(): mixed;

    // Is Btree empty?
    public function is_empty(): bool;



    // return length of DataStruct
    public function len(): int;

    public function pop_first(): mixed;
    public function pop_last(): mixed;
    public function remove(mixed $value);
    public function values(): array;
    public function keys(): array;
    public function all(): array;
}