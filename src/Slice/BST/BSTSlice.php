<?php

namespace Salar\Slice\BST;

use Salar\Contract\DataStruct;
use Salar\Contract\Node;

class BSTSlice implements DataStruct
{
    public ?Node $root = null;

    private function __construct()
    {
    }

    public static function new(): static
    {
        return new static();
    }

    public static function from(array $data): static
    {
        return new static();
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

    public function first_key_value(): mixed
    {
        return "salar";
    }

    public function is_empty(): bool
    {
        return true;
    }

    public function last_value(): mixed
    {
        return 3;
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