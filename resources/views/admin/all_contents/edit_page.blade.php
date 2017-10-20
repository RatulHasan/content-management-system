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
<form action="{{ URL::to("/admin/update_post/$posts->post_id") }}" method="post" class="form-group">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="row">
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title ">Edit Page
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <div class="form-group">
                        <input value="@if(isset($posts->post_title)){{ $posts->post_title }}@endif" autocomplete="off" type="text" class="form-control input-lg" name="post_title" autofocus id="post_title" placeholder="Enter title here">
                        <span class="help-block"><b>Permalink:</b> {{ Request::root() }}/<input value="@if(isset($posts->slug)){{ $posts->slug }}@endif" disabled type="text" name="slug" id="slug" class="input-xs" /></span>
                    </div>
                    <textarea id="editor1" name="post_content" rows="10" cols="80">
                        @if(isset($posts->post_content)){{ $posts->post_content }}@endif
                    </textarea>
                </div>
            </div>
            <!-- /.box -->
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
                            <i class="fa fa-eye-slash"></i>&nbsp; Visibility : @if(isset($posts->post_password)) <b>Password protected</b> @else <b>Public @endif </b>
                            <span class="text-primary" id="edit" style="text-decoration: underline; cursor: pointer" > Edit</span>
                            <div class="form-group" id="edit-content">
                            </div>
                        </li>
                        <li class="list-group-item hidden a">
                            Password protected:
                            <input type="text" class="form-control input-sm" value="@if(isset($posts->post_password)) {{ $posts->post_password }} @endif" id="post_password" name="post_password" placeholder="Enter password here">
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-calendar"></i>&nbsp; Published on: @if(isset($posts->post_date)) <b>{{ date("M d, Y", strtotime($posts->post_date)) }}</b> @else <b> {{ date("M d, Y") }} @endif</b>
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-success btn-flat pull-right" id="post_title">Update</button>
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
                        @foreach($all_post as $page)
                            <option value="{{ $page->post_id }}">{{ $page->post_title }}</option>
                        @endforeach
                    </select>
                    <br>
                    <div class="col-xs-6" style="margin-left: -15px">
                        <b>Order</b>
                        <input type="text" name="menu_order" value="@if(isset($posts->menu_order)){{ $posts->menu_order }}@else 0 @endif" class="form-control input-sm">
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
                        Add Featured Image<input type="file" name="post_image" class="form-control btn-flat">
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
        CKEDITOR.replace('editor1')
        $('.textarea').wysihtml5()
    })
</script>
@endsection