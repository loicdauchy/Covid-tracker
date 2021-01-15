<?php

        try {
            $db = new PDO('mysql:host=localhost;dbname=integrationwp;port=3306;charset=utf8', 'root', '');
            }
        catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }