<?php

namespace App\Http\Controllers\Contacts;

use App\Filters\Contacts\PhoneFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\PhoneRequest;
use App\Http\Resources\Contacts\PhoneResource;
use App\Models\Contacts\Phone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PhoneController extends Controller
{
    /**
     * @param PhoneFilter $filters Filter.
     * @param Request     $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(PhoneFilter $filters, Request $request): AnonymousResourceCollection
    {
        return PhoneResource::collection(Phone::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * @param PhoneRequest $request PhoneRequest.
     *
     * @return PhoneResource
     */
    public function store(PhoneRequest $request): PhoneResource
    {
        $phone = Phone::createObject(
            $request->get(Phone::TYPE),
            $request->get(Phone::NUMBER)
        );

        return new PhoneResource($phone);
    }

    /**
     * @param Phone $phone PhoneRequest.
     *
     * @return Phone
     */
    public function show(Phone $phone): PhoneResource
    {
        return new PhoneResource($phone);
    }

    /**
     * @param PhoneRequest $request Phone.
     * @param Phone        $phone   Phone.
     *
     * @return Phone
     */
    public function update(PhoneRequest $request, Phone $phone): PhoneResource
    {
        $phone->updateObject(
            $request->get(Phone::TYPE),
            $request->get(Phone::NUMBER)
        );

        return new PhoneResource($phone);
    }

    /**
     * @param Phone $phone Phone.
     *
     * @return JsonResponse
     */
    public function destroy(Phone $phone): JsonResponse
    {
        try {
            $phone->delete();

            return $this->getResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error('Delete Currency Error : ' . $exception->getMessage());

            return $this->getResponse([], Response::HTTP_CONFLICT);
        }
    }
}
