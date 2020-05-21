<?php

namespace Liuhelong\laravelAdmin\WangEditor;

use Illuminate\Http\Request;

class UploadImage
{
	// 独立的图片上传接口
	public function index(Request $request)
	{
		$paths = array();
		foreach($request->image as $image){
			$paths[] = config('filesystems.disks.admin.url').'/'.$image->store('images','admin');
		
		}
		return response()->json([
			'errno'=>0, 
			"data"=> $paths,
		]);
	}
}
	
