<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="SHUVO">
    <title>Bornomala Dashboard</title>


    <link rel="apple-touch-icon" href="{{ asset("Backend/app-assets/images/favicon/apple-touch-icon-152x152.png")}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset("Backend/app-assets/images/favicon/favicon-32x32.png")}}">
    <link href="{{ asset("Backend/icon.css?family=Material+Icons")}}" rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/vendors/vendors.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/css/pages/page-users.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/vendors/select2/select2.min.css") }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/vendors/select2/select2-materialize.css") }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/vendors/flag-icon/css/flag-icon.min.css") }}">
     <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/vendors/data-tables/css/select.dataTables.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/vendors/materialize-stepper/materialize-stepper.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/css/pages/form-select2.min.css")}}">

 
    <!-- END: VENDOR CSS-->

    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/css/themes/vertical-dark-menu-template/materialize.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/css/themes/vertical-dark-menu-template/style.min.css")}}">
     <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/css/pages/data-tables.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/css/pages/dashboard.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/css/pages/form-wizard.min.css")}}">


    <!-- END: Page Level CSS-->



    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/css/custom/custom.css")}}">

    <!-- END: Custom CSS-->

    <!-- toaster css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- sweet-alert css -->
    <link rel="stylesheet" type="text/css" href="{{ asset("Backend/app-assets/css/sweet-alert/sweet-alert.min.css")}}">


  

  <!-- Editor Plugin -->
    <style>
        .tox-notifications-container {
    display: none;
        }

        span.tox-statusbar__branding {
          display: none;
        }
    </style>


    <script src='{{ asset("Backend/app-assets/js/tinymce.min.js")}}' referrerpolicy="origin"></script>
      <script>
    tinymce.init({
        selector: 'textarea.mytextarea',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: "30s",
        autosave_prefix: "{path}{query}-{id}-",
        autosave_restore_when_empty: false,
        autosave_retention: "2m",
        image_advtab: true,
        /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
        link_list: [
            { title: 'My page 1', value: 'https://www.codexworld.com' },
            { title: 'My page 2', value: 'https://www.xwebtools.com' }
        ],
        image_list: [
            { title: 'My page 1', value: 'https://www.codexworld.com' },
            { title: 'My page 2', value: 'https://www.xwebtools.com' }
        ],
        image_class_list: [
            { title: 'None', value: '' },
            { title: 'Some class', value: 'class-name' }
        ],
        importcss_append: true,
        file_picker_callback: function (callback, value, meta) {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
            }
        
            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
            }
        
            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
            }
        },
        templates: [
            { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
            { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
            { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 400,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: "mceNonEditable",
        toolbar_mode: 'sliding',
        contextmenu: "link image imagetools table",
    });


      </script>
 <!-- Editor Plugin End-->


    @toastr_css 

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }
    </style>

  </head>
  <!-- END: Head-->

  <body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed">
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
          <div class="nav-wrapper">
            <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
              <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Explore Materialize" data-search="template-list">
              <ul class="search-list collection display-none"></ul>
            </div>
            <ul class="navbar-list right">
              <li class="dropdown-language"><a class="waves-effect waves-block waves-light translation-button" href="#" data-target="translation-dropdown"><span class="flag-icon flag-icon-gb"></span></a></li>
              <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
              <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
              <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">5</small></i></a></li>
              <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="{{ asset("Backend/app-assets/images/avatar/avatar-7.png")}}" alt="avatar"><i></i></span></a></li>
              <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a></li>
            </ul>
            <!-- translation-button-->
            <ul class="dropdown-content" id="translation-dropdown">
              <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="en"><i class="flag-icon flag-icon-gb"></i> English</a></li>
              <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a></li>
              <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></li>
              <li class="dropdown-item"><a class="grey-text text-darken-1" href="#!" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a></li>
            </ul>
            <!-- notifications-dropdown-->
            <ul class="dropdown-content" id="notifications-dropdown">
              <li>
                <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
              </li>
              <li class="divider"></li>
              <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
                <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
              </li>
              <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
              </li>
              <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
                <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
              </li>
              <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
                <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
              </li>
              <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
                <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
              </li>
            </ul>
            <!-- profile-dropdown-->
            <ul class="dropdown-content" id="profile-dropdown">
              <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i class="material-icons">person_outline</i> Profile</a></li>
              <li><a class="grey-text text-darken-1" href="app-chat.html"><i class="material-icons">chat_bubble_outline</i> Chat</a></li>
              <li><a class="grey-text text-darken-1" href="page-faq.html"><i class="material-icons">help_outline</i> Help</a></li>
              <li class="divider"></li>
              <li><a class="grey-text text-darken-1" href="user-lock-screen.html"><i class="material-icons">lock_outline</i> Lock</a></li>
              <li>
                <a class="grey-text text-darken-1" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>


              </li>
            </ul>
          </div>
          <nav class="display-none search-sm">
            <div class="nav-wrapper">
              <form id="navbarForm">
                <div class="input-field search-input-sm">
                  <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                  <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                  <ul class="search-list collection search-list-sm display-none"></ul>
                </div>
              </form>
            </div>
          </nav>
        </nav>
      </div>
    </header>
    <!-- END: Header-->
    <ul class="display-none" id="default-search-main">
      <li class="auto-suggestion-title"><a class="collection-item" href="#">
          <h6 class="search-title">FILES</h6></a></li>
      <li class="auto-suggestion"><a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar"><img src="{{ asset("Backend/app-assets/images/icon/pdf-image.png")}}" width="24" height="30" alt="sample image"></div>
              <div class="member-info display-flex flex-column"><span class="black-text">Two new item submitted</span><small class="grey-text">Marketing Manager</small></div>
            </div>
            <div class="status"><small class="grey-text">17kb</small></div>
          </div></a></li>
      <li class="auto-suggestion"><a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar"><img src="{{ asset("Backend/app-assets/images/icon/doc-image.png")}}" width="24" height="30" alt="sample image"></div>
              <div class="member-info display-flex flex-column"><span class="black-text">52 Doc file Generator</span><small class="grey-text">FontEnd Developer</small></div>
            </div>
            <div class="status"><small class="grey-text">550kb</small></div>
          </div></a></li>
      <li class="auto-suggestion"><a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar"><img src="{{ asset("Backend/app-assets/images/icon/xls-image.png")}}" width="24" height="30" alt="sample image"></div>
              <div class="member-info display-flex flex-column"><span class="black-text">25 Xls File Uploaded</span><small class="grey-text">Digital Marketing Manager</small></div>
            </div>
            <div class="status"><small class="grey-text">20kb</small></div>
          </div></a></li>
      <li class="auto-suggestion"><a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar"><img src="{{ asset("Backend/app-assets/images/icon/jpg-image.png")}}" width="24" height="30" alt="sample image"></div>
              <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
            </div>
            <div class="status"><small class="grey-text">37kb</small></div>
          </div></a></li>
      <li class="auto-suggestion-title"><a class="collection-item" href="#">
          <h6 class="search-title">MEMBERS</h6></a></li>
      <li class="auto-suggestion"><a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar"><img class="circle" src="{{ asset("Backend/app-assets/images/avatar/avatar-7.png")}}" width="30" alt="sample image"></div>
              <div class="member-info display-flex flex-column"><span class="black-text">John Doe</span><small class="grey-text">UI designer</small></div>
            </div>
          </div></a></li>
      <li class="auto-suggestion"><a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar"><img class="circle" src="{{ asset("Backend/app-assets/images/avatar/avatar-8.png")}}" width="30" alt="sample image"></div>
              <div class="member-info display-flex flex-column"><span class="black-text">Michal Clark</span><small class="grey-text">FontEnd Developer</small></div>
            </div>
          </div></a></li>
      <li class="auto-suggestion"><a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar"><img class="circle" src="{{ asset("Backend/app-assets/images/avatar/avatar-10.png")}}" width="30" alt="sample image"></div>
              <div class="member-info display-flex flex-column"><span class="black-text">Milena Gibson</span><small class="grey-text">Digital Marketing</small></div>
            </div>
          </div></a></li>
      <li class="auto-suggestion"><a class="collection-item" href="#">
          <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
              <div class="avatar"><img class="circle" src="{{ asset("Backend/app-assets/images/avatar/avatar-12.png")}}" width="30" alt="sample image"></div>
              <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
            </div>
          </div></a></li>
    </ul>
    <ul class="display-none" id="page-search-title">
      <li class="auto-suggestion-title"><a class="collection-item" href="#">
          <h6 class="search-title">PAGES</h6></a></li>
    </ul>
    <ul class="display-none" id="search-not-found">
      <li class="auto-suggestion"><a class="collection-item display-flex align-items-center" href="#"><span class="material-icons">error_outline</span><span class="member-info">No results found.</span></a></li>
    </ul>



 <!-- BEGIN: SideNav-->
 <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
    <div class="brand-sidebar">
      <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img class="hide-on-med-and-down " src="{{ asset("Backend/app-assets/images/logo/materialize-logo.png")}}" alt="materialize logo"><img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset("Backend/app-assets/images/logo/materialize-logo-color.png")}}" alt="materialize logo"><span class="logo-text hide-on-med-and-down">Materialize</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>


    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="accordion">

      <!-- User menu -->
        <li class="{{ request()->is('users/list') ? 'active' : '' || request()->is('users/view') ? 'active' : '' || request()->is('users/add') ? 'active' : '' }} bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">face</i><span class="menu-title" data-i18n="User">User</span></a>
            <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">

                <li class="{{ request()->is('users/list') ? 'active' : '' }}"><a class="{{ request()->is('users/list') ? 'active' : '' }}" href="{{ route('users.list') }}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="List">List</span></a>
                </li>

                <li class="{{ request()->is('users/add') ? 'active' : '' }}"><a class="{{ request()->is('users/add') ? 'active' : '' }}" href="{{ route('users.add') }}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Add">Add</span></a>
                </li>

            </ul>
            </div>
        </li>
      <!-- User menu End-->

      <!-- Website customize menu-->
      <li class="{{ request()->is('general/add') ? 'active' : '' || request()->is('general/edit/*') ? 'active' : '' || request()->is('general/socialedit/*') ? 'active' : '' || request()->is('general/view') ? 'active' : '' || request()->is('header/add') ? 'active' : '' || request()->is('header/edit/*') ? 'active' : '' ||  request()->is('news/add') ? 'active' : '' || request()->is('news/edit/*') ? 'active' : '' || request()->is('about/add') ? 'active' : '' ||request()->is('about/edit/*') ? 'active' : '' || request()->is('about/view/*') ? 'active' : '' ||request()->is('service/add') ? 'active' : '' || request()->is('service/edit/*') ? 'active' : '' ||request()->is('instituteDetails/add') ? 'active' : '' || request()->is('instituteDetails/edit/*') ? 'active' : '' ||  request()->is('slider/add') ? 'active' : '' || request()->is('slider/edit/*')? 'active' : '' || request()->is('slider/view/*') ? 'active' : '' || request()->is('settings/add') ? 'active' : '' || request()->is('settings/edit/*') ? 'active' : '' || request()->is('courseAdvertise/add') ? 'active' : '' || request()->is('courseAdvertise/edit/*') ? 'active' : '' ||  request()->is('QuestionsAns/add') ? 'active' : '' || request()->is('QuestionsAns/edit/*') ? 'active' : '' || request()->is('QuestionsAns/view') ? 'active' : '' ||  request()->is('social/add') ? 'active' : '' || request()->is('social/edit/*') ? 'active' : '' || request()->is('admin/details/add') ? 'active' : '' || request()->is('admin/details/edit/*') ? 'active' : '' ||request()->is('contact/details/add') ? 'active' : '' || request()->is('contact/details/edit/*') ? 'active' : '' ||  request()->is('contact/message') ? 'active' : '' || request()->is('contact/view/*') ? 'active' : ''  || request()->is('gallery/add') ? 'active' : '' || request()->is('gallery/edit/*') ? 'active' : '' || request()->is('gallery/view/*') ? 'active' : '' || request()->is('privacy-policy/add') ? 'active' : '' || request()->is('privacy-policy/edit/*') ? 'active' : '' || request()->is('terms-conditions/add') ? 'active' : '' || request()->is('terms-conditions/edit/*') ? 'active' : '' || request()->is('mail/add') ? 'active' : ''}} bold">


        <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons dp48">language</i><span class="menu-title" data-i18n="Website">Website Customize</span></a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">

            <!-- General menu-->
              <li class="{{ request()->is('general/add') ? 'active' : '' || request()->is('general/edit/*') ? 'active' : '' || request()->is('general/view') ? 'active' : '' || request()->is('general/socialedit/*') ? 'active' : '' }} "><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">General Settings</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('general.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>

                    <li><a href="{{route('general.view')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">View</span></a>
                    </li>

                  </ul>
                </div>
              </li>

              <!-- Header menu-->
               <li class="{{ request()->is('header/add') ? 'active' : '' || request()->is('header/edit/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Header Settings</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('header.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>

               <!-- Slider menu-->
               <li class="{{ request()->is('slider/add') ? 'active' : '' || request()->is('slider/edit/*') ? 'active' : '' || request()->is('slider/view/*') ? 'active' : '' }}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Slider Settings</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('slider.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>

               <!-- News menu-->
               <li class="{{ request()->is('news/add') ? 'active' : '' || request()->is('news/edit/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">News Scroll Settings</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('news.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>

               <!-- About menu-->
               <li class="{{ request()->is('about/add') ? 'active' : '' || request()->is('about/edit/*') ? 'active' : '' || request()->is('about/view/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">About Settings</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('about.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>


              <!-- Service menu-->
               <li class="{{ request()->is('service/add') ? 'active' : '' || request()->is('service/edit/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Service Settings</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('service.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>

              <!-- Institute menu-->
               <li class="{{ request()->is('instituteDetails/add') ? 'active' : '' || request()->is('instituteDetails/edit/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Study Institute</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('institute.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>

               <!-- Course Advertisement menu-->
               <li class="{{ request()->is('courseAdvertise/add') ? 'active' : '' || request()->is('courseAdvertise/edit/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Course Advertisement</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('courseAdvertise.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>



              <!-- Questions about us menu-->
               <li class="{{ request()->is('QuestionsAns/add') ? 'active' : '' || request()->is('QuestionsAns/edit/*') ? 'active' : '' || request()->is('QuestionsAns/view') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Questions about us</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('QuestionsAnswer.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>

              <!-- Social Share menu-->
               <li class="{{ request()->is('social/add') ? 'active' : '' || request()->is('social/edit/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Social Share</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('SocialShare.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>

               <!-- Admin Details menu-->
               <li class="{{ request()->is('admin/details/add') ? 'active' : '' || request()->is('admin/details/edit/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Admin Details</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('admin.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>


              <!-- Gallery menu-->
               <li class="{{ request()->is('gallery/add') ? 'active' : '' || request()->is('gallery/edit/*') ? 'active' : '' || request()->is('gallery/view/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Gallery</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                    <li><a href="{{route('gallery.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Add</span></a>
                    </li>
                  </ul>
                </div>
              </li>


              <!-- Contact Details menu-->
               <li class="{{ request()->is('contact/details/add') ? 'active' : '' || request()->is('contact/details/edit/*') ? 'active' : '' || request()->is('contact/message') ? 'active' : '' || request()->is('contact/view/*') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Contact Page</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">

                    <li><a href="{{route('contactDetails.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Details</span></a>
                    </li>

                 

                    <li><a href="{{route('contact.message')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Contact Message</span></a>
                    </li>

                  </ul>
                </div>
              </li>


               
    

               <!-- Settings menu-->
               <li class="{{ request()->is('settings/add') ? 'active' : '' || request()->is('settings/edit/*') ? 'active' : '' ||  request()->is('privacy-policy/add') ? 'active' : '' || request()->is('privacy-policy/edit/*') ? 'active' : '' || request()->is('terms-conditions/add') ? 'active' : '' || request()->is('terms-conditions/edit/*') ? 'active' : '' || request()->is('mail/add') ? 'active' : '' }}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Vertical">Settings</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">

                      <!-- Logo/Name menu-->
                     <li><a href="{{route('settings.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Logo/Name Setting</span></a>
                    </li>

                  <!-- Policy Details menu-->
                    <li>
                      <a href="{{route('privacypolicy.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Privacy Policy</span></a>
                    </li>

                     <!-- Terms and Conditions  menu-->
                    <li>
                      <a href="{{route('termsconditions.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Terms and Conditions</span></a>
                    </li>

                     <!--Mail Setting menu-->
                    <li>
                      <a href="{{route('mailSetting.add')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Email Setting</span></a>
                    </li>

                   


                  </ul>
                </div>
              </li>




            </ul>
          </div>
      </li>
      <!-- Website customize menu End-->


      <!-- Manage System menu-->
      <li class="{{request()->is('class/section') ? 'active' : '' || request()->is('section/part') ? 'active' : '' || request()->is('subject/all') ? 'active' : '' || request()->is('exam/all') ? 'active' : '' || request()->is('year/all') ? 'active' : '' || request()->is('course/all') ? 'active' : ''}} bold">

        <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons dp48">apps</i><span class="menu-title" data-i18n="Website">Manage System</span></a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">

              <!-- Manage Setup-->
               <li class="{{request()->is('class/section') ? 'active' : '' || request()->is('section/part') ? 'active' : '' || request()->is('subject/all') ? 'active' : '' || request()->is('exam/all') ? 'active' : '' || request()->is('year/all') ? 'active' : ''|| request()->is('course/all') ? 'active' : ''}}"><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="fa-regular fa-folder-open"></i><span data-i18n="Vertical">Manage Setup</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                     <!-- Year menu-->
                    <li>
                      <a href="{{route('all.year')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Year </span></a>
                    </li>

                    <!-- Class menu-->
                    <li>
                      <a href="{{route('class.section')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Class </span></a>
                    </li>
                    <!-- Section menu-->
                    <li>
                      <a href="{{route('section.part')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Section </span></a>
                    </li>
                 
                    <!-- Course menu-->
                    <li>
                      <a href="{{route('all.course')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Course </span></a>
                    </li>

                    <!-- Exam menu-->
                      <li>
                      <a href="{{route('all.exam')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">Exam Type </span></a>
                    </li>
                  </ul>
                </div>
              </li>

                <!-- Admission Setup-->
                <li class=""><a class="collapsible-header waves-effect waves-cyan" href="JavaScript:void(0)"><i class="fa-regular fa-folder-open"></i><span data-i18n="Vertical">Admission</span></a>
                <div class="collapsible-body">
                  <ul class="collapsible" data-collapsible="accordion">
                     <!-- Year menu-->
                    <li>
                      <a href="{{route('new.admission')}}"><i class="material-icons dp48">arrow_forward</i><span data-i18n="Modern Menu">New Admission </span></a>
                    </li>

          
                  </ul>
                </div>
              </li>
               
    

         



            </ul>
          </div>
      </li>
      <!--  Manage System menu End-->


    </ul>


    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
  <!-- END: SideNav-->

@yield('content')

<!-- START RIGHT SIDEBAR NAV -->

<aside id="right-sidebar-nav">
    <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
      <div class="row">
        <div class="slide-out-right-title">
          <div class="col s12 border-bottom-1 pb-0 pt-1">
            <div class="row">
              <div class="col s2 pr-0 center">
                <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
              </div>
              <div class="col s10 pl-0">
                <ul class="tabs">
                  <li class="tab col s4 p-0">
                    <a href="#messages" class="active">
                      <span>Messages</span>
                    </a>
                  </li>
                  <li class="tab col s4 p-0">
                    <a href="#settings">
                      <span>Settings</span>
                    </a>
                  </li>
                  <li class="tab col s4 p-0">
                    <a href="#activity">
                      <span>Activity</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="slide-out-right-body row pl-3">
          <div id="messages" class="col s12 pb-0">
            <div class="collection border-none mb-0">
              <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages">
              <ul class="collection right-sidebar-chat p-0 mb-0">
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-7.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Elizabeth Elliott</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                  </div>
                  <span class="secondary-content medium-small">5.00 AM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-1.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Mary Adams</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                  </div>
                  <span class="secondary-content medium-small">4.14 AM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-off avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-2.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Caleb Richards</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                  </div>
                  <span class="secondary-content medium-small">4.14 AM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-3.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Caleb Richards</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Keny !</p>
                  </div>
                  <span class="secondary-content medium-small">9.00 PM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-4.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">June Lane</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Ohh God</p>
                  </div>
                  <span class="secondary-content medium-small">4.14 AM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-off avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-5.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Edward Fletcher</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Love you</p>
                  </div>
                  <span class="secondary-content medium-small">5.15 PM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-6.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Crystal Bates</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can we</p>
                  </div>
                  <span class="secondary-content medium-small">8.00 AM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-off avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-7.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Nathan Watts</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Great!</p>
                  </div>
                  <span class="secondary-content medium-small">9.53 PM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-off avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-8.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Willard Wood</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Do it</p>
                  </div>
                  <span class="secondary-content medium-small">4.20 AM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-1.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Ronnie Ellis</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Got that</p>
                  </div>
                  <span class="secondary-content medium-small">5.20 AM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-9.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Daniel Russell</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                  </div>
                  <span class="secondary-content medium-small">12.00 AM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-off avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-10.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Sarah Graves</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Okay you</p>
                  </div>
                  <span class="secondary-content medium-small">11.14 PM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-off avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-11.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Andrew Hoffman</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can do</p>
                  </div>
                  <span class="secondary-content medium-small">7.30 PM</span>
                </li>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                  <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-12.png" alt="avatar">
                    <i></i>
                  </span>
                  <div class="user-content">
                    <h6 class="line-height-0">Camila Lynch</h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3">Leave it</p>
                  </div>
                  <span class="secondary-content medium-small">2.00 PM</span>
                </li>
              </ul>
            </div>
          </div>
          <div id="settings" class="col s12">
            <p class="setting-header mt-8 mb-3 ml-5 font-weight-900">GENERAL SETTINGS</p>
            <ul class="collection border-none">
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Notifications</span>
                  <div class="switch right">
                    <label>
                      <input checked="" type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Show recent activity</span>
                  <div class="switch right">
                    <label>
                      <input type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Show recent activity</span>
                  <div class="switch right">
                    <label>
                      <input type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Show Task statistics</span>
                  <div class="switch right">
                    <label>
                      <input type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Show your emails</span>
                  <div class="switch right">
                    <label>
                      <input type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Email Notifications</span>
                  <div class="switch right">
                    <label>
                      <input checked="" type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
            </ul>
            <p class="setting-header mt-7 mb-3 ml-5 font-weight-900">SYSTEM SETTINGS</p>
            <ul class="collection border-none">
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>System Logs</span>
                  <div class="switch right">
                    <label>
                      <input type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Error Reporting</span>
                  <div class="switch right">
                    <label>
                      <input type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Applications Logs</span>
                  <div class="switch right">
                    <label>
                      <input checked="" type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Backup Servers</span>
                  <div class="switch right">
                    <label>
                      <input type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
              <li class="collection-item border-none">
                <div class="m-0">
                  <span>Audit Logs</span>
                  <div class="switch right">
                    <label>
                      <input type="checkbox">
                      <span class="lever"></span>
                    </label>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div id="activity" class="col s12">
            <div class="activity">
              <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>
              <ul class="widget-timeline mb-0">
                <li class="timeline-items timeline-icon-green active">
                  <div class="timeline-time">Today</div>
                  <h6 class="timeline-title">Homepage mockup design</h6>
                  <p class="timeline-text">Melissa liked your activity.</p>
                  <div class="timeline-content orange-text">Important</div>
                </li>
                <li class="timeline-items timeline-icon-cyan active">
                  <div class="timeline-time">10 min</div>
                  <h6 class="timeline-title">Melissa liked your activity Drinks.</h6>
                  <p class="timeline-text">Here are some news feed interactions concepts.</p>
                  <div class="timeline-content green-text">Resolved</div>
                </li>
                <li class="timeline-items timeline-icon-red active">
                  <div class="timeline-time">30 mins</div>
                  <h6 class="timeline-title">12 new users registered</h6>
                  <p class="timeline-text">Here are some news feed interactions concepts.</p>
                  <div class="timeline-content">
                    <img src="../../../Backend/app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Registration.doc
                  </div>
                </li>
                <li class="timeline-items timeline-icon-indigo active">
                  <div class="timeline-time">2 Hrs</div>
                  <h6 class="timeline-title">Tina is attending your activity</h6>
                  <p class="timeline-text">Here are some news feed interactions concepts.</p>
                  <div class="timeline-content">
                    <img src="../../../Backend/app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Activity.doc
                  </div>
                </li>
                <li class="timeline-items timeline-icon-orange">
                  <div class="timeline-time">5 hrs</div>
                  <h6 class="timeline-title">Josh is now following you</h6>
                  <p class="timeline-text">Here are some news feed interactions concepts.</p>
                  <div class="timeline-content red-text">Pending</div>
                </li>
              </ul>
              <p class="mt-5 mb-0 ml-5 font-weight-900">APPLICATIONS LOGS</p>
              <ul class="widget-timeline mb-0">
                <li class="timeline-items timeline-icon-green active">
                  <div class="timeline-time">Just now</div>
                  <h6 class="timeline-title">New order received urgent</h6>
                  <p class="timeline-text">Melissa liked your activity.</p>
                  <div class="timeline-content orange-text">Important</div>
                </li>
                <li class="timeline-items timeline-icon-cyan active">
                  <div class="timeline-time">05 min</div>
                  <h6 class="timeline-title">System shutdown.</h6>
                  <p class="timeline-text">Here are some news feed interactions concepts.</p>
                  <div class="timeline-content blue-text">Urgent</div>
                </li>
                <li class="timeline-items timeline-icon-red">
                  <div class="timeline-time">20 mins</div>
                  <h6 class="timeline-title">Database overloaded 89%</h6>
                  <p class="timeline-text">Here are some news feed interactions concepts.</p>
                  <div class="timeline-content">
                    <img src="../../../Backend/app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Database-log.doc
                  </div>
                </li>
              </ul>
              <p class="mt-5 mb-0 ml-5 font-weight-900">SERVER LOGS</p>
              <ul class="widget-timeline mb-0">
                <li class="timeline-items timeline-icon-green active">
                  <div class="timeline-time">10 min</div>
                  <h6 class="timeline-title">System error</h6>
                  <p class="timeline-text">Melissa liked your activity.</p>
                  <div class="timeline-content red-text">Error</div>
                </li>
                <li class="timeline-items timeline-icon-cyan">
                  <div class="timeline-time">1 min</div>
                  <h6 class="timeline-title">Production server down.</h6>
                  <p class="timeline-text">Here are some news feed interactions concepts.</p>
                  <div class="timeline-content blue-text">Urgent</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide Out Chat -->
    <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
      <li class="center-align pt-2 pb-2 sidenav-close chat-head">
        <a href="#!"><i class="material-icons mr-0">chevron_left</i>Elizabeth Elliott</a>
      </li>
      <li class="chat-body">
        <ul class="collection">
          <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
            <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-7.png" alt="avatar">
            </span>
            <div class="user-content speech-bubble">
              <p class="medium-small">hello!</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
            <div class="user-content speech-bubble-right">
              <p class="medium-small">How can we help? We're here for you!</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
            <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-7.png" alt="avatar">
            </span>
            <div class="user-content speech-bubble">
              <p class="medium-small">I am looking for the best admin template.?</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
            <div class="user-content speech-bubble-right">
              <p class="medium-small">Materialize admin is the responsive materializecss admin template.</p>
            </div>
          </li>

          <li class="collection-item display-grid width-100 center-align">
            <p>8:20 a.m.</p>
          </li>

          <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
            <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-7.png" alt="avatar">
            </span>
            <div class="user-content speech-bubble">
              <p class="medium-small">Ohh! very nice</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
            <div class="user-content speech-bubble-right">
              <p class="medium-small">Thank you.</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
            <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-7.png" alt="avatar">
            </span>
            <div class="user-content speech-bubble">
              <p class="medium-small">How can I purchase it?</p>
            </div>
          </li>

          <li class="collection-item display-grid width-100 center-align">
            <p>9:00 a.m.</p>
          </li>

          <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
            <div class="user-content speech-bubble-right">
              <p class="medium-small">From ThemeForest.</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
            <div class="user-content speech-bubble-right">
              <p class="medium-small">Only $24</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
            <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-7.png" alt="avatar">
            </span>
            <div class="user-content speech-bubble">
              <p class="medium-small">Ohh! Thank you.</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
            <span class="avatar-status avatar-online avatar-50"><img src="../../../Backend/app-assets/images/avatar/avatar-7.png" alt="avatar">
            </span>
            <div class="user-content speech-bubble">
              <p class="medium-small">I will purchase it for sure.</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
            <div class="user-content speech-bubble-right">
              <p class="medium-small">Great, Feel free to get in touch on</p>
            </div>
          </li>
          <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
            <div class="user-content speech-bubble-right">
              <p class="medium-small">https://pixinvent.ticksy.com/</p>
            </div>
          </li>
        </ul>
      </li>
      <li class="center-align chat-footer">
        <form class="col s12" onsubmit="slideOutChat()" action="javascript:void(0);">
          <div class="input-field">
            <input id="icon_prefix" type="text" class="search">
            <label for="icon_prefix">Type here..</label>
            <a onclick="slideOutChat()"><i class="material-icons prefix">send</i></a>
          </div>
        </form>
      </li>
    </ul>
</aside>
<!-- END RIGHT SIDEBAR NAV -->
    <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons">add</i></a>
    <ul>
        <li><a href="css-helpers.html" class="btn-floating blue"><i class="material-icons">help_outline</i></a></li>
        <li><a href="cards-extended.html" class="btn-floating green"><i class="material-icons">widgets</i></a></li>
        <li><a href="app-calendar.html" class="btn-floating amber"><i class="material-icons">today</i></a></li>
        <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a></li>
    </ul>
    </div>
    </div>
        <div class="content-overlay"></div>
    </div>
    </div>
    </div>


 <!-- Theme Customizer -->

 <a href="#" data-target="theme-cutomizer-out" class="btn btn-customizer pink accent-2 white-text sidenav-trigger theme-cutomizer-trigger"><i class="material-icons">settings</i></a>

 <div id="theme-cutomizer-out" class="theme-cutomizer sidenav row">
    <div class="col s12">
       <a class="sidenav-close" href="#!"><i class="material-icons">close</i></a>
       <h5 class="theme-cutomizer-title">Theme Customizer</h5>
       <p class="medium-small">Customize & Preview in Real Time</p>
       <div class="menu-options">
          <h6 class="mt-6">Menu Options</h6>
          <hr class="customize-devider">
          <div class="menu-options-form row">
             <div class="input-field col s12 menu-color mb-0">
                <p class="mt-0">Menu Color</p>
                <div class="gradient-color center-align">
                   <span class="menu-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                   <span class="menu-color-option gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
                   <span class="menu-color-option gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
                   <span class="menu-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                   <span class="menu-color-option gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
                   <span class="menu-color-option gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
                   <span class="menu-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                   <span class="menu-color-option gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
                   <span class="menu-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
                </div>
                <div class="solid-color center-align">
                   <span class="menu-color-option red" data-color="red"></span>
                   <span class="menu-color-option purple" data-color="purple"></span>
                   <span class="menu-color-option pink" data-color="pink"></span>
                   <span class="menu-color-option deep-purple" data-color="deep-purple"></span>
                   <span class="menu-color-option cyan" data-color="cyan"></span>
                   <span class="menu-color-option teal" data-color="teal"></span>
                   <span class="menu-color-option light-blue" data-color="light-blue"></span>
                   <span class="menu-color-option amber darken-3" data-color="amber darken-3"></span>
                   <span class="menu-color-option brown darken-2" data-color="brown darken-2"></span>
                </div>
             </div>
             <div class="input-field col s12 menu-bg-color mb-0">
                <p class="mt-0">Menu Background Color</p>
                <div class="gradient-color center-align">
                   <span class="menu-bg-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                   <span class="menu-bg-color-option gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
                   <span class="menu-bg-color-option gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
                   <span class="menu-bg-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                   <span class="menu-bg-color-option gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
                   <span class="menu-bg-color-option gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
                   <span class="menu-bg-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                   <span class="menu-bg-color-option gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
                   <span class="menu-bg-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
                </div>
                <div class="solid-color center-align">
                   <span class="menu-bg-color-option red" data-color="red"></span>
                   <span class="menu-bg-color-option purple" data-color="purple"></span>
                   <span class="menu-bg-color-option pink" data-color="pink"></span>
                   <span class="menu-bg-color-option deep-purple" data-color="deep-purple"></span>
                   <span class="menu-bg-color-option cyan" data-color="cyan"></span>
                   <span class="menu-bg-color-option teal" data-color="teal"></span>
                   <span class="menu-bg-color-option light-blue" data-color="light-blue"></span>
                   <span class="menu-bg-color-option amber darken-3" data-color="amber darken-3"></span>
                   <span class="menu-bg-color-option brown darken-2" data-color="brown darken-2"></span>
                </div>
             </div>
             <div class="input-field col s12">
                <div class="switch">
                   Menu Dark
                   <label class="float-right"><input class="menu-dark-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
                </div>
             </div>
             <div class="input-field col s12">
                <div class="switch">
                   Menu Collapsed
                   <label class="float-right"><input class="menu-collapsed-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
                </div>
             </div>
             <div class="input-field col s12">
                <div class="switch">
                   <p class="mt-0">Menu Selection</p>
                   <label>
                      <input class="menu-selection-radio with-gap" value="sidenav-active-square" name="menu-selection" type="radio">
                      <span>Square</span>
                   </label>
                   <label>
                      <input class="menu-selection-radio with-gap" value="sidenav-active-rounded" name="menu-selection" type="radio">
                      <span>Rounded</span>
                   </label>
                   <label>
                      <input class="menu-selection-radio with-gap" value="" name="menu-selection" type="radio">
                      <span>Normal</span>
                   </label>
                </div>
             </div>
          </div>
       </div>
       <h6 class="mt-6">Navbar Options</h6>
       <hr class="customize-devider">
       <div class="navbar-options row">
          <div class="input-field col s12 navbar-color mb-0">
             <p class="mt-0">Navbar Color</p>
             <div class="gradient-color center-align">
                <span class="navbar-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                <span class="navbar-color-option gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
                <span class="navbar-color-option gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
                <span class="navbar-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                <span class="navbar-color-option gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
                <span class="navbar-color-option gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
                <span class="navbar-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                <span class="navbar-color-option gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
                <span class="navbar-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
             </div>
             <div class="solid-color center-align">
                <span class="navbar-color-option red" data-color="red"></span>
                <span class="navbar-color-option purple" data-color="purple"></span>
                <span class="navbar-color-option pink" data-color="pink"></span>
                <span class="navbar-color-option deep-purple" data-color="deep-purple"></span>
                <span class="navbar-color-option cyan" data-color="cyan"></span>
                <span class="navbar-color-option teal" data-color="teal"></span>
                <span class="navbar-color-option light-blue" data-color="light-blue"></span>
                <span class="navbar-color-option amber darken-3" data-color="amber darken-3"></span>
                <span class="navbar-color-option brown darken-2" data-color="brown darken-2"></span>
             </div>
          </div>
          <div class="input-field col s12">
             <div class="switch">
                Navbar Dark
                <label class="float-right"><input class="navbar-dark-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
             </div>
          </div>
          <div class="input-field col s12">
             <div class="switch">
                Navbar Fixed
                <label class="float-right"><input class="navbar-fixed-checkbox" type="checkbox" checked/=""> <span class="lever ml-0"></span></label>
             </div>
          </div>
       </div>
       <h6 class="mt-6">Footer Options</h6>
       <hr class="customize-devider">
       <div class="navbar-options row">
          <div class="input-field col s12">
             <div class="switch">
                Footer Dark
                <label class="float-right"><input class="footer-dark-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
             </div>
          </div>
          <div class="input-field col s12">
             <div class="switch">
                Footer Fixed
                <label class="float-right"><input class="footer-fixed-checkbox" type="checkbox"> <span class="lever ml-0"></span></label>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!--/ Theme Customizer -->


    <!-- BEGIN: Footer-->
    <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
      <div class="footer-copyright">
        <div class="container"><span>&copy; 2020 <a href="" target="_blank">PIXINVENT</a> All rights reserved.</span><span class="right hide-on-small-only">Design and Developed by <a href="https://pixinvent.com/">PIXINVENT</a></span></div>
      </div>
    </footer>
    <!-- END: Footer-->
    
 
   
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset("Backend/app-assets/js/vendors.min.js")}}"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset("Backend/app-assets/vendors/chartjs/chart.min.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/vendors/data-tables/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/vendors/select2/select2.full.min.js") }}"></script>
    <script src="{{ asset("Backend/app-assets/vendors/jquery-validation/jquery.validate.min.js") }}"></script>

    <script src="{{ asset("Backend/app-assets/vendors/materialize-stepper/materialize-stepper.min.js") }}"></script>
    <script src="{{ asset("Backend/app-assets/vendors/data-tables/js/dataTables.select.min.js")}}"></script>

    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN THEME  JS-->
    <script src="{{ asset("Backend/app-assets/js/plugins.min.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/js/search.min.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/js/custom/custom-script.min.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/js/scripts/customizer.min.js")}}"></script>
    <!-- END THEME  JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset("Backend/app-assets/js/scripts/dashboard-ecommerce.min.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/js/scripts/page-users.min.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/js/scripts/form-wizard.min.js") }}"></script>

    <script src="{{ asset("Backend/app-assets/js/scripts/form-select2.min.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/js/scripts/ui-alerts.min.js")}}"></script>

    <script src="{{asset("Backend/app-assets/vendors/quill/katex.min.js")}}"></script>
    <script src="{{asset("Backend/app-assets/vendors/quill/highlight.min.js")}}"></script>
    <script src="{{asset("Backend/app-assets/vendors/quill/quill.min.js")}}"></script>

     <script src="{{asset("Backend/app-assets/js/scripts/data-tables.min.js")}}"></script>

     <script src="{{asset("Backend/app-assets/js/scripts/advance-ui-modals.min.js")}}"></script>


    <!-- END PAGE LEVEL JS-->


     <!-- Custom js -->
     <script src="{{ asset("Backend/app-assets/js/custom.js")}}"></script>
     <script src="{{ asset("Backend/app-assets/js/validate.js")}}"></script>
     <!--/ Custom js -->

    <!-- X-handlebars js -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js" integrity="sha512-zT3zHcFYbQwjHdKjCu6OMmETx8fJA9S7E6W7kBeFxultf75OPTYUJigEKX58qgyQMi1m1EgenfjMXlRZG8BXaw==" crossorigin="anonymous"></script>
    <!--/End X-handlebars -->

    <!-- toaster js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
    
    <!-- sweet-alert js -->
    <script src="{{ asset("Backend/app-assets/js/sweet-alert/sweet-alert.init.js")}}"></script>
    <script src="{{ asset("Backend/app-assets/js/sweet-alert/sweet-alert.min.js")}}"></script>









  </body>

  @toastr_js
@toastr_render

</html>
