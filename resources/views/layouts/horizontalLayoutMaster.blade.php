<body
  class="{{$configData['mainLayoutTypeClass']}} @if(!empty($configData['bodyCustomClass']) && isset($configData['bodyCustomClass'])) {{$configData['bodyCustomClass']}} @endif"
  data-open="click" data-menu="horizontal-menu" data-col="2-columns">

  <!-- BEGIN: Header-->
  <header class="page-topbar" id="header">
    @include('panels.horizontalNavbar')
  </header>
  <!-- BEGIN: SideNav-->
  @include('panels.sidebar')
  <!-- END: SideNav-->

  <!-- BEGIN: Page Main-->
  <div id="main">
    <div class="row">
      @if($configData["navbarLarge"] === true && isset($configData["navbarLarge"]))
      {{-- navabar large  --}}
      <div class="content-wrapper-before {{$configData["navbarLargeColor"]}}"></div>
      @endif
      
      @if (session('status'))
      <div class="card-alert card gradient-45deg-green-teal">
        <div class="card-content white-text">
          <p>
            {{ session('status') }}</p>
        </div>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      @endif

      @if (session('warning'))
        <div class="card-alert card gradient-45deg-amber-amber">
          <div class="card-content white-text">
            <p>
              {{session('warning')}}</p>
          </div>
          <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        @endif 

      @if ($configData["pageHeader"] === true && isset($breadcrumbs))
      {{-- breadcrumb --}}
      @include('panels.breadcrumb')
      @endif
      <div class="col s12">
        <div class="container">
          {{-- main page content  --}}
          @yield('content')
          {{-- right sidebar  --}}
          @include('pages.sidebar.right-sidebar')

          @if($configData["isFabButton"] === true)
          @include('pages.sidebar.fab-menu')
          @endif
        </div>
        {{-- overlay --}}
        <div class="content-overlay"></div>
      </div>
    </div>
  </div>

  <!-- END: Page Main-->


  @if($configData['isCustomizer'] === true && isset($configData['isCustomizer']))
  <!-- Theme Customizer -->
  @include('pages.partials.customizer')
  <!--/ Theme Customizer -->
  @endif



  {{-- main footer  --}}
  @include('panels.footer')

  {{-- vendors and page scripts file   --}}
  @include('panels.scripts')
</body>