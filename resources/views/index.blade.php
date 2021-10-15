@extends('layouts.frontLayout.front_design')
@section('content')

        <!-- SUPPORT AREA -->
		<div class="support-area">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-4 col-xs-12">
						<div class="single-support">
							<div class="sigle-support-icon">
								<p><i class="fa fa-pencil-square-o"></i></p>
							</div>
							<div class="sigle-support-content">
								<p>{{ trans('sentence.Бу сайтда сиз қишлоқ ҳўжалик ҳайвонларини сотиш учун  эълон беришингиз мумкин ва сизни қизиқтирган эълонни топиб эълон берувчи билан боғланиб сотиб олишингиз мумкин.')}}</p>
							</div>
						</div>
					</div>
					<div class="col-md-6 hidden-sm col-xs-12">
						<div class="single-support">
							<div class="sigle-support-icon">
								<p><i class="fa fa-pencil-square-o"></i></p>
							</div>
							<div class="sigle-support-content">
								<p>{{ trans('sentence.Сайтда эълон бериш учун "кириш" тугмасини босинг ва рўйҳатдан ўтиб "эълон бериш" тугмасини босинг ва ўз эълоннингизни жойлаштиринг.')}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
       
        <!-- Product AREA -->
		<div class="product-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-8">
						<div class="product-items-area">
							<div class="product-items">
								<h2 class="product-header">{{ trans('sentence.МОЛЛАР')}}</h2>
								<div class="row">
									<div id="product-slider" class="owl-carousel">
                                        @foreach($mollar as $product)
										<div class="col-md-3">
											<div class="single-product">
												<div class="single-product-img">
													<a href="{{ url('product/'.$product->id) }}">
														<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$product->image) }}" alt="product">
														<!-- <img class="secondary-img" src="img/product/kids-1.jpg" alt="product"> -->
													</a>
													<div class="single-product-action">
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
                                        @endforeach
									</div>
								</div>
							</div>
							<div class="product-items">
								<h2 class="product-header">{{ trans('sentence.ҚЎЙЛАР ВА ҚЎЧҚОРЛАР')}}</h2>
								<div class="row">
									<div id="product-slider" class="owl-carousel">
                                        @foreach($qoylar as $product)
										<div class="col-md-3">
											<div class="single-product">
												<div class="single-product-img">
													<a href="{{ url('product/'.$product->id) }}">
														<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$product->image) }}" alt="product">
														<!-- <img class="secondary-img" src="img/product/kids-1.jpg" alt="product"> -->
													</a>
													<div class="single-product-action">
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
                                        @endforeach
									</div>
								</div>
							</div>
							<div class="product-items">
								<h2 class="product-header">{{ trans('sentence.ЕЧКИЛАР ВА УЛОҚЛАР')}}</h2>
								<div class="row">
									<div id="product-slider" class="owl-carousel">
                                        @foreach($echkilar as $product)
										<div class="col-md-3">
											<div class="single-product">
												<div class="single-product-img">
													<a href="{{ url('product/'.$product->id) }}">
														<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$product->image) }}" alt="product">
														<!-- <img class="secondary-img" src="img/product/kids-1.jpg" alt="product"> -->
													</a>
													<div class="single-product-action">
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
                                        @endforeach
									</div>
								</div>
							</div>
							<div class="product-items">
								<h2 class="product-header">{{ trans('sentence.ТОВУҚЛАР')}}</h2>
								<div class="row">
									<div id="product-slider" class="owl-carousel">
                                        @foreach($tovuqlar as $product)
										<div class="col-md-3">
											<div class="single-product">
												<div class="single-product-img">
													<a href="{{ url('product/'.$product->id) }}">
														<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$product->image) }}" alt="product">
														<!-- <img class="secondary-img" src="img/product/kids-1.jpg" alt="product"> -->
													</a>
													<div class="single-product-action">
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
                                        @endforeach
									</div>
								</div>
							</div>
							<div class="product-items">
								<h2 class="product-header">{{ trans('sentence.БОШҚА ХАЙВОНЛАР')}}</h2>
								<div class="row">
									<div id="product-slider" class="owl-carousel">
                                        @foreach($boshqahayvonlar as $product)
										<div class="col-md-3">
											<div class="single-product">
												<div class="single-product-img">
													<a href="{{ url('product/'.$product->id) }}">
														<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$product->image) }}" alt="product">
														<!-- <img class="secondary-img" src="img/product/kids-1.jpg" alt="product"> -->
													</a>
													<div class="single-product-action">
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
                                        @endforeach
									</div>
								</div>
							</div>
							<div class="product-items">
								<h2 class="product-header">{{ trans('sentence.ЕМИШЛАР')}}</h2>
								<div class="row">
									<div id="product-slider" class="owl-carousel">
                                        @foreach($yemishlar as $product)
										<div class="col-md-3">
											<div class="single-product">
												<div class="single-product-img">
													<a href="{{ url('product/'.$product->id) }}">
														<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$product->image) }}" alt="product">
														<!-- <img class="secondary-img" src="img/product/kids-1.jpg" alt="product"> -->
													</a>
													<div class="single-product-action">
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
                                        @endforeach
									</div>
								</div>
							</div>
							<div class="product-items">
								<h2 class="product-header">{{ trans('sentence.ЕМЛАР')}}</h2>
								<div class="row">
									<div id="product-slider" class="owl-carousel">
                                        @foreach($yemlar as $product)
										<div class="col-md-3">
											<div class="single-product">
												<div class="single-product-img">
													<a href="{{ url('product/'.$product->id) }}">
														<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$product->image) }}" alt="product">
														<!-- <img class="secondary-img" src="img/product/kids-1.jpg" alt="product"> -->
													</a>
													<div class="single-product-action">
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
                                        @endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection
