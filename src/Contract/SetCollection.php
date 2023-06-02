<?php

namespace Salar\Contract;

interface SetCollection
{
    // Create new
    /**
     * @return Collection
     */
    public static function new(): Collection;

    // Create with default value

    /**
     * @param array $values
     * @return Collection
     */
    public static function from(array $values): Collection;

    // Insert Node

    /**
     * @param mixed $value
     * @return void
     */
    public function insert(mixed $value): void;

    /**
     * @param array $values
     * @return void
     */
    public function multi_insert(array $values): void;

    // Clear DataStruct

    /**
     * @return void
     */
    public function clear(): void;

    // Get first Node

    /**
     * @return mixed
     */
    public function first_value(): mixed;

    // Is Btree empty?

    /**
     * @return bool
     */
    public function is_empty(): bool;

        // Get last Node

    /**
     * @return mixed
     */
    public function last_value(): mixed;

    // return length of DataStruct

    /**
     * @return int
     */
    public function len(): int;

    /**
     * @return mixed
     */
    public function pop_first(): mixed;

    /**
     * @return mixed
     */
    public function pop_last(): mixed;

    /**
     * @param mixed $value
     * @return mixed
     */
    public function remove(mixed $value);

    /**
     * @return array
     */
    public function values(): array;

    /**
     * @param ...$values
     * @return bool
     */
    public function in_collection(... $values): bool;
}