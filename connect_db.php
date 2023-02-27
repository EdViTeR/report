<?php

    //локалка дом
    try {
      $dbo = new PDO('mysql:host=localhost;dbname=sereegak_teacherr', 'root', 'root');
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
