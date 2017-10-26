@extends('admin/layouts.app')
@push('css')
    <link href="{{ asset('/backend/assets/css/extras/animate.min.css') }}" rel="stylesheet">
    <style type="text/css">
        .category_datatable span{
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".manage_blog").addClass('active');
            $(".blog_categories_management").addClass('active');

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
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Blog Category Management</span></h4>
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
                            <li class="active">Blog Category Management</li>
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
                        Blog Category Management
                        <small class="display-block">Add and display all blog category</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Blog Category</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="tabbable tab-content-bordered">
                                        <ul class="nav nav-tabs nav-tabs-highlight">
                                            <li class="active"><a href="#css-animate-tab1" data-toggle="tab">Add New Category <span class="label label-success">New</span></a></li>
                                            <li><a href="#css-animate-tab2" data-toggle="tab">View Category <span class="badge bg-slate position-right cat_count">{{ count($blog_category) }}</span></a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane animated bounceIn has-padding active" id="css-animate-tab1">
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <form action="{{ route('admin.post.blog_category') }}" class="form-horizontal blog_categories_form" method="post">
                                                        {{ csrf_field()}}
                                                            <div class="panel panel-flat">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">Category Form</h5>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Category Name:</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name" required="">
                                                                            @if ($errors->has('category_name'))
                                                                                <label id="category_name-error" class="validation-error-label" for="category_name">
                                                                                        {{ $errors->first('category_name') }}
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

                                            <div class="tab-pane animated bounceIn has-padding" id="css-animate-tab2">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table category_datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Name</th>
                                                                    <th>Status</th>
                                                                    <th>Date</th>
                                                                    <th class="text-center">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($blog_category as $key => $value)
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>{{ $value->name }}</td>
                                                                        <td>
                                                                            @if($value->status == 0)
                                                                                <span class="label label-danger blog_category_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}"  title="Click to Active">Deactive</span>
                                                                            @else
                                                                                <span class="label label-success blog_category_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                                                                        <td class="text-center">
                                                                            <a href="{{ route('admin.edit.blog_category',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                            <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_blog_category" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}"></i></a>
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