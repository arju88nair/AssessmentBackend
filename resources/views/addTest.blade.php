<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Test</title>
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
<body>
<div>


    @include('includes.header');


    <!--BEGIN PAGE WRAPPER-->
    <div id="page-wrapper">
        <!--BEGIN TITLE & BREADCRUMB PAGE-->
        <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
            <div class="page-header pull-left">
                <div class="page-title">
                    Add New Test</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a href="http://localhost/Laravel/Assessment/public/dashboardAction">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="hidden"><a href="#">Add New Test</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="active">Add New Test</li>
            </ol>
            <div class="clearfix">
            </div>
        </div>
        <!--END TITLE & BREADCRUMB PAGE-->
        <!--BEGIN CONTENT-->


        <div class="container">




            <h1>Add new test</h1>
            <hr>
            <hr>
            <form class="form-horizontal" role="form" method="post" action="{{ action('userController@saveTest') }}"
                  accept-charset="UTF-8">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Test Name:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tName" placeholder="Enter Test Name"
                               value="">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Image URL:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ImageUrl" placeholder="Enter Image URL"
                               value="">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Test Duration:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="tDuration" placeholder="Enter Test Duration"
                               value="">
                    </div>
                </div>


                <div class="form-group">
                    <label for="sel1">Skip Flag:</label>
                    <select name="flag" class="form-control">
                        <option vale="False">False</option>
                        <option value="True">True</option>

                    </select>
                </div>


                <div class="form-group">
                    <label for="status" >Test Status:</label>
                    <select name="status"  class="form-control">
                        <option vale="Active">Active</option>
                        <option value="Disable">Disable</option>

                    </select>
                </div>



                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Corporate URL:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="CURL" placeholder="Enter Corporate URL"
                               value="">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="owner">Owner:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="owner" placeholder="Enter Owner Name"
                               value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Weightage</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="Weightage" placeholder="Enter Weightage"
                               value="">
                    </div>
                </div>


                <div class="form-group">
                    <label for="comment">Summary:</label>
                    <textarea class="form-control" rows="5" name="Summary"></textarea>
                </div>


                <div class="form-group">
                    <label for="comment">Description:</label>
                    <textarea class="form-control" rows="5" name="description"></textarea>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Expiry Date:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="date" placeholder="Enter Expiry Date"
                               value="">
                    </div>
                </div>

                <hr>
                <hr>
                <br>
                <br>

                <h3>Questions </h3>
                <br>

                <div class="field_wrapper">
                    <div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Question Title:</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="Qtitle[]" placeholder="Enter question title"
                                       value="">
                            </div>
                            <br>
                            <label for="sel1">Multiple-choice:</label>
                            <select name="Mflag[]" class="form-control">
                                <option vale="False">False</option>
                                <option value="True">True</option>

                            </select>

                            <br>
                            <label class="control-label col-sm-2" for="email">Question Image URL:</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="QURL[]" placeholder="Enter Question Image URL"
                                       value="">
                            </div>
                            <br>
                            <br>
                            <br>


                            <label class="control-label col-sm-2" for="email">Question weightage:</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="weightage[]" placeholder="Enter Question weightage"
                                       value="">
                            </div>
                            <br>
                            <br>
                            <br>

                            <div class="col-sm-10">
                                <label class="control-label col-sm-2" for="email">Option:</label>
                                <input type="text" class="form-control" name="qOption[]" placeholder="Enter options"
                                       value="">
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="col-sm-10">
                                <label class="control-label col-sm-2" for="email">Option:</label>
                                <input type="text" class="form-control" name="qOption[]" placeholder="Enter options"
                                       value="">
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="col-sm-10">
                                <label class="control-label col-sm-2" for="email">Option:</label>
                                <input type="text" class="form-control" name="qOption[]" placeholder="Enter options"
                                       value="">
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="col-sm-10">
                                <label class="control-label col-sm-2" for="email">Option:</label>
                                <input type="text" class="form-control" name="qOption[]" placeholder="Enter options"
                                       value="">
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                            <label class="control-label col-sm-2" for="email">Answer key:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="qAnswer[]" placeholder="Enter answer key"
                                       value="">
                            </div>
                        </div>
                        <br>
                        <br>
                        <hr>
                        <br>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Save</button>

                <a href="javascript:void(0);" id="btn btn-primary" class="add_button btn btn-info" title="Add field">Add new field</a>
                <a href="http://localhost/Laravel/Assessment/public/dashboardAction" class="btn btn-default" role="button">Cancel</a>

            </form>

            <br>
            <br>
            <br>
            <br>


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
