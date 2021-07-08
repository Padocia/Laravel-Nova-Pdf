<?php

namespace Padocia\NovaPdf\Actions;

use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\ActionRequest;
use Padocia\NovaPdf\Concerns\WithView;
use Padocia\NovaPdf\Concerns\WithResource;
use Padocia\NovaPdf\Concerns\WithBrowsershot;
use Padocia\NovaPdf\Concerns\WithFilename;
use Padocia\NovaPdf\Concerns\WithStylesContent;
use Padocia\NovaPdf\Concerns\WithDisk;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

abstract class ExportToPdf extends Action
{
    use WithView, WithResource, WithBrowsershot, WithFilename, WithStylesContent, WithDisk;

    /**
     * @var Laravel\Nova\Http\Requests\ActionRequest
     */
    protected $request;

    /**
     * @var int
     */
    protected $downloadUrlExpirationTime = 1;

    /**
     * Execute the action for the given request.
     *
     * @param  \Laravel\Nova\Http\Requests\ActionRequest $request
     *
     * @return mixed
     */

    public function handleRequest(ActionRequest $request)
    {
        $this->request = $request;

        $this->handleResource($request);

        $this->handleBrowsershot();

        $this->handleStyles();

        $this->handleFilename();

        return parent::handleRequest($request);
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $this->handleView($fields, $models);

        $this->addDataToView('stylesContents', $this->allStylesContents());

        $this->saveAsPdf();

        return Action::download(
            $this->getDownloadUrl(),
            $this->getFilename()
        );
    }

    /**
     * @return $this
     */
    protected function saveAsPdf()
    {
        $this->browsershot = $this->browsershot->html($this->renderView());

        $this->handleBrowsershotOptions();

        $pdfFileContent = $this->browsershot->pdf();

        Storage::disk($this->getDisk())->put($this->getFilename(), $pdfFileContent);

        return $this;
    }

    /**
     * @return string
     */
    protected function getDownloadUrl(): string
    {
        return URL::temporarySignedRoute('laravel-nova-pdf.download', now()->addMinutes($this->downloadUrlExpirationTime), [
            'path'     => $this->getFilePathFromDisk($this->getFilename()),
            'filename' => $this->getFilename(),
        ]);
    }

    /**
     * @return string
     */
    protected function defaultFilename(): string
    {
        return $this->resource::uriKey().'-'.$this->uriKey().'-'.Carbon::now()->timestamp.'.'.$this->getFileExtension();
    }




}
