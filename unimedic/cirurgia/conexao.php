<?php
	
	$con = mysqli_connect("localhost", "root", "") ;
	
	mysqli_select_db($con, "banco_unimedic") or 
				die("Erro na seleção do banco:" .
					mysqli_error($con) );

?>