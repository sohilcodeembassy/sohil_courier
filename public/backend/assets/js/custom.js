$(function() {

    var stack_custom_bottom = {"dir1": "up", "dir2": "right", "spacing1": 1};
    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        responsive: true,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    // Modal template
    var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
        '  <div class="modal-content">\n' +
        '    <div class="modal-header">\n' +
        '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
        '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
        '    </div>\n' +
        '    <div class="modal-body">\n' +
        '      <div class="floating-buttons btn-group"></div>\n' +
        '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>\n';
        // Buttons inside zoom modal
    var previewZoomButtonClasses = {
        toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
        fullscreen: 'btn btn-default btn-icon btn-xs',
        borderless: 'btn btn-default btn-icon btn-xs',
        close: 'btn btn-default btn-icon btn-xs'
    };

    // Icons inside zoom modal classes
    var previewZoomButtonIcons = {
        prev: '<i class="icon-arrow-left32"></i>',
        next: '<i class="icon-arrow-right32"></i>',
        toggleheader: '<i class="icon-menu-open"></i>',
        fullscreen: '<i class="icon-screen-full"></i>',
        borderless: '<i class="icon-alignment-unalign"></i>',
        close: '<i class="icon-cross3"></i>'
    };

    // File actions
    var fileActionSettings = {
        zoomClass: 'btn btn-link btn-xs btn-icon',
        zoomIcon: '<i class="icon-zoomin3"></i>',
        dragClass: 'btn btn-link btn-xs btn-icon',
        dragIcon: '<i class="icon-three-bars"></i>',
        removeClass: 'btn btn-link btn-icon btn-xs',
        removeIcon: '<i class="icon-trash"></i>',
        indicatorNew: '<i class="icon-file-plus text-slate"></i>',
        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
    };


    $('.select').select2({
        containerCssClass: 'select-lg'
    });

    $(".selectbox").selectBoxIt({
        autoWidth: false 
    });


    /* ------------------------------------------Login form Management (validation)------------------------------------*/



    // Setup validation
    $(".admin-login-form").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
            email: {
                email: true
            },
            password: {
                minlength: 6
            }
        },
        messages: {
            username: "Enter your username",
            password: {
            	required: "Enter your password",
            	minlength: jQuery.validator.format("At least {0} characters required")
            }
        }
    });

    /* ------------------------------------------User Management (validation)------------------------------------*/
    // Setup validation
    $(".user_form").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
            category_name: {
                minlength: 2,
                maxlength: 30,
            }
        },
        messages: {
            category_name: "Enter your category name",
        }
    });

    //datatable
    $('.user_datatable').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [4]
            },
            { 
                orderable: false,
                targets: [4]
            }
        ],
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy position-left"></i> COPY',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-excel position-left"></i> EXCEL',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.csv'
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
        order: [1, 'asc'],
    });

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
            //console.log(ui.item.data);
            $('#postcode').val(ui.item.data.pin_code);
            $('#state').val(ui.item.data.state);
            $('#suburb_id').val(ui.item.data.id);
            //$('#country_code_1').val(names[3]);
        }
    });

    $('.company_suburb').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '/searchSuburb',
                dataType: "json",
                data: {
                    term: request.term,
                },
                success: function (data) {
                    response($.map(data, function (item) {
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
            //console.log(ui.item.data);
            $('#company_postcode').val(ui.item.data.pin_code);
            $('#company_state').val(ui.item.data.state);
            $("#company_suburb_id").val(ui.item.data.id);
        }
    });

    //Add more communication email
    var c_email_x = 1;
    var c_email_maxField = 10;
    var c_email_wrapper = $('.communication_email_div');
    var c_email_fieldHTML = '<div class="row">';
            c_email_fieldHTML += '<div class="col-md-6">';
                c_email_fieldHTML += '<div class="form-group">';
                c_email_fieldHTML += '<label> </label>';
                    c_email_fieldHTML += '<input type="text" name="c_email[]" placeholder="Enter Communication Email" class="form-control communication_email" required="">';
                c_email_fieldHTML += '</div>';
            c_email_fieldHTML += '</div>';

            c_email_fieldHTML += '<div class="col-md-6">';
                c_email_fieldHTML += '<div class="form-group">';
                c_email_fieldHTML += '<label> </label>';
                    c_email_fieldHTML += '<a href="javascript:void(0)" class="text-danger-600 remove_a"><i class="icon-minus-circle2 c_email_remove" data-id="" data-userid="" data-url="" data-token=""></i></a>';
                c_email_fieldHTML += '</div>';
            c_email_fieldHTML += '</div>';
        c_email_fieldHTML += '</div>';


    $(".addmore").click(function () {
        if (c_email_x < c_email_maxField) { //Check maximum number of input fields

            var c_email_val = $(this).closest('.communication_email_div').find('.communication_email:last').val();
            if (c_email_val != 0) {
                if (isValidEmailAddress(c_email_val)) {
                    c_email_x++; //Increment field counter
                    $(c_email_wrapper).append(c_email_fieldHTML); // Add field html
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
    

    // $(c_email_wrapper).on('click', '.c_email_remove', function (e) {
    //     e.preventDefault();
    //     $(this).closest('.communication_email_div').find('.row:last').remove();
    //     c_email_x--; //Decrement field counter
    // });

    // communication user email delete
    $(c_email_wrapper).on('click','.c_email_remove',function(){
            var me = $(this);
            var id = me.data('id');
            var userid = me.data('userid');
            var token = me.data('token');
            var cat_count = $('.cat_count').html();
            var url = me.data('url');
            
            if(userid == '' && id == '' && url == '' && token == ''){
                me.closest('.communication_email_div').find('.row:last').remove();
                c_email_x--;

            }else{  

                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this email!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url:url,
                            data: {
                                "id": id,
                                "user_id": userid,
                                "_token": token,
                            },
                            dataType:'json',
                            success:function(data){
                                if(data.status == 'success'){
                                    me.closest('.communication_email_div').find('.row:last').remove();
                                    c_email_x--;
                                    // me.closest('tr').fadeOut(2000);
                                    // $('.cat_count').html(cat_count - 1);
                                    swal({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Cancelled",
                            text: "Your file is safe :)",
                            confirmButtonColor: "#2196F3",
                            type: "error",
                            timer: 1000
                        });
                    }
                });
            }
        });


    //Status Active deactive
        $(document.body).on('click','.user_status',function(){
            var me = $(this);
            var id = me.data('id');
            var status = me.html();
            var token = me.data('token');
            var url = me.data('url');


            if(status == 'Active'){
                var label = 'Deactive';
            }else{
                var label = 'Active';
            }
                    
            swal({
                title: "Are you sure?",
                text: "Are you sure "+label+" this User?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, "+label+" it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type:'post',
                        url:url,
                        data: {
                            "id": id,
                            "status": status,
                            "_token": token,
                        },
                        dataType:'json',
                        success:function(data){
                            if(data.status == 'success'){
                                if(data.action == 'deactive'){
                                    me.text('Active');
                                    me.attr({
                                        "title" : "Click to Deactive",
                                        "class" : "label label-success user_status"
                                    });
                                }else if(data.action == 'active'){
                                    me.text('Deactive');
                                    me.attr({
                                        "title" : "Click to Active",
                                        "class" : "label label-danger user_status"
                                    });
                                }

                                swal({
                                    title: "Status changed!",
                                    text: "Your status has been changed.",
                                    confirmButtonColor: "#66BB6A",
                                    type: "success",
                                    timer: 1000
                                });
                            }
                        }
                    });
                }else {
                    swal({
                        title: "Cancelled",
                        text: "No status changed :)",
                        confirmButtonColor: "#2196F3",
                        type: "error",
                        timer: 1000
                    });
                }
            });
        });

    //User Delete
        $(document.body).on('click','.delete_user',function(){
            var me = $(this);
            var id = me.data('id');
            var token = me.data('token');
            var cat_count = $('.cat_count').html();
            var url = me.data('url');
                    
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url:url,
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            dataType:'json',
                            success:function(data){
                                if(data.status == 'success'){
                                    me.closest('tr').fadeOut(2000);
                                    $('.cat_count').html(cat_count - 1);
                                    swal({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Cancelled",
                            text: "Your file is safe :)",
                            confirmButtonColor: "#2196F3",
                            type: "error",
                            timer: 1000
                        });
                    }
                });
        });

    //User member portal form
        $(".user_member_portal_form").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent().parent().parent() );
                    }
                     else {
                        error.appendTo( element.parent().parent().parent().parent().parent() );
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo( element.parent().parent().parent() );
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent() );
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                else {
                    error.insertAfter(element);
                }
            },
            validClass: "validation-valid-label",
            success: function(label) {
                label.addClass("validation-valid-label").text("Successfully")
            },
            submitHandler: function(form) {
                loader('body');
                form.submit();
            },
            rules: {
                password: {
                    minlength: 6,
                }
            },
            messages: {
                category_name: "Enter blog title",
            }
        }); 

    //domestic pricing portal api form
        $(".domestic_pricing_portal_api_form").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent().parent().parent() );
                    }
                     else {
                        error.appendTo( element.parent().parent().parent().parent().parent() );
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo( element.parent().parent().parent() );
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent() );
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                else {
                    error.insertAfter(element);
                }
            },
            validClass: "validation-valid-label",
            success: function(label) {
                label.addClass("validation-valid-label").text("Successfully")
            },
            submitHandler: function(form) {
                loader('body');
                form.submit();
            },
            rules: {
                password: {
                    minlength: 6,
                }
            },
            messages: {
                category_name: "Enter blog title",
            }
        });  

    //international pricing portal api form
        $(".international_pricing_portal_api_form").validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error-label',
            successClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent().parent().parent() );
                    }
                     else {
                        error.appendTo( element.parent().parent().parent().parent().parent() );
                    }
                }

                // Unstyled checkboxes, radios
                else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                    error.appendTo( element.parent().parent().parent() );
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent() );
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }

                else {
                    error.insertAfter(element);
                }
            },
            validClass: "validation-valid-label",
            success: function(label) {
                label.addClass("validation-valid-label").text("Successfully")
            },
            submitHandler: function(form) {
                loader('body');
                form.submit();
            },
            rules: {
                password: {
                    minlength: 6,
                }
            },
            messages: {
                category_name: "Enter blog title",
            }
        });

    // Pricinig portal api datatable    
    $('.pricing_portal_api_datatable').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [4]
            },
            { 
                orderable: false,
                targets: [4]
            }
        ],
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy position-left"></i> COPY',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-excel position-left"></i> EXCEL',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.csv'
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
        order: [1, 'asc'],
    });
            

        $(".pp_api_enable_disable").bootstrapSwitch();

        $(document.body).on('switchChange.bootstrapSwitch','.pp_api_enable_disable',function(){
            var me = $(this);
            var checkStatus = this.checked ? 'enable' : 'disable';
            var token = $(this).data('token');
            var api_type = $(this).data('atype');
            var url = $(this).data('url');
            var user_id = $(this).data('userid');

            loader('body');
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    'status' : checkStatus,
                    'api_type': api_type,
                    'user_id' : user_id,
                    '_token': token,
                },
                dataType: 'json',
                success:function(data){
                    unloader('body');
                    if(api_type == 'domestic'){
                        if(data.action == 'enable'){
                            me.closest('.panel').find(".pricing_portal_api_datatable").find('.pp_api_status').text('Active');
                            me.closest('.panel').find(".pricing_portal_api_datatable").find('.pp_api_status').attr({
                                "title" : "Click to Deactive",
                                "class" : "label label-success pp_api_status"
                            });
                        }else if(data.action == 'disable'){
                            me.closest('.panel').find(".pricing_portal_api_datatable").find('.pp_api_status').text('Deactive');
                            me.closest('.panel').find(".pricing_portal_api_datatable").find('.pp_api_status').attr({
                                "title" : "Click to Active",
                                "class" : "label label-danger pp_api_status"
                            });
                        }
                    }else if(api_type == 'international'){
                        if(data.action == 'enable'){
                            me.closest('.panel').find(".pricing_portal_api_datatable").find('.pp_api_status').text('Active');
                            me.closest('.panel').find(".pricing_portal_api_datatable").find('.pp_api_status').attr({
                                "title" : "Click to Deactive",
                                "class" : "label label-success pp_api_status"
                            });
                        }else if(data.action == 'disable'){
                            me.closest('.panel').find(".pricing_portal_api_datatable").find('.pp_api_status').text('Deactive');
                            me.closest('.panel').find(".pricing_portal_api_datatable").find('.pp_api_status').attr({
                                "title" : "Click to Active",
                                "class" : "label label-danger pp_api_status"
                            });
                        }
                    }
                    
                }
            })
        });

    // pricing portal status Active deactive
        $(document.body).on('click','.pp_api_status',function(){
            var me = $(this);
            var id = me.data('id');
            var status = me.html();
            var token = me.data('token');
            var url = me.data('url');

            if(status == 'Active'){
                var label = 'Deactive';
            }else{
                var label = 'Active';
            }
                    
            swal({
                title: "Are you sure?",
                text: "Are you sure "+label+" this API?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, "+label+" it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type:'post',
                        url:url,
                        data: {
                            "id": id,
                            "status": status,
                            "_token": token,
                        },
                        dataType:'json',
                        success:function(data){
                            if(data.status == 'success'){
                                if(data.action == 'deactive'){
                                    me.text('Active');
                                    me.attr({
                                        "title" : "Click to Deactive",
                                        "class" : "label label-success pp_api_status"
                                    });
                                }else if(data.action == 'active'){
                                    me.text('Deactive');
                                    me.attr({
                                        "title" : "Click to Active",
                                        "class" : "label label-danger pp_api_status"
                                    });
                                }

                                swal({
                                    title: "Status changed!",
                                    text: "Your status has been changed.",
                                    confirmButtonColor: "#66BB6A",
                                    type: "success",
                                    timer: 1000
                                });
                            }
                        }
                    });
                }else {
                    swal({
                        title: "Cancelled",
                        text: "No status changed :)",
                        confirmButtonColor: "#2196F3",
                        type: "error",
                        timer: 1000
                    });
                }
            });
        });

    //Blog Category Delete
        $(document.body).on('click','.delete_pp_api',function(){
            var me = $(this);
            var id = me.data('id');
            var token = me.data('token');
            var cat_count = $('.cat_count').html();
            var url = me.data('url');
                    
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url:url,
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            dataType:'json',
                            success:function(data){
                                if(data.status == 'success'){
                                    me.closest('tr').fadeOut(2000);
                                    $('.cat_count').html(cat_count - 1);
                                    swal({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Cancelled",
                            text: "Your file is safe :)",
                            confirmButtonColor: "#2196F3",
                            type: "error",
                            timer: 1000
                        });
                    }
                });
        });








    /* ------------------------------------------GST & Levy Management (validation)------------------------------------*/ 

    //edit btn click
    $(document.body).on('click','.edit_btn',function(event){
        event.preventDefault();
        var content = $(this).closest('.form-group').find('.gstlevy_content').find('span').html();

        var editMarkUp = '<input type="number" class="form-control gstlevy_content_txt" min="0" pattern="[0-9]" step="0.0001" required=""  value="'+$.trim(content)+'">';
        editMarkUp += '<input type="hidden" data-field="" name="gstlevy_content_hidden" class="form-control content_txt_hidden" value="'+$.trim(content)+'">';
          
        $(this).html('Save');
        $(this).addClass('label border-left-success label-striped save_btn')
        $(this).removeClass('edit_btn');

        $(this).closest('.form-group').find('.gstlevy_content').html(editMarkUp);
        $(this).closest('.form-group').find(".cancel_btn").show();
    });

    //cancle btn click
    $(document.body).on('click','.cancel_btn',function(event){
        event.preventDefault();
        var val = $(this).closest('.form-group').find('.content_txt_hidden').val();
        var editMarkUp = '<span class="label label-block border-left-info label-striped">'+val+'</span>';
        $(this).closest('.form-group').find('.gstlevy_content').html(editMarkUp);
        $(this).hide();
        var edit_btn = $(this).closest('.form-group').find('.save_btn');
        edit_btn.html('Edit');
        edit_btn.addClass('label border-left-grey label-striped edit_btn');
        edit_btn.removeClass('save_btn');
          
    });

    //textbox value validation
    $(document.body).on('input','.gstlevy_content_txt',function(evt){
        var me = $(this);
        me.val(me.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || me.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
        {
            evt.preventDefault();
        }

    });

    //save btn click
    $(document.body).on('click','.save_btn',function(event){
        event.preventDefault();
        var me = $(this);
        var token = me.data('token');
        var field = me.data('field');
        var url = me.data('url');

        var value = me.closest('.form-group').find('.gstlevy_content_txt').val();
        var floting_check = value.substring(value.indexOf('.'), value.indexOf('.').length).length > 5;

        // console.log(floting_check);
        // return false;

        if(floting_check){
            $(".error_div").html('<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button> Allow only four numbers after decimal point! <strong>Example:</strong> <em>(00.0000)</em>').show();
            $(".error_div").delay(5000).fadeOut(5000);
           
            new PNotify({
                title: 'Error Notice',
                text: 'Allow only four numbers after decimal point! <strong>Example:</strong> <em>(00.0000)',
                addclass: 'alert alert-warning alert-styled-left',
                type: 'error'
            });
            //show_stack_custom_bottom('info',stack_custom_bottom);
            
        }else{
            me.closest('.form-group').find(".loader").show();
            // var queryString = 'field='+field+'&value='+ value;
            // console.log(queryString);
            $.ajax({
                url:url,
                type: 'post',
                data: {
                    "field": field,
                    "value": value,
                    "_token": token,
                },
                dataType: 'json',
                success:function(data){
                    if(data.status == 'success'){
                        me.closest('.form-group').find('.gstlevy_content').html('<span class="label label-block border-left-info label-striped">'+value+'</span>');
                        me.closest('.form-group').find(".loader").hide();
                        me.closest('.form-group').find(".cancel_btn").hide();
                        me.addClass('label border-left-grey label-striped edit_btn');
                        me.html('Edit');
                        me.removeClass('save_btn');
                        $(".success_div").html('<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>'+field+' Update Successfully').show();
                        $(".success_div").delay(5000).fadeOut(5000);

                        new PNotify({
                            title: 'Success Notice',
                            text: 'Update Successfully',
                            addclass: 'alert alert-success alert-styled-left',
                            type: 'success'
                        });

                    }else{
                        new PNotify({
                            title: 'Error Notice',
                            text: 'Some problem for update GST & Levy',
                            addclass: 'alert alert-warning alert-styled-left',
                            type: 'error'
                        });
                    }
                }
            })
        }

    });


    /* ------------------------------------------Product Management (validation)------------------------------------*/
    
    multiselect_toggle($(".multiselect-toggle-selection"), $(".multiselect-toggle-selection-button"));
    $.uniform.update();

    // Product form validation
    $(".package_form").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
        },
        messages: {
            category_name: "Enter your category name",
        }
    });

    //datatable
    $('.package_datatable').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [4]
            },
            { 
                orderable: false,
                targets: [4]
            }
        ],
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy position-left"></i> COPY',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-excel position-left"></i> EXCEL',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.csv'
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
        order: [1, 'asc'],
    });


    //Size Add more
    //Size add or remove Button code
    var size_maxField = 10; //Input fields increment limitation
    var size_addButton = $('.add_more_btn_size'); //Add button selector
    var size_wrapper = $('.size_div');
    var size_fieldHTML = '<div class="form-group">';
          size_fieldHTML += '<label class="col-lg-2 control-label"></label>';
          size_fieldHTML += '<div class="col-lg-1">';
            size_fieldHTML += '<input type="text" name="size[]" class="form-control size" placeholder="Size" value="0">';
          size_fieldHTML += '</div>';
          size_fieldHTML += '<label class="col-lg-1 control-label">Length</label>';
          size_fieldHTML += '<div class="col-lg-1">';
            size_fieldHTML += '<input type="text" name="length[]" class="form-control" placeholder="Length" value="0">';
          size_fieldHTML += '</div>';
          size_fieldHTML += '<label class="col-lg-1 control-label">Width</label>';
          size_fieldHTML += '<div class="col-lg-1">';
            size_fieldHTML += '<input type="text" name="width[]" class="form-control" placeholder="Width" value="0">';
          size_fieldHTML += '</div>';
          size_fieldHTML += '<label class="col-lg-1 control-label">Height</label>';
          size_fieldHTML += '<div class="col-lg-1">';
            size_fieldHTML += '<input type="text" name="height[]" class="form-control" placeholder="Height" value="0">';
          size_fieldHTML += '</div>';
          size_fieldHTML += '<div class="col-lg-1">';
            size_fieldHTML += '<select name="lwh_measurement[]" class="form-control select">';
              size_fieldHTML += '<option value="Centimetres">CM</option>';
              size_fieldHTML += '<option value="Inch">Inch</option>';
              size_fieldHTML += '<option value="Feet">Feet</option>';
              size_fieldHTML += '<option value="Metres">Metres</option>';
            size_fieldHTML += '</select>';
          size_fieldHTML += '</div>';
          size_fieldHTML += '<label class="col-lg-1 control-label">Weight</label>';
          size_fieldHTML += '<div class="col-lg-1">';
            size_fieldHTML += '<input type="text" name="weight[]" class="form-control" placeholder="Weight" value="0">';
          size_fieldHTML += '</div>';
          size_fieldHTML += '<div class="col-lg-1">';
            size_fieldHTML += '<select name="weight_measurement[]" class="form-control select">';
              size_fieldHTML += '<option value="Grams">G</option>';
              size_fieldHTML += '<option value="oz">Oz</option>';
              size_fieldHTML += '<option value="Kilograms" selected="">Kg</option>';
              size_fieldHTML += '<option value="Pound">Pnd</option>';
            size_fieldHTML += '</select>';
          size_fieldHTML += '</div>';
          size_fieldHTML += '<div class="col-lg-1">';
            size_fieldHTML += '<a href="javascript:void(0)" class="text-danger-600"><i class="icon-minus-circle2 remove_btn_size remove_minus" data-id="0"></i></a>';
          size_fieldHTML += '</div>';
        size_fieldHTML += '</div>';
    var size_x = 1; //Initial field counter is 1

    $(size_addButton).click(function(){ 
        if(size_x < size_maxField){ //Check maximum number of input fields

          var size_val = $(this).closest('.size_div').find('.size:last').val();
          if(size_val != 0){
            size_x++; //Increment field counter
            $(size_wrapper).append(size_fieldHTML); // Add field html
          }else{
            alert('Please fill Size fields');
          }
        }else{
            alert('Maximum only 10 field add');
        }
    });

    $(size_wrapper).on('click', '.remove_btn_size', function(e){ 
        e.preventDefault();
        var me = $(this);
        var id = me.data('id');
        
        if(id !== 0){
            var url = me.data('url');
            var token = me.data('token');
            $.ajax({
                url:url,
                type:'post',
                data:{
                    "id":id,
                    "_token": token,
                },
                dataType:'json',
                success:function(data){
                    if(data.status == 'success'){
                        me.closest('.form-group').remove();
                        size_x--; //Decrement field counter                
                    }else{
                        alert('Some error');
                    }
                }
            });
        }else{
            me.closest('.form-group').remove();
            size_x--; //Decrement field counter
        }
        
    });

    //Type1 add or remove Button code
    var type1_maxField = 10; //Input fields increment limitation
    var type1_addButton = $('.add_more_btn_type1'); //Add button selector
    var type1_wrapper = $('.type1_div');
    var type1_fieldHTML = '<div class="form-group">';
          type1_fieldHTML += '<label class="col-lg-2 control-label"></label>';
          type1_fieldHTML += '<div class="col-lg-5">';
            type1_fieldHTML += '<input type="text" name="type1[]" class="form-control type1" placeholder="Type1">';
          type1_fieldHTML += '</div>';
          type1_fieldHTML += '<div class="col-lg-5">';
            type1_fieldHTML += '<a href="javascript:void(0)" class="text-danger-600"><i class="icon-minus-circle2 remove_btn_type1 remove_minus"></i></a>';
          type1_fieldHTML += '</div>';
        type1_fieldHTML += '</div>';
    var type1_x = 1; //Initial field counter is 1

    $(type1_addButton).click(function(){ 
        if(type1_x < type1_maxField){ //Check maximum number of input fields

            var type1_val = $(this).closest('.type1_div').find('.type1:last').val();
            if(type1_val != ''){
              type1_x++; //Increment field counter
              $(type1_wrapper).append(type1_fieldHTML); // Add field html
            }else{
              alert('Please fill Typep1 fields');
            }
        }else{
            alert('Maximum only 10 field add');
        }
    });

    $(type1_wrapper).on('click', '.remove_btn_type1', function(e){ 
        e.preventDefault();
        $(this).closest('.form-group').remove();
        type1_x--; //Decrement field counter
    });

    //Type2 add or remove Button code
    var type2_maxField = 10; //Input fields increment limitation
    var type2_addButton = $('.add_more_btn_type2'); //Add button selector
    var type2_wrapper = $('.type2_div');
    var type2_fieldHTML = '<div class="form-group">';
          type2_fieldHTML += '<label class="col-lg-2 control-label"></label>';
          type2_fieldHTML += '<div class="col-lg-5">';
            type2_fieldHTML += '<input type="text" name="type2[]" class="form-control type2" placeholder="Type2">';
          type2_fieldHTML += '</div>';
          type2_fieldHTML += '<div class="col-lg-5">';
            type2_fieldHTML += '<a href="javascript:void(0)" class="text-danger-600"><i class="icon-minus-circle2 remove_btn_type2 remove_minus"></i></a>';
          type2_fieldHTML += '</div>';
        type2_fieldHTML += '</div>';
    var type2_x = 1; //Initial field counter is 1

    $(type2_addButton).click(function(){ 
        if(type2_x < type2_maxField){ //Check maximum number of input fields

            var type2_val = $(this).closest('.type2_div').find('.type2:last').val();
            if(type2_val != ''){
              type2_x++; //Increment field counter
              $(type2_wrapper).append(type2_fieldHTML); // Add field html
            }else{
              alert('Please fill Typep2 fields');
            }
        }else{
            alert('Maximum only 10 field add');
        }
    });
    $(type2_wrapper).on('click', '.remove_btn_type2', function(e){ 
        e.preventDefault();
        $(this).closest('.form-group').remove();
        type2_x--; //Decrement field counter
    });


    //Package Delete
        $(document.body).on('click','.delete_package',function(){
            var me = $(this);
            var id = me.data('id');
            var token = me.data('token');
            var url = me.data('url');
            var cat_count = $('.cat_count').html();
            // console.log(me.closest('tr').closest('tr').html());
            // if(me.closest('tr').parent('tr').hasClass('parent')){
            //                             console.log('true');
            //                         }else{
            //                             console.log('false');
            //                         }
            //                         return false;
                    
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url:url,
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            dataType:'json',
                            success:function(data){
                                if(data.status == 'success'){
                                    me.closest('tr').fadeOut(2000);
                                    if(me.closest('tr').closest('tr').hasClass('parent')){
                                        console.log('true');
                                    }else{
                                        console.log('false');
                                    }
                                    $('.cat_count').html(cat_count - 1);
                                    swal({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Cancelled",
                            text: "Your file is safe :)",
                            confirmButtonColor: "#2196F3",
                            type: "error",
                            timer: 1000
                        });
                    }
                });
        });





    /* ------------------------------------------Blog Category Management (validation)------------------------------------*/

    // Setup validation
    $(".blog_categories_form").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
            category_name: {
                minlength: 2,
                maxlength: 30,
            }
        },
        messages: {
            category_name: "Enter your category name",
        }
    });

    //datatable
    $('.category_datatable').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [4]
            },
            { 
                orderable: false,
                targets: [4]
            }
        ],
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy position-left"></i> COPY',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-excel position-left"></i> EXCEL',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.csv'
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
        order: [1, 'asc'],
    });

    //Status Active deactive
        $(document.body).on('click','.blog_category_status',function(){
            var me = $(this);
            var id = me.data('id');
            var status = me.html();
            var token = me.data('token');
            if(status == 'Active'){
                var label = 'Deactive';
            }else{
                var label = 'Active';
            }
                    
            swal({
                title: "Are you sure?",
                text: "Are you sure "+label+" this blog category?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, "+label+" it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type:'post',
                        url:"/admin/blogcategorystatus",
                        data: {
                            "id": id,
                            "status": status,
                            "_token": token,
                        },
                        dataType:'json',
                        success:function(data){
                            if(data.status == 'success'){
                                if(data.action == 'deactive'){
                                    me.text('Active');
                                    me.attr({
                                        "title" : "Click to Deactive",
                                        "class" : "label label-success blog_category_status"
                                    });
                                }else if(data.action == 'active'){
                                    me.text('Deactive');
                                    me.attr({
                                        "title" : "Click to Active",
                                        "class" : "label label-danger blog_category_status"
                                    });
                                }

                                swal({
                                    title: "Status changed!",
                                    text: "Your status has been changed.",
                                    confirmButtonColor: "#66BB6A",
                                    type: "success",
                                    timer: 1000
                                });
                            }
                        }
                    });
                }else {
                    swal({
                        title: "Cancelled",
                        text: "No status changed :)",
                        confirmButtonColor: "#2196F3",
                        type: "error",
                        timer: 1000
                    });
                }
            });
        });

    //Blog Category Delete
        $(document.body).on('click','.delete_blog_category',function(){
            var me = $(this);
            var id = me.data('id');
            var token = me.data('token');
            var cat_count = $('.cat_count').html();
                    
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url:"/admin/blogcategorydelete",
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            dataType:'json',
                            success:function(data){
                                if(data.status == 'success'){
                                    me.closest('tr').fadeOut(2000);
                                    $('.cat_count').html(cat_count - 1);
                                    swal({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Cancelled",
                            text: "Your file is safe :)",
                            confirmButtonColor: "#2196F3",
                            type: "error",
                            timer: 1000
                        });
                    }
                });
        });



    /*---------------------------------------------User Package Management-------------------------------------------------------*/
    
    $('.user_package_datatable').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [4]
            },
            { 
                orderable: false,
                targets: [4]
            }
        ],
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy position-left"></i> COPY',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-excel position-left"></i> EXCEL',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.csv'
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
        order: [1, 'asc'],
    });




    /* ------------------------------------------Blog Management (validation)------------------------------------*/

    // Setup validation
    $(".blog_form").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Successfully")
        },
        submitHandler: function(form) {
            loader('body');
            form.submit();
        },
        rules: {
            title: {
                minlength: 2,
                maxlength: 30,
            },
            blog_image:{
                fileType: {
                    types: ["jpg", "jpeg", "png"]
                },
                maxFileSize: {
                    "unit": "MB",
                    "size": 5
                },
                minFileSize: {
                    "unit": "KB",
                    "size": 10
                }
            }
        },
        messages: {
            category_name: "Enter blog title",
        }
    });


    

    $('.blog_cat_select').select2({
        containerCssClass: 'select-lg'
    });

    $('.blog_image').fileinput({
        browseLabel: 'Browse',
        browseIcon: '<i class="icon-file-plus"></i>',
        uploadIcon: '<i class="icon-file-upload2"></i>',
        removeIcon: '<i class="icon-cross3"></i>',
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>',
            modal: modalTemplate
        },
        initialCaption: "No file selected",
        previewZoomButtonClasses: previewZoomButtonClasses,
        previewZoomButtonIcons: previewZoomButtonIcons,
        fileActionSettings: fileActionSettings
    });

    //datatable
    $('.blog_datatable').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [4]
            },
            { 
                orderable: false,
                targets: [4]
            }
        ],
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy position-left"></i> COPY',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-excel position-left"></i> EXCEL',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.csv'
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
        order: [1, 'asc'],
    });

    //Status Active deactive
        $(document.body).on('click','.blog_status',function(){
            var me = $(this);
            var id = me.data('id');
            var status = me.html();
            var token = me.data('token');
            if(status == 'Active'){
                var label = 'Deactive';
            }else{
                var label = 'Active';
            }
                    
            swal({
                title: "Are you sure?",
                text: "Are you sure "+label+" this blog?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, "+label+" it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type:'post',
                        url:"/admin/blogstatus",
                        data: {
                            "id": id,
                            "status": status,
                            "_token": token,
                        },
                        dataType:'json',
                        success:function(data){
                            if(data.status == 'success'){
                                if(data.action == 'deactive'){
                                    me.text('Active');
                                    me.attr({
                                        "title" : "Click to Deactive",
                                        "class" : "label label-success blog_status"
                                    });
                                }else if(data.action == 'active'){
                                    me.text('Deactive');
                                    me.attr({
                                        "title" : "Click to Active",
                                        "class" : "label label-danger blog_status"
                                    });
                                }

                                swal({
                                    title: "Status changed!",
                                    text: "Your status has been changed.",
                                    confirmButtonColor: "#66BB6A",
                                    type: "success",
                                    timer: 1000
                                });
                            }
                        }
                    });
                }else {
                    swal({
                        title: "Cancelled",
                        text: "No status changed :)",
                        confirmButtonColor: "#2196F3",
                        type: "error",
                        timer: 1000
                    });
                }
            });
        });

    //Blog Delete
        $(document.body).on('click','.delete_blog',function(){
            var me = $(this);
            var id = me.data('id');
            var token = me.data('token');
            var cat_count = $('.cat_count').html();
                    
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url:"/admin/blogdelete",
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            dataType:'json',
                            success:function(data){
                                if(data.status == 'success'){
                                    me.closest('tr').fadeOut(2000);
                                    $('.cat_count').html(cat_count - 1);
                                    swal({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Cancelled",
                            text: "Your file is safe :)",
                            confirmButtonColor: "#2196F3",
                            type: "error",
                            timer: 1000
                        });
                    }
                });
        });


     /* ------------------------------------------API Management (validation)------------------------------------*/

    // Domestic API Setup validation
    $(".domestic_api_form").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Successfully")
        },
        submitHandler: function(form) {
            loader('body');
            form.submit();
        },
        rules: {
            api_name: {
                minlength: 2,
                maxlength: 30,
            },
            slug_name: {
                minlength: 2,
                maxlength: 30,
            }
        },
        messages: {
            category_name: "Enter blog title",
        }
    });

    // International API Setup validation
    $(".international_api_form").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Successfully")
        },
        submitHandler: function(form) {
            loader('body');
            form.submit();
        },
        rules: {
            api_name: {
                minlength: 2,
                maxlength: 30,
            },
            slug_name: {
                minlength: 2,
                maxlength: 30,
            }
        },
        messages: {
            category_name: "Enter blog title",
        }
    });

    // Domestic tabel
    $('.domestic_api_datatable').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [4]
            },
            { 
                orderable: false,
                targets: [4]
            }
        ],
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy position-left"></i> COPY',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-excel position-left"></i> EXCEL',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.csv'
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
        order: [1, 'asc'],
    });

    // International tabel
    $('.international_api_datatable').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [4]
            },
            { 
                orderable: false,
                targets: [4]
            }
        ],
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy position-left"></i> COPY',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-excel position-left"></i> EXCEL',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.csv'
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
        order: [1, 'asc'],
    });

    //Api Status Active deactive
        $(document.body).on('click','.api_status',function(){
            var me = $(this);
            var id = me.data('id');
            var status = me.html();
            var token = me.data('token');
            if(status == 'Active'){
                var label = 'Deactive';
            }else{
                var label = 'Active';
            }
                    
            swal({
                title: "Are you sure?",
                text: "Are you sure "+label+" this API?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, "+label+" it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type:'post',
                        url:"/admin/apistatus",
                        data: {
                            "id": id,
                            "status": status,
                            "_token": token,
                        },
                        dataType:'json',
                        success:function(data){
                            if(data.status == 'success'){
                                if(data.action == 'deactive'){
                                    me.text('Active');
                                    me.attr({
                                        "title" : "Click to Deactive",
                                        "class" : "label label-success api_status"
                                    });
                                }else if(data.action == 'active'){
                                    me.text('Deactive');
                                    me.attr({
                                        "title" : "Click to Active",
                                        "class" : "label label-danger api_status"
                                    });
                                }

                                swal({
                                    title: "Status changed!",
                                    text: "Your status has been changed.",
                                    confirmButtonColor: "#66BB6A",
                                    type: "success",
                                    timer: 1000
                                });
                            }
                        }
                    });
                }else {
                    swal({
                        title: "Cancelled",
                        text: "No status changed :)",
                        confirmButtonColor: "#2196F3",
                        type: "error",
                        timer: 1000
                    });
                }
            });
        });

    //Blog Delete
        $(document.body).on('click','.delete_api',function(){
            var me = $(this);
            var id = me.data('id');
            var token = me.data('token');
            var cat_count = $('.cat_count').html();
                    
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url:"/admin/apidelete",
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            dataType:'json',
                            success:function(data){
                                if(data.status == 'success'){
                                    me.closest('tr').fadeOut(2000);
                                    $('.cat_count').html(cat_count - 1);
                                    swal({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Cancelled",
                            text: "Your file is safe :)",
                            confirmButtonColor: "#2196F3",
                            type: "error",
                            timer: 1000
                        });
                    }
                });
        });

        $(".api_enable_disable").bootstrapSwitch();

        $(document.body).on('switchChange.bootstrapSwitch','.api_enable_disable',function(){
            var checkStatus = this.checked ? 'enable' : 'disable';
            var token = $(this).data('token');
            var api_type = $(this).data('atype');
            loader('body');
            $.ajax({
                url: '/admin/apiallstatus',
                type: 'post',
                data: {
                    'status' : checkStatus,
                    'api_type': api_type,
                    '_token': token,
                },
                dataType: 'json',
                success:function(data){
                    unloader('body');
                    if(api_type == 'domestic'){
                        if(data.action == 'enable'){
                            $(".domestic_api_datatable").find('.api_status').text('Active');
                            $(".domestic_api_datatable").find('.api_status').attr({
                                "title" : "Click to Deactive",
                                "class" : "label label-success api_status"
                            });
                        }else if(data.action == 'disable'){
                            $(".domestic_api_datatable").find('.api_status').text('Deactive');
                            $(".domestic_api_datatable").find('.api_status').attr({
                                "title" : "Click to Active",
                                "class" : "label label-danger api_status"
                            });
                        }
                    }else if(api_type == 'international'){
                        if(data.action == 'enable'){
                            $(".international_api_datatable").find('.api_status').text('Active');
                            $(".international_api_datatable").find('.api_status').attr({
                                "title" : "Click to Deactive",
                                "class" : "label label-success api_status"
                            });
                        }else if(data.action == 'disable'){
                            $(".international_api_datatable").find('.api_status').text('Deactive');
                            $(".international_api_datatable").find('.api_status').attr({
                                "title" : "Click to Active",
                                "class" : "label label-danger api_status"
                            });
                        }
                    }
                    
                }
            })
        });

