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
use URL;

class SubscriptionSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $SubscriptionPlanId;
    protected $shop;
    public function __construct($SubscriptionPlanId,$requestedshop)
    {
        $this->SubscriptionPlanId=$SubscriptionPlanId;
        $this->shop=$requestedshop;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
     public function handle(Request $request)
     {
        Log::info('Runiung job for subscription : '.$this->SubscriptionPlanId.'-- For Shop --'. $this->shop);
        $postUrl = 'https://amkwebsolutions.com/shopify-app/subscription-swap/processSubscriptionPlan';
        $client = new Client();
        $client->request('GET', $postUrl, ['json' => ['subscription_plan' => $this->SubscriptionPlanId,'shop' => $this->shop]]);
        return TRUE;

     }



     /**
      * Finds the shop based on domain from the webhook.
      *
      * @return Shop|null
      */

}
