	<div id="crear-usuarios-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span >&times;</span>
				</button>
				
				<h2 class="col-sm-12">Formulario de Registro de Nuevos Usuarios</h2>
				{!! Form::open([
					'url'            => 'usuarios/registrar', 
					'accept-charset' => 'UTF-8',
					'class'          => 'form',
					'id'             => 'form-registrar',
					'method'         => 'post',
					'name'           => 'form-registrar',
					'role'           => 'form',
				]) !!}
					<div class="row">
					{!! Form::bsText('first_name', '', [
						'label'       => 'Nombre',
						'placeholder' => '',
						'title'       => 'Nombre',
						'required'    => 'required',
						'data-toggle' => 'tooltip',
						'class_cont'  => 'col-sm-6'
					]) !!}

					{!! Form::bsText('last_name', '', [
						'label'       => 'Apellido',
						'placeholder' => '',
						'title'       => 'Apellido',
						'required'    => 'required',
						'data-toggle' => 'tooltip',
						'class_cont'  => 'col-sm-6'
					]) !!}
					</div>

					<div class="row">
					<div class="form-group col-sm-6">
						<label for="cedula_input" class="requerido">C&eacute;dula o Rif</label>
						<input id="cedula" name="cedula" type="hidden" value="" />
						
						<div class="input-group">
							<div class="input-group-btn">
								<button id="nacionalidad" type="button" class="btn green dropdown-toggle" data-toggle="dropdown">
									<span>V</span>
									<i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu">
									@foreach(['V', 'E', 'J', 'G'] as $nacionalidad)
									<li>
										<a href="javascript:nacionalidad('{{ $nacionalidad }}');"> {{ $nacionalidad }} </a>
									</li>
									@endforeach
								</ul>
							</div>
							<input id="cedula_input" class="cedula form-control" 
								required type="text" value="" 
								data-toggle="tooltip"
								title="RIF/C.I del Cliente ejemplo: V15467845, J854575640, E8897547" />
						</div>
					</div>

					{!! Form::bsText('phone_number', '', [
						'label'       => 'Numero de Telefono',
						'placeholder' => '',
						'title'       => 'Ejm: 0414-890-9876',
						'required'    => 'required',
						'data-toggle' => 'tooltip',
						'class_cont'  => 'col-sm-6'
					]) !!}
					</div>
					<div class="row">
					{!! Form::bsText('email', '', [
						'label'       => 'Correo Electronico',
						'placeholder' => '',
						'title'       => 'Ejm: usuario@gmail.com',
						'required'    => 'required',
						'data-toggle' => 'tooltip',
						'class_cont'  => 'col-sm-6'
					]) !!}
					
					{!! Form::bsPassword('password', '', [
						'label'       => 'Contraseña',
						'placeholder' => '',
						'title'       => 'Contraseña',
						'required'    => 'required',
						'data-toggle' => 'tooltip',
						'class_cont'  => 'col-sm-6',
					]) !!}
					</div>
					<div class="col-xs-12">
						<span id="helpBlock" class="help-block">La contraseña debe contener al menos una letra en Mayúscula, una letra en Minúscula, al menos un número.</span>
					</div>
					<div class="col-sm-12" style="margin-top: 20px">
						<label for="aceptar">
							<input id="aceptar" name="aceptar" type="checkbox" value="1" /> 
							Estoy de acuerdo con las condiciones y uso de 
							<a href="{{ url('legal') }}" target="_blank">alfalibros.com</a>
						</label>
					</div>

					<div class="col-sm-12 text-center" style="margin-top: 40px">
						<button type="submit" class="btn btn-primary">Registrarme</button>
						<span class="btn btn-danger cancelar" data-dismiss="modal"> Cancelar</span>
					</div>
					
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@push('js')
<script type="text/javascript">
$(function(){
	$.mask.definitions['R']='[JGVEjgve]';
	$(".cedula").mask("999999?999");

	$('#cedula_input').on('blur',function(){
		 nacionalidad($("#nacionalidad span").text());
	});
});

function nacionalidad(nac){
	nac = nac || $("#nacionalidad span").text();
	$("#nacionalidad span").text(nac);
	$("#cedula").val(nac + $("#cedula_input").val());
}
</script>
@endpush