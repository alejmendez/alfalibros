@extends('pagina::layouts.default')

@section('content')
<div class="row">
	@include('pagina::partials.side-menu-left')
	<div class="col-md-9 col-sm-12 div-round div-card div-white">
		@if ($autenticado)
			@include('pagina::partials.pasos-compra')
			<div class="row">
				<div class="col-xs-12">
					<button id="imprimir" type="button" class="btn btn-primary btn-imprimir" style="float: right;" data-toggle="modal" data-target="#cotizacionModal">
						<i class="fa fa-print" aria-hidden="true"></i> Imprimir Factura
					</button>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 text-center confirmado">
					<br>
					<i class="fa fa-check fa-5x"></i>
					<br>
					Confirmado
					<br> <br>
					<p class="text-center">
						Acabas de confirmar tu compra, nuestro personal estará verificando la información, esto puede tardar algunos minutos.
					</p>
					<br>
				</div>
			</div>
			
		@else
			@include('pagina::partials.no-login')
		@endif
	</div>
</div>

@endsection

@push('css')
	<style type="text/css">
		.portlet {
		    margin-top: 0;
		    margin-bottom: 0px;
		    padding: 0;
		    border-radius: 4px;
		}
		.mt-step-col a{
			text-decoration: none;
		}
		.confirmado{
			color:#00D550;
		}
	</style>
@endpush
@push('js')
<script type="text/javascript">
var $url_paso_4 = "{{ route('pag.compra.ver', [ 'codigo' => $codigo, 'paso' => 4 ]) }}";
	$("#datosBancosModal").modal();
	
	$('#cotizacion').remove();

	$('#form-confirmar').submit(function() { 
		// submit the form 
		$(this).ajaxSubmit({
			success : function(r){
				alert(r);
				
				setTimeout(function(){
					location.href = $url_paso_4;
				}, 3000);
			}
		}); 
		// return false to prevent normal browser submit and page navigation 
		return false; 
	});
</script>
@endpush