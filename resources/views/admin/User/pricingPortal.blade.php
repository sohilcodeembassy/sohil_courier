@extends('admin/layouts.app')
@push('css')
    <link href="{{ asset('/backend/assets/css/extras/animate.min.css') }}" rel="stylesheet">
    <style type="text/css">
        .pricing_portal_api_datatable span{
            cursor: pointer;
        }
        /*.international_pricing_api_datatable span{
            cursor: pointer;
        }*/
    </style>
@endpush

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".manage_user").addClass('active');

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
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User Pricing Portal Management</span></h4>
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
                            <li class="active">User Pricing Portal Management</li>
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
                        User Pricing Portal Management
                        <small class="display-block">Add and display all domestic and internayional Pricing Portal</small>
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
                                            <li class="active"><a href="#css-animate-tab1" data-toggle="tab">Domestic Pricing Portal <span class="badge bg-slate position-right cat_count">{{ count($domestic_pricingPortalApi) }}</span></a></li>
                                            <li><a href="#css-animate-tab2" data-toggle="tab">International Pricing Portal <span class="badge bg-slate position-right cat_count">{{ count($international_pricingPortalApi) }}</span></a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane animated bounceIn has-padding active" id="css-animate-tab1">
                                                <div class="row">
                                                    <!-- add domestic pricing portal api --> 
                                                    <div class="col-md-12">
                                                        <form action="{{ route('admin.post.user.pricing.portal') }}" class="form-horizontal domestic_pricing_portal_api_form" method="post">
                                                        {{ csrf_field()}}
                                                        <input type="hidden" name="api_type" value="domestic">    
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">    
                                                            <div class="panel panel-flat">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">Domestic Pricing Portal API Form</h5>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Api Name:</label>
                                                                        <div class="col-lg-9">
                                                                            <select data-placeholder="Select a API..." class="select" name="api_name" required="">
                                                                            <option></option>
                                                                            @forelse($domestic_api as $key => $value)
                                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                                            @empty
                                                                            @endforelse                    
                                                                            </select>
                                                                            @if ($errors->has('api_name'))
                                                                                <label id="api_name-error" class="validation-error-label" for="api_name">
                                                                                        {{ $errors->first('api_name') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Price Modifier:</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" name="price_modifier" class="form-control" placeholder="Enter Price Modifier" required="">
                                                                            @if ($errors->has('price_modifier'))
                                                                                <label id="price_modifier-error" class="validation-error-label" for="price_modifier">
                                                                                        {{ $errors->first('price_modifier') }}
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

                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn border-slate text-slate-800 btn-flat">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                                        <button type="reset" class="btn border-slate text-slate-800 btn-flat" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- View domestic pricing portal api table -->
                                                    <div class="col-md-12">
                                                        <div class="panel panel-flat">
                                                            <div class="panel-heading">
                                                                <h5 class="panel-title">Domestic Pricing Portal Api Table</h5>
                                                                <div class="heading-elements">
                                                                    <div class="checkbox checkbox-switch">
                                                                        <label>
                                                                            @if(count($domestic_pp_active_api) == '0')
                                                                                <input type="checkbox" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.api.all_status') }}" data-userid="{{$user->id}}" data-atype="domestic" data-on-color="success" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="pp_api_enable_disable">
                                                                            @else
                                                                                <input type="checkbox" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.api.all_status') }}" data-userid="{{$user->id}}" data-atype="domestic" data-on-color="success" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="pp_api_enable_disable" checked="checked">
                                                                            @endif
                                                                            Enable/Disable
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="panel-body">
                                                                <table class="table pricing_portal_api_datatable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>Api Name</th>
                                                                            <th>Api Type</th>
                                                                            <th>Price Modifier</th>
                                                                            <th>Status</th>
                                                                            <th>Date</th>
                                                                            <th class="text-center">Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse($domestic_pricingPortalApi as $key => $value)
                                                                            <tr>
                                                                                <td></td>
                                                                                <td>{{ $value->api->name }}</td>
                                                                                <td><span class="label label-flat border-purple text-purple-600">domestic</span></td>
                                                                                <td>{{ $value->price_modifier }}</td>
                                                                                <td>
                                                                                    @if($value->status == 0)
                                                                                        <span class="label label-danger pp_api_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.status') }}" title="Click to Active">Deactive</span>
                                                                                    @else
                                                                                        <span class="label label-success pp_api_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.status') }}" title="Click to Deactive">Active</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                                                                                <td class="text-center">
                                                                                    <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_pp_api" data-id="{{ $value->id }}" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.delete') }}"></i></a>
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

                                                    <!-- add pricing portal international api --> 
                                                    <div class="col-md-12">
                                                        <form action="{{ route('admin.post.user.pricing.portal') }}" class="form-horizontal international_pricing_portal_api_form" method="post">
                                                        {{ csrf_field()}}
                                                        <input type="hidden" name="api_type" value="international">
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">    
                                                            <div class="panel panel-flat">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">International Pricing Portal API Form</h5>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Api Name:</label>
                                                                        <div class="col-lg-9">
                                                                            <select data-placeholder="Select a API..." class="select" name="api_name" required="">
                                                                            <option></option>
                                                                            @forelse($international_api as $key => $value)
                                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                                            @empty
                                                                            @endforelse                    
                                                                            </select>
                                                                            @if ($errors->has('api_name'))
                                                                                <label id="api_name-error" class="validation-error-label" for="api_name">
                                                                                        {{ $errors->first('api_name') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Price Modifier:</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" name="price_modifier" class="form-control" placeholder="Enter Price Modifier" required="">
                                                                            @if ($errors->has('price_modifier'))
                                                                                <label id="price_modifier-error" class="validation-error-label" for="price_modifier">
                                                                                        {{ $errors->first('price_modifier') }}
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

                                                                    <div class="text-left">
                                                                        <button type="submit" class="btn border-slate text-slate-800 btn-flat">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                                        <button type="reset" class="btn border-slate text-slate-800 btn-flat" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- View International pricing portal api table -->
                                                    <div class="col-md-12">
                                                        <div class="panel panel-flat">
                                                            <div class="panel-heading">
                                                                <h5 class="panel-title">International Api Table</h5>
                                                                <div class="heading-elements">
                                                                    <div class="checkbox checkbox-switch">
                                                                        <label>
                                                                            @if(count($international_pp_active_api) == '0')
                                                                                <input type="checkbox" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.api.all_status') }}" data-atype="international" data-userid="{{$user->id}}" data-on-color="success" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="pp_api_enable_disable">
                                                                            @else
                                                                                <input type="checkbox" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.api.all_status') }}" data-atype="international" data-userid="{{$user->id}}" data-on-color="success" data-off-color="default" data-on-text="Enable" data-off-text="Disable" class="pp_api_enable_disable" checked="checked">
                                                                            @endif
                                                                            Enable/Disable
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="panel-body">
                                                                <table class="table pricing_portal_api_datatable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>Api Name</th>
                                                                            <th>Api Type</th>
                                                                            <th>Price Modifier</th>
                                                                            <th>Status</th>
                                                                            <th>Date</th>
                                                                            <th class="text-center">Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse($international_pricingPortalApi as $key => $value)
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>{{ $value->api->name }}</td>
                                                                        <td><span class="label label-flat border-brown text-brown-600">international</span></td>
                                                                        <td>{{ $value->price_modifier }}</td>
                                                                        <td>
                                                                            @if($value->status == 0)
                                                                                <span class="label label-danger pp_api_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.status') }}" title="Click to Active">Deactive</span>
                                                                            @else
                                                                                <span class="label label-success pp_api_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.status') }}" title="Click to Deactive">Active</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                                                                        <td class="text-center">
                                                                            <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_pp_api" data-id="{{ $value->id }}" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.pricing.portal.delete') }}"></i></a>
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