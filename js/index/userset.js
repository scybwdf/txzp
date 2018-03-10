$(function(){
	$("#face").uploadify({
	swf:ROOT+'/js/common/uploadify/uploadify.swf',
	uploader:uploadUrl,
	width:120,
	height:30,
	buttonImage:ROOT+'/js/common/uploadify/browse-btn.png',
	fileTypeDesc:'Image File',
	fileTypeExts:'*.jpeg;*.jpg;*.png;*.gif',
	formData:{'session_id':sid},
	onUploadSuccess:function(file,data,response){
		var data2=JSON.parse(data);
		if(data2.status){
			$("#face-img").attr('src',data2.path.max);
			$("input[name=face180]").val(data2.path.max);
			$("input[name=face80]").val(data2.path.mid);
			$("input[name=face50]").val(data2.path.min);
		}
		else{
			alert(data2.msg);
		}
	}
});
})
