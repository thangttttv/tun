<?php
namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\FileRequest;
use App\Http\Responses\Api\V1\Image;
use App\Services\FileServiceInterface;

class FileController extends Controller
{
    /** @var FileServiceInterface $fileService */
    protected $fileService;

    public function __construct(
        FileServiceInterface $fileService
    ) {
        $this->fileService          = $fileService;
    }

    public function upload(FileRequest $request)
    {
        $file                   = $request->file('file');
        $mediaType              = $file->getClientMimeType();
        $path                   = $file->getPathname();
        $image                  = $this->fileService->upload('default-file', $path, $mediaType, []);

        if (empty($image)) {
            throw new APIErrorException('unknown', 'Upload file Failed', []);
        }

        return Image::updateWithModel($image)->withStatus(201)->response();
    }
}
