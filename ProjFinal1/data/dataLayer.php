<?php
	
	function connectionToDataBase()
	{
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "proj";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		// Check connection
		if ($conn->connect_error) 
		{
			return null;
		}
		else
		{
			return $conn;
		}
	}

	function attemptLogin($uEmail, $userPassword)
	{
		
		$connection = connectionToDataBase();

		if ($connection != null)
		{
			$sql = "SELECT nombre, apellido FROM Users WHERE email='$uEmail' AND passwrd='$userPassword'";
		
			$result = $connection->query($sql);

			if ($result->num_rows > 0)
			{
				while ($row = $result->fetch_assoc())
				{
					$response = array(
							"status" => "EXITO",
							"nombre"=>$row["nombre"], 
							"apellido"=>$row["apellido"]
							);
				}

				$connection -> close();
				return $response;
			}
			else
			{
				$connection -> close();
				return array("status" => "406");
			}
		}
		else
		{
			return array("status" => "500");
		}
		
		return array("status" => "500");
	}


	function attemptRegister ($nombre, $apellido, $email, $password)
	{
		$conn = connectionToDataBase();

		if ($conn != null)
		{

			$email = $_POST['email'];
			
			$sql = "SELECT email FROM Users WHERE email = '$email'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0)
			{
				header('HTTP/1.1 409 Conflict, Username already in use please select another one');
			    die("Username already in use.");
			}
			else
			{
				$password = $_POST['password'];
				$nombre = $_POST['nombre'];
				$apellido = $_POST['apellido'];
				
				$sql = "INSERT INTO Users (nombre, apellido, email, passwrd) VALUES ('$nombre', '$apellido', '$email', '$password')";
		    	
		    	if (mysqli_query($conn, $sql)) 
		    	{
		    		// Abrir y guardar datos en la sesion
					session_start();

					$_SESSION["nombre"] = $nombre;
					$_SESSION["apellido"] = $apellido;
				    echo json_encode("New record created successfully");
				} 
				else 
				{
					header('HTTP/1.1 500 Bad connection, something went wrong while saving your data, please try again later');
				    die("Error: " . $sql . "\n" . mysqli_error($conn));
				}
			} 
		}
	}


	function attemptRegisterLibro($titulo, $nombreAutor, $apellidoAutor, $genero, $anio)
	{
		$conn = connectionToDataBase();

		if ($conn != null)
		{

			$email = $_POST['email'];
			
			$sql = "SELECT email FROM Users WHERE email = '$email'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0)
			{
				header('HTTP/1.1 409 Conflict, Username already in use please select another one');
			    die("Username already in use.");
			}
			else
			{
				$titulo = $_POST["titulo"];
				$nombreAutor = $_POST["nombreAutor"];
				$apellidoAutor = $_POST["apellidoAutor"];
				$genero = $_POST["genero"];
				$anio = $_POST["anio"];

				$sql = "INSERT INTO Libros (titulo, nombreAutor, 
						nombreApellido, genero, anio)
				 VALUES ('$titulo', '$nombreAutor', '$apellidoAutor', '$genero', '$anio')";

				 if (mysqli_query($conn, $sql)) 
		    	{

				    echo json_encode("New book created successfully");
				} 
				else 
				{
					header('HTTP/1.1 500 Bad connection, something went wrong while saving your data, please try again later');
				    die("Error: " . $sql . "\n" . mysqli_error($conn));
				}
			}
	}

?>