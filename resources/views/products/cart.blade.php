@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Product; ?>
        <!-- Breadcurb AREA -->
		<div class="breadcurb-area">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="#"></a></li>
				</ul>
			</div>
		</div>
		<!-- Chart AREA -->
		<div class="chart-area">
			<div class="container">
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
		        <div class="row">
					<div class="col-md-12">
						<div class="chart-item table-responsive fix">
							<table class="col-md-12">
								<thead>
									<tr>
										<th class="th-product"></th>
										<th class="th-details"></th>
										<th class="th-price"></th>
										<th class="th-delate"></th>
									</tr>
								</thead>
								<tbody>
										@php
										   $i = 0;
										@endphp
                                    @foreach($userCart as $cart)
	                                    @php
											$i++;
										@endphp
									<tr>
										<td class="th-details">
											@if(!empty($cart->image))
											<a href="{{ url('product/'.$cart->id) }}"><img style="width: 100px;" src="{{ asset('images/backend_images/products/medium/'.$cart->image) }}" alt="cart"></a>
											@endif
										</td>
										<td class="th-details">
											<h2><a href="{{ url('product/'.$cart->id) }}">{{ $cart->product_name }}</a></h2>
										</td>
										<td class="th-details"  style="text-align: center;">{{ $cart->price }} {{ $cart->price_type }}</td>
										<td class="th-details"  style="text-align: center; font-size: 24px;"><a href="{{ url('/cart/delete-product/'.$cart->id) }}"><i class="fa fa-trash"></i></a></td>
									</tr>
                                    @endforeach
                                </tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="shop-pagination floatright" style="margin-top: 20px;">
					<ul class="pagination">
						<li>{{ $userCart->links() }}</li>
					</ul>
				</div>
				@if($i == 0)
				<div class="row" style="text-align: center; padding: 90px 0px 90px 0px; ">
				<h4>{{ trans('sentence.ХОЗЗИР СИЗДА САҚЛАНГАНЛАР ЎЙҚ')}}</h4>
			    </div>
				@endif
			</div>
		</div>
@endsection