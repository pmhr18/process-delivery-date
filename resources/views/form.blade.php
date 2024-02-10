<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body>
        <div>
            <div>配送希望日</div>
            <select name="inputValue">
                <option value="" disabled selected>選択してください</option>
                @foreach($fetchDeliverySelectDays as $index => $day)
                    <option value="{{ $fetchDeliverySelectDaysValues[$index] }}">{{ $day }}</option>
                @endforeach
            </select>
        </div>
    </body>
</html>
