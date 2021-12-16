<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadCsv;

class BatchPost extends Model
{
	use UploadCsv;
	
    protected $fillable = [
        'id', 'batch_id', 'batch_day', 'post_id'
    ];
}
