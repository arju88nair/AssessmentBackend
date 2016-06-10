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

            <li><a href="http://localhost/Laravel/Assessment/public/loginAdmin"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">

    <h1>Active Tests</h1>
    <div class="list-group">




        <table class="table table-striped">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach( $test as $page ): ?>


                <tr>
                    <td><a href="http://localhost/Laravel/Assessment/public/testDetails?action=<?=$page['_id']?>" ><?=$page['testName']?></a></td>
                    <td><?=$page['shortDescription']?></td>
                    <td><?=$page['updated_at']?></td>
                    <td><?=$page['testStatus']?></td>

                </tr>


            <?php endforeach ?>
           {{-- <tr>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
            </tr>--}}

            </tbody>
        </table>







    </div>

</div>

</body>
</html>
