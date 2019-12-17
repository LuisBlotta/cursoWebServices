<?php

    class Conexion
    {
        private function __construct()
        {}
        static function conectar(){

            $conn = new PDO(
                'mysql:host=localhost:3307;dbname=peliculas',
                'root',
                '',
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $conn;
        }
    }
