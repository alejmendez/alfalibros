<div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img
                    src="../assets/themes/microjobengine/assets/img/icon-close.png" alt=""></span></button>
                <h4 class="modal-title" id="myModalLabel">Sign in</h4>
            </div>
            <div class="modal-body">
                <div id="signInForm">
                    <form class="form-authentication et-form">
                        <input type="hidden" name="redirect_url" class="redirect_url" value="dashboard/index.html" />
                        <div class="inner-form signin-form">
                            <div class="form-group clearfix">
                                <div class="input-group">
                                    <label for="user_login">Username or Email</label>
                                    <input type="text" name="user_login" id="user_login" class="form-control">
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="input-group">
                                    <label for="user_pass">Password</label>
                                    <input type="password" name="user_pass" id="user_pass" class="form-control">
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="sign-in-button float-left">
                                    <button class="btn-continue waves-effect waves-light btn-submit">SIGN IN</button>
                                </div>
                                <div class="forgot-pass float-right">
                                    <a href="javascript:void(0)" class="open-forgot-modal">Forgot your password?</a>
                                </div>
                            </div>
                            <div class="clearfix float-right social">
                                <div class="socials-head">Or sign in with:</div>
                                <ul class="list-social-login">
                                    <li>
                                        <a href="#" class="fb facebook_auth_btn ">
                                        <i class="fa fa-facebook"></i>
                                        <span class="social-text">Facebook</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="gplus gplus_login_btn " >
                                        <i class="fa fa-google-plus"></i>
                                        <span class="social-text">Plus</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="indexbc72.html?action=twitterauth" class="tw ">
                                        <i class="fa fa-twitter"></i>
                                        <span class="social-text">Twitter</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="float-center not-member">
                            <span>Not a member yet?</span> <a href="#" class="open-signup-modal">Join us!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>