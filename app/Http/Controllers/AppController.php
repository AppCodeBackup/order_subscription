<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use OhMyBrew\ShopifyApp\Models\Shop;
use View;
use URL;
use App\Subscription_plan;
use App\Product_images;
use App\Subscription_product;

use Stripe\Subscription as StripeSubscription;


class AppController extends Controller
{
      public function index(Request $request)
      {

          $shop = ShopifyApp::shop_get($request->shop);
          $shopdata    = $shop->api()->request('GET', '/admin/shop.json');
          $shopDatashp = $this->getShopDetails($shopdata->body->shop->myshopify_domain);
          return View::make('welcome', ['shop' => $shopdata->body->shop->myshopify_domain, 'shopdata' => $shopDatashp,'page'=>'subscription','appUrl'=>URL::to('/')]);
      }
      public function create_subscription_set(Request $request)
      {

          $shop = ShopifyApp::shop_get($request->shop);
          $shopdata    = $shop->api()->request('GET', '/admin/shop.json');
          $shopDatashp = $this->getShopDetails($shopdata->body->shop->myshopify_domain);
          return View::make('subscription.create-subscription', ['shop' => $shopdata->body->shop->myshopify_domain, 'shopdata' => $shopDatashp,'page'=>'subscription','appUrl'=>URL::to('/')]);
      }




      public function SubscriptionGroups(Request $request)
      {
          $shop = ShopifyApp::shop_get($request->shop);
          $shopdata    = $shop->api()->request('GET', '/admin/shop.json');
          $shopDatashp = $this->getShopDetails($shopdata->body->shop->myshopify_domain);
          $SubscriptionData=  Subscription_plan::all();
          return View::make('subscription.subscription-list', ['Subscriptions'=>$SubscriptionData,'shop' => $shopdata->body->shop->myshopify_domain, 'shopdata' => $shopDatashp,'page'=>'subscription','appUrl'=>URL::to('/')]);
      }

      public function SubScriptionCustomers(Request $request)
      {
          $shop = ShopifyApp::shop_get($request->shop);
          $shopdata    = $shop->api()->request('GET', '/admin/shop.json');
          $shopDatashp = $this->getShopDetails($shopdata->body->shop->myshopify_domain);
          $customers = DB::table('customers')->get();
          foreach ($customers as $key => $customer) {
            $customer->subscriptions = DB::table('subscriptions')->where(['customer_id'=>$customer->id])->get();
          }
          return View::make('subscription.customers', ['customers'=>$customers,'shop' => $shopdata->body->shop->myshopify_domain, 'shopdata' => $shopDatashp,'page'=>'subscriptioncustomers','appUrl'=>URL::to('/')]);
      }

      public function DiscountCodes(Request $request)
      {
        $shop = ShopifyApp::shop_get($request->shop);
          $shopdata    = $shop->api()->request('GET', '/admin/shop.json');
          $shopDatashp = $this->getShopDetails($shopdata->body->shop->myshopify_domain);
          return View::make('subscription.discount-codes', ['shop' => $shopdata->body->shop->myshopify_domain, 'shopdata' => $shopDatashp,'page'=>'discount','appUrl'=>URL::to('/')]);
      }
      public function CreateDiscountCode(Request $request)
      {
          $shop = ShopifyApp::shop();
          $shopdata    = $shop->api()->request('GET', '/admin/shop.json');
          $shopDatashp = $this->getShopDetails($shopdata->body->shop->myshopify_domain);
          return View::make('subscription.create-discount-codes', ['shop' => $shopdata->body->shop->myshopify_domain, 'shopdata' => $shopDatashp,'page'=>'discount','appUrl'=>URL::to('/')]);
      }



    public function GetActiveTheme()
    {
        $shop   = ShopifyApp::shop();
        $themes = $shop->api()->request('GET', '/admin/themes.json');
        foreach ($themes->body->themes as $theme) {
            if ($theme->role == 'main') {
                $active = $theme;
            }
        }
        $theme_id     = $active->id;
        $product_page = $shop->api()->request('GET', 'admin/themes/' . $active_theme->id . '/assets.json', ['asset[key]' => 'templates/product.liquid']);
    }



