<?php

namespace App\Repositories\Batch;

use App\Models\BatchPost;

class BatchPostContentRepository
{

    protected $batchPostContent;

    /**
     * Create a new Batch Post Content repository instance.
     *
     * @return void
     */
    public function __construct(BatchPost $batchPostContent)
    {
        $this->batchPostContent = $batchPostContent;
    }

    public function postBatchContent($batch_id,$key,$value)
    { 
		$batchPostContent = new $this->batchPostContent;
		$batchPostContent->batch_id = $batch_id;
		$batchPostContent->batch_day = $key;
		$batchPostContent->post_id = $value;
		$batchPostContent->save();
		return 1;
    }

    public function deleteByBatch($batch_id)
    {
		if($this->getByBatch($batch_id)) {
			return $this->batchPostContent->where('batch_id', $batch_id)->delete();
		}	
    }
    
    public function getByBatch($batch_id)
    {
        return $this->batchPostContent
            ->where('batch_id', $batch_id)
            ->first();
    }
    
    public function uploadCSV($file, $name)
    {
        return $path = $this->batchPostContent->uploadCSV($file, $name);
    }
    
    public function getBatchPostData($batch_id)
    {
        return $this->batchPostContent
			->select('batch_id','batch_day','post_id')
            ->where('batch_id', $batch_id)
            ->get();
    }
}
