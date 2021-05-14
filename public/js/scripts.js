$("#student_id").change(function(event) {
	var student_id = $(this).val();
	$("#subject_id").children().not(":First-child").remove();
	if (student_id=="") {
		return;
	}
	$("#load").html("loading...");
	$.ajax({
		url: 'index.php?c=register&a=listSubject',
		// thuộc tính oject và giá trị
		data: {student_id: student_id},
	})
	.done(function(data) {
		var subjects = JSON.parse(data);
		// 
		
		$(subjects).each(function(index,el){
			var option = "<option value='" + el.id + "'>" + el.id + " - " + el.name +  "</option>";
			$("#subject_id").append(option)
		});
		$("#load").empty();
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
});
$(".delete").click(function(event){
	$(".error").html();
	$(".message").empty();
	var type = $(this).attr("type"); 
	var message = "Bạn muốn xóa sinh viên này phải không?";
	if (type == "subject") {
		message = "Bạn muốn xóa môn học này phải không?";
	}
	if(!confirm(message)) {
		return false;

	}
	var id = $(this).attr("data");
	var self = this;
	$.ajax({
		url: 'index.php?c='+ type +'&a=hasRegister',
		
		data: {id:id},
	})
	.done(function(data) {
		data = JSON.parse(data);
		if (data.existing ==1){
			$(".error").html(data.error);
			$(".message").empty();
			return false;
		}
		window.location.href = self.href;
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
	return false;
});