<?php

namespace Salar\Maps\BST;

use Salar\Contract\Collection;
use Salar\Contract\MapCollection;
use Salar\Contract\Node;
use Salar\Sets\BST\BSTSetNode;

class BSTMap implements MapCollection, Collection
{
    public ?Node $root = null;

    private function __construct()
    {
    }

    public static function new(): Collection
    {
        return new static();
    }

    public static function from(array $items): Collection
    {
        // create new bst
        $bst = new static();

        // insert values
        $bst->multi_insert($items);

        // return bst
        return $bst;
    }

    public function insert(mixed $key, mixed $value): void
    {
        // create new node
        $node = new BSTMapNode($key, $value);

        // set as root if node is the first inserted element
        // then return
        if (!$this->root) {
            $this->root = $node;
            return;
        }

        $current_node = $this->root;
        while (true) {
            // determine which child should process
            $child = $key < $current_node->key ? 'left_child' : 'right_child';

            // set entry value as child if child equal to null
            if ($current_node->{$child} == null) {
                $current_node->{$child} = $node;
                break;
            }

            // switch on the child
            $current_node = $current_node->{$child};
        }
    }

    public function multi_insert(array $items): void
    {
        foreach ($items as $key => $value) {
            $this->insert($key, $value);
        }
    }

    public function clear(): void
    {
        unset($this->root->left_child, $this->root->right_child);
        $this->root = null;
    }

    public function first_value(): mixed
    {
        // TODO: Implement first_value() method.
    }

    public function is_empty(): bool
    {
        return $this->root == null;
    }

    public function last_value(): mixed
    {
        // TODO: Implement last_value() method.
    }

    public function len(): int
    {
        // TODO: Implement len() method.
    }

    public function pop_first(): mixed
    {
        // TODO: Implement pop_first() method.
    }

    public function pop_last(): mixed
    {
        // TODO: Implement pop_last() method.
    }

    public function remove(mixed $value)
    {
        // TODO: Implement remove() method.
    }

    public function values(): array
    {
        // TODO: Implement values() method.
    }
}