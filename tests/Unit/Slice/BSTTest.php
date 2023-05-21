<?php

use Salar\Contract\Node;
use Salar\Slice\BST\BSTSlice;

$numbers = [
    10,
    20,
    5,
    8,
    14,
    30,
];

test('new_static_function', function () {
    $bst = BSTSlice::new();

    // new function has to make and return new instance of collection
    expect($bst)->toBeInstanceOf(BSTSlice::class);
});

test('from_static_function', function () use ($numbers) {
    $bst = BSTSlice::from($numbers);

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

test('last_value_function', function () use ($numbers) {
   $bst = BSTSlice::from($numbers);

    // largest number is 30 so last value should be 30
   expect($bst->last_value())->toBe(30);
});

test('first_value_function', function () use ($numbers) {
   $bst = BSTSlice::from($numbers);

   expect($bst->first_value())->toBe(5);
});

test('is_empty_function', function () use ($numbers) {
    $bst = BSTSlice::new();
    expect($bst->is_empty())->toBeTrue();

    $bst->insert(6);
    $bst->insert(10);

    expect($bst->is_empty())->toBeFalse();
});