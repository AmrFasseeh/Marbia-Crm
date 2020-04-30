{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App ToDo')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/quill/quill.snow.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/css/pages/app-todo.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- Sidebar Area Starts -->
<div class="todo-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">check_box</i> To-Do</h5>
          <div class="row valign-wrapper mt-10 pt-2 animate fadeLeft">
            <div class="col s3 media-image">
              <img src="{{asset('marbia/marbia-crm/public/images/user/2.jpg')}}" alt="" class="circle z-depth-2 responsive-img">
              <!-- notice the "circle" class -->
            </div>
            <div class="col s9">
              <p class="m-0 subtitle font-weight-700">Lawrence Collins</p>
              <p class="m-0 text-muted">lawrence.collins@xyz.com</p>
            </div>
          </div>
        </div>
      </div>
      <div id="sidebar-list" class="sidebar-menu list-group position-relative  animate fadeLeft">
        <div class="sidebar-list-padding app-sidebar sidenav" id="todo-sidenav">
          <ul class="todo-list display-grid">
            <li class="active"><a href="#!" class="text-sub"><i class="material-icons mr-2"> mail_outline </i> All</a>
            </li>
            <li class="sidebar-title">Filters</li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> star_border </i> Starred</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> info_outline </i> Priority</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> watch_later </i> Scheduled</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> date_range </i> Today</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> check </i> Done</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> delete </i> Delete</a></li>
            <li class="sidebar-title">Department</li>
            <li><a href="#!" class="text-sub"><i class="purple-text material-icons small-icons mr-2">
                  fiber_manual_record </i> API</a></li>
            <li><a href="#!" class="text-sub"><i class="amber-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Paypal</a></li>
            <li><a href="#!" class="text-sub"><i class="light-green-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Invoice</a></li>
          </ul>
        </div>
      </div>
      <a href="#" data-target="todo-sidenav" class="sidenav-trigger hide-on-large-only"><i
          class="material-icons">menu</i></a>
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->

<!-- Content Area Starts -->
<div class="app-todo">
  <div class="content-area content-right">
    <div class="app-wrapper">
      <div class="app-search">
        <i class="material-icons mr-2 search-icon">search</i>
        <input type="text" placeholder="Search Contact" class="app-filter" id="todo_filter">
      </div>
      <div class="card card card-default scrollspy border-radius-6 fixed-width">
        <div class="card-content p-0 pb-1">
          <div class="todo-header">
            <div class="header-checkbox">
              <label>
                <input type="checkbox" onClick="toggle(this)" />
                <span></span>
              </label>
            </div>
            <div class="list-content"></div>
            <div class="todo-action">
              <span class="delete-tasks"><i class="material-icons grey-text mr-1">delete</i></span>
              <span class="sort-task"><i class="material-icons grey-text">sort</i></span>
              <div class="select-action">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger grey-text' href='#' data-target='dropdown1'>
                  <i class="material-icons">more_vert</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                  <li><a href="#!">All</a></li>
                  <li><a href="#!">Read</a></li>
                  <li><a href="#!">Unread</a></li>
                  <li><a href="#!">Starred</a></li>
                  <li><a href="#!">Unstarred</a></li>
                </ul>
              </div>
            </div>
          </div>
          <ul class="collection todo-collection">
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Contrary to popular belief</div>
                  <span class="badge grey lighten-2"><i class="purple-text material-icons small-icons mr-2">
                      fiber_manual_record </i>API</span>
                </div>
                <div class="list-desc">There are many variations of passages of Lorem Ipsum available, but the majority
                  have suffered alteration in some form, by injected humour, or randomised words which don't look even
                  slightly believable. If you are going to use a passage of Lorem Ipsum</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Cupcake tootsie roll icing biscuit</div>
                  <span class="badge grey lighten-2"><i class="amber-text material-icons small-icons mr-2">
                      fiber_manual_record </i>Paypal</span>
                </div>
                <div class="list-desc">Chocolate cake biscuit candy canes carrot cake. Bear claw wafer jujubes bear
                  claw candy biscuit. Jelly-o pudding topping. Muffin soufflé cotton candy topping candy muffin
                  biscuit. Lemon drops lemon drops powder gingerbread pastry cake.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Apple pie cake biscuit bonbon</div>
                  <span class="badge grey lighten-2"><i class="purple-text material-icons small-icons mr-2">
                      fiber_manual_record </i>API</span>
                </div>
                <div class="list-desc">Pudding ice cream macaroon caramels oat cake gummies jelly-o wafer macaroon.
                  Gingerbread cheesecake pudding donut halvah pastry cheesecake. Tootsie roll lemon drops brownie ice
                  cream jelly jelly fruitcake. Muffin tiramisu cake ice cream.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Cupcake danish icing cupcake cupcake</div>
                  <span class="badge grey lighten-2"><i class="light-green-text material-icons small-icons mr-2">
                      fiber_manual_record </i>Invoice</span>
                </div>
                <div class="list-desc">Pie soufflé gummies danish cake pudding tart lollipop. Donut apple pie marzipan.
                  Cupcake pastry gingerbread chocolate cake ice cream icing muffin. Lemon drops cotton candy liquorice
                  candy icing ice cream bear claw. Candy gummies gummies macaroon jujubes biscuit lemon drops.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Cake macaroon topping jelly</div>
                  <span class="badge grey lighten-2"><i class="amber-text material-icons small-icons mr-2">
                      fiber_manual_record </i>Paypal</span>
                </div>
                <div class="list-desc">Apple pie icing powder cheesecake sweet roll halvah pudding sugar plum toffee.
                  Cotton candy tart apple pie.Tart bonbon halvah cake. Carrot cake sugar plum tootsie roll macaroon
                  jujubes.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Wafer chocolate cake tiramisu</div>
                  <span class="badge grey lighten-2"><i class="amber-text material-icons small-icons mr-2">
                      fiber_manual_record </i>Paypal</span>
                </div>
                <div class="list-desc">Candy sesame snaps tiramisu bear claw ice cream chocolate fruitcake powder
                  biscuit. Pudding oat cake cotton candy. Candy canes sweet fruitcake. Macaroon pie bear claw sweet oat
                  cake candy.Marzipan soufflé sugar plum caramels oat cake cake.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Chocolate cake donut jujubes</div>
                  <span class="badge grey lighten-2"><i class="purple-text material-icons small-icons mr-2">
                      fiber_manual_record </i>API</span>
                </div>
                <div class="list-desc">Bear claw macaroon cheesecake cotton candy bear claw sweet roll sweet roll sugar
                  plum. Oat cake sweet jelly beans cheesecake soufflé sweet macaroon. Pudding gingerbread bear claw
                  chupa chups lollipop carrot cake. Cotton candy icing sweet roll.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Contrary to popular belief</div>
                  <span class="badge grey lighten-2"><i class="light-green-text material-icons small-icons mr-2">
                      fiber_manual_record </i>Invoice</span>
                </div>
                <div class="list-desc">Marzipan icing liquorice tiramisu bonbon sweet roll toffee sweet cupcake. Candy
                  canes candy canes pudding pie tiramisu tiramisu powder macaroon. Cotton candy candy powder cheesecake
                  dessert. Sweet halvah marshmallow croissant tootsie roll. Marzipan pudding apple pie caramels sweet
                  roll.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Candy pudding apple pie</div>
                  <span class="badge grey lighten-2"><i class="light-green-text material-icons small-icons mr-2">
                      fiber_manual_record </i>Invoice</span>
                </div>
                <div class="list-desc">Cupcake bear claw pudding. Liquorice cake jujubes candy canes topping pudding.
                  Oat cake liquorice jujubes donut. Powder tiramisu pudding bear claw caramels sweet roll jelly-o.
                  Candy canes gummies muffin wafer oat cake chupa chups. Jujubes tootsie roll pie.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Powder lollipop lollipop pie tiramisu</div>
                  <span class="badge grey lighten-2"><i class="purple-text material-icons small-icons mr-2">
                      fiber_manual_record </i>API</span>
                </div>
                <div class="list-desc">Wafer donut candy. Gummies tootsie roll marshmallow. Sweet roll tootsie roll
                  tart. Chocolate bar marzipan gummies jelly dessert macaroon lollipop topping gingerbread. Donut sugar
                  plum halvah gummies muffin pudding.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Oat cake tootsie roll powder</div>
                  <span class="badge grey lighten-2"><i class="light-green-text material-icons small-icons mr-2">
                      fiber_manual_record </i>Invoice</span>
                </div>
                <div class="list-desc">Topping jelly-o muffin pie. Apple pie dessert oat cake liquorice marshmallow
                  danish gummies tart. Fruitcake toffee tiramisu. Candy canes candy canes biscuit gummies jujubes
                  soufflé caramels. Lollipop bonbon danish gingerbread sesame snaps dragée.</div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item todo-items">
              <div class="todo-move">
                <i class="material-icons icon-move">more_vert</i>
              </div>
              <div class="list-left">
                <label>
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
                <i class="material-icons favorite">star_border</i>
              </div>
              <div class="list-content">
                <div class="list-title-area">
                  <div class="list-title">Caramels pudding chupa chups </div>
                  <span class="badge grey lighten-2"><i class="amber-text material-icons small-icons mr-2">
                      fiber_manual_record </i>Paypal</span>
                </div>
                <div class="list-desc"> Cotton candy cheesecake sweet roll. Gummi bears tiramisu jelly powder. Dessert
                  pie apple pie chocolate bar carrot cake donut chupa chups. Cookie marzipan sweet roll chocolate
                  topping candy canes. Carrot cake croissant jujubes chupa chups cupcake apple pie caramels cake icing.
                </div>
              </div>
              <div class="list-right">
                <div class="list-date"> 23 Apr </div>
                <div class="delete-task"><i class="material-icons">delete</i></div>
              </div>
            </li>
            <li class="collection-item no-data-found">
              <h6 class="center-align font-weight-500">No Results Found</h6>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content Area Ends -->

<!-- Add new todo popup -->
<div style="bottom: 54px; right: 19px;" class="fixed-action-btn direction-top">
  <a class="btn-floating btn-large primary-text gradient-shadow todo-sidebar-trigger">
    <i class="material-icons">note_add</i>
  </a>
</div>
<!-- Add new todo popup Ends-->

<!-- todo compose sidebar -->
<div class="todo-compose-sidebar">
  <div class="card quill-wrapper">
    <div class="card-content pt-0">
      <div class="card-header display-flex pb-2">
        <h3 class="card-title todo-title-label">NEW TASK</h3>
        <button class="btn todo-complete hide">Marks Complete</button>
        <div class="close close-icon">
          <i class="material-icons">close</i>
        </div>
      </div>
      <div class="divider"></div>
      <!-- form start -->
      <form class="edit-todo-item mt-10 mb-10">
        <div class="input-field">
          <textarea class="edit-todo-item-title materialize-textarea" id="edit-item-form"></textarea>
          <label for="edit-item-form">Write a Task Name</label>
        </div>
        <div class="input-field">
          <div class="display-flex">
            <div class="assignto display-flex">
              <div class="avatar">
                <img src="{{asset('marbia/marbia-crm/public/images/avatar/avatar-10.png')}}" class="responsive-img circle z-depth-2" width="50"
                  alt="">
              </div>
              <select>
                <option value="" disabled selected>Unassigned</option>
                <optgroup label="Backend">
                  <option value="1">David Smith</option>
                  <option value="2">John Doe</option>
                  <option value="3">James Smith</option>
                </optgroup>
                <optgroup label="Frontend">
                  <option value="1">Maria Rodrigue</option>
                  <option value="2">Marry Smith</option>
                  <option value="3">James Jackson</option>
                </optgroup>
              </select>
            </div>
            <div class="assignDate display-flex">
              <div class="date-icon circle">
                <i class="material-icons">date_range</i>
              </div>
              <input type="text" class="assign-date datepicker" placeholder="Pick A date" value="14/11/2019">
            </div>
          </div>
        </div>
        <div class="divider"></div>

        <!-- Compose mail Quill editor -->
        <div class="input-field">
          <div class="snow-container mt-7">
            <div class="compose-editor"></div>
            <div class="compose-quill-toolbar">
              <span class="ql-formats mr-0">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-link"></button>
                <button class="ql-image"></button>
              </span>
            </div>
          </div>
        </div>
        <div class="input-field display-flex align-items-center">
          <i class="material-icons mr-5">label_outline</i>
          <select class="browser-default select-tags" multiple disabled="disabled">
            <option value="API">API</option>
            <option value="Paypal">Paypal</option>
            <option value="Invoice">Invoice</option>
          </select>
          <i class="material-icons ml-5 tags-toggler cursor-pointer">add_circle_outline</i>
        </div>
        <div class="divider"></div>
        <div class="display-flex align-items-center mt-5">
          <div class="avatar mr-5">
            <img src="{{asset('marbia/marbia-crm/public/images/avatar/avatar-2.png')}}" width="40" class="circle responsive-img" alt="">
          </div>
          <span class="mr-5">Charlie created this task</span>
          <small>13 days ago</small>
        </div>
        <div class="input-field">
          <div class="snow-container mt-7">
            <div class="comment-editor"></div>
            <div class="comment-quill-toolbar">
              <span class="ql-formats mr-0">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-link"></button>
                <button class="ql-image"></button>
              </span>
            </div>
          </div>
        </div>
      </form>
      <div class="card-action pl-0 pr-0 right-align">
        <button class="btn-small waves-effect waves-light add-todo">
          <span>Add Task</span>
        </button>
        <button class="btn-small waves-effect waves-light update-todo display-none">
          <span>Save Changes</span>
        </button>
      </div>
      <!-- form start end-->
    </div>
  </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('marbia/marbia-crm/public/vendors/sortable/jquery-sortable-min.js')}}"></script>
<script src="{{asset('marbia/marbia-crm/public/vendors/quill/quill.min.js')}}"></script>
<script src="{{asset('marbia/marbia-crm/public/vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('marbia/marbia-crm/public/js/scripts/app-todo.js')}}"></script>
@endsection