window.onload = function () {
	var formRegistro = document.registro;
	var formLogin = document.login;
	var imgContra = document.getElementById('imgContra');
	var boton = document.querySelector(".btncontra");
	var imgRepContra = document.getElementById('repImgContra');
		
	if(formRegistro != undefined) {

		var repboton = document.querySelector(".repbtncontra");
		var Elementos = formRegistro.elements;
		for (var i = 0; i < Elementos.length; i++) {
			if (Elementos[i].type == "text" || Elementos[i].type == "email" || Elementos[i].type == "number") {
				Elementos[i].onkeypress = restringir;
			}
		}
		document.getElementById('formulario').addEventListener('submit', validarFormulario); 

		boton.addEventListener("click", clickBtnContra);
		repboton.addEventListener("click", clickBtnRepContra);
	} else {
		boton.addEventListener("click", clickBtnContraLogin);
	}


	
	

	/*Funciones cambiar imagen de contraseña*/
	function clickBtnContra(event) {
		if (formRegistro.password.type == "password") {
			formRegistro.password.type = "text";
			imgContra.src = "img/ver.png";
		}else {
			formRegistro.password.type = "password";
			imgContra.src = "img/no-ver.png";
		}
	}

	function clickBtnRepContra(event) {
		if (formRegistro.reppassword.type == "password") {
			formRegistro.reppassword.type = "text";
			imgRepContra.src = "img/ver.png";
		}else {
			formRegistro.reppassword.type = "password";
			imgRepContra.src = "img/no-ver.png";
		}
	}

	function clickBtnContraLogin(event) {
		if (formLogin.password.type == "password") {
			formLogin.password.type = "text";
			imgContra.src = "img/ver.png";
		}else {
			formLogin.password.type = "password";
			imgContra.src = "img/no-ver.png";
		}
	}

}

function restringir(event) {
	var letra = String.fromCharCode(event.charCode);
	var caracteresPermitidos = "";
	switch(this.type){
		case "text":
			caracteresPermitidos = "abcdefghikjlmnopqrstuvwxyzABCDEFGHIKJLMNOPQRSTUVWXYZáéíóúÁÉÍÓÚ ";
			break;
		case "number":
			caracteresPermitidos = "0123456789";
			break;
		case "email":
			caracteresPermitidos = "abcdefghikjlmnopqrstuvwxyz0123456789@-+.ABCDEFGHIKJLMNOPQRSTUVWXYZ";
			break;
	}
	var pos = caracteresPermitidos.indexOf(letra);
	return pos != -1;
}

function validarFormulario(e) {
	e.preventDefault();
	var nombre = this.nombre.value;
	var apellido = this.apellido.value;
	var contra = this.password.value;
	var repcontra = this.reppassword.value;

	var expValida = /^[ÁÉÍÓÚA-Z]?[a-záéíóú]+(\s+[ÁÉÍÓÚA-Z]?[a-záéíóú]+)*$/;
	if (!expValida.test(nombre)){
		document.getElementById("alertaNombre").innerHTML = "Ingrese un nombre válido";
		return false;
	}else {
		document.getElementById("alertaNombre").innerHTML = "";
	}

	if (!expValida.test(apellido)){
		document.getElementById("alertaApellido").innerHTML = "Ingrese un apellido válido";
		return false;
	}else {
		document.getElementById("alertaApellido").innerHTML = "";
	}

	if (contra.length < 7){
		document.getElementById("alertaContra").innerHTML = "La contraseña debe ser de mínimo 7 caracteres";
		return false;
	}else {
		document.getElementById("alertaContra").innerHTML = "";
	}

	if (contra != repcontra){
		document.getElementById("alertaRepContra").innerHTML = "Las contraseñas no coinciden";
		return false;
	}else {
		document.getElementById("alertaRepContra").innerHTML = "";
	}


	/*Crear el usuario en la base de datos*/


	this.submit();
}
