# Export nova resources to pdf

![Laravel-Nova-Excel](https://user-images.githubusercontent.com/16169173/104830499-c1822980-5890-11eb-97a7-010f7ed9b4af.png)


## ✨ Features

- **Export nova resources to PDF.** Easily export nova resources to pdf file using blade templates designed by you ! It could be an invoice, a report .... sky is the limit.

- **PDF files are generated from [blade](https://laravel.com/docs/blade) templates.** Generating pdf has never been so easy, Write your pdf template using blade and export it as pdf. 

- **Support [Tailwind Css](https://tailwindcss.com/) to style blade templates.** Prefer to use  Tailwind css framework to style your blade templates ? wrap your div with `.tailwind-container` and you are ready to go.

## Requirements
This package is using [Browsershot](https://github.com/spatie/browsershot#requirements), The conversion is done behind the scenes by [Puppeteer ](https://github.com/GoogleChrome/puppeteer) which controls a headless version of Google Chrome.

## Installation

You can install the package via composer:
```
composer require padocia/laravel-nova-pdf
```

If you don't have the `puppeteer` on your project:
```
npm install puppeteer
```

You can publish the default blade template :
```
php artisan vendor:publish --tag nova-pdf-template
```

## Usage

Export to pdf nova actions may be generated using :
```
php artisan nova:ExportToPdfAction InvoiceAction
```

A new nova action is created under `app\nova\actions`, Feel free to customize or change the view 

```php
<?php

namespace App\Nova\Actions;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Laravel\Nova\Fields\ActionFields;
use Padocia\NovaPdf\Actions\ExportToPdf;

class InvoiceAction extends ExportToPdf
{
    /**
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     *
     * @return \Illuminate\View\View
     */
    public function preview(ActionFields $fields, Collection $models) : View
    {
        $resource = $this->resource;
        return view('nova-pdf.template', compact('models','resource'));
    }
}
```

#### Attach action to a resource
We'll Use the `User` resource as an example to add your action to the actions() list.
```php
<?php

namespace App\Nova;

use Illuminate\Http\Request;
use App\Nova\Actions\InvoiceAction;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\User';
    
    // Other default resource methods
    
    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new InvoiceAction,
        ];
    }
}
```

#### Customize Browsershot
Override the `handleBrowsershotOptions` method in the action class :
```php
protected function handleBrowsershotOptions()
{
    $this->browsershot = $this->browsershot->format('A4');

    return $this;
}
```

#### Change Filename
Override the `filename` method in the action class :
```php
protected function filename()
{
    return "your_new_filename.pdf";
}
```

#### Change Disk
```php
$this->withDisk('public');
```
#### Add new css file
```php
$this->addStyle('nova_style_name');
```

#### Remove tailwind css
```php
$this->useTailwind(false);
```

#### Extend download url expiration time
```php
protected $downloadUrlExpirationTime = 1; // 1 min
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email zakaria.tayebbey@gmail.com.

## Credits

- [Zakaria Tayeb Bey](https://github.com/Padocia)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
