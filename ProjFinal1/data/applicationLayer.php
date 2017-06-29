<?php
	header('Accept: application/json');
	header('Content-type: application/json');
	require_once __DIR__ . '/dataLayer.php';

	$accion = $_POST["accion"];

	$accion2 = $_POST["accion2"];

	switch($accion)
	{
		case "LOGIN" : loginFunction();
						break;

		case "REGISTER" : registerFunction();
						break;

		case "REGISTERLIBRO" : registerLibroFunction()
						break;
	}

	switch ($accion2) 
	{
		case "SESSION" : sessionFunction();
						break;
	}


	function loginFunction()
	{
		$uEmail = $_POST["uEmail"];
		$uPassword = $_POST["uPassword"];

		$response = attemptLogin($uEmail, $uPassword);

		if ($response["status"] == "EXITO")
		{
			startSession($response["nombre"], $response["apellido"]);
			
			startCookie($uEmail);

			echo json_encode($response);
		}
		else
		{
			errorHandling($response["status"]);
		}
	}


	function startSession($nombre, $apellido)
	{
		// Abrir y guardar datos en la sesion
		session_start();

		$_SESSION["nombre"] = $nombre;
		$_SESSION["apellido"] = $apellido;
	}


	function startCookie($uName)
	{
		$remember = $_POST["remember"];

		if ($remember == "true")
		{
			setcookie("email", $uEmail, time() + 3600*24);
		}	
	}


	function errorHandling($errorStatus)
	{
		switch ($errorStatus)
		{
			case "406" : header('HTTP/1.1 406 User not found');
						die("Wrong credentials provided!");
						break;
			case "500" : header('HTTP/1.1 500 Bad connection to Database');
						die("The server is down, we couldn't establish the DB connection");
						break;
		}
	}



	function registerFunction ()
	{
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$email = $_POST["email"];
		$password = $_POST["password"];

		$response = attemptRegister($nombre, $apellido, $email, $password);
	}


	function sessionFunction () 
	{
		session_start();
		if (isset($_SESSION["nombre"]) && isset($_SESSION["apellido"]))
		{
			echo json_encode(array(
					"nombre" => $_SESSION["nombre"], 
					"apellido" => $_SESSION["apellido"]));
		}
		else
		{
			header('HTTP/1.1 406 Session has expired.');
			die("Your session has expired you will be redirected to the index.");
		}
	}



	function registerLibroFunction ()
	{
		$titulo = $_POST["titulo"];
		$nombreAutor = $_POST["nombreAutor"];
		$apellidoAutor = $_POST["apellidoAutor"];
		$genero = $_POST["genero"];
		$anio = $_POST["anio"];

		$response = attemptRegisterLibro($titulo, $nombreAutor, $apellidoAutor, $genero, $anio);
	}
?>