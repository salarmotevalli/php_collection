<?php

use Salar\Contract\Node;
use Salar\Slice\BST\BSTSlice;

test('new_static_function', function () {
    $bst = BSTSlice::new();

    // new function has to make and return new instance of collection
    expect($bst)->toBeInstanceOf(BSTSlice::class);
});

test('from_static_function', function () {
    $bst = BSTSlice::from([
        10,
        20,
        5,
        8,
        14,
        30,
    ]);

    // from function has to make and return new instance of collection with passed data
    expect($bst)->toBeInstanceOf(BSTSlice::class);
    expect($bst->root->value)->toBe(10);
});

test('insert_function', function () {
    $bst = BSTSlice::new();

    // root is null after creating new collection
    expect($bst->root)->toBeNull();

    $bst->insert(10);

    // root is equal to first inserted node
    expect($bst->root)->toBeInstanceOf(Node::class);
    expect($bst->root->value)->toBe(10);

    // after inserting second value, the root node shouldn't be changed
    $bst->insert(5);
    $bst->insert(15);
    expect($bst->root->value)->toBe(10);
    expect($bst->root->left_child->value)->toBe(5);
    expect($bst->root->right_child->value)->toBe(15);

});

