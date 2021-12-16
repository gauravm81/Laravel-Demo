<?php

namespace App\Services\Batch;

use App\Repositories\Batch\BatchPostContentRepository;

class BatchPostContentService
{
    private $batchPostContentRepository;

    public function __construct(BatchPostContentRepository $batchPostContentRepository)
    {
        $this->batchPostContentRepository = $batchPostContentRepository;
    }

    /**
     * Gets the content post by uuid.
     *
     * @param string $uuid
     *
     * @return ContentPost
     */
    public function postBatchContent($importData_arr)
    { 
        if($importData_arr) {
			foreach($importData_arr as $importData) {
				foreach($importData as $key => $value) {
					if($key == 0) {
						$batch_id = $value;
						$this->batchPostContentRepository->deleteByBatch($batch_id);
					} else {
						$this->batchPostContentRepository->postBatchContent($batch_id,$key,$value);
					}	
				}	
			}
		}	
		return true;
    }
    
    public function deleteByBatch($batch_id)
    { 
        return $this->batchPostContentRepository->deleteByBatch($batch_id);
        
    }
    
    public function uploadCSV($file, $name)
    { 
        $path = $this->batchPostContentRepository->uploadCSV($file, $name);
			// Import CSV to Database
			$filepath = public_path('storage/'.$path);
			// Reading file
			$file = fopen($filepath,"r");
			$importData_arr = array();
			$i = 0;
			$flag = 0;
			while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
			 $num = count($filedata );
			 // Skip first row (Remove below comment if you want to skip the first row)
			 if($i == 0){
				$i++;
				continue; 
			 }
			 for ($c=0; $c < $num; $c++) {
				 if(!empty($filedata [$c])) {
					$importData_arr[$i][] = $filedata [$c];
				 } else {
					$flag = 1;
					break;
				 }	
			 }
			 $i++;
		  }
		  fclose($file);
		  if($flag == 1) {
			return 'error';
	      }
		  return $importData_arr;
    }
    
    public function getBatchContent($batch_id) {
		return $this->batchPostContentRepository->getBatchContent($batch_id);
	}

}
