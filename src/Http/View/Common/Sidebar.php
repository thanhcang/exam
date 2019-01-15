<div class="col-md-3 side-bar">
    <div class="sb-image">
        <img src="http://www.haegroup.com/wp-content/uploads/2014/10/logo-hae-group-large.png">
        <span class="sb-separate"></span>
        <span class="sp-title">Guestbook</span>
    </div>
    <div class="sb-intro">
        <p>
            Feel free to leave us a short message to tell us what you think our services.
        </p>
    </div>
    <div class="sb-post">
        <button data-url="<?php echo renderHref('guest/post-message'); ?>" class="btn btn-danger js-post-message">Post a message</button>
    </div>
    <div class="sb-admin-login">
        <?php
        /**
         * @var \Src\Models\UserModel $userInfo
         */
        if ($userInfo): ?>
            Hello <span class="text-info"><?= $userInfo->getFirstName() ?><?= $userInfo->getLastName() ?></span>
            <a href="<?= renderHref('user/logout'); ?>">
                <button class="btn btn-info">Logout</button>
            </a>
        <?php else: ?>
            <a class="js-admin-login" href="javascript:void()" data-url="<?= renderHref('user/login'); ?>">Admin Login</a>
        <?php endif ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.js-admin-login').on('click', function (e) {
            e.preventDefault()
            let url            = $(this).data('url')
            let loginTempplate =
                    `<form id="modal-login">
                        <div class="error"></div>
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" id="email" class="form-control" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                          <label for="pwd">Password:</label>
                          <input type="password" id="pwd" class="form-control" placeholder="Enter password" name="password">
                        </div>
                     </form>`;

            let bModal = new _modal({
                title          : "Admin Login",
                body           : loginTempplate,
                buttonConfirms : {
                    show     : true,
                    label    : "Login",
                    domClass : 'js-modal-admin-login'
                },
                style          : {
                    width : '600px'
                }
            });
            bModal.open();
            $('.js-modal-admin-login').on('click', function (e) {
                e.preventDefault();
                $("#modal-login").find('.error').html('');
                let params = {
                    email    : $("#email").val(),
                    password : $("#pwd").val()
                };
                $.ajax({
                    type     : "POST",
                    url      : url,
                    data     : params,
                    dataType : "json",
                    async    : false,

                    beforeSend : function () {
                        $('.js-modal-admin-login').html('<span><i class="fa fa-spin fa-spinner"></i></span>');
                    },
                    complete   : function () {
                        $('.js-modal-admin-login').html('Login');
                    },
                    success    : function (data) {
                        if (!data.validate) {
                            $.each(data.errors, function (index, value) {
                                $("#modal-login").find('.error').append(`<p>${value}</p>`);
                            });
                        } else {
                            bModal.close();
                            setTimeout(function () {
                                let _infoModal = new _modal({
                                    title : "Leave us a short message",
                                    body  : '<p>Login Success</p>',
                                    style : {
                                        width : '500px'
                                    }
                                });
                                _infoModal.open();

                                window.location.href = '/';
                            }, 500);
                        }
                    }
                });
            });
        });
        $('.js-post-message').on('click', function (e) {
            e.preventDefault();
            let url                  = $(this).data('url');
            let postMessageTempplate =
                    `<form id="modal-post-message">
                        <div class="error"></div>
                        <div class="form-group">
                          <label for="user_name">UserName:</label>
                          <input type="text" id="user_name" class="form-control" placeholder="Enter your name" name="user_name">
                        </div>
                        <div class="form-group">
                          <label for="pwd">Message:</label>
                          <textarea class="form-control" id="message" name="message" rows="10"></textarea>
                        </div>
                     </form>`;

            let bModal = new _modal({
                title          : "Leave us a short message",
                body           : postMessageTempplate,
                buttonConfirms : {
                    show     : true,
                    label    : "Post",
                    domClass : 'js-modal-post-message'
                }
            });
            bModal.open();

            $('.js-modal-post-message').on('click', function (e) {
                e.preventDefault();
                $("#modal-post-message").find('.error').html('');
                let params = {
                    userName : $('#user_name').val(),
                    message  : $('#message').val()
                };

                $.ajax({
                    type     : "POST",
                    url      : url,
                    data     : params,
                    dataType : "json",
                    async    : false,

                    beforeSend : function () {
                        $('.js-modal-post-message').html('<span><i class="fa fa-spin fa-spinner"></i></span>');
                    },
                    complete   : function () {
                        $('.js-modal-post-message').html('Post');
                    },
                    success    : function (data) {
                        if (!data.validate) {
                            $.each(data.errors, function (index, value) {
                                $("#modal-post-message").find('.error').append(`<p>${value}</p>`);
                            });
                        } else {
                            bModal.close();
                            setTimeout(function () {
                                let _infoModal = new _modal({
                                    title : "Leave us a short message",
                                    body  : '<p>Thanks you about your message</p>',
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

            })

        });
    });
</script>