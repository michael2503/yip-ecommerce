<?php

namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UploadFile
{

	/**
	 * Build success response
	 * @param string/array $data
	 * @param int  $code
	 * @return Illuminate\Http\JsonResponse
	*/

    public static function uploadimage($file, $folder)
    {
        $imageName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path($folder), $imageName);
        return url('').'/'.$folder.'/'.$imageName;
    }



}
