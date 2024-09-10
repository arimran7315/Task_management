<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    <h2>{{ $mailData['subject'] }}</h2>
    <p><strong>Date:</strong> {{ date('F d, Y') }}</p>
    <p><strong>Meeting Title:</strong> {{ $mailData['title'] }}</p>
</body>

</html>
