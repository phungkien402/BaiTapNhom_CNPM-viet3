function lietKe(data) {
  // console.log(data);
  var div = document.getElementById('table2');
  console.log(data);

  // Xóa nội dung hiện tại của div
  div.innerHTML = "";
  // Duyệt qua mảng dữ liệu và in ra
  console.log(data.length);
  for (var i = 0; i < data.length; i++) {
    var item = data[i];
    var itemDiv = document.createElement('tr');
    itemDiv.classList.add('category_list');

    // Thêm HTML vào thẻ div, có thể tùy chỉnh theo cấu trúc bạn muốn hiển thị
    itemDiv.innerHTML = `
      <td> <span id-data="${item.id}" contenteditable="false">${item.id}</span></td>
      <td> <span id-data="${item.id}" contenteditable="false">${item.ten}</span> </td>
      <td>
      <button id = 'delete' class= 'btn btn-action' id-data="${item.id}" onclick='deteleForm(${item.id},confirm("Are you sure you want to delete?"))'>Xoá</button>
      <button id = 'edit' class= 'btn btn-action' id-data="${item.id}" onclick='updateForm(${item.id},confirm("Are you sure you want to edit?"))'>Sửa</button>
      </td>
      </tr>
      `;
    // Thêm thẻ div vào thẻ có id là 'div1'
    div.appendChild(itemDiv);
  }
}





function insertForm() {
  // Lấy các giá trị trường
  var tendanhmuc = document.querySelector('#tendanhmuc');
  var madanhmuc = document.querySelector('#madanhmuc');
  data = {
    id: madanhmuc.value,
    ten: tendanhmuc.value
  }

  function reset(name) {
    console.log("#" + name);
    if (name != null) {
      var div = document.querySelector("#" + name);
      console.log(name, error);
      if (div != null) {
        div.setAttribute('class', 'errorMess');
        div.innerHTML = "";
      }
    }
  }

  console.log(data);
  for (const item in data) {
    console.log(item);
    reset("error_" + item);
  }

  function error(name, error) {
    if (error != "") {
      console.log(name, error);
      if (name != null) {
        var div = document.querySelector("#" + name);
        console.log(div);
        if (div != null) {
          div.setAttribute('class', 'errorMess');
          div.innerHTML = error;
        }
      }
    }
  }
  console.log(data);

  $.ajax({
    url: BASE_URL + '/admin/requestAdmin?url=adminRequest/insertLoai', // Đảm bảo đường dẫn chính xác đến file PHP
    type: 'POST',
    data: data,

    // Xử lý kết quả trả về từ file PHP
    success: function (response) {
      console.log('dữ liệu:', response);
      if (response == 'submit') {
        error("error_madanhmuc", "cap nhap thanh cong");
        window.window.location.href = "";
      } else if (response == 'kytu') {
        $mes = "các trường trên chỉ nhân các chữ, số, _, ?, @"
        error("error_confirm_password", $mes);
      } else {
        console.log('dữ liệu:', dataGet);
        var dataGet = JSON.parse(response);
        if (dataGet != null) {
          // console.log(name);
          for (var key in dataGet) {
            console.log("--------------------------------");
            console.log(key + " ghjf         " + dataGet[key]);
            error("error_" + key, dataGet[key]);
          }
        }
      }
    },
    error: function (error) {
      console.error('Lỗi khi gửi dữ liệu:', error);
      // Xử lý lỗi nếu có
    }
  });
}

function deteleForm(data1, bool) {
  if (bool == true) {
    data = {
      id: data1
    }

    $.ajax({
      url: BASE_URL + '/admin/requestAdmin?url=adminRequest/deleteLoai', // Đảm bảo đường dẫn chính xác đến file PHP
      type: 'POST',
      data: data,

      // Xử lý kết quả trả về từ file PHP
      success: function (response) {
        show();
      }

    });
  }
}

function show() {
  console.log("anh show ra day");
  $.ajax({
    url: BASE_URL + '/admin/requestAdmin?url=adminRequest/Loai', // Đảm bảo đường dẫn chính xác đến file PHP
    type: 'GET',

    // Xử lý kết quả trả về từ file PHP
    success: function (response) {
      var dataGet = JSON.parse(response);
      console.log('dữ liệu:', dataGet);
      lietKe(dataGet);
    }
  });
}
show();


function updateForm(data1, bool) {
  var elementsWithIdData = document.querySelectorAll(`[id-data="${data1}"]`);
  var arr = [];
  var div = [];
  for (const element of elementsWithIdData) {
    arr.push(element.textContent);
    div.push(element);
  }
  console.log(div);
  console.log(arr);

  if (bool == false) {
    div[0].setAttribute('contenteditable', 'false');
    div[1].setAttribute('contenteditable', 'false');
    div[2].textContent = "Sửa";
    show();
  } else
    if (bool == true) {
      if (div[0].getAttribute('contenteditable') == "false") {
        div[0].setAttribute('contenteditable', 'true');
        div[1].setAttribute('contenteditable', 'true');
        div[2].style.display = 'none';
        div[3].textContent = "oke";
      } else {
        data = {
          id: arr[0],
          ten: arr[1],
        }

        $.ajax({
          url: BASE_URL + '/admin/requestAdmin?url=adminRequest/updateLoai', // Đảm bảo đường dẫn chính xác đến file PHP
          type: 'POST',
          data: data,

          // Xử lý kết quả trả về từ file PHP
          success: function (response) {
            console.log('dữ liệu:', response);
          }

        });
        div[0].setAttribute('contenteditable', 'false');
        div[1].setAttribute('contenteditable', 'false');
        div[2].textContent = "Sửa";
        show();
      }
    }
}
document.getElementById('edit').addEventListener('click', function() {
  document.getElementById('delete').style.display = 'none';
});