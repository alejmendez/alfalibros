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
					{!! Form::bsText('account_number', '', [
						'label'       => 'Cedula',
						'placeholder' => '',
						'title'       => 'Ejm: V12345678',
						'required'    => 'required',
						'data-toggle' => 'tooltip',
						'class_cont'  => 'col-sm-6'
					]) !!}

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