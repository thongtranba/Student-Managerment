<?php include "layout/header.php" ?>		
<h1>Danh Sach Môn Học</h1>
<a href="index.php?c=subject&a=add" class="btn btn-info">Add</a>
<!-- method GET trong form thì không đẩy được parameter (tham số) lên server, giải pháp là sử dụng lên thẻ hidden -->
<form action="index.php?c=subject" method="GET" class="pull-right">
    <label class="form-inline" >Tìm kiếm:<input type="search" name="search" class="form-control" value="<?=$search?>"></label>
    <input type="hidden" name="c" value="subject">
    <button class="btn btn-danger">Tìm</button>
</form>
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Mã MH</th>
            <th>Tên</th>
            <th>Số tín chỉ</th>
            <th colspan="2">Tùy Chọn</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $order = 0;
        foreach ($subjects as $subject): 
            $order++;
            ?>
            <tr>
                <td><?=$order?></td>
                <td><?=$subject->getId()?></td>
                <td><?=$subject->getName()?></td>
                <td><?=$subject->getNumberOfCredit()?></td>

                <td><a href="index.php?c=subject&a=edit&id=<?=$subject->getId()?>">Sửa</a></td>
                <td><a type="subject" data="<?=$subject->getId()?>" class="delete" href="index.php?c=subject&a=delete&id=<?=$subject->getId()?>">Xóa</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div>
    <span>Tổng số: <?=count($subjects)?></span>
</div>
<?php include "layout/footer.php" ?>           

