<?php
require_once 'connect.php';

$sql = 'update sinhvien set fullname=:fullname,age=:age where id =:id';
$data = [
    'fullname' => 'Minh',
    'age' => 20,
    'id' => 100
];
try {
    $statement = $conn ->prepare($sql);

    // $statement -> bindParam(':fullname', $data['fullname']);
    // $statement -> bindParam(':age', $data['age']);
    // $statement -> bindParam(':id', $data['id']);

    $updateStatus = $statement ->execute($data);
    if($updateStatus){
        $rowCount = $statement->rowCount();
    if ($rowCount > 0) {
        echo 'Cập nhật thành công';
    } else {
        echo 'Cập nhật thất bại';
    }
    }
} catch (Exception $e) {
    echo $e ->getMessage() .'<br>';
    echo 'file: '.$e->getFile();
    echo 'line: '.$e->getLine();
}