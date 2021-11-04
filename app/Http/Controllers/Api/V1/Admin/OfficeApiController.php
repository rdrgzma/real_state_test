<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use App\Http\Resources\Admin\OfficeResource;
use App\Models\Office;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfficeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('office_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OfficeResource(Office::with(['user'])->get());
    }

    public function store(StoreOfficeRequest $request)
    {
        $office = Office::create($request->all());

        if ($request->input('logo', false)) {
            $office->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new OfficeResource($office))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Office $office)
    {
        abort_if(Gate::denies('office_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OfficeResource($office->load(['user']));
    }

    public function update(UpdateOfficeRequest $request, Office $office)
    {
        $office->update($request->all());

        if ($request->input('logo', false)) {
            if (!$office->logo || $request->input('logo') !== $office->logo->file_name) {
                if ($office->logo) {
                    $office->logo->delete();
                }
                $office->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($office->logo) {
            $office->logo->delete();
        }

        return (new OfficeResource($office))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Office $office)
    {
        abort_if(Gate::denies('office_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $office->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
