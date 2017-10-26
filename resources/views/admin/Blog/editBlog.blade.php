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

            // Modal template
            var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
                '  <div class="modal-content">\n' +
                '    <div class="modal-header">\n' +
                '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
                '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
                '    </div>\n' +
                '    <div class="modal-body">\n' +
                '      <div class="floating-buttons btn-group"></div>\n' +
                '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
                '    </div>\n' +
                '  </div>\n' +
                '</div>\n';
                // Buttons inside zoom modal
            var previewZoomButtonClasses = {
                toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
                fullscreen: 'btn btn-default btn-icon btn-xs',
                borderless: 'btn btn-default btn-icon btn-xs',
                close: 'btn btn-default btn-icon btn-xs'
            };

            // Icons inside zoom modal classes
            var previewZoomButtonIcons = {
                prev: '<i class="icon-arrow-left32"></i>',
                next: '<i class="icon-arrow-right32"></i>',
                toggleheader: '<i class="icon-menu-open"></i>',
                fullscreen: '<i class="icon-screen-full"></i>',
                borderless: '<i class="icon-alignment-unalign"></i>',
                close: '<i class="icon-cross3"></i>'
            };

            // File actions
            var fileActionSettings = {
                zoomClass: 'btn btn-link btn-xs btn-icon',
                zoomIcon: '<i class="icon-zoomin3"></i>',
                dragClass: 'btn btn-link btn-xs btn-icon',
                dragIcon: '<i class="icon-three-bars"></i>',
                removeClass: 'btn btn-link btn-icon btn-xs',
                removeIcon: '<i class="icon-trash"></i>',
                indicatorNew: '<i class="icon-file-plus text-slate"></i>',
                indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                indicatorError: '<i class="icon-cross2 text-danger"></i>',
                indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
            };


            var img_path = '/backend/assets/images/blog_images/'+'<?php echo $blog->image;?>';
            $(".edit_blog_img").fileinput({
                browseLabel: 'Browse',
                browseIcon: '<i class="icon-file-plus"></i>',
                uploadIcon: '<i class="icon-file-upload2"></i>',
                removeIcon: '<i class="icon-cross3"></i>',
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                    modal: modalTemplate
                },
                initialPreview: [
                    img_path
                ],
                initialPreviewConfig: [
                    {caption: "<?php echo $blog->image;?>", size: 930321, key: 1, showDrag: false},
                ],
                initialPreviewAsData: true,
                overwriteInitial: true,
                previewZoomButtonClasses: previewZoomButtonClasses,
                previewZoomButtonIcons: previewZoomButtonIcons,
                fileActionSettings: fileActionSettings
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
                            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Edit Blog</span></h4>
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
                            <li><a href="{{ route('admin.blog') }}"><i class="icon-home2 position-left"></i> Blog Management</a></li>
                            <li class="active">Edit Blog</li>
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
                        Edit Blog
                        <small class="display-block">Edit Blog</small>
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Edit Blogs</h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <form action="{{ route('admin.post.edit_blog') }}" class="form-horizontal blog_form" method="post" enctype="multipart/form-data">
                                        {{ csrf_field()}}
                                        <input type="hidden" name="id" value="{{$blog->id}}">
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Blog Form</h5>
                                            </div>

                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Title:</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="title" class="form-control" placeholder="Enter Blog Title" required="" value="{{$blog->title}}">
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
                                                                <option value="{{$value->id}}"@if($blog->categories_id == $value->id) selected @endif>{{$value->name}}</option>
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
                                                        <textarea name="description" id="description" rows="4" cols="4" required="">{{$blog->description}}</textarea>
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
                                                            <input type="file" name="blog_image" class="edit_blog_img" data-show-caption="false" data-show-upload="false" data-browse-class="btn btn-primary btn-xs" data-remove-class="btn btn-default btn-xs">
                                                            <span class="help-block">Accepted formats: png, jpg, jpeg.<br> Max file size 5Mb</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Status:</label>
                                                    <div class="col-lg-9">
                                                        <label class="radio-inline">
                                                            <input type="radio" class="styled_radio" name="status" required="" value="1"@if($blog->status == '1') checked @endif>
                                                            Active
                                                        </label>

                                                        <label class="radio-inline">
                                                            <input type="radio" class="styled_radio" name="status" value="0"@if($blog->status == '0') checked @endif>
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
                                                    <a href="{{ route('admin.blog') }}" class="btn border-slate text-slate-800 btn-flat" id="reset"><i class="icon-arrow-left13 position-left"></i> Back</a>
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