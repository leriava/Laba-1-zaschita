<?php
session_start();
//смена условий пароля в таблице
if($_POST['condition'] == 'Есть'){
    $condition = '0';
}
else{
    $condition = '1';
}

//$db = file($_SESSION['db'], FILE_IGNORE_NEW_LINES);
$newpass = '';
foreach ($_SESSION['db_info'] as $key => $value){
    $user_login = explode(":", $value);
    if($_POST['login'] == $user_login[0]) {
        $newpass.= $_POST['login'] . ":" . $user_login[1] . ":" . $condition . ":" . $user_login[3];
        $db[$key] = $newpass;
        $_SESSION['db_info'][$key] = $newpass;
        //file_put_contents("db.txt", implode("\n", $db));
        break;
    }

}
header("Location: index.php");
