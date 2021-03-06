--TEST--
PHPC-1839: Referenced, out-of-scope, interned string in typeMap
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

function createTypemap()
{
    $rootValue = 'array';
    $documentValue = 'array';

    $typemap = ['root' => &$rootValue, 'document' => &$documentValue];

    return $typemap;
}

$typemap = createTypemap();
$bson    = MongoDB\BSON\fromPhp((object) []);

echo "Before:\n";
debug_zval_dump($typemap);

MongoDB\BSON\toPHP($bson, $typemap);

echo "After:\n";
debug_zval_dump($typemap);

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
Before:
array(2) refcount(2){
  ["root"]=>
  string(5) "array" refcount(1)
  ["document"]=>
  string(5) "array" refcount(1)
}
After:
array(2) refcount(2){
  ["root"]=>
  string(5) "array" refcount(1)
  ["document"]=>
  string(5) "array" refcount(1)
}
===DONE===
