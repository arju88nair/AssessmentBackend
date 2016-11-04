<!DOCTYPE html>
<html lang="en">
<head>
    <title>Set Feed</title>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        $(document).ready(function () {
            var user = localStorage.getItem('user');
            if (user == "content_admin") {
                $('#setId').show()
            }
            else {
                $('#setId').hide()
            }
            if (user == "" || user == "null" || user == "undefined" || user == undefined) {
                window.location.href = "loginAdmin"
            }
        });
    </script>

    <style>

        .alert {
            display: none;
        }

        #sortable1 {
            border: 1px solid #eee;
            min-height: 20px;
            list-style-type: none;
            margin: 0;
            padding: 5px 0 0 0;
        }

        hr.vertical {
            width: 0px;
            height: 100%; /* or height in PX */
        }

        #sortable2 {
            border: 1px solid #eee;
            list-style-type: none;
            padding: 5px 0 0 0;

        }

        #sortable1 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
        }

        #sortable2 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {
            $("#Shareitem").click(function (e) {
                var liIds = $('#sortable1 li').map(function (i, n) {
                    return $(n).attr('id');
                }).get().join(',');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "saveSetFeed",
                    data: {"ids": liIds},
                    success: function (response) {
                        console.log(response);
                        $('#success').show()
                    },
                    error: function (response) {
                        console.log(response);
                        $('#error').show()


                    }
                });

            });
        });
    </script>
    <script>
        $(function () {
            $("#sortable1, #sortable2").sortable({
                connectWith: ".connectedSortable"
            }).disableSelection();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.panel-collapse.in')
                    .collapse('hide');

        });

    </script>
    <style>

        .search-form .form-group {
            float: right !important;
            transition: all 0.35s, border-radius 0s;
            width: 32px;
            height: 32px;
            background-color: #fff;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
            border-radius: 25px;
            border: 1px solid #ccc;
        }

        .search-form .form-group input.form-control {
            padding-right: 20px;
            border: 0 none;
            background: transparent;
            box-shadow: none;
            display: block;
        }

        .search-form .form-group input.form-control::-webkit-input-placeholder {
            display: none;
        }

        .search-form .form-group input.form-control:-moz-placeholder {
            /* Firefox 18- */
            display: none;
        }

        .search-form .form-group input.form-control::-moz-placeholder {
            /* Firefox 19+ */
            display: none;
        }

        .search-form .form-group input.form-control:-ms-input-placeholder {
            display: none;
        }

        .search-form .form-group:hover,
        .search-form .form-group.hover {
            width: 100%;
            border-radius: 4px 25px 25px 4px;
        }

        .search-form .form-group span.form-control-feedback {
            position: absolute;
            top: -1px;
            right: -2px;
            z-index: 2;
            display: block;
            width: 34px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            color: #3596e0;
            left: initial;
            font-size: 14px;
        }

        a {
            color: #428bca;
        }

        @media ( min-width: 768px ) {
            .grid-divider {
                position: relative;
                padding: 0;
            }

            .grid-divider > [class*='col-'] {
                position: static;
            }

            .grid-divider > [class*='col-']:nth-child(n+2):before {
                content: "";
                border-left: 1px solid #DDD;
                position: absolute;
                top: 0;
                bottom: 0;
            }

            .col-padding {
                padding: 0 15px;
            }
        }

    </style>
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
                    Set Feed
                </div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a href="dashboardAction">Home</a>&nbsp;&nbsp;<i
                            class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="hidden"><a href="#">Set Feed</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                </li>
                <li class="active">Set Feed</li>
            </ol>
            <div class="clearfix">
            </div>
        </div>
        <!--END TITLE & BREADCRUMB PAGE-->
        <!--BEGIN CONTENT-->


        <div id="container">
            <div class="alert alert-success fade in" id="success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Feeds have been updated.
            </div>
            <div class="alert alert-danger fade in" id="error">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> Something went wrong.Refresh and try again.
            </div>
            <button id="Shareitem" class="btn btn-primary btn-lg btn-block" type="button">Update Today's feed</button>

            <div class="col1 col-md-6" style="margin-left: 3%;padding-top: 2%">
                <h4 style="">Todays Feed</h4>
                <ul id="sortable1" class="connectedSortable">
                    <?php
                    foreach ($main as $page):
                    ?>
                    <li id="<?= $page['_id'] ?>" class="ui-state-default"><span id="title"
                                                                                style="margin-left: 2%;"><b><?= $page['feedTitle'] ?> </b>&nbsp;<small>[<?= $page['category'] ?>]</small></span>
                        &nbsp;
                        <div><span id="date"
                                   style="font-size: 80%;margin-left: 8%">Updated on <?= date('F Y D', strtotime($page['updated_at'])); ?></span><span
                                    id="added" style="font-size: 80%">&nbsp; By <?= $page['summarised'] ?></span></div>
                    </li>


                    <?php
                    endforeach;
                    ?>


                </ul>
            </div>

            <div class="row">
                <div class="col-lg-1"></div>

                <div class="col-lg-5" id="second" style="margin-top: 2%">
                    <h4 style="padding-left: 5%">Add Feed</h4>

                    <div class="col2 col-lg-12" style=" height:400px;padding-top: 1%;">

                        <ul id="sortable2" class="connectedSortable" style="    margin-top: -5px;"></ul>
                        <hr id="hr" style="border:1px solid grey;">

                        <ul class="pager">
                            <li class="previous"><a href="" onclick="prevPage(); return false;">Previous</a></li>
                            <li class="next"><a href="" onclick="nextPage(); return false;">Next</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5"></div>
            </div>
            <script>
                var items = '<?php
