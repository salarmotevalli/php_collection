<?php

use Salar\Contract\Node;
use Salar\Sets\BST\BSTSet;

$numbers = [
    10,
    20,
    5,
    8,
    14,
    30,
];

test('new_static_function',             function () {
    $bst = BSTSet::new();

    // new function has to make and return new instance of collection
    expect($bst)->toBeInstanceOf(BSTSet::class);
});

test('from_static_function',            function () use ($numbers) {
    $bst = BSTSet::from($numbers);

    // from function has to make and return new instance of collection with passed data
    expect($bst)->toBeInstanceOf(BSTSet::class);
    expect($bst->root->value)->toBe(10);
});

test('insert_function',                 function () {
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

test('multi_insert_function',           function () use ($numbers) {
    $bst = BSTSet::new();

    $bst->multi_insert($numbers);

    // root is equal to first inserted node
    expect($bst->root)->toBeInstanceOf(Node::class);
    expect($bst->root->value)->toBe(10);
    expect($bst->len())->toBe(count($numbers));
});

test('first_and_last_value_function',   function () use ($numbers) {
    $bst = BSTSet::from($numbers);

    // largest number is 30 so last value should be 30
    expect($bst->last_value())->toBe(30);
    expect($bst->first_value())->toBe(5);
});

test('is_empty_function',               function () {
    $bst = BSTSet::new();
    expect($bst->is_empty())->toBeTrue();

    $bst->insert(6);
    $bst->insert(10);

    expect($bst->is_empty())->toBeFalse();
});

test('clear_function',                  function () use ($numbers) {
    $bst = BSTSet::from($numbers);
    expect($bst->is_empty())->toBeFalse();

    $bst->clear();
    expect($bst->is_empty())->toBeTrue();
});

test('values_function',                 function () use ($numbers) {
    $bst = BSTSet::from($numbers);
    expect($bst->values())->toBe([
        5,
        8,
        10,
        14,
        20,
        30,
    ]);

});

test('len_function',                    function () use ($numbers) {
    $bst = BSTSet::from($numbers);
    expect($bst->len())->toBe(count($numbers));

    $bst->insert(6);
    $bst->insert(130);

    expect($bst->len())->toBe(count($numbers) + 2);
});

test('pop_first_function',              function () use ($numbers) {
    $bst = BSTSet::from($numbers);

    expect($bst->first_value())->toBe(5);

    // pop function returns deleted value
    expect($bst->pop_first())->toBe(5);

    // after deleting first value, now the smallest value is 8
    expect($bst->first_value())->toBe(8);

    // these pops going to pop the root node,
    // so we test it again to make sure it works fine
    $bst->pop_first();
    $bst->pop_first();
    $bst->pop_first();
    expect($bst->first_value())->toBe(20);

    $bst->pop_first();
    $bst->pop_first();

    // pop function returns null if tree is empty
    expect($bst->pop_first())->toBeNull();
});

test('pop_last_function',               function () use ($numbers) {

    $bst = BSTSet::from($numbers);

    expect($bst->last_value())->toBe(30);

    // pop function returns deleted value
    expect($bst->pop_last())->toBe(30);

    // after deleting first value, now the smallest value is 8
    expect($bst->last_value())->toBe(20);

    // these pops going to pop the root node,
    // so we test it again to make sure it works fine
    $bst->pop_last();
    $bst->pop_last();
    $bst->pop_last();
    expect($bst->last_value())->toBe(8);

    $bst->pop_last();
    $bst->pop_last();

    // pop function returns null if tree is empty
    expect($bst->pop_last())->toBeNull();
});

test('remove_function',                 function () use ($numbers) {
    $bst = BSTSet::from($numbers);

    // Remove returns the deleted element
    expect($bst->remove(30))->toBe(30);

    // any errors shouldn't occur when removing root node
    $bst->remove(10);
    expect($bst->values())->not->toContain(10, 30);

    // remove returns null if given element doesn't exist
    expect($bst->remove(1234))->toBeNull();

    $bst2 = BSTSet::from([
        100, 200, 300, 400, 500,
        150, 250, 175, 127,
        50, 25, 10, 1,
        75, 35, 15, 5
    ]);

    $bst2->remove(250);
    $bst2->remove(200);

    expect(in_array(200, $bst2->values()))->toBeFalse();
});