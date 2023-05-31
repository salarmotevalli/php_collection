<?php

namespace Salar\Maps\BST;

use Salar\Contract\Node;

class BSTMapNode implements Node
{
    public function __construct(
        public mixed $key,
        public mixed $value,
        public ?Node $left_child = null,
        public ?Node $right_child = null,
    ){}
}