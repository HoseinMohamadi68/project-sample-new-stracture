<?php

namespace App\Http\Controllers\Contacts;

use App\Filters\Contacts\EmailFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\EmailRequest;
use App\Http\Resources\Contacts\EmailResource;
use App\Models\Contacts\Email;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    /**
     * @param EmailFilter $filters Filters.
     * @param Request     $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(EmailFilter $filters, Request $request): AnonymousResourceCollection
    {
        return EmailResource::collection(Email::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * @param EmailRequest $request EmailRequest.
     *
     * @return EmailResource
     */
    public function store(EmailRequest $request): EmailResource
    {
        $email = Email::createObject(
            $request->get(Email::EMAIL)
        );

        return new EmailResource($email);
    }

    /**
     * @param Email $email Email.
     *
     * @return EmailResource
     */
    public function show(Email $email): EmailResource
    {
        return new EmailResource($email);
    }

    /**
     * @param EmailRequest $request EmailRequest.
     * @param Email        $email   Email.
     *
     * @return EmailResource
     */
    public function update(EmailRequest $request, Email $email): EmailResource
    {
        $email->updateObject(
            $request->get(Email::EMAIL),
        );

        return new EmailResource($email);
    }

    /**
     * @param Email $email Email.
     *
     * @return JsonResponse
     */
    public function destroy(Email $email): JsonResponse
    {
        try {
            $email->delete();

            return $this->getResponse([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error('Delete Email Error : ' . $exception->getMessage());

            return $this->getResponse([], Response::HTTP_CONFLICT);
        }
    }
}
