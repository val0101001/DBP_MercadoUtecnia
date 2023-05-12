</head>
<body>

<div class='container'>
	<div class='row'>
		<div class='col-md-6 mx-auto'>
			<form id='myForm' action='' method='post'>
				<div class='mb-3'>
					<label class='form-label'>Numero de tarjeta</label>
					<input type='number' name='array[]' class='form-control' required>
				</div>
				<div class='mb-3'>
					<label class='form-label'>Fecha de expiracion</label>
					<input type='month' name='array[]' class='form-control' required>
				</div>
				<div class='mb-3'>
					<label class='form-label'>CCV</label>
					<input type='number' min='100' max='999' name='array[]' class='form-control' required>
				</div>
				<button type='button' onclick='generate()' class='btn btn-primary'>Confirmar</button>
			</form>
		</div>
	</div>
</div>

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

</body>
</html>
";

?>