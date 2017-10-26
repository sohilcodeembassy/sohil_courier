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
                            <li><a href="{{ route('admin.api') }}"><i class="icon-blog position-left"></i> User Management</a></li>
                            <li class="active">User Member Portal </li>
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
                        User Member Portal
                        <small class="display-block">User Member Portal</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">User Member Portal</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form action="{{ route('admin.post.member.portal') }}" class="form-horizontal user_member_portal_form" method="post">
                                    {{ csrf_field()}}
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <div class="panel panel-flat">
                                            <div class="panel-body">

                                                <!-- <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="grant_this_customer" class="styled_checkbox">
                                                            Grant this customer access to the Members Web Portal
                                                        </label>
                                                    </div>
                                                </div> -->

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"><b>Web Portal Credentials:</b></label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Email:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="email" class="form-control" required="" value="{{$user->email}}" readonly="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Password:</label>
                                                    <div class="col-lg-9">
                                                        <input type="password" name="password" class="form-control" placeholder=".......................">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Time Zone:</label>
                                                    <div class="col-lg-9">
                                                        <select data-placeholder="Select a Timezone..." class="select" name="timezone" required="">
                                                        <option></option>
                                                        @forelse($timezone as $key => $value)
                                                            <option value="{{$value->time_zone}}">{{$value->time_zone}}</option>
                                                        @empty
                                                        @endforelse                    
                                                        </select>
                                                        <a href="">Use the time zone of this computer</a>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group">
                                                    <label class="col-lg-3 control-label"> </label>
                                                    <div class="col-lg-9">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="allow_all_order" class="styled_checkbox">
                                                            Allow contacts to access all orders entered under this customer.
                                                        </label>
                                                    </div>
                                                </div> -->

                                                <hr>

                                                <div class="form-group">
                                                    <label class="col-lg-6 control-label"><a href="#" class="label label-flat border-success  text-success -600">Log in to the  web portal as this customer</a></label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-6 control-label">Send customer a link to the Customer Web Portal via email...</label>
                                                </div>

                                                <div class="text-left">
                                                    <button type="submit" class="btn border-slate text-slate-800 btn-flat">Send Member portal <i class="icon-arrow-right14 position-right"></i></button>
                                                    <a href="{{ route('admin.user') }}" class="btn border-slate text-slate-800 btn-flat" id="reset"><i class="icon-arrow-left13 position-left"></i> Back</a>
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