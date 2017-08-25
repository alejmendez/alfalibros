<header id="et-header">
    <div class="et-pull-top">
        <div class="row">
            <!--Logo-->
            <div class="header-left">
                <div id="logo-site">
                    <a href="{{ url('/')}}">
                        <img src="{{ url('public/img/logos/logo.png')}}" alt="alfalibros.com" style="width: 60px;" />						
                    </a>
                </div>
                <div class="search-bar">
                    <form action="https://microjobengine.enginethemes.com/" class="et-form">
                        <span class="icon-search"><i class="fa fa-search"></i></span>
                        <input type="text" name="s" id="input-search">
                    </form>
                </div>
            </div>
            <!--Function right-->
            <div id="myAccount" class="float-right header-right">
                <div class="link-account">
                    <ul>
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
                        <li>
                            <a href="#" data-toggle="modal" data-target="#login-modal"><b>Login</b></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#crear-usuarios-modal"><b>Registrate</b></a>
                        </li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="et-pull-bottom" id="et-nav">
    <nav>
        <div class="navbar navbar-default megamenu">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse">
            <span class="sr-only">Toggle navigation</span>
            <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse collapsed">
        <ul id="nav" class="nav navbar-nav">
            <li id="menu-item-21" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-has-children menu-item-21 dropdown">
                <a title="Logo Design" href="blog/mjob_category/logo-design-branding/index.html" class="dropdown-toggle waves-effect waves-light hvr-shutter-in-vertical" aria-haspopup="true">Logo Design <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <ul role="menu" class=" dropdown-menu">
                    <div class="div-main-sub">
                        <li id="menu-item-92" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-92"><a title="Logo Design" href="blog/mjob_category/logo-design/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Logo Design</a></li>
                        <!-- start:1--> 
                        <li id="menu-item-93" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-93"><a title="Logo Customization" href="blog/mjob_category/logo-customization/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Logo Customization</a></li>
                        <!-- start:2--> 
                        <li id="menu-item-94" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-94"><a title="Banner Ads" href="blog/mjob_category/banner-ads/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Banner Ads</a></li>
                        <!-- start:3--> 
                        <li id="menu-item-95" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-95"><a title="Social Media Design" href="blog/mjob_category/social-media-design/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Social Media Design</a></li>
                        <!-- start:4--> 
                        <li id="menu-item-96" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-96"><a title="T-Shirt Design" href="blog/mjob_category/t-shirt-design/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">T-Shirt Design</a></li>
                        <!-- start:5-->
                    </div>
                    <div class="div-main-sub">
                    <li id="menu-item-97" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-97"><a title="Invitations" href="blog/mjob_category/invitations/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Invitations</a></li>
                    <!-- start:6--> 
                    <li id="menu-item-98" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-98"><a title="Business Cards &amp; Stationery" href="blog/mjob_category/business-cards-stationery/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Business Cards &amp; Stationery</a></li>
                    <!-- start:7-->
                </div></ul>
            </li>
            <!-- start:7-->
            <li id="menu-item-22" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-has-children menu-item-22 dropdown">
                <a title="Graphics &amp; Design" href="blog/mjob_category/graphics-design/index.html" class="dropdown-toggle waves-effect waves-light hvr-shutter-in-vertical" aria-haspopup="true">Graphics &amp; Design <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <ul role="menu" class=" dropdown-menu">
                    <div class="div-main-sub">
                        <li id="menu-item-99" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-99"><a title="Cartoons &amp; Caricatures" href="blog/mjob_category/cartoons-caricatures/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Cartoons &amp; Caricatures</a></li>
                        <!-- start:1--> 
                        <li id="menu-item-100" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-100"><a title="Photoshop Editing" href="blog/mjob_category/photoshop-editing/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Photoshop Editing</a></li>
                        <!-- start:2--> 
                        <li id="menu-item-101" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-101"><a title="Illustration" href="blog/mjob_category/illustration/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Illustration</a></li>
                        <!-- start:3--> 
                        <li id="menu-item-102" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-102"><a title="Flyers &amp; Posters" href="blog/mjob_category/flyers-posters/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Flyers &amp; Posters</a></li>
                        <!-- start:4--> 
                        <li id="menu-item-103" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-103"><a title="Web &amp; Mobile Design" href="blog/mjob_category/web-mobile-design/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Web &amp; Mobile Design</a></li>
                        <!-- start:5-->
                    </div>
                    <div class="div-main-sub">
                        <li id="menu-item-104" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-104"><a title="Book Covers &amp; Packaging" href="blog/mjob_category/book-covers-packaging/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Book Covers &amp; Packaging</a></li>
                        <!-- start:6--> 
                        <li id="menu-item-105" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-105"><a title="2D Design &amp; 3D Modeling" href="blog/mjob_category/2d-design-3d-modeling/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">2D Design &amp; 3D Modeling</a></li>
                        <!-- start:7--> 
                        <li id="menu-item-106" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-106"><a title="Drawing &amp; Sketching" href="blog/mjob_category/drawing-sketching/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Drawing &amp; Sketching</a></li>
                        <!-- start:8--> 
                        <li id="menu-item-107" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-107"><a title="App Icon Design" href="blog/mjob_category/app-icon-design/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">App Icon Design</a></li>
                        <!-- start:9--> 
                        <li id="menu-item-108" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-108"><a title="Customize Graphics" href="blog/mjob_category/customize-graphics/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Customize Graphics</a></li>
                        <!-- start:10-->
                    </div>
                    <div class="div-main-sub">
                    <li id="menu-item-79" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-79"><a title="Presentations &amp; Infographics" href="blog/mjob_category/presentations-infographics/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Presentations &amp; Infographics</a></li>
                    <!-- start:11-->    
                    <li id="menu-item-110" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-110"><a title="Vector Tracing" href="blog/mjob_category/vector-tracing/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Vector Tracing</a></li>
                    <!-- start:12-->
                </div></ul>
            </li>
            <!-- start:12-->
            <li id="menu-item-23" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-has-children menu-item-23 dropdown">
                <a title="Copywriting" href="blog/mjob_category/copywriting/index.html" class="dropdown-toggle waves-effect waves-light hvr-shutter-in-vertical" aria-haspopup="true">Copywriting <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <ul role="menu" class=" dropdown-menu">
                    <div class="div-main-sub">
                        <li id="menu-item-111" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-111"><a title="Business Copywriting" href="blog/mjob_category/business-copywriting/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Business Copywriting</a></li>
                        <!-- start:1--> 
                        <li id="menu-item-112" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-112"><a title="Creative Writing" href="blog/mjob_category/creative-writing/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Creative Writing</a></li>
                        <!-- start:2--> 
                        <li id="menu-item-113" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-113"><a title="Resumes &amp; Cover Letters" href="blog/mjob_category/resumes-cover-letters/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Resumes &amp; Cover Letters</a></li>
                        <!-- start:3--> 
                        <li id="menu-item-84" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-84"><a title="Press Releases" href="blog/mjob_category/press-releases/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Press Releases</a></li>
                        <!-- start:4--> 
                        <li id="menu-item-115" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-115"><a title="Articles &amp; Blog Posts" href="blog/mjob_category/articles-blog-posts/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Articles &amp; Blog Posts</a></li>
                        <!-- start:5-->
                    </div>
                    <div class="div-main-sub">
                    <li id="menu-item-116" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-116"><a title="Research &amp; Summaries" href="blog/mjob_category/research-summaries/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Research &amp; Summaries</a></li>
                    <!-- start:6-->
                </div></ul>
            </li>
            <!-- start:6-->
            <li id="menu-item-24" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-has-children menu-item-24 dropdown">
                <a title="Translation" href="blog/mjob_category/translation/index.html" class="dropdown-toggle waves-effect waves-light hvr-shutter-in-vertical" aria-haspopup="true">Translation <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <ul role="menu" class=" dropdown-menu">
                    <div class="div-main-sub">
                        <li id="menu-item-87" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-87"><a title="Transcription" href="blog/mjob_category/transcription/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Transcription</a></li>
                        <!-- start:1--> 
                        <li id="menu-item-118" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-118"><a title="Proofreading &amp; Editing" href="blog/mjob_category/proofreading-editing/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Proofreading &amp; Editing</a></li>
                        <!-- start:2--> 
                        <li id="menu-item-89" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-89"><a title="English to Your language" href="blog/mjob_category/english-to-your-language/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">English to Your language</a></li>
                        <!-- start:3--> 
                        <li id="menu-item-120" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-120"><a title="Your language to English" href="blog/mjob_category/your-language-to-english/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Your language to English</a></li>
                        <!-- start:4-->
                </div></ul>
            </li>
            <!-- start:4-->
            <li id="menu-item-25" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-has-children menu-item-25 dropdown"><a title="Digital Marketing" href="blog/mjob_category/digital-marketing/index.html" class="dropdown-toggle waves-effect waves-light hvr-shutter-in-vertical" aria-haspopup="true">Digital Marketing <i class="fa fa-caret-down" aria-hidden="true"></i></a>
            <ul role="menu" class=" dropdown-menu">
            <div class="div-main-sub">  <li id="menu-item-91" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-91"><a title="Social Media Marketing" href="blog/mjob_category/social-media-marketing/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Social Media Marketing</a></li><!-- start:1-->   <li id="menu-item-60" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-60"><a title="Influencer Marketing" href="blog/mjob_category/influencer-marketing/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Influencer Marketing</a></li><!-- start:2--> <li id="menu-item-61" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-61"><a title="Mobile Advertising" href="blog/mjob_category/mobile-advertising/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Mobile Advertising</a></li><!-- start:3-->   <li id="menu-item-126" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-126"><a title="SEO" href="blog/mjob_category/seo/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">SEO</a></li><!-- start:4-->  <li id="menu-item-127" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-127"><a title="Web Analytics" href="blog/mjob_category/web-analytics/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Web Analytics</a></li><!-- start:5--></div></ul>
            </li><!-- start:5--><li id="menu-item-26" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-has-children menu-item-26 dropdown"><a title="WordPress" href="blog/mjob_category/wordpress/index.html" class="dropdown-toggle waves-effect waves-light hvr-shutter-in-vertical" aria-haspopup="true">WordPress <i class="fa fa-caret-down" aria-hidden="true"></i></a>
            <ul role="menu" class=" dropdown-menu">
            <div class="div-main-sub">  <li id="menu-item-128" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-128"><a title="WordPress Installation" href="blog/mjob_category/wordpress-installation/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">WordPress Installation</a></li><!-- start:1--> <li id="menu-item-129" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-129"><a title="WordPress Plug-ins" href="blog/mjob_category/wordpress-plug-ins/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">WordPress Plug-ins</a></li><!-- start:2--> <li id="menu-item-130" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-130"><a title="WordPress Customization" href="blog/mjob_category/wordpress-customization/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">WordPress Customization</a></li><!-- start:3-->  <li id="menu-item-131" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-131"><a title="PSD to WordPress" href="blog/mjob_category/psd-to-wordpress/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">PSD to WordPress</a></li><!-- start:4-->   <li id="menu-item-132" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-132"><a title="Security" href="blog/mjob_category/security/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Security</a></li><!-- start:5--></div><div class="div-main-sub">   <li id="menu-item-133" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-133"><a title="Help/Consultation" href="blog/mjob_category/helpconsultation/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Help/Consultation</a></li><!-- start:6--></div></ul>
            </li><!-- start:6--><li id="menu-item-27" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-has-children menu-item-27 dropdown"><a title="Website &amp; Programming" href="blog/mjob_category/website-programming/index.html" class="dropdown-toggle waves-effect waves-light hvr-shutter-in-vertical" aria-haspopup="true">Website &amp; Programming <i class="fa fa-caret-down" aria-hidden="true"></i></a>
            <ul role="menu" class=" dropdown-menu">
            <div class="div-main-sub">  <li id="menu-item-134" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-134"><a title="Web Programming" href="blog/mjob_category/web-programming/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Web Programming</a></li><!-- start:1-->  <li id="menu-item-135" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-135"><a title="Mobile Apps &amp; Web" href="blog/mjob_category/mobile-apps-web/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Mobile Apps &amp; Web</a></li><!-- start:2-->  <li id="menu-item-136" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-136"><a title="Website Builders &amp; CMS" href="blog/mjob_category/website-builders-cms/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Website Builders &amp; CMS</a></li><!-- start:3--></div></ul>
            </li><!-- start:3--><li id="menu-item-28" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-has-children menu-item-28 dropdown"><a title="Tech Support" href="blog/mjob_category/tech-support/index.html" class="dropdown-toggle waves-effect waves-light hvr-shutter-in-vertical" aria-haspopup="true">Tech Support <i class="fa fa-caret-down" aria-hidden="true"></i></a>
            <ul role="menu" class=" dropdown-menu">
            <div class="div-main-sub">  <li id="menu-item-137" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-137"><a title="Support &amp; IT" href="blog/mjob_category/support-it/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Support &amp; IT</a></li><!-- start:1--> <li id="menu-item-138" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-138"><a title="User Testing" href="blog/mjob_category/user-testing/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">User Testing</a></li><!-- start:2-->   <li id="menu-item-139" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-139"><a title="QA" href="blog/mjob_category/qa/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">QA</a></li><!-- start:3--> <li id="menu-item-140" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-140"><a title="Data Analysis &amp; Reports" href="blog/mjob_category/data-analysis-reports/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Data Analysis &amp; Reports</a></li><!-- start:4-->    <li id="menu-item-141" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-141"><a title="Convert Files" href="blog/mjob_category/convert-files/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Convert Files</a></li><!-- start:5--></div></ul>
            </li><!-- start:5--><!-- start:0--><li class="more" style="display: list-item;"><span>Others</span><ul id="overflow"><li id="menu-item-29" class="menu-item menu-item-type-taxonomy menu-item-object-mjob_category menu-item-29"><a title="Lifestyle" href="blog/mjob_category/lifestyle/index.html" class="waves-effect waves-light hvr-shutter-in-vertical">Lifestyle</a></li></ul></li>
        </ul>
        <div class="overlay-nav"></div>
        </div>
        </div>
    </nav>
    </div>
</header>