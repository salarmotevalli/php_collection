<?php

namespace Salar\Sets\BST;

use mysql_xdevapi\CollectionRemove;
use Salar\Contract\Collection;
use Salar\Contract\Node;

class BSTSet implements Collection
{
    public ?Node $root = null;

    private int $len = 0;
    private array $values = [];

    private function __construct()
    {
    }

    public static function new(): static
    {
        return new static();
    }

    public static function from(array $data): static
    {
        // create new bst
        $bst = new static();

        // insert values
        $bst->multi_insert($data);

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

    public function multi_insert(array $values): void
    {
        foreach ($values as $value) {
            $this->insert($value);
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

    private function traverse(?Node $node, $closure = null) {
        if ($node == null) return;
        $this->traverse($node->left_child, $closure);

        // Execute closure if it's set
        if ($closure != null) $closure($node);

        $this->traverse($node->right_child, $closure);
    }

    public function pop_first(): mixed
    {
        if ($this->is_empty()) {
            return null;
        }

        $current = $this->root;
        $parent = null;

        while (true) {
            // Skip if node has left child
            if ($current->left_child != null) {

                // Set as parent and current
                $parent = $current;
                $current = $current->left_child;

                continue;
            }

            // Check the node has right child
            if ($current->right_child != null) {

                // Check the node has parent or node is root node
                if ($parent == null) {
                    $tmp = $this->root->value;
                    $this->root = $current->right_child;
                } else {
                    $tmp = $parent->left_child->value;
                    $parent->left_child = $current->right_child;
                }
            } else {
                if ($parent == null) {
                    $tmp = $this->root->value;
                    $this->root = null;
                } else {
                    $tmp = $parent->left_child->value;
                    $parent->left_child = null;
                }
            }

            return $tmp;
        }
    }

    public function pop_last(): mixed
    {
        if ($this->is_empty()) {
            return null;
        }

        $current = $this->root;
        $parent = null;

        while (true) {
            // Skip if node has left child
            if ($current->right_child != null) {

                // Set as parent and current
                $parent = $current;
                $current = $current->right_child;

                continue;
            }

            // Check the node has right child
            if ($current->left_child != null) {

                // Check the node has parent or node is root node
                if ($parent == null) {
                    $tmp = $this->root->value;
                    $this->root = $current->left_child;
                } else {
                    $tmp = $parent->right_child->value;
                    $parent->right_child = $current->left_child;
                }
            } else {
                if ($parent == null) {
                    $tmp = $this->root->value;
                    $this->root = null;
                } else {
                    $tmp = $parent->right_child->value;
                    $parent->right_child = null;
                }
            }

            return $tmp;
        }
    }

    public function remove(mixed $value): mixed
    {
        return $this->_remove($this->root, null, $value);
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

    private function _remove(?Node $node, ?Node $parent, mixed $value)
    {
        if ($node == null) return null;
        if ($node->value > $value) $this->_remove($node->left_child, $node, $value);
        if ($node->value < $value) $this->_remove($node->right_child, $node, $value);

        // node has no children
        if ($node->left_child == null && $node->right_child == null) {
            if ($parent == null) {
                $this->root =null;
            } else {
                if ($node->value > $parent->value) {
                    // node is right child for it's parent
                    $parent->right_child = null;
                } else {
                    // node is right child for it's parent
                    $parent->left_child = null;
                }
            }
            return;
        }

        // node has right child
        if ($node->left_child == null) {
            if ($parent == null) {
                $this->root = $this->root->right_child;
            } else {
                if ($node->value > $parent->value) {
                    // node is right child for it's parent
                    $parent->right_child = $node->right_child;
                } else {
                    // node is right child for it's parent
                    $parent->left_child = $node->right_child;
                }
            }
            return;
        }

        // node has left child
        if ($node->right_child == null) {
            if ($parent == null) {
                $this->root = $this->root->right_child;
            } else {
                if ($node->value > $parent->value) {
                    // node is right child for it's parent
                    $parent->right_child = $node->left_child;
                } else {
                    // node is right child for it's parent
                    $parent->left_child = $node->left_child;
                }
            }
            return;
        }

        // node has two children
        $tmp_target_node = $node;
        $tmp_smallest_right_node_parent = $node;

        $current = $node->right_child;
        while (true) {
            if ($current->left_node != null) {
                $tmp_smallest_right_node_parent = $current;
                $current = $current->left_node;
            } else {
                if ($current->right_child == null) {
                    if ($parent == null) {
                        $this->root->value = $current->value;
                    } else {
                        if ($node->value > $parent->value) {
                            // node is right child for it's parent
                            $parent->right_child->value = $current->value;
                        } else {
                            // node is left child for it's parent
                            $parent->left_child->value = $current->value;
                        }
                        $tmp_smallest_right_node_parent->left_child == null;
                    }
                }
                return;
            }
        }
    }


}