<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

function submit_form(form_id,method,table){

	var Form=document.getElementById(form_id);

	var Table=document.createElement("input");
	Table.type="hidden";
	Table.name="Table";
	Table.value=table;
	Form.appendChild(Table);
	
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
