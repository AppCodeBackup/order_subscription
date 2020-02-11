<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use Stripe\Plan as StripePlan;
use App\Customer_subscription_product as CSP;

class SubscriptionApiController extends Controller
{

    public function swapprd(Request $request){
        //dd($request->all());
        $shopDomain=$request->shop;
        $productId=$request->productid;
        $subscriptionId=$request->subscriptionIID;
        $ShopifyApiClient        = ShopifyApp::shop_get($shopDomain);
        $productData=$ShopifyApiClient->api()->request('GET', '/admin/products/'.$productId.'.json');
        $product=$productData->body->product;
        $data=['subsc_product_id'=>$product->id,'subsc_variants_id'=>$product->variants{0}->id,'product_title'=>$product->title,'variant_title'=>$product->variants{0}->title];
        DB::table('customer_subscription_product')->where('stripe_subscription_id',$subscriptionId)->where('subsc_product_id',$request->oldproduct)->update($data);
        $returnData=['status'=>'success','code'=>'200','msg'=>'Subscription product updated.'];
        return response()->json($returnData);
    }
    public function getCustomerOrders(Request $request)
    {
       // dd($request->all());
        $orderIds=$request->order_ids;
        $dataList=[];
        foreach ($orderIds as $singleOrderId) {
          $CSPDATA = CSP::where('shopify_order_id',$singleOrderId)->get();
          if($CSPDATA){
              foreach ($CSPDATA as $CSPDATA_Single) {
                $dataList[]=$CSPDATA_Single;
              }

          }
          $CSPDATA=[];
        }
    //    dd($dataList);
        if($dataList){
            $returnData=['status'=>'success','code'=>'200','data'=>$dataList];

        }else{
            $returnData=['status'=>'success','code'=>'100','msg'=>'No subscription Available'];
        }
        return response()->json($returnData);
       // dd($dataList);

    }
    public function index()
    {
        \Stripe\Stripe::setApiKey("sk_test_Y5MS5U8FzcFgrMstn8SoAOrY00yDDGieq4");

        StripePlan::create(array(
            "amount"   => 5000,
            "interval" => "month",
            "product"  => array(
                "name" => "Bronze standard",
            ),
            "currency" => "eur",
            "id"       => "bronze-standard",
        ));
        //$customers=Customer::All();
        //dd($customers{0}->id);
        $ShopifyCustomer = Customer::find(1);
        //dd($ShopifyCustomer);
        //$StripeCustomer=$ShopifyCustomer->createAsStripeCustomer();
        //dd($StripeCustomer);
        //return view('paymentform');
        return view('paymentform', [
            'intent' => $ShopifyCustomer->createSetupIntent(),
        ]);
    }

    public function GetPaymentMethodFromCustomer(Request $request)
    {
        $strCustomerInfo = urldecode($request->shippingInfo);
        parse_str($strCustomerInfo, $customerInfo);
        $fname         = $customerInfo['checkout']['shipping_address']['first_name'];
        $lname         = $customerInfo['checkout']['shipping_address']['last_name'];
        $CustomerEmail = $customerInfo['checkout']['email'];
        $exitCustomer  = Customer::where(['email' => $CustomerEmail])->count();
        if ($exitCustomer == 0) {
            $C_info        = new Customer;
            $C_info->name  = $fname . ' ' . $lname;
            $C_info->email = $CustomerEmail;
            $C_info->save();
            $c_id = $C_info->id;
        } else {
            $exitCustomer = Customer::where(['email' => $CustomerEmail])->get();
            $c_id         = $exitCustomer{0}->id;
        }
        $ShopifyCustomer = Customer::find($c_id);
        $StripeCustomer  = $ShopifyCustomer->createAsStripeCustomer();
        $setupIntent     = $ShopifyCustomer->createSetupIntent();
        $responsedata    = ["code" => 200, "client_secret" => $setupIntent->client_secret];
        return response()->json($responsedata);
    }

