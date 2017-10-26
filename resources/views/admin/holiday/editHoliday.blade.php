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
                            <li><a href="{{ route('admin.holiday') }}"><i class="icon-blog position-left"></i> Blog Holiday Management</a></li>
                            <li class="active">Edit Holiday</li>
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
                        <small class="display-block">Edit Holiday</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Edit Holiday</h6>
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
                                                                    <h5 class="panel-title">Edit Holiday Form</h5>
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
																			<input type="text" name="holiday_date" class="form-control holiday_date" placeholder="Select a Date" required="" value="{{ date('d F Y', strtotime($holiday->holiday_date)) }}">
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