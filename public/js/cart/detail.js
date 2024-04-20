$.ajax({
    url: BASE_URL+'/admin/requestAdmin?url=homeRequest/showCart', // Đảm bảo đường dẫn chính xác đến file PHP
    type: 'GET',

    // Xử lý kết quả trả về từ file PHP
    success: function(response) {
      console.log('dữ liệu:', response);
        var dataGet = JSON.parse(response);
        console.log(dataGet);
        // lietKeH(dataGet);
    }
  });