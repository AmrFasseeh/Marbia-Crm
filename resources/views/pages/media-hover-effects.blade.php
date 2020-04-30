{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Media Hover Effects Page')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/magnific-popup/magnific-popup.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/hover-effects/media-hover-effects.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section">
  <div class="card">
    <div class="card-content">
      <p class="caption mb-0">Masonry with Magnific Popup is a responsive lightbox & dialog script with focus on
        performance and providing best experience for user with any device</p>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Lily</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-lily">
        <img src="{{asset('public/images/gallery/12.png')}}" alt="img12" />
        <figcaption>
          <div>
            <h2>Nice
              <span>Lily</span>
            </h2>
            <p>Lily likes to play with crayons and pencils</p>
          </div>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-lily">
        <img src="{{asset('public/images/gallery/1.png')}}" alt="img1" />
        <figcaption>
          <div>
            <h2>Nice
              <span>Lily</span>
            </h2>
            <p>Lily likes to play with crayons and pencils</p>
          </div>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Sadie</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-sadie">
        <img src="{{asset('public/images/gallery/2.png')}}" alt="img02" />
        <figcaption>
          <h2>Holy
            <span>Sadie</span>
          </h2>
          <p>Sadie never took her eyes off me.
            <br>She had a dark soul.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-sadie">
        <img src="{{asset('public/images/gallery/14.png')}}" alt="img14" />
        <figcaption>
          <h2>Holy
            <span>Sadie</span>
          </h2>
          <p>Sadie never took her eyes off me.
            <br>She had a dark soul.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Honey</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-honey">
        <img src="{{asset('public/images/gallery/4.png')}}" alt="img04" />
        <figcaption>
          <h2>Dreamy
            <span>Honey</span>
            <i>Now</i>
          </h2>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-honey">
        <img src="{{asset('public/images/gallery/5.png')}}" alt="img05" />
        <figcaption>
          <h2>Dreamy
            <span>Honey</span>
            <i>Now</i>
          </h2>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Layla</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-layla">
        <img src="{{asset('public/images/gallery/6.png')}}" alt="img06" />
        <figcaption>
          <h2>Crazy
            <span>Layla</span>
          </h2>
          <p>When Layla appears, she brings an eternal summer along.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-layla">
        <img src="{{asset('public/images/gallery/3.png')}}" alt="img03" />
        <figcaption>
          <h2>Crazy
            <span>Layla</span>
          </h2>
          <p>When Layla appears, she brings an eternal summer along.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Zoe</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-zoe">
        <img src="{{asset('public/images/gallery/25.png')}}" alt="img25" />
        <figcaption>
          <h2>Creative
            <span>Zoe</span>
          </h2>
          <p class="icon-links">
            <a href="#">
              <span class="icon-heart"></span>
            </a>
            <a href="#">
              <span class="icon-eye"></span>
            </a>
            <a href="#">
              <span class="icon-paper-clip"></span>
            </a>
          </p>
          <p class="description">Zoe never had the patience of her sisters. She deliberately punched the bear in his
            face.</p>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-zoe">
        <img src="{{asset('public/images/gallery/26.png')}}" alt="img26" />
        <figcaption>
          <h2>Creative
            <span>Zoe</span>
          </h2>
          <p class="icon-links">
            <a href="#">
              <span class="icon-heart"></span>
            </a>
            <a href="#">
              <span class="icon-eye"></span>
            </a>
            <a href="#">
              <span class="icon-paper-clip"></span>
            </a>
          </p>
          <p class="description">Zoe never had the patience of her sisters. She deliberately punched the bear in his
            face.</p>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Oscar</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-oscar">
        <img src="{{asset('public/images/gallery/9.png')}}" alt="img09" />
        <figcaption>
          <h2>Warm
            <span>Oscar</span>
          </h2>
          <p>Oscar is a decent man. He used to clean porches with pleasure.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-oscar">
        <img src="{{asset('public/images/gallery/10.png')}}" alt="img10" />
        <figcaption>
          <h2>Warm
            <span>Oscar</span>
          </h2>
          <p>Oscar is a decent man. He used to clean porches with pleasure.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Marley</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-marley">
        <img src="{{asset('public/images/gallery/11.png')}}" alt="img11" />
        <figcaption>
          <h2>Sweet
            <span>Marley</span>
          </h2>
          <p>Marley tried to convince her but she was not interested.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-marley">
        <img src="{{asset('public/images/gallery/12.png')}}" alt="img12" />
        <figcaption>
          <h2>Sweet
            <span>Marley</span>
          </h2>
          <p>Marley tried to convince her but she was not interested.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Ruby</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-ruby">
        <img src="{{asset('public/images/gallery/13.png')}}" alt="img13" />
        <figcaption>
          <h2>Glowing
            <span>Ruby</span>
          </h2>
          <p>Ruby did not need any help. Everybody knew that.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-ruby">
        <img src="{{asset('public/images/gallery/14.png')}}" alt="img14" />
        <figcaption>
          <h2>Glowing
            <span>Ruby</span>
          </h2>
          <p>Ruby did not need any help. Everybody knew that.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Roxy</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-roxy">
        <img src="{{asset('public/images/gallery/15.png')}}" alt="img15" />
        <figcaption>
          <h2>Charming
            <span>Roxy</span>
          </h2>
          <p>Roxy was my best friend. She'd cross any border for me.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-roxy">
        <img src="{{asset('public/images/gallery/1.png')}}" alt="img01" />
        <figcaption>
          <h2>Charming
            <span>Roxy</span>
          </h2>
          <p>Roxy was my best friend. She'd cross any border for me.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Bubba</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-bubba">
        <img src="{{asset('public/images/gallery/2.png')}}" alt="img02" />
        <figcaption>
          <h2>Fresh
            <span>Bubba</span>
          </h2>
          <p>Bubba likes to appear out of thin air.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-bubba">
        <img src="{{asset('public/images/gallery/16.png')}}" alt="img16" />
        <figcaption>
          <h2>Fresh
            <span>Bubba</span>
          </h2>
          <p>Bubba likes to appear out of thin air.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Romeo</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-romeo">
        <img src="{{asset('public/images/gallery/17.png')}}" alt="img17" />
        <figcaption>
          <h2>Wild
            <span>Romeo</span>
          </h2>
          <p>Romeo never knows what he wants. He seemed to be very cross about something.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-romeo">
        <img src="{{asset('public/images/gallery/18.png')}}" alt="img18" />
        <figcaption>
          <h2>Wild
            <span>Romeo</span>
          </h2>
          <p>Romeo never knows what he wants. He seemed to be very cross about something.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Dexter</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-dexter">
        <img src="{{asset('public/images/gallery/19.png')}}" alt="img19" />
        <figcaption>
          <h2>Strange
            <span>Dexter</span>
          </h2>
          <p>Dexter had his own strange way. You could watch him training ants.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-dexter">
        <img src="{{asset('public/images/gallery/12.png')}}" alt="img12" />
        <figcaption>
          <h2>Strange
            <span>Dexter</span>
          </h2>
          <p>Dexter had his own strange way. You could watch him training ants.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Sarah</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-sarah">
        <img src="{{asset('public/images/gallery/13.png')}}" alt="img13" />
        <figcaption>
          <h2>Free
            <span>Sarah</span>
          </h2>
          <p>Sarah likes to watch clouds. She's quite depressed.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-sarah">
        <img src="{{asset('public/images/gallery/20.png')}}" alt="img20" />
        <figcaption>
          <h2>Free
            <span>Sarah</span>
          </h2>
          <p>Sarah likes to watch clouds. She's quite depressed.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Chico</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-chico">
        <img src="{{asset('public/images/gallery/15.png')}}" alt="img15" />
        <figcaption>
          <h2>Silly
            <span>Chico</span>
          </h2>
          <p>Chico's main fear was missing the morning bus.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-chico">
        <img src="{{asset('public/images/gallery/4.png')}}" alt="img04" />
        <figcaption>
          <h2>Silly
            <span>Chico</span>
          </h2>
          <p>Chico's main fear was missing the morning bus.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
  <div class="row">
    <h4 class="col s12">Milo</h4>
    <div class="col s12 m6 grid">
      <figure class="effect-milo">
        <img src="{{asset('public/images/gallery/11.png')}}" alt="img11" />
        <figcaption>
          <h2>Faithful
            <span>Milo</span>
          </h2>
          <p>Milo went to the woods. He took a fun ride and never came back.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
    <div class="col s12 m6 grid">
      <figure class="effect-milo">
        <img src="{{asset('public/images/gallery/3.png')}}" alt="img03" />
        <figcaption>
          <h2>Faithful
            <span>Milo</span>
          </h2>
          <p>Milo went to the woods. He took a fun ride and never came back.</p>
          <a href="#">View more</a>
        </figcaption>
      </figure>
    </div>
  </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('public/vendors/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('public/vendors/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('public/vendors/masonry.pkgd.min.js')}}"></script>
@endsection

{{-- -page script --}}
@section('page-script')
<script src="{{asset('public/js/scripts/media-hover-effects.js')}}"></script>
@endsection