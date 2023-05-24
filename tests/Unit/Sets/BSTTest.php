<?php

use Salar\Contract\Node;
use Salar\Slice\BST\BSTSet;

$numbers = [
    10,
    20,
    5,
    8,
    14,
    30,
];

test('new_static_function', function () {
    $bst = BSTSet::new();

    // new function has to make and return new instance of collection
    expect($bst)->toBeInstanceOf(BSTSet::class);
});

test('from_static_function', function () use ($numbers) {
    $bst = BSTSet::from($numbers);

    // from function has to make and return new instance of collection with passed data
    expect($bst)->toBeInstanceOf(BSTSet::class);
    expect($bst->root->value)->toBe(10);
});

test('insert_function', function () {
    $bst = BSTSet::new();

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
   $bst = BSTSet::from($numbers);

    // largest number is 30 so last value should be 30
   expect($bst->last_value())->toBe(30);
});

test('first_value_function', function () use ($numbers) {
   $bst = BSTSet::from($numbers);

   expect($bst->first_value())->toBe(5);
});

test('is_empty_function', function () {
    $bst = BSTSet::new();
    expect($bst->is_empty())->toBeTrue();

    $bst->insert(6);
    $bst->insert(10);

    expect($bst->is_empty())->toBeFalse();
});

test('clear_function', function () use ($numbers) {
    $bst = BSTSet::from($numbers);
    expect($bst->is_empty())->toBeFalse();

    $bst->clear();
    expect($bst->is_empty())->toBeTrue();
});

//test('values_function', function () use ($numbers) {
//    $bst = BSTSet::from($numbers);
//    expect($bst->values())->toBe($numbers);
//
//});

test('len_function', function () use ($numbers) {
    $bst = BSTSet::from($numbers);
    expect($bst->len())->toBe(count($numbers));

    $bst->insert(6);
    $bst->insert(130);

    expect($bst->len())->toBe(count($numbers) + 2);
});


//test('pop_first_function', function () use ($numbers) {
//    $bst = BSTSet::new();
//
//    // pop method return null if tree is empty
//    expect($bst->pop_first())->toBeNull();
//
//
//    expect($bst->first_value())->toBe(8);
//
//    $bst->pop_first();
//    $bst->pop_first();
//    expect($bst->first_value())->toBe(14);
//    expect($bst->root->value)->toBe(14);
//});