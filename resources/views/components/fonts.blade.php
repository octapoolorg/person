@if (in_array(locale(), array_keys(config('fonts.noto'))))
    <link rel="stylesheet" href="{!! config('fonts.noto.' . locale()) !!}">
@endif

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">