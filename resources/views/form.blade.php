<html>
<head>
</head>
<body>
@if(Session::has('success'))
    <h2>{!! Session::get('success') !!}</h2>
@endif
<div>Upload form</div>
{!! Form::open(array('url'=>'apply/multiple_upload','method'=>'POST', 'files'=>true)) !!}
{!! Form::text("username", null, array('placeholder'=>'Username')) !!}
{!! Form::text("testId",null,  array('placeholder'=>'testId')) !!}
{!! Form::file('images[]', array('multiple'=>true)) !!}
{!! Form::submit('Submit') !!}
{!! Form::close() !!}
</body>
</html>