@extends('layout.app')
@section('content')
<div class="notification-container">
    <style>.message > p {
        margin: 0;
        line-height: 1.75em
        }
    </style>
    <div class="message with-info alert-145" style="margin-top:15px;">
        <p></p>
        <p style="text-align:center"><span style="font-size:14px">A good returns policy isn't&nbsp;just a good thing to have, it can actually be a GREAT way to compete. We've <a href="https://blog.boldcommerce.com/how-to-use-your-ecommerce-return-policy-to-increase-sales" target="_blank"><strong>listed a few ways</strong></a> you can&nbsp;use it to kill your competition.</span></p>
        <p></p>
        <a href="#nogo" onclick="BOLD.notification.dismiss(145)" class="btn btn-close">
            <svg class="boldicon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#boldicon-times"></use>
            </svg>
        </a>
    </div>
</div>
<div class="messages-container app-messages"></div>
<section class="segment">
    <div class="content">
        <header class="segment-header">
            <h1>Create Discount Codes</h1>
            <p class="intro">
                This is where you create discount codes to work with recurring orders.
            </p>
        </header>
    </div>
</section>
<section class="segment with-annotation">
    <div class="content">
        <aside class="annotation">
            <h2>Create a new discount code!</h2>
            <p>
                Generally you want to mimic active discount codes you have in your Shopify admin,
                but if you want, you can also create codes to just work with recurring orders.
            </p>
            <div class="discount-notes-container">
                <p class="notes-title">Discount codes will work differently with prepaid subscriptions:</p>
                <div class="notes-container">
                    <p>
                        <span class="notes-header">Free Shipping codes</span><br>
                        Will give the customer free shipping on every order during the prepaid period.
                    </p>
                    <p>
                        <span class="notes-header">% off codes</span><br>
                        Will take a % off the total of all prepaid orders combined.
                    </p>
                    <p>
                        <span class="notes-header">$ off codes</span><br>
                        Will take a set amount off of the initial order.
                    </p>
                </div>
            </div>
        </aside>
        <div class="card">
            <form action="save_discount" method="post" id="save_discount_form">
                <input type="hidden" name="csrf_bold_token" value="9d70d260d623beaef9f5af3650c563a9">
                <div class="card-section">
                    <h2>Create a New Discount Code</h2>
                    <p>
                        Create your discount code, and specify the usage limit. You can also choose whether or not this discount code will only apply to the first purchase, or all future recurring orders.
                    </p>
                    <div class="grid">
                        <div class="column half field">
                            <label class="field-label">Discount code</label>
                            <input type="text" name="discount_code" placeholder="e.g: AWESOMESALE2019" class="input-field discount_code">
                        </div>
                    </div>
                    <div class="grid">
                        <div class="column half field">
                            <label class="field-label">Discount Type</label>
                            <select name="type" id="type" class="type select-field">
                                <option value="1" id="standard_discount">Standard Discount</option>
                                <option value="2" id="cancellation_discount">Cancellation Discount</option>
                                <option value="3" id="bulk_discount">Bulk Discount Group</option>
                            </select>
                        </div>
                        <div class="column half field">
                            <label class="field-label">Discount Offer</label>
                            <select name="discount_type" class="discount_type select-field">
                                <option value="1">$ INR</option>
                                <option value="2">% Discount</option>
                                <option value="3">Free Shipping</option>
                            </select>
                        </div>
                    </div>
                    <div class="discount_div card sub-card">
                        <div class="grid">
                            <div class="column half">
                                <label class="field-label">Take</label>
                                <div class="field-group inline-group">
                                    <span class="field-group-addon discount_number">Rs.</span>
                                    <input id="discount_amount" placeholder="0.00" type="text" name="discount_amount" class="discount_amount input-field">
                                    <span class="field-group-addon discount_percentage" style="display:none;">%</span>
                                </div>
                            </div>
                            <div class="column half field">
                                <label class="field-label">off for</label>
                                <select name="discount_condition" class="select-field discount_condition">
                                    <option value="0">entire order</option>
                                    <option value="2" class="regular_condition">these products</option>
                                    <option value="3" class="regular_condition">not these products</option>
                                </select>
                            </div>
                        </div>
                        <div class="discount_condition_product_div grid" style="display:none;">
                            <div class="column half">
                                <label class="field-label">Select Products</label>
                                <div>
                                    <input id="select_product" class="select_product" name="filter" type="hidden" value="{&quot;select&quot;:&quot;&quot;,&quot;products&quot;:{&quot;collection_id&quot;:&quot;&quot;,&quot;search_title&quot;:&quot;&quot;,&quot;vendor&quot;:&quot;&quot;,&quot;product_type&quot;:&quot;&quot;}}" width="180px"><input id="select_product_visible" type="text" placeholder="Select Products" readonly="readonly" style="width: 180px; vertical-align:middle;display:none;"> <a href="#" rel="tooltip" title="Preview currently selected products" class="btn preview-btn" style="margin:0 10px 0 -3px;"><i class="fa fa-search"></i> </a><a href="#" onclick="$(&quot;#select_product&quot;)[0].product_selector.show(); return false;" style="" class="btn btn-shopify select_button"><span class="product_selector_title">Select Products</span></a>
                                </div>
                                <p class="field-description">For 'these products' and 'not these products' conditions, you can select a maximum of 100 products.</p>
                            </div>
                        </div>
                    </div>
                    <div class="free_shipping_div card sub-card" style="display:none;">
                        <div class="grid">
                            <div class="column half">
                                <label class="field-label">Free Shipping Amount</label>
                                <div class="field-group inline-group">
                                    <span class="field-group-addon">Rs.</span>
                                    <input placeholder="0.00" type="text" name="free_shipping_amount" class="free_shipping_amount input-field">
                                </div>
                                <p class="field-description">
                                    Applies to any shipping rate equal to or lower than the entered amount.
                                </p>
                            </div>
                            <div class="column half field">
                                <label class="field-label">And applies to</label>
                                <select name="free_shipping_country_id" class="select-field" onchange="document.getElementById('country_name').value=this.options[this.selectedIndex].text">
                                    <option value="1">All countries</option>
                                    <option value="158762598496">India</option>
                                    <option value="158762631264">Rest of World</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="country_name" id="country_name" value="All countries">
                    </div>
                    <div class="card sub-card minimum_purchase_card">
                        <div class="grid">
                            <div class="column half ">
                                <input type="checkbox" class="orders_over_enabled" name="orders_over_enabled"> This discount requires a minimum purchase.
                            </div>
                            <div class="column half minimum_amount" style="display:none">
                                <div class="minimum_amount">
                                    <div class="column half field-group inline-group">
                                        <span class="field-group-addon">Rs.</span>
                                        <input placeholder="0.00" type="text" name="orders_over_amount" class="orders_over_amount input_right minimum_amount_input input-field">
                                    </div>
                                    <p class="field-description">This discount will only be applied to orders equal or above entered amount.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-section bulk_discount_section" style="display:none;">
                    <h2>Bulk Creation Options</h2>
                    <p>How do you want to generate bulk coupons?</p>
                    <div class="card sub-card">
                        <div class="grid">
                            <div class="column half field">
                                <label class="field-label">Coupon Format</label>
                                <select name="bulk_format" id="bulk_format" class="bulk_format select-field">
                                    <option value="1">Series (001,002,003,etc)</option>
                                    <option value="2">Random</option>
                                </select>
                            </div>
                            <div class="column half field">
                                <label class="field-label">Amount of Codes to Generate (Max 5000)</label>
                                <input type="number" size="16" max="5000" id="bulk_amount" class="input-field" placeholder="e.g: 1000" name="bulk_amount" value="">
                            </div>
                        </div>
                        <div class="card sub-card bulk_example">
                            <div class="input-group inline-group">
                                <p style="font-weight:bold">Example:</p>
                                <div class="bulk_series_example">
                                    <table class="tbl_bulk">
                                        <tbody>
                                            <tr>
                                                <td><span class="faded">AWESOMESALE2016</span><span style="font-weight:bold;">001</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bulk_random_example" style="display:none;">
                                    <table class="tbl_bulk">
                                        <tbody>
                                            <tr>
                                                <td><span class="faded">AWESOMESALE2016</span><span style="font-weight:bold;">X3R5W</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-section">
                    <h2>Effective Date</h2>
                    <p>When does this discount begin and end?</p>
                    <div class="card sub-card">
                        <div class="grid">
                            <div class="column half">
                                <label class="field-label">Start Date </label>
                                <div class="field-group">
                                    <span class="field-group-addon start-date-icon" onclick="$('#startdate').datepicker('show')"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    <input type="text" size="16" id="startdate" style="display:none;" class="input-field hasDatepicker" placeholder="Start" name="startdate" value="" readonly="" disabled="">
                                    <span class="field-group-addon">
                                        <div class="toggle-field">
                                            <label>
                                                <input type="checkbox" class="start_now" checked="" name="start_now">
                                                <div class="toggle-field-checkbox"></div>
                                                Start Now
                                            </label>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="column half">
                                <label class="field-label">End Date </label>
                                <div class="field-group">
                                    <span class="field-group-addon end-date-icon" onclick="$('#enddate').datepicker('show')"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    <input type="text" size="16" id="enddate" style="width:165px; display:none;" class="input-field hasDatepicker" placeholder="End" name="enddate" value="" readonly="" disabled="">
                                    <span class="field-group-addon">
                                        <div class="toggle-field">
                                            <label>
                                                <input type="checkbox" class="never_expires" checked="" name="never_expires">
                                                <div class="toggle-field-checkbox"></div>
                                                Never Expires
                                            </label>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-section">
                    <h2>Limits and Restrictions</h2>
                    <p>How do you want to limit the use of this discount code?</p>
                    <div class="card sub-card">
                        <div class="card-section">
                            <div class="input-group" style="width:100%; min-height: 35px">
                                <input type="checkbox" class="no_limit discount_limits" name="no_limit"> Limit the number of times this discount code can be used in total.
                                <input type="text" name="useable_time" class="useable_time form-control input_right input-field" disabled="" placeholder="e.g: 500">
                            </div>
                        </div>
                        <div class="card-section">
                            <div class="input-group" style="width: 100%; min-height: 35px">
                                <input type="checkbox" name="once_per_customer_checked" class="once_per_customer_checked discount_limits"> Limit the number of orders this discount code will be applied to for each customer.
                                <input type="text" name="once_per_customer" class="once_per_customer input_right input-field" disabled="" placeholder="e.g: 10">
                            </div>
                        </div>
                        <div class="card-section">
                            <div class="input-group only_first_discount_group" style="min-height: 35px">
                                <input type="checkbox" name="only_first_discount" id="only_first_discount" class="only_first_discount discount_limits"> Only valid on initial subscription order in the checkout, not existing subscriptions.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-section actions">
                    <a href="../discount_settings" class="btn cancel_btn">Cancel</a>
                    <a href="#" class="btn btn-primary add_discount_btn">Save</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@parent
@if(config('shopify-app.appbridge_enabled'))
<script type="text/javascript">
    var AppBridge = window['app-bridge'];
    var actions = AppBridge.actions;
    var TitleBar = actions.TitleBar;
    var Button = actions.Button;
    var Redirect = actions.Redirect;
    var titleBarOptions = {
        title: 'Welcome',
    };
    var myTitleBar = TitleBar.create(app, titleBarOptions);
</script>
@endif
@endsection
