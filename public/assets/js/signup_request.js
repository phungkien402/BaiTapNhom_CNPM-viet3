function submitForm() {
    // Lấy thông tin từ các trường input
    const phone = document.querySelector('.auth-form__input-sdt').value;
    const email = document.querySelector('.auth-form__input-email').value;
    const password = document.querySelector('.auth-form__input-pwd').value;

    // Tạo một đối tượng FormData để gửi thông tin
    const formData = new FormData();
    formData.append('phone', phone);
    formData.append('email', email);
    formData.append('password', password);

    // Tạo một request AJAX để gửi dữ liệu đến request.php
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'request.php', true);
    xhr.onload = function() {
        // Xử lý phản hồi từ server nếu cần
        console.log(this.responseText);
    };
    xhr.send(formData);
}