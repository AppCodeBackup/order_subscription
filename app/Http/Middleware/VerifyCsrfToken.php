<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
      'GetProductDiscountSet',
      'GetCartPrices',
      'translations',
      'recurring_cart_settings',
      'css',
      'create_subsc_group_data',
      'CreateDraftOrder',
      'processSubscriptionPlan',
      '/draft-ordercheckout/recurring/*',
      'post-subscription',
      'GetPaymentMethodFromCustomer',
      'getCustomerOrders',
      'cart_data',
      'swapprd',
      'UploadCanvas',
      'crateoptions'
    ];
}
