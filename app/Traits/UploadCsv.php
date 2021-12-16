<?php

namespace App\Traits;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use File;

trait UploadCsv
{

    public function uploadCSV($file, $name)
    {
        if (!$file) {
            return;
        }
        

        $filename = Str::slug($name) . '-' . Str::random(8).'-'.date('Y-m-d').'-'.time() . '.' . $file->getClientOriginalExtension();
        $path = Storage::disk('public')->putFileAs('csv'.$this->resource_name, $file, $filename);
        
		return $path;
    }

    
}
