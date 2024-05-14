<?php
$title = [
    'pageTitle' => 'Đăng ký',
];
layouts('header', $title);
$listTodo = getAll("select * from task where status = 0");
$listDoing = getAll("select * from task where status = 1");
$listComplete = getAll("select * from task where status = 2");
$listCancel = getAll("select * from task where status = 3");

if(isPost()){
$filterAll = filter();


$data = [
    "title" => $title = $filterAll['title'],
    "user_id" => 0,
    "description" => $des = $filterAll['des'],
    "end_date" => $date = $filterAll['myDate'] . ' '. $filterAll['myTime'],
    "priority" => $priority = $filterAll['priority'],
    "status" => 0,
    "created_at" => date("m-d-Y H:i:s")
];



    $insert = insert('task',$data);     
    print_r($insert);
        die();
    if ($insert) {
        var_dump($insert);
        die();
        redirect('?module=home&action=todolist');
    }else{
        redirect('?module=home&action=dashboard');
    }
}


?>

<h2 class="text-center text-uppercase">To-do list</h2>
<table class="table-bordered" style="margin: 50px auto;">
    <thead>
        <th>PLAN</th>
        <th>DOING</th>
        <th>COMPLETE</th>
        <th>CANCLE</th>
    </thead>
    <tbody>
        <td>
                <table class="table">
                    <tbody>
                        <?php
                    IF(!empty($listTodo)):
                        $count = 0;
                            foreach($listTodo as $item):
                                $id=$item['id'];
                                $count++;                            ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $item['title']; ?></td>
                                    <td><?php echo $item['description']; ?></td>
                                    <td><?php echo $item['end_date']; ?></td>
                                    <td><?php 
                                     if ($item['priority'] == 0) {
                                        echo "<p class='btn btn-danger'>Cao</p>";
                                      } elseif ($item['priority'] == 1) {
                                        echo "<p class='btn btn-warning'>Trung bình</p>";
                                      } else {
                                        echo "<p class='btn btn-success'>Thấp</p>";
                                      } ?></td>
                                    <td><p><a href=""><i class="fa-solid fa-forward"></i></a></p>
                                        <p><a href=""><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a></p></td>
                                </tr>
                            <?php endforeach;
                                else:
                            ?>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table> 
            </td>    
            <td>    
                <table class="table">
                    <tbody>
                        <?php
                    IF(!empty($listDoing)):
                    $count = 0;
                        foreach($listDoing as $item):
                            $id=$item['id'];
                            $count++;                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $item['title']; ?></td>
                                <td><?php echo $item['description']; ?></td>
                                <td><?php echo $item['end_date']; ?></td>
                                <td><?php 
                                 if ($item['priority'] == 0) {
                                    echo "<p class='btn btn-danger'>Cao</p>";
                                  } elseif ($item['priority'] == 1) {
                                    echo "<p class='btn btn-warning'>Trung bình</p>";
                                  } else {
                                    echo "<p class='btn btn-success'>Thấp</p>";
                                  } ?></td>
                                <td><p><a href=""><i class="fa-solid fa-forward"></i></a></p>
                                        <p><a href=""><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a></p></td>
                                </tr>
                        <?php endforeach;
                                else:
                            ?>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </td>    
            <td>
                <table class="table">
                    <tbody>
                        <?php
                    IF(!empty($listComplete)):
                    $count = 0;
                        foreach($listComplete as $item):
                            $id=$item['id'];
                            $count++;                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $item['title']; ?></td>
                                <td><?php echo $item['description']; ?></td>
                                <td><?php echo $item['end_date']; ?></td>
                                <td><?php 
                                 if ($item['priority'] == 0) {
                                    echo "<p class='btn btn-danger'>Cao</p>";
                                  } elseif ($item['priority'] == 1) {
                                    echo "<p class='btn btn-warning'>Trung bình</p>";
                                  } else {
                                    echo "<p class='btn btn-success'>Thấp</p>";
                                  } ?></td>
                                <td><p><a href=""><i class="fa-solid fa-forward"></i></a></p>
                                        <p><a href=""><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a></p></td>
                                </tr>
                        <?php endforeach;
                                else:
                            ?>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </td>
            <td>
                <table class="table">
                    <tbody>
                        <?php
                    IF(!empty($listCancel)):
                    $count = 0;
                        foreach($listCancel as $item):
                            $id=$item['id'];
                            $count++;                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $item['title']; ?></td>
                                <td><?php echo $item['description']; ?></td>
                                <td><?php echo $item['end_date']; ?></td>
                                <td><?php 
                                 if ($item['priority'] == 0) {
                                    echo "<p class='btn btn-danger'>Cao</p>";
                                  } elseif ($item['priority'] == 1) {
                                    echo "<p class='btn btn-warning'>Trung bình</p>";
                                  } else {
                                    echo "<p class='btn btn-success'>Thấp</p>";
                                  } ?></td>
                                <td><p><a href=""><i class="fa-solid fa-forward"></i></a></p>
                                        <p><a href=""><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a></p></td>
                                </tr>
                        <?php endforeach;
                                else:
                            ?>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>        
<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <form action="" method='post'>
        <div class="form-group mg-form">
                <label for="fullname">Tiêu đề</label>
                <input name="title" type="text" class="form-control" placeholder="Nhập tiêu đề" >
            </div>
            <div class="form-group mg-form">
                <label for="email">Mô tả</label>
                <input name="des" type="text" class="form-control" placeholder="Nhập mô tả">
           </div>
            <div class="form-group mg-form">
                <label for="email">Ngày kết thúc</label>
                <input name="myDate" type="date">
                <input name="myTime" type="time">
               
            </div>
            <div class="form-group mg-form">
                <label for="password">Mức độ ưu tiên</label>
                <select name="priority">
                    <option id="" value = "0">Cao</option>
                    <option id="" value = "1>">Trung bình</option>
                    <option id="" value = "2">Thấp</option>
                </select>
            </div>
            <button type="submit" class="mg-form btn btn-primary btn-block">Add</button>
            <hr>
        </form>
    </div>
</div>

<?php
layouts('footer');


