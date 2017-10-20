@extends('admin.master')
@section('main_content')
        <!-- Page style DataTables -->
<style>
    .hoverInfo {
        position: absolute;
        margin-left: 30px;
        display: none;
    }

    .title:hover .hoverInfo {
        display: block;
    }
</style>

<form action="{{URL::to('admin/bulk_action')}}" method="post">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box box-info">
        <div class="box-header">
            <a href="{{ URL::to('/admin/new-post') }}" class="btn btn-flat btn-primary">Add new</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a href="{{ URL::to('/admin/trashPost') }}">Trash <b>({{ count($all_trash) }})</b></a>
            </div>
            <div class="input-group input-group-sm col-lg-2 col-md-3 col-sm-4 col-xs-6">
                <select name="action" required class="form-control" id="bulk-action-selector-top">
                    <option value="">Bulk Actions</option>
                    <option value="trash">Move to Trash</option>
                </select>
                <span class="input-group-btn">
                  <input type="submit" onclick="return confirm('Are you sure?');" id="doaction" class="btn btn-flat btn-sm bg-olive" value="Apply">
                </span>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>
                        <label class="btn btn-default btn-flat btn-xs">
                            <input type="checkbox" id="all_check" autocomplete="off">
                        </label>
                        Title
                    </th>
                    <th>Author</th>
                    <th>Categories</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_posts as $posts)
                    <tr class="title">
                        <td>
                            <label class="btn btn-default btn-flat btn-xs">
                                <input type="checkbox" name="post_id[]" value="{{ $posts->post_id }}" class="view_group" autocomplete="off">
                            </label>
                            <a href="{{"edit-post/$posts->post_id" }}"><strong> {{ $posts->post_title }}</strong></a> @if(isset($posts->post_password)) <b>Password protected</b>@endif
                            <br>
                            <div class="hoverInfo">
                                <a href="{{"edit-post/$posts->post_id" }}" class="text-primary" ><i class="fa fa-pencil"></i> Edit</a>
                                &nbsp;|&nbsp;
                                <a onclick="return confirm('Are you sure?');" href="{{"delete-post/$posts->post_id" }}" class="text-danger"> <i class="fa fa-trash"></i> Trash</a>
                            </div>
                        </td>
                        <td><a href="{{"author/posts/$posts->post_author" }}" class="text-primary" >{{ $posts->post_author }}</a>
                        </td>
                        <td>{{ $posts->post_category }}</td>
                        <td>
                            <?php $tag='';?>
                            @foreach((array)unserialize($posts->post_tags) as $value)
                                <?php $tag[]=$value;?>
                            @endforeach
                            <?php echo implode(",",$tag);?>
                        </td>
                        <td><i class="fa fa-comment-o">{{ $posts->comment_count }}</i></td>
                        <td>
                            {{ $posts->post_status }}<br>
                            {{ date("d-m-Y",strtotime($posts->created_at)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <nav class="post-navigation" id="nav-below">
                {{ $all_posts->render() }}
            </nav>
        </div>
        <!-- /.box-body -->
    </div>

</form>
    <!-- /.box -->

<script>
    function check_all(id,type) {
        if ($(id).prop("checked")) {
            $(type).prop("checked", true);
        }else{
            $(type).prop("checked", false);

        }
    }
    $(function() {
        $("#all_check").change(function () {
            check_all("#all_check", ".view_group");
        });

    });
</script>
@endsection