/* ------------------------------------------Holiday Management (validation)------------------------------------*/

    // holiday form validation
    $(".holiday_form").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label) {
            label.addClass("validation-valid-label").text("Successfully")
        },
        submitHandler: function(form) {
            loader('body');
            form.submit();
        },
        rules: {
            
        },
        messages: {
            category_name: "Enter blog title",
        }
    });


    $('.holiday_state_select').select2({
        containerCssClass: 'select-lg'
    });

    // Dropdown selectors
    var yesterday = new Date((new Date()).valueOf()-1000*60*60*24);
    $('.holiday_date').pickadate({
        selectYears: true,
        selectMonths: true,
        disable: [
            7,1,{ from: [0,0,0], to: yesterday }
        ]
        // disable: [
        //     7,
        //     // [2013, 10, 21, 'inverted'],
        //     // { from: [2014, 3, 15], to: [2014, 3, 25] },
        //     1,
        //     // [2014, 3, 20, 'inverted'],
        //     // { from: [2014, 3, 17], to: [2014, 3, 18], inverted: true }
        // ]
    });


    // Initialize
    $('.multiselect-toggle-selection').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        templates: {
            filter: '<li class="multiselect-item multiselect-filter"><i class="icon-search4"></i> <input class="form-control" type="text"></li>'
        },
        onSelectAll: function() {
            $.uniform.update();
        }
    });

    // Toggle selection on button click
    $(".multiselect-toggle-selection-button").click(function(e) {
        e.preventDefault();
        multiselect_toggle($(".multiselect-toggle-selection"), $(this));
        $.uniform.update();
    });

    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice'});

    
    // Holiday datatabel
    $('.holiday_datatable').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [4]
            },
            { 
                orderable: false,
                targets: [4]
            }
        ],
        buttons: {            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-copy position-left"></i> COPY',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-excel position-left"></i> EXCEL',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-pdf position-left"></i> PDF',
                    fieldSeparator: '\t',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-default',
                    text: '<i class="icon-file-spreadsheet position-left"></i> CSV',
                    fieldSeparator: '\t',
                    extension: '.csv'
                },
                {
                    extend: 'colvis',
                    text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                    className: 'btn bg-blue btn-icon'
                }
            ]
        },
        order: [1, 'asc'],
    }); 


    //Api Status Active deactive
        $(document.body).on('click','.holiday_status',function(){
            var me = $(this);
            var id = me.data('id');
            var status = me.html();
            var token = me.data('token');
            if(status == 'Active'){
                var label = 'Deactive';
            }else{
                var label = 'Active';
            }
                    
            swal({
                title: "Are you sure?",
                text: "Are you sure "+label+" this Holiday?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Yes, "+label+" it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type:'post',
                        url:"/admin/holidaystatus",
                        data: {
                            "id": id,
                            "status": status,
                            "_token": token,
                        },
                        dataType:'json',
                        success:function(data){
                            if(data.status == 'success'){
                                if(data.action == 'deactive'){
                                    me.text('Active');
                                    me.attr({
                                        "title" : "Click to Deactive",
                                        "class" : "label label-success holiday_status"
                                    });
                                }else if(data.action == 'active'){
                                    me.text('Deactive');
                                    me.attr({
                                        "title" : "Click to Active",
                                        "class" : "label label-danger holiday_status"
                                    });
                                }

                                swal({
                                    title: "Status changed!",
                                    text: "Your status has been changed.",
                                    confirmButtonColor: "#66BB6A",
                                    type: "success",
                                    timer: 1000
                                });
                            }
                        }
                    });
                }else {
                    swal({
                        title: "Cancelled",
                        text: "No status changed :)",
                        confirmButtonColor: "#2196F3",
                        type: "error",
                        timer: 1000
                    });
                }
            });
        });

    //Blog Delete
        $(document.body).on('click','.delete_holiday',function(){
            var me = $(this);
            var id = me.data('id');
            var token = me.data('token');
            var state = me.data('state');
            var class_nm = '.'+state+'_count';
            var holiday_count = $(class_nm).html();

                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url:"/admin/holidaydelete",
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            dataType:'json',
                            success:function(data){
                                if(data.status == 'success'){
                                    me.closest('tr').fadeOut(2000);
                                    $(class_nm).html(holiday_count - 1);
                                    swal({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success",
                                        timer: 1000
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Cancelled",
                            text: "Your file is safe :)",
                            confirmButtonColor: "#2196F3",
                            type: "error",
                            timer: 1000
                        });
                    }
                });
        });   





    /* --------------------------------------------------Extra--------------------------------------------------------*/
    $('.select').select2({
        containerCssClass: 'select-lg'
    });

    // Style checkboxes and radios
    $('.styled_checkbox').uniform();

    $(".styled_color_checkbox").uniform({
        radioClass: 'choice',
        wrapperClass: 'border-indigo-600 text-indigo-800'
    });

    $(".switch_button").bootstrapSwitch();

    // $('.styled, .multiselect-container input').uniform({
    //     radioClass: 'choice',
    //     wrapperClass: 'border-primary text-primary'
    // });

    //$('.select').select2();
    // Format icon
    function iconFormat(icon) {
        var originalOption = icon.element;
        if (!icon.id) { return icon.text; }
        var $icon = "<i class='icon-" + $(icon.element).data('icon') + "'></i>" + icon.text;

        return $icon;
    }

    // Initialize with options
    $(".select-icons").select2({
        templateResult: iconFormat,
        minimumResultsForSearch: Infinity,
        templateSelection: iconFormat,
        escapeMarkup: function(m) { return m; }
    });
    
    // Styled form components
    // ------------------------------

    // Checkboxes, radios
    $(".styled_radio").uniform({ radioClass: 'choice' });

    // File input
    $(".file-styled").uniform({
        fileButtonClass: 'action btn bg-pink-400'
    });

    // External table additions
    // ------------------------------

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });


});

