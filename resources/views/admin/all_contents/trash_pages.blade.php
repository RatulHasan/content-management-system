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
<form action="{{URL::to('admin/bulk_action_delete_or_restore')}}" method="post">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="box box-info">
        <div class="box-header">
            <a href="{{ URL::to('/admin/new-page') }}" class="btn btn-flat btn-primary">Add new</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a href="{{ URL::to('/admin/pages') }}">Publish <b>({{ count($all_trash) }})</b></a>
            </div>
            <div class="input-group input-group-sm col-lg-2 col-md-3 col-sm-4 col-xs-6">
                <select name="action" required class="form-control" id="bulk-action-selector-top">
                    <option value="">Bulk Actions</option>
                    <option value="restore">ReStore</option>
                    <option value="delete">Delete Permanently</option>
                </select>
                <span class="input-group-btn">
                  <input type="submit" id="doaction" class="btn btn-flat btn-sm bg-olive" value="Apply">
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
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_posts as $posts)
                    <tr class="title">
                        <td>
                            <label class="btn btn-default btn-flat btn-xs">
                                <input name="post_id[]" value="{{ $posts->post_id }}" type="checkbox" class="view_group" autocomplete="off">
                            </label>
                            <a href="{{"restore_post/$posts->post_id" }}"><strong> {{ $posts->post_title }}</strong></a>
                            <br>
                            <div class="hoverInfo">
                                <a href="{{"restore_post/$posts->post_id" }}" class="text-primary" ><i class="fa fa-pencil"></i> Restore</a>
                                &nbsp;|&nbsp;
                                <a onclick="return confirm('Are you sure? This action can not be restored!');" href="{{"delete_permanently/$posts->post_id" }}" class="text-danger"> <i class="fa fa-trash"></i> Delete Permanently</a>
                            </div>
                        </td>
                        <td><a href="{{"restore_post/$posts->post_id" }}" class="text-primary" >{{ $posts->post_author }}</a>
                        </td>
                        <td>
                            {{ $posts->post_status }}<br>
                            {{ date("d-m-Y",strtotime($posts->post_date)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $all_posts->render() }}
        </div>
    </div>
</form>
    <!-- /.box -->


<!-- iCheck 1.0.1 -->
<script src="{{ asset('public/admin-panel/css/iCheck/icheck.min.js') }}"></script>
    <script>
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
    </script>

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