    public function getShopDetails($shopp)
    {
        return DB::table('shops')->where('shopify_domain', $shopp)->first();
    }
    public function find_product_title(Request $request)
    {
        //  print_r($request->shop);
        $ShopifyApiClient = ShopifyApp::shop_get($request->shop);
        if ($request->title != '') {
            $search         = ['title' => $request->title, 'page' => $request->pageNumber];
            $products_count = $ShopifyApiClient->api()->request('GET', '/admin/products/count.json', ['title' => $request->title]);
        } else {
            $search         = ['page' => $request->pageNumber];
            $products_count = $ShopifyApiClient->api()->request('GET', '/admin/products/count.json');
        }

        $ShopifyApiClient = ShopifyApp::shop_get($request->shop);

        // dd($products_count->body->count);
        $products = $ShopifyApiClient->api()->request('GET', '/admin/products.json', $search);

        if (isset($products->body->products)) {
            if (count($products->body->products) > 0) {

                $responsedata               = [];
                $responsedata['type']       = 'products';
                $responsedata['type_value'] = 'all';
                $i                          = 0;
                foreach ($products->body->products as $singleProduct) {
                    $returnProduct['id']     = $singleProduct->id;
                    $returnProduct['title']  = $singleProduct->title;
                    $returnProduct['handle'] = $singleProduct->handle;
                    foreach ($singleProduct->variants as $singleVariants) {
                        $returnVariants['id']               = $singleVariants->id;
                        $returnVariants['price']            = $singleVariants->price;
                        $returnVariants['compare_at_price'] = $singleVariants->compare_at_price;
                        $returnVariants['title']            = $singleVariants->title;
                        //  $returnVariants['image_uri']=>$singleVariants->image_uri;
                        $variantDaTa[]  = $returnVariants;
                        $returnVariants = [];
                    }
                    $returnProduct['variants']  = $variantDaTa;
                    $variantDaTa                = [];
                    $returnProduct['image_url'] = (isset($singleProduct->image->src)) ? $singleProduct->image->src : '';
                    $product[]                  = $returnProduct;
                    $returnProduct              = [];
                    $i++;}

                $responsedata['totalNumber'] = $products_count->body->count;
                $responsedata['currentPage'] = 1;
                $responsedata['totalPage']   = ceil($products_count->body->count / 50);
                //$responsedata['count']=$i;
                $responsedata['data'] = $product;
                $responsedata['code'] = 200;
                $responsedata['msg']  = $i . " product found.";
            } else {
                $responsedata['totalNumber'] = $products_count->body->count;
                $responsedata['type']        = 'products';
                $responsedata['type_value']  = 'all';
                $responsedata['code']        = 100;
                $responsedata['data']        = [];
                $responsedata['msg']         = "No product found.";
            }

        } else {
            $responsedata['totalNumber'] = $products_count->body->count;
            $responsedata['type']        = 'products';
            $responsedata['type_value']  = 'all';
            $responsedata['code']        = 100;
            $responsedata['data']        = [];
            $responsedata['msg']         = "No product found.";
        }
        return response()->json($responsedata);
    }






    public function CreateDraft(Request $request)
    {
        $ShopifyApiClient = ShopifyApp::shop_get($request['shop_url']);
        $cart_data = json_decode($request['shopify_cart']);

        $line_items = array();
        foreach ($cart_data->items as $key => $item) {
            $discount_get=0;
            $discount=0;
            $get_properties=array();
            if(count((array)$item->properties) > 0){
                $get_properties = $this->properties($item->properties);
               if($item->price !=$item->properties->_ro_unformatted_price){
                 $discount_get=($item->price-$item->properties->_ro_unformatted_price)/100;
               }
            }

            if($discount_get > 0){
              $line_items[] = [
                  "variant_id" => $item->id,
                  "quantity"   => $item->quantity,
                  "properties"   =>$get_properties,
                  "applied_discount"=>[
                    "description"=>"Subscription Discount",
                    "value_type" => "fixed_amount",
                    "value"=> $discount_get,
                    "amount"=> ($discount_get*$item->quantity)
                    ]
                ];
            }else{
              $line_items[] = [
                "variant_id" => $item->id,
                "quantity"   => $item->quantity,
                "properties"   =>$get_properties,
              ];
            }
        }
        if($request['shopify_customer_id']){
          $draft_order = ["draft_order"=>["line_items"=>$line_items,'customer'=>['id'=>$request['shopify_customer_id']]]];
        }else{
          $draft_order = ["draft_order"=>["line_items"=>$line_items]];
        }
        $shopdata = $ShopifyApiClient->api()->request('POST', '/admin/draft_orders.json', $draft_order);
        return redirect($shopdata->body->draft_order->invoice_url);
    }

