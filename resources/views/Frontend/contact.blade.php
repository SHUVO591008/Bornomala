@extends('layouts.FrontendLayout')

@section('content')

<?php
$sl = 0;

$ContactDetails = App\Model\ContactDetails::where('status',1)->get();
$socialContact = App\Model\socialContact::where('status',1)->get();
$Footer = App\Model\HeaderTopPosition::where('position','footer')->get();




?>

<style>
	p {
  margin-top: 0;
  margin-bottom: 1rem;
}


.gradient-45deg-amber-amber {
    background: -webkit-linear-gradient(45deg,#ff6f00,#ffca28)!important;
    background: linear-gradient(45deg,#ff6f00,#ffca28)!important;
}

.card-alert .card-content {
    padding: 10px 20px;
}



li {
    list-style: decimal;
}

.card-alert button {
    font-size: 20px;
    position: absolute;
    top: 5px;
    right: 10px;
    color: #fff;
    border: none;
    background: 0 0;
}

[type=reset], [type=submit], button, html [type=button] {
    cursor: pointer;
    -webkit-appearance: none;
}
</style>



<!---Bannar section -->
@include('Frontend.bannar')
<!---Bannar section end-->

<!-- short -->
<div class="services-breadcrumb">
    <div class="inner_breadcrumb">
        <ul class="short_ls">
            <li>
                <a href="{{route('home')}}">হোম</a>
                <span>| |</span>
            </li>
            <li>যোগাযোগ</li>
        </ul>
    </div>
</div>
<!-- //short-->



<!-- contact -->
<section class="contact-section">
    <div class="contact">
        <div class="container">
            <div class="title-div">
                <h3 class="title text-center">
                    <span>
                        যো</span>গাযোগ
                </h3>
                <div class="title-style">

                </div>
            </div>
            @if($ContactDetails->isNotEmpty())
                @foreach($ContactDetails as $key)
                    <div class="contact-row row">
                        <div class="col-md-6 contact-text1">
                            <h4 class="fw-bold">
                                {{$key->title}}
                            </h4>
                           
                               <?php echo $key->text?>
                           
                        @if($socialContact->isNotEmpty())
                            <p class="fw-bold text-dark social-p">
                                সোশ্যাল মিডিয়ায় আমাদের গ্রুপ - 
                                @foreach($socialContact as $val)
                                    <a class="btn btn-success btn-sm" href="{{$val->url}}" target="_blank">{{$val->name}}</a>
                                @endforeach
                            </p>
                        @endif


                        </div>
                        <div class="col-md-6 contact-w3lsright">
                          
                          <div class="mapouter">
                            <div class="gmap_canvas">

                              <?php echo $key->map ?> 

                              
                            

                              <a href="https://embedgooglemap.net/maps/63"></a>

                              <br>

                              <style>.mapouter{position:relative;text-align:right;height:607px;width:612px;}</style>
                              <a href="https://www.embedgooglemap.net">custom google map embed</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:607px;width:612px;}
                            </style>

                            </div>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>




    <div style="margin-bottom: 0em;" class="contact-lsleft">
        <div class="container">
            <div class="address-grid">

            @if($Footer->isNotEmpty())
                <h4>যোগাযোগের ঠিকানা</h4>
                <ul class="w3_address">
                    @foreach($Footer as $key)
                        <li>
                             <?php echo $key->headerModelposition->icon ?> 
                           <span class=""></span>{{$key->headerModelposition->text}}
                        </li>
                    @endforeach

                 

                </ul>
            @endif

            </div>
            <div class="contact-grid agileits">
                <h4>যোগাযোগ করুন</h4>
                  <!-- warning msg show -->
                    @if($errors->any())
                       <div class="mt-5 mb-5 card-alert card gradient-45deg-amber-amber">
                        <div class="card-content white-text">
                          <p>
                            <i class="fa-solid fa-circle-exclamation">warning</i></p>
                            <ul>
                                <ol>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ol>
                            </ul>
                        </div>

                        <button type="button" class="close white-text btn btn-success" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                    @endif
                <!-- warning msg show End-->

                <form id="userContact" action="{{route('contact.store')}}" method="post">
                    @csrf
                    <div class="">
                        <input id="name" type="text" name="name" placeholder="নাম" required>
                    </div>
                    <div class="">
                        <input id="email" type="email" name="email" placeholder="ইমেল" required>
                    </div>
                    <div class="">
                        <input id="number" type="text" name="number" placeholder="ফোন নাম্বার" required>
                    </div>
                    <div class="">
                        <textarea id="Message" name="message" placeholder="মেসেজ..." required></textarea>
                    </div>
                    <input type="submit" value="সাবমিট">
                </form>


            </div>
        </div>
    </div>
</section>
<!-- //contact -->


@endsection