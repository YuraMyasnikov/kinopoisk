<?php
$foo = [
    'bar' => 'baz'
];
$ret = [
    'cat' => 'cut',
    'bar' => 'baz1111'
];
$tt = array_merge($foo, $ret);
var_dump($tt);