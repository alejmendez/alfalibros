<!--shopping cart-->
<div class="relative f_right dropdown_2_container shoppingcart">
	<button class="icon_wrap_size_2 color_grey_light circle tr_all">
		<i class="icon-basket color_grey_light_2 tr_inherit"></i>
	</button>
	<div class="dropdown_2 bg_light shadow_1 tr_all p_top_0">
		<div class="sc_header bg_light_2 fs_small color_grey">
			Item(s) agregados recientemente
		</div>
		<ul class="added_items_list">
		<?php
		$impuesto = 0;
		$descuento = 0;
		$total = 0;
		?>
			@foreach(\Cart::content() as $producto)
			<?php
			$total += $producto->qty * $producto->price;
			?>
			<li id="{{ $producto->rowId }}" class="clearfix lh_large m_bottom_20 relative">
				<a href="#" class="d_block f_left m_right_10">
					<img src="{{ $controller->urlphppos('app_files/view/' . $producto->options->imagen) }}" alt="" style="max-width: 20px;" />
				</a>
				<div class="f_left item_description lh_ex_small">
					<a href="#" class="color_dark fs_medium d_inline_b m_bottom_3">{{ $producto->name }}</a>
					<p class="color_grey_light fs_small">Codigo del Producto {{ $producto->id }}</p>
				</div>
				<div class="f_right fs_small lh_medium d_xs_none">
					<span class="color_grey">{{ $producto->qty }} x </span>
					<span class="color_dark">Bs. {{ number_format(floatval($producto->price), 2, ',', '.') }}</span>
				</div>
				<i class="icon-cancel-circled-1 color_grey_light_2 fs_large color_dark_hover tr_all"></i>
			</li>
			@endforeach
		</ul>
		<div class="total_price bg_light_2 t_align_r fs_medium m_bottom_15">
			<ul>
				<li class="color_dark">
					Impuesto: 
					<span class="d_inline_b m_left_15 price t_align_l">
						Bs. {{ number_format(floatval($impuesto), 2, ',', '.') }}
					</span>
				</li>
				<li class="color_dark">
					Descuento: 
					<span class="d_inline_b m_left_15 price t_align_l">
						Bs. {{ number_format(floatval($descuento), 2, ',', '.') }}
					</span>
				</li>
				<li class="color_dark">
					<span class="fw_ex_bold">Total:</span> 
					<span class="fw_ex_bold d_inline_b m_left_15 price t_align_l color_pink">
						Bs. {{ number_format(floatval($total), 2, ',', '.') }}
					</span>
				</li>
			</ul>
		</div>
		<div class="clearfix border_none p_top_0 sc_footer">
			<a href="#" class="button_type_5 d_block color_pink transparent f_right r_corners tr_all fs_medium m_left_5">Comprar</a>
			<a href="{{ url('carrito') }}" class="button_type_5 d_block color_dark f_right r_corners color_pink_hover tr_all fs_medium">Ver Compras</a>
		</div>
	</div>
</div>