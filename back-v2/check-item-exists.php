<?php

echo'

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <style>
	body{
	    background-image: url("https://w0.peakpx.com/wallpaper/474/904/HD-wallpaper-abstract-shapes-2021-minimalist.jpg");
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
            background-color: #67f193;
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
	    text-decoration
        }
    </style>

'; 
error_reporting(E_ALL);
ini_set("display_errors","On");

$data = $_POST["array"];
$db="Proyecto";
$table="Usuarios";
$link=mysqli_connect("localhost","root","",$db);
$operation=$_POST["Operation"];

$result=mysqli_query($link,"SELECT * FROM ".$table."");
$num_rows=mysqli_num_rows($result);
$field_info=mysqli_fetch_fields($result);

$check=false;
$email="";

for($i=0;$i<$num_rows;$i++){
	$row=mysqli_fetch_array($result);
	if($row[1]==$data[0]&&$row[2]==$data[1]){
		$check=true;
		$email=$row[0];
		break;
	}
	$check=false;
}

if($check){
	if($operation==="Comprar"){echo '
    <body><br>
	<div class="form-container">
	<div class="container-fluid vh-10 justify-content-center align-items-center a">
    <h2 style="font-size:40px">Lista de productos</h2>
    <script>
    
		function param(form_id){
        
			var Form=document.getElementById(form_id);
			var email=document.createElement("input");
                	email.type="hidden";
                	email.name="email";
                	email.value="'.$email.'";
                	Form.appendChild(email);

			Form.submit();

		}	

		</script>
		Producto a comprar (codigo):</br>
		<form id="myForm", action="Productos.php" method="post">
			<input type=number min=0 name="id" class="form-control"></br>
	    <div class="d-grid">
            <button type="submit" onclick=param("myForm") class="btn btn-primary">Buscar</button>
            </div>
        </form>
		</br>
        </div>
	</div>
';}
	if($operation==="Comprar"){
		$link2=mysqli_connect("localhost","root","","Proyecto");
		$products=mysqli_query($link2,"SELECT * FROM Producto");
		$n_rows=mysqli_num_rows($products);
		$field_info2=mysqli_fetch_fields($products);
        echo'</br><div class="form-container-fluid vh-10 d-flex justify-content-center align-items-center">
        <div class="form-container">
	    <div class="col-md-20">';
        for($i=0;$i<$n_rows;$i++){
            '<div class="form-group">';
			$row=mysqli_fetch_array($products);
			for($j=0;$j<count($field_info2)-1;$j++){
				echo $field_info2[$j]->name.' : '.$row[$j].'</br>';
			}
			echo '

			<div style="background-color:black;font-size:1px">a</div>

</br>

';
		}
            '</div>
        </div>
        </div>';
	}		

	else{echo '
<script>

function submit_form(form_id,method,table,unique){

        var Form=document.getElementById(form_id);
        
        var Table=document.createElement("input");
        Table.type="hidden";
        Table.name="Table";
        Table.value=table;
        Form.appendChild(Table);

	var Unique=document.createElement("input");
        Unique.type="hidden";
        Unique.name="Unique";
        Unique.value=unique;
        Form.appendChild(Unique);

        if(method=="Add"){
                
                Form.setAttribute("method","post");
                Form.setAttribute("action","add_value.php");

        }

        else if(method=="Get"){

                Form.setAttribute("method","get");
                Form.setAttribute("action","get_values.php");
        
        }

        else if(method=="Edit"){

                Form.setAttribute("method","post");
                Form.setAttribute("action","edit_values.php");

        }

        else{

                Form.setAttribute("method","post");
                Form.setAttribute("action","delete_values.php");

        }

        Form.submit();

}
	</script>

	<script>
	
	function generate(form_id){
		
		var Form=document.getElementById(form_id);
		
		var id=document.createElement("input");
		id.type="hidden";
		id.name="array[]";
		id.value=Math.floor(Math.random()*99999999);
		Form.prepend(id);
		

		var email=document.createElement("input");
		email.type="hidden";
		email.name="array[]";
		email.value="'.$email.'";
		Form.appendChild(email);

		submit_form("myForm","Add","Producto",true);		

		alert("Producto agregado!");
	}

	</script>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
    <div class="form-container col-mb-4">
	<h1 class="text-center ">Vender producto</h1> </br>
		<form id="myForm" action="" method="post">
            <div class="mb-3">
			Nombre: <input type="text" class="form-control" name=array[]></br>
			Precio: <input type="number" min=0 step=0.5 class="form-control" name=array[]></br>
            </div>
        </form>
		<button type="submit" onclick=generate("myForm") class="btn btn-primary">Enviar</button></div></div></div>
		';
	}

}
else{
	header("location:javascript://history.go(-1)");
}
echo "</body>"
?>
