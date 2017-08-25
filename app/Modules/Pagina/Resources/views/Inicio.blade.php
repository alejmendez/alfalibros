@extends('pagina::layouts.micro')
@section('content')
	<!--libros a la venta-->
    <div class="block-items" style="margin: 0px;">
	    <div class="container" style="padding-top: 0px;">
	        
	        <ul class="row mjob-list">
	        	@foreach ($productos->chunk(4) as $_productos)
					@foreach ($_productos as $producto)

		        		<?php
							$enCarrito = $carrito->where('id', $producto->id)->count() > 0;
						?>
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-mobile-12">
			                <div class="mjob-item">
			                    <div class="mjob-item__image libros-fondo" style="width: 262px;height: 160px; background-image:url('{{ $controller->urlphppos('app_files/view/' . $producto->imagen) }}')">
			                    </div>
			                    <!-- end .mjob-item__image -->
			                    <div class="mjob-item__entry">
			                        <div class="mjob-item__title">
			                            <h2 class="trimmed" title="{{ preg_match('/libros/i', $producto->nombre) ? substr($producto->nombre, strrpos($producto->nombre, ',') + 1) : $producto->nombre }}">
			                                <a href="{{ route('pag.producto', ['id' => $producto->id]) }}">
			                                	{{ str_limit(preg_match('/libros/i', $producto->nombre) ? 
												substr($producto->nombre, strrpos($producto->nombre, ',') + 1) : 
												$producto->nombre, 30) }}
			                                </a>
			                            </h2>
			                        </div>
			                        <!-- end .mjob-item__title -->
			                        <div class="mjob-item__author">
			                            <span>
			                            	<a href="">
			                            		#{{ $producto->categoria }}	
			                            	</a>
			                            </span>
			                        </div>
			                        <!-- end .mjob-item__author -->
			                        <div class="mjob-item__price">
			                            <div class="mjob-item__price-inner">
			                                <span class="starting-text customize-color">Precio:</span>
			                                <span class="price-text customize-color"><span title="{{ number_format(floatval($producto->precio), 2, ',', '.') }}">
			                                	<span class="mje-price">
			                                		<sup>Bs.</sup>{{ number_format(floatval($producto->precio), 2, ',', '.') }}
			                                	</span>
			                                	</span>
			                                </span>
			                            </div>
			                        </div>
			                        <!-- end .mjob-item__price -->
			                        <div class="mjob-item__bottom clearfix">
			                            
			                            <span class="can_is_verified">
			                            	<input type="number" name="cantidad" class="form-control" value="1" min="1" max="{{ intval($producto->cantidad) }}" {!! $enCarrito ? 'disabled="disabled"' : '' !!} />
			                            </span>
			                            <div class="mjob-item__rating" style="width: 100%;">
			                               <button data-producto="{{ $producto->id }}" class="btn btn-success btn-comprar" {!! $enCarrito ? 'disabled="disabled"' : '' !!}>
												<i class="fa fa-shopping-cart"></i> Agregar
											</button>

											<button data-producto="{{ $producto->id }}" class="btn btn-danger btn-cancelar-comprar {!! !$enCarrito ? 'hide' : '' !!}" {!! !$enCarrito ? 'disabled="disabled"' : '' !!}>
												<i class="fa fa-remove"></i>
											</button>
			                            </div>
			                            <!-- end .mjob-item__ratings -->
			                        </div>
			                    </div>
			                </div>
			            </li>
		            @endforeach
	        	@endforeach
	        	<div class="row">
					<div class="col-md-12" style="text-align: center;">
						{{ $productos->links() }}
					</div>
				</div>
	        </ul>
	    </div>
	</div>

	<!-- fin de libros a la venta-->
    <div class="block-intro">
	    <div class="container">
	        <p class="block-title float-center">SOBRE LOS LIBROS EN VENTA</p>
	        <ul>
	            <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12 clearfix wow fadeInUp block-intro-1">
	                <div class="icon-article pull-left">
	                    <img src="{{ url('public/img/microjob/icon-intro-1.png')}}" alt="">
	                </div>
	                <div class="text-article pull-right">
	                    <h5><a href="#" class="title">Effortless shopping</a></h5>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque dicta dolorem odit optio placeat praesentium quos reiciendis reprehenderit soluta ullam?</p>
	                </div>
	            </li>
	            <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12 clearfix wow fadeInUp block-intro-2">
	                <div class="icon-article pull-left">
	                    <img src="{{ url('public/img/microjob/icon-intro-2.png')}}" alt="">
	                </div>
	                <div class="text-article pull-right">
	                    <h5><a href="#" class="title">Consigue tu libro de preferencia</a></h5>
	                    <p>A través de nuestras categorías podras ubicar los libros correspondientes y te hacemos más facil la forma de buscarlos.</p>
	                </div>
	            </li>
	            <li class="col-lg-4 col-md-4 col-sm-12 col-xs-12 clearfix wow fadeInUp block-intro-3">
	                <div class="icon-article pull-left">
	                    <img src="{{ url('public/img/microjob/icon-intro-3.png')}}" alt="">
	                </div>
	                <div class="text-article pull-right">
	                    <h5><a href="#" class="title">Paid highly</a></h5>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque dicta dolorem odit optio placeat praesentium quos reiciendis reprehenderit soluta ullam?</p>
	                </div>
	            </li>
	        </ul>
	        <div class="load-more float-center">
	            <a href="#" class="hvr-wobble-vertical">BUSCAR MÁS<i class="fa fa-angle-right"></i></a>
	        </div>
	    </div>
	</div>
@endsection

@push('css')
<style type="text/css">
	.libros-fondo{
		background-position: center center;
		background-repeat:  no-repeat;
		background-size:  cover;
		background-color: #999;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
</style>
@endpush