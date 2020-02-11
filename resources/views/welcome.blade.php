@extends('layout.app')
@section('content')
<div class="grid home-cards">
        <div class="column third">
            <a href="{{url('/SubscriptionGroups')}}?shop={{$shop}}" class="card home_card">
                <div class="icon">
                    <i class="fa fa-refresh"></i>
                </div>
                <div class="description">
                    <h4>Subscription Groups</h4>
                    <span>Add or edit subscriptions on individual products</span>
                </div>
            </a>
        </div>
        <div class="column third">
            <a href="{{url('/SubScriptionCustomers')}}?shop={{$shop}}" class="card home_card">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="description">
                    <h4>Customers</h4>
                    View and edit customers, upcoming orders, credit card info and addresses.
                </div>
            </a>
        </div>
        <div  style="display:none;" class="column third">
            <a href="customers/failed_transactions" class="card home_card">
                <div class="icon">
                    <i class="fa fa-warning"></i>
                </div>
                <div class="description">
                    <h4>Failed Transactions</h4>
                    View all recent failed transactions and update credit card info.
                </div>
            </a>
        </div>

        <div  style="display:none;" class="column third">
            <a href="customers/deleted_products" class="card home_card">
                <div class="icon">
                    <i class="fa fa-trash"></i>
                </div>
                <div class="description">
                    <h4>Manage Deleted Products</h4>
                    Remove or substitute products when they get deleted here.
                </div>
            </a>
        </div>
        <div  style="display:none;" class="column third">
            <a href="price_settings" class="card home_card">
                <div class="icon">
                    <i class="fa fa-usd"></i>
                </div>
                <div class="description">
                    <h4>Update Pricing</h4>
                    Globally update prices for products on all subscriptions.
                </div>
            </a>
        </div>

        <div  style="display:none;" class="column third">
            <a href="{{url('/DiscountCodes')}}?shop={{$shop}}" class="card home_card">
                <div class="icon">
                    <i class="fa fa-tags"></i>
                </div>
                <div class="description">
                    <h4>Discount Codes</h4>
                    View all existing discount codes.
                </div>
            </a>
        </div>

		     <div   style="display:none;" class="column third">
            <a href="display_settings" class="card home_card">
                <div class="icon">
                    <i class="fa fa-paint-brush"></i>
                </div>
                <div class="description">
                    <h4>Display Settings</h4>
                    Style your recurring widgets, cart widgets and customer admin page.
                </div>
            </a>
        </div>
    </div>
</div>

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
