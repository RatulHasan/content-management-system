@extends('admin.master')
@section('main_content')

<div class="row">
    <!-- /.col-->
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title ">Pages
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
            <form action="{{ URL::to("/admin/make_menu") }}" method="post">
                {{ csrf_field() }}
                <div class="box-body pad">
                    <ul class="list-group list-group-unbordered">
                        @if(isset($pages))
                        @foreach($pages as $page)
                            @if($page->post_type=='page')
                                <li class="list-group-item">
                                    <label class="btn btn-default btn-flat btn-xs">
                                        <input value="0" type="checkbox" name="{{ $page->post_id }}" class="view_group" autocomplete="off">
                                    </label>
                                    {{ $page->post_title }}
                                </li>
                            @endif
                        @endforeach
                        @else
                            No pges to create menu
                        @endif
                    </ul>
                    <button type="submit" class="btn btn-success btn-flat pull-right btn-sm" id="post_title">Add to menu</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title ">Reading Settings</h3>
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
                <form action="{{ URL::to("/admin/is_home") }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="box-body pad">
                        Home page
                        <select name="post_id" class="form-control">
                            <option value="">(no home page)</option>
                            @foreach($pages as $page)
                                @if($page->is_menu_show=='yes')
                                    <option value="{{ $page->post_id }}" @if($page->post_type=='home') selected @endif>{{ $page->post_title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-flat pull-right btn-sm" id="post_title">Make Home</button>
                </form>
            </div>
            <div class="box-body pad">
                <form action="{{ URL::to("/admin/is_blog") }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="box-body pad">
                        Blog page
                        <select name="post_id" class="form-control">
                            <option value="">(no blog page)</option>
                            @foreach($pages as $page)
                                @if($page->is_menu_show=='yes')
                                    <option value="{{ $page->post_id }}" @if($page->post_type=='blog') selected @endif>{{ $page->post_title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-flat pull-right btn-sm" id="post_title">Make blog</button>
                </form>
            </div>
        </div>
        <!-- /.box -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title ">Custom Links</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" >
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times"></i></button>
                </div>
                <!-- /. tools -->
            </div>
            <form action="{{ URL::to("/admin/custom_menu") }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
            <div class="box-body pad">
                <div class="box-body pad">
                    URL
                    <input type="text" name="slug" placeholder="http://" class="form-control input-sm">
                </div>
                <div class="box-body pad">
                    Link Text
                    <input type="text" name="post_title" class="form-control input-sm">
                </div>
                <button type="submit" class="btn btn-success btn-flat pull-right btn-sm" id="post_title">Add to menu</button>
            </div>
        </form>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col-->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title ">Menu Lists
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

            <link href="{{ asset('public/admin-panel/css/menu_order_style.css') }}" rel="stylesheet">
            <div class="box-body pad">
                <form action="{{ URL::to('/admin/menu_re_order') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field("PATCH") }}
                    <div class="dd nestable" id="nestable">
                        <ol class="dd-list">
                            @foreach($pages as $page)
                                @if($page->is_menu_show=='yes')
                                    <?php
                                    if($page->parent_id==NULL || $page->parent_id=='0') {
                                    ?>
                                    <li data-id="{{ $page->post_id }}" style="cursor: move" class="dd-item">
                                        <div class="dd-handle">
                                            <b>{{ "# ".$page->post_title }}</b> @if($page->post_type=='blog')( Blog page )@elseif($page->post_type=='home')( Home page )@endif
                                            <span class="help-block">Link: <a href="{{ Request::root() ."/".$page->slug }}" target="_blank">{{ Request::root() ."/".$page->slug }}</a>
                                            </span>
                                        </div>
                            <span class="button-delete btn btn-default btn-flat btn-xs pull-right">
                                <a data-toggle="modal" data-post_id="{{ $page->post_id }}" data-target="#modal-default" class="text-danger delete_btn">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </span>
                                    </li>
                                <?php
                                }else if($page->parent_id=='sub-menu'){
                                ?>
                                    <li data-id="{{ $page->post_id }}" style="cursor: move" class="dd-item">
                                        <div class="dd-handle">
                                            <b>{{ "# ".$page->post_title }}</b> @if($page->post_type=='blog')( Blog page )@elseif($page->post_type=='home')( Home page )@endif
                                            <span class="help-block">Link: <a href="{{ Request::root() ."/".$page->slug }}" target="_blank">{{ Request::root() ."/".$page->slug }}</a>
                                            </span>
                                        </div>
                                        <span class="button-delete btn btn-default btn-flat btn-xs pull-right">
                                            <a data-toggle="modal" data-post_id="{{ $page->post_id }}" data-target="#modal-default" class="text-danger delete_btn">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        <ol class="dd-list">
                                        <?php
                                        $parent_id=$page->post_id;
                                        foreach($child_menu as $child)
                                        if($parent_id==$child->parent_id){
                                        ?>
                                            <li data-id="{{ $child->post_id }}" style="cursor: move" class="dd-item">
                                                <div class="dd-handle">
                                                    <b>{{ "# ".$child->post_title }}</b> @if($child->post_type=='blog')( Blog page )@elseif($child->post_type=='home')( Home page )@endif
                                                    <span class="help-block">Link: <a href="{{ Request::root() ."/".$child->slug }}" target="_blank">{{ Request::root() ."/".$child->slug }}</a>
                                                    </span>
                                                </div>
                                <span class="button-delete btn btn-default btn-flat btn-xs pull-right">
                                    <a data-toggle="modal" data-post_id="{{ $child->post_id }}" data-target="#modal-default" class="text-danger delete_btn">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </span>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                        </ol>
                                    </li>
                                <?php

                                    }
                                ?>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                    <input type="hidden" id="json-output" name="output" class="form-control" />
                    <button type="submit" class="btn btn-success btn-sm btn-flat pull-right">Save</button>
                </form>

            </div>
        </div>
    </div>
</div>
    <!--
FOR MODAL
-->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_content">
                                <form method="post" action="{{ URL::to('/admin/restore_post') }}" id="restore_form" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" id="_method" value="PATCH">
                                    <div class="form-group" id="pre_vou_code1">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edit_category_name">Restore to
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select required name="restore" id="restore" class="form-control input-sm col-md-7 col-xs-12">
                                                <option value="">Choose</option>
                                                <option value="post">Post</option>
                                                <option value="page">Page</option>
                                                <option value="delete">Delete permanently</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="post_id" id="edit_post_id" />
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" id="button" class="btn btn-success pull-right btn-flat btn-sm">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script>
        $(document).on( "click", '.delete_btn',function(e) {
            var post_id = $(this).data('post_id');
            $("#edit_post_id").val(post_id);
        });
        $(function(){
            $("#restore").change(function(){
                var restore_val= $(this).val();
                if(restore_val=='delete'){
                    $("#_method").val('DELETE');
                    $('#restore_form').attr('action', "{{ URL::to('/admin/delete_post') }}");
                }else{
                    $("#_method").val('PATCH');
                    $('#restore_form').attr('action', "{{ URL::to('/admin/restore_post') }}");
                }
            });
        });
    </script>

    <script src="{{ asset('public/admin-panel/js/jquery.nestable.js') }}"></script>
    <script src="{{ asset('public/admin-panel/js/jquery.nestable++.js') }}"></script>
    <script>
        $('#nestable').nestable({
                    maxDepth: 2 // you can make it 3,4 or as you want.
                })
                .on('change', updateOutput);

    </script>
@endsection