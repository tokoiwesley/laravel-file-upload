<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">

<div class="container mt-5">
    <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend>File Upload Example</legend>
            <div class="form-group mb-3">
                <label for="data">Upload data file</label>
                <input type="file" class="form-control" name="data" id="data" required>
                @if($errors->has('data'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('data') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </fieldset>
    </form>
</div>
</body>
</html>
