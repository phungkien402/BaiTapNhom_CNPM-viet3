console.log(BASE_URL);


function formatPrice(price) {
  return price.toLocaleString('vi-VN');
}

function lietKe(data) {
  // console.log(data);
  var div = document.getElementById('div1');

  // Xóa nội dung hiện tại của div
  div.innerHTML = "";
  // Duyệt qua mảng dữ liệu và in ra
  for (var i = 0; i < data.length; i++) {
    var item = data[i];
    if(item.price != null){
      var formattedPrice = formatPrice(item.price );
    }
    // console.log(item.image);

    // Tạo một thẻ div để chứa thông tin của mỗi đối tượng
    var itemDiv = document.createElement('div');
    itemDiv.classList.add('grid__column-2-4');

    // Thêm HTML vào thẻ div, có thể tùy chỉnh theo cấu trúc bạn muốn hiển thị
    itemDiv.innerHTML = `
      <a style="text-decoration: none;" href="${BASE_URL}/home/detail?id=${item.id}">
          <div data-id="${item.id_item}" class="home-sanpham-item">
              <div id="image" class="home-sanpham-item-anh" style="Background-image:url(${item.image})">
              </div>
              <h4  class="home-sanpham-item-ten">${item.name_item}</h4>
              <div class="home-sanpham-item-gia">
              <span class="home-sanpham-item-gia-hientai">${formattedPrice}đ</span>
              </div>
              <div class="home-sanpham-item-tuongtac">
                  <div class="home-sanpham-item-tuongtac-danhgia">
                      <i class="home-sanpham-item-tuongtac-sao-vang fa-solid fa-star"></i>
                      <i class="home-sanpham-item-tuongtac-sao-vang fa-solid fa-star"></i>
                      <i class="home-sanpham-item-tuongtac-sao-vang fa-solid fa-star"></i>
                      <i class="home-sanpham-item-tuongtac-sao-vang fa-solid fa-star"></i>
                      <i class="fa-solid fa-star"></i>
                  </div>
                  <span class="home-sanpham-item-daban">99k đã bán</span>
              </div>
              <div class="home-sanpham-item-nguongoc">
                  <span class="home-sanpham-item-thuonghieu">Who</span>
                  <span class="home-sanpham-item-diachi">Nước ngoài</span>
              </div>
          </div>
      </a>
      `;
    // Thêm thẻ div vào thẻ có id là 'div1'
    div.appendChild(itemDiv);
  }
}



$.ajax({
  url: BASE_URL+'/Home/requestHome?url=HomeRequest/index',
  type: 'POST',
  error: function (error) {
    console.error('Lỗi khi gửi yêu cầu tìm kiếm:', error.responseText);
  },
  success: function (response) {
    // console.log(response);
    var data = JSON.parse(response);
    // console.log(data);
    lietKe(data);
  },
  error: function (error) {
    console.error('Lỗi khi gửi dữ liệu:', error);
  }
});

function timKiem() {
  var searchKeyword = document.getElementById('search').value.trim();
  if (searchKeyword === "") {
    $.ajax({
      url: BASE_URL+'/Home/requestHome?url=HomeRequest/index',
      type: 'GET',
      data: { allProducts: true },
      success: function (response) {
        var data = JSON.parse(response);
        // console.log(data);
        lietKe(data);
      },
      error: function (error) {
        console.error('Lỗi khi gửi yêu cầu tìm kiếm:', error);
      }
    });
  } else {
    $.ajax({
      url: BASE_URL+'/Home/requestHome?url=HomeRequest/search',
      type: 'POST',
      data: { name: searchKeyword },
      success: function (response) {
        var data = JSON.parse(response);
        console.log(data);
        lietKe(data);
      },
      error: function (error) {
        console.error('Lỗi khi gửi yêu cầu tìm kiếm:', error);
      }
    });
  }
}

// Sử dụng sự kiện submit của form để gọi hàm tìm kiếm
document.getElementById('searchForm').addEventListener('submit', function (event) {
  event.preventDefault(); // Ngăn chặn chuyển hướng trang
  if (event.submitter.id === 'searchBtn') {
    event.preventDefault(); // Ngăn chặn chuyển hướng trang
    // Gọi hàm tìm kiếm
    timKiem();
  }
});

// Bổ sung sự kiện click của nút tìm kiếm để gọi hàm tìm kiếm
document.getElementById('searchBtn').addEventListener('click', function () {
  // Gọi hàm tìm kiếm
  timKiem();
});

function sapXep(sortType) {
  $.ajax({
    url: BASE_URL+'/Home/requestHome?url=HomeRequest/search',
    type: 'POST',
    data: { sort: sortType },
    success: function (response) {
      var data = JSON.parse(response);
      console.log(data);
      lietKe(data);
    },
    error: function (error) {
      console.error('Lỗi khi gửi yêu cầu sắp xếp:', error);
    }
  });
}


//danh muc loai san pham
function searchLoai(data1){
  var data = {
    id : data1,
  }
  console.log(data);
  $.ajax({
    url: BASE_URL+'/Home/requestHome?url=HomeRequest/searchLoai',
    type: 'POST',
    data: data,
    success: function (response) {
      var data = JSON.parse(response);
      console.log(data);
      lietKe(data);
    },
    error: function (error) {
      console.error('Lỗi khi gửi yêu cầu sắp xếp:', error);
    }
  });
}

