@extends('layouts.FrontendLayout')

@section('content')

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
            <li>শিক্ষক পরিচিতি</li>
        </ul>
    </div>
</div>
<!-- //short-->


<!-- teacher -->
<section class="teacher-section">
    <div class="team">
        <div class="container">
            <div style="margin-bottom: 35px;" class="title-div pb-5">
                <h3 class="title text-center fw-bold">
                    <span>আ</span>মাদের
                    <span>শি</span>ক্ষক
                </h3>
                <div class="title-style">

                </div>
            </div>
            <div class="team-row-agileinfo row">

                <div class="col-md-3 col-xl-3 team-grids">
                    <div  class="thumbnail team-agileits position-relative">
                        <div class="hover-effected">
                            <ul class="list-ul">
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{asset('Frontend/image/img/t1.jpg')}}" class="img-responsive" alt="" />
                        <div class="effectd-caption">
                            <h4>Shimul Nath</h4>
                            <p>English Teacher</p>
                            <a href="teacherDetails.html" class="btn btn-outline-primary">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-xl-3 team-grids">
                    <div class="thumbnail team-agileits position-relative">
                        <div class="hover-effected">
                            <ul class="list-ul">
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{asset('Frontend/image/img/t2.jpg')}}" class="img-responsive" alt="" />
                        <div class="effectd-caption">
                            <h4>Jark Kohnson</h4>
                            <p>Senior Teacher</p>
                            <a href="teacherDetails.html" class="btn btn-outline-primary ">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-xl-3 team-grids">
                    <div class="thumbnail team-agileits position-relative">
                        <div class="hover-effected">
                            <ul class="list-ul">
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{asset('Frontend/image/img/t3.jpg')}}" class="img-responsive" alt="" />
                        <div class="effectd-caption">
                            <h4>Chunk Erson</h4>
                            <p>Vice Principal</p>
                            <a href="teacherDetails.html" class="btn btn-outline-primary ">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-xl-3 team-grids">
                    <div class="thumbnail team-agileits position-relative">
                        <div class="hover-effected">
                            <ul class="list-ul">
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{asset('Frontend/image/img/t4.jpg')}}" class="img-responsive" alt="" />
                        <div class="effectd-caption">
                            <h4>Goes Mehak</h4>
                            <p>Teacher Science</p>
                            <a href="teacherDetails.html" class="btn btn-outline-primary ">Details</a>
                        </div>
                    </div>
                </div>
            
                <div class="clearfix"> </div>
            </div>

            <div class="team-row-agileinfo row pt-5">

                <div class="col-md-3 col-sm-6 team-grids">
                    <div  class="thumbnail team-agileits position-relative">
                        <div class="hover-effected">
                            <ul class="list-ul">
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{asset('Frontend/image/img/t1.jpg')}}" class="img-responsive" alt="" />
                        <div class="effectd-caption">
                            <h4>Vaura Tegsner</h4>
                            <p>Principal</p>
                            <a href="teacherDetails.html" class="btn btn-outline-primary ">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 team-grids">
                    <div class="thumbnail team-agileits position-relative">
                        <div class="hover-effected">
                            <ul class="list-ul">
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{asset('Frontend/image/img/t2.jpg')}}" class="img-responsive" alt="" />
                        <div class="effectd-caption">
                            <h4>Jark Kohnson</h4>
                            <p>Senior Teacher</p>
                            <a href="teacherDetails.html" class="btn btn-outline-primary ">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 team-grids">
                    <div class="thumbnail team-agileits position-relative">
                        <div class="hover-effected">
                            <ul class="list-ul">
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{asset('Frontend/image/img/t3.jpg')}}" class="img-responsive" alt="" />
                        <div class="effectd-caption">
                            <h4>Chunk Erson</h4>
                            <p>Vice Principal</p>
                            <a href="teacherDetails.html" class="btn btn-outline-primary ">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 team-grids">
                    <div class="thumbnail team-agileits position-relative">
                        <div class="hover-effected">
                            <ul class="list-ul">
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li class="list-li"><a href="#"><i class="fs-6 fab fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{asset('Frontend/image/img/t4.jpg')}}" class="img-responsive" alt="" />
                        <div class="effectd-caption">
                            <h4>Goes Mehak</h4>
                            <p>Teacher Science</p>
                            <a href="teacherDetails.html" class="btn btn-outline-primary ">Details</a>
                        </div>
                    </div>
                </div>
            
                <div class="clearfix"> </div>
            </div>

         
            
        </div>
    </div>
</section>
<!-- //teacher-->


<!---middle section -->
@include('layouts.middle-section')
<!---middle section end-->


<!---news section -->
<!-- <section class="news-section">
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
	<!--<div class="modal about-modal fade" id="myModal" tabindex="-1" role="dialog">
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
	</div>
	<!-- //modal -->
<!--</section> -->
<!---news section end-->




@endsection