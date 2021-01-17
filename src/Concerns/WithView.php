<?php

namespace Padocia\NovaPdf\Concerns;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Collection;
use Illuminate\View\View;

trait WithView
{
    /**
     * @var \Illuminate\View\View
     */
    protected $view;

    /**
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     *
     * @return $this
     */
    protected function handleView(ActionFields $fields, Collection $models)
    {
        $this->view = $this->preview($fields, $models);

        return $this;
    }

    /**
     * @return string
     */
    protected function renderView()
    {
        return $this->view->render();
    }

    /**
     * @param string|int $key
     * @param string $value
     *
     * @return $this
     */
    protected function addDataToView($key, $value)
    {
        $this->view->with($key, $value);

        return $this;
    }

    /**
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     *
     * @return \Illuminate\View\View
     */
    abstract public function preview(ActionFields $fields, Collection $models) : View;
}
