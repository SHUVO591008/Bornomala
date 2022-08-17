@extends('layouts.FrontendLayout')

@section('content')


<?php
$courseAdvertise = App\Model\courseAdvertise::where('status',1)->latest()->get();
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
            <li>আপকামিং ব্যাচসমূহ</li>
        </ul>
    </div>
</div>
<!-- //short-->

@if($courseAdvertise->isNotEmpty())
<!-- course -->
<section class="course-section blog-cource">
    <div class="container">
        <div style="margin-bottom: 35px;" class="title-div py-5">
            <h3 class="title text-center fw-bold">
             <span>কোর্স</span> সমূহ
            </h3>
            <div class="title-style"></div>
        </div>
        @foreach($courseAdvertise as $key)

            @if($key->position=="left")
                <div class="log-info row pb-4">
                    <div class="col-sm-4 blog-grid-img">
                        <img src="{{asset($key->image)}}" class="img-responsive" alt="" />
                    </div>

                    <div class="col-sm-8 blog-grid-text">
                        <h4>{{$key->title}}</h4>
                   
                        <p>{{$key->des}}</p>

                        @if($key->btn=="on")
                            <a class="button-style" href="{{$key->btn_url}}">Apply Now</a>
                        @endif

                    </div>

                    <div class="clearfix"> </div>
                </div>
            @else
             <div class="blog-agileinfo blog-info-mdl row pb-4">
                <div class="col-sm-8 blog-grid-text">
                    <h4> {{$key->title}}</h4>
                    
                    <p>{{$key->des}}</p>
                     @if($key->btn=="on")
                        <a class="button-style" href="{{$key->btn_url}}">Apply Now</a>
                    @endif
                </div>
                <div class="col-sm-4 blog-grid-img blog-img-rght">
                    <img src="{{asset($key->image)}}" class="img-responsive" alt="" />
                </div>
                <div class="clearfix"> </div>
            </div>

            @endif
            
        @endforeach
    


    </div>
</section>
<!-- //course-->
@endif

