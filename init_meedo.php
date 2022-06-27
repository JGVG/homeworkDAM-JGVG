<?php
    require 'C:\xampp\htdocs\homeworkDAM-JGVG\Medoo.php';
    use Medoo\Medoo;

    $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'db_gestor',
        'server' => 'localhost:3306',
        'username' => 'root',
        'password' => ''
    ]);
?>