<?php include "layout/header.php" ?> 
<h1>Cập nhật điểm</h1>
           <!-- <?php var_dump($register) ?> -->
            <form action="index.php?c=register&a=update" method="POST">
                <input type="hidden" name="student_id" value="<?=$register->getStudentId()?>">
                <input type="hidden" name="subject_id" value="<?=$register->getSubjectId()?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Tên sinh viên</label>
                                <span><?=$register->getStudentName()?></span>
                            </div>
                            <div class="form-group">
                                <label>Tên môn học</label>
                                <span><?=$register->getSubjectName()?></span>
                            </div>
                            <div class="form-group">
                                <label for="score">Điểm</label>
                                <input type="text" name="score" id="score" value="<?=$register->getScore()?>">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
<?php include "layout/footer.php" ?> 