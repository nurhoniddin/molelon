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
			        <div class="col-md-1 col-sm-12">
			        </div>
					<div class="col-md-10 col-sm-12">
						<div class="billing-address" style="padding-top: 100px; padding-bottom: 100px;">
							<div class="checkout-head">
								<h2>{{ trans('sentence.ПАРОЛНИ УНУТДИНГИЗМИ')}}?</h2>
							</div>
							<div class="checkout-form">
								<form id="forgotPasswordForm" name="forgotPasswordForm" action="{{ url('/forgot-password') }}" class="form-horizontal" method="POST">
							    {{ csrf_field() }}
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ТЕЛЕФОН')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input name="email" value="+998" type="text" class="form-control" required="" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ЙАНГИ ПАРОЛЬ КИРИТИНГ')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input name="password" type="password" class="form-control" required="" />
										</div>
									</div>
									<div class="single-wishlist" style="float: right;">
									<button type="submit" class="btn btn-fefault cart">{{ trans('sentence.КИРИШ')}}</button>
								    </div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-1 col-sm-12">
			        </div>
				</div>
			</div>
		</div>

@endsection
