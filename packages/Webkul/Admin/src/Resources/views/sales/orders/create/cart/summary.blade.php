@php
    $clientId = core()->getConfigData('sales.payment_methods.paypal_smart_button.client_id');

    $acceptedCurrency = core()->getConfigData('sales.payment_methods.paypal_smart_button.accepted_currencies');
@endphp
    
{!! view_render_event('bagisto.admin.sales.order.create.cart.summary.before') !!}

<v-cart-summary
    :cart="cart"
    @coupon-applied="setCart"
    @coupon-removed="setCart"
></v-cart-summary>

{!! view_render_event('bagisto.admin.sales.order.create.cart.summary.after') !!}

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-cart-summary-template"
    >
        <div
            class="box-shadow rounded bg-white dark:bg-gray-900"
            id="review-step-container"
        >
            <div class="flex items-center border-b p-4 dark:border-gray-800">
                <p class="text-base font-semibold text-gray-800 dark:text-white">
                    @lang('admin::app.sales.orders.create.cart.summary.title')
                </p>
            </div>

            <!-- Cart Totals -->
            <div class="grid w-full justify-end gap-2.5 border-b p-4 dark:border-gray-800">
                <div class="grid gap-4">
                    <!-- Sub Total -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.sub_total.before') !!}

                    <template v-if="displayTax.subtotal == 'including_tax'">
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.sub-total')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_sub_total_incl_tax }}
                            </p>
                        </div>
                    </template>

                    <template v-else-if="displayTax.subtotal == 'both'">
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.sub-total-excl-tax')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_sub_total }}
                            </p>
                        </div>
                        
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.sub-total-incl-tax')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_sub_total_incl_tax }}
                            </p>
                        </div>
                    </template>

                    <template v-else>
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.sub-total')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_sub_total }}
                            </p>
                        </div>
                    </template>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.sub_total.after') !!}


                    <!-- Taxes -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.tax.before') !!}

                    <div
                        class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right"
                        v-for="(amount, index) in cart.tax_amounts"
                        v-if="parseFloat(cart.tax_total)"
                    >
                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @lang('admin::app.sales.orders.create.cart.summary.tax') (@{{ index }})
                        </p>

                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @{{ amount }}
                        </p>
                    </div>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.tax.after') !!}

                    <!-- Shipping Rates -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.delivery_charges.before') !!}

                    <template v-if="displayTax.shipping == 'including_tax'">
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.shipping-amount')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_shipping_amount_incl_tax }}
                            </p>
                        </div>
                    </template>

                    <template v-else-if="displayTax.shipping == 'both'">
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.shipping-amount-excl-tax')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_shipping_amount }}
                            </p>
                        </div>
                        
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.shipping-amount-incl-tax')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_shipping_amount_incl_tax }}
                            </p>
                        </div>
                    </template>

                    <template v-else>
                        <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @lang('admin::app.sales.orders.create.cart.summary.shipping-amount')
                            </p>

                            <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                                @{{ cart.formatted_shipping_amount }}
                            </p>
                        </div>
                    </template>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.delivery_charges.after') !!}

                    <!-- Discount -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.discount_amount.before') !!}

                    <div
                        class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right"
                        v-if="parseFloat(cart.discount_amount)"
                    >
                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @lang('admin::app.sales.orders.create.cart.summary.discount-amount')
                        </p>

                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @{{ cart.formatted_discount_amount }}
                        </p>
                    </div>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.discount_amount.after') !!}

                    <!-- Discount -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.coupon.before') !!}

                    <div class="row grid grid-cols-2 grid-rows-1 justify-items-end gap-4 text-right">
                        <p class="text-base font-medium text-gray-600 dark:text-gray-300">
                            @lang('admin::app.sales.orders.create.cart.summary.apply-coupon')
                        </p>

                        <template v-if="cart.coupon_code">
                            <p class="flex items-center gap-1 text-base font-medium text-green-600">
                                @{{ cart.coupon_code }}

                                <span
                                    class="icon-cancel cursor-pointer text-2xl"
                                    @click="destroyCoupon"
                                >
                                </span>
                            </p>
                        </template>

                        <template v-else>
                            <p class="text-base font-medium text-gray-600">
                                <span
                                    class="cursor-pointer text-blue-600"
                                    @click="$refs.couponModel.open()"
                                >
                                    @lang('admin::app.sales.orders.create.cart.summary.apply-coupon')
                                </span>
                            </p>
                        </template>
                    </div>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.coupon.after') !!}

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.coupon.after') !!}

                    <!-- Cart Grand Total -->
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.grand_total.before') !!}

                    <div class="row grid grid-cols-2 grid-rows-1 justify-between gap-4 text-right">
                        <p class="text-lg font-semibold dark:text-white">
                            @lang('admin::app.sales.orders.create.cart.summary.grand-total')
                        </p>

                        <p class="text-lg font-semibold dark:text-white">
                            @{{ cart.formatted_grand_total }}
                        </p>
                    </div>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.grand_total.after') !!}
                </div>
            </div>

            <div
                class="flex w-full justify-end p-4"
                v-if="$parent.canPlaceOrder"
            >
                <template v-if="cart.payment_method == 'paypal_smart_button'">
                    <!-- Paypal Smart Button Vue Component -->
                    <template v-if="{{ (bool) core()->getConfigData('sales.payment_methods.paypal_smart_button.active') }}">
                        <v-admin-paypal-smart-button></v-admin-paypal-smart-button>
                    </template>
                </template>

                <template v-else>
                    <x-admin::button
                        type="button"
                        class="primary-button w-max px-11 py-3"
                        :title="trans('shop::app.checkout.onepage.summary.place-order')"
                        ::disabled="isPlacingOrder"
                        ::loading="isPlacingOrder"
                        @click="placeOrder"
                    />
                </template>
            </div>

            <!-- Apply Coupon Form -->
            <x-admin::form
                v-slot="{ meta, errors, handleSubmit }"
                as="div"
            >
                <!-- Apply coupon form -->
                <form @submit="handleSubmit($event, applyCoupon)">
                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.coupon_form_controls.before') !!}

                    <!-- Apply coupon modal -->
                    <x-admin::modal ref="couponModel">
                        <!-- Modal Header -->
                        <x-slot:header class="dark:text-white">
                            @lang('admin::app.sales.orders.create.cart.summary.apply-coupon')
                        </x-slot>

                        <!-- Modal Content -->
                        <x-slot:content>
                            <x-admin::form.control-group class="!mb-0">
                                <x-admin::form.control-group.control
                                    type="text"
                                    name="code"
                                    rules="required"
                                    :placeholder="trans('admin::app.sales.orders.create.cart.summary.enter-your-code')"
                                />

                                <x-admin::form.control-group.error control-name="code" />
                            </x-admin::form.control-group>
                        </x-slot>

                        <!-- Modal Footer -->
                        <x-slot:footer>
                            <x-admin::button
                                class="primary-button"
                                :title="trans('admin::app.sales.orders.create.cart.summary.apply-coupon')"
                                ::loading="isStoring"
                                ::disabled="isStoring"
                            />
                        </x-slot>
                    </x-admin::modal>

                    {!! view_render_event('bagisto.admin.sales.order.create.left_component.summary.coupon_form_controls.after') !!}
                </form>
            </x-admin::form>
        </div>
    </script>

    <script type="module">
        app.component('v-cart-summary', {
            template: '#v-cart-summary-template',

            props: ['cart'],

            data() {
                return {
                    displayTax: {
                        prices: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_prices') }}",

                        subtotal: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_subtotal') }}",
                        
                        shipping: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_shipping_amount') }}",
                    },
                    
                    isStoring: false,

                    isPlacingOrder: false,
                }
            },

            methods: {
                applyCoupon(params, { resetForm }) {
                    this.isStoring = true;

                    this.$axios.post("{{ route('admin.sales.cart.store_coupon', $cart->id) }}", params)
                        .then((response) => {
                            this.isStoring = false;

                            this.$emit('coupon-applied', response.data.data);
                  
                            this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                            this.$refs.couponModel.toggle();

                            resetForm();
                        })
                        .catch((error) => {
                            this.isStoring = false;

                            this.$refs.couponModel.toggle();

                            if ([400, 422].includes(error.response.request.status)) {
                                this.$emitter.emit('add-flash', { type: 'warning', message: error.response.data.message });

                                resetForm();

                                return;
                            }

                            this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                        });
                },

                destroyCoupon() {
                    this.$axios.delete("{{ route('admin.sales.cart.remove_coupon', $cart->id) }}", {
                            '_token': "{{ csrf_token() }}"
                        })
                        .then((response) => {
                            this.$emit('coupon-removed', response.data.data);

                            this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });
                        })
                        .catch(error => console.log(error));
                },

                placeOrder() {
                    this.isPlacingOrder = true;

                    this.$axios.post('{{ route('admin.sales.orders.store', $cart->id) }}')
                        .then(response => {
                            if (response.data.data.redirect) {
                                window.location.href = response.data.data.redirect_url;
                            } else {
                                window.location.href = '{{ route('shop.checkout.onepage.success') }}';
                            }

                            this.isPlacingOrder = false;
                        })
                        .catch(error => {
                            this.isPlacingOrder = false

                            this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                        });
                }
            }
        });
    </script>
{{-- 
    <script
        src="https://www.paypal.com/sdk/js?client-id={{ $clientId }}&currency={{ $acceptedCurrency }}"
        data-partner-attribution-id="Bagisto_Cart"
    >
    </script>

    <script
        type="text/x-template"
        id="v-admin-paypal-smart-button-template"
    >
        <div class="paypal-button-container w-max"></div>
    </script>

    <script type="module">
        app.component('v-admin-paypal-smart-button', {
            template: '#v-admin-paypal-smart-button-template',

            mounted() {
                this.register();
            },

            methods: {
                register() {
                    if (typeof paypal == 'undefined') {
                        this.$emitter.emit('add-flash', { type: 'error', message: '@lang('Something went wrong.')' });
                        
                        return;
                    }

                    paypal.Buttons(this.getOptions()).render('.paypal-button-container');
                },

                getOptions() {
                    let options = {
                        style: {
                            layout: 'vertical',
                            shape: 'rect',
                        },

                        authorizationFailed: false,

                        enableStandardCardFields: false,

                        alertBox: (message) => {
                            this.$emitter.emit('add-flash', { type: 'error', message: message });
                        },

                        createOrder: (data, actions) => {                            
                            return this.$axios.get("{{ route('paypal.smart-button.create-order') }}")
                                .then(response => response.data.result)
                                .then(order => order.id)
                                .catch(error => {
                                    if (error.response.data.error === 'invalid_client') {
                                        options.authorizationFailed = true;
                                        
                                        options.alertBox('@lang('Something went wrong.')');
                                    }

                                    return error;
                                });
                        },

                        onApprove: (data, actions) => {                            
                            this.$axios.post("{{ route('paypal.smart-button.capture-order') }}", {
                                _token: "{{ csrf_token() }}",
                                orderData: data
                            })
                            .then(response => {
                                if (response.data.success) {
                                    if (response.data.redirect_url) {
                                        window.location.href = response.data.redirect_url;
                                    } else {
                                        window.location.href = "{{ route('shop.checkout.onepage.success') }}";
                                    }
                                }
                            })
                            .catch(error => window.location.href = "{{ route('shop.checkout.cart.index') }}");
                        },

                        onError: (error) => {
                            if (! options.authorizationFailed) {
                                console.log('3');
                                
                                options.alertBox('@lang('Something went wrong.')');
                            }
                        },
                    };

                    return options;
                },
            },
        });
    </script> --}}
    <script
        src="https://www.paypal.com/sdk/js?client-id={{ $clientId }}&currency={{ $acceptedCurrency }}"
        data-partner-attribution-id="Bagisto_Cart"
    ></script>

    <script type="text/x-template" id="v-admin-paypal-smart-button-template">
        <div class="paypal-button-container w-max"></div>
    </script>

    <script type="module">
        app.component('v-admin-paypal-smart-button', {
            template: '#v-admin-paypal-smart-button-template',

            mounted() {
                this.register();
            },

            methods: {
                register() {
                    if (typeof paypal === 'undefined') {
                        this.$emitter.emit('add-flash', { type: 'error', message: '@lang('Something went wrong.')' });
                        return;
                    }

                    paypal.Buttons(this.getOptions()).render('.paypal-button-container');
                },

                getOptions() {
                    let options = {
                        style: {
                            layout: 'vertical',
                            shape: 'rect',
                        },

                        authorizationFailed: false,
                        enableStandardCardFields: false,

                        alertBox: (message) => {
                            this.$emitter.emit('add-flash', { type: 'error', message: message });
                        },

                        createOrder: (data, actions) => {                            
                            return this.$axios.get("{{ route('admin.paypal.smart-button.create-order') }}")
                                .then(response => {  
                                    if (response.data && response.data.result && response.data.result.id) {
                                        return response.data.result.id;
                                    } else {
                                        throw new Error('Invalid order creation response');
                                    }
                                })
                                .catch(error => {
                                    console.log(error);
                                    
                                    options.authorizationFailed = true;
                                });
                        },

                        onApprove: (data, actions) => {                            
                            this.$axios.post("{{ route('paypal.smart-button.capture-order') }}", {
                                _token: "{{ csrf_token() }}",
                                orderData: data
                            })
                            .then(response => {
                                if (response.data.success) {
                                    const redirectUrl = response.data.redirect_url || "{{ route('shop.checkout.onepage.success') }}";
                                    window.location.href = redirectUrl;
                                } else {
                                    throw new Error('Capture failed');
                                }
                            })
                            .catch(error => {
                                window.location.href = "{{ route('shop.checkout.cart.index') }}";
                                console.error(error); // Log the actual error for debugging
                            });
                        },

                        onError: (error) => {
                            if (!options.authorizationFailed) {
                                options.alertBox('@lang('An error occurred while processing your payment. Please try again.')');
                            }
                            console.error(error); // Log the actual error for debugging
                        },
                    };

                    return options;
                },
            },
        });
    </script>
@endPushOnce
