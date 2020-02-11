<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use OhMyBrew\ShopifyApp\Models\Shop;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use DB;
class ProcessProductMetaFields implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $SubscriptionPlanId;
    protected $Subscription_productId;
    protected $merchantshop;
    public function __construct($SubscriptionPlanId,$Subscription_productId,$merchantshopname)
    {
        $this->SubscriptionPlanId=$SubscriptionPlanId;
        $this->merchantshop=$this->findShop($merchantshopname);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
     public function handle(Request $request)
     {
        Log::info('Runiung job for subscription : '.$this->SubscriptionPlanId);
        $client = new Client();

        try {
          $client->request('GET', 'https://amkwebsolutions.com/shopify-app/subscription-swap/processSubscriptionPlan', [
              'json' => [
                  'subscription_plan' => $this->SubscriptionPlanId
              ]
          ]);
        } catch (RequestException $e) {
          Log::info($e);
        }
      //  $request->query->add(array('SubscriptionPlanId'=>$this->SubscriptionPlanId));
      //  $data = app()->call(SubscriptionSyncController::class . '@processSubscriptionPlan');
         //Get user's product details
         // $respose = $this->getRequestedProduct($this->syncproductId);
         // if (isset($respose->body)) {
         //
         //   // Create product in master store
         //   $created_pro = $this->CreateInMaster($respose->body);
         //   if(isset($created_pro->product)){
         //     $data = ProductsModel::find($this->syncproductId);
         //     $data->is_synched = 1;
         //     $data->synched_at = Carbon::now();
         //     $data->master_store_prd_id = $created_pro->product->id;
         //     $data->save();
         //   }
         //   // dump($created_pro);
         // }
          return TRUE;
     }


     protected function getRequestedProduct($request_id){

     }


     protected function CreateInMaster($data=array())
     {

     }


     protected function variant_ids($indices=[],$variants=[])
     {
         $variant_ids = [];
         foreach ($indices as $index) {
           $variant_ids[] = $variants[$index]->id;
         }
         return $variant_ids;
     }

     /**
      * Finds the shop based on domain from the webhook.
      *
      * @return Shop|null
      */
     protected function findShop($shopDomain)
     {
         $shopModel = Config::get('shopify-app.shop_model');
         return $shopModel::where(['shopify_domain' => $shopDomain])->first();
     }
}
