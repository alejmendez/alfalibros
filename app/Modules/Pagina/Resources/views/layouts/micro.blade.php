<!DOCTYPE html>

<!--[if IE 7]>
<html class="ie ie7" lang="es">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="es">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="es">
<!--<![endif]-->
<head>
	 @include('pagina::partials.microjob.head')
    
</head>
<body class="home blog default wpb-js-composer js-comp-ver-4.12 vc_responsive">
<div class="mje-main-wrapper">

	<!--End Header-->
	

	    @include('pagina::partials.microjob.header')
	    
	    <div id="content">
	     	<?php
	     		//@include('pagina::partials.microjob.categorias')
	     	 ?>

	        @yield('content')
	    </div>
	 @include('pagina::partials.microjob.footer')
	<!--End Footer-->
</div>
<!-- end .mje-main-wrapper -->
	
	@if (!$autenticado)
	@include('pagina::partials.login')
	@include('pagina::partials.crear_usuarios')
	@endif
	
	<!--esto no se que hacer con eso inicio-->
	<script type='text/javascript'>
		/* <![CDATA[ */
		<!--si elimino esto se le van los efectos-->
		var ae_globals = {"ajaxURL":"https:\/\/microjobengine.enginethemes.com\/wp-admin\/admin-ajax.php","imgURL":"https:\/\/microjobengine.enginethemes.com\/wp-content\/themes\/microjobengine\/includes\/aecore\/assets\/img\/","assetImg":"https:\/\/microjobengine.enginethemes.com\/wp-content\/themes\/microjobengine\/assets\/img\/","jsURL":"https:\/\/microjobengine.enginethemes.com\/wp-content\/themes\/microjobengine\/includes\/aecore\/assets\/js\/","loadingImg":"<img class=\"loading loading-wheel\" src=\"https:\/\/microjobengine.enginethemes.com\/wp-content\/themes\/microjobengine\/includes\/aecore\/assets\/img\/loading.gif\" alt=\"Loading...\">","loading":"Loading","ae_is_mobile":"0","plupload_config":{"max_file_size":"1.46484375mb","url":"https:\/\/microjobengine.enginethemes.com\/wp-admin\/admin-ajax.php","flash_swf_url":"https:\/\/microjobengine.enginethemes.com\/wp-includes\/js\/plupload\/plupload.flash.swf","silverlight_xap_url":"https:\/\/microjobengine.enginethemes.com\/wp-includes\/js\/plupload\/plupload.silverlight.xap","filters":[{"title":"Image Files","extensions":"jpg,jpeg,gif,png"}]},"homeURL":"https:\/\/microjobengine.enginethemes.com","is_submit_post":"","is_submit_project":"","is_single":"","max_images":"5","user_confirm":"","max_cat":"3","confirm_message":"Are you sure to archive this?","confirm_delete_message":"Are you sure to delete this?","map_zoom":"8","map_center":{"latitude":10,"longitude":106},"fitbounds":"","limit_free_msg":"You have reached the maximum number of Free posts. Please select another plan.","error":"Please fill all require fields.","geolocation":"0","date_format":"F j, Y","time_format":"g:i a","dates":{"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]},"global_map_style":null,"user_ID":"0","is_admin":"","is_search":"","is_tax_mjob_category":"","is_tax_skill":"","mJobDefaultGalleryImage":"https:\/\/microjobengine.enginethemes.com\/wp-content\/themes\/microjobengine\/assets\/img\/image-avatar.jpg","mjob_image_directory":"https:\/\/microjobengine.enginethemes.com\/wp-content\/themes\/microjobengine\/assets\/img","decimal":"2","decimal_point":".","thousand_sep":",","mjob_currency":{"code":"USD","icon":"$","align":"1"},"order_link":"https:\/\/microjobengine.enginethemes.com\/order\/","profile_empty_text":"There is no content","no_services":"<div class=\"not-found\">This search matches 0 results! <p class=\"not-found-sub-text\"><label for=\"input-search\" class=\"new-search-link\">New search<\/label> or <a href=\"https:\/\/microjobengine.enginethemes.com\">back to home page<\/a><\/p><\/div>","no_mjobs":"<div class=\"not-found\">There are no mJobs found!<\/div>","no_orders":"<p class=\"no-items\" >There are no orders found!<\/p>","min_images":"1","min_images_notification":"You must have at least one picture!","delivery_status":"DELIVERED","disputing_status":"DISPUTING","file_types":"pdf,doc,docx,zip,psd,jpg,png","progress_bar_3":"            <ul class=\"step-3-col\">\n                <li class=\"post-service-step-1 active\" data-id=\"step1\"><span class=\"link-step1\">1<\/span><\/li>\n                <li class=\"post-service-step-2\" data-id=\"step-post\"><span class=\"link-step2\">2<\/span><\/li>\n                <li class=\"post-service-step-3\" data-id=\"step4\"><span class=\"link-step3\">3<\/span><\/li>\n                <div class=\"progress-bar-success\"><\/div>\n            <\/ul>\n","progress_bar_4":"        <ul class=\"step-4-col\">\n            <li class=\"post-service-step-1 active\" data-id=\"step1\"><span class=\"link-step1\">1<\/span><\/li>\n            <li class=\"post-service-step-2\" data-id=\"step2\"><span class=\"link-step2\">2<\/span><\/li>\n            <li class=\"post-service-step-3\" data-id=\"step-post\"><span class=\"link-step3\">3<\/span><\/li>\n            <li class=\"post-service-step-4\" data-id=\"step4\"><span class=\"link-step4\">4<\/span><\/li>\n            <div class=\"progress-bar-success\"><\/div>\n        <\/ul>\n","date_range":["May 21","May 22","May 23","May 24","May 25","May 26","May 27","May 28"],"data_chart":[0,0,0,0,0,0,0,0],"show_bio_text":"Show more","hide_bio_text":"Show less","pending_account_error_txt":"Your account is pending. You have to activate your account to continue this step.","disableNotification":"This mJob was paused by the seller.","priceMinNoti":"Please enter a number greater than 0.","requiredField":"This field is required!","uploadSuccess":"Job slider updated successfully!","permalink_structure":"\/blog\/%year%\/%monthnum%\/%day%\/%postname%\/","notice_expired_date":"This order was expected to be delivered at ","primary_color":"rgba(16,162,239,1)","primary_chart_color":"rgba(16,162,239,0.1)","custom_order_decline":"Decline Custom Order","custom_order_reject":"Offer Rejected","credit_balance_not_enough":"Your balance is not enough to use this checkout method.","min_text":"minutes","hour_text":"hours","sec_text":"seconds","min_withdraw":"15","min_withdraw_error":"Minimum money to withdraw is <span class=\"mje-price\">$15.00<\/span>","title_popover_opening_message":"This message will be shown in the direct chat box.","result":"result","results":"results","skin_assets_path":"https:\/\/microjobengine.enginethemes.com\/wp-content\/themes\/microjobengine\/assets\/","skin_name":"default","is_tablet":"","is_phone":""};
		/* ]]> */
	</script>
	<!--esto no se que hacer con eso fin -->
	
    <style type="text/css">
        .post-a-job .step .toggle-title,
        .btn-background,
        .icon-border {
            box-sizing: content-box;
        }

        .et-plugin-demobar .icon:before {
            font-size: 20px;
        }
    </style>
</body>

<!-- Mirrored from microjobengine.enginethemes.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 28 May 2017 10:28:33 GMT -->
</html>
