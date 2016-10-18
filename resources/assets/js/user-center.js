$(function () {
    var listenFileUpload = function () {
        $("#upload-head").change(function () {
            var filepath = $(this).val();
            var extStart = filepath.lastIndexOf(".");
            var ext = filepath.substring(extStart, filepath.length).toUpperCase();
            if (ext != ".BMP" && ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
                // alert("图片限于bmp,png,gif,jpeg,jpg格式");
                $('.alert-danger').fadeIn(500,function () {
                    $('.alert-danger').fadeOut(5000);
                });
            } else {
                $('form').submit();
            }
        });
    };
    listenFileUpload();
});
