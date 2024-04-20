function lietKe(data) {
  // console.log(data);
  var div = document.getElementById('table3');
  console.log(data);

  // Xóa nội dung hiện tại của div
  div.innerHTML = "";
  // Duyệt qua mảng dữ liệu và in ra
  console.log(data.length);
  for (var i = 0; i < data.length; i++) {
    var item = data[i];
      var itemDiv = document.createElement('tr');
      itemDiv.classList.add('product_list');

    // Thêm HTML vào thẻ div, có thể tùy chỉnh theo cấu trúc bạn muốn hiển thị
    itemDiv.innerHTML = `
    <td id='product_id' id-data='${item.id}' contenteditable="false" >${item.id}</td>
    <td id='product_name' id-data='${item.id}' contenteditable="false" >${item.name_item}</td>
    <td id='product_img'><img src= "${BASE_URL}/public/items/images/${item.image}" style='width:150px;'></td>
    <td id='product_price' id-data='${item.id}' contenteditable="false">${formatNumber(item.price)} VNĐ </td>
    <td id='product_quantity' id-data='${item.id}' contenteditable="false">${item.quantity}</td>
    <td id='product_tomtat' id-data='${item.id}' contenteditable="false">${item.tom_tat}</td>
      <td id='product_noidung' id-data='${item.id}' contenteditable="false">${item.noi_dung}</td>
      <td id='product_loai' id-data='${item.id}'>${item.loai}</td>
      <td id='product_quanly'>
      <button onclick='deteleForm(${item.id},confirm("Are you sure you want to delete?"))' class='btn btn-action' >Xoá</button>
      <button id-data="${item.id}" onclick='updateForm(${item.id},confirm("Are you sure you want to edit?"))' class='btn btn-action' >Sửa</button>
          </td>
      `;
    // Thêm thẻ div vào thẻ có id là 'div1'
    div.appendChild(itemDiv);
  }
}

function insertForm() {
  // Lấy form
  var form = document.getElementById("form");
  var dataform = new FormData();
  console.log(dataform.get);

 const inputElements = document.getElementsByTagName('input');

for (const inputElement of inputElements) {
  if (inputElement.tagName === 'INPUT') {
    const inputValue = inputElement.value;
    console.log(`Input value: ${inputValue}`);
  }
}

  // Lấy các giá trị trường
  var name_item = document.querySelector('#name_item');
  var id_item = document.querySelector('#id_item');
  var price = document.querySelector('#price');
  var quantity = document.querySelector('#quantity');
  var image = $("#image")[0].files[0];
  if(image == null){
    image = "";
  }
  var tom_tat = document.querySelector('#tom_tat');
  var noi_dung = document.querySelector('#noi_dung');
  var loai = document.querySelector('#danhmucSelect');
  console.log("-----------------------vvievivvv--------------------------");

  var op1 = loai.selectedOptions[0];
  var id_loai = op1.getAttribute('id_data');
  // console.log('da ra, anh toi day:'+id_loai);

  function them($name,$value=""){
    dataform.append($name, $value);
    // console.log(dataform.get($name).name);
  }

  them("name_item",name_item.value);
  them("id",id_item.value);
  them("price",price.value);
  them("quantity",quantity.value);
  them("image",image);
  them("tom_tat",tom_tat.value);
  them("noi_dung",noi_dung.value);
  them("loai",loai.value);
  them("id_loai",id_loai);

   // var formData = new FormData(form);
  console.log("\n-------------------------------\n");
  // Trường confirm_password không tồn tại trong HTML, có thể yêu cầu người dùng nhập lại nếu cần

  // Xử lý các giá trị đã lấy được (ví dụ: gửi lên server)
  for(const [key, value] of dataform.entries()) {
  // Kiểm tra xem biến hiện tại có phải là biến "image" hay không
      // Biến hiện tại là biến "image"
      // Lấy dữ liệu của biến "image"
      console.log(value);
  }
  console.log("\n-------------------------------\n");

  data = {
    id: id_item.value,
    name_item: name_item.value,
    image:image,
    price:price.value,
    quantity:quantity.value,
    tom_tat:tom_tat.value,
    noi_dung:noi_dung.value,
    loai:loai.value,
    id_loai:id_loai
  }

  function reset(name){
    if(name != null){
      console.log("#"+name);
      var div = document.querySelector("#"+name);
      console.log(name,error);
      if(div != null){
        div.setAttribute('class', 'errorMess');
        div.innerHTML = "";
    }
    }
  }

  console.log(data);
  for(const item in data){
    console.log(item);
    reset("error_"+item);
  }

  function error(name,error){
    if(error!=null){
      console.log(name,error);
      var div = document.querySelector("#"+name);
      console.log(div);
      if(div != null){
        div.setAttribute('class', 'errorMess');
        div.innerHTML = error;
    }
    }
  }

  $.ajax({
    url: BASE_URL+'/admin/requestAdmin?url=adminRequest/postItem', // Đảm bảo đường dẫn chính xác đến file PHP
    type: 'POST',
    data: dataform, 
    processData: false, // Ngăn chặn jQuery xử lý dữ liệu
    contentType: false,

    // Xử lý kết quả trả về từ file PHP
    success: function(response) {
      console.log('dữ liệu:', response);
      if(response == 'submit'){
        error("error_noi_dung","cap nhap thanh cong");
        window.window.location.href = "../admin/index?action=2";
      }else if(response == 'kytu'){
        $mes = "các trường trên chỉ nhân các chữ, số, _, ?, @"
        error("error_confirm_password",$mes);
      }else{
        var dataGet = JSON.parse(response);
        console.log('dữ liệu:', dataGet);
        if(dataGet != null){
        // console.log(name);
          for(var [key,value] of Object.entries(dataGet)){
            // console.log(key+"    "+value);
            error("error_"+key,value);
          }
        }
      }
    },
    error: function(error) {
      console.error('Lỗi khi gửi dữ liệu:', error);
      // Xử lý lỗi nếu có
    }
  });
}


