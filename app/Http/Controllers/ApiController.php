<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use OhMyBrew\ShopifyApp\Models\Shop;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use App\Subscription_plan;
use App\Subscription_product;
use URL;
class ApiController extends Controller
{

    public function cart_data(){
          header('Content-Type: application/liquid');
        echo "{% section 'cart-page'%}
        {% section 'client-sections' %}";
        exit;
    }
  public function css(Request $request)
  {
          header('Content-Type: application/css');
    echo  $CSS='.float-left {
    float: left;
}

.vowel-ro__recurring-div select {
	background-color: #FFF;
}

.vowel-ro__sub-image img {
	border: 2px solid #DBDBDB;
	border-radius: 5px;
	max-height: 55px;
	max-width: 55px;
}

.vowel-ro__sub-image {
	border: 2px solid #DBDBDB;
	padding: 10px;
	border-radius: 5px;
	margin-bottom: 10px;
	margin-top: 10px;
    line-height: 1.2;
}

.vowel-ro__sub-regular-price {
	text-decoration: line-through;
}

.vowel-ro__table-row.vowel-ro__bottom-info-row {
	font-size: 0.8em;
	opacity: 0.6;
}

.vowel-ro__table {
	display: table;
	width: 100%;
}

.vowel-ro__table-row {
	display: table-row;
	width: auto;
	clear: both;
}

.vowel-ro__table-col {
	float: right;
	display: table-column;
	width: 20%;
	text-align: right;
}

.vowel-ro__table-col-left {
	float: left;
	display: table-column;
	width: 80%;
	padding-left: 25px;
}

.vowel-ro__table-col-3 {
	float: left;
	display: table-column;
	width: 12%;
	height: 55px;
}

.vowel-ro__table-col-6 {
	float: right;
	display: table-column;
	width: 88%;
	min-height: 55px;
}

.vowel-ro__product {
		max-width: 100%;		border-width: 0px;	border-style: solid;
	margin-top: 0px;	margin-bottom: 15px;	margin-left: 0px;	margin-right: 0px;}

.vowel-ro__one-time-div, .vowel-ro__recurring-div, .vowel-ro__frequency-label, .vowel-ro__mix-div {
		font-size: 15px;}

.vowel-ro__one-time-div, .vowel-ro__recurring-div, .vowel-ro__mix-div {
	padding-top: 10px;
	padding-bottom: 10px;
	padding-left: 10px;
	padding-right: 10px;
	margin-top: 0px;	margin-bottom: 0px;	margin-left: 0px;	margin-right: 0px;	border-color: transparent;
	border-width: 1px;	border-style: solid;
}

.vowel-ro__vowel-active {
	background-color: #F5F5F5;	border-color: #DBDBDB;	border-width: 1px;	border-style: solid;
}

.vowel-ro__frequency-label {
	padding-top: 10px;	padding-bottom: 0px;	padding-left: 0px;	padding-right: 0px;}

input.vowel-ro__frequency-num {
	width: 60px;
	display: inline-block;
}

.vowel-ro__custom-order-interval-lbl {
	display: inline-block;
}

.ro_widget .vowel-ro__checkbox {
	margin-right: 5px;
}

.ro_widget label {
	display: inline;
}

.ro_widget select {
	width: 100%;
}

.ro_widget input[type=radio] {
  -webkit-appearance: radio;
  width:auto;
}

select.vowel-ro__frequency-type.vowel-ro__order-interval, select.vowel-ro__frequency-num {
	width:auto;
}

.vowel-ro__prepaid-total-container {
    text-align: right;
}

input.vowel-ro__prepaid-start-date {
    width: 100%;
}

.vowel-ro__frequency-num, .vowel-ro__frequency-type {
	margin-top: 0px;	margin-bottom: 0px;	margin-left: 10px;	margin-right: 0px;	width: auto;
	display: inline-block;
}

.vowel-ro__recurring-title {
	color: #363636;	font-size: 20px; font-weight: vowel;
   padding-top: 10px;	padding-bottom: 10px;	padding-left: 10px;	padding-right: 10px;}

.vowel-ro__new-discounted-price {
	color: # CF0C0C;	font-size: 16px;  }

.vowel-ro__sub .tooltip-inner, .vowel-ro__tooltip .tooltip-inner {
	background-color: #000000;	opacity: 0.9;	color: #FFFFFF;	font-size: 12px;	border-radius: 3px;	padding: 10px;}

.vowel-ro__sub .tooltip.bottom .tooltip-arrow, .vowel-ro__tooltip .tooltip-arrow {
	border-color: #000000;}

.vowel-ro__recurring-div .vowel-ro__recurring-lbl span.vowel-ro__recurring-text.vowel-ro__subscription-only {
	margin-left: 0px;
	margin-top: 0px;
	display: block;
}

.vowel-ro__recurring-lbl {
	width: 100%;
	margin-bottom: 0px;
}

input.vowel-ro__error, .vowel-ro__error {
	border-color: #FF0000;
}

body.vowel-ro__vanilla-modal .vowel-ro__modal-hider {
	position: absolute;
	left: -99999em;
}

.vowel-ro__shipping-rates-container {
    text-align: left;
    border: 1px solid rgba(128, 128, 128, 0.52);
    background-color: rgba(211, 211, 211, 0.15);
    padding: 10px 10px;
    font-size: .9em;
}

span.vowel-ro__shipping-note {
    font-size: 0.7em;
}

p.vowel-ro__rate-change {
    margin-bottom: -10px;
}

.icon--order-success g {
    stroke: #8EC343;}

.vowel-ro__fadeIn.icon.icon--order-success.svg {
    width: auto;
    height: auto;
}

.vowel-ro__loading-shipping-text {
    text-align: center;
}

.vowel-ro__loading, .vowel-ro__widget-loading {
    margin-left: 45%;
}

.vowel-ro__loading-container .vowel-ro__widget-loading-icon {
    border: 10px solid #F3F3F3;
    border-radius: 50%;
    border-top: 10px solid #3498DB;
    width: 50px;
    height: 50px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    margin-bottom: 20px;
}

@-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes fadeIn {
    0% {opacity: 0;}
    100% {opacity: 1;}
}

.vowel-ro__fadeIn {
    -webkit-animation-name: fadeIn;
    animation-name: fadeIn;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}

.vowel-ro__ate-buttons {
    margin-top: 10px;
}

.vowel-ro__modal {
	display: none;
}

.vowel-ro__modal-container input[type=radio] {
    -webkit-appearance: radio;
    width: auto;
}

.vowel-ro__vanilla-modal .vowel-ro__modal {
	display: block;
	position: fixed;
	content: "";
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background: rgba(0, 0, 0, 0.6);
	z-index: -1;
	opacity: 0;
	transition: opacity 0.2s, z-index 0s 0.2s;
	text-align: center;
	overflow: hidden;
	overflow-y: auto;
	white-space: nowrap;
	-webkit-overflow-scrolling: touch;
}

.vowel-ro__vanilla-modal .vowel-ro__modal > * {
	display: inline-block;
	white-space: normal;
	vertical-align: middle;
	text-align: left;
}

.vowel-ro__vanilla-modal .vowel-ro__modal:before {
	display: inline-block;
	overflow: hidden;
	width: 0;
	height: 100%;
	vertical-align: middle;
	content: "";
}

.vowel-ro__vanilla-modal.vowel-ro__modal-visible .vowel-ro__modal {
	z-index: 99999;
	opacity: 1;
	transition: opacity 0.2s;
}

.vowel-ro__vanilla-modal.vowel-ro__modal-visible {
    overflow-y: hidden;
}

.vowel-ro__modal-content {
	text-align: center;
}

.vowel-ro__modal-inner {
	position: relative;
	overflow: hidden;
	width: 100%;
	max-width: 800px;
	max-height: 100%;
	overflow-x: hidden;
	overflow-y: auto;
	background: #fff;
	z-index: -1;
	opacity: 0;
	transform: scale(0);
	transition: opacity 0.2s, transform 0.2s, z-index 0s 0.2s;
	padding: 25px;
	overflow-y: hidden;
}

.vowel-ro__modal-visible .vowel-ro__modal-inner {
	z-index: 100;
	opacity: 1;
	transform: scale(1);
	transition: opacity 0.2s, transform 0.2s;
}

@media only screen and (max-width: 498px) {
    .vowel-ro__modal-visible .vowel-ro__modal-inner {
        overflow-y: visible;
    }
    .vowel-modal__footer.vowel-ro__actions{
        text-align: center;
    }
}

@media only screen and (max-height: 530px) {
    .vowel-ro__modal-visible .vowel-ro__modal-inner {
        overflow-y: visible;
    }
}

vowel-ro__login-modal-text {
  margin-bottom: 20px;
}

.vowel-ro__modal-close {
	position: absolute;
	z-index: 2;
	right: 0;
	top: 0;
	width: 30px;
	height: 25px;
	line-height: 25px;
	font-size: 13px;
	cursor: pointer;
	text-align: center;
	background: #fff;
	box-shadow: -1px 1px 2px rgba(0, 0, 0, 0.2);
}

.vowel-ro__detail-tooltip {
    float:inline}

.vowel-ro__tooltip {
    z-index: 9999;
}
.vowel-ro__tooltip[x-placement^="top"] .tooltip-arrow {
    border-width: 5px 5px 0 5px;
    border-left-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    bottom: -5px;
    left: calc(50% - 5px);
    margin-top: 0;
    margin-bottom: 0;
}
.vowel-ro__tooltip[x-placement^="bottom"] .tooltip-arrow {
    border-width: 0 5px 5px 5px;
    border-left-color: transparent;
    border-right-color: transparent;
    border-top-color: transparent;
    top: -5px;
    left: calc(50% - 5px);
    margin-top: 0;
    margin-bottom: 0;
}

.vowel-ro__tooltip .tooltip-arrow {
    width: 0;
    height: 0;
    border-style: solid;
    position: absolute;
    margin: 5px;
}

';
exit;
  }
      public function recurring_cart_settings(Request $request){
          header('Content-Type: application/json');
        echo $json='{
   "enable_widget":true,
   "recurring_type":2,
   "discount":0,
   "max_number":30,
   "money_format":"Rs. {{amount}}",
   "intervals":[

   ],
   "s_shop_url":"https:\/\/amkwebsolutions.com\/s\/scarflings-test\/",
   "csrf_token":"9c5f85d97e1e123a1dc8130b35581b65",
   "csrf_token_name":"csrf_vowel_token",
   "anonymous_login":1,
   "billing_plans":[

   ],
   "details_tooltip":{
      "enabled":false,
      "location":{
         "bottom":true
      }
   },
   "is_cashier_linked":false
}';
  exit;

      }

      public function translations(Request $request){
          header('Content-Type: application/json');
        $data='{"translations":{"add_subscription_to_cart":"Add subscription to cart","auto_replenish_cart":"Make this entire cart recurring?","auto_replenish_product":"Subscribe and Save!","billing_plan_select":"Place order every [interval_number] [interval] on [billing_day]","box_selections_required":"Minimum [num_required] Selection(s) Remaining","box_subtotal":"Subtotal: [subtotal]","complete_subscription":"Complete subscription","convertible_deliver_every_line_item":"Deliver every [frequency_num] [frequency_type_text]","convertible_name_line_item":"Converts to [convertible_product_name] [convertible_item_price]","convertible_prefix_title":"Subscription to","day":"Day(s)","deliver_every":"Deliver every","deliver_every_line_item":"Deliver every [frequency_num] [frequency_type_text] [item_price] each","discount":" & Save [discount_percentage] ([discount_price])","discount_convertible":"Purchase with subscription","discount_convertible_first":"Purchase with subscription and save [initial_discount_percentage] on the first order","discount_convertible_first_future":"Purchase with subscription and save [initial_discount_percentage] on the first order and [recurring_discount_percentage] on all future orders","discount_convertible_future":"Purchase with subscription and save [recurring_discount_percentage] on future orders","discount_switch_initial":" & Save [discount_percentage] ([amount_discounted]) on your first [num_orders] orders","discount_switch_initial_one":" & Save [discount_percentage] ([amount_discounted]) on your first order","discount_switch_recurring":"and [discount_percentage] ([amount_discounted]) on all remaining orders","discount_switch_recurring_first_only":"and save [discount_percentage] ([discount_price]) on all remaining orders after the first order.","discount_switch_recurring_only":"and save [discount_percentage] ([discount_price]) on all remaining orders after the first [num_orders] orders.","friday":"Friday","is_this_a_gift":"Is this a gift?","login_alert":"You must login before you make a recurring purchase.","login_button":"Login","monday":"Monday","month":"Month(s)","no_limit":"Ongoing","one_time_purchase":"One-time purchase","one_time_purchase_convertible":"Purchase just this product","order_interval_convertible":"Select your order interval","order_will_ship_every":"Order will ship every:","prepaid_start_date_option_label":"Choose first order date","prepay_for_your_subscription":"Prepay for your subscription","saturday":"Saturday","secondary_discount_line_item":"Price changes after [secondary_discount_required_orders] order(s) to [secondary_discount_price]","see_details":"See details","subscription_box_choices":"Select Choices","subscription_length":"Subscription Length (# of shipments): ","sunday":"Sunday","thursday":"Thursday","total_recurrences_line_item":"Your subscription will last for [total_recurrences] shipments","total_recurrences_widget":"Your subscription will last for [total_recurrences] shipments","tuesday":"Tuesday","wednesday":"Wednesday","week":"Week(s)","widget_repenish":"Subscribe","year":"Year(s)","add":"Add","add_product_title":"Add product to existing subscription order","add_successfully":"Done. Added to Subscription!","add_to_existing_add_error":"Could not add product to existing order","add_to_existing_orders":"Add to existing subscription","add_to_existing_ship_error":"There was a problem loading the shipping rates.","add_to_existing_ship_loading":"Checking Shipping Rates","add_to_existing_ship_note":"*Adding this product will affect the shipping rates for the selected order.","add_to_existing_ship_select":"Select a New Shipping Rate:","add_to_existing_view_order":"View Order","cancel":"Cancel","multiple_order_description":"You have multiple recurring orders, which one would you like to add it to?","no_ship_rates_found":"*No new shipping rates","one_order_description":"Are you sure you want to add this product to this existing subscription?","order_information":"Order #[order_number] - [product_quantity] Products - [subtotal] - Every [interval]","shipping_schedule_text":"This item ships today and [next_ship_date_mdY] then every [interval] [interval_type_text] from then on.","shipping_schedule":"Shipping Schedule"},"days_of_week":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"display_settings":{"hover_modal":"<div align=\"left\">\n<div><strong>Subscription Details<\/strong><\/div>\n<div>\n<ul>\n<li>Set it and forget it!<\/li>\n<li>Pause, edit or cancel anytime.<\/li>\n<\/ul>\n<\/div>\n<\/div>"}}';
        echo $data;
        exit;
      }

      public function GetProductPrice($productData)
      {
          return $productData->body->product->variants[0]->price;
      }

      public function GetShopCurrency($shop_data)
      {
          return $shop_data->body->shop->currency;
      }

    public function GetDiscountedPrice($type, $discount, $product_price)
    {
        $p1;
        switch ($type) {
            case 1:
                //Percent Discount
                $p1 = $product_price - (($product_price * $discount) / 100);
                break;
            case 2:
                // Fixed Price Discount
                $p1 = $product_price - $discount;
                break;
            case 3:
                // Set Product Price  Equal TO Discount
                $p1 = $discount;
                break;
        }
        return $p1;
    }

    public function CreateDiscountTableHtml($result, $currency, $product_price)
    {
          $return;
          $ReturnHtml = "";
        switch ($result[0]->grid_style) {
            case 1:
                $ReturnHtml .= '<table class="shappify_qb_grid">';
                $ReturnHtml .= '<thead>';
                $ReturnHtml .= '<tr>';
                $ReturnHtml .= '<th>Qty</th>';
                $ReturnHtml .= '<th>Price</th>';
                $ReturnHtml .= '</tr>';
                $ReturnHtml .= '</thead>';
                $ReturnHtml .= '<tbody>';
                foreach ($result as $tbl_r) {
                    $ReturnHtml .= '<tr>';
                    $ReturnHtml .= '<td>Buy ' . $tbl_r->prd_qty . '</td>';
                    $ReturnHtml .= '<td>'.$currency.' ' . $this->GetDiscountedPrice($tbl_r->discount_type, $tbl_r->discount_price, $product_price) . ' ea</td>';
                    $ReturnHtml .= '</tr>';
                }
                $ReturnHtml .= '</tbody>';
                $ReturnHtml .= '</table>';
                break;
            case 2:
                $ReturnHtml .= '<table class="shappify_qb_grid">';
                $ReturnHtml .= '<thead>';
                $ReturnHtml .= '<tr><th>Qty</th><th>Price</th></tr></thead>';
                $ReturnHtml .= '<tbody>';
                foreach ($result as $tbl_r) {
                $ReturnHtml .= '<tr>';
                $ReturnHtml .= '<td>'.$tbl_r->prd_qty.'</td>';
                $ReturnHtml .= '<td>'.$currency.' ' . $this->GetDiscountedPrice($tbl_r->discount_type, $tbl_r->discount_price, $product_price) . '</td>';
                $ReturnHtml .= '</tr>';
                }
                $ReturnHtml .= '</tbody>';
                $ReturnHtml .= '</table>';
                break;
            case 3:
                  $ReturnHtml .= '<table class="shappify_qb_grid">';
                  $ReturnHtml .= '<thead>';
                  $ReturnHtml .= '<tr><th>Minimum Qty</th><th>Maximum Qty</th><th>Price</th></tr></thead>';
                  $ReturnHtml .= '<tbody>';
                  foreach ($result as $key => $tbl_r) {
                    $ReturnHtml .= '<tr>';
                    $ReturnHtml .= '<td>'.$tbl_r->prd_qty.'</td>';
                    $ReturnHtml .= '<td>'.(isset($result[$key+1]->prd_qty) ? ($result[$key+1]->prd_qty-1) : $tbl_r->prd_qty.'++').'</td>';
                    $ReturnHtml .= '<td>'.$currency.' ' . $this->GetDiscountedPrice($tbl_r->discount_type, $tbl_r->discount_price, $product_price) . '</td>';
                    $ReturnHtml .= '</tr>';
                  }
                  $ReturnHtml .= '</tbody>';
                  $ReturnHtml .= '</table>';
                break;
            case 4:
                $ReturnHtml .= '<table class="shappify_qb_grid">';
                $ReturnHtml .= '<thead>';
                $ReturnHtml .= '<tr>';
                $ReturnHtml .= '<th>Qty</th>';
                $ReturnHtml .= '<th>Price</th>';
                $ReturnHtml .= '<th>Discount</th>';
                $ReturnHtml .= '</tr>';
                $ReturnHtml .= '</thead>';
                $ReturnHtml .= '<tbody>';
                foreach ($result as $key => $tbl_r) {
                    $ReturnHtml .= '<tr>';
                    $ReturnHtml .= '<td>'.$tbl_r->prd_qty.'</td>';
                    $ReturnHtml .= '<td>'.$currency.' ' . $this->GetDiscountedPrice($tbl_r->discount_type, $tbl_r->discount_price, $product_price) . ' ea</td>';
                    $ReturnHtml .= '<td>'.(100-(($this->GetDiscountedPrice($tbl_r->discount_type, $tbl_r->discount_price, $product_price)*100)/$product_price)).' % Off</td>';
                    $ReturnHtml .= '</tr>';
                }
                $ReturnHtml .= '</tbody>';
                $ReturnHtml .= '</table';
                break;
            case 5:
                $ReturnHtml .= '<table class="shappify_qb_grid">';
                $ReturnHtml .= '<thead>';
                $ReturnHtml .= '<tr>';
                $ReturnHtml .= '<th>Qty</th>';
                $ReturnHtml .= '<th>Discount</th>';
                $ReturnHtml .= '</tr>';
                $ReturnHtml .= '</thead>';
                $ReturnHtml .= '<tbody>';
                foreach ($result as $key => $tbl_r) {
                    $ReturnHtml .= '<tr>';
                    $ReturnHtml .= '<td>Buy '.$tbl_r->prd_qty.'</td>';
                    $ReturnHtml .= '<td>'.(100-(($this->GetDiscountedPrice($tbl_r->discount_type, $tbl_r->discount_price, $product_price)*100)/$product_price)).' % Off</td>';
                    $ReturnHtml .= '</tr>';
                }
                $ReturnHtml .= '</tbody>';
                $ReturnHtml .= '</table';
                break;
            case 6:
                  $ReturnHtml .= '<table class="shappify_qb_grid">';
                  $ReturnHtml .= '<thead>';
                  $ReturnHtml .= '<tr>';
                  $ReturnHtml .= '<th>Qty</th>';
                  $ReturnHtml .= '<th>Price</th>';
                  $ReturnHtml .= '</tr>';
                  $ReturnHtml .= '</thead>';
                  $ReturnHtml .= '<tbody>';
                  foreach ($result as $key => $tbl_r) {
                      $ReturnHtml .= '<tr>';
                      $ReturnHtml .= '<td>Buy '.$tbl_r->prd_qty.'-'.(isset($result[$key+1]->prd_qty) ? ($result[$key+1]->prd_qty-1) : $tbl_r->prd_qty.'++').'</td>';
                      $ReturnHtml .= '<td>'.$currency.' ' . $this->GetDiscountedPrice($tbl_r->discount_type, $tbl_r->discount_price, $product_price) . '</td>';
                      $ReturnHtml .= '</tr>';
                  }
                  $ReturnHtml .= '</tbody>';
                  $ReturnHtml .= '</table';
                break;
            default:
                echo "NO Table Structure Found";
        }

        return $ReturnHtml;
    }
    public function GetProductDiscount(Request $request)
    {
        $result = DB::table('tbl_set_price')->where('p_id', $request['p_id'])->get();
        if ($result->count() > 0) {
            $ShopifyApiClient = ShopifyApp::shop_get($request->shop);
            $shop_data        = $ShopifyApiClient->api()->request('GET', '/admin/shop.json');
            $productData      = $ShopifyApiClient->api()->request('GET', '/admin/products/' . $request['p_id'] . '.json');
            $currency         = $this->GetShopCurrency($shop_data);
            $product_price    = $this->GetProductPrice($productData);
            $data['is_qb_enabled']=true;
            $data['grid']=$this->CreateDiscountTableHtml($result, $currency, $product_price);
            $data['style']='';
            return response()->json($data);
        } else {
            $data['message']='No Data Found';
            return response()->json($data);
        }

    }

    public function GetCartPrices(Request $request)
    {
            $add=array();
            $update=array();
            $delete=array();
            $ShopifyApiClient = ShopifyApp::shop_get($request->shop);
            $data['add']=$add;
            $data['update']=$update;
            $data['delete']=$delete;
            $data['savings']='';
            $cart_data = json_decode($request['cart']);
            $return=array();
            $return['token'] = $cart_data->token;
            $return['note'] = $cart_data->note;
            $return['attributes'] = $cart_data->attributes;
            echo "<pre>";
            print_r($cart_data);
            echo "</pre>";

            echo nl2br("\n");
            echo nl2br("\n");
            echo nl2br("\n");
            echo "<pre>";
            print_r($return);
            echo "</pre>";

    }


    public function customer_pricing(Request $request)
    {
      $contents = View::make('getprices');
      $response = Response::make($contents);
      $response->header('Content-Type', 'application/javascript');
      return $response;
      return View::make('getprices');
    }

    public function csp_install_check(Request $request)
    {
      // $contents = View::make('getprices');
      // $response = Response::make($contents);
      // $response->header('Content-Type', 'application/javascript');
      // return $response;
    }

    public function cspqb(Request $request)
    {
        // $contents = View::make('getprices');
        // $response = Response::make($contents);
        // $response->header('Content-Type', 'application/javascript');
        // return $response;
    }


    public function get_qb_discount_banner_data(Request $request)
    {
      header('Content-Type: application/json');
      echo '{"is_qb_enabled": true,
        "is_you_saved_banner_enabled": true,
        "csp_qb_discount_banner_style":"color:#114760;background-color:#CDE8F4;border-color:#A4CBDD;margin:0px;padding:10px;font-size:12px;" ,
        "csp_display_fields": {
        "shop_app_id": 505162,
        "display_id": 2,
        "price_text": "Price",
        "qty_text": "Qty",
        "qty_min_text": "Minimum Qty",
        "qty_max_text": "Maximum Qty",
        "buy_qty_text": "Buy",
        "price_each_text": "ea",
        "preceeding_cart_text": "You will save",
        "following_cart_text": "by buying bulk",
        "unlimited_qty_text": "+",
        "color": "114760",
        "background_color": "CDE8F4",
        "border_color": "A4CBDD",
        "margin": 0,
        "padding": 10,
        "font_size": 12,
        "custom_display": null,
        "css": null,
        "overwrite_grid_css": false,
        "thead_background_color": "D6D6D6 ",
        "table_font_size": 12,
        "thead_color": "000",
        "thead_vowel": true,
        "tbody_background_1": "FFF",
        "tbody_background_2": "EFEFEF",
        "tbody_color": "000",
        "cell_padding": 5,
        "table_border": true,
        "table_border_color": "ccc",
        "table_margin": 0,
        "additional_css": "",
        "percent_discounted_text": "Off",
        "percent_text": "Discount",
        "show_base_price": true
      }}';
      exit;

    }

    public function group($groupid){

    if($groupid){
        if($groupid!="109726"){
            $SubscriptionGroup= Subscription_plan::find($groupid);

          // dd($SubscriptionGroup->attributes);
            //cart object
            $cart_obj=new  \stdClass();
            $cart_obj->cart=false;
            $cart_obj->single_product=false;
            $cart_obj->mixed=true;
            //standerd object
            $standerd=new \stdClass();
            $standerd->type_translation="";
            $standerd->secondary_type_translation="";
            //details_tooltip object
            $details_tooltip=new \stdClass();
            $details_tooltip->enabled=false;
            $details_tooltip->location=["bottom"=>true];
            // frequency_type object
            $frequency_type=new \stdClass();
            $frequency_type->frequency_type_translation="month";
            $frequency_type->frequency_type_id=$SubscriptionGroup->frequency_type;


            $dataSubc = new \stdClass();
            $dataSubc->recurring_group=true;
            $dataSubc->discount_percentage=0.9;
            $dataSubc->group_discount=$SubscriptionGroup->discount;
            $dataSubc->group_id=$SubscriptionGroup->id;
            $dataSubc->csrf_token=md5(date('y-m-d h:i:s'));
            $dataSubc->csrf_token_name='csrf_vowel_token';
            $dataSubc->s_shop_url='https:\/\/amkwebsolutions.com\/s\/scarflings-test\/';
            $dataSubc->shop_url='scarflings-test2.myshopify.com';
            $dataSubc->app_root='https:\\\/\\\/amkwebsolutions.com';
            $dataSubc->money_format="Rs. {{amount}}";
            $dataSubc->anonymous_login=1;
            $dataSubc->subscription_type=$SubscriptionGroup->subscription_type;
            $dataSubc->recurring_mode=$cart_obj;
            $dataSubc->secondary_discount=false;
            $dataSubc->subscription_box=false;
            $dataSubc->conversion=false;
            $dataSubc->standard=$standerd;
            $dataSubc->details_tooltip=$details_tooltip;
            $dataSubc->subscription_only=false;
            $dataSubc->prepaid=false;
            $dataSubc->is_prepaid_only=false;
            $dataSubc->is_prepaid_always_expires=false;
            $dataSubc->limited_subscription=false;
            $dataSubc->fixed_interval=true;
            $dataSubc->frequency_too_large=false;
            $dataSubc->add_to_existing=true;
            $dataSubc->is_cashier_linked=false;
            $dataSubc->is_subscription_default_on_widget=true;
            $dataSubc->frequency_num=$SubscriptionGroup->frequency_num;
            $dataSubc->frequency_type=[$frequency_type];


            return response()->json($dataSubc);
        }else{
                    header('Content-Type: application/json');
      echo '{
   "recurring_group":true,
   "discount_percentage":1,
   "group_discount":0,
   "group_id":"'.$groupid.'",
   "csrf_token":"xcvvxcvnxbvcnbvxnvcxvcnbvnxvcnvc",
   "csrf_token_name":"csrf_vowel_token",
   "s_shop_url":"https:\/\/amkwebsolutions.com\/s\/scarflings-test\/",
   "shop_url":"scarflings-test2.myshopify.com",
   "app_root":"https:\\\/\\\/amkwebsolutions.com",
   "money_format":"Rs. {{amount}}",
   "anonymous_login":1,
   "subscription_type":"1",
   "recurring_mode":{
      "cart":false,
      "single_product":false,
      "mixed":true
   },
   "secondary_discount":false,
   "subscription_box":false,
   "conversion":false,
   "standard":{
      "type_translation":"",
      "secondary_type_translation":""
   },
   "details_tooltip":{
      "enabled":false,
      "location":{
         "bottom":true
      }
   },
   "subscription_only":true,
   "prepaid":false,
   "is_prepaid_only":false,
   "is_prepaid_always_expires":false,
   "limited_subscription":false,
   "fixed_interval":true,
   "frequency_too_large":false,
   "add_to_existing":true,
   "is_cashier_linked":false,
   "is_subscription_default_on_widget":false,
   "frequency_num":1,
   "frequency_type":[
      {
         "frequency_type_translation":"month",
         "frequency_type_id":"3"
      }
   ]
}
        ';
  exit;
        }

    }

// use App\Subscription_plan;
// use App\Subscription_product;


    }