<!-- table -->
<section class="table_section">
    <div class="container">

        <div style="margin-bottom: 35px;" class="title-div py-5">
            <h3 class="title text-center fw-bold">
              সকাল ও বিকালের ব্যাচসমূহ
            </h3>
            <div class="title-style"></div>
        </div>

        <div class="notice pb-5 col-12">
            <h5>বিঃদ্র: রেজিস্ট্রেশন করতে "Join Now" বাটনে ক্লিক কর (মোবাইল থেকে ডানে টানলে "Join Now" বাটন পাবেন ।)</h5>
        </div>

          <div class="table_div table-responsive">
            <table id="example" class="pt-5 table table-bordered table-hover table-dark text-center" style="width:100%">
                <thead class="table-primary">
                    <tr>
                        <th>Sl</th>
                        <th>Course</th>
                        <th>Class</th>
                        <th>Batch ID</th>
                        <th>Schedule</th>
                        <th>Time</th>
                        <th>Joining Date</th>
                        <th>Sir</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Mathematics</td>
                        <td>Nine</td>
                        <td>20211</td>
                        <td>(Sun-Tue-Thu)</td>
                        <td>3.00pm</td>
                        <td>01-Jan-2020</td>
                        <td>Shimul Sir</td>
                        <td><a class="btn btn-danger" href="#">Close</a></td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>English</td>
                        <td>Nine</td>
                        <td>20212</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>3.00pm</td>
                        <td>01-Jan-2021</td>
                        <td>Shuvashis Sir</td>
                        <td><a class="btn btn-success" href="join.html">Join Now</a></td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>English</td>
                        <td>Ten</td>
                        <td>20216</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>2.00pm</td>
                        <td>01-Feb-2021</td>
                        <td>Shuvashis Sir</td>
                        <td><a class="btn btn-success" href="join.html">Join Now</a></td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>Mathematics</td>
                        <td>Ten</td>
                        <td>20256</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>4.00pm</td>
                        <td>01-Feb-2021</td>
                        <td>Shuvashis Sir</td>
                        <td><a class="btn btn-success" href="join.html">Join Now</a></td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>Mathematics</td>
                        <td>Nine</td>
                        <td>20257</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>1.00pm</td>
                        <td>01-Mar-2021</td>
                        <td>Shimul Sir</td>
                        <td><a class="btn btn-success" href="join.html">Join Now</a></td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td>Mathematics</td>
                        <td>Nine</td>
                        <td>20257</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>1.00pm</td>
                        <td>01-Mar-2021</td>
                        <td>Shimul Sir</td>
                        <td><a class="btn btn-success" href="join.html">Join Now</a></td>
                    </tr>


                    <tr>
                        <td>6</td>
                        <td>Mathematics</td>
                        <td>Nine</td>
                        <td>20257</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>1.00pm</td>
                        <td>01-Mar-2020</td>
                        <td>Shimul Sir</td>
                        <td><a class="btn btn-danger" href="#">Close</a></td>
                    </tr>

                    <tr>
                        <td>7</td>
                        <td>Mathematics</td>
                        <td>Nine</td>
                        <td>20257</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>1.00pm</td>
                        <td>01-Mar-2021</td>
                        <td>Shimul Sir</td>
                        <td><a class="btn btn-success" href="join.html">Join Now</a></td>
                    </tr>

                    <tr>
                        <td>8</td>
                        <td>Mathematics</td>
                        <td>Nine</td>
                        <td>20257</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>1.00pm</td>
                        <td>01-Mar-2021</td>
                        <td>Shimul Sir</td>
                        <td><a class="btn btn-success" href="join.html">Join Now</a></td>
                    </tr>

                    <tr>
                        <td>9</td>
                        <td>Mathematics</td>
                        <td>Nine</td>
                        <td>20257</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>1.00pm</td>
                        <td>01-Mar-2021</td>
                        <td>Shimul Sir</td>
                        <td><a class="btn btn-success" href="join.html">Join Now</a></td>
                    </tr>

                    <tr>
                        <td>10</td>
                        <td>Mathematics</td>
                        <td>Nine</td>
                        <td>20257</td>
                        <td>(sat-Mon-Wed)</td>
                        <td>1.00pm</td>
                        <td>01-Mar-2021</td>
                        <td>Shimul Sir</td>
                        <td><a class="btn btn-success" href="join.html">Join Now</a></td>
                    </tr>

                </tbody>

            </table>
          </div>

          <div class="comment_div">
            <div class="mb-5 mt-5">

                <div class="card">

                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="POST">
                                <div class="bg-light pb-5">
                                    <div class="d-flex flex-row align-items-start">
                                        <img class="rounded-circle me-3" src="image/logo/logo.png" width="40">
                                        <textarea class="form-control ml-1 shadow-none textarea" placeholder="Add a comment...." required></textarea>
                                    </div>
                                    <div class="mt-2 ms-5">
                                        <button class="btn btn-primary btn-sm shadow-none fs-6" type="submit">Post comment</button>
                                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none fs-6" type="button">Cancel</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="media">
                                        <img class="mr-3 rounded-circle" alt="Bootstrap Media Preview" src="https://i.imgur.com/stD0Q19.jpg" />
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <h5>Maria Smantha</h5> <span>- 2 hours ago</span>
                                                </div>

                                            </div>
                                             It is a long established fact that a reader will be distracted by the readable content of a page.
                                             <div class="bg-white">
                                                <div class="d-flex flex-row fs-12">
                                                    <div class="like p-2 cursor">
                                                        <a href="#">
                                                            <i class="far fa-thumbs-up"></i><span class="ml-1"> Like</span>
                                                        </a>
                                                    </div>
                                                    <div class="like p-2 cursor">
                                                        <div class="replybutton" data-commentbox="panel2">
                                                            <i class="fas fa-reply"></i><span class="ml-1"> Reply</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!--reply-->
                                            <div class="replybox" id="panel2" style="display:none">
                                                <div class="bg-light pb-5">
                                                    <div class="d-flex flex-row align-items-start">
                                                        <img class="rounded-circle me-3" src="image/logo/logo.png" width="40">
                                                        <textarea class="form-control ml-1 shadow-none textarea" placeholder="Add a comment...."></textarea>
                                                    </div>
                                                    <div class="mt-2 ms-5">
                                                        <button class="btn btn-primary btn-sm shadow-none fs-6" type="submit">Reply comment</button>
                                                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none fs-6 cancelbutton" type="button">Cancel</button>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--reply end-->
                                             <div class="media mt-4 offset-1 col-11"> <a class="pr-3" href="#"><img class="rounded-circle" alt="Bootstrap Media Another Preview" src="https://i.imgur.com/xELPaag.jpg" /></a>
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-12 d-flex">
                                                            <h5>Simona Disa</h5> <span>- 3 hours ago</span>
                                                        </div>
                                                    </div>
                                                     letters, as opposed to using 'Content here, content here', making it look like readable English.
                                                     <div class="bg-white">
                                                        <div class="d-flex flex-row fs-12">
                                                            <div class="like p-2 cursor">
                                                                <a href="#">
                                                                    <i class="far fa-thumbs-up"></i><span class="ml-1"> Like</span>
                                                                </a>
                                                            </div>
                                                            <div class="like p-2 cursor">
                                                                <div class="replybutton" data-commentbox="panel1">
                                                                    <i class="fas fa-reply"></i><span class="ml-1"> Reply</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--reply-->
                                                    <div class="replybox" id="panel1" style="display:none">
                                                        <div class="bg-light pb-5">
                                                            <div class="d-flex flex-row align-items-start">
                                                                <img class="rounded-circle me-3" src="image/logo/logo.png" width="40">
                                                                <textarea class="form-control ml-1 shadow-none textarea" placeholder="Add a comment...."></textarea>
                                                            </div>
                                                            <div class="mt-2 ms-5">
                                                                <button class="btn btn-primary btn-sm shadow-none fs-6" type="submit">Reply comment</button>
                                                                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none fs-6 cancelbutton" type="button">Cancel</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--reply end-->
                                                </div>
                                            </div>
                                            <div class="media mt-3 offset-1 col-11"> <a class="pr-3" href="#"><img class="rounded-circle" alt="Bootstrap Media Another Preview" src="https://i.imgur.com/nAcoHRf.jpg" /></a>
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-12 d-flex">
                                                            <h5>John Smith</h5> <span>- 4 hours ago</span>
                                                        </div>
                                                    </div>
                                                    the majority have suffered alteration in some form, by injected humour, or randomised words.
                                                    <div class="bg-white">
                                                        <div class="d-flex flex-row fs-12">
                                                            <div class="like p-2 cursor">
                                                                <a href="#">
                                                                    <i class="far fa-thumbs-up"></i><span class="ml-1"> Like</span>
                                                                </a>
                                                            </div>
                                                            <div class="like p-2 cursor">
                                                                <div class="replybutton"  data-commentbox="panel3">
                                                                    <i class="fas fa-reply"></i><span class="ml-1"> Reply</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--reply-->
                                                    <div class="replybox" id="panel3" style="display:none">
                                                        <div class="bg-light pb-5">
                                                            <div class="d-flex flex-row align-items-start">
                                                                <img class="rounded-circle me-3" src="image/logo/logo.png" width="40">
                                                                <textarea class="form-control ml-1 shadow-none textarea" placeholder="Add a comment...."></textarea>
                                                            </div>
                                                            <div class="mt-2 ms-5">
                                                                <button class="btn btn-primary btn-sm shadow-none fs-6" type="submit">Reply comment</button>
                                                                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none fs-6 cancelbutton" type="button">Cancel</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--reply end-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media mt-4">
                                        <img class="mr-3 rounded-circle" alt="Bootstrap Media Preview" src="https://i.imgur.com/xELPaag.jpg" />
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <h5>Shad f</h5> <span>- 2 hours ago</span>
                                                </div>

                                            </div>
                                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33.
                                            <div class="bg-white">
                                                <div class="d-flex flex-row fs-12">
                                                    <div class="like p-2 cursor">
                                                        <a href="#">
                                                            <i class="far fa-thumbs-up"></i><span class="ml-1"> Like</span>
                                                        </a>
                                                    </div>
                                                    <div class="like p-2 cursor">
                                                        <div class="replybutton" data-commentbox="panel4" href="#">
                                                            <i class="fas fa-reply"></i><span class="ml-1"> Reply</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                             <!--reply-->
                                             <div class="replybox" id="panel4" style="display:none">
                                                <div class="bg-light pb-5">
                                                    <div class="d-flex flex-row align-items-start">
                                                        <img class="rounded-circle me-3" src="image/logo/logo.png" width="40">
                                                        <textarea class="form-control ml-1 shadow-none textarea" placeholder="Add a comment...."></textarea>
                                                    </div>
                                                    <div class="mt-2 ms-5">
                                                        <button class="btn btn-primary btn-sm shadow-none fs-6" type="submit">Reply comment</button>
                                                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none fs-6 cancelbutton" type="button">Cancel</button>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--reply end-->

                                            <div class="media mt-4 offset-1 col-11"> <a class="pr-3" href="#"><img class="rounded-circle" alt="Bootstrap Media Another Preview" src="https://i.imgur.com/nUNhspp.jpg" /></a>
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-12 d-flex">
                                                            <h5>Andy flowe</h5> <span>- 5 hours ago</span>
                                                        </div>
                                                    </div>
                                                     Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                                                     <div class="bg-white">
                                                        <div class="d-flex flex-row fs-12">
                                                            <div class="like p-2 cursor">
                                                                <a href="#">
                                                                    <i class="far fa-thumbs-up"></i><span class="ml-1"> Like</span>
                                                                </a>
                                                            </div>
                                                            <div class="like p-2 cursor">
                                                                <div class="replybutton" data-commentbox="panel5">
                                                                    <i class="fas fa-reply"></i><span class="ml-1"> Reply</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                     <!--reply-->
                                                     <div class="replybox" id="panel5" style="display:none">
                                                        <div class="bg-light pb-5">
                                                            <div class="d-flex flex-row align-items-start">
                                                                <img class="rounded-circle me-3" src="image/logo/logo.png" width="40">
                                                                <textarea class="form-control ml-1 shadow-none textarea" placeholder="Add a comment...."></textarea>
                                                            </div>
                                                            <div class="mt-2 ms-5">
                                                                <button class="btn btn-primary btn-sm shadow-none fs-6" type="submit">Reply comment</button>
                                                                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none fs-6 cancelbutton" type="button">Cancel</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--reply end-->
                                                </div>
                                            </div>
                                            <div class="media mt-3 offset-1 col-11"> <a class="pr-3" href="#"><img class="rounded-circle" alt="Bootstrap Media Another Preview" src="https://i.imgur.com/HjKTNkG.jpg" /></a>
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-12 d-flex">
                                                            <h5>Simp f</h5> <span>- 5 hours ago</span>
                                                        </div>
                                                    </div>
                                                    a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur
                                                    <div class="bg-white">
                                                        <div class="d-flex flex-row fs-12">
                                                            <div class="like p-2 cursor">
                                                                <a href="#">
                                                                    <i class="far fa-thumbs-up"></i><span class="ml-1"> Like</span>
                                                                </a>
                                                            </div>
                                                            <div class="like p-2 cursor">
                                                                <div class="replybutton" data-commentbox="panel6" href="#">
                                                                    <i class="fas fa-reply"></i><span class="ml-1"> Reply</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                     <!--reply-->
                                                     <div class="replybox" id="panel6" style="display:none">
                                                        <div class="bg-light pb-5">
                                                            <div class="d-flex flex-row align-items-start">
                                                                <img class="rounded-circle me-3" src="image/logo/logo.png" width="40">
                                                                <textarea class="form-control ml-1 shadow-none textarea" placeholder="Add a comment...."></textarea>
                                                            </div>
                                                            <div class="mt-2 ms-5">
                                                                <button class="btn btn-primary btn-sm shadow-none fs-6" type="submit">Reply comment</button>
                                                                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none fs-6 cancelbutton" type="button">Cancel</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--reply end-->
                                                </div>
                                            </div>
                                            <div class="media mt-3 offset-1 col-11"> <a class="pr-3" href="#"><img class="rounded-circle" alt="Bootstrap Media Another Preview" src="https://i.imgur.com/nAcoHRf.jpg" /></a>
                                                <div class="media-body">
                                                    <div class="row">
                                                        <div class="col-12 d-flex">
                                                            <h5>John Smith</h5> <span>- 4 hours ago</span>
                                                        </div>
                                                    </div>
                                                     the majority have suffered alteration in some form, by injected humour, or randomised words.
                                                     <div class="bg-white">
                                                        <div class="d-flex flex-row fs-12">
                                                            <div class="like p-2 cursor">
                                                                <a href="#">
                                                                    <i class="far fa-thumbs-up"></i><span class="ml-1"> Like</span>
                                                                </a>
                                                            </div>
                                                            <div class="like p-2 cursor">
                                                                <div class="replybutton" data-commentbox="panel7">
                                                                    <i class="fas fa-reply"></i><span class="ml-1"> Reply</span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                     <!--reply-->
                                                     <div class="replybox" id="panel7" style="display:none">
                                                        <div class="bg-light pb-5">
                                                            <div class="d-flex flex-row align-items-start">
                                                                <img class="rounded-circle me-3" src="image/logo/logo.png" width="40">
                                                                <textarea class="form-control ml-1 shadow-none textarea" placeholder="Add a comment...."></textarea>
                                                            </div>
                                                            <div class="mt-2 ms-5">
                                                                <button class="btn btn-primary btn-sm shadow-none fs-6" type="submit">Reply comment</button>
                                                                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none fs-6 cancelbutton" type="button">Cancel</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--reply end-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>




    </div>
</section>
<!-- //table-->

<!---middle section -->
@include('layouts.middle-section')
<!---middle section end-->


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
	</div>
	<!-- //modal -->
<!-- </section>-->
<!---news section end-->

@endsection
