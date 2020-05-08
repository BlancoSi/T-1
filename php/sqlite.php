<?php
//windows10:php.ini
//extension_dir = "ext"
//extension=sqlite3
   class SQLiteDB extends SQLite3
   {
      function __construct(){
         $this->open('test.db');
      }
      function RecreateTable(){
         $droptable =<<<EOF
         DROP TABLE USER;
         EOF;
         $this->ExecStr($droptable,"Drop succeed");
         $creattable =<<<EOF
         CREATE TABLE USER
         (ID INT PRIMARY KEY    NOT NULL,
         EMAIL          TEXT    NOT NULL,
         PASSWORD       TEXT    NOT NULL);
         EOF;
         $this->ExecStr($creattable,"Creat succeed");
         // insert
         $insertData =<<<EOF
         INSERT INTO USER (ID,EMAIL,PASSWORD)
         VALUES (1, 'user@example.com', '123456');
         INSERT INTO USER (ID,EMAIL,PASSWORD)
         VALUES (2, '123', '123');
         EOF;
         $this->ExecStr($insertData,"Insert succeed");
         // select
         $selectData =<<<EOF
         SELECT * FROM USER;
         EOF;
         $this->ExecStr($selectData,"Select succeed");
      }
      function Insert($email,$password){
         //查询最大id
         $maxQuery =<<<EOF
         SELECT MAX(ID) AS "MAXID" FROM USER;
         EOF;
         $ret = $this->query($maxQuery);
         $row = $ret->fetchArray(SQLITE3_ASSOC);
         $nextId = (int)$row['MAXID'] + 1;
         //echo "Next Id: ".$nextId."\n";
         //插入新用户数据
         $insertData =<<<EOF
         INSERT INTO USER (ID,EMAIL,PASSWORD)
         VALUES ($nextId,'$email','$password');
         EOF;
         $ret = $this->exec($insertData);
         if(!$ret){
            echo $this->lastErrorMsg()."\n";
         } else {
            echo "User $email Sign up Succeed\n";
            return true;
         }
      }
      function ShowAll($ret){
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            echo "ID = ". $row['ID'] . "\n";
            echo "EMAIL = ". $row['EMAIL'] ."\n";
            echo "PASSWORD = ". $row['PASSWORD'] ."\n";
         }
      }
      function ExecStr($cmd,$succ){
         //echo $cmd.'\n';
         $ret = $this->exec($cmd);
         if(!$ret){
            echo $this->lastErrorMsg()."\n";
         } else {
            echo $succ."\n";
         }
      }
      function VerifyAccount($email, $password){
         if ($email == ''){return false;}
         $sql =<<<EOF
         SELECT * from USER WHERE EMAIL = '$email';
         EOF;
         $ret = $this->query($sql);
         $row = $ret->fetchArray(SQLITE3_ASSOC);
         //echo "In DB:<br />";
         //echo "EMAIL = ". $row['EMAIL'] . "<br />";
         //echo "PASSWORD = ". $row['PASSWORD'] ."<br /><br />";
         if ($row['PASSWORD'] == $password){
            //echo "Verify Succeed!<br /><br />";
            return true;
         } else {
            //echo "Verify Failed!<br /><br />";
            return false;
         }
      }
   }
   /*
   $db = new SQLiteDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully<br /><br />";
   }

   //$db->RecreateTable();

   $db->VerifyAccount('123','123');

   $db->close();
   */
?>