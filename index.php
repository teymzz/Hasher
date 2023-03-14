<?php

use Spoova\Hasher\Hasher;

include_once "vendor/autoload.php";

$hasher = new Hasher;

$hasher->setHash('123', '12345');

$hasher->hashFunc(['md5', 'md4', 'gost','base64_encode','md2']);
// $hasher->randomize(uniqid());
$hash1 = $hasher->hashify();
$hash1 = $hasher->hashify();
$hash2 = $hasher->hashify(false);

$hash = $hasher->randomHash(10, 'a');

var_dump($hash1);
var_dump($hash2);
// var_dump(base64_decode(base64_decode('VTBkb2FtUXdORDA9')));