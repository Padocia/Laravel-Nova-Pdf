<?php

namespace Padocia\NovaPdf\Concerns;

trait WithTailwind
{
    /**
     * @var boolean
     */
    protected $tailwind = true;

    /**
     * @param boolean $useTailwind
     *
     * @return $this
     */
    protected function useTailwind($useTailwind)
    {
        $this->tailwind = $useTailwind;

        return $this;
    }

    /**
     * @return $this
     */
    protected function loadTailwind()
    {
        if($this->tailwind)
        {
            $this->addStyle('laravel-nova-pdf-tailwind');
        }

        return $this;
    }
}
