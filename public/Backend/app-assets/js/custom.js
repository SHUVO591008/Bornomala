//Basic Select2 select
// $(".select2").select2({
//     dropdownAutoWidth: true,
//     width: '100%'
// });






//social Information handlebars-template
$(document).ready(function() {

    $(document).on("click", ".add", function() {

        //handlebars-template code
        var source = $('#document-template').html();
        var template = Handlebars.compile(source);
        var html = template();
        $('#addRow').append(html);


        //id generate
        const id = "id" + Date.now() + Math.random().toString().substr(2);

        $('#socialicon2').attr("id", id);
        $('#url').attr("id", "url" + id);

            //social group add
        $('#socialstatus2').attr("id", id);
         $('#name').attr("id", "name" + id);

        

        var dataerror = '.' + id;
        var urlerror = '.' + "url" + id;
        var nameerror = '.' + "name" + id;

        $('#' + id).attr("data-error", dataerror);
        $('#' + "url" + id).attr("data-error", urlerror);
        $('.socialicon0').attr("class", id);
        $('.urlerror').attr("class", "url" + id);
                //social group add
        $('.socialerrorStatus').attr("class", id);

        $('#' + "name" + id).attr("data-error", nameerror);
        $('.nameerror').attr("class", "name" + id);


        //script add
        $('#delete_add_more_item').append('<script>$(".select3").select2();$("select").formSelect();</script>');

        


    });



    //Remove Button
    $(document).on('click', ".removeeventmore", function(event) {
        var numItems = $('.delete_add_more_item').length
        if (numItems == 1) {
            alert('Sorry!It cannot be deleted.');
        } else {
            $(this).closest(".delete_add_more_item").remove();
        }
    });

});



//qualification handlebars-template
$(document).ready(function() {
    $(document).on("click", ".institute_name_add", function() {

        //handlebars-template code
        var source = $('#qualification-template').html();
        var template = Handlebars.compile(source);
        var html = template();
        $('#qualificationaddRow').append(html);


        //id generate
        const id = "id" + Date.now() + Math.random().toString().substr(3);

        $('#institute_name').attr("id", id);
        $('#subject').attr("id", "subject" + id);
        $('#qualification').attr("id", "qualification" + id);

        var dataerror = '.' + id;
        var subjecterror = '.' + "subject" + id;
        var qualificationerror = '.' + "qualification" + id;

        $('#' + id).attr("data-error", dataerror);
        $('#' + "subject" + id).attr("data-error", subjecterror);
        $('#' + "qualification" + id).attr("data-error", qualificationerror);

        $('.errorinstitute_name').attr("class", id);
        $('.errorsubject').attr("class", "subject" + id);
        $('.errorqualification').attr("class", "qualification" + id);





    });

    //Remove Button
    $(document).on('click', ".institute_nameremoveeventmore", function(event) {
        var numItems = $('.qualification_delete_add_more_item').length


        if (numItems == 1) {
            alert('Sorry!It cannot be deleted.');
        } else {
            $(this).closest(".qualification_delete_add_more_item").remove();
        }


    });
});


//qualification show or hide
$(document).ready(function() {

    var html = '<div class="qualificationaddRow" id="qualificationaddRow"><div id="qualification_delete_add_more_item" class="qualification_delete_add_more_item"><div class="input-field col m5 s12"><label for="institute_name1">Institute Name<span class="red-text"></span></label><input value="" id="institute_name1" type="text" name="institute_name[]" data-error=".errorTxt55"><small class="errorTxt55"></small></div><div class="input-field col m3 s12"><label for="subject1">Subject Name<span class="red-text"></span></label><input id="subject1" type="text" name="subject[]" data-error=".errorTxt556"><small class="errorTxt556"></small></div><div class="input-field col m2 s12"><label for="qualification1">Qualification/GPA<span class="red-text"></span></label><input id="qualification1" type="text" name="qualification[]" data-error=".errorTxt56"><small class="errorTxt56"></small></div><div class="input-field col m2 s6"><div id="institute_name_add" class="btn-light btn institute_name_add"><i class="fas fa-plus-circle"></i></div><div class="red btn institute_nameremoveeventmore"><i class="fas fa-minus-circle"></i></div></div></div></div>';

    $(document).on("change", ".role", function() {

        var data = $(this).val();
        if (data == 'teacher') {
            $('.last').after(html);

        } else {
            $('.qualificationaddRow').remove();

        }

    });

    var role = $('.role').children("option:selected").val();

    if (role == 'teacher') {
        $('.last').after(html);
    }
})



