<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\Batch\BatchPostContentService;

class BatchPostContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     
   private $batchUploadService;  
     
     
    public function __construct(BatchPostContentService $batchPostContentService)
    {
		$this->batchPostContentService = $batchPostContentService;
    }
	
	public function uploadbatch(Request $request) {
		$data = [];
		return view('admin.batch.batch_upload')->with($data);
	}
	
	public function importcsv(Request $request) {
		$rules = [
            'batch_upload' => ['required','file','mimes:csv,txt']
        ];
		 if ($this->isFormValidated($request, $rules)) {
			$file = $request->file('batch_upload');
			 // File Details 
			  $filename = $file->getClientOriginalName();
			  $extension = $file->getClientOriginalExtension();
			  // Valid File Extensions
			  $valid_extension = array("csv");
			  if(in_array(strtolower($extension),$valid_extension)){
				  $importData_arr = $this->batchPostContentService->uploadCSV($request->file('batch_upload'), 'batch_csv');
				  if($importData_arr) {
						$data = $this->batchPostContentService->postBatchContent($importData_arr);
						if($data == 1) {
							Session::flash('status', 'success');
							Session::flash('message', 'CSV file has been imported successfully!');
						} else {
							Session::flash('status', 'error');
							Session::flash('message', 'Something went wrong.Please try again!');
						}	
				  }
				  
			  }
		}
		return redirect()->back();
	}
	
	public function getPostBatch(Request $request, $batch_id) {
		$postBatchData = config('content-posts-batch.' . 1);
		//$postBatchData = $this->batchPostContentService->getBatchContent($batch_id);
		echo "<pre>"; print_r($postBatchData); exit;
	}
}