function show() {
    console.log("anh show ra day");
    $.ajax({
      url: BASE_URL+'/admin/requestAdmin?url=adminRequest/item', // Đảm bảo đường dẫn chính xác đến file PHP
      type: 'GET',

      // Xử lý kết quả trả về từ file PHP
          success: function(response) {
            var dataGet = JSON.parse(response);
            console.log('dữ liệu:', dataGet);
            lietKe(dataGet);
          }
    });
  }
show();

function deteleForm(data1,bool){
  if(bool == true){
    data = {
      id : data1
    }

    $.ajax({
      url: BASE_URL+'/admin/requestAdmin?url=adminRequest/deleteItem', // Đảm bảo đường dẫn chính xác đến file PHP
      type: 'POST',
      data: data,

      // Xử lý kết quả trả về từ file PHP
          success: function(response) {
            show();
          }
            
    });
  }
}


function updateForm(data1,bool){
  var elementsWithIdData = document.querySelectorAll(`[id-data="${data1}"]`);
    var arr = {};
    var div = [];
    var j=0;
    for (const element of elementsWithIdData) {
      arr[j] = element.textContent;
      div.push(element);
      j++;
    }
    console.log("thuoc tinh: ====================================");
    console.log(div);
    console.log(arr);

  if(bool == false){
    for(var i=0;i<div.length-1;i++){
      div[i].setAttribute('contenteditable','false');
    }
    div[div.length].textContent = "Sửa";
    show();
  }else
  if(bool == true){
    if(div[0].getAttribute('contenteditable') == "false"){
      for(var i=0;i<div.length-1;i++){
        div[i].setAttribute('contenteditable','true');
      }
      div[div.length-1].textContent = "oke";
    }else{
      $.ajax({
      url: BASE_URL+'/admin/requestAdmin?url=adminRequest/updateItem', // Đảm bảo đường dẫn chính xác đến file PHP
      type: 'POST',
      data: arr,

      // Xử lý kết quả trả về từ file PHP
          success: function(response) {
            console.log('dữ liệu:', response);
          }
            
    });
    for(var i=0;i<div.length-1;i++){
        div[i].setAttribute('contenteditable','true');
      }
      div[div.length-1].textContent = "Sửa";
    show();
    }
  }
}
function formatNumber(number) {
  return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

