<?php
require_once 'connect.php';

$sql = 'delete from sinhvien where id = ?';
$id = 3;
try {
    $statement = $conn ->prepare($sql);
    $data =[$id];
    $result = $statement->execute($data);
if ($result) {
    $rowCount = $statement->rowCount();
    if ($rowCount > 0) {
        echo 'Xóa thành công';
    } else {
        echo 'Không có dòng nào được xóa';
    }
} else {
    $errorInfo = $statement->errorInfo();
    echo 'Lỗi: ' . $errorInfo[2];
}
} catch (Exception $e) {
    echo $e ->getMessage() .'<br>';
    echo 'file: '.$e->getFile();
    echo 'line: '.$e->getLine();
}