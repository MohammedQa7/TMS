<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadTemporatyAttachmentController extends Controller
{
    function upload(Request $request)
    {
        try {
            $request->validate([
                'attachments' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,txt|max:2048', // Validate image
            ]);

            
            $tenant_id = tenant('id');
            $tenantStoragePath = storage_path("app/public");
            $publicStoragePath = public_path("storage/tenant{$tenant_id}");
            if (!file_exists($publicStoragePath)) {
                symlink($tenantStoragePath, $publicStoragePath);
            }
            $attachment = $request->file('attachments');
            $attachment_path = $attachment->store('attachment/temp', 'public');
            $test=[
                'path' => $attachment_path,
                'original_name' => $attachment->getClientOriginalName(),
            ];
            return $test;
        } catch (\Throwable $th) {
            
            abort(422, 'The attachments type is not supported');
            throw $th;
        }
    }

    function revert(Request $request)
    {
        $attachment = $request['attachments_path'];
        $tenant_id = tenant('id');

        $attachments_path = public_path("storage/tenant{$tenant_id}") . '/' . $attachment;
        if (file_exists($attachments_path)) {
            unlink($attachments_path);
        }
        return '';
    }
}