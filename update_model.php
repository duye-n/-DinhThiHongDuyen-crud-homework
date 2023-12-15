
<?php
require_once './database/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['email']) && !empty($_POST['image_url'])) {
    // Gọi hàm tạo học sinh mới
    if(updateStudent($_GET['id'],$_POST)){
        header('location: index.php');
    }
} else {
    echo 'lỗi';
};
?>