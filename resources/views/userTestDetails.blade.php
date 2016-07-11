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
                    View User</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a href="dashboardAction">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="hidden"><a href="#">View User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="active">View User</li>
            </ol>
            <div class="clearfix">
            </div>
        </div>
        <!--END TITLE & BREADCRUMB PAGE-->
        <!--BEGIN CONTENT-->


        <div style="float: right;width:40%; height:auto;margin-right: 2%" class="container">


            <img style=" display: block; margin: 0 auto;" src=<?=$users['imageUrl']?> class="img-circle" alt="Cinque Terre"
                 width="140" height="130">
            <br>

            <p style="text-align: center;"><strong> <?=$users['name']?></strong></p>

            <br>

            <div class="well-lg "
                 style="display: block; margin: 0 auto;background-color: lightgrey;width:30%; height:20%;border:thin solid grey">

                <h3 style="text-align:center"> <?=$itema['score']?>/5</h3>


            </div>
            <br><br>

            <?php

            if (isset($report) || count($report) != 0) {

                if ($report['status'] == "Pending") {
                    echo "
          <button style=\" margin-left:8%\"type=\"button\" class=\"btn btn-primary active\" data-toggle=\"modal\" data-target=\"#myModal\">Report Requested</button>
";

                } else {
                    echo "
    <button style=\" margin-left:8%\" type=\"button\" class=\"btn btn-primary disabled\">Report not requested</button>


   ";

                }


            } else {
                echo "
    <button style=\"margin-left:8%\" type=\"button\" class=\"btn btn-primary disabled\">Not requested</button>


   ";
            }


            if (isset($assistance) || count($assistance) != 0) {
                if ($assistance['status'] == "Pending") {
                    echo "
          <button style=\"margin-left:8%\" type=\"button\" class=\"btn btn-primary active\">Assistance Requested</button>
";

                } else {
                    echo "
    <button style=\"margin-left:8%\" type=\"button\" class=\"btn btn-primary disabled\">Not requested</button>


   ";

                }

            } else {
                echo "
    <button styletype=\"button\" class=\"btn btn-primary disabled\">Assistance not requested</button>


   ";
            }



            ?>


        </div>
        <div class="container">
            <h1 style="text-align: center">Individual details</h1>

            <br>
            <br>
            <br>
            <br>
            <br>

            <p><strong>Test Name</strong> : <?=$fulltest['testName']?> </p>

            <p><strong>Test Duration</strong> : <?=$fulltest['testDuration']?> Minutes</p>

            <p><strong>Submited Date</strong> : <?=$itema['updated_at']?> </p>

            <p><strong>Unique answer Id</strong> : <?=$itema['_id']?> </p>

            <p><strong>Summary </strong>: <?=$fulltest['shortDescription']?> </p>

            <br>
            <br>
            <br>

            <h3>Questions </h3>
            </br>
            <br>

            <?php $count = 0; ?>

            <?php foreach( $fulltest['questions'] as $item ): ?>


            <div class="panel panel-info">
                <div class="panel-heading">Question Title: <?=$item['questiontitle']?></div>
            </div>
            <ul class="list-group">
                <?php foreach ($item['options'] as $items): ?>
                <li class="list-group-item"><span class="glyphicon glyphicon-minus"></span> <?=$items?></li>
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
    $('.list-group-item:nth-child($num)').css('background-color','lightgreen');


            </script>
        ";




                ?>
            </ul>


            <?php $count++;?>


            <?php endforeach ?>

            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Upload report</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(array('url'=>'apply/multiple_upload','method'=>'POST', 'files'=>true)) !!}

                            {!! Form::file('images[]', array('multiple'=>true)) !!}
                            {{ Form::hidden('sessionHandle',$users['usrSessionHdl']) }}
                            {{ Form::hidden('testName',$fulltest['testName']) }}
                            {{ Form::hidden('testId',$fulltest['_id']) }}



                            <hr>

                            {!! Form::submit('Submit' ,array('class' => 'btn btn-primary')) !!}
                            {!! Form::close() !!}                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
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
