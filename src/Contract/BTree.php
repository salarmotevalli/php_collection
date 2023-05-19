<?php

namespace Salar\Bst\Contract;

interface BTree
{
    // Create new
    public static function new(): self;

    // Create with default value
    public static function from(): self;
}