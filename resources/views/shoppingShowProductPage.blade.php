@extends('shoppingPageLayout')
@section('content')

<!-- ================ category section start ================= -->		  
<section class="section-margin--small mb-5">
    <div class="container">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="sidebar-categories">
            <div class="head">Browse Categories</div>
            <ul class="main-categories">
              <li class="common-filter">
                @foreach($categoryID as $category)
                <form action="{{route('search.product')}}" method="POST" id="filter">
                @csrf
                  <ul>
                    <li class="filter-list">
                      <input class="pixel-radio" type="radio" id="catogoryFilter" name="categoryFilter" value="{{$category->name}}">
                      <label for="catname">{{$category->name}}<span></span></label></li>
                  </ul>
                </form>
                @endforeach
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
          <!-- Start Filter Bar -->
          <div class="filter-bar d-flex flex-wrap align-items-center">
            <div class="sorting">
              <select>
                <option value="1">Default sorting</option>
                <option value="1">Price low to high</option>
                <option value="1">Price high to low</option>
              </select>
            </div>
            <div class="sorting mr-auto">
              <select>
                <option value="1">Show 10</option>
                <option value="1">Show 20</option>
                <option value="1">Show 30</option>
              </select>
            </div>
            <div>
            </form>
              <form class="input-group filter-bar-search" method="POST" action="{{route('search.product')}}">
              @csrf
                <input type="text" name="keyword" type="search" placeholder="Search Products" aria-label="Search">
                <div class="input-group-append">
                  <button type="submit"><i class="ti-search"></i></button>
                </div>
              </form>
            </div>
          </div>
          <!-- End Filter Bar -->
          <!-- Start Best Seller -->
          <section class="lattest-product-area pb-40 category-list">
            <div class="row">
            @foreach($products as $product)
              <div class="col-md-6 col-lg-4">
                <div class="card text-center card-product">
                  <div class="card-product__img">
                    <img class="card-img" src="{{asset('images/')}}/{{$product->image}}" alt="" height="180px">
                    <ul class="card-product__imgOverlay">
                      <li><button><i class="ti-search"></i></button></li>
                      <li><button><i class="ti-shopping-cart"></i></button></li>
                      <li><button><i class="ti-heart"></i></button></li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <p>{{$product->catname}}</p>
                    <h4 class="card-product__title"><a href="{{ route('shoppingShowProductDetails',['id'=>$product->id]) }}">{{$product->name}}</a></h4>
                    <p class="card-product__price">RM {{$product->price}}</p>
                    
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </section>
          <!-- End Best Seller -->
        </div>
      </div>
    </div>
  </section>
	<!-- ================ category section end ================= -->		  

@endsection