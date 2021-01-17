<?php

namespace Padocia\NovaPdf\Concerns;

trait WithStyles
{
    /**
     * @var array
     */
    protected $styles = [];

    /**
     * @return $this
     */
    protected function addStyle($name)
    {
        $this->styles[] = $name;

        return $this;
    }

    /**
     * @return array
     */
    protected function allStyles()
    {
        return $this->styles;
    }

}
