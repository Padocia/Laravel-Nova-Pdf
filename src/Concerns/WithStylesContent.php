<?php

namespace Padocia\NovaPdf\Concerns;

use Laravel\Nova\Nova;
use Illuminate\Support\Arr;

trait WithStylesContent
{
    use WithStyles, WithTailwind;

    /**
     * @var array
     */
    protected $stylesContents = [];

    /**
     * @return $this
     */
    protected function handleStyles()
    {
        $this->loadTailwind();

        $this->loadStylesContents();

        return $this;
    }

    /**
     * @return $this
     */
    protected function loadStylesContents()
    {
        foreach($this->allStyles() as $style)
        {
            $path = Arr::get(Nova::allStyles(), $style);
            if(!is_null($path) && file_exists($path))
            {
                $this->stylesContents[] = file_get_contents($path);
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    protected function allStylesContents()
    {
        return $this->stylesContents;
    }

}
