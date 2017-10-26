@extends('admin/layouts.app')
@push('css')
    <style type="text/css">
        .blog_datatable span{
            cursor: pointer;
        }
        .animated {
            -webkit-animation-fill-mode: none;
            animation-fill-mode: none;
        }
        .form-horizontal .checkbox .checker, .form-horizontal .checkbox-inline .checker{
            top: 50%;
        }
        .input-group .form-control{
            float: none;
        }
        .add_plus{
            margin-top: 13px;
        }
        .remove_minus{
            margin-top: 13px;
        }
        
        @media (min-width: 768px){
            .col-lg-1 {
                width: 6.80%;
            }
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".package_management").addClass('active');

            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            });

            //onChange size code
            $(document.body).on('change','.select_size',function(){
                var me = $(this);
                var size_id = me.val();
                var url = me.data('url');
                var token = me.data('token');
                var package_id = me.closest('tr').find('.package_id').val();

                console.log(size_id);
                console.log(package_id);
                // show loader
                me.closest('tr').find("td:eq(5)").find('.loader_img').show();
                me.closest('tr').find("td:eq(6)").find('.loader_img').show();
                me.closest('tr').find("td:eq(7)").find('.loader_img').show();
                me.closest('tr').find("td:eq(8)").find('.loader_img').show();
                me.closest('tr').find("td:eq(9)").find('.loader_img').show();
                me.closest('tr').find("td:eq(10)").find('.loader_img').show();

                // hide span
                me.closest('tr').find("td:eq(5)").find('span').hide();
                me.closest('tr').find("td:eq(6)").find('span').hide();
                me.closest('tr').find("td:eq(7)").find('span').hide();
                me.closest('tr').find("td:eq(8)").find('span').hide();
                me.closest('tr').find("td:eq(9)").find('span').hide();
                me.closest('tr').find("td:eq(10)").find('span').hide();
                //console.log(a);

                $.ajax({
                    type:'post',
                    url:url,
                    data: {
                        "size_id": size_id,
                        "package_id": package_id,
                        "_token": token,
                    },
                    dataType:'json',
                    success:function(data){
                        var length = data.row['length'];
                        var width = data.row['width'];
                        var height = data.row['height'];
                        var lwh_measurement_row = data.row['lwh_measurement'];
                        var weight = data.row['weight'];
                        var weight_measurement_row = data.row['weight_measurement'];

                        var lwh_measurement = '';
                        var weight_measurement = '';

                        if(lwh_measurement_row == 'Centimetres'){
                            lwh_measurement = 'CM';
                        }else if(lwh_measurement_row == 'Inch'){
                            lwh_measurement = 'Inch';
                        }else if(lwh_measurement_row == 'Feet'){
                            lwh_measurement = 'Feet';
                        }else if(lwh_measurement_row == 'Metres'){
                            lwh_measurement = 'M';
                        }

                        if(weight_measurement_row == 'Grams'){
                            weight_measurement = 'G';
                        }else if(weight_measurement_row == 'oz'){
                            weight_measurement = 'Oz';
                        }else if(weight_measurement_row == 'Kilograms'){
                            weight_measurement = 'Kg';
                        }else if(weight_measurement_row == 'Pound'){
                            weight_measurement = 'Pnd';
                        }

                        if(length == 0 && height == 0 && weight == 0){
                            lwh_measurement = '-';
                        }              

                        if(length == 0){
                            length = '-';
                        }
                          
                        if(width == 0){
                            width = '-';;
                        }
                          
                        if(height == 0){
                            height = '-';
                        }

                        if(weight == 0){
                            weight = '-';
                            weight_measurement = '-';
                        }

                        // hide loader
                        me.closest('tr').find("td:eq(5)").find('.loader_img').hide();
                        me.closest('tr').find("td:eq(6)").find('.loader_img').hide();
                        me.closest('tr').find("td:eq(7)").find('.loader_img').hide();
                        me.closest('tr').find("td:eq(8)").find('.loader_img').hide();
                        me.closest('tr').find("td:eq(9)").find('.loader_img').hide();
                        me.closest('tr').find("td:eq(10)").find('.loader_img').hide();

                        // show span
                        me.closest('tr').find('.length').find('span').text(length).show();
                        me.closest('tr').find('.width').find('span').text(width).show();
                        me.closest('tr').find('.height').find('span').text(height).show();
                        me.closest('tr').find('.lwh_measurement').find('span').text(lwh_measurement).show();
                        me.closest('tr').find('.weight').find('span').text(weight).show();
                        me.closest('tr').find('.weight_measurement').find('span').text(weight_measurement).show();


                    }
                });


            });

        })
    </script>
@endpush

