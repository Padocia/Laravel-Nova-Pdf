<?php

namespace Padocia\NovaPdf\Console;

use Illuminate\Console\GeneratorCommand;

class ActionCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'nova:ExportToPdfAction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new export to pdf action class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Action';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/exportToPdfAction.stub';;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Nova\Actions';
    }
}
