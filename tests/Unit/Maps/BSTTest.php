<?php

use Salar\Contract\Node;
use Salar\Maps\BST\BSTMap;
use Salar\Sets\BST\BSTSet;

$items = [
    'Nariman' => 'Talebi',
    'Salar' => 'Motevalli',
    'Goli' => 'Heydary',
    'Shayan' => 'Bahadory',
    'Mahan' => 'Matani',
    'Sina' => 'Saadatfar',
];

test('new_static_function',     function () {
    $bst = BSTMap::new();

    // new function has to make and return new instance of collection
    expect($bst)->toBeInstanceOf(BSTMap::class);
});

test('insert_function',         function () {
    $bst = BSTMap::new();

    // root is null after creating new collection
    expect($bst->root)->toBeNull();

    $bst->insert('Nariman', 'Talebi');

    // root is equal to first inserted node
    expect($bst->root)->toBeInstanceOf(Node::class);
    expect($bst->root->value)->toBe('Talebi');
    expect($bst->root->key)->toBe('Nariman');

    // after inserting second value, the root node shouldn't be changed
    $bst->insert('Salar', 'Motevalli');
    $bst->insert('Goli', 'Heydari');

    expect($bst->root->left_child->value)->toBe('Heydari');
    expect($bst->root->right_child->value)->toBe('Motevalli');
});

test('is_empty_function',       function () {
    $bst = BSTMap::new();
    expect($bst->is_empty())->toBeTrue();

    $bst->insert(4, 10);
    $bst->insert(10, 38);

    expect($bst->is_empty())->toBeFalse();
});

test('from_static_function',    function () use ($items) {
    $bst = BSTMap::from($items);

    // from function has to make and return new instance of collection with passed data
    expect($bst)->toBeInstanceOf(BSTMap::class);
    expect($bst->root->value)->toBe('Talebi');
    //    expect($bst->len())->toBe(count($numbers));

});

test('multi_insert_function',   function () use ($items) {
    $bst = BSTMap::new();

    $bst->multi_insert($items);

    // root is equal to first inserted node
    expect($bst->root)->toBeInstanceOf(Node::class);
    expect($bst->root->value)->toBe('Talebi');
//    expect($bst->len())->toBe(count($numbers));
});

test('clear_function',          function () use ($items) {
    $bst = BSTSet::from($items);
    expect($bst->is_empty())->toBeFalse();

    $bst->clear();
    expect($bst->is_empty())->toBeTrue();
});

