<?php
require 'Modules/Database.php';
require 'Modules/Customer.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Style.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

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

<div class="container-form">
    <div class="row gy-3 justify-content-center div-wrapper align-items-center" >

        <form method="post" >
            <h3>Vul je gevens in</h3>
            <div class="mb-3">
                <label for="naam" class="col-form-label">
                    Vooraam:
                </label>
                <input type="text" name="fname" class="form-control"">
            </div>
            <div class="mb-3">
                <label for="bericht" class="col-form-label">
                    Achternaam:
                </label>
                <input type="text" name="lname" class="form-control"">
            </div>
            <div class="mb-3">
                <label for="bericht" class="col-form-label">
                    Email:
                </label>
                <input type="text" name="email" class="form-control"">
            </div>
            <div class="mb-3">
                <label for="bericht" class="col-form-label">
                    Adress:
                </label>
                <input type="text" name="adress" class="form-control"">
            </div>
            <div class="mb-3">
                <label for="bericht" class="col-form-label">
                    Postcode:
                </label>
                <input type="text" name="zipcode" class="form-control"">
            </div>
            <?php
            $alert = "Alle velden invullen aub!";

            if(isset($_POST['verzenden'])) {
                $required = array('fname', 'lname', 'email', 'adress', 'zipcode');
                $error = false;

                foreach($required as $field) {
                    if (empty($_POST[$field])) {
                        $error = true;
                    }
                }
                if ($error) {
                    echo "Alle velden invullen aub!";
                } else {
                    saveCustomer($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['adress'],$_POST['zipcode']);
                    $db = new PDO("mysql:host=localhost;dbname=zuzu","root", "");
                    $query = $db->prepare ("SELECT id FROM customer WHERE fname = '".$_POST['fname']."'");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as &$data) {
                        $_SESSION['customer_id'] = $data['id'];
                    }
                    header("Location: sushi.php");
                }
            }
            ?>
            <div class="modal-footer">
                <button type="submit" name="verzenden" class="btn btn-dark">>Save Change</button>
            </div>
        </form>
    </div>

</div>


</body>

</html>
