function submitForm() {
  // Lấy form
  var form = document.getElementById("myForm");

  // Lấy các giá trị trường
  var name = document.querySelector('#phone');
  var pass = document.querySelector('#password');
  var email = document.querySelector('#email');
  var con_passwrod = document.querySelector('#confirm_password');

  // Trường confirm_password không tồn tại trong HTML, có thể yêu cầu người dùng nhập lại nếu cần

  // Xử lý các giá trị đã lấy được (ví dụ: gửi lên server)

  data = {
    name: name.value,
    email: email.value,
    pass: pass.value,
    confirm_password: con_passwrod.value,
  }
  console.log(data);

  function reset(name){
    console.log("#"+name);
    var div = document.querySelector("#"+name);
    console.log(name,error);
    div.setAttribute('class', 'errorMess');
    div.innerHTML = "";
  }

  reset("error_name");
  reset("error_email");
  reset("error_pass");
  reset("error_confirm_password");

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
    url: BASE_URL+'/home/requestHome?url=HomeRequest/dangKy', // Đảm bảo đường dẫn chính xác đến file PHP
    type: 'POST',
    data: data, 

    // Xử lý kết quả trả về từ file PHP
    success: function(response) {
      console.log('dữ liệu:', response);
      if(response == 'submit'){
        window.location.href = "../home/dangNhap";
      }else if(response == 'kytu'){
        $mes = "các trường trên chỉ nhân các chữ, số, _, ?, @"
        error("error_confirm_password",$mes);
      }else{
        var data = JSON.parse(response);
        console.log('dữ liệu:', data);
        // console.log(name);
        error("error_name",data.name);
        error("error_email",data.email);
        error("error_pass",data.pass);
        error("error_confirm_password",data.confirm_password);
      }
    },

    error: function(error) {
      console.error('Lỗi khi gửi dữ liệu:', error);
      // Xử lý lỗi nếu có
    }
  });

}