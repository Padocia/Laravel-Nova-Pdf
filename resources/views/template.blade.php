<!doctype html>
<html>
<head>
    <title>Laravel Nova Pdf Template</title>
    <meta charset="UTF-8" />
    @foreach ($stylesContents as $stylesContent)
        <style>
            {{ $stylesContent }}
        </style>
    @endforeach
    <style>
        html, body{
            height: 100%;
        }
    </style>
</head>
<body class="tailwind-container">
    @foreach ($models as $model)
        <section class="h-full flex flex-col justify-between items-center">
            <div class="flex flex-col items-center">

                <div class="flex pt-4">
                    <label class="font-semibold text-xl">Resource Name :</label>
                    <p class="font-semibold text-blue-600 text-xl"> {{ $resource::label() }} </p>
                </div>

                <div class="flex pt-4">
                    <label class="font-semibold text-xl">Model :</label>
                <p class="font-semibold text-blue-600 text-xl"> {{ class_basename($model) }} </p>
                </div>

                <div class="flex pt-4">
                    <label class="font-semibold text-xl">{{ class_basename($model) }}  id :</label>
                    <p class="font-semibold text-blue-600 text-xl"> {{ $model->getKey() }} </p>
                </div>
            </div>
            <div class="py-5">
                <p class="font-medium">
                    You can use <a href="https://tailwindcss.com/" class="text-green-600">Tailwind Css</a> to update this template.
                </p>
            </div>

            <div class="py-5">
                <p class="font-light text-sm">Page : {{ $loop->iteration }}</p>
            </div>

        </section>
    @endforeach
</body>
</html>
