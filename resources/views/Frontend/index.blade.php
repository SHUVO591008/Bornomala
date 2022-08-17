@extends('layouts.FrontendLayout')

@section('content')
<?php 



$slider = App\Model\slider::where('status',1)->latest()->get();
$about = App\Model\about::where('status',1)->first();
$services = App\Model\service::where('status',1)->get();
$instituteDetails = App\Model\instituteDetails::where('status',1)->get();


?>

@if($slider->isNotEmpty())
<!---mid slider-->
<section id="content" class="slider-section">
 <div class="skitter-large-box">
    <div class="skitter skitter-large with-dots">
      <ul>

		@foreach($slider as $key)
        <li>
        	<a href="#{{$key->style}}">
        		<img src="{{asset($key->image)}}" class="{{$key->style}}" />
        	</a>
        	<div class="label_text">
        		<p>{{$key->text}}
        			<!-- <a href="#" class="btn btn-small btn-yellow">See more</a> -->
        		</p>
        	</div>
        </li>
		@endforeach
    

       
      </ul>
    </div>
  </div>
</section>
<!---mid slider end-->

@endif


@if(!is_null($about))

<!---about section-->
<section class="banner-bottom-section about" id="about">
  <div class="container">
   
      <div class="title-div">
        <h3 class="title text-center fw-bold">
          <span>স্বা</span>গতম
        </h3>
        <div class="title-style"></div>
      </div>
  
      <div class="welcome-sub-wthree row">
        <div class="col-md-6 banner_bottom_left pe-5">
          <h4 class="fs-md-1">আমাদের
            <span>সম্পর্কে</span>
          </h4>
  
          <p>{{$about->title}}</p>
         	<?php echo $about->text?>
        </div>
  
      <!-- Stats-->
     
				<div style=" background: url('{{asset($about->image)}}') no-repeat center;" class="col-md-6 stats-info-agile">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-xl-6 col-xxl-6 col-6 col-md-6 stats-grid stat-border">
                <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='768' data-delay='.5' data-increment="1">768</div>
                <p>বর্তমান শিক্ষার্থী</p>
              </div>
              <div class="col-sm-6 col-xl-6 col-xxl-6 col-6 col-md-6 stats-grid">
                <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='678' data-delay='.5' data-increment="1">678</div>
                <p>অনুমোদিত কোর্স</p>
              </div>
              <div class="clearfix"></div>
            </div>
              <div class="child-stat row">
                
                <div class="col-sm-6 col-xl-6 col-xxl-6 col-6 col-md-6 stats-grid stat-border border-st2">
                  <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='800' data-delay='.5' data-increment="1">800</div>
                  <p>শিক্ষক</p>
                </div>
                <div class="col-sm-6 col-xl-6 col-xxl-6 col-6 col-md-6 stats-grid">
                  <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='485' data-delay='.5' data-increment="1">485</div>
                  <p>সন্তুষ্ট শিক্ষার্থী</p>
                </div>
                <div class="clearfix"></div>
    
    
              </div>
          </div>
				</div>
			
      <!-- //Stats -->
    </div>


  </div>
</section>
<!---about section end-->
@endif

@if($services->isNotEmpty())
<!---service section -->
<section class="service-section">
	<div class="services">
		<div class="container">
			<div class="title-div">
				<h3 class="title">
					<span>আ</span>মাদের
					<span>সেবা</span>সমূহ
				</h3>
				<div class="title-style">

				</div>
			</div>

			<div class="services-moksrow row">
			@foreach($services as $key)
				<div class="col-4 services-grids-w3l mt-xxl-0 mb-4">
					<div class="servi-shadow">
						<span class="icon" aria-hidden="true">
							<?php echo $key->icon?>
						</span>

						<h4>{{$key->title}}</h4>
						<p>{{$key->slogan}}</p>
					</div>
				</div>
				@endforeach
			</div>

</section>
<!---service section  end-->
@endif

