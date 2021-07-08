<?php

namespace Padocia\NovaPdf\Concerns;
use Spatie\Browsershot\Browsershot;

trait WithBrowsershot
{
    /**
     * @var \Spatie\Browsershot\Browsershot
     */
    protected $browsershot;

    /**
     * @return $this
     */
    protected function handleBrowsershot()
    {
        $this->browsershot = new Browsershot();

        return $this;
    }

    /**
     * @return $this
     */
    protected function handleBrowsershotOptions()
    {
        $this->browsershot = $this->browsershot->format('A4');

        return $this;
    }

}
