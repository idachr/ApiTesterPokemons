<?php

class Dbh {

    protected function connect (){
        try {
            $host = "localhost";
            $dbname = "pokemontrainers";
            $username = "root";
            $password = "";

            $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br>";
            die();
        }
    }
}