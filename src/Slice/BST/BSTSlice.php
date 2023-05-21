<?php

namespace Salar\Slice\BST;

use Salar\Contract\DataStruct;
use Salar\Contract\Node;

class BSTSlice implements DataStruct
{
    public ?Node $root = null;

    private function __construct(){}

    public static function new(): static
    {
        return new static();
    }

    public static function from(array $data): static
    {
        // create new bst
        $bst = new static();

        // insert values
        foreach ($data as $value) {
            $bst->insert($value);
        }

        // return bst
        return $bst;
    }

    public function insert(mixed $value): void
    {
        // create new node
        $node = new BSTSliceNode($value);

        // set as root if node is the first inserted element
        // then return
        if (!$this->root) {
            $this->root = $node;
            return;
        }

        $current_node = $this->root;
        while (true) {
            // determine which child should process
            $child = $value < $current_node->value ? 'left_child' : 'right_child';

            // set entry value as child if child equal to null
            if ($current_node->{$child} == null) {
                $current_node->{$child} = $node;
                break;
            }

            // switch on the child
            $current_node = $current_node->{$child};
        }
    }

    public function append(array|DataStruct $data): static
    {
        return new static();
    }

    public function clear(): void
    {
        // TODO: Implement clear() method.
    }

    public function first_value(): mixed
    {
        return "salar";
    }

    public function is_empty(): bool
    {
        return true;
    }

    public function last_value(): mixed
    {
        // return null if slice is empty
        if ($this->root == null) return null;

        $current = $this->root;
        while (true) {
            // return if node is the last right child
            if ($current->right_child == null) return $current->value;

            // set as current node
            $current = $current->right_child;
        }
    }

    public function len(): int
    {
        return 3;
    }

    public function pop_first(): bool
    {
        return true;
    }

    public function pop_last(): bool
    {
        return true;
    }

    public function remove(mixed $value)
    {
        // TODO: Implement remove() method.
    }

    public function values(): array
    {
        return [];
    }
}