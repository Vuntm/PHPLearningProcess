<?php
$title = ['pageTitle'=>'Danh sách người dùng'];
layouts('header', $title);
if(!isLogin()){
    redirect('?module=auth&action=login');
}
$listUsers = getAll("select * from users");

$errors = getFlashData('errors');
$old = getFlashData('old');
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>

<div class="container">
    <hr>
    <h2>Quản lý người dùng</h2>
    <p><a href="?module=users&action=add" class="btn btn-success btn-sm">Thêm người dùng <i class="fa-solid fa-plus"></i></a></p>
    <?php
        if(!empty($msg)){
           getSmg($msg,$msg_type);
        }
    ?><table class="table table-bordered">
    <thead>
        <th class="text-center">STT</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th class="text-center">Trạng thái</th>
        <th class="text-center">Hành động</th>
    </thead>
    <tbody>
        <?php
        IF(!empty($listUsers)):
        $count = 0;
            foreach($listUsers as $item):
                $id=$item['id'];
                $count++;
        ?>
        <tr>
            <td class="text-center"><?php echo $count; ?></td>
            <td><?php echo $item['fullname']?></td>
            <td><?php echo $item['email']?></td>
            <td><?php echo $item['phone']?></td>
            <td class="text-center"><?php echo $item['status']==1?"<a href="._WEB_HOST."/?module=users&action=statusChanger&id=$id"." class='btn btn-success btn-sm'><i class='fa-solid fa-toggle-on'></i></a>":"<a href="._WEB_HOST."/?module=users&action=statusChanger&id=$id"." class='btn btn-danger btn-sm'><i class='fa-solid fa-toggle-off'></i></a>"?></td>
            <td class="text-center">
                <a href="<?php echo _WEB_HOST?>/?module=users&action=edit&id=<?php echo $item['id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="<?php echo _WEB_HOST?>/?module=users&action=delete&id=<?php echo $item['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></i></a>
            </td>
        </tr>
        <?php endforeach;
        else:
            ?>
            <tr>
            <td colspan = "7"><div class="alert alert-danger text-center">Không có người dùng nào</div></td>
            </tr>
            <?php
        endif;
        ?>
    </tbody>
    </table>
</div>

<?php
layouts("footer");
?>