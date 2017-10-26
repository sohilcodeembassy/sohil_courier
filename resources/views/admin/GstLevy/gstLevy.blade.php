@extends('admin/layouts.app')

@push('css')
<style type="text/css">
    .cancel_btn{
        display: none;
    }
    .loader{
        display: none;
    }
    .success_div{
        display: none;   
    }
    .error_div{
        display: none;   
    }
</style>
@endpush

@push('js')

    <script type="text/javascript">
        $(document).ready(function(){
            $(".gst_levy_management").addClass('active');
        })
    </script>
@endpush

@section('content')
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Gst & Levy Management</span></h4>
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
                            <li><a href="{{ route('admin.blog_category') }}"><i class="icon-blog position-left"></i> Gst & Levy Management</a></li>
                            <li class="active">Gst & Levy Management</li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->

                <div class="content">

                        <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered success_div">
                        </div>

                        <div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered error_div">
                        </div>

                    <h6 class="content-group text-semibold">
                        Gst & Levy
                        <small class="display-block">Gst & Levy Management</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Gst & Levy Management</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form action="{{ route('admin.post.edit_blog_category') }}" class="form-horizontal" method="post">
                                    {{ csrf_field()}}
                                        <div class="panel panel-flat">
                                            <div class="panel-body">

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">GST:</label>
                                                    <div class="col-lg-3 gstlevy_content">
                                                        <span class="label label-block border-left-info label-striped">{{$gstLevy->gst}}</span>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="javascript:void(0)" data-token="{{ csrf_token() }}" data-url="{{route('admin.getlevy.edit')}}" data-field="gst" class="label border-left-grey label-striped edit_btn">Edit</a>
                                                        <img src="{{asset('/backend/assets/images/ajax-loader.gif')}}" class="loader" />
                                                        <a href="javascript:void(0)" class="label border-left-danger label-striped cancel_btn">Cancel</a>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Couriers Please Fuel levy:</label>
                                                    <div class="col-lg-3 gstlevy_content">
                                                        <span class="label label-block border-left-info label-striped">{{$gstLevy->couriers_please_fuel_levy}}</span>
                                                        <input type="hidden" class="gstlevy_field_hidden" value="couriers_please_fuel_levy">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="javascript:void(0)" data-token="{{ csrf_token() }}" data-url="{{route('admin.getlevy.edit')}}" data-field="couriers_please_fuel_levy" class="label border-left-grey label-striped edit_btn">Edit</a>
                                                        <img src="{{asset('/backend/assets/images/ajax-loader.gif')}}" class="loader" />
                                                        <a href="javascript:void(0)" class="label border-left-danger label-striped cancel_btn">Cancel</a>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Startrack fuel levy:</label>
                                                    <div class="col-lg-3 gstlevy_content">
                                                        <span class="label label-block border-left-info label-striped">{{$gstLevy->startrack_fuel_levy}}</span>
                                                        <input type="hidden" class="gstlevy_field_hidden" value="startrack_fuel_levy">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="javascript:void(0)" data-token="{{ csrf_token() }}" data-url="{{route('admin.getlevy.edit')}}" data-field="startrack_fuel_levy" class="label border-left-grey label-striped edit_btn">Edit</a>
                                                        <img src="{{asset('/backend/assets/images/ajax-loader.gif')}}" class="loader" />
                                                        <a href="javascript:void(0)" class="label border-left-danger label-striped cancel_btn">Cancel</a>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Residential charge Call:</label>
                                                    <div class="col-lg-3 gstlevy_content">
                                                        <span class="label label-block border-left-info label-striped">{{$gstLevy->residential_charge_call}}</span>
                                                        <input type="hidden" class="gstlevy_field_hidden" value="residential_charge_call">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="javascript:void(0)" data-token="{{ csrf_token() }}" data-url="{{route('admin.getlevy.edit')}}" data-field="residential_charge_call" class="label border-left-grey label-striped edit_btn">Edit</a>
                                                        <img src="{{asset('/backend/assets/images/ajax-loader.gif')}}" class="loader" />
                                                        <a href="javascript:void(0)" class="label border-left-danger label-striped cancel_btn">Cancel</a>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Taillift charge:</label>
                                                    <div class="col-lg-3 gstlevy_content">
                                                        <span class="label label-block border-left-info label-striped">{{$gstLevy->traillift_charge}}</span>
                                                        <input type="hidden" class="gstlevy_field_hidden" value="traillift_charge">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="javascript:void(0)" data-token="{{ csrf_token() }}" data-url="{{route('admin.getlevy.edit')}}" data-field="traillift_charge" class="label border-left-grey label-striped edit_btn">Edit</a>
                                                        <img src="{{asset('/backend/assets/images/ajax-loader.gif')}}" class="loader" />
                                                        <a href="javascript:void(0)" class="label border-left-danger label-striped cancel_btn">Cancel</a>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Manual Handling Fee:</label>
                                                    <div class="col-lg-3 gstlevy_content">
                                                        <span class="label label-block border-left-info label-striped">{{$gstLevy->manual_handling_fee}}</span>
                                                        <input type="hidden" class="gstlevy_field_hidden" value="manual_handling_fee">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="javascript:void(0)" data-token="{{ csrf_token() }}" data-url="{{route('admin.getlevy.edit')}}" data-field="manual_handling_fee" class="label border-left-grey label-striped edit_btn">Edit</a>
                                                        <img src="{{asset('/backend/assets/images/ajax-loader.gif')}}" class="loader" />
                                                        <a href="javascript:void(0)" class="label border-left-danger label-striped cancel_btn">Cancel</a>
                                                    </div>
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