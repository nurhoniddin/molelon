@extends('layouts.frontLayout.front_design')
@section('content')

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
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="product-item-tab">
									<!-- Tab panes -->
									<div class="single-tab-content">
										<div class="tab-content">
											<div role="tabpanel" class="tab-pane active" id="img-one">
												<a href="{{ asset('images/backend_images/products/large/'.$productDetails->image) }}" class="highslide" onclick="return hs.expand(this)">
												<img src="{{ asset('images/backend_images/products/large/'.$productDetails->image) }}" alt="tab-img">
												</a>
											</div>
										</div>
									</div>
									<!-- Nav tabs -->
									<div class="single-tab-img">
										<ul class="nav nav-tabs" role="tablist">
											@foreach($productAltImages as $altimage)
											<li role="presentation" class="active"><a href="{{ asset('images/backend_images/products/gallery/large/'.$altimage->image) }}" class="highslide" onclick="return hs.expand(this)" role="tab" data-toggle="tab"><img src="{{ asset('images/backend_images/products/gallery/small/'.$altimage->image) }}" style="width: 109px; height: 100px; margin-top: 3px;" alt="tab-img"></a></li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<form name="addtocartForm" id="addtocartForm" action="{{ url('add-cart') }}">
                            	{{ csrf_field() }}
                            	<input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                            	<input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
                            	<input type="hidden" name="price" id="price" value="{{ $productDetails->price }}">
                            	<input type="hidden" name="price_type" id="price" value="{{ $productDetails->price_type }}">
								<div class="product-tab-content">
									<div class="product-tab-header">
										<h1>{{ $productDetails->product_name }}</h1>
										<h3 id="getPrice">{{ $productDetails->price }} {{ $productDetails->price_type }}</h3>
									</div>
									<div class="product-item-code">
										
									</div>
									<div class="product-item-details">
										<p>{{ trans('sentence.АЛОҚА УЧУН МАЛУМОТ')}}</p>
									</div>
									<div class="product-item-details">
										<p>{{ $productCountrysity->country_name }}</p>
									</div>
									<div class="product-item-details">
										<p>{{ $productCountry->country_name }}</p>
									</div>
									<div class="available-option">
										<h2>{{ trans('sentence.ФОЙДАЛАНУВЧИ ИСМИ')}}:</h2>
										<div class="color-option fix">
											<p>{{ trans('sentence.ИСМ')}} :  {{ $userDetails->name }} </p>
										</div>
										<h2>{{ trans('sentence.ФОЙДАЛАНУВЧИ ТЕЛЕФОНИ')}}:</h2>
										<div class="color-option fix">
											<p>{{ trans('sentence.ТЕЛЕФОН')}} :   {{ $userDetails->email }}</p>
										</div>
										<div class="wishlist-icon">
											
											<div class="single-wishlist">
												<button type="submit" class="btn btn-fefault cart" id="cartButton" name="cartButton" value="Shopping Cart">
													<i class="fa fa-heart"></i> {{ trans('sentence.САҚЛАНГАНЛАРГА')}}
												</button>
											</div>
											
										</div>
									</div> 
								</div>
							</form>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="description-tab">
								<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#description" role="tab" data-toggle="tab">{{ trans('sentence.ҚЎШИМЧА МАЛУМОТ')}}</a></li>
									</ul>
									  <!-- Tab panes -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="description">
											<p style="font-size: 18px;">{{ $productDetails->description }}</p>
										</div>
										<div role="tabpanel" class="tab-pane" id="information">
											<p></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="single-product-slider similar-product">
									<div class="product-items">
										<h2 class="product-header">{{ trans('sentence.ЎХШАШ ЭЪЛОНЛАР')}}</h2>
										<div class="row">
											<div id="singleproduct-slider" class="owl-carousel">
												@foreach($relatedProducts as $item)
												<div class="col-md-4">
											<div class="single-product">
												<div class="single-product-img">
													<a href="{{ url('product/'.$item->id) }}">
														<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$item->image) }}" alt="product">
														<!-- <img class="secondary-img" src="img/product/kids-1.jpg" alt="product"> -->
													</a>
													<div class="single-product-action">
														<a href="{{ url('product/'.$item->id) }}"><i class="fa fa-eye"></i></a>
													</div>
												</div>
												<div class="single-product-content">
													<div class="product-content-left">
														<h2><a href="{{ url('product/'.$item->id) }}">{{ $item->product_name }}</a></h2>
													</div>
													<div class="product-content-right">
														<h3>{{ $item->price }} {{ $item->price_type }}</h3>
													</div>
												</div>
											</div>
										</div>
												 @endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<script type="text/javascript" src="{{ asset('highslide/highslide-with-gallery.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('highslide/highslide.css') }}" />
  <script type="text/javascript">
      hs.graphicsDir = '/highslide/graphics/';
      hs.align = 'center';
      hs.transitions = ['expand', 'crossfade'];
      hs.wrapperClassName = 'dark borderless floating-caption';
      hs.fadeInOut = true;
      hs.dimmingOpacity = .75;

      // Add the controlbar
      if (hs.addSlideshow) hs.addSlideshow({
          //slideshowGroup: 'group1',
          interval: 5000,
          repeat: false,
          useControls: true,
          fixedControls: 'fit',
          overlayOptions: {
              opacity: .6,
              position: 'bottom center',
              hideOnMouseOut: true
          }
      });
  </script>

@endsection