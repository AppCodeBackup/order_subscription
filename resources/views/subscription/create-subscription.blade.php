@extends('layout.app')
@section('content')
<form action="" method="post" id="save_product_recurring_form" >
    <input type="hidden" name="csrf_bold_token" value="292064d172675df56c11e884b1bc5a53">
    <section class="segment with-annotation">
        <div class="messages-container">
            <script></script>
        </div>
        <div class="extras">
        </div>
        <div class="content">
            <aside class="annotation">
                <h2>Step <span class="step_id">1</span>: Select Subscription Type</h2>
                <p>Give your subscription a descriptive internal name and then select the product(s) it should apply to.</p>
                <p>Standard: These products can be subscribed.</p>
                <p>Convertible: The purchase of one product can include a subscription of a different product.</p>
                <p>Build-a-Box: This will allow you to set how many products need to be selected and which products are available to choose from to build a box.</p>
            </aside>
            <div class="card">
                <div class="field">
                    <label class="field-label">Internal Subscription Name</label>
                    <input type="text" name="group_name" class="input-field" value="" placeholder="All Coffee Packages">
                </div>
                <div class="field subscription_type_container">
                    <label class="field-label">Subscription Type</label>
                    <select name="subscription_type" id="subscription_type" class="select-field subscription_type">
                        <option value="1" selected="">Standard</option>
                        <option value="2">Convertible</option>
                        <option value="3">Build-a-Box</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
    <section class="segment with-annotation products-step" >
        <div class="content">
            <aside class="annotation">
                <h2>Step <span class="step_id">2</span>: Select Product(s)</h2>
                <p>Select the product(s) your subscription will apply to. The initial purchase can be any number of products, however you can only choose one subscription product for this type.</p>
                <p class="standard" style="display: none;">If you allow the swapping of products, a customer will be able to swap the product they are subscribed to, mid subscription. They will only be able to choose from products in the same subscription group.</p>
            </aside>
            <div class="card">
                <div class="field">
                    <label for="select_product" class="field-label">Initial Purchase</label>
                    <div class="input-group">
                        <input id="select_product" class="select_product" name="filter" type="hidden" value="" width="180px">
                        <div class="field-group">
                            <input id="select_product_visible" type="text" class="input-field" placeholder="Select Products" readonly="readonly" style="width: 180px; vertical-align:middle;">
                            <a href="#" rel="tooltip" title="Preview currently selected products" class="btn-shopify preview-btn field-group-addon"><span class="fa fa-search"></span></a>
                            <a href="#"  style="" class="btn btn-shopify open_seletor">
                            <span class="product_selector_title">Select products</span>
                            </a>
                        </div>
                    </div>
                    <label for="select_product" class="field-label">Max 2500 products/variants per subscription group</label>
                    <br>
                    <span class="field-label" id="sync_estimation"></span>
                    <h2>Selected Products</h2>
                    <div style="overflow-y: scroll;max-height: 200px;">
                        <table id="selectedTable" class="table with-row-borders">
                        <thead>
                            <tr>
                              <th class="name-column" >Image</th>
                              <th class="name-column" >Title</th>
                              <th class="name-column" >Price</th>
                              <th class="name-column" >Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="standard" style="display: none;">
                    <label class="toggle-field">
                        <input type="checkbox" name="allow_swap" class="allow_swap">
                        <div class="toggle-field-checkbox"></div>
                        Allow Swapping of Products
                    </label>
                </div>
                <div class="field convertible" style="display: none">
                    <label for="select_recurring_product" class="field-label">Recurring Product</label>
                    <div class="input-group">
                        <div id="hiddenInputProduct">
                        </div>
                        <div class="field-group">
                            <input id="select_recurring_product_visible" type="text" class="input-field" placeholder="Select Products" readonly="readonly" style="width: 180px; vertical-align:middle;">
                            <a href="#" rel="tooltip" title="Preview currently selected products" onclick="" class="btn-shopify preview-btn field-group-addon">
                            <span class="fa fa-search"></span>
                            </a>
                            <a href="#" style="" class="btn btn-shopify open_seletor">
                            <span class="product_selector_title">Select Product</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="segment with-annotation" >
        <div class="content">
            <aside class="annotation">
                <h2>Step <span class="step_id">2</span>: Select Intervals</h2>
                <p>Select the interval lengths you'd like to offer. You must select at least one.</p>
                <div class="billing_plan_content" id="billing_plan_content_description" style="margin-top: 120px; display: none;"></div>
            </aside>
            <div class="card">
                <div class="field">
                    <div>
                        <label class="toggle-field">
                            <input type="radio" name="interval_type" value="0" class="flexible_interval" checked="">
                            <div class="toggle-field-radio"></div>
                            Let customer select order interval
                        </label>
                    </div>
                    <div>
                        <label class="toggle-field">
                            <input type="radio" name="interval_type" value="1" class="fixed_interval">
                            <div class="toggle-field-radio"></div>
                            Set a fixed order interval
                        </label>
                    </div>
                </div>
                <div class="flexible_interval_content" style="display: none;">
                    <div class="field">
                        <label class="field-label">Select the recurring <b>intervals</b> you would like to offer</label>
                        <div class="btn-group multi-toggle">
                            <label class="btn ">
                                <input type="checkbox" name="interval[]" value="1">
                                <div class="wrapper">
                                    <i class="fa fa-check"></i>
                                    Day
                                </div>
                            </label>
                            <label class="btn ">
                                <input type="checkbox" name="interval[]" value="2">
                                <div class="wrapper">
                                    <i class="fa fa-check"></i>
                                    Week
                                </div>
                            </label>
                            <label class="btn ">
                                <input type="checkbox" name="interval[]" value="3">
                                <div class="wrapper">
                                    <i class="fa fa-check"></i>
                                    Month
                                </div>
                            </label>
                            <label class="btn ">
                                <input type="checkbox" name="interval[]" value="5">
                                <div class="wrapper">
                                    <i class="fa fa-check"></i>
                                    Year
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="field">
                        <label class="field-label">Set the maximum amount a customer can select for the intervals. This will show as a dropdown before the time length. (i.e. Ship every <b>"2"</b> Months)</label>
                        <input class="input-field" type="number" min="1" placeholder="10" name="max_number" style="width:80px;" value="9">
                    </div>
                </div>
                <div class="fixed_interval_content" style="display: block;">
                    <div class="field">
                        <label class="field-label">Orders will be processed every</label>
                        <div class="grid">
                            <div class="column half">
                                <div class="field-group">
                                    <input type="number" min="1" class="frequency_num input-field" name="frequency_num" value="1" style="flex:2;">
                                    <select class="frequency_type select-field" name="frequency_type">
                                        <option value="1">Day(s)</option>
                                        <option value="2">Week(s)</option>
                                        <option selected="selected" value="3">Month(s)</option>
                                        <!-- <option value="5">Year(s)</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="field-label">*If you use a monthly or weekly order interval, you can select a specific day to charge customers or you can charge them on the anniversary of their purchase date.</label>
                </div>
                <div class="billing_plan_content" style="display: none;">
                    <div class="field">
                        <label class="field-label">When would you like to charge customers?</label>
                        <div class="field">
                            <label class="toggle-field">
                                <input type="radio" class="billing_plan" name="billing_plan" value="0" checked="">
                                <div class="toggle-field-radio"></div>
                                <span id="billing_plan_content_purchase_date"></span>
                            </label>
                        </div>
                        <div class="field">
                            <label class="toggle-field">
                                <input type="radio" class="billing_plan" name="billing_plan" value="1">
                                <div class="toggle-field-radio"></div>
                                <span id="billing_plan_content_same_day"></span>
                            </label>
                        </div>
                    </div>
                    <div class="shipping_day" style="display: none;">
                        <div id="billing_plan_content_month" style="display: none;">
                            <div class="field-group">
                                <div class="field-group-addon">Date</div>
                                <select class="shipping_day select-field" name="billing_day" style="display: none;">
                                    <option value="1" selected="">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                                <div class="field-group-addon">Buffer Days</div>
                                <select class="select-field" name="billing_offset">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15" selected="">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                    <option value="46">46</option>
                                    <option value="47">47</option>
                                    <option value="48">48</option>
                                    <option value="49">49</option>
                                    <option value="50">50</option>
                                    <option value="51">51</option>
                                    <option value="52">52</option>
                                    <option value="53">53</option>
                                    <option value="54">54</option>
                                    <option value="55">55</option>
                                    <option value="56">56</option>
                                    <option value="57">57</option>
                                    <option value="58">58</option>
                                    <option value="59">59</option>
                                    <option value="60">60</option>
                                </select>
                            </div>
                        </div>
                        <div id="billing_plan_content_week" style="display: none;">
                            <div class="field overflow">
                                <label class="field-label">Select one or more days that customers will be charged.</label>
                                <div class="btn-group multi-toggle">
                                    <label class="btn">
                                        <input type="checkbox" name="billing_day_week[]" value="0">
                                        <div class="wrapper">
                                            <i class="fa fa-check"></i>
                                            Sun<span class="weekday-name">day</span>
                                        </div>
                                    </label>
                                    <label class="btn">
                                        <input type="checkbox" name="billing_day_week[]" value="1">
                                        <div class="wrapper">
                                            <i class="fa fa-check"></i>
                                            Mon<span class="weekday-name">day</span>
                                        </div>
                                    </label>
                                    <label class="btn">
                                        <input type="checkbox" name="billing_day_week[]" value="2">
                                        <div class="wrapper">
                                            <i class="fa fa-check"></i>
                                            Tue<span class="weekday-name">sday</span>
                                        </div>
                                    </label>
                                    <label class="btn">
                                        <input type="checkbox" name="billing_day_week[]" value="3">
                                        <div class="wrapper">
                                            <i class="fa fa-check"></i>
                                            Wed<span class="weekday-name">nesday</span>
                                        </div>
                                    </label>
                                    <label class="btn">
                                        <input type="checkbox" name="billing_day_week[]" value="4">
                                        <div class="wrapper">
                                            <i class="fa fa-check"></i>
                                            Thu<span class="weekday-name">rsday</span>
                                        </div>
                                    </label>
                                    <label class="btn">
                                        <input type="checkbox" name="billing_day_week[]" value="5">
                                        <div class="wrapper">
                                            <i class="fa fa-check"></i>
                                            Fri<span class="weekday-name">day</span>
                                        </div>
                                    </label>
                                    <label class="btn">
                                        <input type="checkbox" name="billing_day_week[]" value="6">
                                        <div class="wrapper">
                                            <i class="fa fa-check"></i>
                                            Sat<span class="weekday-name">urday</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="field-group">
                                <label class="field-group-addon">Buffer Days</label>
                                <input class="input-field" type="number" name="billing_offset_week" min="0" value="7">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <aside class="annotation">
                <p>Set whether you want the products to be purchasable exclusively as a subscription, or as a subscription and a one-time purchase.</p>
            </aside>
            <div class="card">
                <div class="field">
                    <label class="field-label">Recurring Options</label>
                    <div>
                        <label class="toggle-field">
                            <input class="subscription_only" type="radio" name="subscription_only" value="1">
                            <div class="toggle-field-radio"></div>
                            Subscription only
                        </label>
                    </div>
                    <div>
                        <label class="toggle-field">
                            <input class="subscription_one_time" type="radio" name="subscription_only" value="0" checked="" disabled="disabled">
                            <div class="toggle-field-radio"></div>
                            Subscription and one time purchase
                        </label>
                    </div>
                    <div class="default-selection" style="display: none;">
                        <label class="field-label">Default Selection</label>
                        <div>
                            <label class="toggle-field">
                                <input type="radio" name="is_subscription_default_on_widget" value="0" checked="">
                                <div class="toggle-field-radio"></div>
                                One time
                            </label>
                        </div>
                        <div>
                            <label class="toggle-field">
                                <input type="radio" name="is_subscription_default_on_widget" value="1">
                                <div class="toggle-field-radio"></div>
                                Subscription
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <aside class="annotation">
                <p>How long would you like subscriptions to last?</p>
            </aside>
            <div class="card">
                <div class="field">
                    <label class="field-label">Maximum Subscription Length</label>
                    <div>
                        <label class="toggle-field">
                            <input type="radio" value="0" name="is_limited_subscription" checked="">
                            <div class="toggle-field-radio"></div>
                            No Limit
                        </label>
                    </div>
                    <div>
                        <label class="toggle-field">
                            <input type="radio" value="1" name="is_limited_subscription" class="is_limited_subscription">
                            <div class="toggle-field-radio"></div>
                            Set max number of recurring orders to
                        </label>
                    </div>
                </div>
                <div class="limited_interval_div" style="display: none;">
                    <div class="whole_limited_length_div">
                        <div class="limited_length_div" style="padding-bottom: 10px">
                            <input class="input-field" name="limited_length[]" type="text" style="width: 80px;" value="">
                            <a href="#nogo" class="btn btn-shopify small remove_limited_length"><span class="fa fa-minus"></span></a>
                        </div>
                    </div>
                    <a href="#nogo" class="btn btn-shopify small add_limited_length" style="">Add another length option</a>
                    <input type="hidden" id="limited_continue" name="limited_continue" value="1">
                </div>
                <div class="field">
                    <div>
                        <label class="radio allow_ongoing_label toggle-field" style="display: none;">
                            <input class="allow_ongoing_option toggle-field-checkbox" type="checkbox" name="allow_ongoing" value="1">
                            <div class="toggle-field-checkbox"></div>
                            Add ongoing option.
                        </label>
                    </div>
                    <div>
                        <label class="radio allow_one_payment_label toggle-field" style="opacity: 0.6; display: none;" title="Prepaid and multiple discounts on the same subscription are not supported.">
                            <input class="allow_one_payment toggle-field-checkbox" type="checkbox" name="allow_one_payment" value="1" disabled="disabled">
                            <div class="toggle-field-checkbox"></div>
                            Allow customers to prepay for subscriptions
                        </label>
                    </div>
                </div>
                <div class="prepaid_interval_div" style="display: none;">
                    <label class="field-label">Specify below the number of orders customers can prepay for and the discount they will receive</label>
                    <div class="whole_prepaid_length_div">
                        <div class="field-group">
                            <input type="text" name="prepaid_limited_length[]" class="input-field" value="">
                            <div class="field-group-addon">orders for a discount of</div>
                            &nbsp;
                            <input type="text" placeholder="10.00" name="prepaid_discount[]" class="form-control input-field" value="">
                            <div class="field-group-addon">% Off</div>
                            <a href="#nogo" class="btn btn-shopify small remove_prepaid_length">
                            <span class="fa fa-minus"></span>
                            </a>
                        </div>
                    </div>
                    <div class="field">
                        <a href="#nogo" class="btn btn-shopify small add_prepaid_length">Add another prepaid option</a>
                    </div>
                    <div class="field">
                        <label class="field-label">After subscription ends</label>
                        <div>
                            <label class="toggle-field">
                                <input type="radio" name="prepaid_continue" value="1" class="toggle-field-radio" checked="">
                                <div class="toggle-field-radio"></div>
                                Continue charging&nbsp;
                            </label>
                        </div>
                        <div>
                            <label class="toggle-field">
                                <input type="radio" name="prepaid_continue" value="0" class="toggle-field-radio">
                                <div class="toggle-field-radio"></div>
                                Expire
                            </label>
                        </div>
                    </div>
                    <div class="field">
                        <label class="radio is_prepaid_only_label toggle-field">
                            <input class="is_prepaid_only toggle-field-checkbox" type="checkbox" name="is_prepaid_only" value="1">
                            <div class="toggle-field-checkbox"></div>
                            Make these products prepaid only
                        </label>
                    </div>
                    <div class="field">
                        <label class="radio is_prepaid_always_expires_label toggle-field">
                            <input class="is_prepaid_always_expires toggle-field-checkbox" type="checkbox" name="is_prepaid_always_expires" value="1">
                            <div class="toggle-field-checkbox"></div>
                            Make prepaid subscriptions always expire
                        </label>
                    </div>
                    <div class="field">
                        <label class="radio allow_is_gift_label toggle-field">
                            <input class="allow_is_gift toggle-field-checkbox" type="checkbox" name="allow_is_gift" value="1">
                            <div class="toggle-field-checkbox"></div>
                            Allow gift subscriptions? (Will automatically not continue after subscription is over)
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <aside class="annotation">
                <p>Set minimum amount of orders a customer must fulfill before they can cancel?</p>
            </aside>
            <div class="card">
                <label class="field-label">Minimal Fulfilled Order Requirement</label>
                <div>
                    <label class="list-item no-padding align-center">
                        <div class="list-item-part" style="min-width:30px;">
                            <div class="toggle-field">
                                <input type="radio" name="min_convertible_cancel_length_enabled" class="min_convertible_cancel_length_disabled" value="0" checked="">
                                <div class="toggle-field-radio"></div>
                            </div>
                        </div>
                        <div class="list-item-flex">
                            <span>Off</span>
                        </div>
                    </label>
                </div>
                <label class="list-item no-padding align-center">
                    <div class="list-item-part" style="min-width:30px;">
                        <div class="toggle-field">
                            <input type="radio" name="min_convertible_cancel_length_enabled" class="min_convertible_cancel_length_enabled" value="1">
                            <div class="toggle-field-radio"></div>
                        </div>
                    </div>
                    <div class="list-item-flex">
                        <span style="margin-right: 3px;">Customers can cancel after at least</span>
                        <input class="input-field min_convertible_cancel_length_value" type="number" min="0" pattern="\d" placeholder="0" name="min_recurrences_before_cancellable" value="0">
                        <span style="margin-left: 3px;">orders.</span>
                    </div>
                </label>
                <div class="min-terms-and-conditions" style="display: block;">
                    <i class="field-label italic-font">We recommend reviewing your <a href="https://ro.boldapps.net/s/scarflings-test/general_settings" target="_blank">terms and conditions</a> to accommodate this setting.</i>
                </div>
            </div>
        </div>
    </section>
    <section class="segment with-annotation discount-step" >
        <div class="content">
            <aside class="annotation">
                <h2>Step <span class="step_id">4</span>: Offer a Discount</h2>
                <p>Give them a nudge! Offer a discount if they purchase a product as a recurring order.</p>
            </aside>
            <div class="card">
                <div class="field">
                    <label class="field-label">*These discounts will be applied on top of any other discounts (i.e. Coupon codes, sales, quantity breaks, wholesale pricing, etc...) </label>
                    <div>
                        <label class="toggle-field">
                            <input type="radio" name="discount_config" value="none" checked="">
                            <div class="toggle-field-radio"></div>
                            No Discount
                        </label>
                    </div>
                    <div>
                        <label class="toggle-field">
                            <input type="radio" name="discount_config" value="consistent">
                            <div class="toggle-field-radio"></div>
                            Offer the same discount on all orders
                        </label>
                    </div>
                    <div>
                        <label class="toggle-field secondary_discount_label" style="opacity: 1;">
                            <input type="radio" class="secondary_discount" name="discount_config" value="onechange">
                            <div class="toggle-field-radio"></div>
                            Offer different discounts on initial and recurring orders
                        </label>
                    </div>
                </div>
                <div class="discount_config discount_config_none" style="display: block;">
                    <input type="hidden" name="discount" value="0">
                </div>
                <div class="discount_config discount_config_consistent" style="display: none;">
                    <div class="field">
                        <label class="field-label">Recurring Discount</label>
                        <div class="field-group">
                            <input type="text" placeholder="10.00" name="discount" class="input-field" value="" >
                            <span class="field-group-addon">% Off</span>
                        </div>
                    </div>
                </div>
                <div class="discount_config discount_config_onechange" >
                    <label class="field-label">Initial Discount</label>
                    <div class="field-group">
                        <input type="text" placeholder="10.00" name="discount" class="input-field" value="" >
                        <span class="field-group-addon">% Off</span>
                    </div>
                    <label class="field-label">Recurring Discount</label>
                    <div class="field-group">
                        <div class="field-group-addon">Switch to</div>
                        <input type="text" placeholder="10.00" name="secondary_discount" class="input-field" value="" disabled="disabled">
                        <div class="field-group-addon">% Off</div>
                        <div class="field-group-addon secondary-discount" style="display: block">after</div>
                        <input type="number" min="1" placeholder="1" class="input-field secondary-discount" name="secondary_discount_requirement" value="" style="display: block" disabled="disabled">
                        <div class="field-group-addon secondary-discount" style="display: block">order(s)</div>
                    </div>
                    <div class="field apply_secondary_discount_on_product_swap" style="display:none;">
                        <label class="toggle-field">
                            <input type="checkbox" name="apply_secondary_discount_on_product_swap" disabled="disabled">
                            <div class="toggle-field-checkbox"></div>
                            Apply recurring discount when swapping products
                        </label>
                    </div>
                    <div id="include_free_gift_div" style="display: none">
                        <div class="field">
                            <label class="toggle-field">
                                <input type="checkbox" name="include_free_gift" class="include_free_gift toggle-field-checkbox" disabled="disabled">
                                <div class="toggle-field-checkbox"></div>
                                Include a free gift with first shipment
                            </label>
                        </div>
                        <div class="input-group" id="gift_product_selector_div" >
                            <input id="select_gift_product" class="select_product" name="gift_filter" value="{&quot;select&quot;:&quot;&quot;,&quot;products&quot;:{&quot;collection_id&quot;:&quot;&quot;,&quot;search_title&quot;:&quot;&quot;,&quot;vendor&quot;:&quot;&quot;,&quot;product_type&quot;:&quot;&quot;}}" disabled="disabled" type="hidden" width="180px">
                            <div class="field-group">
                                <input id="select_gift_product_visible" type="text" class="input-field" placeholder="Select Products" readonly="readonly" style="width: 180px; vertical-align:middle;">
                                <a href="#" rel="tooltip" title="Preview currently selected products"  class="btn-shopify preview-btn field-group-addon">
                                <span class="fa fa-search">
                                </span>
                                </a>
                                <a href="#"  style="" class="btn btn-shopify open_seletor">
                                <span class="product_selector_title">Select Products</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="segment with-annotation box-step" style="">
        <div class="content">
            <aside class="annotation">
                <h2>Step <span class="step_id">3</span>: Build-a-Box Settings</h2>
                <p>Lock Time :  How long before their next order date should customers be prevented from editing their selections? Note: This time is calculated backwards from 12:00am CST on the next order date.</p>
                <p>Lock After Choices: Do you want to stop your customers from editing their choices again after they've updated them once?</p>
            </aside>
            <div class="card">
                <div class="field">
                    <div class="field-label">Lock time</div>
                    <div class="field-group">
                        <div class="field-group-addon">Days</div>
                        <input type="number" min="0" name="box_lock_days" class="input-field" value="0" placeholder="0">
                        <div class="field-group-addon">Hours</div>
                        <input type="number" min="0" name="box_lock_hours" class="input-field" value="0" placeholder="0">
                    </div>
                </div>
                <div class="field">
                    <label class="field-label">Lock after making new choices</label>
                    <label class="toggle-field">
                        <input type="radio" name="box_lock_after_choices" value="0" class="toggle-field-radio" checked="">
                        <div class="toggle-field-radio"></div>
                        No
                    </label>
                    <label class="toggle-field">
                        <input type="radio" name="box_lock_after_choices" value="1" class="toggle-field-radio">
                        <div class="toggle-field-radio"></div>
                        Yes
                    </label>
                </div>
                <div class="field">
                    <div class="field-group">
                        <div class="field-group-addon">Lock edits to orders more than</div>
                        <input type="number" min="0" name="box_lock_beyond_days" class="input-field" value="0" placeholder="0">
                        <div class="field-group-addon">days away</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="page-actions" class="segment bottom-buttons">
        <div class="content">
            <button class="btn btn-primary add_product_recurring_btn right" type="submit" >Continue</button>
            <a href="../recurring_settings/manage_recurring_list" style="margin-right:10px;" class="btn cancel_btn right">Cancel</a>
        </div>
    </section>
    <div id="facebox" style="top: 733.3px; left: 94.5px;display:none">
         <div class="popup">
            <div class="content">
               <div id="select_product_ps" class="product_selector_wrapper">
                  <div class="title">Select Products</div>
                  <div class="description">Select the products you would like from the "Results" list, you may also use the filters below to narrow down your results.</div>
                  <div class="form-horizontal">
                     <div class="offer-details">
                        <div class="plans">
                           <div id="product_selector_last_sync">Filters last updated on Aug 28
                              <br><a href="#" onclick="visible_product_selector.update_products(); return false;">Update Now</a>
                           </div>
                           <div class="control-group">
                              <label for="offername" class="control-label">Enter Product Title:</label>
                              <div class="controls"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                                 <input type="text" id="product_selector_search_title" maxlength="230" placeholder="Enter product title" name="search_title" value="" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                              </div>
                           </div>
                        </div>
                        <div class="product-buttons">
                           <button type="button" name="search" id="product-selector-search-button" class="selectitem" >Search</button>
                           <button type="button" name="search" class="selectitem" onclick="visible_product_selector.reset()">Reset</button>
                           <input id="variant_count" type="hidden" value="">
                        </div>
                     </div>
                  </div>
                  <div id="product-list" class="product-upsell">
                     <form id="frmselectall" name="frmselectall" action="http://upsell-app.shappify.com/product_select.php" method="GET">
                        <div class="product-buttons">
                           <input name="select" type="button" value="Select All Search Results" class="selectallitem selectallproducts">
                           <input name="select" type="button" value="Use Entire Store" class="selectallitem" onclick="">
                        </div>
                     </form>
                     <div id="result_desc" class="select-description">Results</div>
                     <div id="search-list" class="select-product results-list">
                        <div id="product_selector_results" class="results"></div>
                        <div class="">
                           <div class="product-selector-paginationss"></div>
                        </div>
                        <div class="cleardiv"></div>
                     </div>
                  </div>
                  <div id="select-list" class="select-product">
                     <div id="result_desc" class="select-description">Selected Products</div>
                     <div class="cleardiv"></div>
                     <div id="selected_product_list"></div>
                  </div>
                  <form id="frmselectall" name="frmselect" action="http://upsell-app.shappify.com/product_select.php" method="GET">
                     <div class="product-buttons">
                        <input name="select" type="button" value="Continue with selected products"
                           class="use-selected-products" onclick="SetSelectedProducts()">
                        <input id="cancel" type="button" value="Cancel" class="cancel-selected-products">
                     </div>
                  </form>
               </div>
            </div>
            <a href="#" class="close">
            <img src="https://upsells.boldapps.net/upsell_assets/facebox/closelabel.png" title="close" class="close_image">
            </a>
         </div>
        </div>

</form>
@endsection
@section('scripts')
@parent
@if(config('shopify-app.appbridge_enabled'))
<script type="text/javascript">
    var AppBridge = window['app-bridge'];
    var actions = AppBridge.actions;
    var TitleBar = actions.TitleBar;
    var titleBarOptions = {
        title: 'Welcome',
    };
    var myTitleBar = TitleBar.create(app, titleBarOptions);
</script>
@endif
@endsection
