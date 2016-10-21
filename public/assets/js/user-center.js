$(function () {
    var listenFileUpload = function () {
        $("#upload-head").change(function () {
            var filepath = $(this).val();
            var extStart = filepath.lastIndexOf(".");
            var ext = filepath.substring(extStart, filepath.length).toUpperCase();
            if (ext != ".BMP" && ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
                $('.alert-danger').fadeIn(500, function () {
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
                $('.alert-danger').fadeIn(500, function () {
                    $('.alert-danger').fadeOut(5000);
                });
            } else {
                $('#form-background').submit();
            }
        });
    };

    var deleteRecords = function () {
        $('.records-edit').click(function () {
            $('.records-badge').toggle();
            $('.records-remove').toggle();
        });
        $('.records-remove').click(function () {
            var _this = $(this);
            var id = $(this).data('id');
            $.ajax('/api/delete-record', {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    id: id
                },
                success: function () {
                    _this.parent('li').fadeOut(200);
                    modalSuccess();
                },
                error: function () {
                    modalFailed();
                }
            });
        })
    };

    var deleteArticles = function () {
        $('.articles-edit').click(function () {
            $('.articles-badge').toggle();
            $('.articles-remove').toggle();
        });
        $('.articles-remove').click(function () {
            var _this = $(this);
            var id = $(this).data('id');
            $.ajax('/api/delete-article', {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    _this.parent('li').fadeOut(200);
                    modalSuccess();
                },
                error: function () {
                    modalFailed();
                }
            });
        })
    };

    var modalSuccess = function () {
        $('#reply-modal').modal();
        $('#reply-info').text('Delete Success !').css('color', 'green');
    };

    var modalFailed = function () {
        $('#reply-modal').modal();
        $('#reply-info').text('Delete Failed !').css('color', 'red');
    };

    deleteArticles();
    deleteRecords();
    listenFileUpload();
});

//# sourceMappingURL=user-center.js.map
