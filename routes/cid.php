<?php

// user
$this->group(['prefix' => '/cid'], function () {
    $this->get('/index', [
        'uses' => 'Admin\CidController@index',
        'as' => 'cid.index',
        'shield' => 'cid.index'
    ]);
    $this->get('/create', [
        'uses' => 'Admin\CidController@create',
        'as' => 'cid.create',
        'shield' => 'cid.create'
    ]);
    $this->post('/store', [
        'uses' => 'Admin\CidController@store',
        'as' => 'cid.store',
        'shield' => 'cid.create'
    ]);
    $this->get('/edit/{id}', [
        'uses' => 'Admin\CidController@edit',
        'as' => 'cid.edit',
        'shield' => 'cid.edit'
    ])->where(['id' => '\d+']);

    $this->put('/update/{id}', [
        'uses' => 'Admin\CidController@update',
        'as' => 'cid.update',
        'shield' => 'cid.edit'
    ])->where(['id' => '\d+']);

    $this->delete('/destroy/{id}', [
        'uses' => 'Admin\CidController@destroy',
        'as' => 'cid.destroy',
        'shield' => 'cid.destroy'
    ])->where(['id' => '\d+']);

    $this->post('/restore/{id}', [
        'uses' => 'Admin\CidController@restore',
        'as' => 'cid.restore',
        'is' => config('defender.restore_role'),
    ])->where(['id' => '\d+']);
});