echo json_encode($other);
?>';
                console.log(items);
                var pager = {};
                items=items.replace(/\\n/g, "\\n")
                        .replace(/\\'/g, "\\'")
                        .replace(/\\"/g, '\\"')
                        .replace(/\\&/g, "\\&")
                        .replace(/\\r/g, "\\r")
                        .replace(/\\t/g, "\\t")
                        .replace(/\\b/g, "\\b")
                        .replace(/\\f/g, "\\f");
                // remove non-printable and other non-valid JSON chars
                items = items.replace(/[\u0000-\u0019]+/g,"");
                pager.items = JSON.parse(items);
                pager.itemsPerPage =4;
                pagerInit(pager);

                function bindList() {
                    var pgItems = pager.pagedItems[pager.currentPage];
                    $("#sortable2").empty();
                    for (var i = 0; i < pgItems.length; i++) {
                        for (var key in pgItems[i]) {
                            var option = $('<li class="ui-state-highlight" id=' + pgItems[i]['_id'] + '>');
                            option.html("<span id=\"title\" style=\"margin-left: 2%;\"><b>"+pgItems[i]["feedTitle"]+"</b>&nbsp;<small>["+pgItems[i]["category"]+"]</small></span>&nbsp;<div> <span id=\"date\" style=\"font-size: 80%;margin-left: 8%\">Updated on "+pgItems[i]["updated_at"]+"</span><span id=\"added\" style=\"font-size: 80%\">&nbsp; By "+pgItems[i]["summarised"]+"</span></div> ");
                        }
                        $("#sortable2").append(option);
                    }
                }
                function prevPage() {
                    pager.prevPage();
                    bindList();
                }
                function nextPage() {
                    pager.nextPage();
                    bindList();
                }
                function pagerInit(p) {
                    p.pagedItems = [];
                    p.currentPage = 0;
                    if (p.itemsPerPage === undefined) {
                        p.itemsPerPage = 5;
                    }
                    p.prevPage = function () {
                        if (p.currentPage > 0) {
                            p.currentPage--;
                        }
                    };
                    p.nextPage = function () {
                        if (p.currentPage < p.pagedItems.length - 1) {
                            p.currentPage++;
                        }
                    };
                    init = function () {
                        for (var i = 0; i < p.items.length; i++) {
                            if (i % p.itemsPerPage === 0) {
                                p.pagedItems[Math.floor(i / p.itemsPerPage)] = [p.items[i]];
                            } else {
                                p.pagedItems[Math.floor(i / p.itemsPerPage)].push(p.items[i]);
                            }
                        }
                    };
                    init();
                }
                $(function () {
                    bindList();
                });
            </script>


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
<script>
    var li = $('#list1 li').map(function (i, n) {
        return $(n).attr('id');
    }).get().join(',');


</script>
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
