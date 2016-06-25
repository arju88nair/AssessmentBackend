<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test Details</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="styles/animate.css">
    <link type="text/css" rel="stylesheet" href="styles/all.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
    <link type="text/css" rel="stylesheet" href="styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="styles/pace.css">
    <link type="text/css" rel="stylesheet" href="styles/jquery.news-ticker.css">
</head>
<body>
<div>


    @include('includes.header');


    <!--BEGIN PAGE WRAPPER-->
    <div id="page-wrapper">
        <!--BEGIN TITLE & BREADCRUMB PAGE-->
        <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
            <div class="page-header pull-left">
                <div class="page-title">
                    Test Details</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a href="http://localhost/Laravel/Assessment/public/dashboardAction">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="hidden"><a href="#">Test Details</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="active">Test Details</li>
            </ol>
            <div class="clearfix">
            </div>
        </div>
        <!--END TITLE & BREADCRUMB PAGE-->
        <!--BEGIN CONTENT-->
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


        <!--END CONTENT-->
        <!--BEGIN FOOTER-->
        <div id="footer">
            <div class="copyright">
                <a href="http://themifycloud.com">2016 © Assessment</a></div>
        </div>
        <!--END FOOTER-->
    </div>
    <!--END PAGE WRAPPER-->
</div>
</div>
<script src="script/jquery-1.10.2.min.js"></script>
<script src="script/jquery-migrate-1.2.1.min.js"></script>
<script src="script/jquery-ui.js"></script>
<script src="script/bootstrap.min.js"></script>
<script src="script/bootstrap-hover-dropdown.js"></script>
<script src="script/html5shiv.js"></script>
<script src="script/respond.min.js"></script>
<script src="script/jquery.metisMenu.js"></script>
<script src="script/jquery.slimscroll.js"></script>
<script src="script/jquery.cookie.js"></script>
<script src="script/icheck.min.js"></script>
<script src="script/custom.min.js"></script>
<script src="script/jquery.news-ticker.js"></script>
<script src="script/jquery.menu.js"></script>
<script src="script/pace.min.js"></script>
<script src="script/holder.js"></script>
<script src="script/responsive-tabs.js"></script>
<script src="script/jquery.flot.js"></script>
<script src="script/jquery.flot.categories.js"></script>
<script src="script/jquery.flot.pie.js"></script>
<script src="script/jquery.flot.tooltip.js"></script>
<script src="script/jquery.flot.resize.js"></script>
<script src="script/jquery.flot.fillbetween.js"></script>
<script src="script/jquery.flot.stack.js"></script>
<script src="script/jquery.flot.spline.js"></script>
<script src="script/zabuto_calendar.min.js"></script>
<script src="script/index.js"></script>
<!--LOADING SCRIPTS FOR CHARTS-->
<script src="script/highcharts.js"></script>
<script src="script/data.js"></script>
<script src="script/drilldown.js"></script>
<script src="script/exporting.js"></script>
<script src="script/highcharts-more.js"></script>
<script src="script/charts-highchart-pie.js"></script>
<script src="script/charts-highchart-more.js"></script>
<!--CORE JAVASCRIPT-->
<script src="script/main.js"></script>
<script>        (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-145464-12', 'auto');
    ga('send', 'pageview');


</script>
</body>
</html>
