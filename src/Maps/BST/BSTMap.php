<?php

namespace Salar\Maps\BST;

use Salar\Contract\Collection;
use Salar\Contract\MapCollection;
use Salar\Contract\Node;
use Salar\Sets\BST\BSTSetNode;

class BSTMap implements MapCollection, Collection
{
    public array $values = [];
    public array $keys = [];
    public array $all = [];

    public ?Node $root = null;

    private int $len = 0;

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
        // return null if slice is empty
        if ($this->root == null) return null;

        $current = $this->root;
        while (true) {
            // return if node is the last right child
            if ($current->left_child == null) return $current->value;

            // set as current node
            $current = $current->left_child;
        }
    }

    public function is_empty(): bool
    {
        return $this->root == null;
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
        // Reset length number
        $this->len = 0;

        // Count length
        $this->traverse($this->root, function () {
            ++$this->len;
        });

        // Return length
        return $this->len;
    }

    private function traverse(?Node $node, $closure = null)
    {
        if ($node == null) return;
        $this->traverse($node->left_child, $closure);

        // Execute closure if it's set
        if ($closure != null) $closure($node);

        $this->traverse($node->right_child, $closure);
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
        // Reset
        $this->values = [];

        // collect values
        $this->traverse($this->root, function (Node $node = null) {
            $this->values[] = $node->value;
        });

        // Return values
        return $this->values;
    }

    public function keys(): array
    {
        // Reset
        $this->keys = [];

        // collect values
        $this->traverse($this->root, function (Node $node = null) {
            $this->keys[] = $node->key;
        });

        // Return values
        return $this->keys;
    }

    public function all(): array
    {
        // Reset
        $this->all = [];

        // collect values
        $this->traverse($this->root, function (Node $node = null) {
            $this->all[$node->key] = $node->value;
        });

        // Return values
        return $this->all;
    }

    public function first_key(): mixed
    {
        // return null if slice is empty
        if ($this->root == null) return null;

        $current = $this->root;
        while (true) {
            // return if node is the last right child
            if ($current->left_child == null) return $current->key;

            // set as current node
            $current = $current->left_child;
        }
    }

    public function last_key(): mixed
    {
        // return null if slice is empty
        if ($this->root == null) return null;

        $current = $this->root;
        while (true) {
            // return if node is the last right child
            if ($current->right_child == null) return $current->key;

            // set as current node
            $current = $current->right_child;
        }
    }
}