<?php

try {
    $db = new PDO('mysql:host=localhost:3306;dbname=db_techbank','db_techbank','Skytechnology#123');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print $e->getMessage();
    die();
}
