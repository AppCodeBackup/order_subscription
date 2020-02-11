<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monthly Subscription App using Stripe, Cashier and Laravel 5.4 with example</title>
    <!-- Styles -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
    .StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
    </style>
</head>
<body>
<div class="row" style="margin-top: 10px;">

<form id="paymentForm" class="form-horizontal">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input id="card-holder-name" type="text">

<!-- Stripe Elements Placeholder -->
<div id="card-element"></div>

<button type="button" id="card-button" data-secret="{{ $intent->client_secret }}">
    Update Payment Method
</button>
</form>
</div>
<script src="https://js.stripe.com/v3/"></script>

<script>
$(document).ready(function() {
    // Change the key to your one
   // Stripe.setPublishableKey('pk_test_88d8Kb9ILtA8pvhiD60bD9tR007WmGu1Me');
    const stripe = Stripe('pk_test_88d8Kb9ILtA8pvhiD60bD9tR007WmGu1Me');





const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
    const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');

cardButton.addEventListener('click', async (e) => {
    e.preventDefault();
    const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card', cardElement, {
            billing_details: { name: cardHolderName.value }
        }
    );

    if (error) {
       alert(error);
    } else {
        alert(JSON.stringify(paymentMethod));
    }
});
    // $('#paymentForm')
        
    //     .on('submit', function(e) {
    //         e.preventDefault();
    //         var $form = $(e.target);
    //         // Reset the token first
    //         $form.find('[name="token"]').val('');
    //         Stripe.card.createToken($form, function(status, response) {
    //             if (response.error) {
    //                 alert(response.error.message);
    //             } else {                  
    //                 // Set the token value
    //                 $form.find('[name="token"]').val(response.id);                 
    //                 // Or using Ajax
    //                 $.ajax({
    //                     // You need to change the url option to your back-end endpoint
    //                     url: "{{route('post-subscription')}}",
    //                     data: $form.serialize(),
    //                     method: 'POST',
    //                     dataType: 'json'
    //                 }).success(function(data) {
    //                     alert(data.msg);                        
    //                     // Reset the form
    //                     $form.formValidation('resetForm', true);
    //                 });
    //             }
    //         });
    //     });
});
</script>
</body>
</html>