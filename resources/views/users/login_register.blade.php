@extends('layouts.frontLayout.front_design')
@section('content')

		<!-- Checkout AREA -->
		<div class="checkout-area">
			<div class="container">
				<div class="row">
					<br>
					<br>
			        @if(Session::has('flash_message_error')) 
			          <div class="alert alert-danger alert-block">
			              <button  type="button" class="close" data-dismiss="alert">x</button>
			               <strong> {!! session('flash_message_error') !!}</strong>
			          </div>
			        @endif  
			        @if(Session::has('flash_message_success')) 
			          <div class="alert alert-success alert-block">
			              <button  type="button" class="close" data-dismiss="alert">x</button>
			               <strong> {!! session('flash_message_success') !!}</strong>
			          </div>
			        @endif 
					<div class="col-md-5 col-sm-12">
						<div class="billing-address" style="padding-top: 100px; padding-bottom: 100px;">
							<div class="checkout-head">
								<h2>{{ trans('sentence.КИРИШ')}}</h2>
							</div>
							<div class="checkout-form">
								<form id="loginForm" name="loginForm" class="form-horizontal" action="{{ url('/user-login') }}" method="POST">
							        {{ csrf_field() }}
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ТЕЛЕФОН')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input name="email" type="text" value="+998" class="form-control" required="" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ПАРОЛЬ')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input name="password" type="password" class="form-control" required="" />
										</div>
									</div>
									<div class="single-wishlist" style="float: right;">
									<button type="submit" class="btn btn-fefault cart">{{ trans('sentence.КИРИШ')}}</button>
								    </div>
								    <br>
								    <a href="{{ url('forgot-password') }}">{{ trans('sentence.ПАРОЛНИ УНУТДИНГИЗМИ')}}?</a>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-2">
					</div>
					<div class="col-md-5 col-sm-12">
						<div class="billing-address"  style="padding-top: 100px; padding-bottom: 100px;">
							<div class="checkout-head">
								<h2>{{ trans('sentence.РЎЙХАТДАН ЎТИШ')}}</h2>
							</div>
							<div class="checkout-form">
								<form id="registerForm" name="registerForm" action="{{ url('/user-register') }}" method="POST" class="form-horizontal">
							    {{ csrf_field() }}
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ИСМ')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input id="name" class="form-control" name="name" type="text" required="" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ТЕЛЕФОН')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input id="email" class="form-control" value="+998" name="email" type="text" required="" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ПАРОЛЬ')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input id="myPassword" name="password" type="password" class="form-control" required="" />
										</div>
									</div>
									<div class="single-wishlist" style="float: right;">
									<button type="submit" class="btn btn-fefault cart">{{ trans('sentence.РЎЙХАТДАН ЎТИШ')}}</button>
								    </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection
