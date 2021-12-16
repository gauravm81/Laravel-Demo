<?php

namespace App\Traits;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use File;

use Intervention\Image\ImageManagerStatic as Image;

trait FeaturedImage
{

    public function uploadFeaturedImage($file, $name, $post_image = '')
    {
        if (!$file) {
            return;
        }

        $filename = $this->resource_name . '-' . Str::slug($name) . '-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $path = Storage::disk('public')->putFileAs($this->resource_name, $file, $filename);
        
		if($post_image == 'post_image') {
			foreach (static::sizePostList() as $size) {
				$this->createAlternateImageSize($size['width'], $size['height'], $file, $path, $size['crop']);
			}
		} else {
			foreach (static::sizeList() as $size) {
				$this->createAlternateImageSize($size['width'], $size['height'], $file, $path, $size['crop']);
			}
		}	

        if (isset($this->featured_image_db_name)) {
            $this->attributes[$this->featured_image_db_name] = $path;
        } else {
            $this->attributes['featured_image'] = $path;
        }
    }
    
    

    public function getThumbnailPath($size = '400x400')
    {
        if (isset($this->avatar)) {
            return str_replace('.', '-'.$size.'.', $this->avatar);
        }
    }
    
   
    
    public function getNoImagePath($size = '180x180')
    {
		$fimage = 'images/noImage.png';
        return str_replace('.', '-'.$size.'.', $fimage);
    }

    public function deleteFeaturedImage()
    {
        if ($this->avatar) {
            Storage::disk('public')->delete($this->avatar);

            foreach (static::sizeList() as $size) {
                $name = str_replace('.', '-' . $size['width'] . 'x' . $size['height'] . '.', $this->avatar);
                Storage::disk('public')->delete($name);
            }
        }
    }

    public function createAlternateImageSize($width, $height, $file, $path, $crop = false)
    {
        $search = '.' . $file->getClientOriginalExtension();
        $replace = '-' . $width . 'x' . $height . '.' . $file->getClientOriginalExtension();
        $name = str_replace($search, $replace, $path);

        $thumbnail_path = storage_path('app/public/' . $name);
        
        if ($crop) {
            Image::make(storage_path('app/public/' . $path))->fit($width, $height, null, 'top')->save($thumbnail_path);
        } else {
			if($width > $height) {
				Image::make(storage_path('app/public/' . $path))->resize($width, null, function ($constraint) {
					$constraint->aspectRatio();
				})->save($thumbnail_path);
			} else {
				Image::make(storage_path('app/public/' . $path))->resize($width, $height, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				})->save($thumbnail_path);
			}
        }
    }

    public static function sizeList()
    {
        return [
			['width' => 66,  'height' => 66, 	'crop' => true],
			['width' => 79,  'height' => 79, 	'crop' => true],
			['width' => 90,  'height' => 90, 	'crop' => true],
            ['width' => 120, 'height' => 120, 	'crop' => true]
        ];
    }
    
}
