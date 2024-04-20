console.log(BASE_URL);
var url = BASE_URL+'/Home/requestHome?url=HomeRequest/session'
console.log(url);

$(document).ready(function () {
    var webRoot = $('html').data('web-root');
    $.ajax({
      url: url,
      type: 'GET',
      success: function (response) {
        var user = JSON.parse(response);
        if (user && user.name) {
          var dropdownMenu = `
            <div class="user-menu">
            <a href="#" class="shop__header__navbar-link-account"> <span class="account-avatar">🗿</span> ${user.name}</a>
              <ul class="dropdown-menu">
                <li><a href="${webRoot}/home/user">Tài khoản của tôi</a></li>
                <li><a href="${webRoot}/home/cart">Giỏ Hàng</a></li>
                <li><a href="#" id="logout">Đăng Xuất</a></li>
              </ul>
            </div>
          `;
  
          $('.shop__header__navbar-link-login-logout').hide();
          $('.shop__header__navbar-item').last().after(dropdownMenu);
  
          $('#logout').click(function (e) {
            e.preventDefault();
            $.ajax({
              url: BASE_URL+'/Home/requestHome?url=HomeRequest/logout',
              type: 'GET',
              success: function (response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                  location.reload();
                }
              },
              error: function (error) {
                console.error('Lỗi khi thực hiện đăng xuất:', error);
              }
            });
          });
          $('.user-menu').hover(function () {
            $(this).find('.dropdown-menu').show();
          }, function () {
            $(this).find('.dropdown-menu').hide();
          });
        }
      },
      error: function (error) {
        console.error('Lỗi khi gửi yêu cầu:', error);
      }
    });
  });