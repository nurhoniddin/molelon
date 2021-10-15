<?php 
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
$mainCategories = Controller::mainCategories();
$categories = Category::with('categories')->where(['parent_id'=>0])->get();
?>
<?php

$locale = App::getLocale();
$oz = "oz";
$yz = "yz";

?>
        <!-- HEADER AREA -->
        <div class="header-area">
			<div class="header-top-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="header-top-left">
								<div class="header-top-menu">
									<ul class="list-inline">
										<li class="dropdown open">
											<a href="{{ url('lang/oz') }}">O'ZBEKCHA</a>
                                            <a href="{{ url('lang/yz') }}">ЎЗБЕКЧА</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="header-top-right">
								<ul class="list-inline" style="text-transform: uppercase;">
									<li><a href="{{ url('/add-product') }}"><i class="fa fa-plus"></i> {{ trans('sentence.ЭЪЛОН БЕРИШ')}}</a></li>
									<li><a href="{{ url('/cart') }}"><i class="fa fa-heart"></i> {{ trans('sentence.САҚЛАНГАНЛАР')}}</a></li>
									@if(Auth::check())
									<li><a href="{{ url('/view-products') }}"><i class="fa fa-user"></i> {{ trans('sentence.МЕНИНГ ЭЪЛОНЛАРИМ')}}</a></li>
									@endif
									@if(empty(Auth::check()))
									<li><a href="{{ url('/login-register') }}"><i class="fa fa-lock"></i> {{ trans('sentence.КИРИШ')}}</a></li>
									@else
									<li><a href="{{ url('/account') }}"><i class="fa fa-user"></i>{{ trans('sentence.МЕНИНГ ПРОФИЛИМ')}}</a></li>
									<li><a href="{{ url('/user-logout') }}"><i class="fa fa-sign-out"></i> {{ trans('sentence.ЧИҚИШ')}}</a></li>
									@endif
									</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-sm-2 col-xs-12">
							<div class="header-logo">
								<a href="{{ asset('/') }}"><img src="{{ asset('images/frontend_images/logo.png') }}" alt="logo"></a>
							</div>
						</div>
						<div class="col-md-10 col-sm-10 col-xs-12">
							<div class="search-chart-list">
								<div class="header-search">
									<form action="{{ url('/search-products') }}" method="post">
							        {{ csrf_field() }}
										<input type="text" placeholder="{{ trans('sentence.ҚИДИРУВ')}}" name="product" />
										<button type="submit"><i class="fa fa-search"></i></button>
									</form>
								</div>
								<div class="header-chart">
									<ul class="list-inline">
										<li class="chart-li"><a href="{{ url('/add-product') }}" >{{ trans('sentence.ЭЪЛОН БЕРИШ')}}</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        <!-- MAIN MENU AREA -->
		<div class="main-menu-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-menu hidden-xs">
							<nav>
								<ul>
									@foreach($categories as $cat)
									<li><a href="{{ asset('/products/'.$cat->url) }}">
                                        @if($locale == $oz)
										{{ $cat->name }}
										@endif
										@if($locale == $yz)
										{{ $cat->name_yz }}
										@endif
									</a>
										<ul class="sub-menu">
                                            @foreach($cat->categories as $subcat)
                                            <?php $productCount = Product::productCount($subcat->id); ?>
											<li><a href="{{ asset('/products/'.$subcat->url) }}">
												@if($locale == $oz)
												{{ $subcat->name }}
												@endif
												@if($locale == $yz)
												{{ $subcat->name_yz }}
												@endif
											</a></li>
                                            @endforeach
										</ul>
									</li>
									@endforeach
								</ul>
							</nav>
						</div>
						<!-- Mobile MENU AREA -->
						<div class="mobile-menu hidden-sm hidden-md hidden-lg">
							<nav>
								<ul>
									<li><a href="{{ asset('/') }}">{{ trans('sentence.БОШ САХИФА')}}</a></li>
									@foreach($categories as $cat)
									<li><a href="{{ asset('/products/'.$cat->url) }}">
										@if($locale == $oz)
										{{ $cat->name }}
										@endif
										@if($locale == $yz)
										{{ $cat->name_yz }}
										@endif
									</a>
										<ul>
											@foreach($cat->categories as $subcat)
                                            <?php $productCount = Product::productCount($subcat->id); ?>
											<li><a href="{{ asset('/products/'.$subcat->url) }}">
												@if($locale == $oz)
												{{ $subcat->name }}
												@endif
												@if($locale == $yz)
												{{ $subcat->name_yz }}
												@endif
											</a></li>
											@endforeach
										</ul>
									</li>
									@endforeach
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>