    public function postsubscription(Request $request)
    {


        $ShopifyApiClient        = ShopifyApp::shop_get($request['shop_domain']);
        $string_shipping_address = urldecode($request->customer_data['customer_info']);
        parse_str($string_shipping_address, $shippingdata);
        $shipping_addr = $shippingdata['checkout']['shipping_address'];
        foreach ($shipping_addr as $key => $val) {
            $shipping_addr[$key] = (isset($shipping_addr[$key]) ? $val : '');
        }
        $string_billing_address = urldecode($request->customer_data['billing_address']);
        parse_str($string_billing_address, $billingdata);
        $billing_addr = $billingdata['checkout']['billing_address'];
        if (!empty($billing_addr['address1'])) {
            foreach ($billing_addr as $key => $val) {
                $billing_addr[$key] = (isset($billing_addr[$key]) ? $val : '');
            }
        } else {
            $billing_addr = $shipping_addr;
        }

        $cartData            = json_decode($request->cart_data);
        $line_items          = array();
        $subscriptionProduct = array();
        $normalProduct       = array();
        foreach ($cartData->items as $key => $item) {
            if (count((array) $item->Vowel) > 0) {
                $subscriptionProduct[] = $item;
            } else {
                $normalProduct[] = $item;
            }
        }

        $intentData      = json_decode($request->customer_data['setupIntent']);
        $paymentMethod   = $intentData->payment_method;
        $strCustomerInfo = urldecode($request->customer_data['customer_info']);
        parse_str($strCustomerInfo, $customerInfo);
        $CustomerEmail = $customerInfo['checkout']['email'];
        $exitCustomer  = Customer::where(['email' => $CustomerEmail])->get();
        $c_id          = $exitCustomer{0}->id;
        $user          = Customer::find($c_id);

        \Stripe\Stripe::setApiKey("sk_test_Y5MS5U8FzcFgrMstn8SoAOrY00yDDGieq4");
        if (count($subscriptionProduct) > 0) {
            $sbprice = 0;
            foreach ($subscriptionProduct as $SBproduct) {
                $singlePrice  = (($SBproduct->Vowel->ro_unformatted_price / 100 )* $SBproduct->quantity);
                $sbprice = $sbprice + $singlePrice;
            }
            $current_date_time = Carbon::now()->getTimestamp();
            $plaNid            = $current_date_time . rand();
            $planDAta          = StripePlan::create([
                "amount"   => $sbprice * 100,
                "interval" => "month",
                "product"  => ["name" => "Shopify Product"],
                "currency" => "usd","id"=> $plaNid
            ]);
            $subscription  = $user->newSubscription($planDAta->id, $planDAta->id)->create($paymentMethod);
            $sbProductInfo = array();
            $stripeSubID   = $subscription->stripe_id;
            $stripePlanID  = $planDAta->id;
            foreach ($subscriptionProduct as $SBproduct) {
                $sbProductInfo[] = [
                    'subsc_product_id'=> $SBproduct->product_id,
                    'subsc_variants_id'      => $SBproduct->variant_id,
                    'variant_price'          => $SBproduct->price/100,
                    'variant_qty'            => $SBproduct->quantity,
                    'frequency_num'          => $SBproduct->Vowel->frequency_num,
                    'frequency_type'         => $SBproduct->Vowel->frequency_type,
                    'group_id'               => $SBproduct->Vowel->group_id,
                    'stripe_plan_id'         => $planDAta->id,
                    'variants_actual_price'  => $SBproduct->original_price/100,
                    'product_title'          => $SBproduct->product_title,
                    'variant_title'          => $SBproduct->title,
                    'stripe_subscription_id' => $subscription->stripe_id,
                ];
            }

            $mtSingle =["metafield"=>["namespace"  => "stripe","key" => "stripe_subscription_id","value"=> $subscription->stripe_id,"value_type" => "string"]];
            DB::table('customer_subscription_product')->insert($sbProductInfo);
        }


        $linearray = array();
        foreach ($cartData->items as $key => $line) {

            $get_properties = array();
            if (isset($line->properties_all) && count((array) $line->properties_all) > 0) {
                $get_properties = $this->properties($line->properties_all);
            }
            $discount_get = 0;
            if ($line->price != $line->original_price) {
                $discount_get = ($line->original_price - $line->price) / 100;
            }

            if ($discount_get > 0) {
                $linearray[] = [
                    "variant_id"       => $line->id,
                    "quantity"         => $line->quantity,
                    "properties"       => $get_properties,
                    "applied_discount" => [
                        "description" => "Subscription Discount",
                        "value_type"  => "fixed_amount",
                        "value"       => $discount_get,
                        "amount"      => ($discount_get * $line->quantity),
                    ],
                ];
            } else {
                $linearray[] = [
                    "variant_id" => $line->id,
                    "quantity"   => $line->quantity,
                    "properties" => $get_properties,
                ];
            }
        }
        $draft_order = [
            "draft_order" => [
                "line_items"       => $linearray,
                "shipping_address" => $shipping_addr,
                "billing_address"  => $billing_addr,
                "email"            => $CustomerEmail,
            ],
        ];
        $shipingMethodstr = urldecode($request->customer_data['shipping_method']);
        parse_str($shipingMethodstr, $shippingMethodsPosted);
        if (isset($shippingMethodsPosted['shipping_rate'],$shippingMethodsPosted['shipping_price'])) {
          $draft_order["draft_order"]["shipping_line"] = array(
              'title' => $shippingMethodsPosted['shipping_rate'],
              'custom' => true,
              'price' =>(($shippingMethodsPosted['shipping_price'] !='') ? $shippingMethodsPosted['shipping_price'] : 0 ),
            );
        }

      // Create Charge For Normal Products In stripe

        $normalAmt=0;
        if(count($normalProduct) > 0){
                foreach ($normalProduct as $np) {
                  $normalAmt  = $normalAmt+$np->line_price / 100;
                }
                $normalAmt = $normalAmt+$shippingMethodsPosted['shipping_price'];
        }else{
            if (isset($shippingMethodsPosted['shipping_rate'],$shippingMethodsPosted['shipping_price'])) {
              $normalAmt = $shippingMethodsPosted['shipping_price'];
            }
        }
        if($normalAmt > 0){
          $stripeCharge = $user->charge($normalAmt*100, $paymentMethod);
        }

        $ShopifyApiClient = ShopifyApp::shop_get($request['shop_domain']);

          // print_r($draft_order);
          // exit;
          // echo json_encode($draft_order);
          // exit;
        try {
            $shopdata         = $ShopifyApiClient->api()->request('POST', '/admin/draft_orders.json', $draft_order);
            // echo "<pre>";
            // dd($shopdata);
            // echo "</pre>";
            // exit;
          }catch(Exception $e) {
              dd($e);
          }

          //dd($shopdata);

        $orderid          = $shopdata->body->draft_order->id;
        $completeArray    = ['draft_order' => ['id' => $orderid, 'status' => 'completed']];
        $completed        = $ShopifyApiClient->api()->request('PUT', '/admin/draft_orders/' . $orderid . '/complete.json', $completeArray);
        $DraftOrderID     = $completed->body->draft_order->order_id;
        $orderDetails     = $ShopifyApiClient->api()->request('GET', '/admin/orders/' . $DraftOrderID . '.json');
        $shopifyOrderID   = $orderDetails->body->order->id;
        if (count($subscriptionProduct) > 0) {
            DB::table('customer_subscription_product')->where('stripe_subscription_id', $stripeSubID)->update(['shopify_order_id' => $shopifyOrderID]);
            $saveMeta = $ShopifyApiClient->api()->request('POST', '/admin/orders/'.$shopifyOrderID.'/metafields.json', $mtSingle);
        }

        $responsedata = ["code" => 200, "orderStatus" => $orderDetails->body->order->order_status_url];
        return response()->json($responsedata);
    }

    public function properties($array)
    {
        $retu_array = array();
        foreach ($array as $key => $value) {
            $retu_array[] = ['name' => $key, 'value' => $value];
        }
        return $retu_array;
    }

    public function saveSubscriptionOrderProduct()
    {

    }

    public function saveSubscriptionOrderInfo()
    {

    }

}
