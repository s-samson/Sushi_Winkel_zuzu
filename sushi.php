<?php
require 'Modules/Database.php';
require 'Modules/Order.php';
session_start();
$user_id = $_SESSION['customer_id'];
if(isset($_POST['verzenden'])) {
    $db = new PDO("mysql:host=localhost;dbname=zuzu","root", "");
    $query = $db->prepare ("SELECT * FROM sushi");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $total = 0;
    $i = 0;
    $sushies[0] = $_POST['sushi_1'];
    $sushies[1] = $_POST['sushi_2'];
    $sushies[2] = $_POST['sushi_3'];
    $sushies[3] = $_POST['sushi_4'];
    $sushies[4] = $_POST['sushi_5'];
    $sushies[5] = $_POST['sushi_6'];

    foreach ($result as &$data) {
        $total = $total + $data ["price"] * $sushies[$i];
        $i++;
    }
    echo $total;
    saveOrders($user_id, $_POST['sushi_1'],$_POST['sushi_2'],$_POST['sushi_3'],$_POST['sushi_4'],$_POST['sushi_5'],$_POST['sushi_6'], $total);
    header("Location: result.php");
}
?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Style.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>

        .Table-Sushi{
            border-collapse: collapse;
            border:1px solid black;
            width: 300px;
            margin: auto;
            background-color: rgba(25,39,52);
            color: white;
        }
        td{
            border: 1px solid black;
            width: 100px;
        }
        th{
            border: 1px solid black;
            width: 100px;
        }
        .container-form{
            border-collapse: collapse;
            border:3px solid black;
            width: 300px;
            background-color: rgba(25,39,52);
            color: white;
            justify-content: center;


        }



    </style>

</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">
        <img src="Sushi.png" alt="Logo" style="width:100px;">
    </a>
    ...
</nav>
<br>
<br>
<br>

<div class="Table-Sushi">
<table>
    <tr>
        <th> Naam</th>
        <th> Prijs</th>
        <th> Hoeveelheid sushi</th>
    </tr>
<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=zuzu","root","");
    $query = $db->prepare("SELECT * FROM sushi");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $data) {
        echo "<tr>";
        echo "<td>" . $data['name'] . "</td>";
        echo "<td>" . $data['price'] . "</td>";
        echo "<td>" . $data['amount'] . "</td>";
        echo "</tr>";
    }

}catch (PDOException $e){
    die("Error!: " . $e->getMessage());
}
?>
</table>
</div>

<br>

<div class="container-form">
    <div class="row gy-3 justify-content-center div-wrapper align-items-center">
    <form method="post">
        <div class="mb-3">
            <label for="bericht" class="col-form-label">Uramaki</label>
            <input type="number" name="sushi_1" value="0">
        </div>
        <div class="mb-3">
            <label for="bericht" class="col-form-label">
                    Temaki
            </label>
            <input type="number" name="sushi_2" value="0">
        </div>
        <div class="mb-3">
            <label for="bericht" class="col-form-label">
                    Maki
            </label>
            <input type="number" name="sushi_3" value="0">
        </div>
        <div class="mb-3">
            <label for="bericht" class="col-form-label">
                    Sashimi
            </label>
            <input type="number" name="sushi_4" value="0">
        </div>
        <div class="mb-3">
            <label for="bericht" class="col-form-label">
                    Nigiri
            </label>
            <input type="number" name="sushi_5" value="0">
        </div>
        <div class="mb-3">
            <label for="bericht" class="col-form-label">
                Kappa maki 
            </label>
            <input type="number" name="sushi_6" value="0">
        </div>
        <button type="submit" name="verzenden" class="btn btn-secondary">Verstuur</button>

    </div>
</div>



</body>


