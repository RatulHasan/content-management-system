@extends('admin.master')
@section('main_content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <a href="{{ URL::to('/admin/add-theme') }}" class="btn btn-flat btn-primary">Add theme</a>
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <div class="row">
                    <?php

                    $path = 'resources/views/blog';
                    $results = scandir($path);
                    //print_r($results);
                    $row=1;
                    foreach ($results as $result) {
                        if ($result === '.' or $result === '..') continue;

                        if ($result != '.' or $result != '..'){
                            if (is_dir($path . '/' . $result)) {
                                //code to use if directory
                                $image = asset('resources/views/blog/'.$result."/screenshot.png");

                                if($template==$result){//FOR SELECTING SELECTED THEMES
                                    echo '<div class="col-md-4" >'.ucwords($result).'<a href="'.URL::to("/admin/change_theme/$result").'"><img class="img-thumbnail img-responsive" style=" background:green" src="'.$image.'" /></a></div>';
                                    //}
                                }else{

                                    echo '<div class="col-md-4" >'.ucwords(str_replace("_"," ",$result)).'<a href="'.URL::to("/admin/change_theme/$result").'"><img class="img-thumbnail img-responsive" src="'.$image.'" /></a></div>';
                                }
                            }
                        }
                        if ($row % 3 == 0) {echo '</div><div class="row" style="margin-top:20px;">';}
                        $row++;
                    }


                    ?>
                </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection