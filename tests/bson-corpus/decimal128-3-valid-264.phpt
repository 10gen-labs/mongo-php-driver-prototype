--TEST--
Decimal128: [basx049] strings without E cannot generate E in result
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/basic.inc';

$canonicalBson = hex2bin('180000001364002C00000000000000000000000000403000');
$canonicalExtJson = '{"d" : {"$numberDecimal" : "44"}}';
$degenerateExtJson = '{"d" : {"$numberDecimal" : "0044"}}';

// Canonical BSON -> Native -> Canonical BSON
echo bin2hex(fromPHP(toPHP($canonicalBson))), "\n";

// Canonical BSON -> Canonical extJSON
echo json_canonicalize(toCanonicalExtendedJSON($canonicalBson)), "\n";

// Canonical extJSON -> Canonical BSON
echo bin2hex(fromJSON($canonicalExtJson)), "\n";

// Degenerate extJSON -> Canonical BSON
echo bin2hex(fromJSON($degenerateExtJson)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
180000001364002c00000000000000000000000000403000
{"d":{"$numberDecimal":"44"}}
180000001364002c00000000000000000000000000403000
180000001364002c00000000000000000000000000403000
===DONE===