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
<!--						<p>Integer congue elit noin semper laoreet sed lectus orcil posuer nisal tempor se felis acm Pelentesque inyd urna. Integer vitae felis magna po estibulm Nam rutrumc diam. Aliquam malesuada maurs.</p>-->
            <div id="success"></div>
            <form novalidate id="contactForm" method="post" class="reply-form form-inline" action="{{route('post.register.user')}}">
                <div class="row form-elem">	
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-user"></i>
                            <input type="text" name="first-name" id="first-name" placeholder="First Name" required="required">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-envelope"></i>
                            <input type="text" name="user-email" id="user-email" placeholder="Email Address" required="required">
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-user"></i>
                            <input type="text" name="user-lastname" id="user-lastname" required="required" placeholder="Last Name">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-phone"></i>
                            <input type="text" name="user-phone" id="user-phone" required="required" placeholder="Phone No.">
                        </div>
                    </div>
                </div>

                <div class="row form-elem">	
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-key"></i>
                            <input type="password" name="user-password" id="user-password" placeholder="password" required="required">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-key"></i>
                            <input type="password" name="user-confirm-password" id="user-confirm-password" placeholder="confirm password" required="required">
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="user-address1" id="user-address1" placeholder="Address Line 1" required="required">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="user-address2" id="user-address2" placeholder="Address Line 2">
                        </div>
                    </div>
                </div>

                <div class="row form-elem">	
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-building"></i>
                            <input type="text" name="user-city" id="user-city" placeholder="city" class="suburb" data-token="{{csrf_token()}}" required="required">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-building"></i>
                            <input type="text" name="user-state" id="user-state" placeholder="state" readonly required="required">
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-pin"></i>
                            <input type="text" name="user-postcode" readonly id="user-postcode" required="required" placeholder="Postal Code">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-flag"></i>
                            <select name="country" id="country" required="required">
                                <option>select country</option>
                                <option>India</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row form-elem">	
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-globe"></i>
                            <input type="text" name="user-website" id="user-website" placeholder="website" required="required">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-user-plus"></i>
                            <select name="type" id="type" required="required">
                                <option>what type of account</option>
                                <option>pay as you go</option>
                                <option>credit account</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">

                        <div class="default-inp form-elem">
                            <i class="fa fa-map-pin"></i>
                            <select name="user-how" id="user-how">
                                <option>Where You Found Out About Us</option>
                                <option>Facebook</option>
                                <option>Instagram</option>
                                <option>Google</option>
                                <option>Radio</option>
                                <option>TV</option>
                                <option>Magazine</option>
                            </select>

                        </div>


                    </div>
                </div>

                <div class="communication_email_div">
                    <div class="row form-elem">	
                        <div class="col-sm-6 form-elem">
                            <div class="default-inp form-elem">
                                <i class="fa fa-envelope"></i>
                                <input type="text" name="user-c-email" class="communication_email" id="user-c-email" placeholder="Communication Email" required="required">
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
                            <input type="text" name="company-name" id="company-name" placeholder="Company Name" required="required">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="company-address1" id="company-address1" required="required" placeholder="Address Line 1">
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-marker"></i>
                            <input type="text" name="company-address2" id="company-address2" placeholder="Address Line 2">
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-building"></i>
                            <input type="text" name="company-city" id="company-city" class="suburb-company" required="required" placeholder="city">
                        </div>
                    </div>
                </div>

                <div class="row form-elem">	
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-building"></i>
                            <input type="text" name="company-state" id="company-state" placeholder="state" readonly>
                        </div>
                        <div class="default-inp form-elem">
                            <i class="fa fa-map-pin"></i>
                            <input type="text" name="company-postcode" id="company-postcode" placeholder="Postal code" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6 form-elem">
                        <div class="default-inp form-elem">
                            <i class="fa fa-flag"></i>
                            <select name="c-country" id="c-country">
                                <option>select country</option>
                                <option>India</option>
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