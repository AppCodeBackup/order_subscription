@extends('layout.app')
@section('content')


<?php
  $stype=['Standard','Convertible','Build-a-Box']
?>
<section class="segment">
    <div class="content">
        <header class="segment-header">
            <h1>Subscription Groups</h1>
            <p class="intro">
                Below are all the different subscriptions you offer. A <b>Subscription</b> is when a product has the
                recurring order option added by a customer. Subscriptions can contain one, or many products.
                Different subscriptions can have different rules for discounts, intervals allowed etc.
                A product can only be included in one subscription.
            </p>
        </header>
    </div>
</section>
<section class="segment">
    <div class="messages-container"></div>
    <div class="content">
        <div class="card">
            <div class="options-container">
                <div class="grid">
                    <div class="column half flex-align-bottom sub-group-sync">
                        <div class="btn-group">
                            <a href="{{url('/create-subscription-set')}}?shop={{$shop}}" class="btn btn-primary">Create Subscription Group</a>
                            <span id="sync_icon">
                            <a href="#nogo" class="btn sync_all_btn" onclick="">Resync all Subscriptions</a> </span>
                        </div>
                    </div>
                    <div class="column half sub-group-searchbar">
                        <label class="field-label search-txt">Search by Subscription Name</label>
                        <div class="field-group flex-align-bottom search-div">
                            <input class="input-field search ui-autocomplete-input" type="text" id="search" placeholder="" name="search" autocomplete="off" value="">
                            <a id="search_btn" class="btn search_btn">Search</a>
                        </div>
                    </div>
                </div>
                <div class="actions-alignment"></div>
                <div>                        </div>
                <table class="table with-row-borders">
                    <thead>
                        <tr>
                            <!-- <th class="active-column">Active</th> -->
                            <th class="name-column">Name</th>
                            <th>Type</th>
                            <th>Discount</th>
                            <th class="shrink-column">Preview Products</th>
                            <th class="shrink-column">Sync Group</th>
                            <th class="shrink-column">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Subscriptions as $subscription)
                        <tr>
                            <!-- <td>
                                <div class="field toggle-field with-switch">
                                    <label for="field_109726">
                                        <input id="field_109726" type="checkbox" value="1" class="toggle_checkbox" data-group-id="109726" checked="">
                                        <div class="toggle-field-switch"></div>
                                    </label>
                                </div>
                            </td> -->
                            <td>{{$subscription->group_name}}</td>
                            <td>{{$stype[$subscription->subscription_type-1]}}</td>
                            <td>{{$subscription->discount}}<span>%</span></td>
                            <td class="text-align-center">
                                <input id="select_product_0" class="select_product" name="filter" type="hidden" value="" width="180px">
                                <input id="select_product_0_visible" type="text" placeholder="Select Products" readonly="readonly" style="width: 180px; vertical-align:middle; display:none;">
                                <a rel="tooltip" data-products = "{{$subscription->product_ids}}" title="Preview currently selected products"  class="btn preview-btn showProdutcs">
                                  <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td class="text-align-center">
                              <span id="sync_single_icon"><a class="btn sync_single_btn overflow-unset" data-index="0" data-recurring-id="109726"><span class="fa fa-refresh"></span></a></span></td>
                            <td class="show-overflow text-align-center">
                                <div class="dropdown pull-left">
                                    <!-- <a class="btn  dropdown-toggle " aria-haspopup="true" aria-expanded="true">
                                      <i class="fa fa-ellipsis-v " aria-hidden="true"></i>
                                    </a> -->
                                    <ul   class="dropdown-menu pull-left" aria-labelledby="dropdownMenu1">
                                        <li style="display:none;" class="dropdown-menu-item">
                                          <span>
                                            <a href="edit_product_recurring?id=109726" class="overflow-unset">Edit Subscription</a>
                                          </span>
                                          </li>
                                        <li class="dropdown-menu-item">
                                          <a style="color:#8b0000;cursor:pointer" data-recurring-id="{{$subscription->id}}" class="delete-recurring delete-product-style-0 overflow-unset">
                                            <span>Delete Group</span>
                                          </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
      var createApp = AppBridge.default;
      var app = createApp({
      apiKey: '{{ config('shopify-app.api_key') }}',
      shopOrigin: '{{ ShopifyApp::shop()->shopify_domain }}',
      forceRedirect: true,
      });
      var actions = window['app-bridge'].actions;
      var Button = actions.Button;
      var Modal = actions.Modal;
      var TitleBar = actions.TitleBar;
      var Redirect = actions.Redirect;
      var Loading = actions.Redirect;
      var myTitleBar = TitleBar.create(app, titleBarOptions);
      var titleBarOptions = {
          title: 'Welcome',
      };
      var myTitleBar = TitleBar.create(app, titleBarOptions);

      var loading = Loading.create(app);
      var okButton = Button.create(app, {label: 'Ok'});
      var cancelButton = Button.create(app, {label: 'Close'});

      var  csrfToken = "{{ csrf_token() }}"
</script>

@endif

@endsection
