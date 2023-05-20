<?php

namespace Salar\Map\BST;

use Salar\Contract\Node;

class BSTMapNode implements Node
{
    public function __construct(
        public mixed $root_key,
        public ?Node $left = null,
        public ?Node $right = null,
    ){}
}