@extends('layouts.BackendLayout')

@section('content')

<style>
/*-- status --*/
	.stats-info-agile {
    background: url({{asset($data->image)}}) no-repeat center;

    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    -ms-background-size: cover;
    text-align: center;
    padding: 2em 3em 0;
    min-height: 650px!important;
    -webkit-box-shadow: 0px 3px 5px 0px rgba(10, 10, 10, 0.47);
    -moz-box-shadow: 0px 3px 5px 0px rgba(10, 10, 10, 0.47);
    box-shadow: 0px 3px 5px 0px rgba(10, 10, 10, 0.47);
}


.stats-grid {
    padding: 2em 0!important;
}

.numscroller {
    font-size: 2.5em;
    color: #fff;
    font-weight: 600;
    letter-spacing: 1px;
}

.stats-info-agile p {
    color: #e4e4e4;
    font-size: 15px;
}

.stat-border {
    position: relative!important;
}

.stat-border:before {
    position: absolute;
    top: 0%!important;
    width: .5%!important;
    height: 170px!important;
    background: rgba(255, 255, 255, 0.51)!important;
    content: "";
    left: 95%!important;
}

.child-stat {
    border-top: 2px solid rgba(255, 255, 255, 0.51);
}

@media(max-width: 991px) {

	.stats-info-agile{  
        width:100%!important;
    }
}

@media(max-width: 640px) {

	.stats-info-agile {
        width: 80% !important;
        min-height: 600px!important;
        margin: 3em auto 0!important;
    }
}

@media(max-width: 480px) {
	 .stats-info-agile {
        margin: 0em auto 0 !important;
    }

    .stat-border::before {
        height: 172px;
        left: 93%;
    }

    .numscroller {
        font-size: 2em;
    }
}

@media(max-width: 414px) {
	.stats-info-agile {
        min-height: 500px !important;
        margin: 0em auto 0 !important;
    }


}

@media(max-width: 320px) {

    .numscroller {
        font-size: 1.8em;
    }


    .stat-border::before {
        height: 174px;
        left: 102%;
    }

        
}

/*-- //status --*/

</style>

<!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">

          <div id="breadcrumbs-wrapper" data-image="{{asset("Backend/app-assets/images/gallery/breadcrumb-bg.jpg")}}">
                <!-- Search for small screen-->
                <div class="container">
                  <div class="row">

                    <div class="col s12 m6 l6">
                      <h5 class="breadcrumbs-title mt-0 mb-0">
                        <span>
                        	About View
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">About settings View
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

              <div class="col s12 ">
                
                <!-- about settings Add -->
                <div class="container">
                    <div class="row">
                    
	                    <div  class="card-header col m12 s12 mb-3  mt-3">
                             <a class="btn right " href="{{url()->previous()}}"><i style="font-size:15px!important;margin-right: 11px!important;" class="fa-solid fa-arrow-left mr-2"></i>Back </a>

                             <span class="right fontawesome btn waves-effect waves-light {{($data->status==1)?'green darken-1':' amber darken-4'}} mr-3">Status: {{($data->status==1)?"Published":"Unpublished"}}</span>
	                    </div>


                        <div class="col m6 s12">
                        	<h4 class="fs-md-1">আমাদের
					            <span style="color:red;">সম্পর্কে</span>
					          </h4>

					           <p style="color: #666;line-height: 2em;margin-bottom: 1em;">
					           	<?php echo $data->title ?>
					           </p>
						      <p style="margin-bottom: 0;border-top: 2px solid #ef5861;padding-top: 13px;text-align: justify">
						        <?php echo $data->text ?>
						      </p>
           				</div>

           				<div class="col m6 s12 stats-info-agile">
							<div class="container">

            					<div class="row">
            						 <div class="col s6 col6 m6 stats-grid stat-border">
							            <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='768' data-delay='.5' data-increment="1">768</div>
							            <p>বর্তমান শিক্ষার্থী</p>
							          </div>
							          <div class="col s6 col6 m6 stats-grid">
							            <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='678' data-delay='.5' data-increment="1">678</div>
							            <p>অনুমোদিত কোর্স</p>
							          </div>
							          <div class="clearfix"></div>
            					</div>


            					<div class="child-stat row">
							        <div class="col s6 col6 m6 stats-grid stat-border border-st2">
							          <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='800' data-delay='.5' data-increment="1">800</div>
							          <p>শিক্ষক</p>
							        </div>
							        <div class="col s6 col6 m6 stats-grid">
							          <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='485' data-delay='.5' data-increment="1">485</div>
							          <p>সন্তুষ্ট শিক্ষার্থী</p>
							        </div>
							        <div class="clearfix"></div>
							      </div>


            				</div>
           				</div>

                    </div> 
                </div>
                <!-- about settings Add End-->
              </div>

          
              
        </div>
    </div>
      <!-- END: Page Main-->
@endsection