@section('content')
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Package Management</span></h4>
                        </div>

                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="breadcrumb-line breadcrumb-line-component">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('admin.dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                            <li class="active">Package Management</li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->

                <div class="content">

                    @if(Session::has('success'))
                        <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                          <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            {{Session::get('success')}}
                        </div>
                    @elseif(Session::has('error'))  
                        <div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
                          <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            {{Session::get('error')}}
                        </div>
                    @endif

                    <h6 class="content-group text-semibold">
                        Package Management
                        <small class="display-block">Add and display all Package</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Package</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="tabbable tab-content-bordered">
                                        <ul class="nav nav-tabs nav-tabs-highlight">
                                            <li class="active"><a href="#css-animate-tab1" data-toggle="tab">Add New Package <span class="label label-success">New</span></a></li>
                                            <li><a href="#css-animate-tab2" data-toggle="tab">View Package <span class="badge bg-slate position-right cat_count">{{ count($packages) }}</span></a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane animated bounceIn has-padding active" id="css-animate-tab1">
                                                <!-- <div class="row"> -->
                                                    <!-- <div class="col-md-12"> -->

                                                        <form action="{{ route('admin.post.package') }}" class="form-horizontal package_form" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field()}}
                                                            <div class="panel panel-flat">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">Product Form</h5>
                                                                </div>

                                                                <div class="panel-body">

                                                                    <div class="form-group">
                                                                        <label class="col-lg-2 control-label">Package Name:</label>
                                                                        <div class="col-lg-10">
                                                                            <input type="text" name="package_name" class="form-control" placeholder="Enter Package Name" required="">
                                                                            @if ($errors->has('package_name'))
                                                                                <label id="package_name-error" class="validation-error-label" for="package_name">
                                                                                        {{ $errors->first('package_name') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-2 control-label">Package Type:</label>
                                                                        <div class="col-lg-10">
                                                                            <select data-placeholder="Select a Package Type..." class="select" name="package_type" required="">
                                                                                <option></option>
                                                                                <option value="Bag/Luggage">Bag/Luggage</option>
                                                                                <option value="Box">Box</option>
                                                                                <option value="Carton">Carton</option>
                                                                                <option value="Crate">Crate</option>
                                                                                <option value="Cylinder">Cylinder</option>
                                                                                <option value="Envelope">Envelope</option>
                                                                                <option value="Flat Pack">Flat Pack</option>
                                                                                <option value="Pallet">Pallet</option>
                                                                                <option value="Parcel">Parcel</option>
                                                                                <option value="Satchel">Satchel</option>
                                                                                <option value="Skid">Skid</option>
                                                                            </select>
                                                                            @if ($errors->has('package_type'))
                                                                                <label id="package_type-error" class="validation-error-label" for="package_type">
                                                                                        {{ $errors->first('package_type') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-2 control-label">Package Value:</label>
                                                                        <div class="col-lg-10">
                                                                            <select data-placeholder="Select a Package Value..." class="select" name="package_value" required="">
                                                                                <option></option>
                                                                                <option value="Bag/Luggage">Bag/Luggage</option>
                                                                                <option value="Box">Box</option>
                                                                                <option value="Carton">Carton</option>
                                                                                <option value="Crate">Crate</option>
                                                                                <option value="Cylinder">Cylinder</option>
                                                                                <option value="Document Envelope">Document Envelope</option>
                                                                                <option value="Flat Pack">Flat Pack</option>
                                                                                <option value="Pallet">Pallet</option>
                                                                                <option value="Parcel">Parcel</option>
                                                                                <option value="Satchel/Bag">Satchel/Bag</option>
                                                                                <option value="Skid">Skid</option>
                                                                            </select>
                                                                            @if ($errors->has('package_value'))
                                                                                <label id="package_value-error" class="validation-error-label" for="package_value">
                                                                                        {{ $errors->first('package_value') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="size_div">
                                                                        <div class="form-group">
                                                                          <label class="col-lg-2 control-label">Size:</label>
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="size[]" class="form-control size" placeholder="Size" value="0">
                                                                          </div>
                                                                          <label class="col-lg-1 control-label">Length</label>
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="length[]" class="form-control" placeholder="Length" value="0">
                                                                          </div>
                                                                          <label class="col-lg-1 control-label">Width</label>
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="width[]" class="form-control" placeholder="Width" value="0">
                                                                          </div>
                                                                          <label class="col-lg-1 control-label">Height</label>
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="height[]" class="form-control" placeholder="Height" value="0">
                                                                          </div>
                                                                          <div class="col-lg-1">
                                                                            <select name="lwh_measurement[]" class="form-control select">
                                                                                <option value="Centimetres">CM</option>
                                                                                <option value="Inch">Inch</option>
                                                                                <option value="Feet">Feet</option>
                                                                                <option value="Metres">M</option>
                                                                            </select>
                                                                          </div>
                                                                          <label class="col-lg-1 control-label">Weight</label>
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="weight[]" class="form-control" placeholder="Weight" value="0">
                                                                          </div>
                                                                          <div class="col-lg-1">
                                                                            <select name="weight_measurement[]" class="form-control select">
                                                                                <option value="Grams">G</option>
                                                                                <option value="oz">Oz</option>
                                                                                <option value="Kilograms" selected="">Kg</option>
                                                                                <option value="Pound">Pnd</option>
                                                                            </select>
                                                                          </div>
                                                                          <div class="col-lg-1">
                                                                            <a href="javascript:void(0)"><i class="icon-plus-circle2 add_more_btn_size add_plus"></i></a>
                                                                          </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="type1_div">
                                                                        <div class="form-group">
                                                                          <label class="col-lg-2 control-label">Type 1</label>
                                                                          <div class="col-lg-5">
                                                                            <input type="text" name="type1[]" class="form-control type1" placeholder="Type 1">
                                                                          </div>
                                                                          <div class="col-lg-5">
                                                                            <a href="javascript:void(0)"><i class="icon-plus-circle2 add_more_btn_type1 add_plus"></i></a>
                                                                          </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="type2_div">
                                                                        <div class="form-group">
                                                                          <label class="col-lg-2 control-label">Type 2</label>
                                                                          <div class="col-lg-5">
                                                                            <input type="text" name="type2[]" class="form-control type2" placeholder="Type 2">
                                                                          </div>
                                                                          <div class="col-lg-5">
                                                                            <a href="javascript:void(0)"><i class="icon-plus-circle2 add_more_btn_type2 add_plus"></i></a>
                                                                          </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-2 control-label">Status:</label>
                                                                        <div class="col-lg-10">
                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="status" checked="checked" required="" value="1">
                                                                                Active
                                                                            </label>

                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="status" value="0">
                                                                                Deactive
                                                                            </label>
                                                                            @if ($errors->has('status'))
                                                                                <label id="status-error" class="validation-error-label" for="status">
                                                                                        {{ $errors->first('status') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-2 control-label">Users:</label>
                                                                        <div class="col-lg-10">
                                                                            <div class="input-group">
                                                                            <div class="multi-select-full">
                                                                            <select name="users[]" class="multiselect-toggle-selection" multiple="multiple" required="">
                                                                                @forelse($users as $key => $value)
                                                                                    <option value="{{$value->id}}">{{$value->first_name}} {{$value->last_name}}</option>
                                                                                @empty
                                                                                @endforelse
                                                                            </select>
                                                                            </div>
                                                                                <div class="input-group-btn">
                                                                                    <button type="button" class="btn btn-info multiselect-toggle-selection-button">Select All</button>
                                                                                </div>
                                                                            </div>
                                                                            @if ($errors->has('users'))
                                                                                <label id="users-error" class="validation-error-label" for="users">
                                                                                        {{ $errors->first('users') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn border-slate text-slate-800 btn-flat">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                                        <button type="reset" class="btn border-slate text-slate-800 btn-flat" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    <!-- </div> -->
                                                <!-- </div> -->
                                            </div>

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab2">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table package_datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Package Name</th>
                                                                    <th>Package Type</th>
                                                                    <th>Package Value</th>
                                                                    <th>Size</th>
                                                                    <th>Lenght</th>
                                                                    <th>Width</th>
                                                                    <th>Height</th>
                                                                    <th>lwh Measurement</th>
                                                                    <th>Weight</th>
                                                                    <th>Weight Measurement</th>
                                                                    <th>Type 1</th>
                                                                    <th>Type 2</th>
                                                                    <th>Status</th>
                                                                    <th>Date</th>
                                                                    <th class="text-center">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($packages as $key => $value)
                                                                <?php
                                                                    $type1_array = json_decode($value->package_type_re->type1);
                                                                    $type2_array = json_decode($value->package_type_re->type2);
                                                                ?>
                                                                <tr>
                                                                <input type="hidden" name="package_id" class="package_id" value="<?php echo $value->id; ?>">
                                                                    <td></td>
                                                                    <td>{{$value->package_name}}</td>
                                                                    <td>{{$value->package_type}}</td>
                                                                    <td>{{$value->package_value}}</td>
                                                                    <td>
                                                                        @if(empty($value->package_size[0]->size))
                                                                            --
                                                                        @else
                                                                            <select class="form-control select_size" data-url="{{ route('admin.ajax.get.package.measurement') }}" data-token="{{ csrf_token() }}">
                                                                            @forelse($value->package_size as $s_key => $s_value)
                                                                                <option value="{{$s_value->id}}">{{$s_value->size}}</option>
                                                                            @empty
                                                                            @endforelse
                                                                            </select>
                                                                        @endif
                                                                        
                                                                    </td>
                                                                    <td class="length">
                                                                        <img src="{{asset('/backend/assets/images/LoaderIcon.gif')}}" class="loader_img" style="display: none;">
                                                                        @if(empty($value->package_size[0]->length))
                                                                            <span>-</span>
                                                                        @else
                                                                            <span>{{$value->package_size[0]->length}}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="width">
                                                                        <img src="{{asset('/backend/assets/images/LoaderIcon.gif')}}" class="loader_img" style="display: none;">
                                                                        @if(empty($value->package_size[0]->width))
                                                                            <span>-</span>
                                                                        @else
                                                                            <span>{{$value->package_size[0]->width}}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="height">
                                                                        <img src="{{asset('/backend/assets/images/LoaderIcon.gif')}}" class="loader_img" style="display: none;">
                                                                        @if(empty($value->package_size[0]->height))
                                                                            <span>-</span>
                                                                        @else
                                                                            <span>{{$value->package_size[0]->height}}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="lwh_measurement">
                                                                        <img src="{{asset('/backend/assets/images/LoaderIcon.gif')}}" class="loader_img" style="display: none;">
                                                                        <?php
                                                                        $lwh_measurement_row = $value->package_size[0]->lwh_measurement;
                                                                        ?>
                                                                        @if($lwh_measurement_row == 'Centimetres')
                                                                            <?php $lwh_measurement = 'CM'; ?>
                                                                        @elseif($lwh_measurement_row == 'Inch')
                                                                            <?php $lwh_measurement = 'Inch'; ?>
                                                                        @elseif($lwh_measurement_row == 'Feet')
                                                                            <?php $lwh_measurement = 'Feet'; ?>
                                                                        @elseif($lwh_measurement_row == 'Metres')
                                                                            <?php $lwh_measurement = 'M'; ?>
                                                                        @endif

                                                                        @if(empty($value->package_size[0]->length) && empty($value->package_size[0]->width) && empty($value->package_size[0]->height))
                                                                            <span>-</span>
                                                                        @else
                                                                            <span>{{$lwh_measurement}}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="weight">
                                                                        <img src="{{asset('/backend/assets/images/LoaderIcon.gif')}}" class="loader_img" style="display: none;">
                                                                        @if(empty($value->package_size[0]->weight))
                                                                            <span>-</span>
                                                                        @else
                                                                            <span>{{$value->package_size[0]->weight}}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="weight_measurement">
                                                                        <img src="{{asset('/backend/assets/images/LoaderIcon.gif')}}" class="loader_img" style="display: none;">
                                                                        <?php
                                                                        $weight_measurement_row = $value->package_size[0]->weight_measurement;
                                                                        ?>
                                                                        @if($weight_measurement_row == 'Grams')
                                                                            <?php $weight_measurement = 'G'; ?>
                                                                        @elseif($weight_measurement_row == 'oz')
                                                                            <?php $weight_measurement = 'Oz'; ?>
                                                                        @elseif($weight_measurement_row == 'Kilograms')
                                                                            <?php $weight_measurement = 'Kg'; ?>
                                                                        @elseif($weight_measurement_row == 'Pound')
                                                                            <?php $weight_measurement = 'Pnd'; ?>
                                                                        @endif

                                                                        @if(empty($value->package_size[0]->weight))
                                                                            <span>-</span>
                                                                        @else
                                                                            <span>{{$weight_measurement}}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($type1_array != 0)
                                                                        <select class="form-control">
                                                                            @forelse($type1_array as $type1_key => $type1_value)
                                                                            <option>{{$type1_value}}</option>
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                        @else
                                                                            --
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($type2_array != 0 && $type2_array[0] != '')
                                                                        <select class="form-control">
                                                                            @forelse($type2_array as $type2_key => $type2_value)
                                                                            <option>{{$type2_value}}</option>
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                        @else
                                                                            --
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($value->status == 0)
                                                                            <span class="label label-danger blog_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}"  title="Click to Active">Deactive</span>
                                                                        @else
                                                                            <span class="label label-success blog_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                                                                    <td class="text-center">
                                                                        <a href="{{ route('admin.edit.package',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                        <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_package" data-id="{{ $value->id }}" data-url="{{ route('admin.package.delete') }}"  data-token="{{ csrf_token() }}"></i></a>
                                                                    </td>
                                                                </tr>
                                                                @empty
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Footer -->
                        @include('admin.layouts.footer')
                    <!-- /footer -->

                </div>
            </div>
@endsection