# PHP Collection
_____
This package provide some data structure algorithm.


- BST (Binary search tree)



### BST (Binary search tree)
##### Set
``` php
$bst = BSTSet::new();
$bst->insert(10);
$bst->insert(23);
$bst->insert(2);

$bst->values(); // returns: [2, 10, 23]
```
##### Map
``` php
$bst = BSTMap::new();
$bst->insert('Salar', 20);
$bst->insert('Goli', 20);


$bst->all(); // returns: ['Goli' => 20, 'Salar' => 20]
```
_________

