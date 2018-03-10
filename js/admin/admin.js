$(function(){

    $(".checkall ins").click(function(){
        if($(".checkall input:checked").length==1){
            $(".checklist div").addClass("checked");
            $(".checklist input").prop("checked",true);
        }
        else{
            $(".checklist div").removeClass("checked");
            $(".checklist input").prop("checked",false);
        }

    });

    $(".checklist ins").click(function(){
        if($(".checklist input:checked").length!=$(".checklist input").length){
            $(".checkall div").removeClass("checked");
            $(".checkall input").prop("checked",false);
        }
        else{
            $(".checkall div").addClass("checked");
            $(".checkall input").prop("checked",false);
        }

    });

    $("form[name=addgroup]").submit(function(){
        var checkedbox=$(".checklist input:checked");
        checkedarray=new Array();
        $.each(checkedbox,function(i,n){
            checkedarray.push($(n).val());
        });
        subckecked=checkedarray.join(",");
        $.ajax({
            url:'',
            type:'post',
            dataType:'json',
            data:{
                title:$("form[name=addgroup] input[name=title]").val(),
                rules:subckecked,
                id:$("form[name=addgroup] input[name=id]").val()
            },
            success:function(data){
                if(data.status){
                    swal({
                        title:"成功提示",
                        text:data.info,
                        type:'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    urljump(2000);
                }
                else{
                    swal({
                        title:"错误提示",
                        text:data.info,
                        type:'error',
                        timer: 1500
                    });
                }
            }
        });return false;
    });

    //删除
    $(".btndelete").click(function(){
        var ids = $.map($("#tablelist").bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if(ids.length==0){
            swal({
                title:"错误提示",
                text:"您还没有选择要删除的对象！",
                type:'info',
                timer: 1500
            });
            return false;
        }
        var checkallarray=new Array();
        $.each(ids,function(i,n){
            checkallarray.push(n);
        });
        subcheckall=checkallarray.join(",");
        swal({
                title:"您确定要删除"+ids.length+"条数据吗？",
                text:"请谨慎操作！",
                type:"warning",
                showCancelButton:true,
                confirmButtonColor:"#DD6B55",
                confirmButtonText:"是的，我要删除！",
                cancelButtonText:"让我再考虑一下…",
                closeOnConfirm:false,
                closeOnCancel:false},
            function(isconfirm){
                if(isconfirm){
                    $.ajax({
                        url:URL+'/delete',
                        dataType:'json',
                        type:'get',
                        data:{
                            id:subcheckall
                        },
                        success:function(dataa){
                            if(dataa.status){
                                $("#tablelist").bootstrapTable('refresh');
                                swal("删除成功！","您已经删除了"+ids.length+"条信息。","success");
                            }
                            else{
                                swal("删除失败","请重试！","error");
                            }
                        }})
                }
                else{swal("已取消","您取消了删除操作！","error")}
            }
        );
    });

    //彻底删除
    $(".redelete").click(function(){
        var ids = $.map($("#tablelist").bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if(ids.length==0){
            swal({
                title:"错误提示",
                text:"您还没有选择要删除的对象！",
                type:'info',
                timer: 1500
            });
            return false;
        }
        var checkallarray=new Array();
        $.each(ids,function(i,n){
            checkallarray.push(n);
        });
        subcheckall=checkallarray.join(",");
        swal({
                title:"您确定要彻底删除"+ids.length+"条数据吗？",
                text:"删除后将无法恢复，请谨慎操作！",
                type:"warning",
                showCancelButton:true,
                confirmButtonColor:"#DD6B55",
                confirmButtonText:"是的，我要删除！",
                cancelButtonText:"让我再考虑一下…",
                closeOnConfirm:false,
                closeOnCancel:false},
            function(isconfirm){
                if(isconfirm){
                    $.ajax({
                        url:URL+'/redelete',
                        dataType:'json',
                        type:'get',
                        data:{
                            id:subcheckall
                        },
                        success:function(dataa){
                            if(dataa.status){
                                $("#tablelist").bootstrapTable('refresh');
                                swal("删除成功！","您已经永久删除了"+ids.length+"条信息。","success");
                            }
                            else{
                                swal("删除失败","请重试！","error");
                            }
                        }})
                }
                else{swal("已取消","您取消了删除操作！","error")}
            }
        );
    });

    //恢复
    $(".restore").click(function(){
        var ids = $.map($("#tablelist").bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if(ids.length==0){
            swal({
                title:"错误提示",
                text:"您还没有选择要恢复的对象！",
                type:'info',
                timer: 1500
            });
            return false;
        }
        var checkallarray=new Array();
        $.each(ids,function(i,n){
            checkallarray.push(n);
        });
        subcheckall=checkallarray.join(",");
        swal({
                title:"您确定要恢复"+ids.length+"条数据吗？",
                text:"恢复后将正常显示！",
                type:"warning",
                showCancelButton:true,
                confirmButtonColor:"#DD6B55",
                confirmButtonText:"是的，我要恢复！",
                cancelButtonText:"让我再考虑一下…",
                closeOnConfirm:false,
                closeOnCancel:false},
            function(isconfirm){
                if(isconfirm){
                    $.ajax({
                        url:URL+'/restore',
                        dataType:'json',
                        type:'get',
                        data:{
                            id:subcheckall
                        },
                        success:function(dataa){
                            if(dataa.status){
                                /*$("#tablelist").bootstrapTable('remove', {
                                    field: 'id',
                                    values: ids
                                });*/
                                $("#tablelist").bootstrapTable('refresh');
                                swal("恢复成功！","您已经恢复了"+ids.length+"条信息。","success");
                            }
                            else{
                                swal("恢复失败","请重试！","error");
                            }
                        }})
                }
                else{swal("已取消","您取消了恢复操作！","error")}
            }
        );
    });

    //单个恢复
    $.onerestory=function (value) {
        var ids=value;
        if(ids==''){
            swal({
                title:"错误提示",
                text:"您还没有选择要恢复的对象！",
                type:'info',
                timer: 1500
            });
            return false;
        }

        swal({
                title:"您确定要恢复该条数据吗？",
                text:"恢复后将正常显示！",
                type:"warning",
                showCancelButton:true,
                confirmButtonColor:"#DD6B55",
                confirmButtonText:"是的，我要恢复！",
                cancelButtonText:"让我再考虑一下…",
                closeOnConfirm:false,
                closeOnCancel:false},
            function(isconfirm){
                if(isconfirm){
                    $.ajax({
                        url:URL+'/restore',
                        dataType:'json',
                        type:'get',
                        data:{
                            id:ids
                        },
                        success:function(dataa){
                            if(dataa.status){
                                $("#tablelist").bootstrapTable('refresh');
                                swal("恢复成功！","您已经恢复该条数据。","success");
                            }
                            else{
                                swal("恢复失败","请重试！","error");
                            }
                        }})
                }
                else{swal("已取消","您取消了恢复操作！","error")}
            }
        );
    };

    //单个删除
    $.oneredelete=function (value) {
        var ids=value;
        if(ids==''){
            swal({
                title:"错误提示",
                text:"您还没有选择要删除的对象！",
                type:'info',
                timer: 1500
            });
            return false;
        }

        swal({
                title:"您确定要彻底删除该条数据吗？",
                text:"删除后将无法恢复，请谨慎操作！",
                type:"warning",
                showCancelButton:true,
                confirmButtonColor:"#DD6B55",
                confirmButtonText:"是的，我要删除！",
                cancelButtonText:"让我再考虑一下…",
                closeOnConfirm:false,
                closeOnCancel:false},
            function(isconfirm){
                if(isconfirm){
                    $.ajax({
                        url:URL+'/redelete',
                        dataType:'json',
                        type:'get',
                        data:{
                            id:ids
                        },
                        success:function(dataa){
                            if(dataa.status){
                                /*$("#tablelist").bootstrapTable('remove', {
                                    field: 'id',
                                    values: ids
                                });*/
                                $("#tablelist").bootstrapTable('refresh');
                                swal("删除成功！","您已经永久删除该条数据。","success");
                            }
                            else{
                                swal("删除失败","请重试！","error");
                            }
                        }})
                }
                else{swal("已取消","您取消了删除操作！","error")}
            }
        );
    };
    $(".restore").click(function(){
        var ids = $.map($("#tablelist").bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if(ids.length==0){
            swal({
                title:"错误提示",
                text:"您还没有选择要恢复的对象！",
                type:'info',
                timer: 1500
            });
            return false;
        }
        var checkallarray=new Array();
        $.each(ids,function(i,n){
            checkallarray.push(n);
        });
        subcheckall=checkallarray.join(",");
        swal({
                title:"您确定要恢复"+ids.length+"条数据吗？",
                text:"恢复后将正常显示！",
                type:"warning",
                showCancelButton:true,
                confirmButtonColor:"#DD6B55",
                confirmButtonText:"是的，我要恢复！",
                cancelButtonText:"让我再考虑一下…",
                closeOnConfirm:false,
                closeOnCancel:false},
            function(isconfirm){
                if(isconfirm){
                    $.ajax({
                        url:URL+'/restore',
                        dataType:'json',
                        type:'get',
                        data:{
                            id:subcheckall
                        },
                        success:function(dataa){
                            if(dataa.status){
                                $("#tablelist").bootstrapTable('refresh');
                                swal("恢复成功！","您已经恢复了"+ids.length+"条信息。","success");
                            }
                            else{
                                swal("恢复失败","请重试！","error");
                            }
                        }})
                }
                else{swal("已取消","您取消了恢复操作！","error")}
            }
        );
    });
    //设置有效性
    $.set_effect=function(nowthis,id){
        $.ajax({
            url:URL+'/set_effect',
            type:'post',
            dataType:'json',
            data:{
                id:id
            },
            success:function(data){
                if(data.status){
                    if(data.info){
                        $(nowthis).removeClass("btn-danger");
                        $(nowthis).addClass("btn-info");
                        $(nowthis).text("有效");
                    }
                    else{
                        $(nowthis).removeClass("btn-info");
                        $(nowthis).addClass("btn-danger");
                        $(nowthis).text("无效");
                    }
                }
                else{
                    alert("失败");
                }
                console.log(data);
            }
        });
    };
    //设置热门
    $.set_toogle=function(nowthis,id,name){
        $.ajax({
            url:URL+'/set_toogle',
            type:'post',
            dataType:'json',
            data:{
                id:id,
                name:name
            },
            success:function(data){
                if(data.status){
                    if(data.info){
                        $(nowthis).removeClass("btn-danger");
                        $(nowthis).addClass("btn-info");
                        $(nowthis).text("是");
                    }
                    else{
                        $(nowthis).removeClass("btn-info");
                        $(nowthis).addClass("btn-danger");
                        $(nowthis).text("否");
                    }
                }
                else{
                    alert("失败啦");
                }
                console.log(data);
            }
        });
    };
    $('.chosen-select').chosen();
    function urljump(timmer){
        clearTimeout(jumptime);
        var jumptime=setTimeout('window.location.href=window.location.href',timmer);
    };
//编辑器开始
//编辑器及图片上传开始
    var K =null;
    bindKdedior();
    bindKdupload();
    bindFileUpload();

});

function bindKdedior(){
    K = KindEditor;
    var editor = K.create('textarea.ketext', {
        allowFileManager : true,
        // emoticonsPath:EMOT_URL,
        afterBlur: function(){this.sync();}, //兼容jq的提交，失去焦点时同步表单值
        height:300,
        items: ["source", "|", "undo", "redo", "|", "preview", "print", "template", "code",
            "cut", "copy", "paste", "plainpaste", "wordpaste", "|", "justifyleft", "justifycenter",
            "justifyright", "justifyfull", "insertorderedlist", "insertunorderedlist", "indent", "outdent",
            "subscript", "superscript", "clearhtml", "quickformat", "selectall", "|", "fullscreen", "/",
            "formatblock","fontname", "fontsize", "|", "forecolor", "hilitecolor", "bold", "italic",
            "underline", "strikethrough", "lineheight","removeformat", "|", "image", "multiimage",
            "flash", "media", "insertfile", "table", "hr", "emoticons", "baidumap",
            "pagebreak", "anchor", "link", "unlink", "|", "about"]
    });

}

function bindFileUpload(){
    if(K==null){
        K = KindEditor;
    }
    var editor = K.editor({
        allowFileManager : true
    });
    K('.kefile').click(function() {
        var node = K(this);
        var dom =$(node).parent();
        editor.loadPlugin('insertfile', function() {
            editor.plugin.fileDialog({
                clickFn : function(url, title) {
                    dom.find(".kefile_url").val(url);
                    //K('#url').val(url);
                    editor.hideDialog();
                }
            });
        });
    });
};

function bindKdupload(){
    if(K==null){
        K = KindEditor;
    }
    var ieditor = K.editor({
        allowFileManager : true,
        imageSizeLimit:3000000
    });
    K('.keimg').unbind("click");
    K('.keimg').click(function() {
        var node = K(this);
        var dom =$(node).parent().parent().parent().parent();
        ieditor.loadPlugin('image', function() {

            ieditor.plugin.imageDialog({
                // imageUrl : K("#keimg_h_"+$(this).attr("rel")).val(),
                imageUrl:dom.find("#keimg_h_"+node.attr("rel")).val(),
                clickFn : function(url, title, width, height, border, align) {
                    dom.find("#keimg_a_"+node.attr("rel")).attr("href",url),
                        dom.find("#keimg_m_"+node.attr("rel")).attr("src",url),
                        dom.find("#keimg_h_"+node.attr("rel")).val(url),
                        dom.find(".keimg_d[rel='"+node.attr("rel")+"']").show(),
                        ieditor.hideDialog();
                }
            });
        });
    });
    /**
     * 删除单图
     */
    K('.keimg_d').unbind("click");
    K('.keimg_d').click(function() {
        var node = K(this);
        K(this).hide();
        var dom =$(node).parent().parent().parent().parent();
        dom.find("#keimg_a_"+node.attr("rel")).attr("href","");

        dom.find("#keimg_m_"+node.attr("rel")).attr("src",ROOT+"/public/images/nophoto.gif");
        dom.find("#keimg_h_"+node.attr("rel")).val("");
    });
};
