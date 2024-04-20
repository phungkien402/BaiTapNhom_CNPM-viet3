

$.ajax({
    url: BASE_URL+'/admin/requestAdmin?url=adminRequest/loai', // Đảm bảo đường dẫn chính xác đến file PHP
    type: 'POST',

    // Xử lý kết quả trả về từ file PHP
    success: function(response) {
      console.log('dữ liệu:', response);
        var dataGet = JSON.parse(response);
        console.log('dữ liệu:', dataGet);

        // Lấy thẻ select theo id
        var selectElement = $('#danhmucSelect');

        // Duyệt qua mảng dữ liệu và thêm từng tùy chọn vào thẻ select
        dataGet.forEach(function(item) {
            // Tạo một phần tử option
            var optionElement = $('<option>', {
                value: item.ten, // Giá trị của option
                text: item.ten, // Nội dung của option
                id_data : item.id,
                class: 'select_option',
            });

            // Thêm option vào thẻ select
            selectElement.append(optionElement);
        });

    },
    error: function(error) {
      console.error('Lỗi khi gửi dữ liệu:', error);
      // Xử lý lỗi nếu có
    }
  });