<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Danh sách sinh viên</title>
        <link rel="stylesheet" href="public/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../public/css/css.css">
    </head>
    <body>
        <?php global $c; ?>
        <div class="container" style="margin-top:20px">
            <a href="index.php?c=student" class="<?=$c=="student" ? "active":""?> btn btn-info">Students</a>
            <a href="index.php?c=subject" class="<?=$c=="subject" ? "active":""?> btn btn-info">Subject</a>
            <a href="index.php?c=register" class="<?=$c=="register" ? "active":""?> btn btn-info">Register</a>
            <a href="index.php?c=student&a=import" class="<?=$a=="import" ? "active" : ""?> btn btn-info">Import Student</a>
            <div style="height:20px;">
                <div class="error bg-danger container-fluid text-center form-group">
                <?=!empty($_SESSION["error"]) ? $_SESSION["error"] : "" ?>
                <?php unset($_SESSION["error"]) ?>
            </div>
            <div class="message bg-primary container-fluid text-center form-group">
                <?=!empty($_SESSION["message"]) ? $_SESSION["message"] : "" ?>
                <?php unset($_SESSION["message"]) ?>
            </div>
            </div>