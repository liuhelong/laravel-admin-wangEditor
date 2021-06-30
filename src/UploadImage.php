<?php

namespace Liuhelong\laravelAdmin\WangEditor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImage
{
	// 独立的图片上传接口
	public function index(Request $request)
	{
		$request->validate([
			'image.*' => 'file|mimes:jpeg,bmp,png',
			//'file' => 'nullable|mimes:jpeg,bmp,png,pdf'
		]);
		
		$paths = array();
		foreach($request->image as $image){
			
			$paths[] = Storage::disk('admin')->url($image->store($request->directory??'images','admin'));
		
		}
		return response()->json([
			'errno'=>0, 
			"data"=> $paths,
		]);
	}
}
	
