
$(document).ready(function(){

	menuFunctionality();
	//sessionActiva();

	$("#newUserButton").on("click", newUser);
	$("#registerLoginButton").on("click", registerToLogin);

	$("#loginUserButton").on("click", loginFunction);
	$("#registraUserButton").on("click", registerUserFunction);

	$("#agregarLibro").on("click", agregarLibroFunction);

});

//----------------------------------------Menu Functionality------
function menuFunctionality () {

	$("#menu > li").on("click", function() {

		$(".selected").removeClass("selected");

		var $currentSelection = $(".currentSelection");
		$currentSelection.removeClass("selected");

		$currentSelection.removeClass("currentSelection")
							.addClass("hiddenSection");

		var currentSection = $(this).attr("class");
		console.log(currentSection);

		$("#" + currentSection).addClass("currentSelection")
								.removeClass("hiddenSection");

		$(this).addClass("selected");
	});
}

//--------------------------New user-----------------
function newUser () 
{
	$("#loginUsersId").hide();
	$("#registroUsuariosId").show();
}


//--------------------------Registe to Login------------
function registerToLogin ()
{
	$("#loginUsersId").show();
	$("#registroUsuariosId").hide();
}


//---------------------------Login Function----------------------------
function loginFunction()
{	
	console.log("loginFunction");
	var rememberMe = $("#rememberMe").is(":checked");
	
	if ($("#emailLogin").val == "" || $("#passwordLogin").val()=="")
	{
		$("#camposVaciosLogin").show();
	}
	else
	{
		$("#camposVaciosLogin").hide();
		var jsonToSend ={
							"uEmail" : $("#emailLogin").val(),
							"uPassword" : $("#passwordLogin").val(),
							"remember" : rememberMe,
							"accion" : "LOGIN"
						};	

		$.ajax({

			url : "data/applicationLayer.php",
			type : "POST",
			data : jsonToSend,
			dataType : "json",
			contentType : "application/x-www-form-urlencoded",
			success : function(jsonReceived){
				console.log("success ajax POST");
				//("#h2usuario").text(sessionJson.nombre + " " +
									// sessionJson.apellido);
				$(".loginRegister").removeClass("selected")
									.removeClass("currentSection");

				$("#home").addClass("currentSelection")
							.removeClass("hiddenSection");

				$(".home").addClass("selected");
				$("#loginRegister").addClass("hiddenSection");
			},
			error : function(errorMessage){
				console.log("errorMessage.responseText AJAX");
				$("#datosIncorrectos").show();
			}

		});
	}
}

//-----------------------------------registerUserFunction
function registerUserFunction () 
{	
	if ($("#nombreRegister").val() == "" || 
		$("#apellidoRegister").val() == "" || 
		$("#emailRegister").val() == "" ||
		$("#passwordRegister").val() == "" ||
		$("#ConfirmaPasswordRegister").val() == ""
		)
	{
		$("#camposVaciosRegister").show();
	}
	else
	{
		if($("#passwordRegister").val() != $("#ConfirmaPasswordRegister").val())
		{
			$("#camposVaciosRegister").hide();
			console.log("Passwords no coinciden");
			$("#passwordsError").show();
		}
		else
		{
			$("#camposVaciosRegister").hide();
			$("#passwordsError").hide();

			var jsonObject = {
		        "nombre" : $("#nombreRegister").val(),
		        "apellido" : $("#apellidoRegister").val(),
		        "email" : $("#emailRegister").val(),
		        "password" : $("#passwordRegister").val(),
		        "accion" : "REGISTER"
		    };

		    $.ajax({
		        type: "POST",
		        url: "data/applicationLayer.php",
		        data : jsonObject,
		        dataType : "json",
		        contentType : "application/x-www-form-urlencoded",
		        success: function(jsonData) {
		            console.log("Register User Success");  
		            $(".loginRegister").removeClass("selected")
									.removeClass("currentSection");

					$("#home").addClass("currentSelection")
							.removeClass("hiddenSection");

					$(".home").addClass("selected");

					$("#loginRegister").addClass("hiddenSection");
		           
		        },
		        error: function(errorMsg){
		            console.log("errorMsg.statusText");
		        }
		    });
		}
	}
}




//----------------------------------------------
function sessionActiva()
{	

	var jsonObject2 = 	{
							"accion2" : "SESSION"
						};

	$.ajax({
		type: "POST",
        url: "data/applicationLayer.php",
        data : jsonObject,
        dataType : "json",
        contentType : "application/x-www-form-urlencoded",
        success: function(jsonData) {
        	console.log("success session JS");
           	$("#userHome").text(sessionJson.nombre + " " + sessionJson.apellido);  
           	
        },
        error: function(errorMsg){
        	console.log("session error");
        }
	});

}

//--------------------Agrega Libro Function------------------------------
function agregarLibroFunction()
{
	if ($("#tituloNuevoLibro").val() == "" ||
		$("#nombreAutorNuevoLibro").val() == "" ||
		$("#apellidoAutorNuevoLibro").val() == "" ||
		$("#generoNuevoLibro").val() == "" ||
		$("#anioNuevoLibro").val() == "")
	{
		console.log("Campos vacios");
	}
	else
	{
		var jsonObject = {
		        "titulo" : $("#tituloNuevoLibro").val(),
		        "nombreAutor" : $("#nombreAutorNuevoLibro").val(),
		        "apellidoAutor" : $("#apellidoAutorNuevoLibro").val(),
		        "genero" : $("#generoNuevoLibro").val(),
		        "anio" : $("#anioNuevoLibro").val(),
		        "accion" : "REGISTERLIBRO"
		    };

		$.ajax({
		        type: "POST",
		        url: "data/applicationLayer.php",
		        data : jsonObject,
		        dataType : "json",
		        contentType : "application/x-www-form-urlencoded",
		        success: function(jsonData) {
		            console.log("Register Libro Success");  
		           
		        },
		        error: function(errorMsg){
		            console.log("errorMsg.statusText");
		        }
		});
	}
}

//--------------------------see Database info-------

/*function seeDB(){
	console.log("see DB");

	$.ajax({
		url : "data/librosDB.php",
		type : "POST",
		dataType : "json",
		contentType : "application/x-www-form-urlencoded",
		success : function(conversionData){

				console.log("CRACK conversiones DB Jquer");
					
				var listConversion = "";

				for(let conversionVar of conversionData ) {

					listConversion = "nombre: " +
									conversionVar.name + '<br/>' +
					" add :" +		conversionVar.addition + '<br/>' +
					" subs :" +		conversionVar.substract + '<br/>' +
					" tiims :" +	conversionVar.tiimes + '<br/>' +
					" divide :" +	conversionVar.divide +'<br/>';

					$("#librosId").append(listConversion);
				}

				
				

			},
			error : function(errorMessage){
				console.log("la saco muerta el doctor");
				//alert(errorMessage.responseText);
			}

		});
}*/