<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hello, this is a blade template</h1>

    <p>A great number is {{ 2 + 2 }}</p>
    <p>The current year is {{ date ("Y") }}</p>
    <h3>{{ $name }}</h3>

    <ul>
        @foreach ($all_animals as $animal)
            <li>{{ $animal }}</li>
        @endforeach
    </ul>

    <a href="/about">Go to the about page</a>
</body>
</html>
