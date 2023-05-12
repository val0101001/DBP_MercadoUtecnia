<?php
$id=$_REQUEST["id"];
$email=$_REQUEST["email"];

$link=mysqli_connect("localhost","root","","Proyecto");
$product=mysqli_query($link,"SELECT Nombre,Precio FROM Producto WHERE ID=".$id);

$num_rows=mysqli_num_rows($product);
$field_info=mysqli_fetch_fields($product);

echo "<h1 class='display-4'>Compra realizada!</h1>";

echo "<div class='card border-0 shadow p-3 mb-5 bg-white rounded'>
        <div class='card-body'>
            <h5 class='card-title'>Se ha comprado el siguiente objeto</h5>";

$price=0;

$row=mysqli_fetch_array($product);
for($i=0;$i<count($field_info);$i++){
	echo "<p class='card-text'><strong>".$field_info[$i]->name."</strong> : ".$row[$i]."</p>";
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