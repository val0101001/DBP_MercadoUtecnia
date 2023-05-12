function submit_form(form_id,method,table,unique){
	
	var Form=document.getElementById(form_id);	
	
	var Table=document.createElement("input");
	Table.type="hidden";
	Table.name="Table";
	Table.value=table;
	Form.appendChild(Table);

	var Unique=document.createElement('input');
        Unique.type='hidden';
        Unique.name='Unique';
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

function check_exists(form_id,table,op){	
	
	var Form=document.getElementById(form_id);
       	
        var Table=document.createElement("input");
        Table.type="hidden";
        Table.name="Table";
        Table.value=table;
        Form.appendChild(Table);
	
	var Operation=document.createElement("input");
	Operation.type="hidden";
	Operation.name="Operation";
	Operation.value=op;
	Form.appendChild(Operation);
	
	Form.submit();

}
