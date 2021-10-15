@extends('layouts.frontLayout.front_design')
@section('content')
<?php

$locale = App::getLocale();
$oz = "oz";
$yz = "yz";

?>
<!-- Breadcurb AREA -->
		<div class="breadcurb-area">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="#"></a></li>
				</ul>
		@if(Session::has('flash_message_error')) 
          <div class="alert alert-success alert-block">
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
			</div>
		</div>
		<!-- Product Item AREA -->
		<div class="product-item-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-8">
						<div class="product-item-list">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="product-item-heading">
										<div class="item-heading-title">
											<h2>
												@if(!empty($categoryDetails->name))
												@if($locale == $oz)
												{{ $categoryDetails->name }}
												@endif
												@if($locale == $yz)
												{{ $categoryDetails->name_yz }}
												@endif
												@endif
											</h2>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								@php
								   $i = 0;
								@endphp
								@foreach($productsAll as $product)
								@php
									$i++;
								@endphp
								<div class="col-md-3 col-sm-6">
									<div class="single-item-area">
										<div class="single-product">
											<div class="product-item-img">
												<a href="{{ url('product/'.$product->id) }}">
													<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$product->image) }}" alt="item">
												</a>
												<div class="product-item-action">
													<a href="{{ url('product/'.$product->id) }}"><i class="fa fa-eye"></i></a>
												</div>
											</div>
											<div class="single-product-content">
												<div class="product-content-left">
												<h2><a href="{{ url('product/'.$product->id) }}">{{ $product->product_name }}</a></h2>
											    </div>
											    <div class="product-content-right">
												<h3>{{ $product->price }} {{ $product->price_type }}</h3>
											    </div>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="shop-pagination floatright">
							<ul class="pagination">
								<li>{{ $productsAll->links() }}</li>
							</ul>
						</div>
					</div>
				</div>
				@if($i == 0)
				<div class="row" style="text-align: center; padding: 30px 0px 90px 0px; ">
				<h4>{{ trans('sentence.ЭЪЛОН ТОПИЛМАДИ')}}</h4>
				<a href="{{ url('/') }}" class="btn btn-primary"> {{ trans('sentence.БОШ САХИФА')}}</a>
			    </div>
				@endif
			</div>
		</div>


@endsection