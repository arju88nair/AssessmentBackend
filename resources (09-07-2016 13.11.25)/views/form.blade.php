<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Asessment</a>
        </div>

        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="http://localhost/Laravel/Assessment/public/addTest">Add tests</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">

            <li><a href="http://localhost/Laravel/Assessment/public/loginAdmin"><span
                            class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    {!! Form::open(array('url'=>'apply/multiple_upload','method'=>'POST', 'files'=>true)) !!}
    {!! Form::text("username", null, array('placeholder'=>'Username')) !!}

    {!! Form::text("userHandle", null, array('placeholder'=>'User Handle')) !!}

    {!! Form::text("testId",null,  array('placeholder'=>'testId')) !!}
    <br>
    <hr>
    {!! Form::file('images[]', array('multiple'=>true)) !!}
    <br>

    {!! Form::submit('Submit') !!}
    {!! Form::close() !!}

</div>

</body>
</html>

























