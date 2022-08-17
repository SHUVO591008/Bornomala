<!DOCTYPE html>
<html lang="bn">
<head>
      @toastr_css 

     <style type="">
.skitter{
  max-width:width: 100%!important;
}

.skitter {

    max-width: 100%!important;
 
}
.skitter-large{
  width: 100%!important;
}
  .container_skitter{
    width: 100%!important;
  }
</style>
  <?php 
$logo = App\Model\Settings::first();

$HeaderLeft = App\Model\HeaderTopPosition::where('position','left')->get();
$HeaderRight = App\Model\HeaderTopPosition::where('position','right')->get();

$HeaderSocialLeft = App\Model\HeaderTopPosition::where('position','socialleft')->get();
$HeaderSocialRight = App\Model\HeaderTopPosition::where('position','socialright')->get();
$SocialFooter = App\Model\HeaderTopPosition::where('position','socialfooter')->get();
$Footer = App\Model\HeaderTopPosition::where('position','footer')->get();

$headers = App\Model\header::where('status',1)->latest()->limit(2)->get();

$newsScrollBar = App\Model\newsScrollBar::where('status',1)->first();
$news = App\Model\news::where('status',1)->latest()->get();


?>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Favicon-->
    <link style="height: 16px;width: 16px;" rel="shortcart icon" type="image/png" href="{{($logo==null)?'':asset($logo->favicon)}}">



     <!-- custom css -->
    <link rel="stylesheet" href="{{asset('Frontend/css/style.css')}}">
    <!-- Bootstrap link -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" href="{{asset('Frontend/css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="{{asset('Frontend/css/bootstrap.css')}}">
    
     <!-- fontawesome link -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!---dataTable-->
    <link rel="stylesheet" type="text/css" href="{{asset('Frontend/css/jquery.dataTables.min.css')}}" media="screen">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="{{asset('Frontend/js/jquery.dataTables.min.js')}}"></script>

    <!---dataTable end-->


    <!-- mid slider link -->
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=latin-ext,greek-ext,cyrillic-ext,greek,vietnamese,latin,cyrillic" rel="stylesheet" type="text/css" />
    
  <!-- toaster css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

 <!-- testimonial theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.css">
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
     <script> 
    $(document).ready(function(){
        $("#testimonial-slider").owlCarousel({
            items:1,
            itemsDesktop:[1000,1],
            itemsDesktopSmall:[979,1],
            itemsTablet:[768,1],
            pagination:true,
            navigation:false,
            navigationText:["",""],
            slideSpeed:1000,
            singleItem:true,
            transitionStyle:"fade",
            autoPlay:true
        });
    });
    </script>
  <!-- testimonial theme -->


      <!-- Skitter Styles -->
      <link href="{{asset('Backend/app-assets/css/skitter_slider/skitter.css')}}" type="text/css" media="all" rel="stylesheet" />

      <!-- Skitter JS -->
      <!-- <script src="{{asset('Backend/app-assets/css/skitter_slider/jquery-2.1.1.min.js')}}"></script> -->
      <script src="{{asset('Backend/app-assets/css/skitter_slider/jquery.easing.1.3.js')}}"></script>
      <script src="{{asset('Backend/app-assets/css/skitter_slider/jquery.skitter.min.js')}}"></script>


  <!-- Init Skitter -->
  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      $('.skitter-large').skitter({
        responsive: {
          small: {
            animation: 'fade',
            max_width: 768,
            suffix: '-small'
          },
          medium: {
            animation: 'directionRight',
            max_width: 1024,
            suffix: '-medium'
          }
        }
      });
    });
  </script>




   <!-- Skitter Custom -->
   <!--    <link href="{{asset('Backend/app-assets/css/skitter_slider/styles.css')}}" type="text/css" media="all" rel="stylesheet" />
      <script src="{{asset('Backend/app-assets/css/skitter_slider/app.js')}}"></script> -->


  <!-- gallary -->
    <link rel="stylesheet" media="screen" href="{{asset('Frontend/css/common.css')}}">
    <link rel="stylesheet" media="screen" href="{{asset('Frontend/css/reset.css')}}">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script> -->
    <script src="{{asset('Frontend/js/gallery.js')}}"></script>
    <script src="{{asset('Frontend/js/gallery.dev.js')}}"></script>
  <!-- gallary -->
  
  <script type="text/javascript">
      window.jssor_1_slider_init = function() {

          var jssor_1_SlideoTransitions = [
            [{b:-1,d:1,ls:0.5},{b:0,d:1000,y:5,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:200,d:1000,y:25,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:400,d:1000,y:45,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:600,d:1000,y:65,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:800,d:1000,y:85,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:500,d:1000,y:195,e:{y:6}}],
            [{b:0,d:2000,y:30,e:{y:3}}],
            [{b:-1,d:1,rY:-15,tZ:100},{b:0,d:1500,y:30,o:1,e:{y:3}}],
            [{b:-1,d:1,rY:-15,tZ:-100},{b:0,d:1500,y:100,o:0.8,e:{y:3}}],
            [{b:500,d:1500,o:1}],
            [{b:0,d:1000,y:380,e:{y:6}}],
            [{b:300,d:1000,x:80,e:{x:6}}],
            [{b:300,d:1000,x:330,e:{x:6}}],
            [{b:-1,d:1,r:-110,sX:5,sY:5},{b:0,d:2000,o:1,r:-20,sX:1,sY:1,e:{o:6,r:6,sX:6,sY:6}}],
            [{b:0,d:600,x:150,o:0.5,e:{x:6}}],
            [{b:0,d:600,x:1140,o:0.6,e:{x:6}}],
            [{b:-1,d:1,sX:5,sY:5},{b:600,d:600,o:1,sX:1,sY:1,e:{sX:3,sY:3}}]
          ];

          var jssor_1_options = {
            $AutoPlay: 1,
            $LazyLoading: 1,
            $CaptionSliderOptions: {
              $Class: $JssorCaptionSlideo$,
              $Transitions: jssor_1_SlideoTransitions
            },
            $ArrowNavigatorOptions: {
              $Class: $JssorArrowNavigator$
            },
            $BulletNavigatorOptions: {
              $Class: $JssorBulletNavigator$,
              $SpacingX: 20,
              $SpacingY: 20
            }
          };

          var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

          /*#region responsive code begin*/

          var MAX_WIDTH = 3000;

          function ScaleSlider() {
              var containerElement = jssor_1_slider.$Elmt.parentNode;
              var containerWidth = containerElement.clientWidth;

              if (containerWidth) {

                  var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                  jssor_1_slider.$ScaleWidth(expectedWidth);
              }
              else {
                  window.setTimeout(ScaleSlider, 30);
              }
          }

          ScaleSlider();

          $Jssor$.$AddEvent(window, "load", ScaleSlider);
          $Jssor$.$AddEvent(window, "resize", ScaleSlider);
          $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
          /*#endregion responsive code end*/
      };
  </script>
  <script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>

   <style>
    /* jssor slider loading skin spin css */
    .jssorl-009-spin img {
        animation-name: jssorl-009-spin;
        animation-duration: 1.6s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    @keyframes jssorl-009-spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }


    /*jssor slider bullet skin 132 css*/
    .jssorb132 {position:absolute;}
    .jssorb132 .i {position:absolute;cursor:pointer;}
    .jssorb132 .i .b {fill:#fff;fill-opacity:0.8;stroke:#000;stroke-width:1600;stroke-miterlimit:10;stroke-opacity:0.7;}
    .jssorb132 .i:hover .b {fill:#000;fill-opacity:.7;stroke:#fff;stroke-width:2000;stroke-opacity:0.8;}
    .jssorb132 .iav .b {fill:#000;stroke:#fff;stroke-width:2400;fill-opacity:0.8;stroke-opacity:1;}
    .jssorb132 .i.idn {opacity:0.3;}

    .jssora051 {display:block;position:absolute;cursor:pointer;}
    .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
    .jssora051:hover {opacity:.8;}
    .jssora051.jssora051dn {opacity:.5;}
    .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
  </style>

    <title>{{($logo==null)?'':$logo->name}}</title>
</head>
<body>




 <!-- header top -->
 <section class="header-top py-3 bg-dark">
  <div class="container">
    <div class="row">
    <div class="bottom_header_left col-md-6 col-7 bottom-social-icons">
      <p class="m-0 pt-2">

        @if($HeaderLeft->isNotEmpty())
          @foreach($HeaderLeft as $key)
            <span>
              <?php echo $key->headerModelposition->icon ?>  {{$key->headerModelposition->text}}<br>
            </span>
          @endforeach
        @endif

        @if($HeaderLeft->isNotEmpty() AND $HeaderSocialLeft->isNotEmpty())
          <br>
        @endif

        @if($HeaderSocialLeft->isNotEmpty())
          @foreach($HeaderSocialLeft as $key)
             <a class="{{$key->socialModelposition->name}}" href="{{$key->socialModelposition->url}}" target="_blank">
                <span><?php echo $key->socialModelposition->icon ?></span>
              </a>
          @endforeach
        @endif




      </p>
    </div>

    <div class="header-top-righ col-md-6 col-5">
      <div class="bottom-social-icons float-end">

       @if($HeaderRight->isNotEmpty())
         @foreach($HeaderRight as $key)
           <span>
              <?php echo $key->headerModelposition->icon ?>  {{$key->headerModelposition->text}}<br>
          </span>
          @endforeach
        @endif

         @if($HeaderRight->isNotEmpty() AND $HeaderSocialRight->isNotEmpty())
          <br>
        @endif

        @if($HeaderSocialRight->isNotEmpty())
          @foreach($HeaderSocialRight as $key)
             <a class="{{$key->socialModelposition->name}}" href="{{$key->socialModelposition->url}}" target="_blank">
                <span><?php echo $key->socialModelposition->icon ?></span>
              </a>
          @endforeach
        @endif

    

      </div>


    </div>
    </div>
  </div>
 </section>
 <!-- header top end -->

<!-- header-mid -->
<section class="header-mid">
  <div class="container">
    <!-- header row -->
   <div style="width: 100%;" class="row py-2 text-center">
       <!-- header -->

         <!-- logo -->
    <div class="col-4">
        <a class="nav-link" href="{{asset(route('home'))}}">
          <img class="logo" src="{{($logo==null)?'':asset($logo->logo)}}" alt="Logo">
        </a>
    </div>
        <!-- logo end-->
          @foreach($headers as $key)
             <div class="{{(count($headers)==1)?'col-8':'col-4'}}">
                <span class="flag text-success"><?php echo $key->icon?></span>
                <div class="success-div pt-3">
                    <h5 class="text-primary"><b>{{$key->title}}</b></h5>
                    <span>{{$key->text}}</span>
                    @if($key->author_name)
                      <author><br>------{{$key->author_name}}</author>
                    @endif
                    
                </div>
            </div>
          @endforeach    
   
        <!-- header end-->
   </div>
   <!-- header row end-->


</div>
</section>
<!-- header-mid end-->

<!-- nav-->
<section class="navbar-section" id="navbar-section">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark stroke">
      <div class="container">
        <button class="navbar-toggler" type="button"  aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('home') }}">হোম</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('upcoming') }}">আপকামিং ব্যাচসমূহ</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('teacher') }}">শিক্ষক পরিচিতি</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('about') }}">আমাদের সম্পর্কে..</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="gallery.html">ছবি</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('contact')}}">যোগাযোগ</a>
            </li>



          </ul>

          <ul class="navbar-nav">

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="login.html"><i class="fas fa-sign-in-alt"></i>  লগইন</a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">|</a>
              </li>

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="registration.html"><i class="fas fa-user-plus"></i>  সাইন আপ</a>
              </li>



          </ul>

        </div>

      </div>
  </nav>
