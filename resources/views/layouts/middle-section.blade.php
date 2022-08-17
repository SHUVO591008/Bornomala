
<?php 

$instituteDetails = App\Model\instituteDetails::where('status',1)->get();

?>

@if($instituteDetails->isNotEmpty())
<!---middle section -->
<section class="middle-section">
	<div class="middle-sec-agile">
		<div class="container">
			<h4>আমাদের
				<span>সেরা স্টাডি </span>ইনস্টিটিউট </h4>
			<ul>
			@foreach($instituteDetails as $key)
				<li>
					<div class="midle-left-w3l">
						<span class="fa fa-check" aria-hidden="true"></span>
					</div>
					<div class="middle-right">
						<h5>{{$key->title}}</h5>
						<p>{{$key->details}}</p>
					</div>
					<div class="clearfix"></div>
				</li>
			@endforeach
			

			</ul>
			<a class="button-style" href="join.html">Join Now</a>
		</div>
		<div class="pencil-img">
			<img src="image/img/bg5.png" alt="" />
		</div>
	</div>
</section>
<!---middle section end-->
@endif

