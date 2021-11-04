<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Office
    Route::post('offices/media', 'OfficeApiController@storeMedia')->name('offices.storeMedia');
    Route::apiResource('offices', 'OfficeApiController');
});
