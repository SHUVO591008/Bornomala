@extends('layouts.FrontendLayout')

@section('content')
<?php
use App\Model\privacypolicy;

$privacypolicy = privacypolicy::get();


?>


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
            <li>প্রাইভেসী পলিসি</li>
        </ul>
    </div>
</div>
<!-- //short-->

@if($privacypolicy->isNotEmpty())
<!--policy-->
<section class="policy-section">
    <div class="container pt-5">
        <div class="title-div">
            <h3 class="title text-center fw-bold">
             শর্তাবলি এবং প্রাইভেসি পলিসি
            </h3>
            <div class="title-style"></div>
          </div>

          
            @foreach($privacypolicy as $key)
            <div class="policy pb-5">
                <?php echo $key->text?>
            </div>
            @endforeach
          

          
    </div>
</section>
<!--policy end-->
@endif


@endsection