{{-- extent Layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Transitions')

{{-- page content --}}
@section('content')
<div class="section">
  <div class="row">
    <div class="col s12">
      <div id="scale" class="card card-tabs">
        <div class="card-content">
          <div class="card-title">
            <div class="row">
              <div class="col s12 m6 l10">
                <h4 class="card-title">Scale</h4>
              </div>
              <div class="col s12 m6 l2">
                <ul class="tabs">
                  <li class="tab col s6 p-0"><a class="active p-0" href="#view-animations">View</a></li>
                  <li class="tab col s6 p-0"><a class="p-0" href="#html-animations">Html</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div id="view-animations">
            <div class="row">
              <div class="col s12">
                <p>Use this scale in and out elements. Make sure to add the base transition class
                  <a>scale-transition.</a>
                  Then add the class <a>scale-out</a> to scale the element down until it is hidden. To start something
                  as hidden, add the class <a>scale-out</a> first, and then add the class scale-in to scale the element
                  up until it is shown.</p>
                <!-- Scaled in -->
                <a id="scale-demo" href="#!" class="btn-floating btn-large scale-transition mt-2">
                  <i class="material-icons">add</i>
                </a>
                <!-- Scaled out -->
                <a id="scale-demo-out" href="#!" class="btn-floating btn-large scale-transition scale-out mt-2">
                  <i class="material-icons">add</i>
                </a>
                <a id="scale-demo-trigger" href="#!" class="btn right mt-2">Toggle Scale</a>
              </div>
            </div>
          </div>
          <div id="html-animations">
            <pre><code class="language-markup">
  &lt;!-- Scaled in -->
  &lt;a id="scale-demo" href="#!" class="btn-floating btn-large scale-transition">
  &lt;i class="material-icons">add&lt;/i>
  &lt;/a>
  &lt;!-- Scaled out -->
  &lt;a id="scale-demo" href="#!" class="btn-floating btn-large scale-transition scale-out">
  &lt;i class="material-icons">add&lt;/i>
  &lt;/a>
  </code></pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('public/js/scripts/css-transition.js')}}"></script>
@endsection