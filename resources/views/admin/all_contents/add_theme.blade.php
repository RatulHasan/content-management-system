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
<form action="{{URL::to('admin/theme-upload')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
    {{ csrf_field() }}
    <div class="box box-info">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Upload zip</label>
                <div class="col-sm-3">
                    <input type="file" required onchange="return validateFileExtension(this)" class="form-control input-sm" id="zip" name="zip">
                    <span class="help-block" id="help">Max upload size 20M</span>
                </div>

                <button type="submit" onclick="return confirm('Same name folder will be replaced by this one! Are you want to upload?')"  id="upload" class="btn btn-primary btn-sm btn-flat">Upload</button>
            </div>

        </div>
    </div>
</form>
<script type="text/javascript">
    function validateFileExtension(fld) {
        if(!/(\.zip)$/i.test(fld.value)) {
            alert("Invalid file type! Only zip allowed.");
            fld.form.reset();
            fld.focus();
            return false;
        }
        return true;
    }
</script>
@endsection