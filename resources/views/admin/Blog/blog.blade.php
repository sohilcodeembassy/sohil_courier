@extends('admin/layouts.app')
@push('css')
    <style type="text/css">
        .blog_datatable span{
            cursor: pointer;
        }
        .animated {
            -webkit-animation-fill-mode: none;
            animation-fill-mode: none;
        }
        /*.kv-file-remove{
            display: none;
        }
        .text-slate{
            display: none;  
        }*/
        .img-wrap {
            position: relative;
            display: inline-block;
            /*border: 1px red solid;*/
            font-size: 0;
        }
        .img-wrap .close {
            position: absolute;
            top: 2px;
            right: 2px;
            z-index: 100;
            /*background-color: #FFF;*/
            padding: 5px 2px 2px;
            color: #000;
            font-weight: bold;
            cursor: pointer;
            /*opacity: .2;*/
            text-align: center;
            font-size: 22px;
            line-height: 10px;
            border-radius: 50%;
        }
        /*.img-wrap:hover .close {
            opacity: 1;
        }*/
    </style>
@endpush

@push('js')
    <script src="{{ asset('/backend/assets/js/jquery.validate.file.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/plugins/uploaders/fileinput.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".manage_blog").addClass('active');
            $(".blog_management").addClass('active');

            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            });

            CKEDITOR.replace('description', {
                height: '300px',
                extraPlugins: 'forms'
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
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Blog Management</span></h4>
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
                            <li class="active">Blog Management</li>
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
                        Blog Management
                        <small class="display-block">Add and display all Blog</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Blogs</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="tabbable tab-content-bordered">
                                        <ul class="nav nav-tabs nav-tabs-highlight">
                                            <li class="active"><a href="#css-animate-tab1" data-toggle="tab">Add New Blog <span class="label label-success">New</span></a></li>
                                            <li><a href="#css-animate-tab2" data-toggle="tab">View Blogs <span class="badge bg-slate position-right cat_count">{{ count($blogs) }}</span></a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane animated bounceIn has-padding active" id="css-animate-tab1">
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <form action="{{ route('admin.post.blog') }}" class="form-horizontal blog_form" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field()}}
                                                            <div class="panel panel-flat">
                                                                <div class="panel-heading">
                                                                    <h5 class="panel-title">Blog Form</h5>
                                                                </div>

                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Title:</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" name="title" class="form-control" placeholder="Enter Blog Title" required="">
                                                                            @if ($errors->has('title'))
                                                                                <label id="title-error" class="validation-error-label" for="title">
                                                                                        {{ $errors->first('title') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Blog Category:</label>
                                                                        <div class="col-lg-9">
                                                                            <select data-placeholder="Select a Category..." class="blog_cat_select" name="blog_category" required="">
                                                                                <option></option>
                                                                                @forelse($blog_category as $key => $value)
                                                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                                                @empty
                                                                                @endforelse
                                                                            </select>
                                                                            @if ($errors->has('description'))
                                                                                <label id="description-error" class="validation-error-label" for="description">
                                                                                        {{ $errors->first('description') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Description:</label>
                                                                        <div class="col-lg-9">
                                                                            <textarea name="description" id="description" rows="4" cols="4" required=""></textarea>
                                                                            @if ($errors->has('description'))
                                                                                <label id="description-error" class="validation-error-label" for="description">
                                                                                        {{ $errors->first('description') }}
                                                                                </label>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-lg-3 control-label">Image:</label>
                                                                        <div class="col-lg-9">
                                                                            <div class="input-group">
                                                                            <input type="file" name="blog_image" class="blog_image" data-show-caption="false" data-show-upload="false" data-browse-class="btn btn-primary btn-xs" data-remove-class="btn btn-default btn-xs" required="">
                                                                            <span class="help-block">Accepted formats: png, jpg, jpeg.<br> Max file size 5Mb</span>

                                                                            @if ($errors->has('blog_image'))
                                                                                <label id="blog_image-error" class="validation-error-label" for="blog_image">
                                                                                        {{ $errors->first('blog_image') }}
                                                                                </label>
                                                                            @endif
                                                                            </div>
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
                                                        <table class="table blog_datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Title</th>
                                                                    <th>Category</th>
                                                                    <th>Image</th>
                                                                    <th>Status</th>
                                                                    <th>Date</th>
                                                                    <th class="text-center">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($blogs as $key => $value)
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>{{$value->title}}</td>
                                                                        <td>{{$value->blog_category->name}}</td>
                                                                        <td>
                                                                            <div class="img-wrap">
                                                                                <a href="{{ route('admin.blog.download.img',['img_name' => $value->image]) }}" class="close"><i class="icon-file-download2"></i></a>

                                                                                <img src="/backend/assets/images/blog_images/thumbnail/{{$value->image}}">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            @if($value->status == 0)
                                                                                <span class="label label-danger blog_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}"  title="Click to Active">Deactive</span>
                                                                            @else
                                                                                <span class="label label-success blog_status" data-id="{{ $value->id}}" data-token="{{ csrf_token() }}" title="Click to Deactive">Active</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                                                                        <td class="text-center">
                                                                            <a href="{{ route('admin.edit.blog',['id' => $value->id]) }}" data-popup="tooltip" title="" data-original-title="Edit" aria-describedby="tooltip560649"><i class="icon-pencil7"></i></a> |

                                                                            <a href="javascript:void(0)" class="text-danger-600" data-popup="tooltip" title="" data-original-title="Remove"><i class="icon-trash delete_blog" data-id="{{ $value->id }}"  data-token="{{ csrf_token() }}"></i></a>
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