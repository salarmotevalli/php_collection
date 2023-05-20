<?php

namespace Salar\Contract;

interface DataStruct
{
    // Create new
    public static function new(): self;

    // Create with default value
    public static function from(): self;

    // Insert Node
    public function insert(): void;

    // Append other DataStruct with self
    public function append(array|self $map): self;

    // Clear DataStruct
    public function clear(): void;

    // Get first Node
    public function first_key_value(): array;

    // Get Node by key
    public function get(): Node;

    // Get key and value
    public function get_key_value(string $key): array;

    // Is Btree empty?
    public function is_empty(): bool;

    // Get list of keys
    public function keys(): array;

    // Get last Node
    public function last_key_value(): array;

    // return length of DataStruct
    public function len(): int;

    public function pop_first(): bool;
    public function pop_last(): bool;
    public function remove();
    public function values(): array;
}