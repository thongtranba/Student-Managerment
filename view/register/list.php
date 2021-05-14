<?php include "layout/header.php" ?>		
<h1>Danh sách sinh viên đăng ký môn học</h1>
<a href="index.php?c=register&a=add" class="btn btn-info">Add</a>
<form action="index.php?c=register" method="GET" class="pull-right">
    <label class="form-inline" >Tìm kiếm:<input type="search" name="search" class="form-control" value="<?=$search?>"></label>
    <input type="hidden" name="c" value="register">
    <button class="btn btn-danger">Tìm</button>
</form>
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Mã SV</th>
            <th>Tên SV</th>
            <th>Mã MH</th>
            <th>Tên MH</th>
            <th>Điểm</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $order = 0;

        foreach ($registers as $register): 
            $order++;
            ?>
            <tr>
                <td><?=$order?></td>
                <td><?=$register->getStudentId()?></td>
                <td><?=$register->getStudentName()?></td>
                <td><?=$register->getSubjectId()?></td>
                <td><?=$register->getSubjectName()?></td>
                <td><?=$register->getScore()?></td>
                <td><a href="index.php?c=register&a=edit&student_id=<?=$register->getStudentId()?>&subject_id=<?=$register->getSubjectId()?>">Cập nhật điểm</a></td>
                <td><a  onclick="return confirm('Bạn muốn xóa môn học này phải không?')" href="index.php?c=register&a=delete&student_id=<?=$register->getStudentId()?>&subject_id=<?=$register->getSubjectId()?>">Xóa</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div>
    <span>Tổng số: <?=count($registers)?></span>
</div>


<?php include "layout/footer.php" ?>           

