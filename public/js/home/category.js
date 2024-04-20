function lietKeH(data) {
  var div = document.getElementById('category');
  console.log(div);

  // Xóa nội dung hiện tại của div
  div.innerHTML = "";
  // Duyệt qua mảng dữ liệu và in ra
  console.log(data.length);
  for (var i = 0; i < data.length; i++) {
    var item = data[i];
      var itemDiv = document.createElement('li');
      itemDiv.classList.add('category-item');

    // Thêm HTML vào thẻ div, có thể tùy chỉnh theo cấu trúc bạn muốn hiển thị
    itemDiv.innerHTML = `
      <a class='category-item__link' onclick='searchLoai("${item.id}")'>${item.ten}</a>
      `;
    // Thêm thẻ div vào thẻ có id là 'div1'
    div.appendChild(itemDiv);
  }
}


$.ajax({
    url: BASE_URL+'/admin/requestAdmin?url=homeRequest/sidebarLoai', // Đảm bảo đường dẫn chính xác đến file PHP
    type: 'GET',

    // Xử lý kết quả trả về từ file PHP
    success: function(response) {
      console.log('dữ liệu:', response);
        var dataGet = JSON.parse(response);
        console.log(dataGet);
        lietKeH(dataGet);
    }
  });

