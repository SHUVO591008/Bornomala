@extends('layouts.FrontendLayout')

@section('content')
<?php
use App\Model\termscondition;

$termscondition = termscondition::get();


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
            <li>Terms and conditions</li>
        </ul>
    </div>
</div>
<!-- //short-->

@if($termscondition->isNotEmpty())
<!--policy-->
<section class="policy-section">
    <div class="container pt-5">
        <div class="title-div">
            <h3 class="title text-center fw-bold">
                 Terms and conditions
            </h3>
            <div class="title-style"></div>
          </div>

          
            @foreach($termscondition as $key)
            <div class="policy pb-5">
                <?php echo $key->text?>
            </div>
            @endforeach
          

          
    </div>
</section>
<!--policy end-->
@endif


@endsection