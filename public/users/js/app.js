 app = {
    init() {
      // Tạo một nút để gửi dữ liệu
      button = document.createElement('button');
      button.textContent = 'Nhận dữ liệu';
      button.addEventListener('click', this.sendData);
       div = document.createElement('div');
      var bien = document.getElementById('data');
      document.write("dffdssfsdfsfd");
    },
  
    sendData() {
      // Tạo một đối tượng JSON chứa dữ liệu cần gửi
       data = {
        name: 'vietgioi12',
        email: 'vietgioi12@gmail.com',
        pass: '12345678',
        confirm_password: '12345678'
        
      };
  
      // Gửi dữ liệu đến file PHP bằng AJAX
      $.ajax({
        url: 'home/requestHome?url=HomeRequest/dangNhap', // Đảm bảo đường dẫn chính xác đến file PHP
        type: 'POST',
        data: data, 

        // Xử lý kết quả trả về từ file PHP
        success: function(response) {
          // Chuyển trang đến trang `/about`
          // location.href = 'home/detail';
          console.log('dữ liệu:', response);
          document.getElementById('data').innerHTML = "hello word";

        },
  
        error: function(error) {
          console.error('Lỗi khi gửi dữ liệu:', error);
          var data = 
          // Xử lý lỗi nếu có
        }
      });
    },
  };
  
  app.init();
  app.sendData();
  