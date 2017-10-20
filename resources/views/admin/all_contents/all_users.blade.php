@extends('admin.master')
@section('main_content')
        <!-- Page style DataTables -->
<style>
    .hoverInfo {
        position: absolute;
        display: none;
    }

    .title:hover .hoverInfo {
        display: block;
    }
</style>

    <div class="box box-info">
        <div class="box-header">
            <a data-target="#add_user" data-toggle="modal" class="btn btn-flat btn-primary">Add new</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach($all_users as $users)
                    <tr class="title">
                        <td>
                            {{ $i++ }}
                        </td>
                        <td>
                            {{ $users->name }}
                            <div class="hoverInfo">
                                @if(Session::get('user.id')==$users->id)
                                <a data-target="#edit_user" data-toggle="modal"
                                   data-id="{{ $users->id }}"
                                   data-name="{{ $users->name }}"
                                   data-email="{{ $users->email }}"
                                   data-user_role="{{ $users->user_role }}"
                                   href="javascript:void(0)"
                                   class="text-primary edit_button"
                                >
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                @else
                                <a onclick="return confirm('Are you sure?');" href="{{"delete_user/$users->id" }}" class="text-danger"> <i class="fa fa-trash"></i> Delete</a>
                                @endif
                            </div>
                        </td>
                        <td> <a href="mailto:{{ $users->email }}"> {{ $users->email }} </a> </td>
                        <td>
                            @if($users->user_role==1)
                                Admin
                            @else
                                Subscriber
                            @endif
                        </td>
                        <td>{{ $users->status }}</td>
                        <td>
                            {{ date("d-m-Y",strtotime($users->created_at)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <nav class="post-navigation" id="nav-below">
                {{ $all_users->render() }}
            </nav>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="add_user" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h3 class="modal-title">Create User </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="{{ URL::to('admin/create_user') }}" class="form-horizontal form-label-left" method="post">
                        {{ csrf_field() }}
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                User Name <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input autocomplete="off" type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Name" required>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                                Email <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input autocomplete="off" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter valid Email" required>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                                Role <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <select name="user_role" name="edit_user_role" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="0">Subscriber</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">
                                Password <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input autocomplete="off" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">
                                Re-Password <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input autocomplete="off" type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Retype password" required>
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" id="button" class="btn btn-primary btn-flat pull-right">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
{{--FOR EDIT--}}
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit_user" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h3 class="modal-title">Create User </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="{{ URL::to('/admin/edit-user')  }}" class="form-horizontal form-label-left" method="post">
                        {{ csrf_field() }}
                        {{ method_field("PATCH") }}
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                User Name <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input autocomplete="off" type="text" class="form-control" id="edit_name" name="name" value="{{ old('name') }}" placeholder="Name" required>
                                <input type="hidden" name="id" value="{{ $users->id }}" id="id" />
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                                Email <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input autocomplete="off" type="email" class="form-control" id="edit_email" name="email" value="{{ old('email') }}" placeholder="Enter valid Email" required>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                                Role <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <select name="user_role" class="form-control">
                                    <option value="1">Admin</option>
                                    <option value="0">Subscriber</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">
                                Password <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input autocomplete="off" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" id="pre_vou_code1">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">
                                Re-Password <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input autocomplete="off" type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Retype password" required>
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" id="button" class="btn btn-primary btn-flat pull-right">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).on( "click", '.edit_button',function(e) {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var user_role = $(this).data('user_role');
        $("#edit_name").val(name);
        $("#edit_email").val(email);
        $("#edit_user_role").val(user_role);

    });
</script>

@endsection