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
						<div class="billing-address" style="padding-top: 70px; padding-bottom: 100px;">
							<div class="checkout-head">
								<h2>{{ trans('sentence.ЭЪЛОН БЕРИШ')}}</h2>
							</div>
							<div class="checkout-form">
							    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/add-product')  }}" name="add_product" id="add_product" >
            	                   {{ csrf_field() }}
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.КАТЕГОРИЯНИ ТАНЛАНГ')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<div class="controls">
							                  <select name="category_id" id="category_id" required="">
							                   <?php echo $categories_dropdown; ?>
							                  </select>
							                </div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.САРЛАВХА ЙОЗИНГ')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<input type="text" name="product_name" id="product_name" class="form-control" required="" >
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ҚЎШИМЧА МАЛУМОТ ЙОЗИНГ')}} <sup></sup>
										</label>
										<div class="col-md-9">
											<textarea name="description" id="description"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.НАРХИ')}} <sup>*</sup>
										</label>
										<div class="col-md-6">
											<input type="text" name="price" id="price" class="form-control" required="" >
										</div>
										<div class="col-md-3">
											<select name="price_type" id="price_type">
							                   <option value='so’m'>so’m</option>
							                   <option value='y.e.'>y.e.</option>
							                </select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">
											{{ trans('sentence.РАСМИ')}} <sup>jpeg,png,jpg</sup> <sup>*</sup>
										</label>
										<div class="col-md-5">
											<input type="file" name="image" id="image" class="form-control" required="">
										</div>
										<div class="col-md-5">
											<input type="file" name="images[]" id="image" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">
											 <sup></sup>
										</label>
										<div class="col-md-5">
											<input type="file" name="images[]" id="image" class="form-control">
										</div>
										<div class="col-md-5">
											<input type="file" name="images[]" id="image" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">
											 <sup></sup>
										</label>
										<div class="col-md-5">
											<input type="file" name="images[]" id="image" class="form-control">
										</div>
										<div class="col-md-5">
											<input type="file" name="images[]" id="image" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">
											 <sup></sup>
										</label>
										<div class="col-md-5">
											<input type="file" name="images[]" id="image" class="form-control">
										</div>
										<div class="col-md-5">
											<input type="file" name="images[]" id="image" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-2">
											 <sup></sup>
										</label>
										<div class="col-md-5">
											<input type="file" name="images[]" id="image" class="form-control">
										</div>
										<div class="col-md-5">
											<input type="file" name="images[]" id="image" class="form-control">
										</div>
									</div>
									<br>
									<br>
									<div class="checkout-head">
										<h2>{{ trans('sentence.АЛОҚА УЧУН МАЛУМОТ')}}</h2>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
											{{ trans('sentence.ВИЛОЙАТ ТУМАН ТАНЛАНГ')}} <sup>*</sup>
										</label>
										<div class="col-md-9">
											<select id="country" name="country_id" class="form-control" required="">
												<?php echo $country_dropdown; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
										  {{ trans('sentence.ТЕЛЕФОН')}} <sup></sup>
										</label>
										<div class="col-md-7">
											<input type="text" class="form-control" value="{{ $userDetails->email }}" readonly="" disabled=""> 
										</div>
										<div class="col-md-2">
											 <a style="padding-top: 6px; display: inline-block;" href="{{ url('/account/') }}">{{ trans('sentence.ЎЗГАРТИРИШ')}}</a>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">
										  {{ trans('sentence.ИСМ')}} <sup></sup>
										</label>
										<div class="col-md-7">
											<input type="text" class="form-control" value="{{ $userDetails->name }}" readonly="" disabled=""> 
										</div>
										<div class="col-md-2">
											 <a style="padding-top: 6px; display: inline-block;" href="{{ url('/account/') }}">{{ trans('sentence.ЎЗГАРТИРИШ')}}</a>
										</div>
									</div>
									<input type="hidden" name="status" id="status" value="1">
									<div class="single-wishlist" style="float: right;">
									<button type="submit" class="btn btn-fefault cart">{{ trans('sentence.ЭЪЛОН БЕРИШ')}}</button>
								    </div>
								    <br>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-10 col-sm-12">
					</div>
				</div>
			</div>
		</div>

@endsection
