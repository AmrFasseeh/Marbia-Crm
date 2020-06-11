{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Marbia CRM')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/animate-css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/chartist-js/chartist.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/chartist-js/chartist-plugin-tooltip.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/ionRangeSlider/css/ion.rangeSlider.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/ionRangeSlider/css/ion.rangeSlider.skinFlat.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/dashboard-modern.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/intro.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section">
   <!-- Current balance & total transactions cards-->
   <div class="row vertical-modern-dashboard">
      <div class="col s12">
         <div class="card animate fadeLeft">
            <div class="card-content">
               <h6 class="mb-0 mt-0 display-flex justify-content-between">Advanced Property Search
               </h6>
               <form action="{{ route('property.search') }}" method="post">
                  @csrf
                  <div class="row mb-2">
                     <div class="col s4 mt-2">
                        <label for="value">Price Range</label>
                        <input type="range" id="value" id="value">
                        <input type="hidden" id="value_from" name="value_from">
                        <input type="hidden" id="value_to" name="value_to">
                     </div>
                     <div class="col s4 mt-2">
                        <label for="area_sqm">Area Range</label>
                        <input type="range" id="area_sqm" id="area_sqm">
                        <input type="hidden" id="area_from" name="area_from">
                        <input type="hidden" id="area_to" name="area_to">
                     </div>
                     <div class="col s2 mt-2">
                        <label for="floor_no">Floor #</label>
                        <input type="number" id="floor_no" name="floor_no" id="floor_no">
                     </div>
                     <div class="col s2 mt-2">
                        <label for="property_type">Property Type</label>
                        <select id="property_type" class="select2 browser-default" name="property_type">
                           <option disabled>Select</option>
                           @foreach ($property_types as $type)
                           <option value="{{ $type->property_type }}">{{ $type->property_type }}</option>
                           @endforeach
                         </select>
                     </div>
                  </div>
                     <div class="row">
                        <div class="col s3 mt-2">
                           <label for="bedrooms"># of Bedrooms</label>
                           <input type="number" name="bedrooms" id="bedrooms">
                        </div>
                        <div class="col s3 mt-2">
                           <label for="bathrooms"># of Bathrooms</label>
                           <input type="number" name="bathrooms" id="bathrooms">
                        </div>
                        <div class="col s3 mt-2">
                           <label for="kitchen"># of Kitchens</label>
                           <input type="number" name="kitchen" id="kitchen">
                        </div>
                        <div class="col s3 mt-2">
                           <label for="status">Property Availability</label>
                           <select id="status" class="select2 browser-default" name="status">
                              <option disabled>Select</option>
                              <option value="0">Available</option>
                              <option value="1">onHold</option>
                              <option value="2">Sold</option>
                            </select>
                        </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col s12 m8 l8">
                        <input type="submit" value="Search!" class="btn blue">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="row vertical-modern-dashboard">
      <div class="col s12 m4 l4">
         <!-- Current Balance -->
         <div class="card animate fadeLeft">
            <div class="card-content">
               <h6 class="mb-0 mt-0 display-flex justify-content-between">Deals Balance
               </h6>
               <p class="medium-small">This billing cycle</p>
               <div class="current-balance-container">
                  <div id="current-balance-donut-chart" class="current-balance-shadow"></div>
               </div>
               <h5 class="center-align">{{ number_format($balance) }} EGP</h5>
               <p class="medium-small center-align">Used balance this billing cycle</p>
            </div>
         </div>
      </div>
      <div class="col s12 m8 l8 animate fadeRight">
         <!-- Total Transaction -->
         <div class="card">
            <div class="card-content">
               <h4 class="card-title mb-0">Total Transaction <i class="material-icons float-right">more_vert</i></h4>
               <p class="medium-small">This month transaction</p>
               <div class="total-transaction-container">
                  <div id="total-transaction-line-chart" class="total-transaction-shadow"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--/ Current balance & total transactions cards-->

   <!-- User statistics & appointment cards-->
   <div class="row">
      <div class="col s12 l5">
         <!-- User Statistics -->
         <div class="card user-statistics-card animate fadeLeft">
            <div class="card-content">
               <h4 class="card-title mb-0">User Statistics <i class="material-icons float-right">more_vert</i></h4>
               <div class="row">
                  <div class="col s12 m6">
                     <ul class="collection border-none mb-0">
                        <li class="collection-item avatar">
                           <i class="material-icons circle pink accent-2">trending_up</i>
                           <p class="medium-small">This year</p>
                           <h5 class="mt-0 mb-0">60%</h5>
                        </li>
                     </ul>
                  </div>
                  <div class="col s12 m6">
                     <ul class="collection border-none mb-0">
                        <li class="collection-item avatar">
                           <i class="material-icons circle purple accent-4">trending_down</i>
                           <p class="medium-small">Last year</p>
                           <h5 class="mt-0 mb-0">40%</h5>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="user-statistics-container">
                  <div id="user-statistics-bar-chart" class="user-statistics-shadow"></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col s12 l4">
         <!-- Recent Buyers -->
         <div class="card recent-buyers-card animate fadeUp">
            <div class="card-content">
               <h4 class="card-title mb-0">Recent Buyers <i class="material-icons float-right">more_vert</i></h4>
               <p class="medium-small pt-2">Today</p>
               <ul class="collection mb-0">
                  @foreach ($latest_deals as $deal)
                  <li class="collection-item avatar">
                     <img src="{{asset('public/images/avatar/default.png')}}" alt="" class="circle" />
                     <p class="font-weight-600"><a href="{{ route('view.deal', $deal->id) }}">{{ $deal->customer->fullname }}</a></p>
                     <p class="medium-small">{{ Carbon\Carbon::make($deal->created_at)->toFormattedDateString() }}</p>
                  </li>
                  @endforeach
               </ul>
            </div>
         </div>
      </div>
      <div class="col s12 l3">
         <div class="card animate fadeRight">
            <div class="card-content">
               <h4 class="card-title mb-0">Conversion Ratio</h4>
               <div class="conversion-ration-container mt-8">
                  <div id="conversion-ration-bar-chart" class="conversion-ration-shadow"></div>
               </div>
               <p class="medium-small center-align">This month conversion ratio</p>
               <h5 class="center-align mb-0 mt-0">62%</h5>
            </div>
         </div>
      </div>
   </div>
   <!--/ Current balance & appointment cards-->

   <div class="row">
      <div class="col s12 m6 l4">
         <div class="card padding-4 animate fadeLeft">
            <div class="row">
               <div class="col s5 m5">
                  <h5 class="mb-0">{{ $newContacts }}</h5>
                  <p class="no-margin">New</p>
                  <p class="mb-0 pt-8">{{ $contacts }}</p>
               </div>
               <div class="col s7 m7 right-align">
                  <i
                     class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
                  <p class="mb-0">Total Contacts</p>
               </div>
            </div>
         </div>
         <div id="chartjs" class="card pt-0 pb-0 animate fadeLeft">
            <div class="dashboard-revenue-wrapper padding-2 ml-2">
               <span class="new badge gradient-45deg-indigo-purple gradient-shadow mt-2 mr-2">+ {{ number_format($last_deal_value) }} EGP</span>
               <p class="mt-2 mb-0 font-weight-600">Today's income</p>
               <p class="no-margin grey-text lighten-3">{{ number_format($today_deals/$today_deals_count) }} EGP</p>
               <h5>{{ number_format($today_deals) }} EGP</h5>
            </div>
            <div class="sample-chart-wrapper card-gradient-chart">
               <canvas id="custom-line-chart-sample-three" class="center"></canvas>
            </div>
         </div>
      </div>
      <div class="col s12 m6 l8">
         <div class="card subscriber-list-card animate fadeRight">
            <div class="card-content pb-1">
               <h4 class="card-title mb-0">Recent Contacts <i class="material-icons float-right">more_vert</i></h4>
            </div>
            <table class="subscription-table responsive-table highlight">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Phone</th>
                     <th>Added</th>
                     <th>Stage</th>
                     <th>City</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($latest_contacts as $contact)
                  <tr>
                     <td><a href="{{ route('view.contact', $contact->id) }}">{{ $contact->fullname }}</a></td>
                     <td>{{ $contact->phone }}</td>
                     <td>{{ Carbon\Carbon::make($contact->created_at)->toFormattedDateString() }}</td>
                     @if ($contact->type == 0)
                     <td><span class="badge pink lighten-5 pink-text text-accent-2">Contact</span></td>
                     @elseif($contact->type == 1)
                     <td><span class="badge blue lighten-5 blue-text text-accent-4">Lead</span></td>  
                     @else
                     <td><span class="badge green lighten-5 green-text text-accent-4">Deal</span></td>
                     @endif
                     <td>{{ App\governorate::findorfail($contact->city)->name_en }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
{{-- @include('pages.intro') --}}
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('public/vendors/chartjs/chart.min.js')}}"></script>
<script src="{{asset('public/vendors/chartist-js/chartist.min.js')}}"></script>
<script src="{{asset('public/vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('public/vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script>
<script src="{{asset('public/vendors/ionRangeSlider/js/ion.rangeSlider.js')}}"></script>
<script src="{{asset('public/vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('public/js/scripts/dashboard-modern.js')}}"></script>
<script>
$("#value").ionRangeSlider({
    type: "double",
    grid: true,
    min: {{ $property_min_price }},
    max: {{ $property_max_price }},
    from: {{ $property_max_price }}/4,
    to: {{ $property_max_price }}/2,
    prefix: "EGP ",
    onStart: function(data) {
       $('input#value_from').attr('value', data.from);
       $('input#value_to').attr('value', data.to);
    },
    onChange: function(data) {
       $('input#value_from').attr('value', data.from);
       $('input#value_to').attr('value', data.to);
    }
  });
  $("#area_sqm").ionRangeSlider({
    type: "double",
    grid: true,
    min: {{ $property_min_area }},
    max: {{ $property_max_area }},
    from: {{ $property_max_area }}/4,
    to: {{ $property_max_area }}/2,
    prefix: "Sqm ",
    onStart: function(data) {
       $('input#area_from').attr('value', data.from);
       $('input#area_to').attr('value', data.to);
    },
    onChange: function(data) {
       $('input#area_from').attr('value', data.from);
       $('input#area_to').attr('value', data.to);
    }
  });

   $("#property_type").select2({
        dropdownAutoWidth: true,
        placeholder: "Select"
    });
    $("#status").select2({
        dropdownAutoWidth: true,
        placeholder: "Select"
    });
   
   var CurrentBalanceDonutChart = new Chartist.Pie(
    "#current-balance-donut-chart",
    {
      labels: [1, 2],
      series: [
        { meta: "Completed", value: 80 },
        { meta: "Remaining", value: 20 }
      ]
    },

    {
      donut: true,
      donutWidth: 8,
      showLabel: false,
      plugins: [
        Chartist.plugins.tooltip({
          class: "current-balance-tooltip",
          appendToBody: true
        }),
        Chartist.plugins.fillDonut({
          items: [
            {
              content:
                '<p class="small">Balance</p><h5 class="mt-0 mb-0">{{ $shortBalance }}</h5>'
            }
          ]
        })
      ]
    }
  )
</script>
<script src="{{asset('public/js/scripts/intro.js')}}"></script>
@endsection