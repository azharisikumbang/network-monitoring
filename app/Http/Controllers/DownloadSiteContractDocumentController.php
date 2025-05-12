<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DownloadSiteContractDocumentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Site $site)
    {
        $filename = sprintf("%s%s%s", Site::CONTRACT_UPLOAD_PATH, DIRECTORY_SEPARATOR, $site->contract_document);

        abort_if(false === Storage::disk('local')->exists($filename), Response::HTTP_NOT_FOUND);

        return Storage::download($filename);
    }
}
