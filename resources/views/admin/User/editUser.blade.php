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
                            <li><a href="{{ route('admin.user') }}"><i class="icon-blog position-left"></i> User Management</a></li>
                            <li class="active">Edit User</li>
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
                        Edit User
                        <small class="display-block">Edit User</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Edit User</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                     <form action="{{ route('admin.post.edit.user') }}" class="user_form" method="post">
                                                        {{ csrf_field()}}
                                                        <input type="hidden" name="suburb_id" id="suburb_id" value="{{ $user->suburb_id }}">
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                            <fieldset>
                                                                <legend class="text-semibold"><i class="icon-truck position-left"></i> User details</legend>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>First name:</label>
                                                                            <input type="text" name="firstname" placeholder="Enter First name" class="form-control" value="{{ $user->first_name }}" required="">
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
                                                                            <input type="text" name="lastname" placeholder="Enter Last name" class="form-control" value="{{ $user->last_name }}" required="">
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
                                                                            <input type="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}" required="" readonly="">
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
                                                                            <input type="text" name="phone" placeholder="Enter Phone" class="form-control" value="{{ $user->phone }}" required="">
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
                                                                            <input type="text" name="address1" placeholder="Enter Address line 1" class="form-control" value="{{ $user->address1 }}" required="">
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
                                                                            <input type="text" name="address2" placeholder="Enter Address line 2" class="form-control" value="{{ $user->address2 }}" required="">
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
                                                                            <input type="text" name="city" id="city" placeholder="Search City" class="form-control suburb" data-token="{{csrf_token()}}" required="required" value="{{ $user->city }}">
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
                                                                            <input type="text" name="state" class="form-control" id="state" placeholder="Enter State" readonly required="required" value="{{ $user->state }}">
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
                                                                            <input type="text" name="postcode" class="form-control" readonly id="postcode" required="required" placeholder="Enter Postal Code" value="{{ $user->postal_code }}">
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
                                                                                <option value="customer"@if($user->user_type == 'customer') selected @endif>Customer</option>
                                                                                <option value="crazycamel"@if($user->user_type == 'crazycamel') selected @endif>Crazycamel</option>
                                                                                <option value="guest"@if($user->user_type == 'guest') selected @endif>Guest</option>
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
                                                                                    <option value="{{$value->id}}"@if($user->country == $value->id) selected @endif>{{$value->country}}</option>
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
                                                                            <input type="text" name="website" placeholder="Enter Website" class="form-control" value="{{ $user->website }}" required="">
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
                                                                                <option value="Facebook"@if($user->user_found == 'Facebook') selected @endif>Facebook</option>
                                                                                <option value="Instagram"@if($user->user_found == 'Instagram') selected @endif>Instagram</option>
                                                                                <option value="Google"@if($user->user_found == 'Google') selected @endif>Google</option>
                                                                                <option value="Radio"@if($user->user_found == 'Radio') selected @endif>Radio</option>
                                                                                <option value="TV"@if($user->user_found == 'TV') selected @endif>TV</option>
                                                                                <option value="Magazine"@if($user->user_found == 'Magazine') selected @endif>Magazine</option>
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
                                                                                <option value="pay as you go"@if($user->account_type == 'pay as you go') selected @endif>pay as you go</option>
                                                                                <option value="credit account"@if($user->account_type == 'credit account') selected @endif>credit account</option>
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
                                                                                <input type="radio" class="styled_radio" name="sender_type" checked="checked" required="" value="business"@if($user->sender_type == 'business account') checked @endif>
                                                                                Business
                                                                            </label>

                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="sender_type" value="residential"@if($user->sender_type == 'residential') checked @endif>
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
                                                                                <input type="radio" class="styled_radio" name="receiver_type" checked="checked" required="" value="business"@if($user->receiver_type == 'business') checked @endif>
                                                                                Business
                                                                            </label>

                                                                            <label class="radio-inline">
                                                                                <input type="radio" class="styled_radio" name="receiver_type" value="residential"@if($user->receiver_type == 'residential') checked @endif>
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
                                                                @forelse($user->communication_user_email as $key => $value)
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>@if($key == 0) Communication Email: @endif</label>
                                                                                <input type="text" name="c_email[]" placeholder="Enter Communication Email" class="form-control communication_email" @if($key == 0) required="" @endif value="{{$value->email}}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label> </label>
                                                                                @if($key == 0)
                                                                                <a href="javascript:void(0)" class="add_a text-success-600"><i class="icon-plus-circle2 addmore"></i></a>
                                                                                @else
                                                                                <a href="javascript:void(0)" class="remove_a text-danger-600"><i class="icon-minus-circle2 c_email_remove" data-id="{{$value->id}}" data-userid="{{$user->id}}" data-url="{{route('admin.user_c_email.delete')}}" data-token="{{ csrf_token() }}"></i></a>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                @empty
                                                                @endforelse
                                                                </div>

                                                                <legend class="text-semibold"><i class="icon-truck position-left"></i> Company details</legend>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Company name:</label>
                                                                            <input type="text" name="company_name" placeholder="Enter Company Name" class="form-control" value="{{ $user->company_address->company_name }}" required="">
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
                                                                                    <option value="{{$value->id}}"@if($user->company_address->country == $value->id) selected @endif>{{$value->country}}</option>
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
                                                                            <input type="text" name="company_address1" placeholder="Enter Company Address line 1" class="form-control" required="" value="{{$user->company_address->address1}}">
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
                                                                            <input type="text" name="company_address2" placeholder="Enter Company Address line 2" class="form-control" value="{{ $user->company_address->address2 }}" required="">
                                                                            @if ($errors->has('company_address2'))
                                                                                <label id="company_address2-error" class="validation-error-label" for="company_address2">
                                                                                        {{ $errors->first('company_address2') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="company_suburb_id" id="company_suburb_id" value="{{ $user->company_address->suburb_id }}">

                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>City:</label>
                                                                            <input type="text" name="company_city" id="company_city" placeholder="Search Company City" class="form-control company_suburb" data-token="{{csrf_token()}}" required="required" value="{{ $user->company_address->city }}">
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
                                                                            <input type="text" name="company_state" class="form-control" id="company_state" placeholder="Enter Company State" readonly required="required" value="{{ $user->company_address->state }}">
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
                                                                            <input type="text" name="company_postcode" class="form-control" readonly id="company_postcode" required="required" placeholder="Enter Company Postal Code" value="{{ $user->company_address->postal_code }}">
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

                                                                            <a href="{{route('admin.user')}}" class="btn border-slate text-slate-800 btn-flat" id="reset"><i class="icon-arrow-left13 position-left"></i> Back</a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>
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