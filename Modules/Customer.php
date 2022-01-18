<?php

function getCustomer():array
{
    global $pdo;
    $sth = $pdo->prepare('SELECT * FROM customer order by date DESC');
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_CLASS, 'Customer');
}

function saveCustomer(string $fname, string $lname, string $email, string $adress, string $zipcode): void
{
    global $pdo;

    $sth = $pdo->prepare('INSERT INTO customer (fname, lname, email, adress, zipcode) VALUES (:f,:l,:e,:a,:z)');
    $sth->bindParam("f", $fname);
    $sth->bindParam("l", $lname);
    $sth->bindParam("e", $email);
    $sth->bindParam("a", $adress);
    $sth->bindParam("z", $zipcode);
    $sth->execute();
}
