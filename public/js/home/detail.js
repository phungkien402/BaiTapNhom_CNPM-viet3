function lietKe(data) {
  var div = document.getElementById('div1');
  console.log(div);                              
}

var data = {'data' : 'v'};

$.ajax({
  url: BASE_URL+'/Home/requestHome?url=HomeRequest/detail', // Đảm bảo đường dẫn chính xác đến file PHP
  type: 'POST',
  data: data,

  // Xử lý kết quả trả về từ file PHP
  success: function(response) {
    console.log(response);
    var data = JSON.parse(response);
    console.log(data);
    lietKe(data);
  },
  error: function(error) {
    console.error('Lỗi khi gửi dữ liệu:', error);
    // Xử lý lỗi nếu có
  }
});