@extends('layouts.FrontendLayout')

@section('content')

<?php
$qus = App\Model\qusAndans::where('status',1)->get();
$SocialShare = App\Model\SocialShare::where('status',1)->get();
$name = App\Model\settings::first();
$AdminDetails = App\Model\AdminDetails::where('status',1)->first();



$sl = 0;





?>

<style>
    
.share {
    font-size: 13px;
    font-weight: 700;
    padding: 8px;
    float: right;
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
            <li>আমাদের সম্পর্কে</li>
        </ul>
    </div>
</div>
<!-- //short-->

<!-- qus-section -->
<section class="qus-section">
    <div class="qus">
        <div class="container">
            @if($qus->isNotEmpty())
            <div style="margin-bottom: 35px;" class="title-div pb-5 pt-5">
                <h3 class="title text-center fw-bold">
                    <span>আ</span>মাদের
                    <span>স</span>ম্পর্কে  <span>স</span>চরাচর <span>জি</span>জ্ঞাসিত <span>প্র</span>শ্নাবলি
                </h3>
                <div class="title-style">
                </div>
            </div>
           
            <div class="row accordion" id="accordionExample">
                <div class="col-12">
                    @foreach($qus as $key)
                        <?php $sl++ ?>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default accordion-item">
                                <div class="panel-heading" role="tab" id="heading{{ $sl }}">
                                    <h4 class="panel-title">
                                        
                                        <a class="{{ ($sl==1)?'':'collapsed'}}" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample{{ $sl }}"  role="button" aria-expanded="false" aria-controls="multiCollapseExample{{ $sl }}">প্রশ্নঃ{{$key->qus}}</a>
                                    </h4>
                                </div>
                                <div class="{{ ($sl==1)?'show':'collapse'}}" id="multiCollapseExample{{ $sl }}" class="accordion-collapse collapse" role="{{ ($sl==1)?'':'tabpanel'}}" aria-labelledby="heading{{ $sl }}" data-bs-parent="#accordionExample">
                                    <div class="panel-body">
                                        <?php echo $key->ans?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    @endforeach


            <p class="pb-3 text-dark qus-p">
               এই ছিল সাধারণত 
               {{$name->name}}
                নিয়ে করা কিছু কমন প্রশ্ন এবং তার উত্তর।
               এই প্রশ্নগুলো সব সময় আপডেট করা হয়,যদি এর পরেও 
               আমাদের নিয়ে আপনার মনে কোন প্রশ্ন জেগে থাকে তাহলে অনুগ্রহ করে
                <a target="_blank" href="#">এখানে ক্লিক করে</a>
                 আমাদের জানান।
            </p>
    @endif

        @if($SocialShare->isNotEmpty())


            <p class="fw-bold text-dark social-p pt-3">
             নিচের বাটন থেকে এক ক্লিকে বন্ধুর সাথে শেয়ার করুনঃ - 
             @foreach($SocialShare as $key)

                  

                    @if($key->name=='facebook')

                    <?php
                    $facebook  = Share::page($key->url, $key->title)
                        ->facebook()
                        ->getRawLinks();
                    ?>


                    <a style="text-transform: uppercase;" class="btn btn-primary btn-sm mb-3" href="{{$facebook}}" target="_blank"><i style="font-size: 32px;" class="fa-brands fa-facebook-square"></i> 
                        <span class="share">{{$key->name}}</span>
                        </a>

                    @elseif($key->name=='twitter')

                     <?php
                    $twitter  = Share::page($key->url, $key->title)
                        ->twitter()
                        ->getRawLinks();
                    ?>


                     <a style="text-transform: uppercase;" class="btn btn-primary btn-sm mb-3" href="{{$twitter}}" target="_blank"><i  style="font-size: 32px;" class="fa-brands fa-twitter-square"></i>
                        <span class="share">{{$key->name}}</span>
                        </a>

                    @elseif($key->name=='linkedin')

                     <?php
                    $linkedin  = Share::page($key->url, $key->title)
                        ->linkedin()
                        ->getRawLinks();
                    ?>


                    
                     <a style="text-transform: uppercase;" class="btn btn-primary btn-sm mb-3" href="{{$linkedin}}" target="_blank">
                        <i style="font-size: 32px;" class="fa-brands fa-linkedin"></i>


                        <span class="share">{{$key->name}}</span>
                    </a>


                      @elseif($key->name=='whatsapp')

                     <?php
                    $whatsapp  = Share::page($key->url, $key->title)
                        ->whatsapp()
                        ->getRawLinks();
                    ?>


                    
                     <a style="text-transform: uppercase;" class="btn btn-success btn-sm mb-3" href="{{$whatsapp}}" target="_blank">
                        <i style="font-size: 32px;" class="fa-brands fa-whatsapp-square"></i>

                        <span class="share">{{$key->name}}</span>
                    </a>



                    @endif

                  

             @endforeach
            </p>
        @endif

        @if($AdminDetails)
            <div class="card mb-5 mt-5 col-12">
              <div class="row g-0">
                <div class="col-md-2 mt-4">
                 
                @if($AdminDetails->user->image)
                    <img class="rounded-circle img-responsive mx-auto" src="{{asset($key->user->image)}}" alt="">
                @else
                    <img class="rounded-circle img-responsive mx-auto" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                @endif
                </div>
                <div class="col-md-10">
                  <div class="card-body">
                    <h3 class="card-title text-dark fw-bold pb-3 text-md-start text-center">
                    @if($AdminDetails->name)
                        {{$AdminDetails->name}} 
                    @else
                        {{$AdminDetails->user->first_name}} {{$AdminDetails->user->last_name}} (এডমিন)
                    @endif
                    </h3>
                    <hr>
                    <p class="card-text text-dark">
                        <?php echo $AdminDetails->text?>
                    </p>
                    
                  </div>
                </div>
              </div>
            </div>

            <hr>
        @endif

        </div>
    </div>
</section>
<!-- //about-section-->


<!---middle section -->
@include('layouts.middle-section')
<!---middle section end-->



@endsection