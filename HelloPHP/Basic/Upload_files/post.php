<form action="" method="post">
    <input type="text" name="fullname" placeholder="Họ và tên">
    <input type="text" name="email" placeholder="Email">
    <button type="submit">Gửi</button>
</form>

<?php
echo '<pre>';
print_r($_POST);
echo '</pre>';