</section>
<!-- nav end-->

@if(!is_null($newsScrollBar))
<!--marquee-->
<section class="marquee-section bg-warning py-2">
  <div class="container">
    <div class="row">
      <div class="col-1 pt-1"><h6 class="fw-bold">News:</h6></div>
      <div class="col-11">
        <marquee onMouseOver="this.stop()" onMouseOut="this.start()">
        @foreach($news as $key)
          <a {{(!is_null($key->url))?'target="_blank"':''}}  href="{{$key->url}}">{{$key->title}}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endforeach
        </marquee>
      </div>
    </div>
  </div>
</section>
<!--marquee-->
@endif

@yield('content')


<!---footer-->
<section class="footer-section">
  <footer class="container">
    <div class="row">
      <div class="col-12 text-center">
        <ul class="list-ul p-5 m-0">
          @if($SocialFooter->isNotEmpty())
              @foreach($SocialFooter as $key)
                  <li class="list-li m-4">
                    <a target="_blank" href="{{$key->socialModelposition->url}}"><?php echo $key->socialModelposition->icon ?></a>
                  </li>
              @endforeach
          @endif
        </ul>
      </div>
      <div class="col-4 footer-link-part">
        <h3 class="text-warning"><u>কিছু গুরুত্বপূর্ণ লিঙ্কঃ</u></h3>
        <ul class="p-0">
          <li class="nav-item"><a class="nav-link text-light ps-0" href="#">স্টুডেন্ট রেজিস্ট্রেশন</a></li>
          <li class="nav-item"><a class="nav-link text-light ps-0" href="#">ক্লাস ভিডিও</a></li>
          <li class="nav-item"><a class="nav-link text-light ps-0" href="#">পেমেন্ট পদ্ধতি</a></li>
          <li class="nav-item"><a class="nav-link text-light ps-0" href="gallery.html">ছবি</a></li>

        </ul>

      </div>
      <div class="col-4 footer-link-part">
        <h3 class="text-warning"><u>টার্মস এন্ড পলিসি</u></h3>
        <ul class="p-0">
          <li class="nav-item"><a class="nav-link text-light ps-0" href="#">প্রাইভেসী পলিসি</a></li>
          <li class="nav-item"><a class="nav-link text-light ps-0" href="policy.html">টার্মস এন্ড কন্ডিশনস</a></li>
          <!-- <li class="nav-item"><a class="nav-link text-light ps-0" href="#">ডিসক্লেইমার</a></li> -->


        </ul>
      </div>
      <div class="col-4 footer-link-part">
        <h3 class="text-warning"><u>যোগাযোগ</u></h3>
        <ul class="p-0">
         @if($Footer->isNotEmpty())
            @foreach($Footer as $key)
             
              <li class="text-light nav-link ps-0">
                <?php echo $key->headerModelposition->icon ?> 
                <span class="ms-2"></span>{{$key->headerModelposition->text}}
              </li>

            @endforeach
          @endif
        </ul>
      </div>

    </div>
  </footer>
    <!-- footer-button-info -->
    <div class="footer-middle-thanks text-center py-5">
      <h2>Thanks For watching</h2>
    </div>
    <!-- footer-button-info -->
