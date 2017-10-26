@extends('admin/layouts.app')
@push('css')
    <link href="{{ asset('/backend/assets/css/extras/animate.min.css') }}" rel="stylesheet">
    <style type="text/css">
        .domestic_api_datatable span{
            cursor: pointer;
        }
        .international_api_datatable span{
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".manage_api").addClass('active');

            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
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
                            <li class="active">API Management</li>
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
                        API Management
                        <small class="display-block">Add and display all domestic and internayional API</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">API</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="tabbable tab-content-bordered">
                                        <ul class="nav nav-tabs nav-tabs-highlight">
                                            <li class="active"><a href="#css-animate-tab1" data-toggle="tab">Domestic API <span class="badge bg-slate position-right cat_count">{{ count($domestic_api) }}</span></a></li>
                                            <li><a href="#css-animate-tab2" data-toggle="tab">International API <span class="badge bg-slate position-right cat_count">{{ count($international_api) }}</span></a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane animated bounceIn has-padding active" id="css-animate-tab1">
                                                <div class="row">

                                                    <!-- add domestic api --> 
                                                    <div class="col-md-12">
                                                        <form action="{{ route('admin.post.api') }}" class="form-horizontal domestic_api_form" method="post">
                                                        {{ csrf_field()}}
                                                        <input type="hidden" name="api_type" value="domestic">
                                                            <div class="panel panel-flat">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">Domestic API Form</h5>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Api Name:</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" name="api_name" class="form-control" placeholder="Enter Domestic API Name" required="">
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
                                                                            <input type="text" name="slug_name" class="form-control" placeholder="Enter Domestic API Slug Name" required="">
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
                                                                            <input type="url" name="access_quote_live_url" class="form-control" placeholder="Enter Domestic Quote Live URL" required="">
                                                                            @if ($errors->has('access_quote_live_url'))
                                                                                <label id="access_quote_live_url-error" class="validation-error-label" for="access_quote_live_url">
                                                                                        {{ $errors->first('access_quote_live_url') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="url" name="access_quote_test_url" class="form-control" placeholder="Enter Domestic Quote Test URL" required="">
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
                                                                            <input type="url" name="access_booking_live_url" class="form-control" placeholder="Enter Domestic Booking Live URL" required="">
                                                                            @if ($errors->has('access_booking_live_url'))
                                                                                <label id="access_booking_live_url-error" class="validation-error-label" for="access_booking_live_url">
                                                                                        {{ $errors->first('access_booking_live_url') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="url" name="access_booking_test_url" class="form-control" placeholder="Enter Domestic Booking Test URL" required="">
                                                                            @if ($errors->has('access_booking_test_url'))
                                                                                <label id="access_booking_test_url-error" class="validation-error-label" for="access_booking_test_url">
                                                                                        {{ $errors->first('access_booking_test_url') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">label URL:</label>
                                                                        <div class="col-lg-4">
                                                                            <input type="url" name="access_label_live_url" class="form-control" placeholder="Enter Domestic Label Live URL" required="">
                                                                            @if ($errors->has('access_label_live_url'))
                                                                                <label id="access_label_live_url-error" class="validation-error-label" for="access_label_live_url">
                                                                                        {{ $errors->first('access_label_live_url') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="url" name="access_label_test_url" class="form-control" placeholder="Enter Domestic Label Test URL" required="">
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
                                                                            <input type="text" name="access_live_usernm" class="form-control" placeholder="Enter Domestic Live User Name" required="">
                                                                            @if ($errors->has('access_live_usernm'))
                                                                                <label id="access_live_usernm-error" class="validation-error-label" for="access_live_usernm">
                                                                                        {{ $errors->first('access_live_usernm') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="text" name="access_test_usernm" class="form-control" placeholder="Enter Domestic Test User Name" required="">
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
                                                                            <input type="text" name="access_live_password" class="form-control" placeholder="Enter Domestic Live Password" required="">
                                                                            @if ($errors->has('access_live_password'))
                                                                                <label id="access_live_password-error" class="validation-error-label" for="access_live_password">
                                                                                        {{ $errors->first('access_live_password') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="text" name="access_test_password" class="form-control" placeholder="Enter Domestic Test Password" required="">
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
                                                                            <input type="checkbox" name="mode" data-on-color="success" data-off-color="danger" data-on-text="LIVE" data-off-text="TEST" class="switch_button" value="live">
                                                                        </div>
                                                                    </div>

                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn border-slate text-slate-800 btn-flat">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                                        <button type="reset" class="btn border-slate text-slate-800 btn-flat" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- View domestic api table -->
                                                    <div class="col-md-12">
                                                        <div class="panel panel-flat">
                                                            <div class="panel-heading">
                                                                <h5 class="panel-title">Domestic Api Table</h5>
                                                                <div class="heading-elements">
                                                                    <div class="checkbox checkbox-switch">
                                                                        <label>
                                                                            @if(count($domestic_active_api) == '0')
                                                                                <input type="checkbox" data-token="{{ csrf_token() }}" data-atype="domestic" data-on-color="success" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="api_enable_disable">
                                                                            @else
                                                                                <input type="checkbox" data-token="{{ csrf_token() }}" data-atype="domestic" data-on-color="success" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="api_enable_disable" checked="checked">
                                                                            @endif
                                                                            Enable/Disable
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="panel-body">
                                                                <table class="table domestic_api_datatable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>Name</th>
                                                                            <th>Slug</th>
                                                                            <th>Type</th>
                                                                            <th>Status</th>
                                                                            <th>Date</th>
                                                                            <th class="text-center">Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse($domestic_api as $key => $value)
                                                                            <tr>
                                                                                <td></td>
                                                                                <td>{{ $value->name }}</td>
                                                                                <td>{{ $value->slug }}</td>
                                                                                <td><span class="label label-flat border-purple text-purple-600">{{ $value->type }}</span></td>
                                                                                <td>
                                                                                    @if($value->status == 0)
                                                                                        <span class="label label-danger api_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}"  title="Click to Active">Deactive</span>
                                                                                    @else
                                                                                        <span class="label label-success api_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                                                                                <td class="text-center">
                                                                                    <a href="{{ route('admin.edit.api',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                                    <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_api" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}"></i></a>
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

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab2">
                                                <div class="row">

                                                    <!-- add international api --> 
                                                    <div class="col-md-12">
                                                        <form action="{{ route('admin.post.api') }}" class="form-horizontal international_api_form" method="post">
                                                        {{ csrf_field()}}
                                                        <input type="hidden" name="api_type" value="international">
                                                            <div class="panel panel-flat">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">International API Form</h5>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Api Name:</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" name="api_name" class="form-control" placeholder="Enter International API Name" required="">
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
                                                                            <input type="text" name="slug_name" class="form-control" placeholder="Enter International API Slug Name" required="">
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
                                                                        <label class="col-lg-3 control-label"></label>
                                                                        <div class="col-lg-4">
                                                                            <span class="label label-flat label-block border-brown text-brown-600">Live</span>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <span class="label label-flat label-block border-brown text-brown-600">Test</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Quote URL:</label>
                                                                        <div class="col-lg-4">
                                                                            <input type="url" name="access_quote_live_url" class="form-control" placeholder="Enter International Quote Live URL" required="">
                                                                            @if ($errors->has('access_quote_live_url'))
                                                                                <label id="access_quote_live_url-error" class="validation-error-label" for="access_quote_live_url">
                                                                                        {{ $errors->first('access_quote_live_url') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="url" name="access_quote_test_url" class="form-control" placeholder="Enter International Quote Test URL" required="">
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
                                                                            <input type="url" name="access_booking_live_url" class="form-control" placeholder="Enter International Booking Live URL" required="">
                                                                            @if ($errors->has('access_booking_live_url'))
                                                                                <label id="access_booking_live_url-error" class="validation-error-label" for="access_booking_live_url">
                                                                                        {{ $errors->first('access_booking_live_url') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="url" name="access_booking_test_url" class="form-control" placeholder="Enter International Booking Test URL" required="">
                                                                            @if ($errors->has('access_booking_test_url'))
                                                                                <label id="access_booking_test_url-error" class="validation-error-label" for="access_booking_test_url">
                                                                                        {{ $errors->first('access_booking_test_url') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">label URL:</label>
                                                                        <div class="col-lg-4">
                                                                            <input type="url" name="access_label_live_url" class="form-control" placeholder="Enter International Label Live URL" required="">
                                                                            @if ($errors->has('access_label_live_url'))
                                                                                <label id="access_label_live_url-error" class="validation-error-label" for="access_label_live_url">
                                                                                        {{ $errors->first('access_label_live_url') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="url" name="access_label_test_url" class="form-control" placeholder="Enter International Label Test URL" required="">
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
                                                                            <input type="text" name="access_live_usernm" class="form-control" placeholder="Enter International Live User Name" required="">
                                                                            @if ($errors->has('access_live_usernm'))
                                                                                <label id="access_live_usernm-error" class="validation-error-label" for="access_live_usernm">
                                                                                        {{ $errors->first('access_live_usernm') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="text" name="access_test_usernm" class="form-control" placeholder="Enter International Test User Name" required="">
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
                                                                            <input type="text" name="access_live_password" class="form-control" placeholder="Enter  InternationalLive Password" required="">
                                                                            @if ($errors->has('access_live_password'))
                                                                                <label id="access_live_password-error" class="validation-error-label" for="access_live_password">
                                                                                        {{ $errors->first('access_live_password') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <input type="text" name="access_test_password" class="form-control" placeholder="Enter  InternationalTest Password" required="">
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
                                                                            <input type="checkbox" name="mode" data-on-color="success" data-off-color="danger" data-on-text="LIVE" data-off-text="TEST" class="switch_button" value="live">
                                                                        </div>
                                                                    </div>

                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn border-slate text-slate-800 btn-flat">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                                        <button type="reset" class="btn border-slate text-slate-800 btn-flat" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- View domestic api table -->
                                                    <div class="col-md-12">
                                                        <div class="panel panel-flat">
                                                            <div class="panel-heading">
                                                                <h5 class="panel-title">International Api Table</h5>
                                                                <div class="heading-elements">
                                                                    <div class="checkbox checkbox-switch">
                                                                        <label>
                                                                            @if(count($international_active_api) == '0')
                                                                                <input type="checkbox" data-token="{{ csrf_token() }}" data-atype="international" data-on-color="success" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="api_enable_disable">
                                                                            @else
                                                                                <input type="checkbox" data-token="{{ csrf_token() }}" data-atype="international" data-on-color="success" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="api_enable_disable" checked="checked">
                                                                            @endif
                                                                            Enable/Disable
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="panel-body">
                                                                <table class="table international_api_datatable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>Name</th>
                                                                            <th>Slug</th>
                                                                            <th>Type</th>
                                                                            <th>Status</th>
                                                                            <th>Date</th>
                                                                            <th class="text-center">Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse($international_api as $key => $value)
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>{{ $value->name }}</td>
                                                                        <td>{{ $value->slug }}</td>
                                                                        <td><span class="label label-flat border-brown text-brown-600">{{ $value->type }}</span></td>
                                                                        <td>
                                                                            @if($value->status == 0)
                                                                                <span class="label label-danger api_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}"  title="Click to Active">Deactive</span>
                                                                            @else
                                                                                <span class="label label-success api_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                                                                        <td class="text-center">
                                                                            <a href="{{ route('admin.edit.api',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                            <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_api" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}"></i></a>
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
                        </div>
                    </div>


                    <!-- Footer -->
                        @include('admin.layouts.footer')
                    <!-- /footer -->

                </div>
            </div>
@endsection