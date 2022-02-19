<?php

namespace App\Http\Controllers\Language;

use App\Filters\Language\LanguageFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageRequest;
use App\Http\Resources\Language\LanguageResource;
use App\Models\Language\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param LanguageFilter $filters Filter.
     *
     * @param Request        $request Request.
     *
     * @return AnonymousResourceCollection
     */
    public function index(LanguageFilter $filters, Request $request): AnonymousResourceCollection
    {
        return LanguageResource::collection(Language::filter($filters)->paginate($this->getPageSize($request)));
    }

    /**
     * * Display the specified resource.
     *
     * @param Language $language Language.
     *
     * @return LanguageResource
     */
    public function show(Language $language): LanguageResource
    {
        return new LanguageResource($language);
    }

    /**
     * @param LanguageRequest $request  Request.
     * @param Language        $language Language.
     *
     * @return LanguageResource
     */
    public function update(LanguageRequest $request, Language $language): LanguageResource
    {
        return new LanguageResource(
            $language->updateObject($request->get(Language::IS_LTR))
        );
    }
}
