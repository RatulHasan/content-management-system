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
<form action="{{ URL::to('admin/save_post') }}" method="post" class="form-group">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title ">Add New Post
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                        <div class="form-group">
                            <input autocomplete="off" name="post_title" autofocus type="text" class="form-control input-lg" id="post_title" placeholder="Enter title here">
                            <span class="help-block"><b>Permalink:</b> {{ Request::root() }}/<input style="width: 300px;" type="text" name="slug" id="slug" class="input-xs" /></span>
                        </div>
                        <textarea id="editor" name="post_content" rows="10" cols="80">
                        </textarea>
                </div>
            </div>
            <!-- /.box -->
<script>
    $(function(){
        var typingTimer;
        var doneTypingInterval = 1000;

        $('#post_title').keyup(function(){
            clearTimeout(typingTimer);
            if ($('#post_title').val) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });

        function doneTyping () {
            var str=$('#post_title').val();
            var post_title1=str.toLowerCase();
            //var post_title2=post_title1.replace(/[^a-zA-Z ]/g, "");
            var post_title3=post_title1.split(' ').join('-');
            var slug=post_title3;
            $.ajax({
                type: 'POST',
                url:  '{{ URL::to('/admin/check_slug') }}',
                data: {
                    'slug': slug,
                    '_token':'{{ csrf_token() }}'
                },
                success: function (e) {
                    $('#slug').val('');
                    e.replace(/[^a-zA-Z0-9 ]/g, "");
                    $('#slug').val(e);
                }
            });
        }
    });
    $(function(){
        var typingTimer;
        var doneTypingInterval = 600;

        $('#slug').keyup(function(){
            clearTimeout(typingTimer);
            if ($('#slug').val) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });

        function doneTyping () {
            var str=$('#slug').val();
            var post_title1=str.toLowerCase();
            var post_title3=post_title1.split(' ').join('-');
            var slug=post_title3;

            $.ajax({
                type: 'POST',
                url:  '{{ URL::to('/admin/check_slug') }}',
                data: {
                    'slug': slug,
                    '_token':'{{ csrf_token() }}'
                },
                success: function (e) {
                    $('#slug').val('');
                    e.replace(/[^a-zA-Z0-9 ]/g, "");
                    $('#slug').val(e);
                }
            });
        }
    });
</script>
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
                            <i class="fa fa-info-circle"></i>&nbsp; Status : <b>Draft</b>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-eye-slash"></i>&nbsp; Visibility : <b>Public</b>
                            <span class="text-primary" id="edit" style="text-decoration: underline; cursor: pointer" > Edit</span>
                        </li>
                        <li class="list-group-item hidden a">
                            Password protected: <input type="text" name="post_password" id="post_password" />
                        </li>
                        <li class="list-group-item">
                            Comment status:
                            <select name="comment_status" id="comment_status">
                                <option value="open">open</option>
                                <option value="close">close</option>
                            </select>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-calendar"></i>&nbsp; Published on: <b> {{ date("M d, Y") }}</b>
                        </li>
                    </ul>
                    <button class="btn btn-success btn-flat pull-right" id="post_title">Publish</button>
                </div>
            </div>
<script>
    @if(isset($posts->post_password))
        $(".a").removeClass('hidden');
    @endif
    $('#edit').on( "click", function(e) {
            e.preventDefault();
        $(".a").toggleClass('hidden');
    });
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
                       Add Featured Image<a data-toggle="modal" data-target="#media" class="form-control btn-flat media">Add</a>
                        <img id="photo" data-toggle="modal" data-target="#media" name="photo" class="img-thumbnail media" src=""/>
                        <span id="close" class="close">&times; Remove</span>
                        <input type="hidden" id="media_value" name="post_image" value="" />
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col-->
    </div>
<!-- /.row-->
</form>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="media" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h3 class="modal-title">Attachment Details </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" id="info">
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<style>
    .modal-dialog {
        width: 95%;
        height: 95%;
        margin: 20px auto;
        padding: 0;
    }

    .modal-content {
        height: auto;
        min-height: 100%;
        border-radius: 0;
    }
    .photo{
        border-radius: 0;
        border: 1px solid #ccc;
        width: 200px;
        height: 100px;
        margin: 5px;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-drag: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    .photo:hover{
        cursor: pointer;
    }
    .media:hover{
        cursor: pointer;
    }
</style>
<script>
    $(document).on( "click", '.media',function(e) {
        //alert ("OK");
        $.ajax({
            type: 'GET',
            url:  '{{ URL::to('/admin/media_ajax') }}',
            success: function (e) {
                //alert(e);
                $("#info").html(e);
            }
        });
    });
</script>
<script>
    $(document).on( "click", '.photo',function(e) {
        var id = $(this).data('id');
        var photo = $(this).data('photo');
        var src = $(this).data('src');
        $("#photo").attr('src',photo);
        $("#media_value").val(src);

    });
</script>
<script>
    $(function(){
        $("#close").click(function () {
            $('#photo').attr('src',' ');
            $('#media_value').val('');
        });
    });
</script>
<script>
    $('.select2').select2()
    $(function () {
        CKEDITOR.replace( 'editor' );
        $('.textarea').wysihtml5()

    })
</script>
@endsection