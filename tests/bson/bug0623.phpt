--TEST--
PHPC-623: Numeric keys limited to unsigned 32-bit integer
--SKIPIF--
<?php if (8 !== PHP_INT_SIZE) { die('skip Only for 64-bit platform'); } ?>
--FILE--
<?php

require_once __DIR__ . '/../utils/basic.inc';

$tests = [
    [
        '9781449410247' => 'a',
        'X9781449410247' => 'b',
        9781449410248 => 'c',
    ],
    [
        '4294967295' => 'a',
        '4294967296' => 'b',
        '4294967297' => 'c',
    ]
];

foreach ($tests as $test) {
    printf("Test %s\n", json_encode($test));
    $bson = fromPHP($test);
    hex_dump($bson);
    echo toJSON($bson), "\n\n";
}

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
Test {"9781449410247":"a","X9781449410247":"b","9781449410248":"c"}
     0 : 45 00 00 00 02 39 37 38 31 34 34 39 34 31 30 32  [E....97814494102]
    10 : 34 37 00 02 00 00 00 61 00 02 58 39 37 38 31 34  [47.....a..X97814]
    20 : 34 39 34 31 30 32 34 37 00 02 00 00 00 62 00 02  [49410247.....b..]
    30 : 39 37 38 31 34 34 39 34 31 30 32 34 38 00 02 00  [9781449410248...]
    40 : 00 00 63 00 00                                   [..c..]
{ "9781449410247" : "a", "X9781449410247" : "b", "9781449410248" : "c" }

Test {"4294967295":"a","4294967296":"b","4294967297":"c"}
     0 : 3b 00 00 00 02 34 32 39 34 39 36 37 32 39 35 00  [;....4294967295.]
    10 : 02 00 00 00 61 00 02 34 32 39 34 39 36 37 32 39  [....a..429496729]
    20 : 36 00 02 00 00 00 62 00 02 34 32 39 34 39 36 37  [6.....b..4294967]
    30 : 32 39 37 00 02 00 00 00 63 00 00                 [297.....c..]
{ "4294967295" : "a", "4294967296" : "b", "4294967297" : "c" }

===DONE===
