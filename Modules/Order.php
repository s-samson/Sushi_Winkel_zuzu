<?php

function getOrders():array
{
    global $pdo;
    $sth = $pdo->prepare('SELECT * FROM orders order by date DESC');
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_CLASS, 'Orders');


}

function saveOrders(int $customer_id, string $sushi_1, string $sushi_2, string $sushi_3, string $sushi_4, string $sushi_5, string $sushi_6, int $total): void
{
    global $pdo;

    $sth = $pdo->prepare('INSERT INTO orders (customer_id, sushi_1, sushi_2, sushi_3, sushi_4, sushi_5, sushi_6,total) VALUES (:c,:s1,:s2,:s3,:s4,:s5,:s6,:t)');
    $sth->bindParam("c", $customer_id);
    $sth->bindParam("s1", $sushi_1);
    $sth->bindParam("s2", $sushi_2);
    $sth->bindParam("s3", $sushi_3);
    $sth->bindParam("s4", $sushi_4);
    $sth->bindParam("s5", $sushi_5);
    $sth->bindParam("s6", $sushi_6);
    $sth->bindParam("t", $total);
    $sth->execute();
}