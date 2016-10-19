$(function () {
    var listenFileUpload = function () {
        $("#upload-head").change(function () {
            var filepath = $(this).val();
            var extStart = filepath.lastIndexOf(".");
            var ext = filepath.substring(extStart, filepath.length).toUpperCase();
            if (ext != ".BMP" && ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
                $('.alert-danger').fadeIn(500,function () {
                    $('.alert-danger').fadeOut(5000);
                });
            } else {
                $('#form-avater').submit();
            }
        });

        $("#upload-background").change(function () {
            var filepath = $(this).val();
            var extStart = filepath.lastIndexOf(".");
            var ext = filepath.substring(extStart, filepath.length).toUpperCase();
            if (ext != ".BMP" && ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
                $('.alert-danger').fadeIn(500,function () {
                    $('.alert-danger').fadeOut(5000);
                });
            } else {
                $('#form-background').submit();
            }
        });
    };
    listenFileUpload();
});
