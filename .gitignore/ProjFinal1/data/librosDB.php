<?php
	//header('Accept: application/json');
	header('Content-type: application/json');

	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "proj";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn -> connect_error){
		header("HTTP/1.1 500 Bad connection to the DataBase");
		die("The server is down, please try again later.");
	}
	else{
		
		$sql = "SELECT id_conversion, name, addition, substract, tiimes, divide FROM Conversion"; 

		$result = $conn ->query($sql);

		if($result ->num_rows > 0){

  			$response = array();

  			while ($row = $result ->fetch_assoc())
  			{
  				array_push($response, array 
  						(
  						"idLibro" => ($row["id_libro"]),
  						"titulo" => utf8_encode($row["titulo"]),
  						"autorNombre" => utf8_encode($row["autorNombre"]),
  						"autorApellido" => utf8_encode($row["autorApellido"]),
  						"genero" => utf8_encode($row["genero"]),
  						"anio" => utf8_encode($row["anio"])
  						)
  					);
  			}

			echo json_encode($response);

		}
		else{	
			header("HTTP/1.1 409 Bad connection, something went wrong with the DataBase, please try again later");
	 		die("Something were wrong. Try again later");
		}		
	}

?>
