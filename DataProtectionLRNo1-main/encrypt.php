<?php
session_start();
$db = '';
$db = implode($_SESSION['db_info'], PHP_EOL);
$contetsEncrypted = openssl_encrypt($db, "AES-128-CBC-HMAC-SHA1", $_SESSION['key']);
file_put_contents($_SESSION['db'], $contetsEncrypted);
header("Location: index.php");