<?php

namespace App\Actions;

use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Models\Site;
use Illuminate\Http\UploadedFile;

final class UpdateSiteAction
{
    public function execute(UpdateSiteRequest $request, Site $site): bool
    {
        // TODO: handle uplaoded file
        if (false === $request->hasFile('contract_document'))
            return $site->update($request->except('contract_document'));

        $contractFileName = $this->uploadContractDocument($request->file('contract_document'));

        $merged = array_merge([
            'contract_document' => $contractFileName
        ], $request->except('contract_document'));

        return $site->update($merged);
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