<?php
session_start();
include('functions.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    });
    </script>
</head>
<body>
    <div class='navbar navbar-expand-lg navbar-default text-white' style='background-color: #9A616D;'>
        <!--    navbar-fixed-top-->
        <div class='container'>
            <div class='navbar-header col-lg-3'>
<?php
    switch($_SESSION['crypt']){
        case 0:
            echo "<h2>Придумай ключ доступа</h2>";
            break;
        case 1:
            echo "<h2>Введите ключ доступа!</h2>";
            break;
    }
?>
            </div>
            <div class='navbar-header'>
            </div>
        </div>
    </div>
    <div class='container'>
        <div class='page-header' id='banner'>
            <div class='row'>
                <div class='col-lg-12'>
<?php
if($_GET['result'] == 'passerror'){
    echo "<h2>Введен неправильный ключ</h2>";

}
    switch($_SESSION['crypt']){
        case 0:
            echo setkey();
            break;
        case 1:
            echo decrypt();
            break;
    }
?>
                </div>
            </div>
        </div>
    </div>
<?php
    //echo footer();
?>
<div class="clearfix"></div>
</div>
</body>
</html>
