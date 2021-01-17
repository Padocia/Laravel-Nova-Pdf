<?php

namespace Padocia\NovaPdf\Concerns;

trait WithFilename
{

    /**
     * @var string
     */
    protected $filename;

    /**
     * @return $this
     */
    protected function handleFilename()
    {
        $this->filename = $this->filename();

        return $this;
    }

    /**
     * @return string
     */
    protected function filename()
    {
        return $this->defaultFilename();
    }

    /**
     * @return string
     */
    protected function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    protected function getFileExtension()
    {
        return 'pdf';
    }

    /**
     * @return string
     */
    abstract protected function defaultFilename(): string;



}
