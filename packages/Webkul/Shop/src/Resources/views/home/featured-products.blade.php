<section class="featured-products">

        <div class="featured-heading">Classes<br/>

            <span class="featured-seperator" style="color:lightgrey;">_____</span>
        </div>

        <div class="featured-grid product-grid-4">

          <div class="featured-grid product-grid-4"><div class="product-card"><div class="product-image"><a href="http://127.0.0.1:8000/SwimmingPool" title="Sunglasses"><img src="http://127.0.0.1:8000/vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png" onerror="this.src='http://127.0.0.1:8000/vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png'"></a></div> <div class="product-information"><div class="product-name"><a href="http://127.0.0.1:8000/SwimmingPool" title="Swimming Pool 1"><span>
                    Swimming Pool 1
                </span></a></div> <div class="product-price"><span>$10.00</span></div> <div class="cart-wish-wrap"><form action="http://127.0.0.1:8000/checkout/cart/add/4" method="POST"><input type="hidden" name="_token" value="JYC9nNtgV0LtKck8jQQ700DqIaWeHS5sPCAHeCJZ"><input type="hidden" name="price" value="10"> <input type="hidden" name="product_id" value="4"><input type="hidden" name="product_type" value="class"> <input type="hidden" name="quantity" value="1"> <button class="btn btn-lg btn-primary addtocart">Add To Cart</button></form></div></div></div></div>



          <div class="featured-grid product-grid-4"><div class="product-card"><div class="product-image"><a href="http://127.0.0.1:8000/SwimmingPool" title="Sunglasses"><img src="http://127.0.0.1:8000/vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png" onerror="this.src='http://127.0.0.1:8000/vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png'"></a></div> <div class="product-information"><div class="product-name"><a href="http://127.0.0.1:8000/SwimmingPool" title="Swimming Pool 2"><span>
                    Swimming Pool 2
                </span></a></div> <div class="product-price"><span>$9.00</span></div> <div class="cart-wish-wrap"><form action="http://127.0.0.1:8000/checkout/cart/add/2" method="POST"><input type="hidden" name="_token" value="JYC9nNtgV0LtKck8jQQ700DqIaWeHS5sPCAHeCJZ"> <input type="hidden" name="price" value="9"><input type="hidden" name="product_id" value="2"> <input type="hidden" name="product_type" value="class"><input type="hidden" name="quantity" value="1"> <button class="btn btn-lg btn-primary addtocart">Add To Cart</button></form></div></div></div></div>


          <div class="featured-grid product-grid-4"><div class="product-card"><div class="product-image"><a href="http://127.0.0.1:8000/SwimmingPool" title="Sunglasses"><img src="http://127.0.0.1:8000/vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png" onerror="this.src='http://127.0.0.1:8000/vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png'"></a></div> <div class="product-information"><div class="product-name"><a href="http://127.0.0.1:8000/SwimmingPool" title="Swimming Pool 3"><span>
                    Swimming Pool 3
                </span></a></div> <div class="product-price"><span>$20.00</span></div> <div class="cart-wish-wrap"><form action="http://127.0.0.1:8000/checkout/cart/add/2" method="POST"><input type="hidden" name="_token" value="JYC9nNtgV0LtKck8jQQ700DqIaWeHS5sPCAHeCJZ"> <input type="hidden" name="product_id" value="3"><input type="hidden" name="price" value="20"><input type="hidden" name="product_id" value="3"><input type="hidden" name="product_type" value="class"> <input type="hidden" name="quantity" value="1"> <button class="btn btn-lg btn-primary addtocart">Add To Cart</button></form></div></div></div></div>

        </div>

    </section>

    @if (app('Webkul\Product\Repositories\ProductRepository')->getFeaturedProducts()->count())
    <section class="featured-products">

        <div class="featured-heading">
            {{ __('shop::app.home.featured-products') }}<br/>

            <span class="featured-seperator" style="color:lightgrey;">_____</span>
        </div>

        <div class="featured-grid product-grid-4">

            @foreach (app('Webkul\Product\Repositories\ProductRepository')->getFeaturedProducts() as $productFlat)
            <?php  $productFlat ['product_type'] = 'product'; ?>

                @include ('shop::products.list.card', ['product' => $productFlat])

            @endforeach

        </div>

    </section>
@endif
