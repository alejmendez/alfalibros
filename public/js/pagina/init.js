$.ajaxSetup({
	headers: { 'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content') },
	complete : ajaxComplete,
	cache: false
});

function ajaxComplete(x,e,o){
	switch(x.status){
		case 401:
			location.reload();
			//alert('Session Caducada, ');
			break;

		case 404:
			alert('No se encontro lo solicitado');
			break;

		case 422:
			if (x.responseJSON){
				var msj = '';
				
				$.each(x.responseJSON, function(id, valor){
					for (var i = 0; i < valor.length; i++) {
						msj += valor[i] + "\n";
					}
				});

				alert(msj, false, 'Error de validaci&oacute;n');
			}
			break;
		case 500:
			alert('Se genero un error interno del servidor');
			break;
	}
};

$(function(){
	Pace.options = {
		ajax: true
	};

	PNotify.prototype.options.styling = "fontawesome";

	$("#login-form").submit(function(e){
		e.preventDefault();
		var form = $(this);
		$.post(form.attr('action'), form.serialize(), function(r){
			aviso(r);
			if (r.s) {
				location.href = $url.replace(/\/+$/,'');
			}
		});
	});

	$('#form-registrar').submit(function(e){
		e.preventDefault();

		var form = $(this);
		$.post(form.attr('action'), form.serialize(), function(r){
			$("#crear-usuarios-modal").modal('hide');
			alert(r);
		});
	});

	$(".btn.btn-comprar").click(function(e){
		e.preventDefault();

		var t = $(this),
			producto = t.data('producto'),
			cantidad = t.parent().parent().find("input[name='cantidad']").val();

		agregarCarrito(producto, cantidad);
	});

	$(".btn.btn-cancelar-comprar").click(function(e){
		e.preventDefault();
		var t = $(this), producto = t.data('producto');
		eliminarCarrito(producto);
	});

	$(".added_items_list").on('click', '.icon-cancel-circled-1', function(){
		eliminarCarrito($(this).parent().attr('id'));
	});

	$("#form-login").submit(function(e){
		e.preventDefault();
		$("#login_submit").prop("disable", true);
		
		$.ajax($url + 'backend/login/validar', {
			method : 'post',
			data: {
				usuario : $("#login_user").val(),
				password : $("#login_password").val(),
				recordar : $("#login_remember").val(),
			},
			success: function(r){
				if (r.s === "n"){
					$("#login_submit").prop("disable", false);

					aviso('No se puedo Autenticar');

					return false;
				}

				if (r.s === "s"){
					//location.reload();
					location.href = $url.replace(/\/+$/,'');
				}
				
				return false;
			}
		});
	});

	$('.dropdown-submenu a.adrop').on("click", function(e){
		$(this).next('ul').toggle();
		e.stopPropagation();
		e.preventDefault();
	});

	$('[data-toggle="tooltip"]').tooltip();

	$("#btn-sign-in").click(function(evt) {
		evt.preventDefault();
		$('#login-modal').modal('show');
	});
});

function _agregarCarrito($id, $cantidad) {
	$.ajax($urlApp + 'carrito/agregar/' + $id, {
		method : 'post',
		data: {
			cantidad : $cantidad
		},
		error: function(jqXHR, textStatus, errorThrown){
			aviso(jqXHR.responseJSON, false);
			bloquearProducto($id, false);
		},
		success: function(r){
			if (r == '0'){
				return false;
			}

			//aviso('Agregado a tu Carrito de Compras el Articulo (' + $id + ')', true);

			actualizarCarrito(r);
		}
	});
}

