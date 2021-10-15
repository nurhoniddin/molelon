@extends('layouts.frontLayout.front_design')
@section('content')

<!-- Breadcurb AREA -->
		<div class="breadcurb-area">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="#"> </a></li>
				</ul>
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
			</div>
		</div>
		<!-- Product Item AREA -->
		<div class="product-item-area">
			<div class="container">
				<div class="row">
					<div class="checkout-head">
						<h2>{{ trans('sentence.МЕНИНГ ЭЪЛОНЛАРИМ')}}</h2>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="product-item-list">
							<div class="row">
								@if(empty($productCount))
								<div class="row" style="text-align: center; padding: 60px 0px 60px 0px; ">
								<h4>{{ trans('sentence.ХОЗЗИР СИЗДА ЭЪЛОНЛАР ЎЙҚ')}}</h4>
								<a href="{{ url('/add-product') }}" class="btn btn-primary" ><i class="fa fa-plus"></i> {{ trans('sentence.ЭЪЛОН БЕРИШ')}}</a>
							    </div>
								@endif
								@foreach($productsAll as $product)
								<div class="col-md-3 col-sm-6">
									<div class="single-item-area">
										<div class="single-item">
											<div class="product-item-img">
												<a href="{{ url('product/'.$product->id) }}">
													<img class="primary-img" src="{{ asset('images/backend_images/products/medium/'.$product->image) }}" alt="item">
												</a>
												<div class="product-item-action">
													<a href="{{ url('product/'.$product->id) }}"><i class="fa fa-eye"></i></a>
												</div>
											</div>
											<div class="single-item-content">
												<h2><a href="{{ url('product/'.$product->id) }}">{{ $product->product_name }}</a></h2>
												<h3></h3>
											</div>
										</div>
										<div class="item-action-button fix">
											<a href="{{ url('/edit-product/'.$product->id) }}">{{ trans('sentence.ЎЗГАРТИРИШ')}}</a>
											<a style="float: right;" href="{{ url('delete-product/'.$product->id) }}">{{ trans('sentence.ЎЧИРИШ')}}</a>
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
			</div>
		</div>

@endsection