<!---news section -->
<!---<section class="news-section">
	<div class="news" id="news">
		<div class="container">
			<div class="title-div">
				<h3 class="title text-center">
					<span>আ</span>মাদের
					<span>ই</span>ভেন্টস
				</h3>
				<div class="title-style">

				</div>
			</div>
			<div class="news-grids-agile">
				<div class="news-grid row">
					<div class="col-6 news-left row">
						<div class="col-6 news-left-img">
							<div class="news-left-text color-event1">
								<h5>২০ ডিসেম্বর</h5>
							</div>
						</div>
						<div class="col-6 news-grid-info-bottom-w3ls">
							<div class="news-left-top-text text-color1">
								<a href="#" data-bs-toggle="modal" data-bs-target="#myModal">ইভেন্টসের নাম লিখুন।</a>
							</div>
							<div class="date-grid">
								<div class="admin">
									<a href="#">
										<span class="fa fa-clock-o" aria-hidden="true"></span> ৭:০০ সন্ধ্যা - ৯:০০ সন্ধ্যা</a>
								</div>
								<div class="time">
									<p>
										<span class="fa fa-map-marker" aria-hidden="true"></span>আগ্রাবাদ,চট্টগ্রাম, ২৫৮৯</p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="news-grid-info-bottom-w3ls-text">
								<p>ইভেন্টস সম্পর্কে ছোট করে কিছু লিখুন ।</p>
							</div>
						</div>
						<div class="clearfix"> </div>
          </div>
          
					<div class="col-6 news-left news-left-top row">
						<div class="col-6 news-left-img news-left-img1">
							<div class="news-left-text color-event2">
								<h5>২৭ ডিসেম্বর</h5>
							</div>
						</div>
						<div class="col-6 news-grid-info-bottom-w3ls">
							<div class="news-left-top-text text-color2">
								<a href="#" data-bs-toggle="modal" data-bs-target="#myModal">ইভেন্টসের নাম লিখুন।</a>
							</div>
							<div class="date-grid">
								<div class="admin">
									<a href="#">
										<span class="fa fa-clock-o" aria-hidden="true"></span>৭:০০ সন্ধ্যা - ৯:০০ সন্ধ্যা</a>
								</div>
								<div class="time">
									<p>
										<span class="fa fa-map-marker" aria-hidden="true"></span> আগ্রাবাদ,চট্টগ্রাম, ২৫৮৯</p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="news-grid-info-bottom-w3ls-text">
								<p>ইভেন্টস সম্পর্কে ছোট করে কিছু লিখুন ।</p>
							</div>
						</div>
						<div class="clearfix"> </div>
          </div>
          
					<div class="clearfix"> </div>
        </div>
        
				<div class="news-grid row">
					<div class="col-6 news-left news-left-top row">
						<div class="col-6 news-left-img news-left-img2">
							<div class="news-left-text color-event3">
								<h5>২৮ ডিসেম্বর</h5>
							</div>
						</div>
						<div class="col-6 news-grid-info-bottom-w3ls">
							<div class="news-left-top-text text-color3">
								<a href="#" data-bs-toggle="modal" data-bs-target="#myModal">ইভেন্টসের নাম লিখুন।</a>
							</div>
							<div class="date-grid">
								<div class="admin">
									<a href="#">
										<span class="fa fa-clock-o" aria-hidden="true"></span> ৯:০০ সকাল - ১০:০০ সকাল</a>
								</div>
								<div class="time">
									<p>
										<span class="fa fa-map-marker" aria-hidden="true"></span>বোয়ালখালী,চট্টগ্রাম, ২৫৮৯</p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="news-grid-info-bottom-w3ls-text">
								<p>ইভেন্টস সম্পর্কে ছোট করে কিছু লিখুন ।</p>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-6 news-left news-left-top row">
						<div class="col-6 news-left-img news-left-img3">
							<div class="news-left-text color-event4">
								<h5>৩০ ডিসেম্বর</h5>
							</div>
						</div>
						<div class="col-6 news-grid-info-bottom-w3ls">
							<div class="news-left-top-text text-color4">
								<a href="#" data-bs-toggle="modal" data-bs-target="#myModal">ইভেন্টসের নাম লিখুন।</a>
							</div>
							<div class="date-grid">
								<div class="admin">
									<a href="#">
										<span class="fa fa-clock-o" aria-hidden="true"></span> ৭:০০ সকাল - ১০:০০ সকাল</a>
								</div>
								<div class="time">
									<p>
										<span class="fa fa-map-marker" aria-hidden="true"></span> বোয়ালখালী,চট্টগ্রাম, ৭৬৮</p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="news-grid-info-bottom-w3ls-text">
								<p>ইভেন্টস সম্পর্কে ছোট করে কিছু লিখুন ।</p>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
        </div>
        
			</div>
		</div>
	</div>
	<!-- modal -->
	<!-- <div class="modal about-modal fade" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">

         <h4 class="modal-title">ইভেন্টসের
						<span> নাম লিখুন।</span>
          </h4>
          
          <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="model-img-info">
						<img src="image/img/e1.jpg" alt="" />
						<p>২০১৪ সালের শুরুর দিকে প্রতিষ্ঠা করা হয় বর্ণমালা।
              মূলত শিক্ষার জ্ঞান মানুষের মাঝে ছড়িয়ে দেয়ার উদ্দেশ্য তৈরি হয়েছিল এই ওয়েবসাইটটি। 
              ২০১৪ সালের শুরুর দিকে প্রতিষ্ঠা করা হয় বর্ণমালা।
              মূলত শিক্ষার জ্ঞান মানুষের মাঝে ছড়িয়ে দেয়ার উদ্দেশ্য তৈরি হয়েছিল এই ওয়েবসাইটটি। 
              ২০১৪ সালের শুরুর দিকে প্রতিষ্ঠা করা হয় বর্ণমালা।
              মূলত শিক্ষার জ্ঞান মানুষের মাঝে ছড়িয়ে দেয়ার উদ্দেশ্য তৈরি হয়েছিল এই ওয়েবসাইটটি।
               ২০১৪ সালের শুরুর দিকে প্রতিষ্ঠা করা হয় বর্ণমালা।মূলত শিক্ষার জ্ঞান মানুষের মাঝে ছড়িয়ে দেয়ার উদ্দেশ্য তৈরি হয়েছিল এই ওয়েবসাইটটি।
                ২০১৪ সালের শুরুর দিকে প্রতিষ্ঠা করা হয় বর্ণমালা।
              মূলত শিক্ষার জ্ঞান মানুষের মাঝে ছড়িয়ে দেয়ার উদ্দেশ্য তৈরি হয়েছিল এই ওয়েবসাইটটি। </p>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- //modal -->