<!---copyright-->
   <div class="col-12 copyright py-3 text-center">
    <span class="text-light">Copyright 2020 Bornomala.<a target="_blank" class="text-warning" href="https://web.facebook.com/subratanath.shuvo1998"> Designed by SHUVO</a> All rights reserved.</span>
  </div>
<!---copyright end-->
</section>
<!---footer end-->




</body>




<script>
    $(function() {

    $('.replybutton').on('click', function() {
    $('.replybox').hide();
    var commentboxId= $(this).attr('data-commentbox');

    $('#'+commentboxId).toggle();
    });

    $('.cancelbutton').on('click', function() {
    $('.replybox').hide();
    });

    });
</script>

<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>

<!---nav toggle-->
<script>
  $('.navbar-toggler').click(function(){
    $(".navbar-collapse").toggle(1000);
  });
</script>
<!---nav toggle end-->

<!-- Bootstrap js link -->
<!-- <script src="{{ asset('Frontend/js/bootstrap.js') }}"></script> -->
<script src="{{ asset('Frontend/js/bootstrap.min.js') }}"></script>
<!-- custom js link -->
 <script src="{{ asset('Frontend/js/script.js') }}"></script>

 <!-- jquery link -->
 <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->

 <!--mid slider link -->
 <script src="{{ asset('Frontend/js/jssor.slider-28.0.0.min.js') }}" type="text/javascript"></script>

  <!-- stats numscroller-js-file -->
   <script src="{{ asset('Frontend/js/numscroller-1.0.js') }}"></script>
   <!-- //stats numscroller-js-file -->



 <script type="text/javascript">jssor_1_slider_init();
 </script>

<!-- Flexslider-js for-testimonials -->

<!-- //Flexslider-js for-testimonials -->

  <!-- smooth scrolling -->
  <script src="{{ asset('Frontend/js/SmoothScroll.min.js') }}"></script>
  <script src="{{ asset('Frontend/js/move-top.js') }}"></script>
  <script src="{{ asset('Frontend/js/easing.js') }}"></script>
  <!-- here stars scrolling icon -->
  <script>
    $(document).ready(function () {
      /*
        var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear'
        };
      */

      $().UItoTop({
        easingType: 'easeOutQuart'
      });

    });
  </script>
  <!-- //here ends scrolling icon -->
  <!-- smooth scrolling -->
  <!-- //js-files -->
  

  <!-- gallary-->
  <script>
    var gallery_init = {
      group : ['Buildings', 'Landscapes', 'Beaches', 'Lamborghinis'],
      //set_svg_color : '#ff6666',
      //set_image_hover_transparency : false
    };

    $(gallery.construct(gallery_init));
    </script>
<!-- gallary-->

<script src="{{ asset("Backend/app-assets/js/scripts/ui-alerts.min.js")}}"></script>

  <!-- toaster js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>

  @toastr_js
@toastr_render

 </html>

