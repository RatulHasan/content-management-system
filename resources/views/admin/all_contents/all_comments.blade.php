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
                        Author
                    </th>
                    <th>Comments</th>
                    <th>Post title</th>
                    <th>Comment type</th>
                    <th>Comments parent</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_comments as $comments)
                    <tr class="title">
                        <td>
                            <label class="btn btn-default btn-flat btn-xs">
                                <input type="checkbox" name="post_id[]" value="{{ $comments->comment_ID }}" class="view_group" autocomplete="off">
                            </label>
                            @if($comments->comment_approved=='approved')
                                <a href="{{"view_details_comment/$comments->comment_ID" }}"><strong class="text-info"> {{ $comments->comment_author }}</strong></a>
                            @elseif($comments->comment_approved=='unapproved')
                                <a href="{{"view_details_comment/$comments->comment_ID" }}"><strong class="text-danger"> {{ $comments->comment_author }}</strong></a>
                            @endif
                            | {{ $comments->comment_author_email }}

                            <div class="hoverInfo">
                                @if($comments->comment_approved=='approved')
                                    <a href="{{ URL::to("/admin/unapprove/$comments->comment_ID") }}" class="text-danger" ><i class="fa fa-times"></i> Unapprove</a>
                                @elseif($comments->comment_approved=='unapproved')
                                    <a href="{{ URL::to("/admin/approve/$comments->comment_ID") }}" class="text-success" ><i class="fa fa-check"></i> Approve</a>
                                @endif
                                &nbsp;|&nbsp;
                                <a onclick="return confirm('Are you sure?');" href="{{ URL::to("/admin/trash_comment/$comments->comment_ID") }}" class="text-danger"> <i class="fa fa-trash"></i> Trash</a>
                            </div>
                        </td>
                        <td>{{ $comments->comment_content }}</td>
                        <td><a href="{{ URL::to('/'.$comments->slug) }}" target="_blank"> {{ $comments->post_title }}</a></td>
                        <td>{{ $comments->comment_type }}</td>
                        <td>
                            @if($comments->comment_type==='reply')
                            @foreach($all_comments as $all_comment)
                                @if($all_comment->comment_ID==$comments->comment_parent)
                                    {{ $all_comment->comment_content }}
                                @endif
                            @endforeach
                            @endif
                        </td>
                        <td>
                            {{ date("d-m-Y",strtotime($comments->created_at)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <nav class="post-navigation" id="nav-below">
                {{ $all_comments->render() }}
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