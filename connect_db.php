<?php

#    //локалка дом
#    try {
#      $dbo = new PDO('mysql:host=localhost;dbname=sereegak_teacherr', 'root', '');
#    } catch (PDOException $e) {
#      print "Error!: " . $e->getMessage();
#      die();
#    }

  define('DB_HOST', 'localhost');       #Изменил подключение к БД
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'sereegak_teacherr');

  $dbo = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if($dbo->connect_errno) exit('Ошибка подключения к БД');
  $dbo->set_charset('utf8');
