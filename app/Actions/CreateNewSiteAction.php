<?php

namespace App\Actions;

use App\Http\Requests\StoreSiteRequest;
use App\Models\Site;
use Illuminate\Http\UploadedFile;

final class CreateNewSiteAction
{
    public function execute(StoreSiteRequest $request): Site
    {
        $contractFileName = $this->uploadContractDocument($request->file('contract_document'));

        $merged = array_merge([
            'contract_document' => $contractFileName
        ], $request->except('contract_document'));

        return Site::create($merged);
    }

    private function uploadContractDocument(UploadedFile $file): string
    {
        $filename = sprintf("%s.%s", md5($file->getFilename() . time()), $file->getClientOriginalExtension());
        $file->storeAs(
            Site::CONTRACT_UPLOAD_PATH,
            $filename
        );

        return $filename;
    }
}