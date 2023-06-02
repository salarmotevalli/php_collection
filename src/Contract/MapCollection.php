<?php

namespace Salar\Contract;

interface MapCollection
{
    // Create new
    /**
     * @return Collection
     */
    public static function new(): Collection;

    // Create with default value

    /**
     * @param array $items
     * @return Collection
     */
    public static function from(array $items): Collection;

    // Insert Node

    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function insert(mixed $key, mixed $value): void;

    // Insert Nodes

    /**
     * @param array $items
     * @return void
     */
    public function multi_insert(array $items): void;

    // Clear DataStruct

    /**
     * @return void
     */
    public function clear(): void;

    // Get first Node

    /**
     * @return mixed
     */
    public function first_value(): mixed;    // Get last Node

    // Return last value
    /**
     * @return mixed
     */
    public function last_value(): mixed;

    // Return first key (smallest)

    /**
     * @return mixed
     */
    public function first_key(): mixed;

    // Return first key (largest)

    /**
     * @return mixed
     */
    public function last_key(): mixed;

    // Is collection empty?

    /**
     * @return bool
     */
    public function is_empty(): bool;

    // Return length of collection

    /**
     * @return int
     */
    public function len(): int;

    // Remove smallest key

    /**
     * @return mixed
     */
    public function pop_first(): mixed;

    // Remove largest key

    /**
     * @return mixed
     */
    public function pop_last(): mixed;

    // Remove given key

    /**
     * @param mixed $key
     * @return mixed
     */
    public function remove(mixed $key): mixed;

    // Return list of values

    /**
     * @return array
     */
    public function values(): array;

    // Return list of keys

    /**
     * @return array
     */
    public function keys(): array;

    // Return key value pairs

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param ...$values
     * @return bool
     */
    public function in_collection(... $values): bool;

    /**
     * @param ...$keys
     * @return bool
     */
    public function is_set(... $keys): bool;
}