<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('test.store') }}">
    <input type="text" name="a[][]" id="" value="222">
    <input type="text" name="a[][]" id="" value="222">

    <input type="text" name="b[][]" id="" value="333">>
    <input type="submit" value="tijiao">

</form>
</body>
</html>