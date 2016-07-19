<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Users</title>
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
            <li><a href="#">Home</a></li>
            <li><a href="http://localhost/Laravel/Assessment/public/addTest">Add tests</a></li>
            <li class="active"><a href="http://localhost/Laravel/Assessment/public/viewUsers">View users</a></li>


        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="http://localhost/Laravel/Assessment/public/loginAdmin"><span
                            class="glyphicon glyphicon-bell"></span> Notifications <span
                            class="badge"><?=count($report) + count($assistance)?></span></a></li>


            <li><a href="http://localhost/Laravel/Assessment/public/loginAdmin"><span
                            class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">

    <h2 style="text-align: center">View Users</h2>

    <?php
    foreach ($users as $item) {
        echo '<div class="list-group">
         <a href="http://localhost/Laravel/Assessment/public/userTestDetails?uId=' . $item['_uId'] . '&qId=' . $item['testId'] . '" class="list-group-item"><img style="margin-left:1.3% " src=' . $item["imageUrl"] . ' class="img-circle" alt="Cinque Terre" width="48" height="48"><br><p>' . $item["name"] . '</p><h4 style="margin-top:-4.5%;text-align:center">' . $item['testName'] . '</h4><h2 style="margin-top:-2.9%;text-align:right">' . $item['score'] . '</h2></a>
     </div>';


    }


    ?>


    {{-- <div class="list-group">
         <a href="#" class="list-group-item">First item<p style="text-align: right">ghjkl;</p></a>
         <a href="#" class="list-group-item">Second item</a>
         <a href="#" class="list-group-item">Third item</a>
     </div>
 --}}

</div>

</body>
</html>
