<!DOCTYPE html>
<html lang="en">
<head>
    <title>Set Today's Feed</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://rawgithub.com/darkskyapp/skycons/master/skycons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
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
            padding: 8px;
            font-size: 1.2em;
            background-color: white;
            border:thin solid lightgrey;
        }

        #sortable2 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
            border:thin solid lightgrey;
            background-color: khaki;
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


<body>
<style type="text/css">
    #wrapper {
        padding-left: 0;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #wrapper.toggled {
        padding-left: 250px;
    }

    #sidebar-wrapper {
        position: fixed;
        left: 250px;
        z-index: 1000;
        overflow-y: auto;
        margin-left: -250px;
        width: 0;
        height: 100%;
        background: #000;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 250px;
    }

    #page-content-wrapper {
        padding: 15px;
        width: 100%;
    }

    #wrapper.toggled #page-content-wrapper {
        position: absolute;
        margin-right: -250px;
    }

    /* Sidebar Styles */

    .sidebar-nav {
        position: absolute;
        top: 0;
        margin: 0;
        padding: 0;
        width: 250px;
        list-style: none;
    }

    .sidebar-nav li {
        text-indent: 20px;
        line-height: 40px;
    }

    .sidebar-nav li a {
        display: block;
        color: #999999;
        text-decoration: none;
    }

    .sidebar-nav li a:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        text-decoration: none;
    }

    .sidebar-nav li a:active,
    .sidebar-nav li a:focus {
        text-decoration: none;
    }

    .sidebar-nav > .sidebar-brand {
        height: 65px;
        font-size: 18px;
        line-height: 60px;
    }

    .sidebar-nav > .sidebar-brand a {
        color: #999999;
    }

    .sidebar-nav > .sidebar-brand a:hover {
        background: none;
        color: #fff;
    }

    @media (min-width: 768px) {
        #wrapper {
            padding-left: 250px;
        }

        #wrapper.toggled {
            padding-left: 0;
        }

        #sidebar-wrapper {
            width: 250px;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 0;
        }

        #page-content-wrapper {
            padding: 20px;
        }

        #wrapper.toggled #page-content-wrapper {
            position: relative;
            margin-right: 0;
        }
    }
</style>
<nav class="navbar navbar-inverse" style="margin-bottom: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li id="Mikrolearn" style="font-size: 1.8em"><a href="addFeed"> Mikrolearn</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="loginAdmin"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log Out</a></li>
            </ul>
            <!--             <form class="navbar-form navbar-right" action="#" method="GET">
                               <div class="input-group">
                                <input class="form-control" placeholder="Search..." id="query" name="search" value="" type="text">
                                  <div class="input-group-btn">
                                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                                  </div>
                            </div>
                        </form> -->
        </div>
    </div>
</nav>
<div id="wrapper" class="toggled">
    <div class="container-fluid">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <br>
                </li>
                {{--<li class="sidebar-brand">--}}
                    {{--<a href="#" class="navbar-brand">--}}
                        {{--<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Add feeds--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li style="font-size: 1.2em">
                    <a href="addFeed"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;&nbsp; Add feeds</a>
                </li>
                <li id="setId" style="font-size: 1.2em">
                    <a href="setFeed"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; &nbsp;Set Todays Shots</a>
                </li>


            </ul>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <!--         <div id="page-content-wrapper">
     --><!--             <div class="container-fluid">
 -->      <!--           <div class="row"  style="text-align: center; background-color: bisque;margin-bottom: 1%;">
                    <div class="col-lg-12">
                      <br>
                      <h1>Your Title</h1>
                    </div>
                </div> -->



    <div id="container" style="background-color: #F0F2F5">

        <br>
        <div id="help" style="text-align: center;font-weight: bold;font-size: 1.4em">Drag and drop to set today's shots!</div>
        <br>
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
            <h4 style="">Add Feed</h4>
            <div class="col2 col-lg-12" style=" height:400px;padding-top: 1%;">

                <ul id="sortable2" class="connectedSortable" style="    margin-top: -5px;"></ul>
                <hr id="hr" style="border:1px solid grey;">

                <ul class="pager">
                    <li class="previous"><a href="" onclick="prevPage(); return false;">Previous</a></li>
                    <li class="next"><a href="" onclick="nextPage(); return false;">Next</a></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-1"></div>

            <div class="col-lg-5" id="second" style="margin-top: 2%">
                <h4 style="padding-left: 5%">Today's Feed</h4>
                <ul id="sortable1" class="connectedSortable">
                    <?php
                    foreach ($main as $page):
                    ?>
                    <li id="<?= $page['_id'] ?>" class="ui-state-default"><span id="title"
                                                                                style="margin-left: 2%;font-weight: bold"><?= $page['feedTitle'] ?> </span>
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
                    .replace(/\\/g, "\\\\")
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
                        option.html("<span id=\"title\" style=\"margin-left: 2%;font-weight: bold\">"+pgItems[i]["feedTitle"]+"</span>&nbsp;<div> <span id=\"date\" style=\"font-size: 80%;margin-left: 8%\">Updated on "+pgItems[i]["updated_at"]+"</span><span id=\"added\" style=\"font-size: 80%\">&nbsp; By "+pgItems[i]["summarised"]+"</span></div> ");
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

    <!-- /#page-content-wrapper -->
</div>
</div>
<!-- /#wrapper -->

<script type="text/javascript">
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>