function loader(tag_nm){
    var dark_6 = $(tag_nm);
    $(dark_6).block({
        message: '<i class="icon-spinner9 spinner"></i>',
        overlayCSS: {
            backgroundColor: '#1B2024',
            opacity: 0.85,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none',
            color: '#fff'
        }
    });
    window.setTimeout(function () {
        $(dark_6).unblock();
    }, 500000);
}

function unloader(tag_nm){
    $(tag_nm).unblock();
}

// Select all/Deselect all
        function multiselect_selected($el) {
        var ret = true;
        $('option', $el).each(function(element) {
            if (!!!$(this).prop('selected')) {
            ret = false;
            }
            });
            return ret;
        }
        function multiselect_selectAll($el) {
            $('option', $el).each(function(element) {
            $el.multiselect('select', $(this).val());
            });
        }
        function multiselect_deselectAll($el) {
            $('option', $el).each(function(element) {
            $el.multiselect('deselect', $(this).val());
            });
        }
        function multiselect_toggle($el, $btn) {
            if (multiselect_selected($el)) {
                multiselect_deselectAll($el);
                $btn.text("Select All");
            }
            else {
                multiselect_selectAll($el);
                $btn.text("Deselect All");
            }
        }

function show_stack_custom_bottom(type,stack_custom_bottom) {
        var opts = {
            title: "Over here",
            text: "Check me out. I'm in a different stack.",
            width: "100%",
            cornerclass: "no-border-radius",
            addclass: "stack-custom-bottom bg-primary",
            stack: stack_custom_bottom
        };
        switch (type) {
            case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.addclass = "stack-custom-bottom bg-danger";
            opts.type = "error";
            break;

            case 'info':
            opts.title = "Breaking News";
            opts.text = "Have you met Ted?";
            opts.addclass = "stack-custom-bottom bg-info";
            opts.type = "info";
            break;

            case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.addclass = "stack-custom-bottom bg-success";
            opts.type = "success";
            break;
        }
        new PNotify(opts);
    }
