/**
 *  龙哥自定义 拓展部分
 */
 
var editor;

//自定义全屏按钮
window.wangEditor.fullscreen = {
	// editor create之后调用
	init: function(editorSelector){
		$(editorSelector + " .w-e-toolbar").append('<div class="w-e-menu"><i class="fa fa-arrows-alt _wangEditor_btn_fullscreen" data-full="0" onclick="window.wangEditor.fullscreen.toggleFullscreen(\'' + editorSelector + '\')"></i></div>');
	},
	toggleFullscreen: function(editorSelector){
		$(editorSelector).toggleClass('fullscreen-editor');
		if($(editorSelector + ' ._wangEditor_btn_fullscreen').attr('full') == '0'){
			$(editorSelector + ' ._wangEditor_btn_fullscreen').attr('full',1).removeClass("fa-compress").addClass("fa-arrows-alt");
		}else{
			$(editorSelector + ' ._wangEditor_btn_fullscreen').attr('full',0).removeClass("fa-arrows-alt").addClass("fa-compress");
		}
	}
};

// 自定义插入横线
window.wangEditor.hr = {
	// editor create之后调用
	init: function(editorSelector,Editor){
		$(editorSelector + " .w-e-toolbar").append('<div class="w-e-menu"><i class="fa fa-arrows-h" onclick="window.wangEditor.hr.insert(\'' + editorSelector + '\')"><i/></div>');
		
		editor = Editor;
	},
	insert: function(editorSelector){
		
		command('insertHorizontalRule');// 插入下划线
		//editor.cmd.do('insertParagraph');
		editor.selection.createEmptyRange();
		command('formatBlock','P');
		return;

	}
};


function command(name, value) {
	// 如果无选区，忽略
	if (!editor.selection.getRange()) {
		console.log('无选区')
		return;
	}

	// 恢复选取
	editor.selection.restoreSelection();

	// 执行
	document.execCommand(name, false, value);

	// 修改菜单状态
	editor.menus.changeActive();

	// 最后，恢复选取保证光标在原来的位置闪烁
	editor.selection.saveRange();
	editor.selection.restoreSelection();

	// 触发 onchange
	editor.change && editor.change();
}