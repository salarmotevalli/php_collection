<?php

namespace Salar\Bst;

use Salar\Bst\Contract\BTree;
use Salar\Bst\Contract\Node;

class AVL implements BTree
{
    private ?Node $left_child;
    private ?Node $right_child;


    // Create new AVL
    public static function new(): self
    {
        return new self();
    }

    // Create AVL with default value
    public static function from(): self
    {
        return new self();
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function insert(): BTree
    {
//        return ;
    }

    public function search(): null|Node
    {
        // TODO: Implement search() method.
    }
}