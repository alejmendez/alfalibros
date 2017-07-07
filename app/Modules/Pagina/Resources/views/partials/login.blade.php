	<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog" style="width: 350px;">
			<div class="loginmodal-container">
								
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span >&times;</span>
				</button>
				
				<h1>Iniciar sesi&oacute;n</h1><br>
				{!! Form::open([
					'url'            => 'login', 
					'accept-charset' => 'UTF-8',
					'class'          => 'form',
					'id'             => 'login-form',
					'method'         => 'post',
					'name'           => 'login-form',
					'role'           => 'form',
				]) !!}
					<div class="form-group">
						<label for="login-usuario">Correo Electr&oacute;nico</label>
						<input id="login-usuario" name="usuario" class="form-control" placeholder="" required="" type="text" title="Usuario" data-toggle="tooltip"/>
					</div>
					<div class="form-group">
						<label for="login-password">Contrase&ntilde;a</label>
						<input id="login-password" name="password" class="form-control" placeholder="" required="" type="password" title="Contraseña" data-toggle="tooltip">
						<div class="help-block text-right">
							<a href="{{ route('pag.usuarios.recuperar.clave') }}">&iquest; Olv&iacute;daste de la contrase&ntilde;a ?</a>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block" type="submit">Aceptar</button>
					</div>
					<div class="checkbox">
						<label><input id="recordar" type="checkbox" name="recordar" value="1" /> Mantenme conectado</label>
					</div>
				{!! Form::close() !!}
				<div class="login-help">
					<div class="bottom text-center">
						&iquest; Eres Nuevo ? <a href="#" data-toggle="modal" data-target="#crear-usuarios-modal"><b>&Uacute;nete a nosotros</b></a>
					</div>
				</div>
			</div>
		</div>
	</div>