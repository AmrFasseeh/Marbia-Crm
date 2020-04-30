<!-- BEGIN VENDOR JS-->
<script src="{{asset('marbia/marbia-crm/public/js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
@yield('vendor-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{asset('marbia/marbia-crm/public/js/plugins.js')}}"></script>
<script src="{{asset('marbia/marbia-crm/public/js/search.js')}}"></script>
<script src="{{asset('marbia/marbia-crm/public/js/custom/custom-script.js')}}"></script>
<script src="{{ asset('marbia/marbia-crm/public/js/vue.js') }}"></script>
<script src="{{ asset('marbia/marbia-crm/public/js/dom-autoscroller.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
@if ($configData['isCustomizer']=== true)
<script src="{{asset('marbia/marbia-crm/public/js/scripts/customizer.js')}}"></script>
@endif
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
@yield('page-script')