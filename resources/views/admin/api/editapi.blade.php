@extends('admin/layouts.app')
@push('css')
<style type="text/css">
    .form-control[readonly] {
        cursor: not-allowed;
    }
</style>
@endpush

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".manage_api").addClass('active');
        })
    </script>
@endpush

@section('content')
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">API Management</span></h4>
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
                            <li><a href="{{ route('admin.api') }}"><i class="icon-blog position-left"></i> API Management</a></li>
                            <li class="active">Edit {{ $api->type }} API </li>
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
                        Edit {{ $api->type }} API
                        <small class="display-block">Edit {{ $api->type }} API</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Edit {{ $api->type }} API</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form action="{{ route('admin.post.edit_api') }}" class="form-horizontal domestic_api_form" method="post">
                                    {{ csrf_field()}}
                                    <input type="hidden" name="id" value="{{$api->id}}">
                                        <div class="panel panel-flat">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Api Name:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="api_name" class="form-control" placeholder="Enter {{ $api->type }} API Name" required="" value="{{$api->name}}">
                                                        @if ($errors->has('api_name'))
                                                            <label id="api_name-error" class="validation-error-label" for="api_name">
                                                            {{ $errors->first('api_name') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Slug Name:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="slug_name" class="form-control" placeholder="Enter {{ $api->type }} API Slug Name" required="" value="{{$api->slug}}" readonly="">
                                                        @if ($errors->has('slug_name'))
                                                            <label id="slug_name-error" class="validation-error-label" for="slug_name">
                                                                {{ $errors->first('slug_name') }}
                                                            </label>
                                                         @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Status:</label>
                                                    <div class="col-lg-9">
                                                        <label class="radio-inline">
                                                            <input type="radio" class="styled_radio" name="status" required="" value="1"@if($api->status == '1') checked @endif>
                                                            Active
                                                        </label>

                                                        <label class="radio-inline">
                                                            <input type="radio" class="styled_radio" name="status" value="0" @if($api->status == '0') checked @endif>
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
                                                    <label class="col-lg-3 control-label"></label>
                                                    <div class="col-lg-4">
                                                        <span class="label label-flat label-block border-purple text-purple-600">Live</span>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="label label-flat label-block border-purple text-purple-600">Test</span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Quote URL:</label>
                                                    <div class="col-lg-4">
                                                        <input type="url" name="access_quote_live_url" class="form-control" placeholder="Enter {{ $api->type }} Quote Live URL" required="" value="{{$api->access_quote_live_url}}">
                                                        @if ($errors->has('access_quote_live_url'))
                                                            <label id="access_quote_live_url-error" class="validation-error-label" for="access_quote_live_url">
                                                                {{ $errors->first('access_quote_live_url') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="url" name="access_quote_test_url" class="form-control" placeholder="Enter {{ $api->type }} Quote Test URL" required="" value="{{$api->access_quote_test_url}}">
                                                        @if ($errors->has('access_quote_test_url'))
                                                            <label id="access_quote_test_url-error" class="validation-error-label" for="access_quote_test_url">
                                                                {{ $errors->first('access_quote_test_url') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Booking URL:</label>
                                                    <div class="col-lg-4">
                                                        <input type="url" name="access_booking_live_url" class="form-control" placeholder="Enter {{ $api->type }} Booking Live URL" required="" value="{{$api->access_booking_live_url}}">
                                                        @if ($errors->has('access_booking_live_url'))
                                                            <label id="access_booking_live_url-error" class="validation-error-label" for="access_booking_live_url">
                                                                {{ $errors->first('access_booking_live_url') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="url" name="access_booking_test_url" class="form-control" placeholder="Enter {{ $api->type }} Booking Test URL" required="" value="{{$api->access_booking_test_url}}">
                                                        @if ($errors->has('access_booking_test_url'))
                                                            <label id="access_booking_test_url-error" class="validation-error-label" for="access_booking_test_url">
                                                                {{ $errors->first('access_booking_test_url') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Label URL:</label>
                                                    <div class="col-lg-4">
                                                        <input type="url" name="access_label_live_url" class="form-control" placeholder="Enter {{ $api->type }} Label Live URL" required="" value="{{$api->access_label_live_url}}">
                                                        @if ($errors->has('access_label_live_url'))
                                                            <label id="access_label_live_url-error" class="validation-error-label" for="access_label_live_url">
                                                                {{ $errors->first('access_label_live_url') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="url" name="access_label_test_url" class="form-control" placeholder="Enter {{ $api->type }} Label Test URL" required="" value="{{$api->access_label_test_url}}">
                                                        @if ($errors->has('access_label_test_url'))
                                                            <label id="access_label_test_url-error" class="validation-error-label" for="access_label_test_url">
                                                                {{ $errors->first('access_label_test_url') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">User Name:</label>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="access_live_usernm" class="form-control" placeholder="Enter {{ $api->type }} Live User Name" required="" value="{{$api->access_live_usernm}}">
                                                        @if ($errors->has('access_live_usernm'))
                                                            <label id="access_live_usernm-error" class="validation-error-label" for="access_live_usernm">
                                                                {{ $errors->first('access_live_usernm') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="access_test_usernm" class="form-control" placeholder="Enter {{ $api->type }} Test User Name" required="" value="{{$api->access_test_usernm}}">
                                                        @if ($errors->has('access_test_usernm'))
                                                            <label id="access_test_usernm-error" class="validation-error-label" for="access_test_usernm">
                                                                {{ $errors->first('access_test_usernm') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Password:</label>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="access_live_password" class="form-control" placeholder="Enter {{ $api->type }} Live Password" required="" value="{{$api->access_live_password}}">
                                                        @if ($errors->has('access_live_password'))
                                                            <label id="access_live_password-error" class="validation-error-label" for="access_live_password">
                                                                {{ $errors->first('access_live_password') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input type="text" name="access_test_password" class="form-control" placeholder="Enter {{ $api->type }} Test Password" required="" value="{{$api->access_test_password}}">
                                                        @if ($errors->has('access_test_password'))
                                                            <label id="access_test_password-error" class="validation-error-label" for="access_test_password">
                                                                {{ $errors->first('access_test_password') }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Mode:</label>
                                                    <div class="col-lg-9">
                                                        <input type="checkbox" name="mode" data-on-color="success" data-off-color="danger" data-on-text="LIVE" data-off-text="TEST" class="switch_button" value="live"@if($api->mode == 'live') checked @endif>
                                                    </div>
                                                </div>

                                                <div class="text-left">
                                                    <button type="submit" class="btn border-slate text-slate-800 btn-flat">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                    <a href="{{ route('admin.api') }}" class="btn border-slate text-slate-800 btn-flat" id="reset"><i class="icon-arrow-left13 position-left"></i> Back</a>
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