<!---</section>-->
<!---news section end-->

@include('layouts.middle-section')

<!-- testimonials -->
<section class="testimonials-section py-5"> 
  <div class="container py-5">

    <div class="title-div">
      <h3 class="title text-center">
        <span>আ</span>মাদের 
        <span>শি</span>ক্ষার্থীদের
        <span>কিছু</span>মন্তব্য
      </h3>
      <div class="title-style"></div>
    </div>

      <div class="row">
          <div class="offset-md-3 col-md-6">
              <div id="testimonial-slider" class="owl-carousel">
                  <div class="testimonial">
                      <div class="pic">
                          <img src="{{asset('Frontend/image/img/person-2.jpg')}}" alt=""/>
                      </div>
                      <h3 class="testimonial-title">
                          রাইহান<small>,শিক্ষার্থী</small>
                      </h3>
                      <p class="description">
                        শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।
                        শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।
                      </p>
                  </div>

                  <div class="testimonial">
                      <div class="pic">
                          <img src="{{asset('Frontend/image/img/Sam-Revilter.jpg')}}" alt=""/>
                      </div>
                      <h3 class="testimonial-title">
                          শিমুল<small>, শিক্ষার্থী</small>
                      </h3>
                      <p class="description">
                        শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।
                        শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।
                      </p>
                  </div>

                  <div class="testimonial">
                      <div class="pic">
                          <img src="{{asset('Frontend/image/img/team4-large.jpg')}}" alt=""/>
                      </div>
                      <h3 class="testimonial-title">
                          মাইকেল<small>, শিক্ষার্থী</small>
                      </h3>
                      <p class="description">
                        শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।
                        শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।শিক্ষার্থীদের কিছু মন্তব্য দেওয়া হল।
                      </p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- //testimonials -->


@endsection

