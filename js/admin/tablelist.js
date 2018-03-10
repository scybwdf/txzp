   $(function () {
	   
		$.seteffect=function(value,row,index){
               if(value=="1"){
				return  '<button type="button" onclick="javascript:$.set_effect(this,'+row.id+');"   class="btn btn-info" >有效</button>'; 
			   }
				 else{
					return  '<button type="button" onclick="javascript:$.set_effect(this,'+row.id+');"   class="btn btn-danger" >无效</button>';  
				 }
              };
	  $.setnew=function(value,row,index){
		    is_new="is_new";  
               if(value=="1"){
				return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_new+');" class="btn btn-info" >是</button>'; 
			   }
				 else{
					return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_new+');"  class="btn btn-danger" >否</button>';  
				 }
              };
	    $.sethuati=function(value,row,index){
		    is_huati="is_huati";  
               if(value=="1"){
				return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_huati+');" class="btn btn-info" >是</button>'; 
			   }
				 else{
					return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_huati+');"  class="btn btn-danger" >否</button>';  
				 }
              };
	   $.sethot=function(value,row,index){
		    is_hot="is_hot";  
               if(value=="1"){
				return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_hot+');" class="btn btn-info" >是</button>'; 
			   }
				 else{
					return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_hot+');"  class="btn btn-danger" >否</button>';  
				 }
              };
	   $.setindex=function(value,row,index){
		    is_index="is_index";  
               if(value=="1"){
				return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_index+');" class="btn btn-info" >是</button>'; 
			   }
				 else{
					return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_index+');"  class="btn btn-danger" >否</button>';  
				 }
              };
	     $.setend=function(value,row,index){
		    is_end="is_end";  
               if(value=="1"){
				return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_end+');" class="btn btn-info" >是</button>'; 
			   }
				 else{
					return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_end+');"  class="btn btn-danger" >否</button>';  
				 }
              };
	     $.setrecommend=function(value,row,index){
		    is_recommend="is_recommend";  
               if(value=="1"){
				return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_recommend+');" class="btn btn-info" >是</button>'; 
			   }
				 else{
					return  '<button type="button" onclick="javascript:$.set_toogle(this,'+row.id+','+is_recommend+');"  class="btn btn-danger" >否</button>';  
				 }
              };
		$.setedit=function(value,row,index){
				return '<a  class="btn btn-info" href='+URL+'/edit?id='+row.id+'>编辑</a>'
              };
	   $.setwriter=function(value,row,index){
		   	if(value==''){
				return '<span>管理员</span>'
			}
		   else{
			   return '<span>'+value+'</span>'
		   }
				
              };

	   $.trashact=function (value,row,index) {

		return '<button onclick="$.onerestory('+value+')" type="button" class="btn btn-outline  btn-success">恢复 </button><button onclick="$.oneredelete('+value+')" style="margin-left:10px;" type="button" class="btn  btn-danger btn-outline "> 彻底删除 </button>'
       };

        $("#tablelist").bootstrapTable({
			method:'get',
            search: !0,
			//height: $(window).height() - 200,
            pagination: !0,
            showRefresh: !0,
            showToggle: !0,
			sortName:'id',
			sortOrder:'desc',
			uniqueId: "id",
			dataType: "json",
			showExport: true,                   
			exportDataType: "basic",
			exportTypes:['excel','doc','pdf','json'],
			'queryParamsType': 'limit',
			responseHandler: responseHandler,
			singleSelect: false,
			//contentType: "application/x-www-form-urlencoded",
			striped: true,
			pageSize:10,
			sidePagination : 'server',
			showPaginationSwitch:!0,
            showColumns: !0,
            iconSize: "outline",
            toolbar: "#tableToolbar",
        });
		function responseHandler(e) {
			console.log(e);
            if (e.rows && e.rows.length > 0) {
                return { "rows": e.rows, "total": e.total };
            }
            else {
                return { "rows": [], "total": 0 };
            }
		}

//传递的参数

function queryParamss(param) {

return {
pageSize: params.pageSize,
pageNumber:params.pageNumber,	
search: params.searchText,
sort: params.sortOrder, 
sortOrder: params.sortName,	
};
}
    });