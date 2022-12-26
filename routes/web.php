<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






// Frontend route

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'Frontend\Home\HomeController@index');
Route::get('/upcoming', 'Frontend\Home\HomeController@upcoming')->name('upcoming');
Route::get('/teacher', 'Frontend\Home\HomeController@teacher')->name('teacher');
Route::get('/about', 'Frontend\Home\HomeController@about')->name('about');
Route::get('/contact', 'Frontend\Home\HomeController@contact')->name('contact');
Route::get('/gallery', 'Frontend\Home\HomeController@gallery')->name('gallery');
Route::get('/privacy-policy', 'Frontend\Home\HomeController@PrivacyPolicy')->name('PrivacyPolicy');
Route::get('/Terms-And-Conditions', 'Frontend\Home\HomeController@TermsConditions')->name('TermsConditions');
    //user Auth Route
Route::get('/login', 'Backend\Auth\AuthController@showLoginForm')->name('user-login');
Route::post('login', 'Backend\Auth\AuthController@login');
Route::get('/register', 'Backend\Auth\AuthController@showRegistrationForm')->name('user-register');
Route::post('register', 'Backend\Auth\AuthController@create');



// Backend route
    //Admin Auth Route
    Route::get('dashboard/login', 'Backend\Auth\AdminAuthController@showLoginForm')->name('login');
    Route::post('dashboard/login', 'Backend\Auth\AdminAuthController@login');

    Route::post('logout', 'Backend\Auth\AdminAuthController@logout')->name('logout');

    Route::get('dashboard/register', 'Backend\Auth\AdminAuthController@showRegistrationForm')->name('register');
    Route::post('dashboard/register', 'Backend\Auth\AdminAuthController@create');

    //forgot password Route
    Route::get('forgot/password', 'Backend\Auth\AdminAuthController@Forgetpassword')->name('forgot');
    Route::post('forgot/password', 'Backend\Auth\AdminAuthController@updateForgetpassword')->name('Updateforgot');
    Route::get('reset-password/{token}', 'Backend\Auth\AdminAuthController@showResetPasswordForm')->name('reset.password.get');
    Route::match(['GET', 'POST'],'reset-password', 'Backend\Auth\AdminAuthController@submitResetPasswordForm')->name('reset.password.post');

    // verify Routes...
    Route::get('/user/verify/{token}', 'Backend\Auth\AdminAuthController@verifyEmail')->name('verifyEmail');


    Route::get('admin/varifyusername','Backend\Ajax\AjaxController@varifyadminName');
    Route::get('admin/varifyemail','Backend\Ajax\AjaxController@varifyadminemail');

//user msg
 Route::post('/add', 'Backend\ContactDetailsSettings\ContactController@store')->name('contact.store');

