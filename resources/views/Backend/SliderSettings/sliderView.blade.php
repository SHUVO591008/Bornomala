<!DOCTYPE html>
<html lang="bn">
<head>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link style="height: 16px;width: 16px;" rel="shortcart icon" type="image/png" href="{{asset('Frontend/image/favicon/fav.jpg')}}">

    <link rel="stylesheet" href="{{asset('Frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('Frontend/css/bootstrap.css')}}">

 
   <!-- Skitter Styles -->
      <link href="{{asset('Backend/app-assets/css/skitter_slider/skitter.css')}}" type="text/css" media="all" rel="stylesheet" />

      <!-- Skitter JS -->
      <script src="{{asset('Backend/app-assets/css/skitter_slider/jquery-2.1.1.min.js')}}"></script>
      <script src="{{asset('Backend/app-assets/css/skitter_slider/jquery.easing.1.3.js')}}"></script>
      <script src="{{asset('Backend/app-assets/css/skitter_slider/jquery.skitter.min.js')}}"></script>

         <!-- fontawesome link -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- Init Skitter -->
  <script type="text/javascript" language="javascript">
    $(document).ready(function() {

      $('.skitter-large').skitter({
      	preview: false,
      	interval:2500,
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
      <link href="{{asset('Backend/app-assets/css/skitter_slider/styles.css')}}" type="text/css" media="all" rel="stylesheet" />
      <script src="{{asset('Backend/app-assets/css/skitter_slider/app.js')}}"></script>

    <title>Bornomala Dashboard</title>
</head>
<body>


	<!---mid slider-->
	<div class="container mt-5">
		<div class="col-12">
			<h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;font-size: 20px;font-weight: 700;" class="General card-title ">Slider Settings Preview</h4>
         </div>
		<div class="row">

			<section id="content" class="slider-section col-md-12">
			<div class="skitter-large-box">
			<div class="skitter skitter-large with-dots">
			  <ul>

			    <li>
			    	<a href="#{{$data->style}}">
			    	<img src="{{asset($data->image)}}" class="{{$data->style}}" />
			    	</a>
			    	<div class="label_text">
				    	<p>{{$data->text}}

				    		<!-- <a href="#see-more" class="btn btn-small btn-yellow">See more</a> -->
				    	</p>
			        </div>
			    </li>

			     <li>
			    	<a href="#{{$data->style}}">
			    	<img src="{{asset($data->image)}}" class="{{$data->style}}" />
			    	</a>
			    	<div class="label_text">
				    	<p>{{$data->text}}

				    		<!-- <a href="#see-more" class="btn btn-small btn-yellow">See more</a> -->
				    	</p>
			        </div>
			    </li>


			

			  </ul>
			</div>
			</div>


 					

			</section>
			<div class="col-md-2">
					<a style="display:block;" class="btn btn-success" href="{{route('slider.add')}}">
						<i style="font-size:15px!important;margin-right: 11px!important;" class="fa-solid fa-arrow-left mr-2"></i>
					Back</a>
			</div>
		</div>
	</div>
<!---mid slider end-->





</body>

<!-- Bootstrap js link -->
<script src="{{ asset('Frontend/js/bootstrap.js') }}"></script>
<script src="{{ asset('Frontend/js/bootstrap.min.js') }}"></script>

 </html>

