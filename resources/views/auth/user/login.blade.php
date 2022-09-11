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
            <li>লগইন</li>
        </ul>
    </div>
</div>
<!-- //short-->

<!-- login-->
<section class="login-section">
    <div class="register-form-main">
        <div class="container">
            <div class="title-div">
                <h3 class="title text-center">
                    <span>ল</span>গইন 
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
                        <p>পাসওয়ার্ড</p>
                        <input type="password" class="password" name="Password" required="" />
                    </div>
                    <label class="anim">
                        <input type="checkbox" class="checkbox">
                        <span> Remember me ?</span>
                    </label>
                    <div class="login-agileits-bottom wthree">
                        <h6>
                            <a href="#">পাসওয়ার্ড ভুলে গেছেন?</a>
                        </h6>
                    </div>
                    <input type="submit" value="লগইন">
                    <div class="register-forming">
                        <p>
                            নতুন অ্যাকাউন্ট নিবন্ধন করতে --
                            <a href="{{route('user-register')}}">
                                এখানে ক্লিক করুন</a>
                        </p>
                    </div>
                </form>
            </div>
    
        </div>
    </div>
</section>
<!-- //login-->



@endsection