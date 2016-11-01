$(function () {
    var showModal = function (content, color) {
        $('#reply-modal').modal();
        $('#reply-info').text(content).css('color', color);
    }

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
                    console.log(_this);
                    _this.parent('p').parent('li').fadeOut(200);
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
                success: function () {
                    _this.parent('p').parent('li').fadeOut(200);
                    $('div[title="' + id + '"]').fadeOut(200);
                    modalSuccess();
                },
                error: function () {
                    modalFailed();
                }
            });
        })
    };

    var modalSuccess = function () {
        showModal('Delete Success !', 'green');
    };

    var modalFailed = function () {
        showModal('Delete Failed !', 'red');
    };

    var validateForm = function () {
        $('#basic-submit').click(function () {
            var description = $('#inputDescription').val();
            if (description.length > 50) {
                showModal('description most 50 character', 'red');
            } else {
                $('#basic-info').submit();
            }
        });
    };

    deleteArticles();
    deleteRecords();
    listenFileUpload();
    validateForm();
});

//# sourceMappingURL=user-center.js.map