//slider  status showORhide Count

function sliderStatusShowHide() {

    $.ajax({
        url: 'ShowOrHide',
        type: 'GET',
        dataType: 'json',
        success: function(result) {
            $("#unpublished").text(result.Unpublished);
            $("#published").text(result.published);
        },

    });
}



//status active/inactive

$(document).ready(function() {
    $(".status").on("click", function() {

        var sliderLink = window.location.origin + '/slider/status';


        var link = $(this).attr("data-column");
        var dataId = $(this).attr("data-id");
        var check = $(this).val($(this).is(':checked'));
        var val = $(this).val();
        var updated_by = $(this).parents('tr').find('.updated_by');
        toastr.options = {
            "closeButton": false,
            "debug": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }


        $.ajax({
            url: link,
            type: 'post',
            data: {
                dataId: dataId,
                val: val,
            },
            dataType: 'json',
            success: function(result) {

                if (link == sliderLink) {
                    sliderStatusShowHide();
                }
                updated_by.text(result.authName);

                if(result.check){
                    toastr.error(result.check);
                }else{
                    toastr.success('Data Updated Successfully.');
                }


            },
            error: function(erro) {
                toastr.error('Data Not Updated.');

            },
        });


    });

});


//ShowOrHide settings active/inactive
$(document).ready(function() {
    $(".showOrhide").on("click", function() {
        var link = $(this).attr("data-column");
        var dataId = $(this).attr("data-id");
        var check = $(this).val($(this).is(':checked'));
        var val = $(this).val();


        toastr.options = {
            "closeButton": false,
            "debug": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }


        $.ajax({
            url: link,
            type: 'post',
            data: {
                dataId: dataId,
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                toastr.success('Data Updated Successfully.');
            },
            error: function(erro) {
                toastr.error('Data Not Updated.');

            },
        });


    });

});








