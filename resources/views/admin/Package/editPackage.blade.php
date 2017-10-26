@extends('admin/layouts.app')
@push('css')
<style type="text/css">
    .form-control[readonly] {
        cursor: not-allowed;
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
                            <li><a href="{{ route('admin.api') }}"><i class="icon-blog position-left"></i> Package Management</a></li>
                            <li class="active">Edit Package </li>
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
                        Edit Package
                        <small class="display-block">Edit Package</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Edit Package</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form action="{{ route('admin.post.edit.package') }}" class="form-horizontal package_form" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="package_id" value="{{$package->id}}">
                                                        {{ csrf_field()}}
                                                            <div class="panel panel-flat">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">Product Form</h5>
                                                                </div>

                                                                <div class="panel-body">

                                                                    <div class="form-group">
                                                                        <label class="col-lg-2 control-label">Package Name:</label>
                                                                        <div class="col-lg-10">
                                                                            <input type="text" name="package_name" class="form-control" placeholder="Enter Package Name" required="" value="{{$package->package_name}}">
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
                                                                                <option value="Bag/Luggage"@if($package->package_type == 'Bag/Luggage') selected @endif>Bag/Luggage</option>
                                                                                <option value="Box"@if($package->package_type == 'Box') selected @endif>Box</option>
                                                                                <option value="Carton"@if($package->package_type == 'Carton') selected @endif>Carton</option>
                                                                                <option value="Crate"@if($package->package_type == 'Crate') selected @endif>Crate</option>
                                                                                <option value="Cylinder"@if($package->package_type == 'Cylinder') selected @endif>Cylinder</option>
                                                                                <option value="Envelope"@if($package->package_type == 'Envelope') selected @endif>Envelope</option>
                                                                                <option value="Flat Pack"@if($package->package_type == 'Flat Pack') selected @endif>Flat Pack</option>
                                                                                <option value="Pallet"@if($package->package_type == 'Pallet') selected @endif>Pallet</option>
                                                                                <option value="Parcel"@if($package->package_type == 'Parcel') selected @endif>Parcel</option>
                                                                                <option value="Satchel"@if($package->package_type == 'Satchel') selected @endif>Satchel</option>
                                                                                <option value="Skid"@if($package->package_type == 'Skid') selected @endif>Skid</option>
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
                                                                                <option value="Bag/Luggage"@if($package->package_value == 'Bag/Luggage') selected @endif>Bag/Luggage</option>
                                                                                <option value="Box"@if($package->package_value == 'Box') selected @endif>Box</option>
                                                                                <option value="Carton"@if($package->package_value == 'Carton') selected @endif>Carton</option>
                                                                                <option value="Crate"@if($package->package_value == 'Crate') selected @endif>Crate</option>
                                                                                <option value="Cylinder"@if($package->package_value == 'Cylinder') selected @endif>Cylinder</option>
                                                                                <option value="Document Envelope"@if($package->package_value == 'Document Envelope') selected @endif>Document Envelope</option>
                                                                                <option value="Flat Pack"@if($package->package_value == 'Flat Pack') selected @endif>Flat Pack</option>
                                                                                <option value="Pallet"@if($package->package_value == 'Pallet') selected @endif>Pallet</option>
                                                                                <option value="Parcel"@if($package->package_value == 'Parcel') selected @endif>Parcel</option>
                                                                                <option value="Satchel/Bag"@if($package->package_value == 'Satchel/Bag') selected @endif>Satchel/Bag</option>
                                                                                <option value="Skid"@if($package->package_value == 'Skid') selected @endif>Skid</option>
                                                                            </select>
                                                                            @if ($errors->has('package_value'))
                                                                                <label id="package_value-error" class="validation-error-label" for="package_value">
                                                                                        {{ $errors->first('package_value') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="size_div">
                                                                    @forelse($packagesize as $s_key => $s_value)
                                                                        <div class="form-group">
                                                                        <input type="hidden" name="package_size_id[]" value="{{$s_value->id}}">
                                                                        @if($s_key == 0)
                                                                            <label class="col-lg-2 control-label">Size:</label>
                                                                        @else
                                                                            <label class="col-lg-2 control-label"></label>
                                                                        @endif
                                                                          
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="size[]" class="form-control size" placeholder="Size" value="{{$s_value->size}}">
                                                                          </div>
                                                                          <label class="col-lg-1 control-label">Length</label>
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="length[]" class="form-control" placeholder="Length" value="{{$s_value->length}}">
                                                                          </div>
                                                                          <label class="col-lg-1 control-label">Width</label>
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="width[]" class="form-control" placeholder="Width" value="{{$s_value->width}}">
                                                                          </div>
                                                                          <label class="col-lg-1 control-label">Height</label>
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="height[]" class="form-control" placeholder="Height" value="{{$s_value->height}}">
                                                                          </div>
                                                                          <div class="col-lg-1">
                                                                            <select name="lwh_measurement[]" class="form-control select">
                                                                                <option value="Centimetres"@if($s_value->lwh_measurement == 'Centimetres') selected @endif>CM</option>
                                                                                <option value="Inch"@if($s_value->lwh_measurement == 'Inch') selected @endif>Inch</option>
                                                                                <option value="Feet"@if($s_value->lwh_measurement == 'Feet') selected @endif>Feet</option>
                                                                                <option value="Metres"@if($s_value->lwh_measurement == 'Metres') selected @endif>M</option>
                                                                            </select>
                                                                          </div>
                                                                          <label class="col-lg-1 control-label">Weight</label>
                                                                          <div class="col-lg-1">
                                                                            <input type="text" name="weight[]" class="form-control" placeholder="Weight" value="{{$s_value->weight}}">
                                                                          </div>
                                                                          <div class="col-lg-1">
                                                                            <select name="weight_measurement[]" class="form-control select">
                                                                                <option value="Grams"@if($s_value->weight_measurement == 'Grams') selected @endif>G</option>
                                                                                <option value="oz"@if($s_value->weight_measurement == 'oz') selected @endif>Oz</option>
                                                                                <option value="Kilograms" @if($s_value->weight_measurement == 'Kilograms') selected @endif>Kg</option>
                                                                                <option value="Pound"@if($s_value->weight_measurement == 'Pound') selected @endif>Pnd</option>
                                                                            </select>
                                                                          </div>
                                                                          @if($s_key == 0)
                                                                          <div class="col-lg-1">
                                                                            <a href="javascript:void(0)"><i class="icon-plus-circle2 add_more_btn_size add_plus"></i></a>
                                                                          </div>
                                                                          @else
                                                                          <div class="col-lg-1">
                                                                            <a href="javascript:void(0)" class="text-danger-600"><i class="icon-minus-circle2 remove_btn_size remove_minus" data-id="{{$s_value->id}}" data-url="{{route('admin.ajax.delete.package.size')}}" data-token="{{ csrf_token() }}"></i></a>
                                                                          </div>
                                                                          @endif
                                                                        </div>
                                                                    @empty
                                                                    @endforelse
                                                                    </div>

                                                                    
                                                                    @if($type1_array !== 0)
                                                                        @forelse($type1_array as $t1_key => $t1_value)
                                                                        <div class="type1_div">
                                                                        <div class="form-group">
                                                                        @if($t1_key == 0)
                                                                            <label class="col-lg-2 control-label">Type 1:</label>
                                                                        @else
                                                                            <label class="col-lg-2 control-label"></label>
                                                                        @endif
                                                                          <div class="col-lg-5">
                                                                            <input type="text" name="type1[]" class="form-control type1" placeholder="Type 1" value="{{$t1_value}}">
                                                                          </div>
                                                                          <div class="col-lg-5">
                                                                            @if($t1_key == 0)  
                                                                                <a href="javascript:void(0)"><i class="icon-plus-circle2 add_more_btn_type1 add_plus"></i></a>
                                                                            @else
                                                                                <a href="javascript:void(0)" class="text-danger-600"><i class="icon-minus-circle2 remove_btn_type1 remove_minus"></i></a>
                                                                            @endif
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        @empty
                                                                        @endforelse
                                                                    @else
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
                                                                    @endif
                                                                    

                                                                    @if($type2_array !== 0)
                                                                    
                                                                        @forelse($type2_array as $t2_key => $t2_value)
                                                                        <div class="type2_div">
                                                                        <div class="form-group">
                                                                        @if($t2_key == 0)
                                                                            <label class="col-lg-2 control-label">Type 2:</label>
                                                                        @else
                                                                            <label class="col-lg-2 control-label"></label>
                                                                        @endif
                                                                          <div class="col-lg-5">
                                                                            <input type="text" name="type2[]" class="form-control type2" placeholder="Type 2" value="{{$t2_value}}">
                                                                          </div>
                                                                          <div class="col-lg-5">
                                                                            @if($t2_key == 0)
                                                                                <a href="javascript:void(0)"><i class="icon-plus-circle2 add_more_btn_type2 add_plus"></i></a>
                                                                            @else
                                                                                <a href="javascript:void(0)" class="text-danger-600"><i class="icon-minus-circle2 remove_btn_type2 remove_minus"></i></a>
                                                                            @endif

                                                                          </div>
                                                                        </div>
                                                                        </div>
                                                                        @empty
                                                                        @endforelse
                                                                    @else
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
                                                                    @endif
                                                                    

                                                                    <div class="form-group">
                                                                        <label class="col-lg-2 control-label">Status:</label>
                                                                        <div class="col-lg-10">
                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="status" checked="checked" value="1"@if($package->status == '1') checked @endif>
                                                                                Active
                                                                            </label>

                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="status" value="0"@if($package->status == '0') checked @endif>
                                                                                Deactive
                                                                            </label>
                                                                            @if ($errors->has('status'))
                                                                                <label id="status-error" class="validation-error-label" for="status">
                                                                                        {{ $errors->first('status') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>


                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn border-slate text-slate-800 btn-flat">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                                        <a href="{{ route('admin.package') }}" class="btn border-slate text-slate-800 btn-flat" id="reset"><i class="icon-arrow-left13 position-left"></i> Back</a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>
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