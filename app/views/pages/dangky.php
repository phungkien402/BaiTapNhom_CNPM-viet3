<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    var BASE_URL = "<?php echo _WEB_ROOT; ?>"; // _WEB_ROOT được định nghĩa trong file cấu hình PHP của bạn
</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/icons/themify-icons/themify-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/dangky.css">
    <link rel="shortcut icon" href="<?php echo _WEB_ROOT ?>/public/assets/icons/favicon.png" type="image/x-icon">
</head>

<body>
    <div class="auth-form">
        <div class="auth-form_header">
            <a href="<?php echo _WEB_ROOT ?>/home/index" class="fa fa-sharp fa-solid fa-arrow-left back-icon"></a>
            <p class="auth-form__heading">Đăng ký</p>
        </div>
        <div class="auth-form_form" id="myForm">
            <div class="auth-form_form">
                <div class="auth-form_group">
                    <label class="form-label">
                        <div class="form_group">
                            <i class="form-icon ti-mobile"></i>
                            <input id="phone" type="text" class="auth-form__input auth-form__input-sdt" name="phone"
                                required placeholder="Số điện thoại" aria-autocomplete="none">
                        </div>
                        <div id="error_name"></div>
                    </label>
                </div>
                <div class="auth-form_group">
                    <label class="form-label">
                        <div class="form_group">
                            <i class="form-icon ti-email"></i>
                            <input id="email" type="email" class="auth-form__input auth-form__input-email" name="email"
                                required placeholder="Email">
                        </div>
                        <div id="error_email"></div>
                    </label>
                </div>
                <div class="auth-form_group">
                    <label class="form-label">
                        <div class="form_group">
                            <i class="form-icon ti-lock"></i>
                            <input id="password" type="password" class="auth-form__input auth-form__input-pwd"
                                name="password" required placeholder="Mật khẩu">
                        </div>
                        <div id="error_pass"></div>
                    </label>
                </div>
                <div class="auth-form_group">
                    <label class="form-label">
                        <div class="form_group">
                            <i class="form-icon ti-lock"></i>
                            <input id="confirm_password" type="password" class="auth-form__input auth-form__input-pwd"
                                name="confirm_password" required placeholder="Nhâp lại mật khẩu">
                        </div>
                        <div id="error_confirm_password"></div>
                    </label>
                </div>
            </div>
            <div class="auth-form__controls">
                <button type="submit" onclick="submitForm()" class="btn">Đăng Ký</button>
            </div>
        </div>
        <!-- <script src="<?php echo _WEB_ROOT ?>/public/assets/js/signup_request.js"></script> -->
        <script src="<?php echo _WEB_ROOT ?>/public/js/home/dangKy.js"></script>
        <div class="auth-form__controls1">
            Đã có tài khoản?
            <a class="link" href="<?php echo _WEB_ROOT ?>/home/dangNhap">Đăng nhập</a>
        </div>

    </div>


</body>

</html>