// group route
Route::group(['middleware' =>'auth:webadmin'], function () {


        Route::get('/dashboard', 'Backend\Dashboard\DashboardController@index')->name('dashboard');

        // User route
        Route::prefix('users')->group(function () {
            Route::get('/list', 'Backend\User\UserController@list')->name('users.list');
            Route::get('/view/{id}', 'Backend\User\UserController@view')->name('users.view');
            Route::get('/add', 'Backend\User\UserController@Useradd')->name('users.add');
            Route::post('/add', 'Backend\User\UserController@store')->name('users.store');



            Route::get('/edit/{id}', 'Backend\User\UserController@edit')->name('users.edit');
            Route::post('/update/{id}', 'Backend\User\UserController@update')->name('users.update');
            Route::get('/delete/{id}', 'Backend\User\UserController@destroy')->name('users.delete');

        });





        // general route
        Route::prefix('general')->group(function () {
            Route::get('/varifyname','Backend\generalSettings\generalSettingsController@varifyname');
            Route::get('/update/varifyname','Backend\generalSettings\generalSettingsController@updatevarifyname');

            Route::get('/add', 'Backend\generalSettings\generalSettingsController@add')->name('general.add');
            Route::post('/add', 'Backend\generalSettings\generalSettingsController@store')->name('general.store');
            Route::get('/view', 'Backend\generalSettings\generalSettingsController@view')->name('general.view');
            Route::post('/status', 'Backend\generalSettings\generalSettingsController@status')->name('general.status');
            Route::get('/edit/{id}', 'Backend\generalSettings\generalSettingsController@edit')->name('general.edit');
            Route::post('/update/{id}', 'Backend\generalSettings\generalSettingsController@update')->name('general.update');
            Route::get('/delete/{id}', 'Backend\generalSettings\generalSettingsController@destroy')->name('general.delete');

            // Social route
            Route::get('/socialvarifyname','Backend\generalSettings\generalSettingsController@socialvarifyname');
            Route::get('/update/socialvarifyname','Backend\generalSettings\generalSettingsController@Updatesocialvarifyname');

            Route::post('/socialadd', 'Backend\generalSettings\generalSettingsController@socialstore')->name('social.store');

            Route::post('/socialstatus', 'Backend\generalSettings\generalSettingsController@socialstatus')->name('social.status');
            Route::get('/socialedit/{id}', 'Backend\generalSettings\generalSettingsController@socialedit')->name('social.edit');

            Route::post('/socialupdate/{id}', 'Backend\generalSettings\generalSettingsController@socialupdate')->name('social.update');
            Route::get('/socialdelete/{id}', 'Backend\generalSettings\generalSettingsController@socialdestroy')->name('social.delete');

            Route::post('/leftposition', 'Backend\generalSettings\generalSettingsController@headerLeftposition')->name('left.customize');
            Route::post('/rightposition', 'Backend\generalSettings\generalSettingsController@headerRightposition')->name('right.customize');

             Route::post('/footerposition', 'Backend\generalSettings\generalSettingsController@footerposition')->name('footer.customize');

             Route::post('/socialleftposition', 'Backend\generalSettings\generalSettingsController@socialleftposition')->name('socialLeft.customize');

             Route::post('/socialrightposition', 'Backend\generalSettings\generalSettingsController@socialrightposition')->name('socialRight.customize');

             Route::post('/socialfooterposition', 'Backend\generalSettings\generalSettingsController@socialfooterposition')->name('socialFooter.customize');

        });

        //header route
        Route::prefix('header')->group(function () {
            Route::get('/add', 'Backend\headerSettings\headerController@add')->name('header.add');
            Route::post('/add', 'Backend\headerSettings\headerController@store')->name('header.store');
            Route::post('/status', 'Backend\headerSettings\headerController@status')->name('header.status');
            Route::get('/edit/{id}', 'Backend\headerSettings\headerController@edit')->name('header.edit');
            Route::post('/update/{id}', 'Backend\headerSettings\headerController@update')->name('header.update');
            Route::get('/delete/{id}', 'Backend\headerSettings\headerController@destroy')->name('header.delete');

        });



        //news route
        Route::prefix('news')->group(function () {
            Route::get('/add', 'Backend\newsSettings\newsController@add')->name('news.add');
            Route::post('/add', 'Backend\newsSettings\newsController@store')->name('news.store');
            Route::post('/status', 'Backend\newsSettings\newsController@status')->name('news.status');
            Route::post('/scrollBar', 'Backend\newsSettings\newsController@scrollBar')->name('news.scrollBar');
            Route::get('/edit/{id}', 'Backend\newsSettings\newsController@edit')->name('news.edit');
            Route::post('/update/{id}', 'Backend\newsSettings\newsController@update')->name('news.update');
            Route::get('/delete/{id}', 'Backend\newsSettings\newsController@destroy')->name('news.delete');

        });


        //slider route
        Route::prefix('slider')->group(function () {
            Route::get('/add', 'Backend\sliderSettings\sliderController@add')->name('slider.add');
            Route::post('/add', 'Backend\sliderSettings\sliderController@store')->name('slider.store');
            Route::get('/view/{id}', 'Backend\sliderSettings\sliderController@show')->name('slider.view');
            Route::post('/status', 'Backend\sliderSettings\sliderController@status')->name('slider.status');
            Route::get('/edit/{id}', 'Backend\sliderSettings\sliderController@edit')->name('slider.edit');
            Route::post('/update/{id}', 'Backend\sliderSettings\sliderController@update')->name('slider.update');
            Route::get('/delete/{id}', 'Backend\sliderSettings\sliderController@destroy')->name('slider.delete');

            Route::get('/ShowOrHide', 'Backend\sliderSettings\sliderController@sliderStatusShowHide');

        });

        //about route
        Route::prefix('about')->group(function () {
            Route::get('/add', 'Backend\aboutSettings\aboutController@add')->name('about.add');
            Route::post('/add', 'Backend\aboutSettings\aboutController@store')->name('about.store');
            Route::post('/status', 'Backend\aboutSettings\aboutController@status')->name('about.status');
            Route::get('/view/{id}', 'Backend\aboutSettings\aboutController@show')->name('about.view');
            Route::get('/edit/{id}', 'Backend\aboutSettings\aboutController@edit')->name('about.edit');
            Route::post('/update/{id}', 'Backend\aboutSettings\aboutController@update')->name('about.update');
            Route::get('/delete/{id}', 'Backend\aboutSettings\aboutController@destroy')->name('about.delete');

        });

        //service route
        Route::prefix('service')->group(function () {
            Route::get('/add', 'Backend\serviceSettings\serviceController@add')->name('service.add');
            Route::post('/add', 'Backend\serviceSettings\serviceController@store')->name('service.store');
            Route::post('/status', 'Backend\serviceSettings\serviceController@status')->name('service.status');
            Route::get('/edit/{id}', 'Backend\serviceSettings\serviceController@edit')->name('service.edit');
            Route::post('/update/{id}', 'Backend\serviceSettings\serviceController@update')->name('service.update');
            Route::get('/delete/{id}', 'Backend\serviceSettings\serviceController@destroy')->name('service.delete');
        });

        //Institute Details route
        Route::prefix('instituteDetails')->group(function () {
            Route::get('/add', 'Backend\instituteDetailsSettings\instituteDetailsController@add')->name('institute.add');
            Route::post('/add', 'Backend\instituteDetailsSettings\instituteDetailsController@store')->name('institute.store');
            Route::post('/status', 'Backend\instituteDetailsSettings\instituteDetailsController@status')->name('institute.status');
            Route::get('/edit/{id}', 'Backend\instituteDetailsSettings\instituteDetailsController@edit')->name('institute.edit');
            Route::post('/update/{id}', 'Backend\instituteDetailsSettings\instituteDetailsController@update')->name('institute.update');
            Route::get('/delete/{id}', 'Backend\instituteDetailsSettings\instituteDetailsController@destroy')->name('institute.delete');
        });


        //Course Advertisement route
        Route::prefix('courseAdvertise')->group(function () {
            Route::get('/add', 'Backend\courseAdvertiseSettings\courseAdvertiseController@add')->name('courseAdvertise.add');
            Route::post('/add', 'Backend\courseAdvertiseSettings\courseAdvertiseController@store')->name('courseAdvertise.store');
             Route::get('/view/{id}', 'Backend\courseAdvertiseSettings\courseAdvertiseController@show')->name('courseAdvertise.view');
            Route::post('/status', 'Backend\courseAdvertiseSettings\courseAdvertiseController@status')->name('courseAdvertise.status');
            Route::post('/button/on/off', 'Backend\courseAdvertiseSettings\courseAdvertiseController@btn')->name('courseAdvertise.btn');
            Route::get('/edit/{id}', 'Backend\courseAdvertiseSettings\courseAdvertiseController@edit')->name('courseAdvertise.edit');
            Route::post('/update/{id}', 'Backend\courseAdvertiseSettings\courseAdvertiseController@update')->name('courseAdvertise.update');
            Route::get('/delete/{id}', 'Backend\courseAdvertiseSettings\courseAdvertiseController@destroy')->name('courseAdvertise.delete');
        });

         //Questions & Answer route
        Route::prefix('QuestionsAns')->group(function () {
            Route::get('/add', 'Backend\QuestionsAnswerSettings\QuestionsAnswerController@add')->name('QuestionsAnswer.add');
            Route::post('/add', 'Backend\QuestionsAnswerSettings\QuestionsAnswerController@store')->name('QuestionsAnswer.store');
            Route::get('/edit/{id}', 'Backend\QuestionsAnswerSettings\QuestionsAnswerController@edit')->name('QuestionsAnswer.edit');
            Route::post('/update/{id}', 'Backend\QuestionsAnswerSettings\QuestionsAnswerController@update')->name('QuestionsAnswer.update');
            Route::post('/status', 'Backend\QuestionsAnswerSettings\QuestionsAnswerController@status')->name('QuestionsAnswer.status');
            Route::get('/delete/{id}', 'Backend\QuestionsAnswerSettings\QuestionsAnswerController@destroy')->name('QuestionsAnswer.delete');
            Route::get('/view/', 'Backend\QuestionsAnswerSettings\QuestionsAnswerController@show')->name('QuestionsAnswer.view');


        });


        //Social Share route
        Route::prefix('social')->group(function () {
            Route::get('/add', 'Backend\SocialSettings\SocialController@add')->name('SocialShare.add');
            Route::post('/add', 'Backend\SocialSettings\SocialController@store')->name('SocialShare.store');
            Route::get('/edit/{id}', 'Backend\SocialSettings\SocialController@edit')->name('SocialShare.edit');
            Route::post('/update/{id}', 'Backend\SocialSettings\SocialController@update')->name('SocialShare.update');
            Route::post('/status', 'Backend\SocialSettings\SocialController@status')->name('SocialShare.status');
            Route::get('/delete/{id}', 'Backend\SocialSettings\SocialController@destroy')->name('SocialShare.delete');

        });


        //Admin Details
        Route::prefix('admin/details')->group(function () {
            Route::get('/add', 'Backend\AdminDetailsSettings\AdminDetailsController@add')->name('admin.add');
            Route::post('/add', 'Backend\AdminDetailsSettings\AdminDetailsController@store')->name('admin.store');
            Route::get('/edit/{id}', 'Backend\AdminDetailsSettings\AdminDetailsController@edit')->name('admin.edit');
            Route::post('/update/{id}', 'Backend\AdminDetailsSettings\AdminDetailsController@update')->name('admin.update');
            Route::post('/status', 'Backend\AdminDetailsSettings\AdminDetailsController@status')->name('admin.status');
            Route::get('/delete/{id}', 'Backend\AdminDetailsSettings\AdminDetailsController@destroy')->name('admin.delete');

        });

          //Contact Details
        Route::prefix('contact')->group(function () {
            //Details Route
            Route::get('/details/add', 'Backend\ContactDetailsSettings\ContactController@Detailsadd')->name('contactDetails.add');
            Route::post('/details/add', 'Backend\ContactDetailsSettings\ContactController@Detailsstore')->name('contactDetails.store');
            Route::get('/details/edit/{id}', 'Backend\ContactDetailsSettings\ContactController@Detailsedit')->name('contactDetails.edit');
            Route::post('/details/update', 'Backend\ContactDetailsSettings\ContactController@Detailsupdate')->name('contactDetails.update');
            Route::post('/details/status', 'Backend\ContactDetailsSettings\ContactController@Detailsstatus')->name('contactDetails.status');
            Route::get('/details/delete', 'Backend\ContactDetailsSettings\ContactController@Detailsdestroy')->name('contactDetails.delete');

            //Social Contact Route
            Route::post('/social/status', 'Backend\ContactDetailsSettings\ContactController@socialstatus')->name('socialContact.status');

            //Contact Route
            Route::get('/message', 'Backend\ContactDetailsSettings\ContactController@add')->name('contact.message');
            Route::get('/view/{id}', 'Backend\ContactDetailsSettings\ContactController@show')->name('contact.view');
            Route::get('/delete/{id}', 'Backend\ContactDetailsSettings\ContactController@destroy')->name('contact.delete');


        });


          //Gallery Details
        Route::prefix('gallery')->group(function () {
            Route::get('/add', 'Backend\gallerySettings\GalleryController@add')->name('gallery.add');
            Route::post('/add', 'Backend\gallerySettings\GalleryController@store')->name('gallery.store');
            Route::get('/view/{slug}', 'Backend\gallerySettings\GalleryController@view')->name('gallery.view');
            Route::get('/edit/{slug}', 'Backend\gallerySettings\GalleryController@edit')->name('gallery.edit');
            Route::post('/update/{slug}', 'Backend\gallerySettings\GalleryController@update')->name('gallery.update');
            Route::get('/delete/{slug}', 'Backend\gallerySettings\GalleryController@destroy')->name('gallery.delete');
            //ajax route
            Route::get('varifyname','Backend\Ajax\AjaxController@varifyGroupName');

        });


         //Privacy-Policy Details
        Route::prefix('privacy-policy')->group(function () {
            Route::get('/add', 'Backend\privacypolicySettings\PrivacyPolicyController@add')->name('privacypolicy.add');
            Route::post('/add', 'Backend\privacypolicySettings\PrivacyPolicyController@store')->name('privacypolicy.store');
            Route::get('/edit/{id}', 'Backend\privacypolicySettings\PrivacyPolicyController@edit')->name('privacypolicy.edit');
            Route::post('/update/{id}', 'Backend\privacypolicySettings\PrivacyPolicyController@update')->name('privacypolicy.update');
            Route::get('/delete/{id}', 'Backend\privacypolicySettings\PrivacyPolicyController@destroy')->name('privacypolicy.delete');
        });


        //Terms and Conditions Details
        Route::prefix('terms-conditions')->group(function () {
            Route::get('/add', 'Backend\termsconditionsSettings\TermsConditionsController@add')->name('termsconditions.add');
            Route::post('/add', 'Backend\termsconditionsSettings\TermsConditionsController@store')->name('termsconditions.store');
            Route::get('/edit/{id}', 'Backend\termsconditionsSettings\TermsConditionsController@edit')->name('termsconditions.edit');
            Route::post('/update/{id}', 'Backend\termsconditionsSettings\TermsConditionsController@update')->name('termsconditions.update');
            Route::get('/delete/{id}', 'Backend\termsconditionsSettings\TermsConditionsController@destroy')->name('termsconditions.delete');
        });

          //Mail Settings
        Route::prefix('mail')->group(function () {
            Route::get('/add', 'Backend\mailSetting\MailSettingController@index')->name('mailSetting.add');
            Route::post('/add', 'Backend\mailSetting\MailSettingController@store')->name('mailSetting.store');
            Route::post('/update', 'Backend\mailSetting\MailSettingController@update')->name('mailSetting.update');

        });



        //settings route
        Route::prefix('settings')->group(function () {
            Route::get('/add', 'Backend\Settings\settingsController@add')->name('settings.add');
            Route::post('/add', 'Backend\Settings\settingsController@store')->name('settings.store');
            Route::get('/edit/{id}', 'Backend\Settings\settingsController@edit')->name('settings.edit');
            Route::post('/update/{id}', 'Backend\Settings\settingsController@update')->name('settings.update');
            Route::get('/delete/{id}', 'Backend\Settings\settingsController@destroy')->name('settings.delete');

        });




    //admin panel section ------------------

         //Year routes
        Route::prefix('year')->group(function () {
            Route::get('all','Backend\system\Admin\YearController@AllYear')->name('all.year');
            Route::post('insert','Backend\system\Admin\YearController@insert')->name('year.insert');
            Route::post('/status', 'Backend\system\Admin\YearController@status')->name('year.status');
            Route::get('/edit','Backend\system\Admin\YearController@edit');
            Route::post('update','Backend\system\Admin\YearController@Update')->name('year.update');
            Route::get('delete/{id}','Backend\system\Admin\YearController@delete')->name('year.delete');
            //ajax route
            Route::get('/varify','Backend\system\Admin\YearController@varifyYear');
            Route::get('/update/varify','Backend\system\Admin\YearController@updatevarify');

        });


      //class routes
        Route::prefix('class')->group(function () {
            Route::get('section','Backend\system\Admin\ClassController@ClassSection')->name('class.section');
            Route::post('insert','Backend\system\Admin\ClassController@ClassInsert')->name('class.insert');
            Route::get('/classedit','Backend\system\Admin\ClassController@EditClass');
            Route::post('update','Backend\system\Admin\ClassController@UpdateClass')->name('class.update');
            Route::get('delete/{id}','Backend\system\Admin\ClassController@DeleteClass')->name('class.delete');
            //ajax route
            Route::get('/varifyname','Backend\system\Admin\ClassController@varifyname');
            Route::get('/update/varifyname','Backend\system\Admin\ClassController@updatevarifyname');

        });

        //section routes------------------------
        Route::prefix('section')->group(function () {
            Route::get('part','Backend\system\Admin\ClassController@SectionPart')->name('section.part');
            Route::post('insert','Backend\system\Admin\ClassController@SectionInsert')->name('section.insert');
            Route::get('delete/{id}','Backend\system\Admin\ClassController@DeleteSection')->name('section.delete');
            Route::get('/edit','Backend\system\Admin\ClassController@EditSection');
            Route::match(['GET', 'POST'],'update','Backend\system\Admin\ClassController@UpdateSection')->name('section.update');
            //ajax route
             Route::get('/get-section-name', 'Backend\system\Admin\ClassController@getSectionName');

        });




          //Course routes-----------------------
        Route::prefix('course')->group(function () {
            Route::get('all','Backend\system\Admin\CourseController@AllCourse')->name('all.course');
            Route::post('insert','Backend\system\Admin\CourseController@InsertCourse')->name('course.insert');
            Route::post('/status', 'Backend\system\Admin\CourseController@status')->name('course.status');
            Route::get('delete/{id}','Backend\system\Admin\CourseController@DeleteCourse')->name('course.delete');
            Route::get('/edit','Backend\system\Admin\CourseController@EditCourse');
            Route::post('update','Backend\system\Admin\CourseController@UpdateCourse')->name('course.update');
            //ajax route
            Route::get('/get-section-name', 'Backend\system\Admin\CourseController@getSectionName');
            Route::get('/search', 'Backend\system\Admin\CourseController@search')->name('search');
        });

          //exam routes------------------------
        Route::prefix('exam')->group(function () {

             Route::get('all','Backend\system\Admin\ExamController@AllExam')->name('all.exam');
             Route::get('/update/varifyname','Backend\system\Admin\ExamController@updatevarifyname');
             Route::post('insert','Backend\system\Admin\ExamController@InsertExam')->name('exam.insert');
             Route::get('delete/{id}','Backend\system\Admin\ExamController@DeleteExam')->name('exam.delete');
             Route::get('/edit','Backend\system\Admin\ExamController@EditExam');
             Route::post('update','Backend\system\Admin\ExamController@UpdateExam')->name('exam.update');
            //ajax route
            Route::get('/varifyname','Backend\system\Admin\ExamController@varifyname');
            Route::post('/status', 'Backend\system\Admin\ExamController@status')->name('exam.status');

        });



         //admission routes are here---------------
        Route::prefix('admission')->group(function () {
             Route::get('new-admission','Backend\system\Admin\AdmissionController@NewAdmission')->name('new.admission');
             Route::post('insert-admission','Backend\system\Admin\AdmissionController@InsertAdmission')->name('insert.admission');
             Route::get('today-admission','Backend\system\Admin\AdmissionController@TodayAdmission')->name('today.admission');
             Route::get('all','Backend\system\Admin\AdmissionController@AllAdmission')->name('all.admission');
             Route::get('edit/{id}','Backend\system\Admin\AdmissionController@edit')->name('admission.edit');
             Route::post('update/{id}','Backend\system\Admin\AdmissionController@UpdateAdmission')->name('admission.update');
             Route::get('view/{id}','Backend\system\Admin\AdmissionController@ViewAdmission')->name('admission.view');

              //ajax route
            Route::get('/fee','Backend\system\Admin\AdmissionController@fee');
            Route::get('/varifyusername','Backend\system\Admin\AdmissionController@varifyuserName');
            Route::get('/varifyemail','Backend\system\Admin\AdmissionController@varifyemail');
            Route::get('/search', 'Backend\system\Admin\AdmissionController@search')->name('search');
            Route::post('/status', 'Backend\system\Admin\AdmissionController@status')->name('status.admission');


             Route::get('delete/admission/{id}','Backend\system\Admin\AdmissionController@DeleteAdmission');
             Route::post('update/admission/{id}','Backend\system\Admin\AdmissionController@UpdateAdmission');
             Route::get('view/admission/{id}','Backend\system\Admin\AdmissionController@ViewAdmission');
             Route::get('admin/search/admission','Backend\system\Admin\AdmissionController@SearchAdmission')->name('search.admission');
             Route::post('admin/search/by/month','Backend\system\Admin\AdmissionController@SearchByMonth')->name('search.by.month');
             Route::post('admin/search/by/date','Backend\system\Admin\AdmissionController@SearchByDate')->name('search.by.date');
             Route::post('admin/search/by/class','Backend\system\Admin\AdmissionController@SearchByClass')->name('search.by.class');

            //Admission Gmail routes
            Route::get('gmail/{id}','Backend\system\Admin\gmailController@singlegmail')->name('admission.singlegmail');
            Route::post('send/{id}','Backend\system\Admin\gmailController@store')->name('gmail.store');
            Route::get('gmail/all','Backend\system\Admin\gmailController@all')->name('gmail.all');


            
         });

       

});