    public function createmeta(Request $request){
    $shop = ShopifyApp::shop_get($request->shop);
      $mt = array(
          "namespace"  => "vowel_rp",
          "key"        => "rp_group_id",
          "value"      => 109726,
          "value_type" => "integer",
      );
      $mtSingle = array("metafield" => $mt);
      $saveMeta = $shop->api()->request('POST', "/admin/products/" . $request->product . "/variants/".$request->variant."/metafields.json", $mtSingle);
      dd($saveMeta);
    }

    public function GetCountyList()
    {

        $countries = $this->GetCountries();
        $options   = '<option value="" >Select Country</option>';
        foreach ($countries as $country) {
            $options .= '<option data-val="' . $country->name . '" data-id="' . $country->id . '" value="' . $country->name . '">' . $country->name . '</option>';
        }
        echo $options;
    }
    public function GetCountries()
    {
        return DB::table('countries')->get();
    }

    public function GetStateList(Request $request)
    {
        $countries = DB::table('states')->where("country_id", $request['country_id'])->get();
        $options   = '<option value="">Select State</option>';
        foreach ($countries as $country) {
            $options .= '<option data-val="' . $country->name . '" data-id="' . $country->id . '" value="' . $country->name . '">' . $country->name . '</option>';
        }

        echo $options;
    }

