@extends('admin.master')
@section('main_content')
    <div class="row">
        <div class="col-md-3">
            <!-- form start -->
            <form action="{{ URL::to("/admin/change_options") }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field("PATCH") }}
                <div class="box-body">
                    <div class="form-group">
                        <label>Site Title</label>
                        <input type="text" name="blogname" class="form-control input-sm" />
                    </div>
                    <div class="form-group">
                        <label>Tagline</label>
                        <input type="text" name="blogdescription" class="form-control input-sm" />
                    </div>
                    <div class="form-group">
                        <label>Header image</label><br/>
                        <?php
                        if(!empty($header_image)) {
                        ?>
                        <img id="photo" data-toggle="modal" data-target="#media" name="photo" class="img-thumbnail media" src="{{ asset("public/$header_image") }}"/>
                        <span id="close" class="close">&times; Remove</span>
                    <?php
                        }else {
                        ?>
                        <img id="photo" data-toggle="modal" data-target="#media" name="photo" class="img-thumbnail media" alt="No image set"/>
                    <?php
                        }
                        ?>
                        <input type="hidden" id="media_value" name="header_image" value="{{ $header_image }}" />
                    </div><br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-flat btn-sm pull-right">Save & Publish</button>
                    </div>
                </div>
            </form>
            <!--EDIT MODAL-->
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
            <!-- /.box -->
        </div>
        <div class="col-md-9">
                <p><iframe id="iframe" frameborder="0" width="100%" scrolling="yes" src="{{ Request::root() }}"></iframe></p>
            <!-- /.box -->
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
            var height=$(document).height();
            $("#iframe").attr("height",height);
        });
    </script>
    <script>
        function validateFileExtension(fld) {
            if(!/(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i.test(fld.value)) {
                alert("Invalid file type!");
                $('#file-input').closest('form').get(0).reset();
                return false;
            }
            return true;
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo').attr('src', e.target.result);
                            /*.width(100)
                            .height(130);*/
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(function(){
            $("#close").click(function () {
                $('#photo').attr('src',' ');
                $('#media_value').val('');
            });
        });
    </script>
    <style>
        .image-upload > input
        {
            display: none;
        }

        .image-upload img{
            width: 110px;
            height:130px;
            cursor: pointer;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 4px;
        }
        .close {
            color: red;
        }

    </style>
@endsection