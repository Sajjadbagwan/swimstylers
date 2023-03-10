<?php

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
    //Store front home
    Route::get('/', 'Swim\Shop\Http\Controllers\HomeController@index')->defaults('_config', [
        'view' => 'shop::home.index'
    ])->name('shop.home.index');

    //subscription
    //subscribe
    Route::get('/subscribe', 'Swim\Shop\Http\Controllers\SubscriptionController@subscribe')->name('shop.subscribe');

    //unsubscribe
    Route::get('/unsubscribe/{token}', 'Swim\Shop\Http\Controllers\SubscriptionController@unsubscribe')->name('shop.unsubscribe');

    //Store front search
    Route::get('/search', 'Swim\Shop\Http\Controllers\SearchController@index')->defaults('_config', [
        'view' => 'shop::search.search'
    ])->name('shop.search.index');

    //Country State Selector
    Route::get('get/countries', 'Swim\Core\Http\Controllers\CountryStateController@getCountries')->defaults('_config', [
        'view' => 'shop::test'
    ])->name('get.countries');

    //Get States When Country is Passed
    Route::get('get/states/{country}', 'Swim\Core\Http\Controllers\CountryStateController@getStates')->defaults('_config', [
        'view' => 'shop::test'
    ])->name('get.states');

    //checkout and cart
    //Cart Items(listing)
    Route::get('checkout/cart', 'Swim\Shop\Http\Controllers\CartController@index')->defaults('_config', [
        'view' => 'shop::checkout.cart.index'
    ])->name('shop.checkout.cart.index');

    Route::post('checkout/cart/coupon', 'Swim\Shop\Http\Controllers\CartController@applyCoupon')->name('shop.checkout.cart.coupon.apply');

    Route::delete('checkout/cart/coupon', 'Swim\Shop\Http\Controllers\CartController@removeCoupon')->name('shop.checkout.coupon.remove.coupon');

    //Cart Items Add
    Route::post('checkout/cart/add/{id}', 'Swim\Shop\Http\Controllers\CartController@add')->defaults('_config', [
        'redirect' => 'shop.checkout.cart.index'
    ])->name('cart.add');

    //Cart Items Remove
    Route::get('checkout/cart/remove/{id}', 'Swim\Shop\Http\Controllers\CartController@remove')->name('cart.remove');

    //Cart Update Before Checkout
    Route::post('/checkout/cart', 'Swim\Shop\Http\Controllers\CartController@updateBeforeCheckout')->defaults('_config', [
        'redirect' => 'shop.checkout.cart.index'
    ])->name('shop.checkout.cart.update');

    //Cart Items Remove
    Route::get('/checkout/cart/remove/{id}', 'Swim\Shop\Http\Controllers\CartController@remove')->defaults('_config', [
        'redirect' => 'shop.checkout.cart.index'
    ])->name('shop.checkout.cart.remove');

    //Checkout Index page
    Route::get('/checkout/onepage', 'Swim\Shop\Http\Controllers\OnepageController@index')->defaults('_config', [
        'view' => 'shop::checkout.onepage'
    ])->name('shop.checkout.onepage.index');

    //Checkout Save Order
    Route::get('/checkout/summary', 'Swim\Shop\Http\Controllers\OnepageController@summary')->name('shop.checkout.summary');

    //Checkout Save Address Form Store
    Route::post('/checkout/save-address', 'Swim\Shop\Http\Controllers\OnepageController@saveAddress')->name('shop.checkout.save-address');

    //Checkout Save Shipping Address Form Store
    Route::post('/checkout/save-shipping', 'Swim\Shop\Http\Controllers\OnepageController@saveShipping')->name('shop.checkout.save-shipping');

    //Checkout Save Payment Method Form
    Route::post('/checkout/save-payment', 'Swim\Shop\Http\Controllers\OnepageController@savePayment')->name('shop.checkout.save-payment');

    //Checkout Save Order
    Route::post('/checkout/save-order', 'Swim\Shop\Http\Controllers\OnepageController@saveOrder')->name('shop.checkout.save-order');

    //Checkout Order Successfull
    Route::get('/checkout/success', 'Swim\Shop\Http\Controllers\OnepageController@success')->defaults('_config', [
        'view' => 'shop::checkout.success'
    ])->name('shop.checkout.success');

    //Shop buynow button action
    Route::get('move/wishlist/{id}', 'Swim\Shop\Http\Controllers\CartController@moveToWishlist')->name('shop.movetowishlist');

    Route::get('/downloadable/download-sample/{type}/{id}', 'Swim\Shop\Http\Controllers\ProductController@downloadSample')->name('shop.downloadable.download_sample');

    // Show Product Review Form
    Route::get('/reviews/{slug}', 'Swim\Shop\Http\Controllers\ReviewController@show')->defaults('_config', [
        'view' => 'shop::products.reviews.index'
    ])->name('shop.reviews.index');

    // Show Product Review(listing)
    Route::get('/product/{slug}/review', 'Swim\Shop\Http\Controllers\ReviewController@create')->defaults('_config', [
        'view' => 'shop::products.reviews.create'
    ])->name('shop.reviews.create');

    // Show Product Review Form Store
    Route::post('/product/{slug}/review', 'Swim\Shop\Http\Controllers\ReviewController@store')->defaults('_config', [
        'redirect' => 'shop.home.index'
    ])->name('shop.reviews.store');

     // Download file or image
    Route::get('/product/{id}/{attribute_id}', 'Swim\Shop\Http\Controllers\ProductController@download')->defaults('_config', [
        'view' => 'shop.products.index'
    ])->name('shop.product.file.download');

    //customer routes starts here
    Route::prefix('customer')->group(function () {
        // forgot Password Routes
        // Forgot Password Form Show
        Route::get('/forgot-password', 'Swim\Customer\Http\Controllers\ForgotPasswordController@create')->defaults('_config', [
            'view' => 'shop::customers.signup.forgot-password'
        ])->name('customer.forgot-password.create');

        // Forgot Password Form Store
        Route::post('/forgot-password', 'Swim\Customer\Http\Controllers\ForgotPasswordController@store')->name('customer.forgot-password.store');

        // Reset Password Form Show
        Route::get('/reset-password/{token}', 'Swim\Customer\Http\Controllers\ResetPasswordController@create')->defaults('_config', [
            'view' => 'shop::customers.signup.reset-password'
        ])->name('customer.reset-password.create');

        // Reset Password Form Store
        Route::post('/reset-password', 'Swim\Customer\Http\Controllers\ResetPasswordController@store')->defaults('_config', [
            'redirect' => 'customer.profile.index'
        ])->name('customer.reset-password.store');

        // Login Routes
        // Login form show
        Route::get('login', 'Swim\Customer\Http\Controllers\SessionController@show')->defaults('_config', [
            'view' => 'shop::customers.session.index',
        ])->name('customer.session.index');

        // Login form store
        Route::post('login', 'Swim\Customer\Http\Controllers\SessionController@create')->defaults('_config', [
            'redirect' => 'customer.profile.index'
        ])->name('customer.session.create');

        // Registration Routes
        //registration form show
        Route::get('register', 'Swim\Customer\Http\Controllers\RegistrationController@show')->defaults('_config', [
            'view' => 'shop::customers.signup.index'
        ])->name('customer.register.index');

        //registration form store
        Route::post('register', 'Swim\Customer\Http\Controllers\RegistrationController@create')->defaults('_config', [
            'redirect' => 'customer.session.index',
        ])->name('customer.register.create');

        //verify account
        Route::get('/verify-account/{token}', 'Swim\Customer\Http\Controllers\RegistrationController@verifyAccount')->name('customer.verify');

        //resend verification email
        Route::get('/resend/verification/{email}', 'Swim\Customer\Http\Controllers\RegistrationController@resendVerificationEmail')->name('customer.resend.verification-email');

        // for customer login checkout
        Route::post('/customer/exist', 'Swim\Shop\Http\Controllers\OnepageController@checkExistCustomer')->name('customer.checkout.exist');

        // for customer login checkout
        Route::post('/customer/checkout/login', 'Swim\Shop\Http\Controllers\OnepageController@loginForCheckout')->name('customer.checkout.login');

        // Auth Routes
        Route::group(['middleware' => ['customer']], function () {

            //Customer logout
            Route::get('logout', 'Swim\Customer\Http\Controllers\SessionController@destroy')->defaults('_config', [
                'redirect' => 'customer.session.index'
            ])->name('customer.session.destroy');

            //Customer Wishlist add
            Route::get('wishlist/add/{id}', 'Swim\Customer\Http\Controllers\WishlistController@add')->name('customer.wishlist.add');

            //Customer Wishlist remove
            Route::get('wishlist/remove/{id}', 'Swim\Customer\Http\Controllers\WishlistController@remove')->name('customer.wishlist.remove');

            //Customer Wishlist remove
            Route::get('wishlist/removeall', 'Swim\Customer\Http\Controllers\WishlistController@removeAll')->name('customer.wishlist.removeall');

            //Customer Wishlist move to cart
            Route::get('wishlist/move/{id}', 'Swim\Customer\Http\Controllers\WishlistController@move')->name('customer.wishlist.move');

            //customer account
            Route::prefix('account')->group(function () {
                //Customer Dashboard Route
                Route::get('index', 'Swim\Customer\Http\Controllers\AccountController@index')->defaults('_config', [
                    'view' => 'shop::customers.account.index'
                ])->name('customer.account.index');

                //Customer Profile Show
                Route::get('profile', 'Swim\Customer\Http\Controllers\CustomerController@index')->defaults('_config', [
                    'view' => 'shop::customers.account.profile.index'
                ])->name('customer.profile.index');

                //Customer Profile Edit Form Show
                Route::get('profile/edit', 'Swim\Customer\Http\Controllers\CustomerController@edit')->defaults('_config', [
                    'view' => 'shop::customers.account.profile.edit'
                ])->name('customer.profile.edit');

                //Customer Profile Edit Form Store
                Route::post('profile/edit', 'Swim\Customer\Http\Controllers\CustomerController@update')->defaults('_config', [
                    'redirect' => 'customer.profile.index'
                ])->name('customer.profile.edit');

                //Customer Profile Delete Form Store
                Route::post('profile/destroy', 'Swim\Customer\Http\Controllers\CustomerController@destroy')->defaults('_config', [
                    'redirect' => 'customer.profile.index'
                ])->name('customer.profile.destroy');

                /*  Profile Routes Ends Here  */

                /*    Routes for Addresses   */
                //Customer Address Show
                Route::get('addresses', 'Swim\Customer\Http\Controllers\AddressController@index')->defaults('_config', [
                    'view' => 'shop::customers.account.address.index'
                ])->name('customer.address.index');

                //Customer Address Create Form Show
                Route::get('addresses/create', 'Swim\Customer\Http\Controllers\AddressController@create')->defaults('_config', [
                    'view' => 'shop::customers.account.address.create'
                ])->name('customer.address.create');

                //Customer Address Create Form Store
                Route::post('addresses/create', 'Swim\Customer\Http\Controllers\AddressController@store')->defaults('_config', [
                    'view' => 'shop::customers.account.address.address',
                    'redirect' => 'customer.address.index'
                ])->name('customer.address.create');

                //Customer Address Edit Form Show
                Route::get('addresses/edit/{id}', 'Swim\Customer\Http\Controllers\AddressController@edit')->defaults('_config', [
                    'view' => 'shop::customers.account.address.edit'
                ])->name('customer.address.edit');

                //Customer Address Edit Form Store
                Route::put('addresses/edit/{id}', 'Swim\Customer\Http\Controllers\AddressController@update')->defaults('_config', [
                    'redirect' => 'customer.address.index'
                ])->name('customer.address.edit');

                //Customer Address Make Default
                Route::get('addresses/default/{id}', 'Swim\Customer\Http\Controllers\AddressController@makeDefault')->name('make.default.address');

                //Customer Address Delete
                Route::get('addresses/delete/{id}', 'Swim\Customer\Http\Controllers\AddressController@destroy')->name('address.delete');

                /* Wishlist route */
                //Customer wishlist(listing)
                Route::get('wishlist', 'Swim\Customer\Http\Controllers\WishlistController@index')->defaults('_config', [
                    'view' => 'shop::customers.account.wishlist.wishlist'
                ])->name('customer.wishlist.index');

                /* Orders route */
                //Customer orders(listing)
                Route::get('orders', 'Swim\Shop\Http\Controllers\OrderController@index')->defaults('_config', [
                    'view' => 'shop::customers.account.orders.index'
                ])->name('customer.orders.index');

                //Customer downloadable products(listing)
                Route::get('downloadable-products', 'Swim\Shop\Http\Controllers\DownloadableProductController@index')->defaults('_config', [
                    'view' => 'shop::customers.account.downloadable_products.index'
                ])->name('customer.downloadable_products.index');

                //Customer downloadable products(listing)
                Route::get('downloadable-products/download/{id}', 'Swim\Shop\Http\Controllers\DownloadableProductController@download')->defaults('_config', [
                    'view' => 'shop::customers.account.downloadable_products.index'
                ])->name('customer.downloadable_products.download');

                //Customer orders view summary and status
                Route::get('orders/view/{id}', 'Swim\Shop\Http\Controllers\OrderController@view')->defaults('_config', [
                    'view' => 'shop::customers.account.orders.view'
                ])->name('customer.orders.view');

                //Prints invoice
                Route::get('orders/print/{id}', 'Swim\Shop\Http\Controllers\OrderController@print')->defaults('_config', [
                    'view' => 'shop::customers.account.orders.print'
                ])->name('customer.orders.print');

                /* Reviews route */
                //Customer reviews
                Route::get('reviews', 'Swim\Customer\Http\Controllers\CustomerController@reviews')->defaults('_config', [
                    'view' => 'shop::customers.account.reviews.index'
                ])->name('customer.reviews.index');

                //Customer review delete
                Route::get('reviews/delete/{id}', 'Swim\Shop\Http\Controllers\ReviewController@destroy')->defaults('_config', [
                    'redirect' => 'customer.reviews.index'
                ])->name('customer.review.delete');

                //Customer all review delete
                Route::get('reviews/all-delete', 'Swim\Shop\Http\Controllers\ReviewController@deleteAll')->defaults('_config', [
                    'redirect' => 'customer.reviews.index'
                ])->name('customer.review.deleteall');
            });
        });
    });
    //customer routes end here

    Route::get('page/{slug}', 'Swim\CMS\Http\Controllers\Shop\PagePresenterController@presenter')->name('shop.cms.page');

    Route::fallback(\Swim\Shop\Http\Controllers\ProductsCategoriesProxyController::class . '@index')
        ->defaults('_config', [
            'product_view' => 'shop::products.view',
            'category_view' => 'shop::products.index'
        ])
        ->name('shop.productOrCategory.index');
});
