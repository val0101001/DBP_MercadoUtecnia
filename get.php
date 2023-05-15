<?php

error_reporting(E_ALL);
ini_set("display_errors","On");

$action=$_REQUEST["Action"];
$db=$_REQUEST["DB"];
$table=$_REQUEST["Table"];
$link=mysqli_connect("localhost","root","",$db);

if($action=="add"){

	$select=mysqli_query($link,"SELECT * FROM ".$table."");
        $num_rows=mysqli_num_rows($select);
        $field_info=mysqli_fetch_fields($select);
	$rows="(";

	for($i=0;$i<count($field_info);$i++){
		$rows.=$field_info[$i]->name;
		if($i!=count($field_info)-1) $rows.=", ";
	}
	$rows.=")";

	$query="INSERT INTO ".$table." ".$rows;
	$query.="VALUES (1,'1','1',1,'1','1')";

	$result=mysqli_query($link,$query);	
}

else{

	if(!isset($_POST["search_id"]) and !isset($_POST["catch_0"])){

		$result=mysqli_query($link,"SELECT * FROM ".$table."");
		$num_rows=mysqli_num_rows($result);
		$field_info=mysqli_fetch_fields($result);

		for($i=0;$i<$num_rows;$i++){
        		$row=mysqli_fetch_array($result);
        		echo "ID : ".($i+1)."</br>";
        		foreach($field_info as $val){
                		echo $val->name." : ".$row[$val->name]."</br>";
        		}
        		echo "----------------------------------------------</br>";
		}

		if($action!="get"){
			
		echo "

		<form action='get.php' id='form' method='post'>
		
		<Input Type='number' name='search_id' min=1>
		
		</form>

		<button onclick='Form()'>Search</button>
		
		<script>
		
			function Form(){
				var f=document.getElementById('form');

				var db=document.createElement('input');
				db.type='hidden';
				db.name='DB';
				db.value='".$db."';
				f.appendChild(db);

				var table=document.createElement('input');
                                table.type='hidden';
                                table.name='Table';
                                table.value='".$table."'; 
                                f.appendChild(table);

				var action=document.createElement('input');
                                action.type='hidden';
                                action.name='Action';
                                action.value='".$action."'; 
                                f.appendChild(action);
				
				f.submit();
			}
		
		</script>
			
		";
		
		}

	}

	else{
		$num_id=$_POST["search_id"];
		$select_id="";
			
		$result=mysqli_query($link,"SELECT * FROM ".$table."");
                $num_rows=mysqli_num_rows($result);
                $field_info=mysqli_fetch_fields($result);

		for($i=0;$i<$num_rows;$i++){
			$row=mysqli_fetch_array($result);
			if($row[0]==$num_id){
				$select_id=$field_info[0]->name."=".$row[$field_info[0]->name];
				break;
			}
		
		}

		if($action=="edit"){
			
			if(!isset($_POST["catch_0"])){

			$types=[
				3=>"'number' min=0",
				4=>"'number' step=0.5 min=0",
				253=>"text",
				254=>"text"
			];

			$inputs="";

			for($i=0;$i<count($field_info);$i++){
				$inputs.="<Input Type=".$types[$field_info[$i]->type]." name='catch_".$i."'></br>";
			}

			echo "

                	<form action='get.php' id='form' method='post'>
                	
			".$inputs."

                	</form>
                	                
                	<button onclick='Form()'>Search</button>
                	
                	<script>
                	
                	        function Form(){
                        	        var f=document.getElementById('form');
                        	        
                        	        var db=document.createElement('input');
                        	        db.type='hidden';
                        	        db.name='DB';
                        	        db.value='".$db."';
                        	        f.appendChild(db);
                	
                	                var table=document.createElement('input');
                	                table.type='hidden';
                	                table.name='Table';
                	                table.value='".$table."'; 
                	                f.appendChild(table);
  	
  	                        	var action=document.createElement('input');
        	                        action.type='hidden';
                	                action.name='Action';
                        	        action.value='".$action."'; 
               	                	f.appendChild(action);
                	                
					var search=document.createElement('input');
					search.type='hidden';
					search.name='search_id';
					search.value='".$_POST["search_id"]."';
					f.appendChild(search);

					f.submit();
                	        }
                	
                	</script>
                	        
                	";

			}

			else{
				
				$result=mysqli_query($link,"SELECT * FROM".$table."");				
				$num_id=$_POST["search_id"];

				$update="UPDATE ".$table." SET ";
				for($i=0;$i<count($field_info);$i++){
					$update.=$field_info[$i]->name."=";
					if($field_info[$i]->type==253 or $field_info[$i]->type==254) $update.="'";	
					$update.=$_POST["catch_".strval($i)];
					if($field_info[$i]->type==253 or $field_info[$i]->type==254) $update.="'";	
					if($i!=count($field_info)-1) $update.=", ";
				}

				$update.=" WHERE ".$select_id;
				$end=mysqli_query($link,$update);
				echo $update."</br>";

			}
		}

		else{
			$deletion="DELETE FROM ".$table." WHERE ".$select_id;
			$end=mysqli_query($link,$deletion);
			echo $deletion;
		}

	}

}

?>
