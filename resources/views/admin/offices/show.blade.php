@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.office.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.offices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.office.fields.id') }}
                        </th>
                        <td>
                            {{ $office->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.office.fields.name') }}
                        </th>
                        <td>
                            {{ $office->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.office.fields.logo') }}
                        </th>
                        <td>
                            @if($office->logo)
                                <a href="{{ $office->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $office->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.office.fields.user') }}
                        </th>
                        <td>
                            {{ $office->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.offices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection