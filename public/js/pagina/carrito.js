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

Vue.component('carrito-table', {
	template: '#carrito-template',
	props: {
		carrito: Array
	},
	methods: {
		eliminar: function (rowid, id) {
			app.eliminar(rowid, id);
		}
	},
	computed: {
		total: function () {
			var total = 0, cantidad = 0;

			for (var i in this.carrito) {
				total += (this.carrito[i].qty * this.carrito[i].price);
			}
			
			total = number_format(total, 2, ',', '.');

			$("#carritoTotal").html(total);
			$("#cantidadProductor").html(this.carrito.length);
			return total;
		}
	},
});

var app = new Vue({
	el: '#app-carrito',
	data: {
		carrito: []
	},
	methods: {
		actualizar: function (event) {
			var t = this;
			$.ajax({
				url: $url + 'recargar',
				data: {
					carrito : app.$data.carrito
				},
				type: 'post',
				success: function(r) {
					console.log(r);
					t.$data.carrito = r.carrito;
					if (r.errores == ''){
						aviso('Actualización Completa', true);
					} else {
						aviso(r.errores);
					}
				}
			});
		},
		eliminar: function (rowid, id) {
			var t = this;
			$.ajax({
				url: $url + 'eliminar/' + rowid,
				type: 'DELETE',
				success: function(r) {
					console.log(r);
					t.$data.carrito = r;
				}
			});
		},
		comprar: function (event) {
			var t = this;

			if (t.$data.carrito.length == 0) {
				return;
			}

			$.ajax({
				url: $url + 'comprar',
				data: {
					carrito : app.$data.carrito
				},
				type: 'post',
				success: function(r) {
					if (typeof(r) == 'string') {
						//alert(r);
					}

					if (r.errores) {
						alert(r.errores);
						return;
					}
					
					if (r.codigo){
						location.href = $urlApp + 'compra/ver/' + r.codigo;
					}
				}
			});
		}
	}
});