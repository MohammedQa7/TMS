<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use App\Imports\TasksImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportTasksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // need to get the file that is uploaded;

        // import the file and dd the row 
        $tenant_id = tenant('id');
        $attachments_path = public_path("storage/tenant{$tenant_id}") . '/' . $request->attachments_path['path'];
        Excel::import(new TasksImport, $attachments_path);
        dd('success');
    }
}