<?php
session_start()
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Style.css" type="text/css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Customer</title>

    <style>

        Table{
            border-collapse: collapse;
            border:1px solid black;
            width: 500px;
            margin: auto;
            background-color: rgba(25,39,52);
            color: white;
        }
        td{
            border: 1px solid black;
            width-: 100px;
        }
        th{
            border: 1px solid black;
            width: 300px;
        }

    </style>

    <head>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="#">
                <img src="Sushi.png" alt="Logo" style="width:100px;">
            </a>
            ...
        </nav>
        <br>

<div class="container">

    <table>
        <tr>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th>Adress</th>
            <th>Postcode</th>
        </tr>

<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=zuzu", "root", "");
    $query = $db->prepare ("SELECT * FROM customer WHERE id = '".$_SESSION['customer_id']."'");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $data) {
        echo "<tr>";
        echo "<td>" . $data ["fname"] . "</td>";
        echo "<td>" . $data ["lname"] . "</td>";
        echo "<td>" . $data ["email"] . "</td>";
        echo "<td>" . $data ["adress"] . "</td>";
        echo "<td>" . $data ["zipcode"] . "</td>";
        echo "<tr>";
    }
    echo "</table>";

?>


        <br>
        <br>
        <br>

    <table>
    <tr>
        <th>Sushi 1</th>
        <th>Sushi 2</th>
        <th>Sushi 3</th>
        <th>Sushi 4</th>
        <th>Sushi 5</th>
        <th>Sushi 6</th>
        <th>total €</th>
    </tr>

    <?php
    $query = $db->prepare ("SELECT * FROM orders WHERE customer_id = '".$_SESSION['customer_id']."'");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $data) {
        echo "<tr>";
        echo "<td>" . $data ["sushi_1"] . "</td>";
        echo "<td>" . $data ["sushi_2"] . "</td>";
        echo "<td>" . $data ["sushi_3"] . "</td>";
        echo "<td>" . $data ["sushi_4"] . "</td>";
        echo "<td>" . $data ["sushi_5"] . "</td>";
        echo "<td>" . $data ["sushi_6"] . "</td>";
        echo "<td>" . $data ["total"] . "</td>";
        echo "<tr>";
    }
    echo "</table>";


} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>

</div>