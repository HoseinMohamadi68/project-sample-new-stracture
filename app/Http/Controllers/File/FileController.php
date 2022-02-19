<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\File\File;
use App\Filters\FileFilter;
use App\Http\Requests\File\FileRequest;
use App\Http\Resources\File\FileResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FileFilter $filter  Filters.
     * @param Request    $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(FileFilter $filter, Request $request): AnonymousResourceCollection
    {
        return FileResource::collection(File::filter($filter)->paginate($this->getPageSize($request)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FileRequest $request Request.
     *
     * @return FileResource|JsonResponse
     */
    public function store(FileRequest $request): FileResource|JsonResponse
    {
        try {
            return new FileResource(File::createObject($request->file('file')));
        } catch (\Exception $exception) {
            Log::error('Create File Error  : ' . $exception->getMessage());

            return $this->getResponse([], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param File $file File.
     *
     * @return FileResource
     */
    public function show(File $file): FileResource
    {
        return new FileResource($file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $file File.
     *
     * @return JsonResponse
     */
    public function destroy(File $file): JsonResponse
    {
        try {
            $file->delete();
        } catch (\Throwable $exception) {
            Log::error('Delete File Error : ' . $exception->getMessage());

            return $this->getResponse([], Response::HTTP_CONFLICT);
        }

        return $this->getResponse([], Response::HTTP_NO_CONTENT);
    }
}
