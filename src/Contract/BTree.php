<?php

namespace Salar\Bst\Contract;

interface BTree
{
    // Create new
    public static function new(): self;

    // Create with default value
    public static function from(): self;

    // Insert Node
    public function insert(): self;

    // Append other BTree with self
    public function append(array|self $map): self;

    // Clear BTree
    public function clear(): self;

    // Get first Node
    public function first_key_value(): Node;

    // Get Node by key
    public function get(): Node;

    // Get key and value
    public function get_key_value(): Node;

    // Is Btree empty?
    public function is_empty(): bool;;

    // Get list of keys
    public function keys(): array;

    // Get last Node
    public function last_key_value(): Node;

    // return length of BTree
    public function len(): int;

    public function pop_first(): bool;
    public function pop_last(): bool;
    public function remove();
    public function values(): array;
}