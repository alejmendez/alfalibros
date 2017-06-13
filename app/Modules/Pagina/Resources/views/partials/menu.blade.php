<nav class="navbar navbar-fixed-top navbar-inverse">
	<div class="container-fluid">
		<div class="collapse navbar-collapse">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand div-white" href="{{ route('pag.index') }}">
					<i class="fa fa-home w3-margin-right"></i>
					Alfalibros
				</a>
			</div>

			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							Libros <span class="caret"></span>
						</a>
						
						<ul class="dropdown-menu">
						@foreach ($categorias as $categoria)
							<li class="dropdown-submenu">
								<a href="#">{{ ucwords(strtolower($categoria->name)) }} ({{ $categoria->cantidad }}) <span class="caret"></span> </a>
								@if (count($categoria->hijos) > 0)
								<ul class="dropdown-menu">
								@foreach ($categoria->hijos as $subcategoria)
									<li>
										<a href="{{ url('categoria/' . $subcategoria->id) }}">{{ ucwords(strtolower($subcategoria->name)) }} ({{ $subcategoria->cantidad }})</a>
									</li>
								@endforeach
								</ul>
								@endif
							</li>
						@endforeach
						</ul>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if ($autenticado)
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								
								{{ $usuario->persona->first_name }}
								
							</a>
							
							<ul class="dropdown-menu">
								<li><a href="{{ url('compra/ver') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Ver Compras</a></li>
								<li><a href="{{ url('notificaciones') }}"><i class="fa fa-bell" aria-hidden="true"></i> Notifiaciones</a></li>
								<li><a href="{{ url('favoritos') }}"><i class="fa fa-heart" aria-hidden="true"></i> Favoritos</a></li>
								<li><a href="{{ url('salir') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a></li>
							</ul>
						</li>
					@else
						<li class="dropdown">
							<a href="#" data-toggle="modal" data-target="#login-modal"><b>Login</b></a>
						</li>
					@endif
				</ul>
			</div><!-- /.nav-collapse -->
		</div>
	</div><!-- /.container -->
</nav><!-- /.navbar -->