$(document).ready(function() {

//position Left
// click li Function Left
$("#leftPosition .lwms-selectli").on("click", function(){

    var val = $(this).attr("data-value");

    $.ajax({
            url: 'leftposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);

            },

        });



    });

// click Addall Function Left
$('#leftPosition .lwms-addall').on("click", function(){

   var selected = $('#leftPosition .lwms-available .lwms-selectli').not('.lwms-selected');

   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");

      $.ajax({
            url: 'leftposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });

});

// click RemoveAll Function Left
$('#leftPosition .lwms-removeall').on("click", function(){

   var selected = $('#leftPosition .lwms-right .lwms-selectli');


   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");


      $.ajax({
            url: 'leftposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });
});

// click li Function Right
$("#rightPosition .lwms-selectli").on("click", function(){

        var val = $(this).attr("data-value");

        $.ajax({
            url: 'rightposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);

            },

        });



});




// click Addall Function Left
$('#rightPosition .lwms-addall').on("click", function(){

   var selected = $('#rightPosition .lwms-available .lwms-selectli').not('.lwms-selected');

   console.log(selected);

   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");

      $.ajax({
            url: 'rightposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });

});

// click RemoveAll Function Right
$('#rightPosition .lwms-removeall').on("click", function(){

   var selected = $('#rightPosition .lwms-right .lwms-selectli');


   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");


      $.ajax({
            url: 'rightposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });
});



    
//Footer Position
// click li Function footer position
$("#footerPosition .lwms-selectli").on("click", function(){

    var val = $(this).attr("data-value");

    $.ajax({
            url: 'footerposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);

            },

        });



    });

// click Addall Function footer position
$('#footerPosition .lwms-addall').on("click", function(){

   var selected = $('#footerPosition .lwms-available .lwms-selectli').not('.lwms-selected');

   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");

      $.ajax({
            url: 'footerposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });

});

// click RemoveAll Function footer position
$('#footerPosition .lwms-removeall').on("click", function(){

   var selected = $('#footerPosition .lwms-right .lwms-selectli');


   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");


      $.ajax({
            url: 'footerposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });
});


//Social Left Position
// click li Function social Left position
$("#SocialleftPosition .lwms-selectli").on("click", function(){

    var val = $(this).attr("data-value");

    $.ajax({
            url: 'socialleftposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);

            },

        });



    });

// click Addall Function Social Left position
$('#SocialleftPosition .lwms-addall').on("click", function(){

   var selected = $('#SocialleftPosition .lwms-available .lwms-selectli').not('.lwms-selected');

   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");

      $.ajax({
            url: 'socialleftposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });

});

// click RemoveAll Function Social Left position
$('#SocialleftPosition .lwms-removeall').on("click", function(){

   var selected = $('#SocialleftPosition .lwms-right .lwms-selectli');


   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");


      $.ajax({
            url: 'socialleftposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });
});



//Social Right Position
// click li Function social Right position
$("#SocialrightPosition .lwms-selectli").on("click", function(){

    var val = $(this).attr("data-value");

    $.ajax({
            url: 'socialrightposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);

            },

        });


    });


// click Addall Function Social Right position
$('#SocialrightPosition .lwms-addall').on("click", function(){

   var selected = $('#SocialrightPosition .lwms-available .lwms-selectli').not('.lwms-selected');

   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");

      $.ajax({
            url: 'socialrightposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });

});

// click RemoveAll Function Social Right position
$('#SocialrightPosition .lwms-removeall').on("click", function(){

   var selected = $('#SocialrightPosition .lwms-right .lwms-selectli');


   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");


      $.ajax({
            url: 'socialrightposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });
});


//Social Footer Position
// click li Function social Footer position
$("#SocialfooterPosition .lwms-selectli").on("click", function(){

    var val = $(this).attr("data-value");

    $.ajax({
            url: 'socialfooterposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result);

            },

        });


    });


// click Addall Function Social footer position
$('#SocialfooterPosition .lwms-addall').on("click", function(){

   var selected = $('#SocialfooterPosition .lwms-available .lwms-selectli').not('.lwms-selected');

   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");

      $.ajax({
            url: 'socialfooterposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });

});

// click RemoveAll Function Social footer position

$('#SocialfooterPosition .lwms-removeall').on("click", function(){

   var selected = $('#SocialfooterPosition .lwms-right .lwms-selectli');


   $.each(selected, function(key, value) {

    var val = $(this).attr("data-value");

      $.ajax({
            url: 'socialfooterposition',
            type: 'post',
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {

            },

        });
      });
});





});



 // Class Model ----Ajax
 $(document).on("click", ".editClass", function() {

        var val = $(this).attr("data-id");

        $.ajax({
            type: 'GET',
            url: '/class/classedit',
            
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                $('#modeldata').html(result)
            },
            error: function(result){
                alert("fail");
            },

        });

  
});


  // Section Model------Ajax
 $(document).on("click", ".editSection", function() {

    var val = $(this).attr("data-id");

    $.ajax({
        type: 'GET',
        url: '/section/edit',
        
        data: {
            val: val,
        },
        dataType: 'json',
        success: function(result) {
            $('#modeldata').html(result)
        },
        error: function(result){
            alert("fail");
        },

    });

  
});



  // Subject Model------Ajax
 $(document).on("click", ".editSubject", function() {

    var val = $(this).attr("data-id");

    $.ajax({
        type: 'GET',
        url: '/subject/edit',
        
        data: {
            val: val,
        },
        dataType: 'json',
        success: function(result) {
            $('#modeldata').html(result)
        },
        error: function(result){
            alert("fail");
        },

    });

  
});




 function getSectionName(argument){



    if(argument===undefined){
         var class_id = $('#class_id').val();
    }else{
         var class_id = argument.value;
    }


      $.ajax({
        type:"GET",
        url:"/section/get-section-name",
        data:{class_id:class_id},
        success:function(data){

           
            
            var html = '<option disabled value="">Section name typing....</option>';

            $.each(data,function(key,v){
                html +='<option selected value="'+v.section+'">'+v.section+'</option>';
            });

            if(argument===undefined){
                 $('#section').html(html);
            }else{
                  $('#section1').html(html);
            }


        }
    })

 }


$("#class_id").change(function () {
    getSectionName();

});


//Subject Information handlebars-template
$(document).ready(function() {

    //add Subject

    $(document).on("click", ".subjectadd", function() {

        //handlebars-template code
        var source = $('#subject-template').html();
        var template = Handlebars.compile(source);
        var html = template();
        $('#addRowsubject').append(html);


        //id generate
        const id = "id" + Date.now() + Math.random().toString().substr(2);

        $('#subject_name1').attr("id", id);
        $('#subject_code1').attr("id", "code" + id);



        var name = '.' + id;
        var code = '.' + "code" + id;


        $('#' + id).attr("data-error", name);
        $('#' + "code" + id).attr("data-error", code);

        $('.errorsubject_name0').attr("class", id);
        $('.errorsubject_code0').attr("class", "code" + id);


    });



    //Remove Button
    $(document).on('click', ".subjectremove", function(event) {
        var numItems = $('.delete_add_more_item').length
        if (numItems == 1) {
            alert('Sorry!It cannot be deleted.');
        } else {
            $(this).closest(".delete_add_more_item").remove();
        }
    });


       //Edit Subject

    $(document).on("click", ".subjectedit", function() {

        //handlebars-template code
        var source = $('#subject-edit-template').html();
        var template = Handlebars.compile(source);
        var html = template();
        $('#editRowsubject').append(html);


        //id generate
        const id = "id" + Date.now() + Math.random().toString().substr(2);

        $('#subject_name2').attr("id", id);
        $('#subject_code2').attr("id", "code" + id);



        var name = '.' + id;
        var code = '.' + "code" + id;


        $('#' + id).attr("data-error", name);
        $('#' + "code" + id).attr("data-error", code);

        $('.errorsubject_name1').attr("class", id);
        $('.errorsubject_code1').attr("class", "code" + id);


    });



    //Remove Button
    $(document).on('click', ".subjectEditremove", function(event) {
        var numItems = $('.delete_Edit_more_item').length
        if (numItems == 1) {
            alert('Sorry!It cannot be deleted.');
        } else {
            $(this).closest(".delete_Edit_more_item").remove();
        }
    });




});



 // Course Model------Ajax
 $(document).on("click", ".editCourse", function() {

    var val = $(this).attr("data-id");

    $.ajax({
        type: 'GET',
        url: '/course/edit',
        
        data: {
            val: val,
        },
        dataType: 'json',
        success: function(result) {
            $('#modeldata').html(result)
        },
        error: function(result){
            alert("fail");
        },

    });

  
});






//Course Information handlebars-template
$(document).ready(function() {

    //add Course

    $(document).on("click", ".courseadd", function() {

        //handlebars-template code
        var source = $('#course-template').html();
        var template = Handlebars.compile(source);
        var html = template();
        $('#addRowcourse').append(html);


        //id generate
        const id = "id" + Date.now() + Math.random().toString().substr(2);

        $('#course_name1').attr("id", id);
        $('#course_fee1').attr("id", "fee" + id);
        $('#course_type1').attr("id", "type" + id);
        $('#status1').attr("id", "status" + id);



        var name = '.' + id;
        var fee = '.' + "fee" + id;
        var type = '.' + "type" + id;
        var status = '.' + "status" + id;


        $('#' + id).attr("data-error", name);
        $('#' + "fee" + id).attr("data-error", fee);
        $('#' + "type" + id).attr("data-error", type);
        $('#' + "status" + id).attr("data-error", status);

        $('.errorcourse_name0').attr("class", id);
        $('.errorcourse_fee0').attr("class", "fee" + id);
        $('.errorcourse_type0').attr("class", "type" + id);
        $('.errorStatus0').attr("class", "status" + id);


        //script add
        $('#delete_add_more_item').append('<script>$(".select3").select2();');


    });



    //Remove Button
    $(document).on('click', ".courseremove", function(event) {
        var numItems = $('.delete_add_more_item').length
        if (numItems == 1) {
            alert('Sorry!It cannot be deleted.');
        } else {
            $(this).closest(".delete_add_more_item").remove();
        }
    });


       //Edit Course

    $(document).on("click", ".courseedit", function() {

        //handlebars-template code
        var source = $('#course-edit-template').html();
        var template = Handlebars.compile(source);
        var html = template();
        $('#editRowcourse').append(html);


        //id generate
        const id = "id" + Date.now() + Math.random().toString().substr(2);

         $('#course_name2').attr("id", id);
        $('#course_fee2').attr("id", "fee" + id);
        $('#course_type2').attr("id", "type" + id);
        $('#status2').attr("id", "status" + id);



        var name = '.' + id;
        var fee = '.' + "fee" + id;
        var type = '.' + "type" + id;
        var status = '.' + "status" + id;


        $('#' + id).attr("data-error", name);
        $('#' + "fee" + id).attr("data-error", fee);
        $('#' + "type" + id).attr("data-error", type);
        $('#' + "status" + id).attr("data-error", status);

        $('.errorcourse_name3').attr("class", id);
        $('.errorcourse_fee3').attr("class", "fee" + id);
        $('.errorcourse_type3').attr("class", "type" + id);
        $('.errorStatus3').attr("class", "status" + id);


        //script add
        $('#delete_Edit_more_item').append('<script>$(".select3").select2();');


    });



    //Remove Button
    $(document).on('click', ".courseEditremove", function(event) {
        var numItems = $('.delete_Edit_more_item').length
        if (numItems == 1) {
            alert('Sorry!It cannot be deleted.');
        } else {
            $(this).closest(".delete_Edit_more_item").remove();
        }
    });




});


 // Exam Model ----Ajax
 $(document).on("click", ".editExam", function() {

        var val = $(this).attr("data-id");

        $.ajax({
            type: 'GET',
            url: '/exam/edit',
            
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                $('#modeldata').html(result)
            },
            error: function(result){
                alert("fail");
            },

        });

  
});


  // Year Model ----Ajax
 $(document).on("click", ".editYear", function() {

        var val = $(this).attr("data-id");

        $.ajax({
            type: 'GET',
            url: '/year/edit',
            
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                $('#modeldata').html(result)
            },
            error: function(result){
                alert("fail");
            },

        });

  
});


   //Course Model ----Ajax
 $(document).on("click", ".editCourse", function() {

        var val = $(this).attr("data-id");

        $.ajax({
            type: 'GET',
            url: '/course/edit',
            
            data: {
                val: val,
            },
            dataType: 'json',
            success: function(result) {
                $('#modeldata').html(result)
            },
            error: function(result){
                alert("fail");
            },

        });

  
});



     // course search

    $(document).on('click','#SearchBtn',function(){

        var class_id = $('#class_id30').val();
        var section_id = $('#section_id30').val();
        var session_id = $('#year').val();

        $.ajax({
            url:"/course/search",
            type:"get",
            data:{'session_id':session_id,'class_id':class_id,'section_id':section_id},
            beforeSend:function(){
            },
            success:function(data){

                if(data.msg){
                    $('#msg_div').fadeIn();
                    $('#res_message').html(data.msg);
                    $('#documentResult').fadeOut();
                   $('#page-length-option').fadeIn();
                }else{
                    $('#documentResult').fadeIn();
                   $('#page-length-option').fadeOut();
                    $('#msg_div').fadeOut();
                }
                var source = $('#document-template-search').html();
                var template = Handlebars.compile(source);
                var html = template(data);
                $("#documentResult").html(html);
                
            }
        });
    });


// admission search

$(document).on('click','#admissionSearchBtn',function(){

var class_id = $('#class_id30').val();
var section_id = $('#section_id30').val();
var session_id = $('#year').val();

    $.ajax({
        url:"/admission/search",
        type:"get",
        data:{'session_id':session_id,'class_id':class_id,'section_id':section_id},
        beforeSend:function(){
        },
        success:function(data){

            if(data.msg){
                $('#msg_div').fadeIn();
                $('#res_message').html(data.msg);
                $('#documentResult').fadeOut();
                $('#page-length-option').fadeIn();
                $('.dataTables_wrapper').fadeIn();
            }else{
                $('#documentResult').fadeIn();
                $('#page-length-option').fadeOut();
                $('.dataTables_wrapper').fadeOut();
                $('#msg_div').fadeOut();
            }
            var source = $('#admission-template-search').html();
            var template = Handlebars.compile(source);
            var html = template(data);
            $("#documentResult").html(html);
            
        }
    });
});