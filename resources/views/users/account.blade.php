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
						<div class="billing-address" style="padding-top: 70px; padding-bottom: 100px;">
							<div class="checkout-head">
								<h2>{{ trans('sentence.МЕНИНГ ПРОФИЛИМ')}} {{ trans('sentence.ЎЗГАРТИРИШ')}}</h2>
							</div>
							<div class="checkout-form">
								<form id="accountForm" name="accountForm" action="{{ url('/account') }}" class="form-horizontal" method="POST">
							    {{ csrf_field() }}
									<div class="form-group">
										<div class="col-md-9">
											<input value="{{ $userDetails->name }}" id="name" name="name" type="text" placeholder="{{ trans('sentence.ИСМ')}}" class="form-control" required="" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-9">
											<input value="{{ $userDetails->email }}" type="text" name="email" id="mobile" placeholder="{{ trans('sentence.ТЕЛЕФОН')}}" class="form-control" required="" />
										</div>
									</div>
									<div class="single-wishlist">
									<button type="submit" class="btn btn-fefault cart">{{ trans('sentence.ЎЗГАРТИРИШ')}}</button>
								    </div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-2">
					</div>
					<div class="col-md-5 col-sm-12">
						<div class="billing-address"  style="padding-top: 70px; padding-bottom: 100px;">
							<div class="checkout-head">
								<h2>{{ trans('sentence.ПАРОЛЬ')}} {{ trans('sentence.ЎЗГАРТИРИШ')}}</h2>
							</div>
							<div class="checkout-form">
							    <form id="passwordForm" name="passwordForm" action="{{ url('/update-user-pwd') }}" method="POST" class="form-horizontal">
						        {{ csrf_field() }} 
									<div class="form-group">
										<div class="col-md-9">
											<input type="password" name="current_pwd" id="current_pwd" placeholder="{{ trans('sentence.ХОЗЗИРГИ ПАРОЛИНГИЗНИ КИРИТИНГ')}}" class="form-control" required="" />
											<span id="chkPwd"></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-9">
											<input type="password" name="new_pwd" id="new_pwd" placeholder="{{ trans('sentence.ЙАНГИ ПАРОЛ КИРИТИНГ')}}" class="form-control" required="" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-9">
											<input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="{{ trans('sentence.ЙАНГИ ПАРОЛНИ ҚАЙТА КИРИТИНГ')}}" class="form-control" required="" />
										</div>
									</div>
									<div class="single-wishlist">
									<button type="submit" class="btn btn-fefault cart">{{ trans('sentence.ЎЗГАРТИРИШ')}}</button>
								    </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection
