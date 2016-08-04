<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Users</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<h2 style="text-align:center";><?=$fulltest['testName']?> </h2>

<p><strong>User Name</strong> : <?=$test['name']?> </p>

<p><strong>User Mail Id</strong> : <?=$test['email']?> </p>

<p><strong>User Location</strong> : <?=$test['testCity']?> </p>

<p><strong>Test Duration</strong> : <?=$test['duration']?> </p>

<p><strong>Submited Date</strong> : <?=$test['updated_at']?> </p>

<p><strong>Unique answer Id</strong> : <?=$test['_id']?> </p>

<p><strong>Score</strong> : <?=$test['score']?> </p>





<br>
<br>


<br><br><br>
<hr>

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
                echo "
            <script type=\"text/javascript\">
    $('.list-group-item:nth-child($num)').css('color','lightgreen');
            </script>
        ";
                ?>
            </ul>
							 <p>Choice:     <?=$test['keys'][$count]['answer'][0]?></p>
							  <p>Answer:     <?=$item['solutionkey'][0]?></p>

            <?php } else { ?>
						<p>Answer:     <?=$test['keys'][$count]['answer'][0]?></p>            <?php } ?>

			<br>

            <?php $count++;?>


            <?php endforeach ?>


</body>
</html>
