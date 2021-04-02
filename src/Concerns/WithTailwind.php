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
        if ($this->tailwind) {
            $path = __DIR__ . '/../../dist/css/tailwind.css';
            $this->stylesContents[] = file_get_contents($path);
        }

        return $this;
    }
}
