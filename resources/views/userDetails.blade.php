<!DOCTYPE html>
<html lang="en">
<head>
    <title>View User</title>
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
    <link type="text/css" rel="stylesheet"
          href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
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

    <script type="text/javascript">
        $(document).ready(function () {
            var maxField = 20; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div> <div class="form-group"> <label class="control-label col-sm-2" for="email">Question Title:</label> <div class="col-sm-10"> <input type="text" class="form-control" name="Qtitle[]" placeholder="Enter question title" value=""> </div> <br> <label for="sel1">Multiple-choice:</label> <select name="Mflag[]" class="form-control"> <option vale="False">False</option> <option value="True">True</option> </select> <br> <label class="control-label col-sm-2" for="email">Question Image URL:</label> <div class="col-sm-10"> <input type="text" class="form-control" name="QURL[]" placeholder="Enter Question Image URL" value=""> </div> <br> <br> <br> <label class="control-label col-sm-2" for="email">Question weightage:</label> <div class="col-sm-10"> <input type="text" class="form-control" name="weightage[]" placeholder="Enter Question weightage" value=""> </div> <br> <br> <br> <div class="col-sm-10"> <label class="control-label col-sm-2" for="email">Option:</label> <input type="text" class="form-control" name="qOption[]" placeholder="Enter options" value=""> </div> <br> <br> <br> <div class="col-sm-10"> <label class="control-label col-sm-2" for="email">Option:</label> <input type="text" class="form-control" name="qOption[]" placeholder="Enter options" value=""> </div> <br> <br> <br> <div class="col-sm-10"> <label class="control-label col-sm-2" for="email">Option:</label> <input type="text" class="form-control" name="qOption[]" placeholder="Enter options" value=""> </div> <br> <br> <br> <div class="col-sm-10"> <label class="control-label col-sm-2" for="email">Option:</label> <input type="text" class="form-control" name="qOption[]" placeholder="Enter options" value=""> </div> <br> <br> <br> <br> <br> <label class="control-label col-sm-2" for="email">Answer key:</label> <div class="col-sm-10"> <input type="text" class="form-control" name="qAnswer[]" placeholder="Enter answer key" value=""> </div> </div> <br><a href="javascript:void(0);" class="remove_button btn btn-warning "  title="Remove field">Remove Field</a> <br> <hr> <br> </div>'; //New input field html
            var x = 1; //Initial field counter is 1
            var addButton = $('.add_button');
            $(addButton).click(function () {
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
</head>
<body style="overflow-x: hidden">
<div>


    @include('includes.header');


    <!--BEGIN PAGE WRAPPER-->
    <div id="page-wrapper">
        <!--BEGIN TITLE & BREADCRUMB PAGE-->
        <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
            <div class="page-header pull-left">
                <div class="page-title">
                    View User
                </div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a href="dashboardAction">Home</a>&nbsp;&nbsp;<i
                            class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="hidden"><a href="#">View User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                </li>
                <li class="active">View User</li>
            </ol>
            <div class="clearfix">
            </div>
        </div>
        <!--END TITLE & BREADCRUMB PAGE-->
        <!--BEGIN CONTENT-->


        <div style="float: right;width:40%; height:auto;margin-right: 2%;margin-top:10%" class="container">


            <img style=" display: block; margin: 0 auto;" src=<?=$users['imageUrl']?> class="img-circle"
                 alt="Cinque Terre"
                 width="140" height="130">
            <br>

            <p style="text-align: center;"><strong> <?=$users['name']?></strong></p>

            <br>

            <br><br>


        </div>
        <div class="container">
            <h1 style="text-align: center">Individual details</h1>

            <br>
            <br>
            <br>
            <br>
            <br>

            <p><strong>User Name</strong> :<?=$users['name']?></p>

            <p><strong>User Email Id</strong> :<?=$users['userId']?></p>

            <p><strong>Authentication Type</strong> :<?=$users['auth_type']?></p>

            <p><strong>Push Notification Id</strong> :<?=$users['pushNotificationID']?></p>

            <p><strong>Session Handle</strong> :<?=$users['usrSessionHdl']?></p>

            <p><strong>Unique Databsae Id</strong> :<?=$users['_id']?></p>

            <?php
            if (isset($users['corporateName'])) {
                if ($users['corporateName'] !== "" || count($users['corporateName']) != 0) {
                    echo '<p><strong>Corporate Name</strong> :' . $users['corporateName'] . '</p> ';
                }
            }
            ?>

            <br>
            <br>
            <br>
            <?php
            if (count($test) != 0) {
                echo '<h3>Attended Tests </h3></br><br>';
            }


            foreach ($test as $item) {
                echo '<div class="list-group">
         <a style="width:95%" href="userTestDetails?uId=' . $users['_id'] . '&qId=' . $item['testId'] . '&tId=' . $item['_id'] . '"  class="list-group-item"><br><h4 style="margin-top:-0.5%;text-align:center">' . $item['testName'] . '</h4><h2 style="margin-top:-2.9%;text-align:right">' . $item['score'] . '</h2></a>
     </div>';
            }
            ?>
            <br><br>

        </div>
        <!--END CONTENT-->
        <!--BEGIN FOOTER-->

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
