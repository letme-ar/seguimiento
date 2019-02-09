<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class RepoBase{

    public function getModel()
    {
        //
    }

    public function save($request)
    {
        $model = $this->getModel()->firstOrNew(['id' => $request->get('id')]);
        $model->fill($request->except('_token'));
        $model->save();
        return $model;
    }

    public function make($request)
    {
        $model = $this->getModel()->firstOrNew(['id' => $request->get('id')]);
        $model->fill($request->except('_token'));
        $model->make();
        return $model;
    }



}
