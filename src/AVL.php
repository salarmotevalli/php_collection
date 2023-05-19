<?php

namespace Salar\Bst;

use Salar\Bst\Contract\BTree;

class AVL implements BTree
{
    private $left_child;
    private $right_child;


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
}