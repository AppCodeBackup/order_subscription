
if(typeof jQuery=='undefined') {
    var headTag = document.getElementsByTagName("head")[0];
    var jqTag = document.createElement('script');
    jqTag.type = 'text/javascript';
    jqTag.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js';
    jqTag.onload = myJQueryCode;
    headTag.appendChild(jqTag);
}
$(document).ready(function(){
    if(location.pathname.includes("products")){
      $("[action='/cart/add']").after("<p>Test</p>")
    }else if(location.pathname.includes("cart")){
      console.log("We are on Cart Page")
      console.log(cart_data);
    }
})
