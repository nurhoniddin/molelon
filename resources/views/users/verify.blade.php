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
					<div class="col-md-1">
					</div>
					<div class="col-md-10 col-sm-12">
						<div class="billing-address"  style="padding-top: 100px; padding-bottom: 100px;">
							<div class="checkout-head">
								<h2>{{ trans('sentence.РЎЙХАТДАН ЎТИШ')}}</h2>
							</div>
							<div class="checkout-form">
								<form id="registerForm" name="registerForm" action="{{ url('/confirm') }}" method="POST" class="form-horizontal">
							    {{ csrf_field() }}
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ТЕЛЕФОННИНГИЗГА КЕЛГАН СМС ПАРОЛНИ КИРИТИНГ')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input id="name" class="form-control" name="verify" type="text" required="" />
										</div>
									</div>
									
										<div class="col-md-9">
											<input id="email" class="form-control" name="email" type="hidden" placeholder="Phone" value="{{ Session::get('emailSession') }}" required="" />
										</div>
									
								
										<div class="col-md-9">
											<input id="myPassword" name="password" type="hidden" placeholder="Password" value="{{ Session::get('passwordSession') }}" class="form-control" required="" />
										</div>
									
									<div class="single-wishlist" style="float: right;">
									<button type="submit" class="btn btn-fefault cart">{{ trans('sentence.РЎЙХАТДАН ЎТИШ')}}</button>
								    </div>
								</form>
								<form id="registerForm" name="registerForm" action="{{ url('/sendsms') }}" method="POST" class="form-horizontal">
							    {{ csrf_field() }}
									
										
											<input id="email" class="form-control" name="email" type="hidden" placeholder="Phone" value="{{ Session::get('emailSession') }}" required="" />

											<input id="myPassword" name="password" type="hidden" placeholder="Password" value="{{ Session::get('passwordSession') }}" class="form-control" required="" />
										
									
									<div class="single-wishlist" style="float: right;">
									<button type="submit" class="btn btn-fefault cart">{{ trans('sentence.СМСНИ ҚАЙТА ЙУБОРИШ')}}</button>
								    </div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-1">
					</div>
				</div>
			</div>
		</div>

@endsection
