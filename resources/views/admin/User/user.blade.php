@extends('admin/layouts.app')
@push('css')
    <!-- <link href="{{ asset('/backend/assets/css/extras/animate.min.css') }}" rel="stylesheet"> -->
    
    <style type="text/css">
        .user_datatable span{
            cursor: pointer;
        }
        .form-control[readonly] {
            cursor: not-allowed;
        }
        .add_a{
            display: block;
            padding: 8px 16px;
        }
        .remove_a{
            display: block;
            padding: 8px 16px;
        }
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
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User Management</span></h4>
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
                            <li class="active">User Management</li>
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

                    @if ($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif


                    <h6 class="content-group text-semibold">
                        User Management
                        <small class="display-block">Add and display all User</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">User</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="tabbable tab-content-bordered">
                                        <ul class="nav nav-tabs nav-tabs-highlight">
                                            <li class="active"><a href="#css-animate-tab1" data-toggle="tab">Add New User <span class="label label-success">New</span></a></li>
                                            <li><a href="#css-animate-tab2" data-toggle="tab">View All User <span class="badge bg-slate position-right cat_count">{{ count($users) }}</span></a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane animated bounceIn has-padding active" id="css-animate-tab1">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form action="{{ route('admin.post.user') }}" class="user_form" method="post">
                                                        {{ csrf_field()}}
                                                        <input type="hidden" name="suburb_id" id="suburb_id" value="{{ old('suburb_id') }}">
                                                            <fieldset>
                                                                <legend class="text-semibold"><i class="icon-truck position-left"></i> User details</legend>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>First name:</label>
                                                                            <input type="text" name="firstname" placeholder="Enter First name" class="form-control" value="{{ old('firstname') }}" required="">
                                                                            @if ($errors->has('firstname'))
                                                                                <label id="firstname-error" class="validation-error-label" for="firstname">
                                                                                        {{ $errors->first('firstname') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Last name:</label>
                                                                            <input type="text" name="lastname" placeholder="Enter Last name" class="form-control" value="{{ old('lastname') }}" required="">
                                                                            @if ($errors->has('lastname'))
                                                                                <label id="lastname-error" class="validation-error-label" for="lastname">
                                                                                        {{ $errors->first('lastname') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Email:</label>
                                                                            <input type="email" name="email" placeholder="Enter Email" class="form-control" value="{{ old('email') }}" required="">
                                                                            @if ($errors->has('email'))
                                                                                <label id="email-error" class="validation-error-label" for="email">
                                                                                        {{ $errors->first('email') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Phone #:</label>
                                                                            <input type="text" name="phone" placeholder="Enter Phone" class="form-control" value="{{ old('phone') }}" required="">
                                                                            @if ($errors->has('phone'))
                                                                                <label id="phone-error" class="validation-error-label" for="phone">
                                                                                        {{ $errors->first('phone') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Address line 1:</label>
                                                                            <input type="text" name="address1" placeholder="Enter Address line 1" class="form-control" value="{{ old('address1') }}" required="">
                                                                            @if ($errors->has('address1'))
                                                                                <label id="address1-error" class="validation-error-label" for="address1">
                                                                                        {{ $errors->first('address1') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Address line 2:</label>
                                                                            <input type="text" name="address2" placeholder="Enter Address line 2" class="form-control" value="{{ old('address2') }}" required="">
                                                                            @if ($errors->has('address2'))
                                                                                <label id="address2-error" class="validation-error-label" for="address2">
                                                                                        {{ $errors->first('address2') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>City:</label>
                                                                            <input type="text" name="city" id="city" placeholder="Search City" class="form-control suburb" data-token="{{csrf_token()}}" required="required" value="{{ old('city') }}">
                                                                            @if ($errors->has('city'))
                                                                                <label id="city-error" class="validation-error-label" for="city">
                                                                                        {{ $errors->first('city') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>State/Province:</label>
                                                                            <input type="text" name="state" class="form-control" id="state" placeholder="Enter State" readonly required="required" value="{{ old('state') }}">
                                                                            @if ($errors->has('state'))
                                                                                <label id="state-error" class="validation-error-label" for="state">
                                                                                        {{ $errors->first('state') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>ZIP code:</label>
                                                                            <input type="text" name="postcode" class="form-control" readonly id="postcode" required="required" placeholder="Enter Postal Code" value="{{ old('postcode') }}">
                                                                            @if ($errors->has('postcode'))
                                                                                <label id="postcode-error" class="validation-error-label" for="postcode">
                                                                                        {{ $errors->first('postcode') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>User Type:</label>
                                                                            <select name="user_type" data-placeholder="User Type" class="select" required="">
                                                                                <option></option>
                                                                                <option value="customer">Customer</option>
                                                                                <option value="crazycamel">Crazycamel</option>
                                                                                <option value="guest">Guest</option>
                                                                            </select>
                                                                            @if ($errors->has('user_type'))
                                                                                <label id="user_type-error" class="validation-error-label" for="user_type">
                                                                                        {{ $errors->first('user_type') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Country:</label>
                                                                            <select name="country" data-placeholder="Select your country" class="select" required="">
                                                                                <option></option>
                                                                                @forelse($country as $key => $value)
                                                                                    <option value="{{$value->id}}">{{$value->country}}</option>
                                                                                @empty
                                                                                    <option>No Country</option>
                                                                                @endforelse
                                                                            </select>
                                                                            @if ($errors->has('country'))
                                                                                <label id="country-error" class="validation-error-label" for="country">
                                                                                        {{ $errors->first('country') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Website:</label>
                                                                            <input type="text" name="website" placeholder="Enter Website" class="form-control" value="{{ old('website') }}" required="">
                                                                            @if ($errors->has('website'))
                                                                                <label id="website-error" class="validation-error-label" for="website">
                                                                                        {{ $errors->first('website') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Where You Found Out About Us:</label>
                                                                            <select name="how_found" data-placeholder="Where You Found Out About Us" class="select" required="">
                                                                                <option></option>
                                                                                <option value="Facebook">Facebook</option>
                                                                                <option value="Instagram">Instagram</option>
                                                                                <option value="Google">Google</option>
                                                                                <option value="Radio">Radio</option>
                                                                                <option value="TV">TV</option>
                                                                                <option value="">Magazine</option>
                                                                            </select>
                                                                            @if ($errors->has('how_found'))
                                                                                <label id="how_found-error" class="validation-error-label" for="how_found">
                                                                                        {{ $errors->first('how_found') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>What type of account:</label>
                                                                            <select name="account_type" data-placeholder="What type of account" class="select" required="">
                                                                                <option></option>
                                                                                <option value="pay as you go">pay as you go</option>
                                                                                <option value="credit account">credit account</option>
                                                                            </select>
                                                                            @if ($errors->has('account_type'))
                                                                                <label id="account_type-error" class="validation-error-label" for="account_type">
                                                                                        {{ $errors->first('account_type') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                        <label>Sender Type:</label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="sender_type" checked="checked" required="" value="business">
                                                                                Business
                                                                            </label>

                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="sender_type" value="residential">
                                                                                Residential
                                                                            </label>
                                                                            @if ($errors->has('sender_type'))
                                                                                <label id="sender_type-error" class="validation-error-label" for="sender_type">
                                                                                        {{ $errors->first('sender_type') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                        <label>Receiver Type:</label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="receiver_type" checked="checked" required="" value="business">
                                                                                Business
                                                                            </label>

                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="receiver_type" value="residential">
                                                                                Residential
                                                                            </label>
                                                                            @if ($errors->has('receiver_type'))
                                                                                <label id="receiver_type-error" class="validation-error-label" for="receiver_type">
                                                                                        {{ $errors->first('receiver_type') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="communication_email_div">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Communication Email:</label>
                                                                                <input type="text" name="c_email[]" placeholder="Enter Communication Email" class="form-control communication_email"  required="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label> </label>
                                                                                <a href="javascript:void(0)" class="add_a"><i class="icon-plus-circle2 addmore"></i></a>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <legend class="text-semibold"><i class="icon-truck position-left"></i> Company details</legend>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Company name:</label>
                                                                            <input type="text" name="company_name" placeholder="Enter Company Name" class="form-control" value="{{ old('company_name') }}" required="">
                                                                            @if ($errors->has('company_name'))
                                                                                <label id="company_name-error" class="validation-error-label" for="company_name">
                                                                                        {{ $errors->first('company_name') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Country:</label>
                                                                            <select name="company_country" data-placeholder="Select your country" class="select" required="">
                                                                                <option></option>
                                                                                @forelse($country as $key => $value)
                                                                                    <option value="{{$value->id}}">{{$value->country}}</option>
                                                                                @empty
                                                                                    <option>No Country</option>
                                                                                @endforelse
                                                                            </select>
                                                                            @if ($errors->has('company_country'))
                                                                                <label id="company_country-error" class="validation-error-label" for="company_country">
                                                                                        {{ $errors->first('company_country') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Address line 1:</label>
                                                                            <input type="text" name="company_address1" placeholder="Enter Company Address line 1" class="form-control" value="{{ old('company_address1') }}" required="">
                                                                            @if ($errors->has('company_address1'))
                                                                                <label id="company_address1-error" class="validation-error-label" for="company_address1">
                                                                                        {{ $errors->first('company_address1') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Address line 2:</label>
                                                                            <input type="text" name="company_address2" placeholder="Enter Company Address line 2" class="form-control" value="{{ old('company_address2') }}" required="">
                                                                            @if ($errors->has('company_address2'))
                                                                                <label id="company_address2-error" class="validation-error-label" for="company_address2">
                                                                                        {{ $errors->first('company_address2') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="company_suburb_id" id="company_suburb_id" value="{{ old('company_suburb_id') }}">

                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>City:</label>
                                                                            <input type="text" name="company_city" id="company_city" placeholder="Search Company City" class="form-control company_suburb" data-token="{{csrf_token()}}" required="required" value="{{ old('company_city') }}">
                                                                            @if ($errors->has('company_city'))
                                                                                <label id="company_city-error" class="validation-error-label" for="company_city">
                                                                                        {{ $errors->first('company_city') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>State/Province:</label>
                                                                            <input type="text" name="company_state" class="form-control" id="company_state" placeholder="Enter Company State" readonly required="required" value="{{ old('company_state') }}">
                                                                            @if ($errors->has('company_state'))
                                                                                <label id="company_state-error" class="validation-error-label" for="company_state">
                                                                                        {{ $errors->first('company_state') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>ZIP code:</label>
                                                                            <input type="text" name="company_postcode" class="form-control" readonly id="company_postcode" required="required" placeholder="Enter Company Postal Code" value="{{ old('company_postcode') }}">
                                                                            @if ($errors->has('company_postcode'))
                                                                                <label id="company_postcode-error" class="validation-error-label" for="company_postcode">
                                                                                        {{ $errors->first('company_postcode') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                        <label>Set as default:</label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="set_default" checked="checked" required="" value="0">
                                                                                Sender
                                                                            </label>

                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="set_default" value="1">
                                                                                Receiver
                                                                            </label>
                                                                            @if ($errors->has('status'))
                                                                                <label id="status-error" class="validation-error-label" for="status">
                                                                                        {{ $errors->first('status') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="text-left">
                                                                            <button type="submit" class="btn border-slate text-slate-800 btn-flat">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                                                            <button type="reset" class="btn border-slate text-slate-800 btn-flat" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab2">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table user_datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Full Name</th>
                                                                    <th>Company Name</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th>Website</th>
                                                                    <th>Address</th>
                                                                    <th>Account Number</th>
                                                                    <th>Paypal</th>
                                                                    <th>Online</th>
                                                                    <th>Portal</th>
                                                                    <th>Status</th>
                                                                    <th>Date</th>
                                                                    <th class="text-center">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($users as $key => $value)
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>{{$value->first_name}} {{$value->last_name}}</td>
                                                                        <td>
                                                                            @if(!empty($value->company_address->toArray()))
                                                                                {{$value->company_address->company_name}}
                                                                            @else
                                                                                --
                                                                            @endif
                                                                        </td>
                                                                        <td>{{$value->email}}</td>
                                                                        <td>{{$value->phone}}</td>
                                                                        <td>{{$value->website}}</td>
                                                                        <td>{{$value->address1}} {{$value->address2}}</td>
                                                                        <td>{{$value->account_number}}</td>
                                                                        <td>{{$value->account_type}}</td>
                                                                        <td>0</td>
                                                                        <td class="text-center">
                                                                            <a href="{{ route('admin.user.member.portal',['id' => $value->id]) }}" class="label label-flat border-primary text-primary-600">Member</a> |

                                                                            <a href="{{ route('admin.user.pricing.portal',['id' => $value->id]) }}" class="label label-flat border-primary text-primary-600">Pricing</a>
                                                                        </td>
                                                                        <td>
                                                                            @if($value->status == 0)
                                                                                <span class="label label-danger user_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.status') }}" title="Click to Active">Deactive</span>
                                                                            @else
                                                                                <span class="label label-success user_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.status') }}" title="Click to Deactive">Active</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                                                                        <td class="text-center">
                                                                            <a href="{{ route('admin.edit.user',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                            <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_user" data-id="{{ $value->id }}" data-token="{{ csrf_token() }}" data-url="{{ route('admin.user.delete') }}"></i></a>
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