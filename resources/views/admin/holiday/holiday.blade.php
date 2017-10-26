@extends('admin/layouts.app')
@push('css')
    <style type="text/css">
        .holiday_datatable span{
            cursor: pointer;
        }
        .form-horizontal .checkbox .checker, .form-horizontal .checkbox-inline .checker{
        	top: 50%;
        }
        .input-group .form-control{
        	float: none;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".holiday_management").addClass('active');

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
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Holiday Management</span></h4>
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
                            <li class="active">Holiday Management</li>
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
                        Holiday Management
                        <small class="display-block">Add and display all Holiday</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Holiday</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                	<div class="row">
                                                    <div class="col-md-12">
                                                        <form action="{{ route('admin.post.holiday') }}" class="form-horizontal holiday_form" method="post">
                                                        {{ csrf_field()}}
                                                            <div class="panel panel-flat">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">Holiday Form</h5>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">State:</label>
                                                                        <div class="col-lg-9">
	                                                                        <div class="input-group">
																				<div class="multi-select-full">
																					<select name="holiday_state[]" class="multiselect-toggle-selection" multiple="multiple" required="">
		                                                                            	<option value="wa">Western Australia (W.A.)</option>
		                                                                            	<option value="vic">Victoria (Vic)</option>
		                                                                            	<option value="tas">Tasmania (Tas)</option>
		                                                                            	<option value="nsw">New South Wales (N.S.W.)</option>
		                                                                            	<option value="sa">South Australia (S.A.)</option>
		                                                                            	<option value="qld">Queensland (Qld)</option>
		                                                                            	<option value="nt">Northern Territory (N.T.)</option>
																					</select>
																				</div>

																				<div class="input-group-btn">
																					<button type="button" class="btn btn-info multiselect-toggle-selection-button">Select All</button>
																				</div>
																			</div>
                                                                            @if ($errors->has('holiday_state'))
                                                                                <label id="holiday_state-error" required="" class="validation-error-label" for="holiday_state">
                                                                                        {{ $errors->first('holiday_state') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Date:</label>
                                                                        <div class="col-lg-9">
																			<input type="text" name="holiday_date" class="form-control holiday_date" placeholder="Select a Date" required="">
                                                                            @if ($errors->has('holiday_date'))
                                                                                <label id="holiday_date-error" class="validation-error-label" for="holiday_date">
                                                                                        {{ $errors->first('holiday_date') }}
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
                                    </div>

                                    <div class="tabbable tab-content-bordered">
                                        <ul class="nav nav-tabs nav-tabs-highlight">
                                            <li class="active"><a href="#css-animate-tab1" data-toggle="tab">(W.A.) <span class="badge bg-slate position-right wa_count">{{ count($wa_state) }}</span></a></li>
                                            <li><a href="#css-animate-tab2" data-toggle="tab">(VIC) <span class="badge bg-slate position-right vic_count">{{ count($vic_state) }}</span></a></li>
                                            <li><a href="#css-animate-tab3" data-toggle="tab">(Tas) <span class="badge bg-slate position-right tas_count">{{ count($tas_state) }}</span></a></li>
                                            <li><a href="#css-animate-tab4" data-toggle="tab">(N.S.W.) <span class="badge bg-slate position-right nsw_count">{{ count($nsw_state) }}</span></a></li>
                                            <li><a href="#css-animate-tab5" data-toggle="tab">(S.A.) <span class="badge bg-slate position-right sa_count">{{ count($sa_state) }}</span></a></li>
                                            <li><a href="#css-animate-tab6" data-toggle="tab">(Qld) <span class="badge bg-slate position-right qld_count">{{ count($qld_state) }}</span></a></li>
                                            <li><a href="#css-animate-tab7" data-toggle="tab">(N.T.) <span class="badge bg-slate position-right nt_count">{{ count($nt_state) }}</span></a></li>
                                        </ul>

                                        <div class="tab-content">

                                            <div class="tab-pane animated bounceIn has-padding active" id="css-animate-tab1">
                                            	<h5 class="panel-title">Western Australia (W.A)</h5>
                                                <table class="table holiday_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Holidays</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	@forelse($wa_state as $key => $value)
                                                    	<tr>
                                                    		<td></td>
                                                    		<td><span class="label label-flat border-brown text-brown-600">{{ $value->holiday_date }}</span> </td>
                                                    		<td>
                                                                @if($value->status == 0)
                                                                    <span class="label label-danger holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Active">Deactive</span>
                                                                @else
                                                                    <span class="label label-success holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                @endif
                                                            </td>
                                                    		<td>{{ date('d F Y', strtotime($value->created_at)) }} </td>
                                                    		<td class="text-center">
                                                                <a href="{{ route('admin.edit.holiday',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_holiday" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}" data-state="wa"></i></a>
                                                            </td>
                                                    	</tr>
                                                    	@empty
                                                    	@endforelse 
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab2">
                                                <h5 class="panel-title">Victoria (VIC)</h5>
                                                <table class="table holiday_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Holidays</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	@forelse($vic_state as $key => $value)
                                                    	<tr>
                                                    		<td></td>
                                                    		<td><span class="label label-flat border-brown text-brown-600">{{ $value->holiday_date }}</span> </td>
                                                    		<td>
                                                                @if($value->status == 0)
                                                                    <span class="label label-danger holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Active">Deactive</span>
                                                                @else
                                                                    <span class="label label-success holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                @endif
                                                            </td>
                                                    		<td>{{ date('d F Y', strtotime($value->created_at)) }} </td>
                                                    		<td class="text-center">
                                                                <a href="{{ route('admin.edit.holiday',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_holiday" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}" data-state="vic"></i></a>
                                                            </td>
                                                    	</tr>
                                                    	@empty
                                                    	@endforelse 
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab3">
                                                <h5 class="panel-title">Tasmania (Tas)</h5>
                                                <table class="table holiday_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Holidays</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	@forelse($tas_state as $key => $value)
                                                    	<tr>
                                                    		<td></td>
                                                    		<td><span class="label label-flat border-brown text-brown-600">{{ $value->holiday_date }}</span> </td>
                                                    		<td>
                                                                @if($value->status == 0)
                                                                    <span class="label label-danger holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Active">Deactive</span>
                                                                @else
                                                                    <span class="label label-success holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                @endif
                                                            </td>
                                                    		<td>{{ date('d F Y', strtotime($value->created_at)) }} </td>
                                                    		<td class="text-center">
                                                                <a href="{{ route('admin.edit.holiday',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_holiday" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}" data-state="tas"></i></a>
                                                            </td>
                                                    	</tr>
                                                    	@empty
                                                    	@endforelse 
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab4">
                                                <h5 class="panel-title">New South Wales (N.S.W.)</h5>
                                                <table class="table holiday_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Holidays</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	@forelse($nsw_state as $key => $value)
                                                    	<tr>
                                                    		<td></td>
                                                    		<td><span class="label label-flat border-brown text-brown-600">{{ $value->holiday_date }}</span> </td>
                                                    		<td>
                                                                @if($value->status == 0)
                                                                    <span class="label label-danger holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Active">Deactive</span>
                                                                @else
                                                                    <span class="label label-success holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                @endif
                                                            </td>
                                                    		<td>{{ date('d F Y', strtotime($value->created_at)) }} </td>
                                                    		<td class="text-center">
                                                                <a href="{{ route('admin.edit.holiday',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_holiday" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}" data-state="nsw"></i></a>
                                                            </td>
                                                    	</tr>
                                                    	@empty
                                                    	@endforelse 
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab5">
                                                <h5 class="panel-title">South Australia (S.A.)</h5>
                                                <table class="table holiday_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Holidays</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	@forelse($sa_state as $key => $value)
                                                    	<tr>
                                                    		<td></td>
                                                    		<td><span class="label label-flat border-brown text-brown-600">{{ $value->holiday_date }}</span> </td>
                                                    		<td>
                                                                @if($value->status == 0)
                                                                    <span class="label label-danger holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Active">Deactive</span>
                                                                @else
                                                                    <span class="label label-success holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                @endif
                                                            </td>
                                                    		<td>{{ date('d F Y', strtotime($value->created_at)) }} </td>
                                                    		<td class="text-center">
                                                                <a href="{{ route('admin.edit.holiday',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_holiday" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}" data-state="sa"></i></a>
                                                            </td>
                                                    	</tr>
                                                    	@empty
                                                    	@endforelse 
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab6">
                                                <h5 class="panel-title">Queensland (Qld)</h5>
                                                <table class="table holiday_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Holidays</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	@forelse($qld_state as $key => $value)
                                                    	<tr>
                                                    		<td></td>
                                                    		<td><span class="label label-flat border-brown text-brown-600">{{ $value->holiday_date }}</span> </td>
                                                    		<td>
                                                                @if($value->status == 0)
                                                                    <span class="label label-danger holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Active">Deactive</span>
                                                                @else
                                                                    <span class="label label-success holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                @endif
                                                            </td>
                                                    		<td>{{ date('d F Y', strtotime($value->created_at)) }} </td>
                                                    		<td class="text-center">
                                                                <a href="{{ route('admin.edit.holiday',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_holiday" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}"  data-state="qld"></i></a>
                                                            </td>
                                                    	</tr>
                                                    	@empty
                                                    	@endforelse 
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab7">
                                                <h5 class="panel-title">Northern Territory (N.T.)</h5>
                                                <table class="table holiday_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Holidays</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	@forelse($nt_state as $key => $value)
                                                    	<tr>
                                                    		<td></td>
                                                    		<td><span class="label label-flat border-brown text-brown-600">{{ $value->holiday_date }}</span> </td>
                                                    		<td>
                                                                @if($value->status == 0)
                                                                    <span class="label label-danger holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Active">Deactive</span>
                                                                @else
                                                                    <span class="label label-success holiday_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                @endif
                                                            </td>
                                                    		<td>{{ date('d F Y', strtotime($value->created_at)) }} </td>
                                                    		<td class="text-center">
                                                                <a href="{{ route('admin.edit.holiday',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_holiday" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}" data-state="nt"></i></a>
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


                    <!-- Footer -->
                        @include('admin.layouts.footer')
                    <!-- /footer -->

                </div>
            </div>
@endsection