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
            <li>সাইন আপ</li>
        </ul>
    </div>
</div>
<!-- //short-->

<!-- register-->
<section class="register-section">
    <div class="register-form-main">
        <div class="container">
            <div class="title-div">
                <h3 class="title text-center">
                    <span>রে</span>জিস্টার
                    <span>ফ</span>র্ম
                </h3>
                <div class="title-style">

                </div>
            </div>
            <div class="login-form">
                <form action="#" method="post">
                    <div class="">
                        <p>নাম </p>
                        <input type="text" class="name" name="user name" required="" />
                    </div>
                    <div class="">
                        <p>ই-মেইল</p>
                        <input type="email" class="password" name="email" required="" />
                    </div>
                    
                    <div class="">
                        <p>ফোন</p>
                        <input type="text" class="password" name="phone" required="" />
                    </div>
                    
                    <div class="">
                        <p>পাসওয়ার্ড</p>
                        <input type="password" class="password" name="Password" id="password1" required="" />
                    </div>
                    <div class="">
                        <p>পুনরায় পাসওয়ার্ড</p>
                        <input type="password" class="password" name="Password" id="password2" required="" />
                    </div>
                    <label class="anim">
                        <input type="checkbox" class="checkbox">
                        <span>আমি শর্তাবলী স্বীকার করছি</span>
                    </label>
                    <input type="submit" value="রেজিস্টার">
                </form>
            </div>

        </div>
    </div>
</section>
<!-- //register-->



@endsection