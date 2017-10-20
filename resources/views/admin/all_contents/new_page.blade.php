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
<form action="{{ URL::to('/admin/save_page') }}" method="post" class="form-group">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title ">Add New Page
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <div class="form-group">
                        <input required autocomplete="off" type="text" class="form-control input-lg" name="post_title" autofocus id="post_title" placeholder="Enter title here">
                        <span class="help-block"><b>Permalink:</b> {{ Request::root() }}/<input required type="text" name="slug" id="slug" class="input-xs" /></span>
                    </div>
                    <textarea required id="editor1" name="post_content" rows="10" cols="80">
                    </textarea>
                </div>
            </div>
            <!-- /.box -->
<script>
    $("#post_title").keyup(function(){
       var str=$(this).val();
        var post_title1=str.toLowerCase();
        var post_title2=post_title1.replace(/[^a-zA-Z ]/g, "");
        var post_title3=post_title2.split(' ').join('-');
       $("#slug").val(post_title3);
    });
</script>
        </div>
        <!-- /.col-->
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title ">Publish
                    </h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" >
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body pad">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <i class="fa fa-info-circle"></i>&nbsp; Status : @if(isset($posts->post_status)) <b>{{ $posts->post_status }}</b> @else <b>Draft @endif</b>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-eye-slash"></i>&nbsp; Visibility : <b>Public</b>
                            <span class="text-primary" id="edit" style="text-decoration: underline; cursor: pointer" > Edit</span>
                        </li>
                        <li class="list-group-item hidden a">
                            Password protected: <input type="text" name="post_password" id="post_password" />
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-calendar"></i>&nbsp; Published on: @if(isset($posts->post_date)) <b>{{ date("M d, Y", strtotime($posts->post_date)) }}</b> @else <b> {{ date("M d, Y") }} @endif</b>
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-success btn-flat pull-right" id="post_title">Publish</button>
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
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title ">Page Attributes</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" >
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="box-body pad"><b>Parent</b>
                    <select name="parent_id" class="form-control">
                        <option value="">(no parent)</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->post_id }}">{{ $page->post_title }}</option>
                        @endforeach
                    </select>
                    <br>
                    <div class="col-xs-6" style="margin-left: -15px">
                        <b>Order</b>
                        <input type="text" name="menu_order" value="0" class="form-control input-sm">
                    </div>
                </div>
            </div>
            <!-- /.box -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title ">Featured Image</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" >
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
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
        $.ajax({
            type: 'GET',
            url:  '{{ URL::to('/admin/media_ajax') }}',
            success: function (e) {
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
            CKEDITOR.replace('editor1')
            $('.textarea').wysihtml5()
        })
    </script>
@endsection