function agregarCarrito($id, $cantidad) {
	$cantidad = $cantidad || 1;
	$cantidad = parseInt($cantidad);

	var btn = bloquearProducto($id, true),
		input = btn.parent().parent().find("input[name='cantidad']"),
		max = parseInt(input.attr('max'));

	if ($cantidad > max) {
		bootbox.confirm({ 
			title: "Alfalibros.com",
			message: "Solo tenemos disponible " + max + " &iquest;Desea comprar los " + max + "?", 
			callback: function(result) {
				if (!result){
					input.val(1);
					bloquearProducto($id, false);
					return;
				}

				input.val(max);
				_agregarCarrito($id, max);
			}
		});

		return;
	}

	_agregarCarrito($id, $cantidad);
}

function eliminarCarrito($id) {
	bloquearProducto($id, false);

	$.ajax($urlApp + 'carrito/eliminar/' + $id, {
		method : 'delete',
		error: function(jqXHR, textStatus, errorThrown){
			aviso(jqXHR.responseJSON, false);
			bloquearProducto($id, true);
		},
		success: function(r){
			//aviso('Eliminado de tu Carrito de Compras el Articulo');
			actualizarCarrito(r);
		}
	});
}

function bloquearProducto(id, bloquear){
	var btn = $("button.btn-comprar[data-producto='" + id + "']"),
		btnCancel = $("button.btn-cancelar-comprar[data-producto='" + id + "']");

	if (btn.length){
		btn.prop('disabled', bloquear);
		if (bloquear){
			btnCancel.removeClass('hide');
		} else {
			btnCancel.addClass('hide');
		}
		btnCancel.prop('disabled', !bloquear);
		btn.parent().parent().find("input[name='cantidad']").prop('disabled', bloquear);

		return btn;
	}
}

function actualizarCarrito($carrito) {
	var $html = "",
		$impuesto = 0,
		$descuento = 0,
		$totalArticulos = 0,
		$total = 0;

	for (var i in $carrito) {
		$totalArticulos += parseInt($carrito[i].qty);
		$total += $carrito[i].qty * $carrito[i].price;
	}
	
	$("#cantidadProductor").html($totalArticulos);
	$("#carritoTotal").html(number_format($total, 2, ',', '.'));
}

var stack_bottomright = { "dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25 };

function aviso(msj, t, titulo){
	var _msj = msj, tipo = t, titulo = titulo || 'Alfalibros.com', timeout = 8000;
	if (typeof(msj) === 'object'){
		_msj = msj.msj || '';
		t = typeof(msj.s) == 'string' ? msj.s == 's' : msj.s;
	}
	
	if (_msj === undefined || _msj === ''){
		console.log("llamada a 'aviso' sin msj");
		return;
	}
	
	if (t === true){
		tipo = 'success';
	}else if (t === false){
		tipo = 'error';
	}

	countWords = 0;

	s = _msj.replace(/(^\s*)|(\s*$)/gi,"");//exclude  start and end white-space
    s = s.replace(/[ ]{2,}/gi," ");//2 or more space to 1
    s = s.replace(/\n /,"\n"); // exclude newline with a start spacing
    countWords = s.split(' ').length;
    _timeout = countWords * 500;
	if (_timeout > timeout) {
		timeout = _timeout;
		console.log(timeout);
	}
	
	var notice = new PNotify({
		title: titulo,
		text: _msj,
		type: tipo,
		hide: true,
		delay: timeout,
		mouse_reset: true,
		addclass: "stack-bottomright",
		stack: stack_bottomright,
		animate: {
			animate: true,
			in_class: 'zoomInLeft',
			out_class: 'zoomOutRight'
		}
	});

	notice.get().click(function() {
		//notice.remove();
	});

	setTimeout(function(){
		//notice.remove();
	}, timeout);
}

function number_format (number, decimals, decPoint, thousandsSep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep,
		dec = (typeof decPoint === 'undefined') ? '.' : decPoint,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec)
			return '' + (Math.round(n * k) / k).toFixed(prec)
		};

	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');

	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}

window.alert = function(msj) {
	bootbox.alert({ 
		//size: "small",
		title: "Alfalibros.com",
		message: msj, 
		//callback: function(){ /* your callback code */ }
	});
};