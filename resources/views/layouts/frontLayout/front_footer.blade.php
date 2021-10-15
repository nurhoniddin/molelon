<!-- Footer AREA -->
		<div class="footer-area">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-12">
							<div class="footer-info-card">
								<div class="footer-logo">
									<a href="{{ asset('/') }}"><img src="{{ asset('images/frontend_images/logo.png') }}" alt="logo"></a>
								</div>
							</div>
						</div>
						<div class="col-md-2 col-sm-6">
							<div class="footer-menu-area">
								<div class="footer-menu">
									<ul>
										@if(empty(Auth::check()))
										<li><a href="{{ url('/login-register') }}"><i class="fa fa-lock"></i> {{ trans('sentence.КИРИШ')}}</a></li>
										@else
										<li><a href="{{ url('/user-logout') }}"><i class="fa fa-sign-out"></i> {{ trans('sentence.ЧИҚИШ')}}</a></li>
										@endif
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="footer-menu-area">
								<div class="footer-menu">
									<ul>
										<li><i class="fa fa-plus"></i><a href="#">{{ trans('sentence.ЭЪЛОН БЕРИШ')}}</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="footer-social-icon">
								<ul class="list-inline">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
									<li><a href="#"><i class="fa fa-vimeo"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>	
			</div>
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="copyright">
								© 2020
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							
						</div>
					</div>
				</div>
			</div>
		</div>