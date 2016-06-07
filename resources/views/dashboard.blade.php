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
            <li><a href="#">Add tests</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">

            <li><a href="http://localhost/Laravel/Assessment/public/loginAdmin"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">

    <h1>Active Quizes</h1>
    <div class="list-group">
        <?php foreach( $test as $page ): ?>
        <a href="http://localhost/Laravel/Assessment/public/testDetails?action=<?=$page['_id']?>" class="list-group-item"><?=$page['testName']?></a>
        <?php endforeach ?>
       {{-- <a href="#" class="list-group-item">First item</a>
        <a href="#" class="list-group-item">Second item</a>
        <a href="#" class="list-group-item">Third item</a>--}}
    </div>

</div>

</body>
</html>
