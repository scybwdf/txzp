    KindEditor.plugin('taobao', function(K) {  
        var self = this, name = 'taobao';  
        self.plugin.taobao = {  
            edit : function() {  
                var lang = self.lang(name + '.'),  
                    html = '<div style="padding:20px;">' +  
                        //url  
                        '<div class="ke-dialog-row">' +  
                        '<label for="keUrl" style="width:60px;">¡¥Ω”</label>' +  
                        '<input class="ke-input-text" type="text" id="keUrl" name="url" value="" style="width:260px;" /></div>' +  
                        //type  
                        '<div class="ke-dialog-row"">' +  
                        '<label for="keTitle" style="width:60px;">±ÍÃ‚</label>' +  
                        '<input class="ke-input-text" type="text" id="keTitle" name="title" value="" style="width:260px;" /></div>' +  
                        '</div>' +  
                        '</div>',  
                    dialog = self.createDialog({  
                        name : name,  
                        width : 450,  
                        title : self.lang(name),  
                        body : html,  
                        yesBtn : {  
                            name : self.lang('yes'),  
                            click : function(e) {  
                                var url = K.trim(urlBox.val());  
                                var title=K.trim(titleBox.val());  
                                if (url == 'http://' || K.invalidUrl(url)) {  
                                    alert(self.lang('invalidUrl'));  
                                    urlBox[0].focus();  
                                    return;  
                                }  
                                var itemStr="<a data-type=\"0\" biz-itemid=\"null\" data-tmpl=\"350x100\" data-tmplid=\"6\" data-rd=\"2\" data-style=\"2\" data-border=\"1\" href=\""+url+"\">"+title+"</a>";  
                                self.insertHtml(itemStr).hideDialog().focus();  
                            }  
                        }  
                    }),  
                    div = dialog.div,  
                    urlBox = K('input[name="url"]', div),  
                    titleBox=K('input[name="title"]', div);  
                urlBox.val('http://');  
                self.cmd.selection();  
                var a = self.plugin.getSelectedLink();  
                if (a) {  
                    self.cmd.range.selectNode(a[0]);  
                    self.cmd.select();  
                    urlBox.val(a.attr('data-ke-src'));  
                    titleBox.val(a.text());  
                }  
                urlBox[0].focus();  
                urlBox[0].select();  
            },  
            'delete' : function() {  
                self.exec('unlink', null);  
            }  
        };  
        self.clickToolbar(name, self.plugin.taobao.edit);  
    });  