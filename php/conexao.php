<?php

    define("HOST","localhost");
    define("USER","root");
    define("PASS","");
    define("DATABASE","aluno_db");

    function getConnection(){
        try{
            $key = 'strval';
            $connection = new PDO("mysql:host={$key(HOST)};dbname={$key(DATABASE)}",USER, PASS) or die("Erro ao tentar conectar no banco de dados");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $error){
            echo "Erro ao conectar no banco. Erro: {$error->getMessage()}";
            exit;
        }
    }