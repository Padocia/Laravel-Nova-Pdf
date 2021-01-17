<?php

namespace Padocia\NovaPdf\Concerns;

trait WithResource
{
    /**
     * @var \Laravel\Nova\Resource
     */
    protected $resource;

    /**
     * @param  \Laravel\Nova\Http\Requests\ActionRequest $request
     *
     * @return $this
     */
    protected function handleResource($request)
    {
        $this->resource = $request->resource();

        return $this;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model $model
     *
     * @return \Laravel\Nova\Resource
     */
    protected function resolveResource($model)
    {
        $resource = $this->resource;

        return new $resource($model);
    }
}
