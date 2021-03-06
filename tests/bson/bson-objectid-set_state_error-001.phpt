--TEST--
MongoDB\BSON\ObjectId::__set_state() requires "oid" string field
--FILE--
<?php

require_once __DIR__ . '/../utils/basic.inc';

echo throws(function() {
    MongoDB\BSON\ObjectId::__set_state(['oid' => 0]);
}, 'MongoDB\Driver\Exception\InvalidArgumentException'), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
MongoDB\BSON\ObjectId initialization requires "oid" string field
===DONE===
