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

    // Insert Nodes
    public function multi_insert(array $items): void;

    // Clear DataStruct
    public function clear(): void;

    // Get first Node
    public function first_value(): mixed;    // Get last Node

    // Return last value
    public function last_value(): mixed;

    // Return first key (smallest)
    public function first_key(): mixed;

    // Return first key (largest)
    public function last_key(): mixed;

    // Is collection empty?
    public function is_empty(): bool;

    // Return length of collection
    public function len(): int;

    // Remove smallest key
    public function pop_first(): mixed;

    // Remove largest key
    public function pop_last(): mixed;

    // Remove given key
    public function remove(mixed $key);

    // Return list of values
    public function values(): array;

    // Return list of keys
    public function keys(): array;

    // Return key value pairs
    public function all(): array;
}