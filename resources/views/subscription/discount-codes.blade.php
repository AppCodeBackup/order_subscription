@extends('layout.app')
@section('content')
<div class="notification-container">
    <style>.message > p {
        margin: 0;
        line-height: 1.75em
        }
    </style>
    <div class="message with-info alert-174" style="margin-top:15px;">
        <p>
        </p>
        <p></p>
        <p style="text-align: center;"><span style="font-size:14px"><strong><a href="https://shopify.boldapps.net?utm_campaign=aotm_mar_18&amp;utm_medium=content&amp;utm_source=app_notifications&amp;utm_content=bold_brain&amp;redirect_uri=https://apps.shopify.com/the-bold-brain%3Fref%3Dshappify%26utm_campaign%3Daotm_mar_18%26utm_medium%3Dcontent%26utm_source%3Dapp_notifications%26utm_content%3Dbold_brain" target="_blank">Automatically cross-sell products that are often purchased together!</a></strong> Drive sales </span></p>
        <p></p>
        <a href="#nogo" onclick="BOLD.notification.dismiss(174)" class="btn btn-close">
            <svg class="boldicon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#boldicon-times"></use>
            </svg>
        </a>
    </div>
</div>
<div class="messages-container app-messages">
</div>
<section class="segment">
    <div class="content">
        <header class="segment-header">
            <h1>Discount Codes</h1>
            <p class="intro">
                Discount codes created in your Shopify admin don't automatically carry
                over to this app. If you'd like a discount code to also work on your
                subscription orders you need to create it here with the exact same code
                and discount amount as the one in your Shopify admin.
            </p>
        </header>
        <div class="segment-header-actions">
            <a href="{{url('/CreateDiscountCode')}}" class="btn btn-primary">Add a discount code</a>
        </div>
    </div>
</section>
<section class="segment">
    <div class="messages-container"></div>
    <div class="content">
        <div class="card">
            <ul class="nav tabs card-tabs" role="tablist" style="margin-bottom:0;">
                <li role="presentation" class="nav-item "><a href="javascript:void(0)" class="nav-link" role="tab" data-toggle="tab" onclick="window.self.location=&quot;discount_settings&quot;">All discount codes</a></li>
                <li role="presentation" class="nav-item "><a href="javascript:void(0)" class="nav-link" role="tab" data-toggle="tab" onclick="window.self.location=&quot;discount_settings?status=0&amp;deleted=0&quot;">Active</a></li>
                <li role="presentation" class="nav-item nav-item-active "><a href="javascript:void(0)" class="nav-link" role="tab" data-toggle="tab" onclick="window.self.location=&quot;discount_settings?status=1&amp;deleted=0&quot;">Inactive</a></li>
                <li role="presentation" class="nav-item  "><a href="javascript:void(0)" class="nav-link" role="tab" data-toggle="tab" onclick="window.self.location=&quot;discount_settings?deleted=1&quot;">Deleted</a></li>
            </ul>
            <div class="grid">
                <div class="column half field">
                    <label class="field-label">Discount Type</label>
                    <select class="type select-field">
                        <option value="">All</option>
                        <option value="1">Standard</option>
                        <option value="2">Cancellation</option>
                        <option value="3">Bulk Group</option>
                    </select>
                </div>
                <div class="column half">
                    <label class="field-label">Search by discount code</label>
                    <div class="field-group">
                        <input class="input-field search ui-autocomplete-input" type="text" id="search" placeholder="" name="search" value="" autocomplete="off">
                        <a href="#" id="search_btn" class="btn search_btn" style="vertical-align: initial;" onclick="return false;">Search</a>
                    </div>
                </div>
            </div>
            <div class="card-section">
                <table class="table with-row-borders">
                    <thead>
                        <tr>
                            <th>Discount Code</th>
                            <th>Type</th>
                            <th>Limits</th>
                            <th>Uses</th>
                            <th>Start/End</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center" style="padding:17px;">You don't have any discounts in this group.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
