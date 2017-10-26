@extends('layouts.user')

@section('content')
<div class="bg-image page-title">
    <div class="container-fluid">
        <a href="#"><h1>road transportation</h1></a>
        <div class="pull-right">
            <a href="01_home.html"><i class="fa fa-home fa-lg"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="06_services.html">Our services</a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="08_services-details.html">Road Transportation</a>
        </div>
    </div>
</div>
<div class="container-fluid block-content">
    <div class="row main-grid">

        <div class="col-sm-12 wow fadeInRight" data-wow-delay="0.3s">
            <h4>Register an Account</h4>
            <p>Personal Details</p>
<!--                        <p>Integer congue elit noin semper laoreet sed lectus orcil posuer nisal tempor se felis acm Pelentesque inyd urna. Integer vitae felis magna po estibulm Nam rutrumc diam. Aliquam malesuada maurs.</p>-->
<!-- novalidate -->
        @if ($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
            <div id="success"></div>
            <form novalidate id="contactForm" method="post" class="reply-form form-inline" action="{{route('post.register.user')}}">
                {{csrf_field()}}
                <input type="hidden" name="user_suburb_id" id="user-suburb-id">
                <div class="row form-elem"> 
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-user"></i>
                            <input type="text" name="user_firstname" id="first-name" placeholder="First Name" required="required" value="{{ old('user_firstname') }}">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-envelope"></i>
                            <input type="text" name="email" id="user-email" placeholder="Email Address" required="required" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-user"></i>
                            <input type="text" name="user_lastname" id="user-lastname" required="required" placeholder="Last Name" value="{{ old('user_lastname') }}">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-phone"></i>
                            <input type="text" name="user_phone" id="user-phone" required="required" placeholder="Phone No." value="{{ old('user_phone') }}">
                        </div>
                    </div>
                </div>

                <div class="row form-elem"> 
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-key"></i>
                            <input type="password" name="password" id="user-password" placeholder="password" required="required">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-key"></i>
                            <input type="password" name="password_confirmation" id="password-confirm" placeholder="confirm password" required="required">
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="user_address1" id="user-address1" placeholder="Address Line 1" required="required" value="{{ old('user_address1') }}">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="user_address2" id="user-address2" placeholder="Address Line 2" value="{{ old('user_address2') }}">
                        </div>
                    </div>
                </div>

                <div class="row form-elem"> 
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-building"></i>
                            <input type="text" name="user_city" id="user-city" placeholder="city" class="suburb" data-token="{{csrf_token()}}" required="required" value="{{ old('user_city') }}">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-building"></i>
                            <input type="text" name="user_state" id="user-state" placeholder="state" readonly required="required" value="{{ old('user_state') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-pin"></i>
                            <input type="text" name="user_postcode" readonly id="user-postcode" required="required" placeholder="Postal Code" value="{{ old('user_postcode') }}">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-flag"></i>
                            <select name="user_country" id="country" required="required">
                                <option value="">Select Country</option>
                                @forelse($country as $key => $value)
                                    <option value="{{$value->id}}">{{$value->country}}</option>
                                @empty
                                    <option>No Country</option>
                                @endforelse
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row form-elem"> 
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-globe"></i>
                            <input type="text" name="user_website" id="user-website" placeholder="website" required="required" value="{{ old('user_website') }}">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-user-plus"></i>
                            <select name="user_account_type" id="type" required="required">
                                <option value="">what type of account</option>
                                <option value="pay as you go">pay as you go</option>
                                <option value="credit account">credit account</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">

                        <div class="default-inp form-elem">
                            <i class="fa fa-map-pin"></i>
                            <select name="user_how_found" id="user-how">
                                <option value="">Where You Found Out About Us</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Google">Google</option>
                                <option value="Radio">Radio</option>
                                <option value="TV">TV</option>
                                <option value="">Magazine</option>
                            </select>

                        </div>


                    </div>
                </div>

                <div class="communication_email_div">
                    <div class="row form-elem"> 
                        <div class="col-sm-6 form-elem">
                            <div class="default-inp form-elem">
                                <i class="fa fa-envelope"></i>
                                <input type="text" name="user_c_email[]" class="communication_email" id="user-c-email" placeholder="Communication Email" required="required">
                            </div>

                        </div>
                        <div class="col-sm-1"><i class="fa fa-plus" style="padding-top: 20px;cursor: pointer;" id="addmore"></i></div>
                    </div>
                </div>
                <hr>
                <p>Company Details</p>

                <div class="row form-elem"> 
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-user"></i>
                            <input type="text" name="company_name" id="company-name" placeholder="Company Name" required="required" value="{{ old('company_name') }}">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="company_address1" id="company-address1" required="required" placeholder="Address Line 1" value="{{ old('company_address1') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="company_address2" id="company-address2" placeholder="Address Line 2" value="{{ old('company_address2') }}">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-building"></i>
                            <input type="text" name="company_city" id="company-city" class="suburb-company" required="required" placeholder="city" value="{{ old('company_city') }}">
                        </div>
                    </div>
                </div>

                <div class="row form-elem"> 
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-building"></i>
                            <input type="text" name="company_state" id="company-state" placeholder="state" readonly value="{{ old('company_state') }}">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-pin"></i>
                            <input type="text" name="company_postcode" id="company-postcode" placeholder="Postal code" readonly value="{{ old('company_postcode') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-flag"></i>
                            <select name="company_country" id="c-country">
                                <option value="">Select Country</option>
                                @forelse($country as $key => $value)
                                    <option value="{{$value->id}}">{{$value->country}}</option>
                                @empty
                                    <option>No Country</option>
                                @endforelse
                            </select>

                        </div>

                    </div>
                </div>



                <div class="form-elem">
                    <button type="submit" class="btn btn-success btn-default">send message</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection