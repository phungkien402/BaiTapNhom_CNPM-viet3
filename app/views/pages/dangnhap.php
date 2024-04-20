<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    var BASE_URL = "<?php echo _WEB_ROOT; ?>"; // _WEB_ROOT được định nghĩa trong file cấu hình PHP của bạn
</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/dangnhap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="<?php echo _WEB_ROOT ?>/public/assets/icons/favicon.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="auth-form">
        <div class="auth-form_header">
            <a href="../home/index" class="fa fa-sharp fa-solid fa-arrow-left back-icon"></a>
            <p class="auth-form__heading">Đăng nhập</p>

        </div>
        <div id="myForm" class="auth-form_form">
            <div class="auth-form_group">
                <label for="email" class="form-label"><div class="label_heading" >SĐT/Email:</div>
                    <div class="form_group">
                        <input id="phone" type="text" name="phone" class="auth-form__input auth-form__input-username"
                            placeholder="Nhập SĐT/Email">
                        <div id=error_phone></div>
                    </div>
                </label>
            </div>
            <div class="auth-form_group">
                <label for="email" class="form-label"><div class="label_heading label_pwd">Mật khẩu:</div>
                    <div class="form_group">
                        <input id="pass" type="password" name="pass" class="auth-form__input auth-form__input-pwd"
                            placeholder="Nhập mật khẩu">
                        <div id=error_pass></div>
                    </div>
                </label>

            </div>
        </div>
        <div class="auth-form__controls">
            <button class="btn" onclick="submitForm()">Đăng Nhập</button>
        </div>
        <div class="auth-form__controls1">
            Bạn mới biết đến chúng tôi? <a class="link" href="<?php echo _WEB_ROOT ?>/home/dangky">Đăng ký</a></div>

    </div>
    <script src="<?php echo _WEB_ROOT ?>/public/js/home/dangNhap.js""></script>
    
</body>
</html>