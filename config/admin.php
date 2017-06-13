<?php

return [
	'name'            => 'Admin',
	'prefix'          => 'backend',
	'libreriaEntorno' => 'externa', //interna, externa
	'grupos_apps'     => [
		'Base'         => ['base'],
	],
	'librerias' => [
		'externa' => [
			'metronic' => [
				'css' => [
					'metronic/components.min.css',
					'metronic/layout.min.css',
					'metronic/themes/default.min.css',
					'metronic/custom.min.css',
					'metronic/backend.css',
					'metronic/plugins.min.css'
				],
				'js' => [
					'metronic/init_plantilla.js',
					'metronic/init.js',
					'metronic/funciones.js'
				]
			],
			'ie' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js'
				]
			],
			'modernizr' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'
				]
			],
			'OpenSans' => [
				'css' => [
					'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'
				]
			],
			'vue' => [
				'js' => [
					//'https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.common.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js'
				]
			],
			'vuex' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/vuex/2.1.1/vuex.min.js'
				]
			],
			'vue-strap' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/vue-strap/1.1.36/vue-strap.min.js'
				]
			],
			'vue-router' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/vue-router/2.1.3/vue-router.common.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/vue-router/2.1.3/vue-router.min.js'
				]
			],
			'vue-resource' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.common.js',
					'https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js'
				]
			],
			'vue-validator' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/vue-validator/2.1.7/vue-validator.common.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/vue-validator/2.1.7/vue-validator.min.js'
				]
			],
			'jquery' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js'
				]
			],
			'jquery2' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js'
				]
			],
			'jquery-easing' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'
				]
			],
			'jquery-migrate' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.4.1/jquery-migrate.min.js'
				]
			],
			'font-awesome' => [
				'css' => [
					'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css'
				]
			],
			'simple-line-icons' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.3.1/css/simple-line-icons.css'
				]
			],
			'animate' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.css'
				]
			],
			'bootstrap' => [
				'css' => [
					'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
					//'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css'
				],
				'js' => [
					'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'
				]
			],
			'bootbox' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js'
				]
			],
			'bootstrap-datepicker' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js'
				]
			],
			'bootstrap-tagsinput' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css',
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js'
				]
			],
			'bootstrap-fileinput' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.5/css/fileinput.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.5/js/fileinput.min.js'
				]
			],
			'jquery-shortcuts' => [
				'js' => [
					'http://www.stepanreznikov.com/js-shortcuts/jquery.shortcuts.min.js'
				]
			],
			'jquery-cookie' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.2/js.cookie.min.js'
				]
			],
			'jquery-form' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js'
				]
			],
			'blockUI' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js'
				]
			],
			'pace' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/black/pace-theme-flash.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js'
				]
			],
			'pnotify' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.min.css',
					'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.buttons.min.css',
					'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.nonblock.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.buttons.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.nonblock.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.confirm.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.animate.min.js'
				]
			],
			'alphanum' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery.alphanum/1.0.24/jquery.alphanum.min.js'
				]
			],
			'maskedinput' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js'
				]
			],
			'datatables' => [
				'css' => [
					//'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/jquery.dataTables.min.css',
					'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js'
				]
			],
			'jquery-ui' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/themes/flick/jquery-ui.min.css',
					'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/themes/flick/theme.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js'
				]
			],
			'jquery-ui-timepicker' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/jquery-ui-timepicker-addon.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/jquery-ui-timepicker-addon.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/i18n/jquery-ui-timepicker-es.js'
				]
			],
			'ckeditor' => [
				'js' => [
					'https://cdn.ckeditor.com/4.5.9/full/ckeditor.js'
				]
			],
			'jstree' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.1/themes/default/style.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.1/jstree.min.js'
				]
			],
			'jcrop' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/css/jquery.Jcrop.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/js/jquery.Jcrop.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/js/jquery.color.min.js'
				]
			],
			'template' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-JavaScript-Templates/3.4.0/js/tmpl.min.js',
				]
			],
			'file-upload' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/css/jquery.fileupload.min.css',
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/css/jquery.fileupload-ui.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-JavaScript-Templates/3.4.0/js/tmpl.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-load-image/2.6.1/load-image.all.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/js/jquery.fileupload.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/js/jquery.fileupload-process.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/javascript-canvas-to-blob/3.3.0/js/canvas-to-blob.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/js/jquery.iframe-transport.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/js/jquery.fileupload-validate.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/js/jquery.fileupload-ui.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/js/jquery.fileupload-image.min.js'
					//'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/js/jquery.fileupload-audio.min.js',
					//'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.4/js/jquery.fileupload-video.min.js',
				]
			],
			'bootstrap-switch' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap3/bootstrap-switch.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js'
				]
			],
			'highcharts' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.6/highcharts.js',
					'https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.6/highcharts-more.js'
				]
			],
			'highcharts-more' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.6/highcharts-more.js'
				]
			],
			'highcharts-drilldown' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.6/modules/drilldown.js'
				]
			],
			'highcharts-3d' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/highcharts/4.2.6/highcharts-3d.js'
				]
			],
			'highmaps' => [
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/highmaps/4.2.6/modules/map.js',
				]
			],
			'icheck' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js'
				]
			],
			'ladda' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/ladda-bootstrap/0.9.4/ladda-themeless.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/ladda-bootstrap/0.9.4/spin.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/ladda-bootstrap/0.9.4/ladda.min.js'
				]
			],
			'touchspin' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.1/jquery.bootstrap-touchspin.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/3.1.1/jquery.bootstrap-touchspin.min.js'
				]
			],

			'flexslider' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css',
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.min.js',
				]
			],
			'mixitup' => [
				'js' => [
					'jquery.mixitup.js',
				]
			],
			'wow' => [
				'js' => [
					'wow.min.js',
				]
			],
			'placeholdem' => [
				'js' => [
					'placeholdem.min.js',
				]
			],
			'vide' => [
				'js' => [
					'jquery.vide.js',
				]
			],
			'prettyPhoto' => [
				'js' => [
					'jquery.prettyPhoto.js',
				]
			],
			'smooth-scroll' => [
				'js' => [
					'smooth-scroll.js',
				]
			],
			'waypoints' => [

				'js' => [
					'waypoints.min.js',
				]
			],
			'counterup' => [
				'js' => [
					'jquery.counterup.min.js',
				]
			],
			'scroll-top' => [
				'js' => [
					'scroll-top.js',
				]
			],
			'lazyload' => [
				'js' => [
					'jquery.lazyload.js',
				]
			],
			'appear' => [
				'js' => [
					'jquery.appear.js',
				]
			],
			'slicknav' => [
				'js' => [
					'jquery.slicknav.js',
				]
			],
			'owl-carousel'=>[
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css',
					'owl-carousel/css/owl.theme.default.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'
				]
			],
			'magnific-popup'=> [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/magnific-popup.css',
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js',
				]
			],
			'revolution-slider'=> [
				'css' =>[
					'revolution-slider/css/settings.css',
				],
				'js' => [
					'revolution-slider/js/jquery.themepunch.tools.min.js',
					'revolution-slider/js/jquery.themepunch.revolution.min.js',
				]
			],
			'hover'=> [
				'css'=>[
					'https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.0.2/css/hover-min.css',
				]
			],
			'bxslider' => [
				'css'=>[
					'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.css',
				],
				'js'=>[
					'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.js'
				],
			],
			'lightbox'=> [
				'css'=> [
						'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.css',
				],
				'js'=> [
						'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.js',
				],

			],
			'bootstrap-select'=> [
				'css'=> [
						'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/css/bootstrap-select.min.css',
				],
				'js'=> [
						'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/js/bootstrap-select.min.js',
						'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/js/i18n/defaults-es_CL.min.js',
						'bootstrap-select2/js/bootstrap-select.min.js',
				],

			], 
			'bootstrap-colorpicker'=>[
				'css'=>[
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.css',
				],
				'js'=>[
					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/js/bootstrap-colorpicker.js',
				]
			],
			'jasny-bootstrap' => [
				'css' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css'
				],
				'js' => [
					'https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js',
				]
			],
			'components-metronic'=> [
				'css'	=> [
					'metronic/components-rounded.min.css',
				],
			],
		],
		'interna' => [
			'metronic' => [
				'css' => [
					'metronic/components.min.css',
					'metronic/layout.min.css',
					'metronic/themes/default.min.css',
					'metronic/custom.min.css',
					'metronic/backend.css',
					'metronic/plugins.min.css'
				],
				'js' => [
					'metronic/init_plantilla.js',
					'metronic/init.js',
					'metronic/funciones.js'
				]
			],
			'ie' => [
				'js' => [
					'respond.min.js',
					'excanvas.js'
				]
			],
			'OpenSans' => [
				'css' => [
					'OpenSans/OpenSans.css'
				]
			],
			'modernizr' => [
				'js' => [
					'modernizr.min.js'
				]
			],

			'vue' => [
				'js' => [
					//'vue/vue.common.min.js',
					'vue/vue.min.js'
				]
			],
			'vuex' => [
				'js' => [
					'vue/vuex.min.js'
				]
			],
			'vue-strap' => [
				'js' => [
					'vue/vue-strap.min.js'
				]
			],
			'vue-router' => [
				'js' => [
					'vue/vue-router.common.min.js',
					'vue/vue-router.min.js'
				]
			],
			'vue-resource' => [
				'js' => [
					'vue/vue-resource.common.js',
					'vue/vue-resource.min.js'
				]
			],
			'vue-validator' => [
				'js' => [
					'vue/vue-validator.common.min.js',
					'vue/vue-validator.min.js'
				]
			],
			'jquery' => [
				'js' => [
					'jquery-1.12.4.min'
				]
			],
			'jquery2' => [
				'js' => [
					'jquery-2.2.4.min.js'
				]
			],
			'jquery-easing' => [
				'js' => [
					'jquery.easing.min.js'
				]
			],
			'jquery-migrate' => [
				'js' => [
					'jquery-migrate-1.4.1.min.js'
				]
			],
			'font-awesome' => [
				'css' => [
					'font-awesome/css/font-awesome.min.css'
				]
			],
			'simple-line-icons' => [
				'css' => [
					'simple-line-icons/simple-line-icons.min.css'
				]
			],
			'animate' => [
				'css' => [
					'animate/animate.css'
				]
			],
			'bootstrap' => [
				'css' => [
					'bootstrap/css/bootstrap.min.css',
					//'bootstrap/css/bootstrap-theme.min.css'
				],
				'js' => [
					'bootstrap/js/bootstrap.min.js'
				]
			],
			'bootbox' => [
				'js' => [
					'bootbox/bootbox.min.js'
				]
			],
			'bootstrap-datepicker' => [
				'css' => [
					'bootstrap-datepicker/css/bootstrap-datepicker3.min.css'
				],
				'js' => [
					'bootstrap-datepicker/js/bootstrap-datepicker.min.js'
				]
			],
			'bootstrap-tagsinput' => [
				'css' => [
					'bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css',
					'bootstrap-tagsinput/bootstrap-tagsinput.css'
				],
				'js' => [
					'bootstrap-tagsinput/bootstrap-tagsinput.min.js'
				]
			],
			'bootstrap-fileinput' => [
				'css' => [
					'bootstrap-fileinput/fileinput.min.css'
				],
				'js' => [
					'bootstrap-fileinput/fileinput.min.js'
				]
			],
			'jquery-shortcuts' => [
				'js' => [
					'jquery-shortcuts/jquery.shortcuts.min.js'
				]
			],
			'jquery-cookie' => [
				'js' => [
					'js.cookie.min.js'
				]
			],
			'jquery-form' => [
				'js' => [
					'jquery-form/jquery.form.min.js'
				]
			],
			'blockUI' => [
				'js' => [
					'blockUI/jquery.blockUI.min.js'
				]
			],
			'pace' => [
				'css' => [
					'pace/themes/pace-theme-flash.css'
				],
				'js' => [
					'pace/pace.min.js'
				]
			],
			'pnotify' => [
				'css' => [
					'pnotify/css/pnotify.min.css',
					'pnotify/css/pnotify.buttons.min.css',
					'pnotify/css/pnotify.nonblock.min.css'
				],
				'js' => [
					'pnotify/js/pnotify.min.js',
					'pnotify/js/pnotify.buttons.min.js',
					'pnotify/js/pnotify.nonblock.min.js',
					'pnotify/js/pnotify.confirm.min.js',
					'pnotify/js/pnotify.animate.min.js'
				]
			],
			'alphanum' => [
				'js' => [
					'alphanum/jquery.alphanum.min.js'
				]
			],
			'maskedinput' => [
				'js' => [
					'maskedinput/jquery.maskedinput.min.js'
				]
			],
			'datatables' => [
				'css' => [
					'datatables/datatables.min.css'
				],
				'js' => [
					'datatables/datatables.min.js'
				]
			],
			'jquery-ui' => [
				'css' => [
					'jquery-ui/jquery-ui.min.css',
					'jquery-ui/jquery-ui.structure.min.css',
					'jquery-ui/jquery-ui.theme.min.css'
				],
				'js' => [
					'jquery-ui/jquery-ui.min.js'
				]
			],
			'jquery-ui-timepicker' => [
				'css' => [
					'jquery-ui-timepicker/jquery-ui-timepicker-addon.min.css'
				],
				'js' => [
					'jquery-ui-timepicker/jquery-ui-timepicker-addon.min.js',
					'jquery-ui-timepicker/i18n/jquery-ui-timepicker-es.js'
				]
			],
			'ckeditor' => [
				'js' => [
					'ckeditor/ckeditor.js'
				]
			],
			'jstree' => [
				'css' => [
					'jstree/themes/default/style.min.css'
				],
				'js' => [
					'jstree/jstree.min.js'
				]
			],
			'jcrop' => [
				'css' => [
					'jcrop/css/jquery.Jcrop.min.css'
				],
				'js' => [
					'jcrop/js/jquery.Jcrop.min.js',
					'jcrop/js/jquery.color.min.js'
				]
			],
			'template' => [
				'js' => [
					'tmpl.min.js'
				]
			],
			'file-upload' => [
				'css' => [
					'jquery-file-upload/css/jquery.fileupload.css',
					'jquery-file-upload/css/jquery.fileupload-ui.css'
				],
				'js' => [
					'tmpl.min.js',
					'jquery-file-upload/js/vendor/load-image.min.js',
					'jquery-file-upload/js/jquery.fileupload.js',
					'jquery-file-upload/js/jquery.fileupload-process.js',
					'jquery-file-upload/js/vendor/canvas-to-blob.min.js',
					'jquery-file-upload/js/jquery.iframe-transport.js',
					'jquery-file-upload/js/jquery.fileupload-validate.js',
					'jquery-file-upload/js/jquery.fileupload-ui.js',
					'jquery-file-upload/js/jquery.fileupload-image.js'
					//'jquery-file-upload/js/jquery.fileupload-audio.js',
					//'jquery-file-upload/js/jquery.fileupload-video.js',
				]
			],
			'bootstrap-switch' => [
				'css' => [
					'bootstrap-switch/css/bootstrap-switch.min.css'
				],
				'js' => [
					'bootstrap-switch/js/bootstrap-switch.min.js'
				]
			],
			'highcharts' => [
				'js' => [
					'highcharts/js/highcharts.js',
					'highcharts/js/highcharts-more.js'
				]
			],
			'highcharts-drilldown' => [
				'js' => [
					'highcharts/js/modules/drilldown.js'
				]
			],
			'highcharts-3d' => [
				'js' => [
					'highcharts/js/highcharts-3d.js'
				]
			],
			'highmaps' => [
				'js' => [
					'highmaps/js/modules/map.js'
				]
			],
			'icheck' => [
				'css' => [
					'icheck/skins/all.css'
				],
				'js' => [
					'icheck/icheck.min.js'
				]
			],
			'ladda' => [
				'css' => [
					'ladda/ladda-themeless.min.css'
				],
				'js' => [
					'ladda/spin.min.js',
					'ladda/ladda.min.js'
				]
			],
			'touchspin' => [
				'css' => [
					'touchspin/jquery.bootstrap-touchspin.min.css'
				],
				'js' => [
					'touchspin/jquery.bootstrap-touchspin.min.js'
				]
			],
			'flexslider' => [
				'css' => [
					'flexslider/flexslider.min.css',
				],
				'js' => [
					'flexslider/jquery.flexslider.min.js',
				]
			],
			'mixitup' => [
				'js' => [
					'jquery.mixitup.js'
				]
			],
			'wow' => [
				'js' => [
					'wow.min.js'
				]
			],
			'placeholdem' => [
				'js' => [
					'placeholdem.min.js'
				]
			],
			'vide' => [

				'js' => [
					'jquery.vide.js'
				]
			],
			'prettyPhoto' => [
				'js' => [
					'jquery.prettyPhoto.js'
				]
			],
			'smooth-scroll' => [
				'js' => [
					'smooth-scroll.js'
				]
			],
			'waypoints' => [
				'js' => [
					'waypoints.min.js'
				]
			],
			'counterup' => [
				'js' => [
					'jquery.counterup.min.js'
				]
			],
			'scroll-top' => [
				'js' => [
					'scroll-top.js'
				]
			],
			'lazyload' => [
				'js' => [
					'jquery.lazyload.js'
				]
			],
			'appear' => [
				'js' => [
					'jquery.appear.js'
				]
			],
			'slicknav' => [
				'js' => [
					'jquery.slicknav.js'
				]
			],
			'owl-carousel'=>[
				'css' => [
					'owl-carousel/owl.carousel.css',
					'owl-carousel/owl.theme.css'
				],
				'js' => [
					'owl-carousel/owl.carousel.min.js'
				]
			],
			'magnific-popup'=> [
				'css' => [
					'magnific-popup/magnific-popup.css',
				],
				'js' => [
					'magnific-popup/jquery.magnific-popup.min.js',
				]
			],
			'revolution-slider'=> [
				'css' =>[
					'revolution-slider/css/settings.css',
				],
				'js' => [
					'revolution-slider/js/jquery.themepunch.tools.min.js',
					'revolution-slider/js/jquery.themepunch.revolution.min.js',
				]
			],
			'hover'=> [
				'css'=>[
					'hover/hover-min.css',
				]
			],
			'bxslider' => [
				'css'=>[
					'jquery-bxslider/css/jquery.bxslider.css',
				],
				'js'=>[
					'jquery-bxslider/js/jquery.bxslider.js'
				],
			],
			'lightbox'=> [
				'css'=> [
						'lightbox/css/lightbox.css',
				],
				'js'=> [
						'lightbox/js/lightbox.js',
				],

			],
			'bootstrap-select'=> [
				'css'=> [
						'bootstrap-select2/css/bootstrap-select.min.css',
				],
				'js'=> [
						'bootstrap-select2/js/bootstrap-select.min.js',
				],

			], 
			'bootstrap-colorpicker'=>[
				'css'=>[
					'bootstrap-colorpicker/css/colorpicker.css',
				],
				'js'=>[
					'bootstrap-colorpicker/js/bootstrap-colorpicker.js',
				]
			],
			'jasny-bootstrap' => [
				'css' => [
					'jasny-bootstrap/css/jasny-bootstrap.min.css'
				],
				'js' => [
					'jasny-bootstrap/js/jasny-bootstrap.min.js',
				]
			]
		],
		'e-bolivar' => [
			'metronic' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/css/metronic/components.min.css',
					'http://cdn.e-bolivar.gob.ve/css/metronic/layout.min.css',
					'http://cdn.e-bolivar.gob.ve/css/metronic/themes/default.min.css',
					'http://cdn.e-bolivar.gob.ve/css/metronic/custom.min.css',
					'http://cdn.e-bolivar.gob.ve/css/metronic/backend.css',
					'http://cdn.e-bolivar.gob.ve/css/metronic/plugins.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/js/metronic/init_plantilla.js',
					'http://cdn.e-bolivar.gob.ve/js/metronic/init.js',
					'http://cdn.e-bolivar.gob.ve/js/metronic/funciones.js'
				]
			],
			'ie' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/respond.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/excanvas.js'
				]
			],
			'OpenSans' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/OpenSans/OpenSans.css'
				]
			],
			'modernizr' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/modernizr.min.js'
				]
			],
			'vue' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/vue/vue.min.js'
				]
			],
			'vue-strap' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/vue/vue-strap.min.js'
				]
			],
			'vue-router' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/vue/vue-router.min.js'
				]
			],
			'vue-resource' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/vue/vue-resource.common.js',
					'http://cdn.e-bolivar.gob.ve/plugins/vue/vue-resource.min.js'
				]
			],
			'vue-validator' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/vue/vue-validator.common.js',
					'http://cdn.e-bolivar.gob.ve/plugins/vue/vue-validator.min.js'
				]
			],
			'jquery' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-1.12.4.min.js'
				]
			],
			'jquery2' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-2.2.4.min.js'
				]
			],
			'jquery-easing' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery.easing.min.js'
				]
			],
			'jquery-migrate' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-migrate-1.4.1.min.js'
				]
			],
			'font-awesome' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/font-awesome/css/font-awesome.min.css'
				]
			],
			'simple-line-icons' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/simple-line-icons/simple-line-icons.min.css'
				]
			],
			'animate' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/animate/animate.css'
				]
			],
			'bootstrap' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap/css/bootstrap.min.css'
					//'bootstrap/css/bootstrap-theme.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap/js/bootstrap.min.js'
				]
			],
			'bootbox' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootbox/bootbox.min.js'
				]
			],
			'bootstrap-datepicker' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'
				]
			],
			'bootstrap-tagsinput' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css',
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'
				]
			],
			'bootstrap-fileinput' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-fileinput/fileinput.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-fileinput/fileinput.min.js'
				]
			],
			'jquery-shortcuts' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-shortcuts/jquery.shortcuts.min.js'
				]
			],
			'jquery-cookie' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/js.cookie.min.js'
				]
			],
			'jquery-form' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-form/jquery.form.min.js'
				]
			],
			'blockUI' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/blockUI/jquery.blockUI.min.js'
				]
			],
			'pace' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/pace/themes/pace-theme-flash.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/pace/pace.min.js'
				]
			],
			'pnotify' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/pnotify/css/pnotify.min.css',
					'http://cdn.e-bolivar.gob.ve/plugins/pnotify/css/pnotify.buttons.min.css',
					'http://cdn.e-bolivar.gob.ve/plugins/pnotify/css/pnotify.nonblock.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/pnotify/js/pnotify.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/pnotify/js/pnotify.buttons.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/pnotify/js/pnotify.nonblock.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/pnotify/js/pnotify.confirm.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/pnotify/js/pnotify.animate.min.js'
				]
			],
			'alphanum' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/alphanum/jquery.alphanum.min.js'
				]
			],
			'maskedinput' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/maskedinput/jquery.maskedinput.min.js'
				]
			],
			'datatables' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/datatables/datatables.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/datatables/datatables.min.js'
				]
			],
			'jquery-ui' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-ui/jquery-ui.min.css',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-ui/jquery-ui.structure.min.css',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-ui/jquery-ui.theme.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-ui/jquery-ui.min.js'
				]
			],
			'jquery-ui-timepicker' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-ui-timepicker/jquery-ui-timepicker-addon.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-ui-timepicker/jquery-ui-timepicker-addon.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-ui-timepicker/i18n/jquery-ui-timepicker-es.js'
				]
			],
			'ckeditor' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/ckeditor/ckeditor.js'
				]
			],
			'jstree' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jstree/themes/default/style.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jstree/jstree.min.js'
				]
			],
			'jcrop' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jcrop/css/jquery.Jcrop.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jcrop/js/jquery.Jcrop.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jcrop/js/jquery.color.min.js'
				]
			],
			'template' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/tmpl.min.js'
				]
			],
			'file-upload' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/css/jquery.fileupload.css',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/css/jquery.fileupload-ui.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/tmpl.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/js/vendor/load-image.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/js/jquery.fileupload.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/js/jquery.fileupload-process.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/js/jquery.iframe-transport.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/js/jquery.fileupload-validate.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/js/jquery.fileupload-ui.js',
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-file-upload/js/jquery.fileupload-image.js'
					//'jquery-file-upload/js/jquery.fileupload-audio.js',
					//'jquery-file-upload/js/jquery.fileupload-video.js',
				]
			],
			'bootstrap-switch' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-switch/css/bootstrap-switch.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-switch/js/bootstrap-switch.min.js'
				]
			],
			'highcharts' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/highcharts/js/highcharts.js',
					'http://cdn.e-bolivar.gob.ve/plugins/highcharts/js/highcharts-more.js'
				]
			],
			'highcharts-drilldown' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/highcharts/js/modules/drilldown.js'
				]
			],
			'highcharts-3d' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/highcharts/js/highcharts-3d.js'
				]
			],
			'highmaps' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/highmaps/js/modules/map.js'
				]
			],
			'icheck' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/icheck/skins/all.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/icheck/icheck.min.js'
				]
			],
			'ladda' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/ladda/ladda-themeless.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/ladda/spin.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/ladda/ladda.min.js'
				]
			],
			'touchspin' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/touchspin/jquery.bootstrap-touchspin.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/touchspin/jquery.bootstrap-touchspin.min.js'
				]
			],
			'mixitup' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery.mixitup.js'
				]
			],
			'wow' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/wow.min.js'
				]
			],
			'placeholdem' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/placeholdem.min.js'
				]
			],
			'vide' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery.vide.js'
				]
			],
			'prettyPhoto' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery.prettyPhoto.js'
				]
			],
			'smooth-scroll' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/smooth-scroll.js'
				]
			],
			'waypoints' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/waypoints.min.js'
				]
			],
			'counterup' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery.counterup.min.js'
				]
			],
			'scroll-top' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/scroll-top.js'
				]
			],
			'lazyload' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery.lazyload.js'
				]
			],
			'appear' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery.appear.js'
				]
			],
			'slicknav' => [
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jquery.slicknav.js'
				]
			],
			'owl-carousel'=>[
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/owl-carousel/css/owl.carousel.css',
					'http://cdn.e-bolivar.gob.ve/plugins/owl-carousel/css/owl.theme.default.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/owl-carousel/js/owl.carousel.js'
				]
			],
			'magnific-popup'=> [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/magnific-popup/magnific-popup.css',
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/magnific-popup/jquery.magnific-popup.min.js',
				]
			],
			'revolution-slider'=> [
				'css' =>[
					'http://cdn.e-bolivar.gob.ve/plugins/revolution-slider/css/settings.css',
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/revolution-slider/js/jquery.themepunch.tools.min.js',
					'http://cdn.e-bolivar.gob.ve/plugins/revolution-slider/js/jquery.themepunch.revolution.min.js',
				]
			],
			'hover'=> [
				'css'=>[
					'http://cdn.e-bolivar.gob.ve/plugins/hover/hover-min.css',
				]
			],
			'bxslider' => [
				'css'=>[
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-bxslider/css/jquery.bxslider.css',
				],
				'js'=>[
					'http://cdn.e-bolivar.gob.ve/plugins/jquery-bxslider/js/jquery.bxslider.js'
				],
			],
			'lightbox'=> [
				'css'=> [
					'http://cdn.e-bolivar.gob.ve/plugins/lightbox/css/lightbox.css',
				],
				'js'=> [
					'http://cdn.e-bolivar.gob.ve/plugins/lightbox/js/lightbox.js',
				],

			],
			'bootstrap-select'=> [
				'css'=> [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-select2/css/bootstrap-select.min.css',
				],
				'js'=> [
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-select2/js/bootstrap-select.min.js',
				],

			], 
			'bootstrap-colorpicker'=>[
				'css'=>[
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-colorpicker/css/colorpicker.css',
				],
				'js'=>[
					'http://cdn.e-bolivar.gob.ve/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
				]
			],
			'jasny-bootstrap' => [
				'css' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css'
				],
				'js' => [
					'http://cdn.e-bolivar.gob.ve/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js',
				]
			]
		]
	]
];