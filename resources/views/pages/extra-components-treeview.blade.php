{{-- extend Layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Treeview')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/jstree/themes/default/style.min.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/extra-components-treeview.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- Treeview  -->
<div class="section treeview-wrapper">
  <div class="row">
    <!-- treeview description -->
    <div class="col s12">
      <div class="card-panel">
        <a href="https://www.jstree.com" target="_blank">jsTree </a> is jquery plugin, that provides interactive
        trees. It is
        absolutely free, open
        source and
        distributed under the MIT license. jsTree is easily extendable, themable and configurable, it
        supports HTML & JSON data sources and AJAX loading.
      </div>
    </div>
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div class="row mb-3">
            <div class="col m6 s12">
              <h6>Default</h6>
              <div class="jsTreedefault mt-3">
                <!-- default js tree example -->
                <ul>
                  <li>css
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.css</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>style.css
                      </li>
                    </ul>
                  </li>
                  <li class="jstree-open">images
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>bg.jpg</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>logo.png</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>avatar.png
                      </li>
                    </ul>
                  </li>
                  <li>js
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>jquery.js</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.js</li>
                    </ul>
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">index.html
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">page-one.html</li>
                  <li data-jstree='{"icon" : "jstree-file"}'>page-two.html</li>
                </ul>
              </div>
            </div>
            <div class="col m6 s12">
              <!--Json data treeview example -->
              <h6>Json data</h6>
              <div class="jsondataTree mt-3">
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col m6 s12">
              <!--Draggable treeview example -->
              <h6>Draggable</h6>
              <div class="draggablejstree mt-3">
                <ul>
                  <li>css
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.css</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>style.css
                      </li>
                    </ul>
                  </li>
                  <li class="jstree-open">images
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>bg.jpg</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>logo.png</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>avatar.png
                      </li>
                    </ul>
                  </li>
                  <li>js
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>jquery.js</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.js</li>
                    </ul>
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">index.html
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">page-one.html</li>
                  <li data-jstree='{"icon" : "jstree-file"}'>page-two.html</li>
                </ul>
              </div>
            </div>
            <div class="col m6 s12">
              <!--Whole row treeview example -->
              <h6>WholeRow</h6>
              <div class="wholerowjstree mt-3">
                <ul>
                  <li>css
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.css</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>style.css
                      </li>
                    </ul>
                  </li>
                  <li class="jstree-open">images
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>bg.jpg</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>logo.png</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>avatar.png
                      </li>
                    </ul>
                  </li>
                  <li>js
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>jquery.js</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.js</li>
                    </ul>
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">index.html
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">page-one.html</li>
                  <li data-jstree='{"icon" : "jstree-file"}'>page-two.html</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col m6 s12">
              <!--Contextmenu treeview example -->
              <h6>Contextmenu</h6>
              <div class="contextmenujstree mt-3">
                <ul>
                  <li>css
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.css</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>style.css
                      </li>
                    </ul>
                  </li>
                  <li class="jstree-open">images
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>bg.jpg</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>logo.png</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>avatar.png
                      </li>
                    </ul>
                  </li>
                  <li>js
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>jquery.js</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.js</li>
                    </ul>
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">index.html
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">page-one.html</li>
                  <li data-jstree='{"icon" : "jstree-file"}'>page-two.html</li>
                </ul>
              </div>
            </div>
            <div class="col m6 s12">
              <!--Searchable treeview example -->
              <h6>Search </h6>
              <div class="input-field">
                <input type="text" class="searchtree" placeholder="Search data">
              </div>
              <div class="searchablejstree mt-3">
                <ul>
                  <li>css
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.css</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>style.css
                      </li>
                    </ul>
                  </li>
                  <li class="jstree-open">images
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>bg.jpg</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>logo.png</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>avatar.png
                      </li>
                    </ul>
                  </li>
                  <li>js
                    <ul>
                      <li data-jstree='{"icon" : "jstree-file"}'>jquery.js</li>
                      <li data-jstree='{"icon" : "jstree-file"}'>app.js</li>
                    </ul>
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">index.html
                  </li>
                  <li data-jstree='{"icon" : "jstree-file"}' class="green-text">page-one.html</li>
                  <li data-jstree='{"icon" : "jstree-file"}'>page-two.html</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- vendor script --}}
@section('vendor-script')
<script src="{{asset('public/vendors/jstree/jstree.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('public/js/scripts/extra-components-treeview.js')}}"></script>
@endsection