<?php

namespace Salar\Map\BST;

use Salar\Contract\Node;

class BSTNode implements Node
{
    public function __construct(
        public mixed $root_key,
        public ?Node $left_key = null,
        public ?Node $right_key = null,
    ){}
}