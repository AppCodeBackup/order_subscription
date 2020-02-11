window.BOLD = window.BOLD || {};
window.BOLD.csp = window.BOLD.csp || {};
window.BOLD.csp.is_installed = true;

var cp_app_url = "cp.boldapps.net";

if(window.location.host != "checkout.shopify.com"){
if (typeof jQuery == 'undefined') {
shappify_addJs("//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js");
setTimeout(shappify_csp_main, 700);
} else{
shappify_csp_main();
}
}

function shappify_csp_main(success_callback){
if (typeof shappify_customer_tags == 'undefined'){

}else{
  shapp_disable_checkout();
  setTimeout(shapp_enable_checkout, 3000);

  var tmp = new Date().getTime();
//        setTimeout(shappify_csp_got_cart, 300);

  jQuery.getJSON("/cart.js?tmp=yo"+tmp, function(data) { shappify_csp_got_cart(data, success_callback); });

  jQuery('.single-option-selector option').change()

  jQuery("#shappify-variant-id").change(shappify_update_message);
  jQuery(".single-option-selector").change(shappify_update_message);
  jQuery("select[name='id']").change(shappify_update_message);

  shappify_update_message();
  jQuery("[name^='updates']").change(shapp_disable_checkout);
  if(typeof BOLD !== 'undefined' &&
      typeof BOLD.common !== 'undefined' &&
      typeof BOLD.common.eventEmitter !== 'undefined'
  ) {
      BOLD.common.eventEmitter.emit('BOLD_CSP_APPCOMPAT_customer_pricing_loaded');
  }
}
}

function shapp_disable_checkout(){
  jQuery("[name=\'checkout\']").attr("disabled", "disabled");
  jQuery("[name=\'goto_pp\']").attr("disabled", "disabled");
  jQuery("[name=\'goto_gc\']").attr("disabled", "disabled");
  jQuery("[href$=\'checkout\']").attr("disabled", "disabled");
}

function shapp_enable_checkout(){
  jQuery("[name=\'checkout\']").removeAttr("disabled");
  jQuery("[name=\'goto_pp\']").removeAttr("disabled");
  jQuery("[name=\'goto_gc\']").removeAttr("disabled");
  jQuery("[href$=\'checkout\']").removeAttr("disabled");
}

function shappify_update_message(){

  jQuery("#shappify-qty-msg").html(jQuery("#variant_html_" + jQuery("[name='id']").val()).html());
  if(jQuery("[name='id']:checked").length){
      jQuery("#shappify-qty-msg").html(jQuery("#variant_html_" + jQuery("[name='id']:checked").val()).html());
  }
  var prds = jQuery(".shapp_qb_prod");
  var i=0;
  for(i=0;i < prds.length;i++){
      var shapp_var_id            = jQuery(prds[i]).find("[name='id']").val();
      var shapp_message           = jQuery("#variant_html_" + shapp_var_id).html();
      var shapp_message_container = jQuery(prds[i]).find(".shappify-qty-msg");

      shapp_message_container.html(shapp_message);

  }

}


function shappify_csp_got_cart(data, success_callback){
if(jQuery("#shappify-cart-object").text()==""){
      var postdata = {cart: JSON.stringify(data)};
}else{
  var postdata = {cart: jQuery("#shappify-cart-object").text()};
}

var tmp = new Date().getTime();
jQuery.ajax({
  url:'https://amkwebsolutions.com/shopify-app/quantity-break/GetCartPrices?shop='+Shopify.shop+'&tmp=yo'+tmp+'&tags='+JSON.stringify(shappify_customer_tags),
  type:"POST",
  data:postdata,
  dataType:"json",
  success: function(data) {
      shappify_csp_got_suggestions(data, success_callback);
  }
});
}

function shappify_csp_got_suggestions(data, success_callback) {
if (data.count > 0) {
  var i;
  var dels =data['delete'];
  var adds =data['add'];
  for (i=0;i < dels.length;i++) {
      jQuery.ajax({url: "/cart/change.js", type: "POST", data:dels[i], async: false, dataType: "json", success: null });
  }
  for (i=0;i < adds.length;i++) {
      jQuery.ajax({url: "/cart/add.js", type: "POST", data:adds[i], async: false, dataType: "json", success: null });
  }

  refresh_shop_cart(success_callback);
} else {
  shapp_enable_checkout();
  jQuery("#shappify-qty-cart-msg").html(data.savings);
  jQuery("#currencies").change();

  if(typeof success_callback === 'function') {
      jQuery.getJSON("/cart.js", success_callback);
  }
}
}

function refresh_shop_cart(success_callback) {
if (typeof success_callback === 'function') {
  jQuery.getJSON("/cart.js",success_callback);
} else {
  window.location = document.URL;
}
}

function shappify_addJs(src){
var fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript")
fileref.setAttribute("src", src)

document.getElementsByTagName("head")[0].appendChild(fileref)
}
