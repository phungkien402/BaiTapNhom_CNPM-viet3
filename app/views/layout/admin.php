<script type="text/javascript">
    var BASE_URL = "<?php echo _WEB_ROOT; ?>"; // _WEB_ROOT được định nghĩa trong file cấu hình PHP của bạn
</script>

<?php
$this->render('blocks/adminHeader.php');
if(isset($_GET['action'])){
    $action = $_GET['action'];
    switch ($action){
        case 1:
            $this->render('admin/admin_qldanhmuc.php');
            $this->render('admin/admin_lietkedanhmuc.php');
            break;
        case 2: 
            $this->render('admin/admin_qlsanpham.php');
            $this->render('admin/admin_lietkesanpham.php');
            break;
        default:
            $this->render('admin/admin_qldanhmuc.php');
            
            break; 
    }
}    



?>