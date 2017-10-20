@extends('admin.master')
@section('main_content')
        <!-- CK Editor -->
<style>
    #edit-content {
        display: none;
        padding : 5px;
    }
</style>
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/admin-panel/js/select2/dist/css/select2.min.css') }}">
<!-- Select2 -->
<script src="{{ asset('public/admin-panel/js/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/admin-panel/js/ckeditor/ckeditor.js') }}"></script>
<form action="{{ URL::to("/admin/update_post/$all_post->post_id") }}" method="post" class="form-group">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="row">
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header">
                    <a href="{{ URL::to('/admin/new-post') }}" class="btn btn-flat btn-primary pull-right">Add new</a>
                    <h3 class="box-title ">
                        Edit Post
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <div class="form-group">
                        <input autocomplete="off" name="post_title" autofocus type="text" class="form-control input-lg" id="post_title" placeholder="Enter title here" value="@if(isset($all_post->post_title)){{ $all_post->post_title }}@endif">
                        <span class="help-block">
                            <b>Permalink:</b> {{ Request::root() }}/<input disabled style="width: 300px;" value="@if(isset($all_post->slug)){{ $all_post->slug }}@endif" type="text" name="slug" id="slug" class="input-xs" />
                        </span>
                    </div>
                        <textarea id="editor" name="post_content" rows="10" cols="80">
                            @if(isset($all_post->post_content)){{ $all_post->post_content }}@endif
                        </textarea>
                </div>
            </div>

        </div>
        <!-- /.col-->
        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title ">Publish
                    </h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body pad">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <i class="fa fa-info-circle"></i>&nbsp; Status : @if(isset($all_post->post_status)) <b>{{ $all_post->post_status }}</b> @else <b>Draft @endif</b>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-eye-slash"></i>&nbsp; Visibility : @if(isset($all_post->post_password)) <b>Password protected</b> @else <b>Public @endif </b>
                            <span class="text-primary" id="edit" style="text-decoration: underline; cursor: pointer" > Edit</span>
                            <div class="form-group" id="edit-content">
                            </div>
                        </li>
                        <li class="list-group-item hidden a">
                            Password protected:
                            <input type="text" class="form-control input-sm" value="@if(isset($all_post->post_password)) {{ $all_post->post_password }} @endif" id="post_password" name="post_password" placeholder="Enter password here">
                        </li>
                        <li class="list-group-item">
                            Comment status:
                            <select name="comment_status" id="comment_status">
                                <option value="open">open</option>
                                <option value="close">close</option>
                            </select>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-calendar"></i>&nbsp; Published on: @if(isset($all_post->post_date)) <b>{{ date("M d, Y", strtotime($all_post->post_date)) }}</b> @else <b> {{ date("M d, Y") }} @endif</b>
                        </li>
                    </ul>
                    <button class="btn btn-success btn-flat pull-right" id="post_title">Update</button>
                </div>
            </div>
            <script>
                @if(isset($all_post->post_password))
                    $(".a").removeClass('hidden');
                @endif
                $('#edit').on( "click", function(e) {
                    e.preventDefault();
                    $(".a").toggleClass('hidden');
                });
                document.getElementById("comment_status").value="{{ $all_post->comment_status }}";
            </script>
            <!-- /.box -->
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title ">Categories</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body pad">
                    <select class="form-control" id="post_category" name="post_category">
                        @foreach($all_categories as $all_category)
                            <option value="{{ $all_category->category_name }}">{{ $all_category->category_name }}</option>
                        @endforeach
                    </select>
                    <br>
                    Create New Category
                    <div class="input-group input-group-sm">
                        <input name="category_name" id="category_name" type="text" class="form-control">
                        <span class="input-group-btn">
                          <button id="category_submit" type="button" class="btn btn-info btn-flat">Add</button>
                        </span>
                    </div>
                </div>
            </div>
            <!-- /.box -->
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title ">Tags</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body pad">
                    <div class="form-group">
                        <select name="post_tags[]" id="select_tag" class="form-control input-sm select2" multiple="multiple" data-placeholder="Select a tags" style="width: 100%;">
                            @foreach($all_tags as $all_tag)
                                @if(isset($all_post->post_tags))
                                    @foreach(unserialize($all_post->post_tags) as $tag)
                                        @if($tag==$all_tag->tag_name)
                                            <option selected value="{{ $all_tag->tag_name }}">{{ $all_tag->tag_name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                                    <option value="{{ $all_tag->tag_name }}">{{ $all_tag->tag_name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block">Separate tags with commas</span>

                        <br>
                        Create New Tag
                        <div class="input-group input-group-sm">
                            <input type="text" name="tag_name" id="tag_name" class="form-control">
                        <span class="input-group-btn">
                          <button id="tag_submit" type="button" class="btn btn-info btn-flat">Add</button>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById("post_category").value="{{ $all_post->post_category }}";

                $("#category_submit").click(function(){
                    var category_name=$("#category_name").val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ URL::to('/admin/create_category') }}',
                        data: {
                            'category_name': category_name,
                            '_token':'{{ csrf_token() }}'
                        },
                        success: function (e) {
                            $("#post_category").html(e);
                            $("#category_name").val('');

                        }
                    });

                });
                $("#tag_submit").click(function(){
                    var tag_name=$("#tag_name").val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ URL::to('/admin/create_tag') }}',
                        data: {
                            'tag_name': tag_name,
                            '_token':'{{ csrf_token() }}'
                        },
                        success: function (e) {
                            $("#select_tag").html(e);
                            $("#tag_name").val('');

                        }
                    });

                });
            </script>
            <!-- /.box -->
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title ">Featured Image</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body pad">
                    <div class="input-group input-group-sm">
                        Add Featured Image<input name="post_image" type="file" class="form-control">
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row-->
</form>

<script>
    $('.select2').select2()
    $(function () {
        CKEDITOR.replace('editor')
        $('.textarea').wysihtml5()
    })
</script>
@endsection