@if (app('Webkul\Classes\Repositories\ClassesRepository')->getFeaturedClasses()->count())
    <section class="featured-products">

        <div class="featured-heading">
            {{ __('shop::app.home.classes') }}<br/>

            <span class="featured-seperator" style="color:lightgrey;">_____</span>
        </div>

        <div class="featured-grid product-grid-4">

          <div class="featured-grid product-grid-4"><div class="product-card"><div class="product-image"><a href="http://127.0.0.1:8000/sunglasses" title="Sunglasses"><img src="http://127.0.0.1:8000/vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png" onerror="this.src='http://127.0.0.1:8000/vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png'"></a></div> <div class="product-information"><div class="product-name"><a href="http://127.0.0.1:8000/sunglasses" title="Sunglasses"><span>
                    Sunglasses
                </span></a></div> <div class="product-price"><span>$300.00</span></div> <div class="cart-wish-wrap"><form action="http://127.0.0.1:8000/checkout/cart/add/2" method="POST"><input type="hidden" name="_token" value="3YC7kS1CDdaxnzwVdZNLZoW2G7GoyxxKlxrlAGFG"> <input type="hidden" name="product_id" value="2"> <input type="hidden" name="quantity" value="1"> <button class="btn btn-lg btn-primary addtocart">Add To Cart</button></form></div></div></div></div>

        </div>

    </section>
@endif