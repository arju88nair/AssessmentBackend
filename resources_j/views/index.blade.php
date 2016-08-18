<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Users</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<p><strong>Test Name</strong> : <?=$fulltest['testName']?> </p>

<p><strong>Test Duration</strong> : <?=$fulltest['testDuration']?> Minutes</p>

<p><strong>Submited Date</strong> : <?=$test['updated_at']?> </p>

<p><strong>Unique answer Id</strong> : <?=$test['_id']?> </p>


<br>
<br>


<br><br><br>


<h3>Questions </h3>
</br>
<br>

<?php $count = 0; ?>

<?php foreach( $fulltest['questions'] as $item ): ?>


<div class="panel panel-info">
    <div class="panel-heading">Question Title: <?=$item['questiontitle']?></div>
</div>
<?php if ($item['questionType'] == "Non-Descriptive") { ?>
<ul class="list-group">
    <?php foreach ($item['options'] as $items): ?>
    <?php if (strlen($items) != 0) { ?>
    <li class="list-group-item"><span class="glyphicon glyphicon-minus"></span> <?=$items?></li>
    <?php } ?>

    <?php endforeach ?>
    <?php

    $num = 1;

    if ($item['solutionkey'][0] == 0) {
        $num = 1;
    }
    if ($item['solutionkey'][0] == 1) {
        $num = 2;
    }
    if ($item['solutionkey'][0] == 2) {
        $num = 3;
    }if ($item['solutionkey'][0] == 3) {
        $num = 4;
    }


    ?>
</ul>
<?php } else { ?>
<textarea disabled><?=$test['keys'][$count]['answer'][0]?></textarea>
<?php } ?>



<?php $count++;?>


<?php endforeach ?>


</body>
</html>
