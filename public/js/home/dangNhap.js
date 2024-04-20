function submitForm() {
  // Lấy form
  var form = document.getElementById("myForm");

  // Lấy các giá trị trường
  var name = document.querySelector('#phone');
  var pass = document.querySelector('#pass');

  // Trường confirm_password không tồn tại trong HTML, có thể yêu cầu người dùng nhập lại nếu cần

  // Xử lý các giá trị đã lấy được (ví dụ: gửi lên server)
  console.log(name);

  data = {
    name: name.value,
    pass: pass.value,
  }
  console.log(data);

  function reset(name){
    console.log("#"+name);
    var div = document.querySelector("#"+name);
    console.log(name,error);
    div.setAttribute('class', 'errorMess');
    div.innerHTML = "";
  }

  reset("error_phone");
  reset("error_pass");

  function error(name,error){
    if(error!=null){
      console.log(name,error);
      var div = document.querySelector("#"+name);
      console.log(div);
      div.setAttribute('class', 'errorMess');
      div.innerHTML = error;
    }
  }

  $.ajax({
    url: BASE_URL+'/home/requestHome?url=HomeRequest/dangNhap',
    type: 'POST',
    data: data, 

    // Xử lý kết quả trả về từ file PHP
    success: function(response) {
      console.log('dữ liệu:', response);
      // if(response == 'submit'){
      //   window.location.href = "../";
      // }else if(response == 'admin'){
      //   window.location.href = "../admin/index";
      if(response == 'kytu'){
        $mes = "các trường trên chỉ nhận các ký tự là: chữ, số, _, ?, @"
        error("error_pass",$mes);
      }else{
        var data = JSON.parse(response);
      //  console.log('dữ liệu:', data);
      //  console.log('dữ liệu:', data.level);
        if(data.level == 0){
          window.location.href = BASE_URL+"/admin/index?action=1";
        }
        else if(data.level > 0) {
          console.log('dữ liệu:', data);
          window.location.href = BASE_URL;
        }else{
          error("error_phone",data.name);
          error("error_pass",data.pass);
        }
      }
    },

    error: function(error) {
      console.error('Lỗi khi gửi dữ liệu:', error);
      // Xử lý lỗi nếu có
    }
  });

}