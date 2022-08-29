@extends('layouts.FrontendLayout')

@section('content')

<?php
use App\Model\gallery;

$gallery = gallery::orderBy('id','desc')->get();




?>

<style>
    .js-gallery div{
        border: 1px solid #708090;
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
            <li>ছবি</li>
        </ul>
    </div>
</div>
<!-- //short-->




<!-- gallary-->
<section class="gallary-section pt-5">
    <div class="container">
        <div class="title-div">
            <h3 class="title text-center fw-bold">
              <span>ছ</span>বি
            </h3>
            <div class="title-style"></div>
          </div>
          <div style="width: 100%;" id="frame">
            <div class="gallery js-gallery">

                 @foreach($gallery as $image)
                    <div>
                       <h1>{{$image->group_name}}</h1>
                        <a  href="{{ asset($image->image)}}" rel="{{$image->slug}}" title="{{$image->group_name}}">
                            <img class="mt-3" src="{{ asset($image->image)}}?h=200">
                        </a>
                    </div>
                @endforeach


              
            </div>
        </div>
    </div>
</section>
<!-- //gallary-->

  <!-- gallary-->
  <script>
    var gallery_init = {

      group : [
        @foreach($gallery as $image)
          '<?php echo $image->slug?>',
        @endforeach
      ],
      set_svg_color : '#ff6666',
      set_image_hover_transparency : false
    };

    $(gallery.construct(gallery_init));
    </script>
<!-- gallary-->

@endsection