<?php include "layout/header.php" ?>		
            <h1>Danh sách sinh viên</h1>
            <a href="index.php?c=student&a=add" class="btn btn-info">Add</a>
            <form action="index.php" method="GET" class="pull-right">
                <label class="form-inline" >Tìm kiếm:<input type="search" name="search" class="form-control" value="<?=$search?>"></label>
                <button class="btn btn-danger">Tìm</button>
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã SV</th>
                        <th>Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Giới Tính</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $order = 0;
                    foreach ($students as $student): 
                        $order++;
                    ?>
                    <tr>
                        <td><?=$order?></td>
                        <td><?=$student->getId()?></td>
                        <td><?=$student->getName()?></td>
                        <td><?=$student->getFormatBirthday()?></td>
                        <td><?=$student->getGenderName()?></td>
                        <td><a href="index.php?c=student&a=edit&id=<?=$student->getId()?>">Sửa</a></td>
                        <td><a type="student" data="<?=$student->getId()?>" class="delete" href="index.php?c=student&a=delete&id=<?=$student->getId()?>">Xóa</a></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div>
                <span>Tổng số: <?=count($students)?></span>
            </div>
 <?php include "layout/footer.php" ?>           

