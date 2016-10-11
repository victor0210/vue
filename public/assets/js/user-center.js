$(function () {
    var listenFileUpload = function () {
        // var imgFile = $('#upload-head');
        // imgFile.on('change', function () {
        //     console.log($(this));
        //     // $('form').submit();
        // })

        $("#upload-head").change(function () {
            var filepath = $(this).val();
            var extStart = filepath.lastIndexOf(".");
            var ext = filepath.substring(extStart, filepath.length).toUpperCase();
            if (ext != ".BMP" && ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
                // alert("图片限于bmp,png,gif,jpeg,jpg格式");
                $('.modal').modal();
                setTimeout(function () {
                    $('.modal').modal('hide');
                },3000);
                return false;
            } else {
                $('form').submit();
            }
        });
    };
    listenFileUpload();
});

//# sourceMappingURL=user-center.js.map
