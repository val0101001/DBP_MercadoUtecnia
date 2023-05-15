<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <style>
	body {
	    background-image: url('https://w0.peakpx.com/wallpaper/474/904/HD-wallpaper-abstract-shapes-2021-minimalist.jpg');
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

<body><br>
<div class="container-fluid vh-10 justify-content-center align-items-center">
	<div class="form-container">
		<form id='myForm' action='' method='post'>
			<div class="mb-3">
				<label class='form-label'>Numero de tarjeta</label>
				<br>
				<input type='number' name='array[]' class='form-control' required>
			</div>
			<div class="mb-3">
				<label class='form-label'>Fecha de expiracion</label>
				<br>
				<input type='month' name='array[]' class='form-control' required>
			</div>
			<div class="mb-3">
				<label class='form-label'>CCV</label>
				<br>
				<input type='number' min='100' max='999' name='array[]' class='form-control' required>
			</div>
			<div class="d-grid">
				<button type="submit" onclick='generate()' class='btn btn-primary'>Confirmar</button>
			</div>
		</form>
	</div>
</div>
</body>

<script>
function generate(){
	var Form=document.getElementById('myForm');
	var email=document.createElement('input');
	email.type='hidden';
	email.name='array[]';
	email.value='".$email."';
	Form.appendChild(email);
	submit_form('myForm','Add','Tarjeta',false);
	alert('Tarjeta agregada!');
	var Form2=document.createElement('form');
	Form2.setAttribute('method','post');
	Form2.setAttribute('action','venta.php');
	var email2=document.createElement('input');
	email2.type='hidden';
	email2.name='array[]';
	email2.value='".$email."';
	Form2.appendChild(email2);
	var id=document.createElement('input');
	id.type='hidden';
	id.name='array[]';
	id.value='".$id."';
	Form2.appendChild(id);	
	location.replace(".$url.");	
}

function submit_form(form_id,method,table,unique){
	var Form=document.getElementById(form_id);
	var Table=document.createElement('input');
	Table.type='hidden';
	Table.name='Table';
	Table.value=table;
	Form.appendChild(Table);
	var Unique=document.createElement('input');
	Unique.type='hidden';
	Unique.name='Unique';
	Unique.value=unique;
	Form.appendChild(Unique);
	if(method=='Add'){
		Form.setAttribute('method','post');
		Form.setAttribute('action','add_value.php');
	}
	else if(method=='Get'){
		Form.setAttribute('method','get');
		Form.setAttribute('action','get_values.php');
	}
	else if(method=='Edit'){
		Form.setAttribute('method','post');
		Form.setAttribute('action','edit_values.php');
	}
	else{
		Form.setAttribute('method','post');
		Form.setAttribute('action','delete_values.php');
	}
	Form.submit();
}
</script>
</html>
