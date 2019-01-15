<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php include(__DIR__ . '/../Common/Sidebar.php') ?>
            <div class="col-md-8 article ">
                <?php foreach ($guestBooks as $index): ?>
                    <div class="col-md-6 ">
                        <?php
                        /**
                         * @var \Src\Models\MessageModel $item
                         */
                        foreach ($index as $item):
                            ?>
                            <div class="card">
                                <p><?= $item->getMessage(); ?></p>
                                <span class="author"><?= $item->getAuthor(); ?></span>
                                <span class="date"><?php $date = date_create($item->getDateCreated());
                                    echo date_format($date, 'd S M, Y \a\t H:i a') ?></span>
                                <?php
                                /**
                                 * @var \Src\Models\UserModel $userInfo
                                 */
                                if ($userInfo && $userInfo->isAdmin()):?>
                                    <button data-url="<?= renderHref("admin/delete/message/{$item->getId()}") ?>" class="btn btn-danger btn-circle js-message-remove"><i class="fa fa-remove"></i>
                                    </button>
                                    <button data-message="<?= $item->getMessage(); ?>"
                                            data-url="<?= renderHref("admin/edit/message/{$item->getId()}") ?>"
                                            class="btn btn-danger btn-circle js-edit"><i
                                            class="fa fa-edit"></i></button>
                                <?php endif ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.js-message-remove').on('click', function (e) {
            e.preventDefault();
            let url = $(this).data('url');

            let bModal = new _modal({
                title          : "Remve message",
                body           : '<p>Do you want remove this message </p>',
                buttonConfirms : {
                    show     : true,
                    label    : "Delete",
                    domClass : 'js-modal-remove-message'
                },
                style          : {
                    width : '500px'
                }
            });

            bModal.open();

            $('.js-modal-remove-message').on('click', function (e) {
                e.preventDefault();

                $.ajax({
                    type     : "DELETE",
                    url      : url,
                    data     : {},
                    dataType : "json",
                    async    : false,

                    beforeSend : function () {
                        $('.js-modal-post-message').html('<span><i class="fa fa-spin fa-spinner"></i></span>');
                    },
                    complete   : function () {
                        $('.js-modal-post-message').html('');
                    },
                    success    : function (data) {
                        bModal.close();

                        let message = "Message was deleted";
                        if (!data.validate) {
                            message = data.errors;
                        }

                        setTimeout(function () {
                            let _infoModal = new _modal({
                                title : "Remove message",
                                body  : `<p>${message}</p>`,
                                style : {
                                    width : '500px'
                                }
                            });
                            _infoModal.open();
                        }, 500);

                        setTimeout(function () {
                            window.location.href = '/';
                        }, 2000);
                    }
                });

            })

        })

        $('.js-edit').on('click', function (e) {
            e.preventDefault();
            let url                  = $(this).data('url')
            let message              = $(this).data('message');
            let postMessageTempplate =
                    `<form id="modal-edit-message">
                        <div class="error"></div>
                        <div class="form-group">
                          <label for="pwd">Message:</label>
                          <textarea class="form-control" id="model_message" name="message" rows="10">${message}</textarea>
                        </div>
                     </form>`;

            let bModal = new _modal({
                title          : "Leave us a short message",
                body           : postMessageTempplate,
                buttonConfirms : {
                    show     : true,
                    label    : "Edit",
                    domClass : 'js-modal-edit-message'
                }
            });
            bModal.open();

            $('.js-modal-edit-message').on('click', function (e) {
                e.preventDefault();
                $("#modal-edit-message").find('.error').html('');
                let params = {
                    message : $('#model_message').val()
                };
                $.ajax({
                    type     : "POST",
                    url      : url,
                    data     : params,
                    dataType : "json",
                    async    : false,

                    beforeSend : function () {
                        $('.js-modal-edit-message').html('<span><i class="fa fa-spin fa-spinner"></i></span>');
                    },
                    complete   : function () {
                        $('.js-modal-edit-message').html('Edit');
                    },
                    success    : function (data) {
                        if (!data.validate) {
                            $.each(data.errors, function (index, value) {
                                $("#modal-edit-message").find('.error').append(`<p>${value}</p>`);
                            });
                        } else {
                            bModal.close();
                            let message = "Message was edited";

                            setTimeout(function () {
                                let _infoModal = new _modal({
                                    title : "Edit message",
                                    body  : `<p>${message}</p>`,
                                    style : {
                                        width : '500px'
                                    }
                                });
                                _infoModal.open();

                            }, 500);

                            setTimeout(function () {
                                window.location.href = '/';
                            }, 2000);
                        }
                    }
                });
            });

        });

    });
</script>