    public function GetShopifyCustomer(Request $request)
    {
        $ShopifyApiClient = ShopifyApp::shop_get($request['shop']);
        $customerData = $ShopifyApiClient->api()->request('GET', '/admin/customers/'.$request['customer'].'.json');
        if(count((array)$customerData->body->customer) > 0){
          $return = ["code"=>200,"data"=>$customerData->body->customer];
        }else{
          $return = ["code"=>100,"data"=>"No Data Found"];
        }
        return response()->json($return);
    }

    public function UploadCanvas(Request $request)
    {

      $upload_dir = $_SERVER['DOCUMENT_ROOT'].'/shopify-app/subscription-swap/public/BoxImages/';

// img_proof

      $img_preview = $_POST['img_preview'];
      $img_preview = str_replace('data:image/png;base64,', '', $img_preview);
      $img_preview = str_replace(' ', '+', $img_preview);
      $PreData = base64_decode($img_preview);
      $preName = 'pre'.time().".png";
      $fileFile = $upload_dir.$preName;
      file_put_contents($fileFile, $PreData);
      $preFile = 'https://amkwebsolutions.com/shopify-app/subscription-swap/public/BoxImages/'.$preName;


      $img_proof = $_POST['img_proof'];
      $img_proof = str_replace('data:image/png;base64,', '', $img_proof);
      $img_proof = str_replace(' ', '+', $img_proof);
      $ProofData = base64_decode($img_proof);
      $proofName = 'proof'.time().".png";
      $fileFile2 = $upload_dir.$proofName;
      $success = file_put_contents($fileFile2, $ProofData);
      $proofFile = 'https://amkwebsolutions.com/shopify-app/subscription-swap/public/BoxImages/'.$proofName;
      if($success){
          $return = ["code"=>200,"data"=>['img_preview'=>$preFile,'img_proof'=>$proofFile]];
        }else{
          $return = ["code"=>100,"data"=>"File Not Upload"];
        }
      return response()->json($return);
    }




}
