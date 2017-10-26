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
            $(".user_package_management").addClass('active');

            $(document.body).on('change','.chk_pkg',function(){
                var me = $(this); 
                var status = me.val();
                var user_id = me.data('userid');
                var package_id = me.data('pkgid');
                var url = me.data('url');
                var token = me.data('token');

                $.ajax({
                  url: url,
                  type: 'post',
                  data: {
                    "user_id":user_id,
                    "package_id":package_id,
                    "status":status,
                    "_token": token,
                  },
                  dataType:'json',
                  success:function(data){
                    var package_status = data.package_status;
                    if(data.status === 'success'){
                        me.val(package_status);
                      // if(package_status == 'active'){
                      //   me.val();
                      // }else if(package_status == 'deactive'){

                      // }
                    }else{
                      alert('some error')
                    }
                  }

                });

            });

        });
    </script>
@endpush

@section('content')
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User Package Management</span></h4>
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
                            <li><a href="{{ route('admin.api') }}"><i class="icon-blog position-left"></i> User Package Management</a></li>
                            <li class="active">User Package </li>
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
                        User Package
                        <small class="display-block">User Package</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">User Package</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <table class="table user_package_datatable">
                                        <thead>
                                            <tr class="heading_tr">
                                                <th></th>
                                                <th align="center">Customer Name</th>
                                                @forelse($packages as $key => $value)
                                                    <th>{{ $value->package_type }}</th>
                                                @empty
                                                @endforelse
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($users as $u_key => $u_value)
                                            <?php
                                                $user_id = $u_value->id;
                                            ?>
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $u_value->email }}</td>
                                                    @forelse($packages as $key => $value)
                                                    <?php
                                                        $p_id = $value->id;
                                                        $status = $controller->findUpackage($user_id, $p_id); 
                                                                                                            ?>
                                                    <td>
                                                        @if($status == '1')
                                                            <input data-userid="<?php echo $user_id ?>" data-pkgid="<?php echo $p_id ?>" type="checkbox" name="chk_pkg" value="active" class="styled_color_checkbox chk_pkg" data-url="{{ route('admin.ajax.active.deactive.userpackage')}}" data-token="{{ csrf_token() }}" checked>
                                                        
                                                        @else
                                                            <input data-userid="<?php echo $user_id ?>" data-pkgid="<?php echo $p_id ?>" type="checkbox" name="chk_pkg" value="deactive" class="styled_color_checkbox chk_pkg" data-url="{{ route('admin.ajax.active.deactive.userpackage')}}" data-token="{{ csrf_token() }}" >
                                                        @endif
                                                    </td>
                                                    @empty
                                                    @endforelse
                                                </tr>
                                            @empty
                                            @endforelse                               
                                        </tbody>
                                    </table>
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