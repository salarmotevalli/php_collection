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
        if ($this->is_empty()) return null;

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
        if ($this->is_empty()) return null;

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

    public function remove(mixed $key): mixed

    {
        return $this->_remove($key);
    }

    private function _remove(mixed $key)
    {
        $parent = null;
        $current = $this->root;

        while (true) {

            if ($current == null) return null;

            if ($current->key != $key) {
                $parent = $current;
                $current = match (true) {
                    $current->key > $key => $current->left_child,
                    $current->key < $key => $current->right_child,
                };
                continue;
            }

            // It's going to return as deleted value
            $tmp = $current->value;

            // node doesn't have two children
            if (!($current->left_child && $current->right_child)) {
                $data = match (true) {
                    // Has no children
                    !$current->left_child && !$current->right_child => ['root' => null, 'children' => null],
                    // Has right children
                    !$current->left_child => ['root' => $current->right_child, 'children' => $current->right_child],
                    // Has left children
                    !$current->right_child => ['root' => $current->right_child, 'children' => $current->left_child],
                };

                $this->set_node($parent, $data, $current);
                return $tmp;
            }

            // node has two children
            $current_tmp = $current->right_child;
            $current_tmp_parent = null;

            while (true) {
                if ($current_tmp->left_child != null) {
                    $current_tmp = $current_tmp->left_child;
                    continue;
                } elseif ($current_tmp->right_child == null) {

                    $data = [
                        'root' => null,
                        'children' => null,
                    ];

                    // Replace the smallest value after target with target
                    $current->value = $current_tmp->value;

                    $this->set_node($current_tmp_parent, $data, $current_tmp);

                } else {
                    $data = [
                        'root' => $current_tmp->right_child,
                        'children' => $current_tmp->right_child,
                    ];

                    // Replace the smallest value after target with target
                    $current->value = $current_tmp->value;

                    $this->set_node($current_tmp_parent, $data, $current_tmp);
                }
                return $tmp;
            }
        }
    }

    public function set_node(?Node $parent, array $data, Node $current): void
    {
        if ($parent == null) {
            $this->root = $data['root'];
        } else {
            if ($current->value > $parent->value) {
                // node is right child for it's parent
                $parent->right_child = $data['children'];
            } else {
                // node is right child for it's parent
                $parent->left_child = $data['children'];
            }
        }
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

    public function in_collection(...$values): bool
    {
        foreach ($values as $value) {
            if (!$this->is_there_value($value)) return false;
        }

        // All entries exist
        return true;
    }

    private function is_there_value($value): bool
    {
        $current = $this->root;
        while ($current !== null) {

            // Collection has value
            if ($current->value === $value) {
                return true;
            }

            // Check and set nodes
            $current = match (true) {
                $current->value > $value => $current->left_child,
                $current->value < $value => $current->right_child,
            };
        }

        return false;
    }

    public function is_set(...$keys): bool
    {
        foreach ($keys as $key) {
            if (!$this->is_there_key($key)) return false;
        }

        // All entries exist
        return true;
    }

    private function is_there_key($key): bool
    {
        $current = $this->root;
        while ($current !== null) {

            // Collection has value
            if ($current->key === $key) {
                return true;
            }

            // Check and set nodes
            $current = match (true) {
                $current->key > $key => $current->left_child,
                $current->key < $key => $current->right_child,
            };
        }

        return false;
    }
}