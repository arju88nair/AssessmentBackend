<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title><?=$tests['testName']?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"/>
    {{--
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://localhost/Laravel/Assessment/public/dashboardAction">Asessment</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="http://localhost/Laravel/Assessment/public/dashboardAction">Home</a></li>
            <li><a href="http://localhost/Laravel/Assessment/public/addTest">Add tests</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">

            <li><a href="http://localhost/Laravel/Assessment/public/loginAdmin"><span
                            class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    </br>
    </br>
    <h1><?=$tests['testName']?>
        <hr>
        <hr>
        <a href="http://localhost/Laravel/Assessment/public/edit?action=<?=$tests['_id']?>" class="btn btn-default" role="button">Edit</a>
        <a href="http://localhost/Laravel/Assessment/public/delete?action=<?=$tests['_id']?>"class="btn btn-danger" role="button">Delete</a>
    </h1>
    <img class="img-responsive" src=<?=$tests['ImageUrl']?> alt="Chania">
    <br>
    <br>
    <?php
    $testFlag = $tests['skipFlag'];

    if ($tests['skipFlag'] == 'False') {
        $testFlag = "No";
    } else {
        $testFlag = "Yes";
    }
    ?>
    <p><strong>Test Duration</strong> : <?=$tests['testDuration']?> Minutes</p>

    <p><strong>Test Owner</strong> : <?=$tests['ownerName']?></p>

    <p><strong>Skipping Allowed</strong> : <?=$testFlag?></p>

    <p><strong>Test Status</strong> : <?=$tests['testStatus']?></p>

    <p><strong>Summary </strong>: <?=$tests['shortDescription']?> </p>

    <p><strong>Description</strong> : <?=$tests['testDescription']?> </p>

    <p><strong>Expiry date</strong> : <?=$tests['expiryDate']?> </p>

    <p><strong>Created at</strong> : <?=$tests['created_at']?> </p>

    <p><strong>Test Id</strong> : <?=$tests['_id']?> </p>

    <p><strong>Status</strong> :Active</p>

    <h3>Questions </h3>
    </br>
    <br>

    <?php foreach( $tests['questions'] as $item ): ?>


    <p><b>Question Title</b> : <?=$item['questiontitle']?></p>
    <?php foreach ($item['options'] as $items): ?>
    <br>

    <p><span class="glyphicon glyphicon-minus"></span> <?=$items?></p>
    <br>
    <?php endforeach ?>
    <?php foreach ($item['solutionkey'] as $keys): ?>
    <p>Answer : <?=$keys?> </p>
    <br>
    <br>
    <?php endforeach ?>
    <?php endforeach ?>


</div>

</body>
</html>
