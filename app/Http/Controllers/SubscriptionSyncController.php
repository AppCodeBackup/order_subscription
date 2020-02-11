<?php

namespace App\Http\Controllers;

use DB;
use Artisan;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use App\Jobs\SubscriptionSync;
use App\Jobs\DeleteSubscriptionVariant;
use Illuminate\Support\Facades\Log;
use App\Subscription_plan;
use App\Product_images;
use App\Subscription_product;

use OhMyBrew\ShopifyApp\Models\Shop;

class SubscriptionSyncController extends Controller
{
  public $q;
  public function create_subsc_group_data(Request $request)
  {

      $prdId=array();
      foreach ($request->recurring_filter as $productkey => $value) {
          $prdId[]=$productkey;
          $ik = $productkey."_image";
          $tk = $productkey."_title";
          $hk = $productkey."_handle";
          $save = Product_images:: updateOrCreate(
                ['image_src' => $request[$ik], 'title' => $request[$tk],'p_id'=>$productkey,'p_handle'=>$request[$hk]],
                ['p_id' => $productkey]
            );
      }

      $productString = implode(',',$prdId);
      $shop = ShopifyApp::shop_get($request->shop);
      $Subscription_plan = new Subscription_plan;
      $Subscription_plan->shops_id=$shop->id;
      $Subscription_plan->group_name=$request->group_name;
      $Subscription_plan->subscription_type=$request->subscription_type;
      $Subscription_plan->product_ids=$productString;
      $Subscription_plan->recurring_filter=$productString;
      $Subscription_plan->interval_type=$request->interval_type;
      $Subscription_plan->max_number=$request->max_number;
      $Subscription_plan->frequency_num=$request->frequency_num;
      $Subscription_plan->frequency_type=$request->frequency_type;
      $Subscription_plan->billing_plan=$request->billing_plan;
      $Subscription_plan->billing_day=$request->billing_day;
      $Subscription_plan->billing_offset=$request->billing_offset;
      $Subscription_plan->billing_offset_week=$request->billing_offset_week;
      $Subscription_plan->is_subscription_default_on_widget=$request->is_subscription_default_on_widget;
      $Subscription_plan->is_limited_subscription=$request->is_limited_subscription;
      $Subscription_plan->limited_continue=$request->limited_continue;
      $Subscription_plan->prepaid_continue=$request->prepaid_continue;
      $Subscription_plan->min_convertible_cancel_length_enabled=$request->min_convertible_cancel_length_enabled;
      $Subscription_plan->min_recurrences_before_cancellable=$request->min_recurrences_before_cancellable;
      $Subscription_plan->discount_config=$request->discount_config;
      $Subscription_plan->discount=$request->discount;
      $Subscription_plan->box_lock_days=$request->box_lock_days;
      $Subscription_plan->box_lock_hours=$request->box_lock_hours;
      $Subscription_plan->box_lock_after_choices=$request->box_lock_after_choices;
      $Subscription_plan->box_lock_beyond_days=$request->box_lock_beyond_days;
      $Subscription_plan->search_title=$request->search_title;
      $dataSave=$Subscription_plan->save();

      if(isset($Subscription_plan)){
        foreach ($request->recurring_filter as  $productkey => $allVariants){
            if($allVariants){
             $VariantsArray= explode(',',$allVariants);
              if($VariantsArray){
                foreach($VariantsArray as $singleVariants){
                  $Subscription_product = new Subscription_product;
                  $Subscription_product->subscription_plans_id;
                  $Subscription_product->subscription_plans_id=$Subscription_plan->id;
                  $Subscription_product->product_id=$productkey;
                  $Subscription_product->variants_id=$singleVariants;
                  $Subscription_product->save();
                  $Subscription_product->id;
                  $total_jobs = DB::table('jobs')->count();
                  $delay = $total_jobs+1;
                  $job = (new SubscriptionSync($Subscription_product->id,$shop->shopify_domain))->delay(Carbon::now()->addSeconds($delay));
                  dispatch($job);
                }
              }
            }

            // $productkey
        }
      }
      $responsedata = ["code" => 200, "msg" => "Subscription Request added to queue"];
      return response()->json($responsedata);
  }

  public function processSubscriptionPlan(Request $request){
    $ShopifyApiClient = ShopifyApp::shop_get($request->shop);
    $SubscriptionData=  Subscription_product::find($request->subscription_plan);
    $mtSingle =["metafield"=>["namespace"  => "vowel_rp","key" => "rp_group_id","value"=> $SubscriptionData->subscription_plans_id,"value_type" => "string"]];
    $saveMeta = $ShopifyApiClient->api()->request('POST', '/admin/products/'.$SubscriptionData->product_id.'/variants/'.$SubscriptionData->variants_id.'/metafields.json', $mtSingle);
  }

  public function extractdataFromCsv($allProducts){
      if($allProducts){
        return  explode(',',$allProducts);
        }
  }

  public function DeleteGroup(Request $request)
  {
        $subscriptionData=  DB::table('subscription_products')->where(['subscription_plans_id'=>$request->group_id])->get();
        foreach ($subscriptionData as  $subscription) {
          $total_jobs = DB::table('jobs')->count();
          $delay = $total_jobs+1;
          $job = (new DeleteSubscriptionVariant($subscription->id,$request->shop))->delay(Carbon::now()->addSeconds($delay));
          dispatch($job);
        }
        $responsedata = ["code" => 200, "msg" => "Delete Request Added TO queue"];
        return response()->json($responsedata);
  }

  public function DeleteGroupFromJob(Request $request)
  {
      $subscriptionData=  Subscription_product::find($request->subscription_plan);
      $ShopifyApiClient = ShopifyApp::shop_get($request->shop);
      $GetVariantMetafield = $ShopifyApiClient->api()->request('GET', '/admin/products/'.$subscriptionData->product_id.'/variants/'.$subscriptionData->variants_id.'/metafields.json');
      if(count($GetVariantMetafield->body->metafields) > 0){
        foreach ($GetVariantMetafield->body->metafields as $key => $meta) {
          if($meta->key == 'rp_group_id' && $meta->value == $subscriptionData->subscription_plans_id){
              $delete = $ShopifyApiClient->api()->request('DELETE', '/admin/metafields/' . $meta->id . '.json');
          }
        }
        $delete = Subscription_product::destroy($request->subscription_plan);
      }
      $recordCount=  Subscription_product::where(['subscription_plans_id' => $subscriptionData->subscription_plans_id])->count();
      if($recordCount == 0){
        $res=Subscription_plan::where('id',$subscriptionData->subscription_plans_id)->delete();
      }
  }


}
