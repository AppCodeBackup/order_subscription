<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use OhMyBrew\ShopifyApp\Models\Shop;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class AdminApiController extends Controller
{


      public function crateoptions(Request $request){
        dd($request->all());

      }
      public function create_subsc_group_data(){
          dd($_POST);
      }

      public function GetProducts(Request $request)
      {
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
                        $variantDaTa[]  = $returnVariants;
                        $returnVariants = [];
                    }
                    $returnProduct['variants']  = $variantDaTa;
                    $variantDaTa                = [];
                    $returnProduct['image_url'] = (isset($singleProduct->image->src)) ? $singleProduct->image->src : '';
                    $product[]                  = $returnProduct;
                    $returnProduct              = [];
                    $i++;
                  }

                $responsedata['totalNumber'] = $products_count->body->count;
                $responsedata['currentPage'] = 1;
                $responsedata['totalPage']   = ceil($products_count->body->count / 50);
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
        header('Content-Type: application/json');
      echo '{
   "recurring_group":true,
   "discount_percentage":1,
   "group_discount":0,
   "group_id":"109726",
   "csrf_token":"424e2a8d96624b0bdcf553cf60f4006c",
   "csrf_token_name":"csrf_vowel_token",
   "s_shop_url":"https:\/\/ro.boldapps.net\/s\/scarflings-test\/",
   "shop_url":"scarflings-test2.myshopify.com",
   "app_root":"https:\\\/\\\/ro.boldapps.net",
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



}
