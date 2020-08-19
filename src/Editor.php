<?php

namespace Liuhelong\laravelAdmin\WangEditor;

use Encore\Admin\Form\Field;

class Editor extends Field
{
    protected $view = 'laravel-admin-wangEditor::editor';

    protected static $css = [
        'vendor/liuhelong/laravel-admin/wang-editor/wangEditor-3.0.10/release/wangEditor.css',
		'vendor/liuhelong/laravel-admin/wang-editor/wangEditor-3.0.10/release/wangEditor-long.css',
    ];

    protected static $js = [
        'vendor/liuhelong/laravel-admin/wang-editor/wangEditor-3.0.10/release/wangEditor.js',
		'vendor/liuhelong/laravel-admin/wang-editor/wangEditor-3.0.10/release/wangEditor-long.js',
    ];

    public function render()
    {
        $id = $this->formatName($this->id);

        $config = (array) WangEditor::config('config');

        $config = json_encode(array_merge([
            'zIndex'              => 0,
            'uploadImgShowBase64' => true,
        ], $config, $this->options));

        $token = csrf_token();

        $this->script = <<<EOT
(function ($) {

    if ($('#{$this->id}').attr('initialized')) {
        return;
    }

    var E = window.wangEditor
    var editor_{$this->id} = new E('#{$this->id}');
    
    editor_{$this->id}.customConfig.uploadImgParams = {_token: '$token'}
    
    Object.assign(editor_{$this->id}.customConfig, {$config})
    
    editor_{$this->id}.customConfig.onchange = function (html) {
        $('#input-$id').val(html);
    }
    editor_{$this->id}.create();
    E.hr.init('{$this->id}',editor_{$this->id});//插入hr
    E.fullscreen.init('#{$this->id}');//插入全屏
    $('#{$this->id}').attr('initialized', 1);
})(jQuery);
EOT;
        return parent::render();
    }
}
