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
						<div class="billing-address" style="padding-top: 100px; padding-bottom: 100px;">
							<div class="checkout-head">
								<h2>{{ trans('sentence.МЕНИНГ ПРОФИЛИМ')}} {{ trans('sentence.ЎЗГАРТИРИШ')}}</h2>
							</div>
							<div class="checkout-form">
								<form id="accountForm" name="accountForm" action="{{ url('/editphoneverifyconfirm') }}" class="form-horizontal" method="POST">
							    {{ csrf_field() }}
									
											<input value="{{ Session::get('name_Session') }}" id="name" name="name" type="hidden" placeholder="Name" class="form-control" required="" />
									
											<input value="{{ Session::get('phone_Session') }}" type="hidden" name="email" id="mobile" placeholder="Mobile" class="form-control" required="" />
										
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ТЕЛЕФОННИНГИЗГА КЕЛГАН СМС ПАРОЛНИ КИРИТИНГ')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input  type="text" name="verify" placeholder="sms code" class="form-control" required="" />
										</div>
									</div>
									<div class="single-wishlist" style="float: right;">
									<button type="submit" class="btn btn-fefault cart">{{ trans('sentence.ЎЗГАРТИРИШ')}}</button>
								    </div>
								</form>
								<form id="registerForm" name="registerForm" action="{{ url('/sendsms') }}" method="POST" class="form-horizontal">
							    {{ csrf_field() }}
									
										
											<input id="email" class="form-control" name="email" type="hidden" placeholder="Phone" value="{{ Session::get('phone_Session') }}" required="" />

											<input id="myPassword" name="password" type="hidden" placeholder="Password" value="{{ Session::get('name_Session') }}" class="form-control" required="" />
										
									
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
