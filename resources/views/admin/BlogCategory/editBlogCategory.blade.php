@extends('admin/layouts.app')

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".manage_blog").addClass('active');
            $(".blog_categories_management").addClass('active');
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
                            <li><a href="{{ route('admin.blog_category') }}"><i class="icon-blog position-left"></i> Blog Category Management</a></li>
                            <li class="active">Edit Blog Category</li>
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
                        Edit Blog Category
                        <small class="display-block">Edit Blog Category</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Edit Blog Category</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form action="{{ route('admin.post.edit_blog_category') }}" class="form-horizontal blog_categories_form" method="post">
                                    {{ csrf_field()}}
                                    <input type="hidden" name="id" value="{{$blog_category->id}}">
                                        <div class="panel panel-flat">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Category Name:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name" required="" value="{{$blog_category->name}}">
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
                                                            <input type="radio" class="styled_radio" name="status" required="" value="1"@if($blog_category->status == '1') checked @endif>
                                                            Active
                                                        </label>

                                                        <label class="radio-inline">
                                                            <input type="radio" class="styled_radio" name="status" value="0" @if($blog_category->status == '0') checked @endif>
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
                                                    <a href="{{ route('admin.blog_category') }}" class="btn border-slate text-slate-800 btn-flat" id="reset"><i class="icon-arrow-left13 position-left"></i> Back</a>
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