window.onload = function() {
	const carritoContainer = document.getElementById('carrito-container');
	const bCarrito = document.getElementsByClassName('btn-carrito');

	bCarrito[0].onclick = funt;

	function funt ()
	{
		if (carritoContainer.style.display == 'block') {
			carritoContainer.style.display = 'none';

		} else {
			carritoContainer.style.display = 'block';
			actCarritoUI();
		}
	}

	function actCarritoUI(){
		fetch('http://localhost/Proyectofinal/carrito-fun.php?action=mostrar')
		.then(response => response.json())
		.then(data => {
			let tablaCont = document.querySelector('#tabla');
			let precioTotal = '';
			let html = '';

			data.items.forEach(element => {
				console.log(element);
				switch (parseInt(element.oferta)) {
					case 0:
						p = parseFloat(element.precio)*1000;
						precio = formatoMexico(p);
						break;
					
					default:
						p = parseFloat(element.precio)*1000*((100-parseFloat(element.oferta))/100);
						precio = formatoMexico(p);
						break;
				}

				sub = formatoMexico(element.subtotal.toFixed(2));

				html += "<div class='row carrito-item'><input type='hidden' value="+element.id+" /><input type='hidden' value="+element.tabla+" /><img src="+element.imagen+" class='col-md-4'><div class='col col-md-8'><h5>"+element.nombre+"</h5><p>"+element.cantidad+" items de $"+precio+"</p><p>Subtotal $"+sub+"</p><button class='btn-remove'>Quitar 1 del carrito</button></div></div>";
			});

			precioTotal = "<p>Total: $"+formatoMexico(data.info.total.toFixed(2))+"</p>";
			tablaCont.innerHTML = html + precioTotal;

			buttons = document.getElementsByClassName('btn-remove');

			for (var i = 0; i < buttons.length; i++) {
				buttons[i].onclick = function() {
					const id = this.parentElement.parentElement.children[0].value;
					const tabla = this.parentElement.parentElement.children[1].value;
					console.log(this.parentElement.parentElement);
					removeItemFromCarrito(id, tabla);
				}
			}
			
		});

	}

	const add_btn = document.getElementById('btn-add');

	if (add_btn != null) {
		add_btn.onclick = function() {
			const id = this.parentElement.parentElement.parentElement.parentElement.children[0].value;
			console.log(id);
			const tabla = this.parentElement.parentElement.parentElement.parentElement.children[1].value;
			console.log(tabla);
			fetch('http://localhost/Proyectofinal/carrito-fun.php?action=add&id='+ id + '&s='+tabla);
		}
	}



	function removeItemFromCarrito(id, tabla) {
		fetch('http://localhost/Proyectofinal/carrito-fun.php?action=remove&id=' + id + '&s=' + tabla)
		.then(response => response.json())
		.then(data => {
			actCarritoUI();
		});
	}

	const formatoMexico = (number) => {
	  const exp = /(\d)(?=(\d{3})+(?!\d))/g;
	  const rep = '$1,';
	  let arr = number.toString().split('.');
	  arr[0] = arr[0].replace(exp,rep);
	  return arr[1] ? arr.join('.'): arr[0];
	}
}