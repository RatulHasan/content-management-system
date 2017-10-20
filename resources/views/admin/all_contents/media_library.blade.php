@extends('admin.master')
@section('main_content')
    <div class="box box-info">
        <div class="box-header">

            <link href="{{ asset('/public/admin-panel/js/dropzone/dropzone.min.css') }}" rel="stylesheet">
            <script src="{{ asset('/public/admin-panel/js/dropzone/dropzone.js') }}"></script>
            <script src="{{ asset('/public/admin-panel/js/dropzone-config.js') }}"></script>


            <b style="color: #00a0d1">
                <form action="{{ URL::to('admin/upload') }}" enctype="multipart/form-data" class="dropzone" id="dropZone">
                    {{ csrf_field() }}
                </form>
            </b>

            <script type="text/javascript">
                Dropzone.options.dropZone = {
                    maxFilesize:2,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    dictRemoveFile: 'Remove',
                    success: function () {
                        $("#showImage").load(location.href + " #showImage");
                    }
                };
            </script>
            <style>
                .dropzone .dz-preview .dz-remove{
                    color: red;
                    font-size:14px;
                    text-align:center;
                    display:block;
                    cursor:pointer;
                    border:none;
                    position: absolute;
                    top: 0;
                    left: 0;
                    z-index: 9999;
                }
                .dropzone {
                    border: 2px dashed #3C8DBC;
                    border-radius: 5px;
                    font-size: 20px;;
                    background: white;
                }
            </style>
        </div>
        <div class="box-body pad">
            <div class="col-md-12" id="showImage">
                @foreach ($all_media as $media)
                    {{--<div class="col-md-3" >--}}
                        <img
                                data-toggle="modal"
                                data-target="#photo"
                                data-id="{{ $media->post_id }}"
                                data-post_title="{{ $media->post_title }}"
                                data-created_at="{{ date('F d, Y', strtotime($media->created_at)) }}"
                                data-photo="{{ asset("public/$media->post_image") }}"
                                class="img-thumbnail img-responsive photo"
                                src="{{ asset("public/$media->post_image") }}"
                        />

                @endforeach
            </div>
            </div>
        </div>
        <!-- /.box-body -->
    <!-- /.box -->
    <!--EDIT MODAL-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="photo" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h3 class="modal-title">Attachment Details </h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <img src="" id="img" class="img-responsive" />
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div id="info">
                                {{--Javascript--}}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>

        .photo{
            border-radius: 0;
            border: 1px solid #ccc;
            width: 150px;
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

        #img{
            margin: 0 auto;
        }
        #info{
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }
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
    </style>

    <script>
        $(document).on( "click", '.photo',function(e) {
            var id = $(this).data('id');
            var post_title = $(this).data('post_title');
            var photo = $(this).data('photo');
            var created_at = $(this).data('created_at');
            $("#img").attr('src',photo);

            var temp = "";
            temp += "Filename: " + post_title;
            temp += "<br>Uploaded on: " + created_at;
            temp += "<br>Dimensions: : " + (this.naturalWidth)+'x'+(this.naturalHeight);
            temp += "<br>URL: <span id='copyTarget'>"+photo+"</span>";
            temp += "<br><button class='btn-btn-flat btn-info btn-xs' onclick='copyToClipboardMsg(document.getElementById(\"copyTarget\").innerHTML,msg)' id='copyButton'>Copy</button> <span id='msg'></span>";
            temp += "<br><a style='color: red' onclick='return confirm(\"Are you sure?\")' href='{{ URL::to('/admin/destroy_upload') }}/"+ id +"'> Delete permanently</a> </b>";
            $("#info").html(temp);

        });
    </script>

<script>

    function copyToClipboardMsg(elem, msgElem) {
        //alert(elem);
        var succeed = copyToClipboard(elem);
        var msg;
        if (!succeed) {
            msg = "Copy not supported or blocked.  Press Ctrl+c to copy."
        } else {
            msg = "Text copied to the clipboard."
        }
        if (typeof msgElem === "string") {
            msgElem = document.getElementById(msgElem);
        }
        msgElem.innerHTML = msg;
        setTimeout(function() {
            msgElem.innerHTML = "";
        }, 2000);
    }

    function copyToClipboard(elem) {
        alert(elem);
        // create hidden text element, if it doesn't already exist
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        var succeed;
        try {
            //alert(elem);
            succeed = document.execCommand("copy");
        } catch(e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        }
        return succeed;
    }

</script>

@endsection