    public function properties($array)
    {
        $retu_array=array();
        foreach ($array as $key => $value) {
          $retu_array[]=['name'=>$key,'value'=>$value];
        }
        return $retu_array;
    }

    public function GetSubscriptionProducts(Request $request)
    {
        $products = explode(',',$request['pids']);
        $return="";
        $return.='<style>
        .btnclass{
            background: linear-gradient(180deg,#6371c7,#5563c1);
            box-shadow: inset 0 1px 0 0 #6774c8,0 1px 0 0 rgba(22,29,37,.05),0 0 0 0 transparent;
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.6rem;
            margin: 0;
            padding: .7rem 1.6rem;
            border-color:#3f4eae;
            color:#fff;
            border-radius: 6px;
            cursor:pointer;
        }
                  </style>';
        $return.='<div style="margin-left: 7%;">';
        $return.='<table style="border:1px solid black;border-collapse:collapse;"><tr><th style="border:1px solid black;">Product Image</th><th style="border:1px solid black;">Title</th><th style="border:1px solid black;">View</th></tr>';
        foreach ($products as $product) {
            $productData=  Product_images::where(['p_id'=>$product])->first();
            if($productData){
              $return.='<tr><td style="border:1px solid black;text-align: center;"><img style="height: 50px;" src="'.$productData->image_src.'"></td><td style="border:1px solid black;text-align: center;">'.$productData->title.'</td>
              <td style="border:1px solid black;text-align: center;">
              <div style="display:inline-flex">
              <a  target="_blank"   href="https://'.$request->shop.'/admin/products/'.$product.'" ><button  type="button" class="btnclass" >Admin</button></a>
              <a  target="_blank"  href="https://'.$request->shop.'/products/'.$productData->p_handle.'" ><button  type="button" class="btnclass"  style="margin-left: 2%;background:#fe9d52;border:#fe9d52;" >StoreFront</button></a>
              </div>
              </td></tr>';
            }
        }
        $return.='</table>';
        $return.='</div>';
       echo $return;
    }

    public function SubscriptionDetailsByID(Request $request)
    {
      $sub_id=$request->sub_id;
      $stype=['Day(s)','Week(s)','Month(s)'];
      $s_detais = DB::table('subscriptions')->where(['stripe_id'=>$sub_id])->first();
      $subscriptionDatils = DB::table('customer_subscription_product')->where(['stripe_subscription_id'=>$sub_id])->get();
      if(count($subscriptionDatils) >0){
        $subscriptionDatils[0]->created_at=date('d-M-Y',strtotime($s_detais->created_at));
        $subscriptionDatils[0]->no_orders=$subscriptionDatils[0]->frequency_num;
        $subscriptionDatils[0]->per=$stype[($subscriptionDatils[0]->frequency_type-1)];
        $subscriptionDatils[0]->upcomingOrderDate= date('d-M-Y',strtotime('+30 days',strtotime($s_detais->created_at)));
        $subscriptionDatils[0]->productDetails = DB::table('products_details')->where(['p_id'=>$subscriptionDatils[0]->subsc_product_id])->first();
        $response = ["code"=>200,"data"=>$subscriptionDatils];
      }else{
        $response = ["code"=>100,"msg"=>"First Order  Not completed By User"];
      }
      return response()->json($response);
    }

}
