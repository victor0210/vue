<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targ_w = $targ_h = 150;
    $jpeg_quality = 90;

    $src = 'demo_files/pool.jpg';
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

    imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'],
            $targ_w, $targ_h, $_POST['w'], $_POST['h']);

    header('Content-type: image/jpeg');
    imagejpeg($dst_r, null, $jpeg_quality);

    exit;
}

// If not a POST request, display page below:

?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Live Cropping Demo</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.Jcrop.min.js"></script>
    <link rel="stylesheet" href="/css/main.css" type="text/css"/>
    <link rel="stylesheet" href="/css/demos.css" type="text/css"/>
    <link rel="stylesheet" href="/css/jquery.Jcrop.min.css" type="text/css"/>
    <script src="{{ elixir('js/bootstrap.js') }}"></script>

    <script type="text/javascript">



    </script>
    <style type="text/css">
        #target {
            background-color: #ccc;
            width: 500px;
            height: 330px;
            font-size: 24px;
            display: block;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <form action="api/crop" method="post" enctype="multipart/form-data" id="uploader">
            <input type="file" id="img" name="img">
            <input type="submit" style="position: absolute;left: 0;top:400px;">
        </form>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload Avatar</h4>
                </div>
                <div class="modal-body">
                    <div class="row preview">


                        <form action="api/crop-size" method="post" enctype="multipart/form-data" id="cropForm">
                            <input type="hidden" id="x" name="x"/>
                            <input type="hidden" id="y" name="y"/>
                            <input type="hidden" id="w" name="w"/>
                            <input type="hidden" id="h" name="h"/>
                            <input type="submit" value="Crop Image" class="btn btn-large btn-inverse"/>
                        </form>
                    </div>
                    <div class="row">
                        <div class="alert-danger text-center" style="display: none"> 请勿上传图片格式以外的文件 !
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }


    $('#cropForm input[type=submit]').click(function (e) {
        e.preventDefault();
        if(!!$('#x').val()){
            $('#cropForm').submit();
        }
        return false;
    });
    $('#uploader').submit(function () {
        var formData = new FormData($(this)[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/crop',
            type: 'POST',
            data: formData,
            success: function (data) {
                $('#editModal .preview').prepend('<img id="cropbox" src="' + data + '"/>');
                $('#editModal').modal();

                $('#cropbox').Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    })
</script>

</body>
</html>
