wangEditor extension for laravel-admin
======

prower by https://github.com/laravel-admin-extensions/wangEditor

## 截图

![wx20180904-103609](https://user-images.githubusercontent.com/1479100/45007036-65573b80-b02e-11e8-8b27-7ced3db47085.png)

## 安装

```bash
composer require liuhelong/laravel-admin-wang-editor
```

然后
```bash
php artisan vendor:publish --tag=laravel-admin-wangEditor
```

## 配置

在`config/admin.php`文件的`extensions`，加上属于这个扩展的一些配置
```php
    'extensions' => [
	'wang-editor' => [
        
            // 如果要关掉这个扩展，设置为false
            'enable' => true,
            
            // 编辑器的配置
            'config' => [
                //配置图片上传地址，不然会用base64处理图片
                'uploadImgServer' => '/admin/uploadImage',
	    	'debug'=>false,
		//上传的图片大小限制
		'uploadImgMaxSize' => 3 * 1024 * 1024,
		//上传图片的传递数组名
		'uploadFileName' => 'image[]',
            ]
        ]
    ]

```

编辑器的配置可以到[wangEditor文档](https://www.kancloud.cn/wangfupeng/wangeditor3/335776)找到


## 使用

在form表单中使用它：
```php
$form->editor('content');
```
