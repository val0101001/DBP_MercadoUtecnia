echo'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <style>
	body {
	    background-image: url('https://images.wallpapersden.com/image/download/abstract-shapes-2021-minimalist_bG1lZm6UmZqaraWkpJRnamtlrWZpaWU.jpg');
	    background-repeat: no-repeat;
	    background-size: cover;
	}
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.2);
            padding: 30px;
        }
        .form-container h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
        }
        .form-container label {
            font-size: 1.2rem;
            font-weight: bold;
            color: #555;
        }
        .form-container input[type="nombre"], .form-container input[type="password"] {
            border-radius: 5px;
            padding: 10px;
            border: none;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
        }
        .form-container input[type="nombre"]:focus, .form-container input[type="password"]:focus {
            box-shadow: 0px 0px 10px 0px rgba(0,0,255,0.5);
            outline: none;
        }
        .form-container .btn-primary {
            background-color: #007bff;
            border: none;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
        }
        .form-container .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-container .mt-2 {
            font-size: 0.9rem;
            color: #888;
        }
        .form-container .mt-2 a {
            color: #007bff;
            text-decoration: none;
        }
        .form-container .mt-2 a:hover {
            text-decoration: underline;
        }
    </style>
<?php
$id=$_REQUEST["id"];
$email=$_REQUEST["email"];

$link=mysqli_connect("localhost","root","","Proyecto");
$product=mysqli_query($link,"SELECT Nombre,Precio FROM Producto WHERE ID=".$id);

$num_rows=mysqli_num_rows($product);
$field_info=mysqli_fetch_fields($product);

echo "<div class='container-fluid vh-100 d-flex justify-content-center align-items-center>";

echo "h1 class='text-center mb-4'>Compra realizada!</h1>
        <div class='card-body'>
            <h5 class='card-title'>Se ha comprado el siguiente objeto</h5>";

$price=0;

$row=mysqli_fetch_array($product);
for($i=0;$i<count($field_info);$i++){
	echo "<label for='nombre'><strong>".$field_info[$i]->name."</strong> : ".$row[$i]."</p>";
	if($i==1) $price=$row[$i];
}

$sell=mysqli_query($link,"SELECT v_email FROM Producto WHERE ID=".$id);
$sells=mysqli_fetch_array($sell);
$seller=$sells[0];

$add="INSERT INTO Venta (ID,v_email,c_email,p_ID,Pago) ";
$add.="VALUES (".rand(0,999999999).", '".$seller."', ".$email.", ".$id.", ".$price.")";

$deletion="DELETE FROM Producto WHERE ID=".$id;

$result=mysqli_query($link,$deletion);
$result=mysqli_query($link,$add);

echo "
            <a href='Inicio.html' class='btn btn-primary'>Menu principal</a>
        </div>
    </div>";

?>
