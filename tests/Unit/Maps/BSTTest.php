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

test('new_static_function', function () {
    $bst = BSTMap::new();

    // new function has to make and return new instance of collection
    expect($bst)->toBeInstanceOf(BSTMap::class);
});

test('insert_function', function () {
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

test('is_empty_function', function () {
    $bst = BSTMap::new();
    expect($bst->is_empty())->toBeTrue();

    $bst->insert(4, 10);
    $bst->insert(10, 38);

    expect($bst->is_empty())->toBeFalse();
});

test('from_static_function', function () use ($items) {
    $bst = BSTMap::from($items);

    // from function has to make and return new instance of collection with passed data
    expect($bst)->toBeInstanceOf(BSTMap::class);
    expect($bst->root->value)->toBe('Talebi');
    //    expect($bst->len())->toBe(count($numbers));

});

test('multi_insert_function', function () use ($items) {
    $bst = BSTMap::new();

    $bst->multi_insert($items);

    // root is equal to first inserted node
    expect($bst->root)->toBeInstanceOf(Node::class);
    expect($bst->root->value)->toBe('Talebi');
//    expect($bst->len())->toBe(count($numbers));
});

test('clear_function', function () use ($items) {
    $bst = BSTSet::from($items);
    expect($bst->is_empty())->toBeFalse();

    $bst->clear();
    expect($bst->is_empty())->toBeTrue();
});

test('len_function', function () use ($items) {
    $bst = BSTMap::from($items);
    expect($bst->len())->toBe(count($items));

    $bst->insert(6, 43);
    $bst->insert(130, 45);

    expect($bst->len())->toBe(count($items) + 2);
});

test('first_and_last_key_value_function', function () use ($items) {
    $bst = BSTMap::from($items);

    expect($bst->first_value())->toBe('Heydary');
    expect($bst->first_key())->toBe('Goli');

    expect($bst->last_value())->toBe('Saadatfar');
    expect($bst->last_key())->toBe('Sina');
});

test('values_function', function () use ($items) {
    $bst = BSTMap::from($items);
    expect($bst->values())->toBe([
        'Heydary',
        'Matani',
        'Talebi',
        'Motevalli',
        'Bahadory',
        'Saadatfar',
    ]);

});

test('keys_function', function () use ($items) {
    $bst = BSTMap::from($items);
    expect($bst->keys())->toBe([
        'Goli',
        'Mahan',
        'Nariman',
        'Salar',
        'Shayan',
        'Sina',
    ]);

});

test('all_function', function () use ($items) {
    $bst = BSTMap::from($items);
    expect($bst->all())->toBe([
        'Goli' => 'Heydary',
        'Mahan' => 'Matani',
        'Nariman' => 'Talebi',
        'Salar' => 'Motevalli',
        'Shayan' => 'Bahadory',
        'Sina' => 'Saadatfar',
    ]);

});
