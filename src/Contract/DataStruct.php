<?php

namespace Salar\Contract;

interface DataStruct
{
    // Create new
    public static function new(): self;

    // Create with default value
    public static function from(array $data): self;

    // Insert Node
    public function insert(mixed $value): void;

    // Append other DataStruct with self
    public function append(array|self $data): self;

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

    public function pop_first(): bool;
    public function pop_last(): bool;
    public function remove(mixed $value);
    public function values(): array;
}