<?php

    function start(){
        $return='';
        $return.="<div class='navbar navbar-expand-lg navbar-default text-white' style='background-color: #9A616D;>
    <!--    navbar-fixed-top-->
    <div class='container'>
        
        <div class='navbar-header col-lg-3' style='text-align: center'>
        <button type='button' class='btn btn-secondary' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Автор: Прибылова Валерия Задание: Наличие букв, цифр и знаков арифметических операций'>
  О программе хд
</button>";
        if($_SESSION['sign']==0) {
            $return .= "<h2>Войдите в свой аккаунт</h2>";
        }
        else{
            $return .= "<h2>$_SESSION[login]</h2>";
        }
        $return.="</div>
        <div class='navbar-header'>";
        if($_SESSION['sign']==0) {
            $return .= "<form action='sign.php'>
                <button type='submit' class='btn btn-dark btn-lg'>Войти</button>
            </form>";
        }
        else{
            $return .= "
            <table>
            <td>
            <form action='sign.php'>
                    <button type='submit' class='btn btn-dark btn-lg'>Сменить пароль</button>
                    </form></td>
            <td><form action='signout.php'>
                <button type='submit' class='btn btn-dark btn-lg'>Выйти</button>
            </form></td>
            </table>";
        }
        $return .= "</div>
                </div>
            </div>
            <div class='container'>
                <div class='page-header' id='banner'>
                    <div class='row'>
                        <div class='col-lg-12'>";
        switch ($_SESSION['sign']) {
            case 0:
                $return .= "<h1></h1>";
                break;
            case 1:
                switch ($_SESSION['login'] == 'admin'){
                    case 0:
                        $return .= user_prof();
                        break;
                    case 1:
                        $return .= admin_prof();
                        break;
                }


            break;

        }
        $return .= "</div>
                    </div>
        </div>";
        return $return;
    }

    function sign(){
        $return='';
        $return.="<div class='navbar navbar-expand-lg navbar-default text-white' style='background-color: #9A616D;'>
    <!--    navbar-fixed-top-->
    <div class='container'>";
       //if($_SESSION['chpass'] == 0){
       //    $return.="<a href='index.php' class='text-white' style='text-decoration: none;'><h1>Защита информации ЛР№1</h1></a>";
       //}
       //else{
       //    $return.="<a href='index.php' class='text-white' style='text-decoration: none;'><h1>Защита информации ЛР№1</h1></a>";
       //}

        $return.="
        <div class='navbar-header col-lg-3'>";
        switch ($_SESSION['sign']){
            case 0:
                if($_SESSION['chpass'] == 1){
                    if($_SESSION['pass'] == ''){
                        $return.="<h2>Придумай пароль</h2>";
                    }else{
                        $return.="<h2>Сменить пароль</h2>";
                    }
                }else{
                    $return.="<h2>Вход в аккаунт</h2>";
                }

                break;
            case 1:
                $return.="<h2>Сменить пароль</h2>";
                break;
        }
        $return.="</div>
                    <button type='submit' class='btn btn-dark btn-lg' disabled>Войти</button>
                </div>
            </div>
            <div class='container'>
                <div class='page-header' id='banner'>
                    <div class='row'>
                        <div class='col-lg-12'>";
        switch ($_SESSION['sign']){
            case 0:
                if($_SESSION['chpass'] != 1){
                    $return.="<h2 style='position: absolute !important; top: 30%; left: 30%;'>Введите свой логин и пароль</h2>";
                }
                break;
            case 1:
                $return.="<h2>Сменить пароль</h2>";
                break;
        }
        $return.="</div>
                    </div>
                </div>
            <div class='container' ><h1 style='position: absolute !important; top: 40%; left: 30%;'>";
        $return.= $_SESSION['message1'];
        $return.="</h1>";
        switch ($_SESSION['sign']== 0){
            //проверка входа
            case 0:
                //вход выполнен
                $return.= change_pass();
                break;
            case 1:
                //вход не выполнен
                switch ($_SESSION['chpass'] == 0){
                    //проверка необходимости смены пароля
                    case 0:
                        //нужно менять
                        $return.= change_pass();
                        break;
                    case 1:
                        //не нужно менять
                        $return .= sign_in();
                        break;
                }
                break;
        }
        $return.="</div>";
        return $return;
    }

    function sign_in() {
        $return='';
        $return.="<form action='./checksign.php' id='sign' method='post'></form>
            <input type='text' class='form-control w-25'
                placeholder='Username' 
                form='sign' 
                aria-label='Username' 
                name='login' style='position: absolute !important; top: 50%; left: 30%;' required/>
            <input type='password' class='form-control w-25' 
                placeholder='Password' 
                form='sign' 
                aria-label='Password' 
                name='pass' style='position: absolute !important; top: 55%; left: 30%;' />
            <input class='btn btn-dark' type='submit' value='Войти' form='sign' name='sign' style='position: absolute !important; top: 60%; left: 30%;'/>";
        return $return;
    }

    function change_pass(){
        $return='';
        $default_pass = '';
        if($_SESSION['pass'] == ''){
            $default_pass .= 'hidden';
        }
        $return.="<form action='./checksign.php' id='sign' method='post'></form>
            <input type='password' class='form-control w-25' 
                placeholder='Old Password' 
                form='sign' 
                aria-label='Old Password' 
                name='oldpass' style='position: absolute !important; top: 45%; left: 30%;' $default_pass/>";
        if($_SESSION['chpass'] == 1){
            $return.="<input type='password' class='form-control w-25' 
                placeholder='New Password' 
                form='sign' 
                aria-label='New Password' 
                name='pass' style='position: absolute !important; top: 50%; left: 30%;' required />
                <input type='password' class='form-control w-25' 
                placeholder='New Password' 
                form='sign' 
                aria-label='New Password' 
                name='pass1' style='position: absolute !important; top: 55%; left: 30%;' required />";
        }else{
            $return.="<input type='password' class='form-control w-25' 
                placeholder='New Password' 
                form='sign' 
                aria-label='New Password' 
                name='pass' style='position: absolute !important; top: 50%; left: 30%;' required />
                <input type='password' class='form-control w-25' 
                placeholder='New Password' 
                form='sign' 
                aria-label='New Password' 
                name='pass1' style='position: absolute !important; top: 55%; left: 30%;' required />";
        }

        $return.="<input class='btn btn-dark' type='submit' value='Подтвердить' form='sign' name='sign' style='position: absolute !important; top: 60%; left: 30%;'/>";
        return $return;
    }

    function user_prof(){
        $return = '';
        $return .= "<h1>Добро пожаловать!</h1>
        <form action='encrypt.php'>
        <button type='submit' class='btn btn-dark btn-lg'>Сохранить измененный пароль</button>
        </form>";
        $return .= "<div class='text-center'>
            <img width='250' src=$pic_fold>
</div>";
        return $return;
    }

    function admin_prof(){
        $return='';
        $return .= "
        <h1>Список пользователей:</h1>";
        //$db = file_get_contents($_SESSION['db']);
        //$_SESSION['db_info']=explode("\n",$db);
        $users_count = count($_SESSION['db_info']);
        $return .="<table class='table table-striped table-success text-center'>
                    <tbody>
                    <tr>
                        <td>Логин:</td>";
            $return .="<td> Условие пароля: </td>
                    <td>Бан:</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <form action='./adduser.php' id='adduser' method='post'></form>
                    <td>
                    <input type='text' class='form-control'
                    placeholder='Добавь пользователя, придумав ему логин' 
                    form='adduser' 
                    aria-label='Username' 
                    name='login' required/>
                    </td><td>
                        <select class='form-select-sm btn-light' form='adduser' name='condition'>
                            <option value='0'>Нет</option>
                            <option value='1'>Есть</option> 
                        </select>
                    </td>
                    <td></td>
                    <td colspan='2'>
                        <input class='btn btn-dark w-100' 
                        type='submit' value='Добавить' 
                        form='adduser' 
                        name='adduser'/>
                    </td>";

        $return .="</tr>";
        foreach ($_SESSION['db_info'] as $value){
            $user_login=explode(":",$value);
            $block = '';
            $unblock = '';
            $drop = '';
            $checkcondpass = '';
            $block .= "block" . $user_login[0];
            $unblock .= "unblock" . $user_login[0];
            $drop .= "drop" . $user_login[0];
            $checkcondpass .= "checkcondpass" . $user_login[0];
            $return .="<tr>
                <form action='./edit.php' id='edit' method='post'></form>
                    <form action='./block.php' id='$block' method='post'></form>
                    <form action='./unblock.php' id='$unblock' method='post'></form>
                    <form action='./droppassword.php' id='$drop' method='post'></form>
                    <form action='./checkcondpass.php' id='$checkcondpass' method='post'></form>
                    <td> $user_login[0] </td>";
//condition password
                $return .="<td>
                            ";
                if($user_login[2] == 1 and $user_login[0] != 'admin'){
                    $return .="<input class='btn btn-light' type='submit' value='Есть' form='$checkcondpass' name='condition'/>";
                }
                elseif($user_login[2] == 0 and $user_login[0] != 'admin'){
                    $return .="<input class='btn btn-light' type='submit' value='Нет' form='$checkcondpass' name='condition'/>";
                }else{
                    $return .="<input class='btn btn-dark' type='submit' value='Нет' name='condition' disabled/>";
                }

                $return .="<input class='btn' value='$user_login[0]' form='$checkcondpass' name='login' hidden/></td>";
//user blocked
                $return .="<td>";
                if($user_login[3] == 1 and $user_login[0] != 'admin'){$return .="Забанен!!!</td><td>
                    <input class='btn btn-success w-100' 
                    type='submit' value='Разбанить' 
                    form='$unblock' 
                    name='unblock'/></td>
                    <td><input class='btn' value='$user_login[0]' form='$unblock' name='login' hidden/>
                    <input class='btn btn-dark w-100' 
                    type='submit' value='Сбросить' 
                    form='$drop' 
                    name='drop'/>
                    <input class='btn' value='$user_login[0]' form='$drop' name='login' hidden/></td>";}
                elseif($user_login[3] == 0 and $user_login[0] != 'admin'){$return .="Нет</td><td>
                    <input class='btn btn-danger w-100' 
                    type='submit' value='Забанить' 
                    form='$block' 
                    name='block'/></td>
                    <td><input class='btn' value='$user_login[0]' form='$block' name='login' hidden/>
                    <input class='btn btn-dark w-100' 
                    type='submit' value='Сбросить' 
                    form='$drop' 
                    name='drop'/>
                    <input class='btn' value='$user_login[0]' form='$drop' name='login' hidden/></td>";}
                else{
                    $return .="</td><td colspan='2'></td>";
                }
                //$return .="</td><td></td>";

            $return .="</tr>";
        }
        $return .="</tbody>
            </table>";
        $return .= "
        <form action='encrypt.php'>
        <button type='submit' class='btn btn-dark btn-lg'>Сохранить изменения</button>
        </form>";
        return $return;
    }

    function encrypt(){


    }

   //function footer(){
   //    $return = '';
   //    $return .="<div class='container'>
   //        <footer class='text-center text-white fixed-bottom' >
   //            <div class='text-center p-3' style='background-color: rgba(0, 0, 0, 0.2);'>
   //                <a class='nav-link fs-6 text-white' href='https://github.com/AndreM-1230/DataProtectionLRNo1'>2022: Github</a>
   //            </div>
   //        </footer>
   //    </div>";
   //    return $return;
   //}


    function decrypt(){
        $return = '';
        $return .= "<form action='./decrypt.php' id='decrypt' method='post'></form>
        <input type='password' class='form-control w-25'
        placeholder='Ключ доступа' form='decrypt' style='position: absolute !important; top: 50%; left: 30%;'
        aria-label='Key for database' name='key' required/>
        <input class='btn btn-dark' type='submit' value='Ввести ключ' form='decrypt' name='sign' style='position: absolute !important; top: 60%; left: 30%;'/>";
        return $return;

    }

    function setkey(){
        $return = '';
        $return .= "<form action='./setkey.php' id='setkey' method='post'></form>
        <input type='password' class='form-control w-25'
        placeholder='Ключ доступа' form='setkey'
        aria-label='Ключ доступа' name='key' style='position: absolute !important; top: 50%; left: 30%;' required/>
            <input class='btn btn-dark' type='submit' value='Установить ключ' form='setkey' name='sign' style='position: absolute !important; top: 60%; left: 30%;'/>";
        return $return;
    }