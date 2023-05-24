<?php

namespace Salar\Slice\BST;

use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Salar\Contract\DataStruct;
use Salar\Contract\Node;

class BSTSetNode implements Node
{
    public function __construct(
        public mixed $value,
        public ?Node $left_child = null,
        public ?Node $right_child = null,
    ){}
}