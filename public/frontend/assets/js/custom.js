//$(document).ready(function() {
//
//    // Resive video
//    scaleVideoContainer();
//
//    
//    initBannerVideoSize('.video-container .filter');
//    initBannerVideoSize('.video-container video');
//        
//    $(window).on('resize', function() {
//        scaleVideoContainer();
//        
//        scaleBannerVideoSize('.video-container .filter');
//        scaleBannerVideoSize('.video-container video');
//    });
//
//});
//
///** Reusable Functions **/
///********************************************************************/
//
//function scaleVideoContainer() {
//
//    var height = $(window).height();
//    var unitHeight = parseInt(height) + 'px';
//    $('.homepage-hero-module').css('height',unitHeight);
//
//}
//
//function initBannerVideoSize(element){
//    
//    $(element).each(function(){
//        $(this).data('height', $(this).height());
//        $(this).data('width', $(this).width());
//    });
//
//    scaleBannerVideoSize(element);
//
//}
//
//function scaleBannerVideoSize(element){
//
//    var windowWidth = $(window).width(),
//        windowHeight = $(window).height(),
//        videoWidth,
//        videoHeight;
//    
//    console.log(windowHeight);
//
//    $(element).each(function(){
//        var videoAspectRatio = $(this).data('height')/$(this).data('width'),
//            windowAspectRatio = windowHeight/windowWidth;
//
//  
//
//        if (videoAspectRatio > windowAspectRatio) {
//            videoWidth = windowWidth;
//            videoHeight = videoWidth * videoAspectRatio;
//            $(this).css({'top' : -(videoHeight - windowHeight) / 2 + 'px', 'margin-left' : 0});
//        } else {
//            videoHeight = windowHeight;
//            videoWidth = videoHeight / videoAspectRatio;
//            $(this).css({'margin-top' : 0, 'margin-left' : -(videoWidth - windowWidth) / 2 + 'px'});
//        }
//
//        $(this).width(videoWidth).height(videoHeight);
//
//        $('.homepage-hero-module .video-container video').addClass('fadeIn animated');
//        
//
//    });
//}

// add more communication email on register

var communication_email_x = 1;
var communication_email_maxField = 10;
var communication_email_wrapper = $('.communication_email_div');
var communication_email_fieldHTML = '<div class="row form-elem">';

communication_email_fieldHTML += '<div class="col-sm-6 form-elem">';
communication_email_fieldHTML += '<div class="default-inp form-elem">';
communication_email_fieldHTML += '<i class="fa fa-envelope"></i><input type="text" name="user_c_email[]" class="communication_email" id="user-c-email" placeholder="Communication Email" required="required">';
communication_email_fieldHTML += '</div>';
communication_email_fieldHTML += '</div>';
communication_email_fieldHTML += '<div class="col-sm-1"><i class="fa fa-minus" style="padding-top: 20px;cursor: pointer;" id="remove_email"></i></div>';
communication_email_fieldHTML += '</div>';


$("#addmore").click(function () {
    if (communication_email_x < communication_email_maxField) { //Check maximum number of input fields

        var communication_email_val = $(this).closest('.communication_email_div').find('.communication_email:last').val();
        if (communication_email_val != 0) {
            if (isValidEmailAddress(communication_email_val)) {
                communication_email_x++; //Increment field counter
                $(communication_email_wrapper).append(communication_email_fieldHTML); // Add field html
            } else {
                alert('Please enter valid communication email');
            }
        } else {
            alert('Please fill communication email fields');
        }

    }
});

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}
;

$(communication_email_wrapper).on('click', '#remove_email', function (e) {
    e.preventDefault();
    $(this).parent('div').parent('div').remove(); //Remove field html
    communication_email_x--; //Decrement field counter
});



// ajax call on suburb type

$(document).ready(function () {
//    $('.suburb').keypress(function (e) {
//        
//        var suburb = $(this).val();
//       var token = $(this).data("token");
//       
//        $.ajax({
//            type: "POST",
//            url: '/searchSuburb',
//            data: {suburb: suburb,"_token":token},
//            success: function( msg ) {
//                //$("#ajaxResponse").append("<div>"+msg+"</div>");
//            }
//        });
//    });


//
// $(".suburb").autocomplete({
//        minLength: 2,
//        source: '/searchSuburb',
//        focus: function(event, ui) {
//            event.preventDefault();
//        console.log("hi");
//            $(this).val(ui.item.city);
//        },
//        select: function(event, ui) {
//            
//            console.log(ui);
//                       event.preventDefault();
////            $(this).val(ui.item.label);
////            $("#pickup_pin_code_hidden").val(ui.item.pin_code);
////            $("#pickup_locality_hidden").val(ui.item.locality);
////            $("#pickup_state_hidden").val(ui.item.state);
////            $("#pickup_locality_id").val(ui.item.id);
//           
//            
//        }
//    });




    $('.suburb').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '/searchSuburb',
                dataType: "json",
                data: {
                    term: request.term,
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        //var code = item.split("|");
                        return {
                            label: item.city,
                            value: item.city,
                            data: item
                        }
                    }));
                }
            });
        },
        //autoFocus: true,	      	
        minLength: 2,
        select: function (event, ui) {
            //var names = ui.item.data.split("|");	
            console.log(ui.item.data);
            $('#user-postcode').val(ui.item.data.pin_code);
            $('#user-state').val(ui.item.data.state);
            $('#user-suburb-id').val(ui.item.data.id);
            //$('#country_code_1').val(names[3]);
        }
    });



    $('.suburb-company').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '/searchSuburb',
                dataType: "json",
                data: {
                    term: request.term,
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        //var code = item.split("|");
                        return {
                            label: item.city,
                            value: item.id,
                            data: item
                        }
                    }));
                }
            });
        },
        //autoFocus: true,	      	
        minLength: 2,
        select: function (event, ui) {
            //var names = ui.item.data.split("|");	
            console.log(ui.item.data);
            $('#company-postcode').val(ui.item.data.pin_code);
            $('#company-state').val(ui.item.data.state);
            //$('#country_code_1').val(names[3]);
        }
    });


});