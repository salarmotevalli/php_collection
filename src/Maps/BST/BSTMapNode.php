<?php

namespace Salar\Maps\BST;

use Salar\Contract\Node;

class BSTMapNode implements \Salar\Contract\Node
{
    public function __construct(
        public mixed $value,
        public mixed $key,
        public ?Node $left_child = null,
        public ?Node $right_child = null,
    ){}
}