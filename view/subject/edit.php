<?php include "layout/header.php" ?> 
<h1>Chỉnh Sửa Môn Học</h1>


<form action="index.php?c=subject&a=update" method="POST" accept-charset="utf-8">
	<div class="container">
		<div class="row">
			<input type="hidden" name="id" value="<?=$subject->getID()?>">
			<div class="col-md-5">
				<div class="form-group">
					<div class="col">
						<label>Tên</label>
						<input type="text" class="form-control" placeholder="Tên của bạn" required name="name" value="<?=$subject->getName()?>">
					</div>
					
				</div>
				<div class="form-group">
					<label>Số tín chỉ</label>
					<input type="text" class="form-control" placeholder="Số tín chỉ" required name="number_of_credit" value="4<?=$subject->getNumberOfCredit()?>">
				<div class="form-group">
					<button class="btn btn-success" type="submit">Lưu</button>
				</div>
				
			</div>		
		</div>
	</div>
</form>
<?php include "layout/footer.php" ?> 