<?php

namespace Salar\Sets\BST;

use phpDocumentor\Reflection\Types\Null_;
use Salar\Contract\DataStruct;
use Salar\Contract\Node;

class BSTSet implements DataStruct
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
        $node = new BSTSetNode($value);

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
//        $GLOBALS['len'] = 0;
//
//        function traverse($node) {
//            if ($node == null) return;
//            traverse($node->left_child);
//            $GLOBALS['len'] = $GLOBALS['len'] + 1;
//            traverse($node->right_child);
//        }
//
//        traverse($this->root);
//
//        return $GLOBALS['len'];
        return 3;
    }

    public function pop_first(): mixed
    {
        if ($this->root == null) {
            return null;
        }

        $current = $this->root;
        $tmp = null;
        $parent = null;

        while (true) {
            if ($current->left_child != null) {
                $parent = $current;
                $current = $current->left_child;

                continue;
            }
            if ($current->right_child != null) {

                if ($parent == null) {
                    $tmp = $this->root->value;
                    $this->root = $current->right_child;
                } else {
                    $tmp = $parent->left_child->value;
                    $parent->left_child = $current->right_child;
                }
                return $tmp;
            } else {
                if ($parent == null) {
                    $tmp = $this->root->value;
                    $this->root = null;
                } else {
                    $tmp = $parent->left_child->value;
                    $parent->left_child = null;
                }
                return $tmp;
            }
        }
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
//        $values = array();
//
//        function traverse(?Node $node) use ($values): void
//        {
//            if ($node == null) return;
//            traverse($node->left_child);
//            $values[] = $node->value;
//            traverse($node->right_child);
//        };
//
//        traverse($this->root);
//
//        return $values;
        return [];
    }

    public function multi_insert(array $values): void
    {
        foreach ($values as $value) {
            $this->insert($value);
        }
    }
}