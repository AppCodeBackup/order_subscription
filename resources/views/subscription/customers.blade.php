@extends('layout.app')
@section('content')
<div class="notification-container">
    <style>.message > p {
        margin: 0;
        line-height: 1.75em
        }

body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
</style>
    <div class="message with-info alert-145" style="margin-top:15px;">
        <p>
        </p>
        <p style="text-align:center"><span style="font-size:14px">A good returns policy isn't&nbsp;just a good thing to have, it can actually be a GREAT way to compete. We've <a href="https://blog.boldcommerce.com/how-to-use-your-ecommerce-return-policy-to-increase-sales" target="_blank"><strong>listed a few ways</strong></a> you can&nbsp;use it to kill your competition.</span></p>
        <p></p>
        <a href="#nogo" onclick="BOLD.notification.dismiss(145)" class="btn btn-close">
            <svg class="boldicon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#boldicon-times"></use>
            </svg>
        </a>
    </div>
</div>
<section class="segment">
    <div class="content">
        <header class="segment-header">
            <h1>Customers</h1>
            <p class="intro">
                Here's a list of all your customers with recurring subscription orders.
                Click the <b>Edit</b> button to view and edit the details of the customer or their orders.
                Your customers can access their order management when logged in by going to:
                <!-- <a class="ellipses" href="https://scarflings-test.myshopify.com/tools/checkout/front_end/login" target="_blank">http://scarflings-test.myshopify.com/tools/checkout/front_end/login</a> -->
            </p>
        </header>
        <div class="segment-header-actions">
            <a href="https://ro.boldapps.net/s/scarflings-test/exports" class="btn">Export</a>
        </div>
    </div>
</section>
<section class="segment">
    <div class="messages-container"></div>
    <div class="content">
        <div class="card">
            <div class="grid text-center">
                <div class="column third">
                    <h1>Rs. 0.00</h1>
                    <h4>Orders scheduled for the next 7 days</h4>
                </div>
                <div class="column third">
                    <h1>Rs. 0.00</h1>
                    <h4>Orders scheduled for the next 30 days</h4>
                </div>
                <div class="column third">
                    <h1>Rs. 0.00</h1>
                    <h4>Orders scheduled for the next 365 days</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <form id="sort_form" action="customer_list" method="get">
                <div class="grid">
                    <div class="column half">
                        <label class="field-label">Show</label>
                        <div class="field-group small-input">
                            <select id="show" name="show" class="select-field" onchange="$(this).closest('form').submit()">
                                <option value="1">Active Subscribers</option>
                                <option value="0" selected="">Inactive Subscribers</option>
                            </select>
                        </div>
                    </div>
                    <div class="column half">
                        <label class="field-label">Search by customer or subscription ID</label>
                        <div class="field-group">
                            <input class="search input-field" type="text" id="search" name="search" value="" autocomplete="off" placeholder="E.g. #3578, johndoe@gmail.com, COFFEECLUB">
                            <a href="#" id="search_btn" class="btn" onclick="$(this).closest('form').submit(); return false;">Search</a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-section">
              <table class="table with-row-borders">
                  <thead>
                      <tr>
                          <th class="active-column">Sr No</th>
                          <th class="name-column">Customer Name</th>
                          <th class="name-column">Customer Email</th>
                          <th>Subscriptions</th>
                      </tr>
                  </thead>
                  <tbody>
                        @foreach ($customers as $key=>$customer)
                      <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$customer->name}}</td>
                          <td>{{$customer->email}}</td>
                          <td>
                            @foreach ($customer->subscriptions as $subscription)
                              <p  data-sub-id="{{$subscription->stripe_id}}" class="subscription" style="color:#1c2260;font-size: 16px;cursor: pointer;">{{$subscription->stripe_id}}</p>
                            @endforeach
                          </td>
                      </tr>
                        @endforeach
                  </tbody>
              </table>
            </div>
        </div>
    </div>
    <div id="mypopup" style="display: none;background: #0000006e none repeat scroll 0% 0%;position: fixed;width: 75%;top: 0;height: 100vh;">
       <div id="facebox" style="position: absolute;top: 50%;left: 50%;width:90%;z-index: 999999999;text-align: left;transform: translate(-50%, -50%);">
          <div class="popup">
             <div class="content" style="width: 100%;">

               <h2>Subscription Details</h2>
               <table class="table with-row-borders" id="table1">
                   <thead>
                       <tr>
                           <th class="active-column">Subscription ID</th>
                           <th>Subscription Type</th>
                           <th class="name-column">Plan ID</th>
                           <th class="name-column">Created At</th>
                           <th>Upcoming Order Date</th>
                       </tr>
                   </thead>
                   <tbody>
                     <tr>
                       <td>a</td>
                       <td>a</td>
                       <td>a</td>
                       <td>a</td>
                       <td>a</td>
                     </tr>
                   </tbody>
                 </table>
               <h2>Subscription Product Details</h2>
               <table class="table with-row-borders" id="table2">
                   <thead>
                       <tr>
                           <th class="active-column">Image</th>
                           <th class="name-column">Title</th>
                           <th class="name-column">Qty</th>
                           <th class="name-column">Original Price</th>
                           <th class="name-column">Discounted Price</th>
                       </tr>
                   </thead>
                   <tbody>
                     <tr>
                       <td>a</td>
                       <td>a</td>
                       <td>a</td>
                       <td>a</td>
                       <td>a</td>
                     </tr>
                   </tbody>
                 </table>

                <div class="pagination"></div>
             </div>
             <a href="#" class="close"><img src="https://upsells.boldapps.net/upsell_assets/facebox/closelabel.png" title="close" class="close_image"></a>
          </div>
       </div>
    </div>

    </section>

@endsection
@section('scripts')

<script>
$('.subscription').click(function() {
    $("#mypopup,#facebox").show();
    var Url =  AppURL+'/SubscriptionDetailsByID';
    var sub_id = $(this).data('sub-id');
    $.ajax({
      type : 'GET',
      url : Url,
      data : {sub_id:sub_id,shop:shop},
      dataType:"json",
      success: function(data){
        if(data.code == 100){
          var html='<tr><td colspan="5"> First Order Not Completed By Customer</td></tr>';
          $("#table1 tbody,#table2 tbody").html(html);
        }else{
            var mydata = data.data[0];
            var t1='<tr>\
            <td>'+mydata.stripe_subscription_id+'</td>\
            <td>'+mydata.no_orders+' Orders  Per '+mydata.per+'</td>\
            <td>'+mydata.stripe_plan_id+'</td>\
            <td>'+mydata.created_at+'</td>\
            <td>'+mydata.upcomingOrderDate+'</td>\
            </tr>';
            var t2='<tr>\
            <td><img src="'+mydata.productDetails.image_src+'" height="35px"></td>\
            <td>'+mydata.productDetails.title+'</td>\
            <td>'+mydata.variant_qty+'</td>\
            <td>'+mydata.variants_actual_price+'</td>\
            <td>'+mydata.variant_price+'</td>\
            </tr>';
              $("#table1 tbody").html(t1);
              $("#table2 tbody").html(t2);
        }
      }
    });
})
$('.close_image').click(function() {
    $("#mypopup").hide();
    $("#table1 tbody,#table2 tbody").html("")
})
</script>
@parent
@if(config('shopify-app.appbridge_enabled'))

@endif
@endsection
