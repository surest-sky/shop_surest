@extends('layout.layout')

@section('main')
    <main id="mainContent" class="main-content">
        <div class="page-container ptb-20">
            <div class="container">
                <section class="wishlist-area ptb-30">
                    <div class="container">
                        <div class="wishlist-wrapper">
                            <h3 class="h-title mb-40 t-uppercase">My Wishlist</h3>
                            <table id="cart_list" class="wishlist">
                                <tbody>

                                @foreach($wishs as $wish)
                                <tr class="panel alert">
                                    <td class="col-sm-8 col-md-9">
                                        <div class="media-left is-hidden-sm-down">
                                            <figure class="product-thumb">
                                                <img src="assets/images/cart/product_11.jpg" alt="product">
                                            </figure>
                                        </div>
                                        <div class="media-body valign-middle">
                                            <h5 class="title mb-5 t-uppercase"><a href="#">Diamond engagement ring</a></h5>
                                            <div class="rating mb-10">
                                                        <span class="rating-stars rate-allow" data-rating="2">
				                        		<i class="fa fa-star-o"></i>
				                        		<i class="fa fa-star-o"></i>
				                        		<i class="fa fa-star-o"></i>
				                        		<i class="fa fa-star-o star-active"></i>
				                        		<i class="fa fa-star-o"></i>
				                        	</span>
                                                <span class="rating-reviews">
				                        		( <span class="rating-count">100</span> rates )
                                                        </span>
                                            </div>
                                            <h4 class="price color-green"><span class="price-sale">$380.00</span>$340.00</h4>
                                            <button class="btn btn-rounded btn-sm mt-15 is-hidden-sm-up">Add To Cart</button>
                                        </div>
                                    </td>
                                    <td class="col-sm-3 col-md-2 is-hidden-xs-down">
                                        <button class="btn btn-rounded btn-sm">Add To Cart</button>
                                    </td>
                                    <td class="col-sm-1">
                                        <button type="button" class="close pr-xs-0 pr-sm-10" data-dismiss="alert" aria-hidden="true">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>


    </main>
@stop