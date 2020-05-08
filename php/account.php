<?php
class Account
{
    public static function Login(){
        $mail = $_POST["email"];
        $passwd = $_POST["password"];
        //验证密码
        //echo 'In receive:<br />Email: '.$mail.'<br />Passwd: '.$passwd.'<br />';
        include('sqlite.php');
        $db = new SQLiteDB();
        $verifyRes = $db->VerifyAccount($mail,$passwd);
        $db->close();

        if ($verifyRes == true){
            //签发jwt
            include('jwt.php');
            //存取用户信息生成token
            $payload=array('sub'=>'1234567890','name'=>'John Doe','email'=>$mail);
            $token=Jwt::getToken($payload);
            //echo "<pre>";
            echo $token;
            //验证token部分
            /*
            $getPayload=Jwt::verifyToken($token);
            echo "<br><br>";
            var_dump($getPayload);
            echo "<br><br>";
            */
        } else {echo "Login Failed!";}
    }
    public static function UserAction(){
        $token = $_POST["token"];
        //$dataReceive = $_POST["data"];
        //验证token
        //echo 'Input token: '.$token.'<br />';
        include('jwt.php');
        if ($getPayload=Jwt::verifyToken($token) != false){
            //验证成功 可以执行下一步
            //echo "<br><br>";
            //var_dump($getPayload);
            echo "Verify Succeed!";
            //echo "<br><br>";
        } else {
            //echo "<br><br>";
            echo "Verify Failed!";
            //echo "<br><br>";
        }
    }
    public static function SignUp(){
        include('sqlite.php');
        $db = new SQLiteDB();
        $db->Insert($_POST["email"],$_POST["password"]);
        //查询
        $sql =<<<EOF
        SELECT * from USER;
        EOF;
        $ret = $db->query($sql);
        //$db->ShowAll($ret);
        $db->close();
    }
    public static function ReTable(){
        include('sqlite.php');
        $db = new SQLiteDB();
        $db->RecreateTable();
        $db->close();
    }
}
?>