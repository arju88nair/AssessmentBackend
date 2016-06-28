<!DOCTYPE html>
<html lang="en">
<head>
    <title>Active Feeds</title>
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
                    Active Feeds
                </div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a
                            href="http://localhost/Laravel/Assessment/public/dashboardAction">Home</a>&nbsp;&nbsp;<i
                            class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                <li class="hidden"><a href="#">Active Feeds</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;
                </li>
                <li class="active">Active Feeds</li>
            </ol>
            <div class="clearfix">
            </div>
        </div>
        <!--END TITLE & BREADCRUMB PAGE-->
        <!--BEGIN CONTENT-->
        <div class="container">

            <h1>Active Feeds</h1>
            <br><br>

            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">Add new
                feed
                item
            </button>

            <br><br>
            <?php foreach( $feed as $page ): ?>

            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <img src="<?=$page["feedImage"]?>" class="img-rounded" alt="Cinque Terre" width="60"
                                 height="60">
                            <a style="text-align: center;font-weight: bolder;color:lightseagreen" data-toggle="collapse"
                               href="#<?= $page['_id']?>"><?= $page['feedTitle']?></a>

                            <p style="font-size: 60%;color: grey;margin-top: 2.5%;float: right;"><strong>Added
                                    date:</strong><?= $page['updated_at']?></p>
                        </h4>
                    </div>
                    <div id="<?= $page['_id']?>" class="panel-collapse collapse">
                        <div class="panel-body"><?= $page['feedContent']?></div>
                        <div class="panel-footer"><a style="margin-left: 0%"
                                                     href="<?= $page['feedSource']?>"><?= $page['feedSourceTag']?></a>

                            <a style="margin-left: 4%"
                               href="<?= $page['feedAudio']?>">Audio</a>

                            <?php $id = $page['_id']?>
                            <a style="margin-left: 63%;margin-top: 0%" href="#<?php echo '' . $id . '';?>"
                               class="btn btn-primary"
                               role="button" data-toggle="modal" data-target="#myModal2"
                               data-title="<?= $page['feedTitle']?>" data-image="<?= $page['feedImage']?>"
                               data-source="<?= $page['feedSource']?>" data-content="<?= $page['feedContent']?>"
                               data-sourcetag="<?= $page['feedSourceTag']?>" data-image_lw="<?= $page['feedImage_lw']?>" data-audio="<?= $page['feedAudio']?>"
                               data-idtag="<?= $page['_id']?>">Edit feed</a>
                            <a style="margin-left: 84%;margin-top: -5%"
                               href="http://localhost/Laravel/Assessment/public/deleteFeed?action=<?=$page['_id']?>"
                               class="btn btn-danger" role="button">Delete feed</a>

                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach ?>


            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add new feed</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ action('DashboardController@saveFeed') }}"
                                  enctype="multipart/form-data"
                                  accept-charset="UTF-8">
                                <div class="form-group">
                                    <label for="usr">Feed title:</label>
                                    <input type="text" class="form-control" name="feedTitle">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Image Large:</label>
                                    <input type="text" class="form-control" name="feedImage">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Audio:</label>
                                    <input type="file" class="form-control" name="images[]">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Image Small:</label>
                                    <input type="text" class="form-control" name="feedImage_lw">
                                </div>
                                <div class="form-group">
                                    <label for="comment">Feed content:</label>
                                    <textarea class="form-control" rows="5" name="feedContent"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Source URL:</label>
                                    <input type="text" class="form-control" name="sourceUrl">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Source Tag:</label>
                                    <input type="text" class="form-control" name="sourceTitle">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>

                </div>
            </div>

            <!--Modal2-->
            <div class="modal fade" id="myModal2" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit feed</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ action('DashboardController@saveEditFeed') }}"
                                  accept-charset="UTF-8">
                                <div class="form-group">
                                    <label for="usr">Feed title:</label>
                                    <input type="text" class="form-control" name="feedTitle" id="feedTitle">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Image Large:</label>
                                    <input type="text" class="form-control" name="feedImage" id="feedImage">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Image Small:</label>
                                    <input type="text" class="form-control" name="feedImage_lw" id="feedImage_lw">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Audio:</label>
                                    <input type="file" class="form-control" name="images[]">
                                </div>
                                <div class="form-group">
                                    <label for="comment">Feed content:</label>
                                    <textarea class="form-control" rows="5" name="feedContent" id="feedContent"
                                              id="feedContent"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Source URL:</label>
                                    <input type="text" class="form-control" name="sourceUrl" id="sourceUrl">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Source Tag:</label>
                                    <input type="text" class="form-control" name="sourceTitle" id="sourceTitle">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" id="idTag">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </form>
                        </div>
                        <div class="modal-footer">
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
<script>var text = document.getElementById("infoartist").value;
    text = text.replace(/\r?\n/g, '<br />');</script>
<script>

    $('#myModal2').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var title = button.data('title');
        var image = button.data('image');
        var image_lw = button.data('image_lw');
        var source = button.data('source');
        var content = button.data('content');
        var sourceTag = button.data('sourcetag');
        var idTag = button.data('idtag');
        var audio=button.data('audio');

        // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#feedTitle').val(title);
        modal.find('#feedImage').val(image);
        modal.find('#feedImage_lw').val(image_lw);
        modal.find('#sourceUrl').val(source);
        modal.find('#feedContent').val(content);
        modal.find('#sourceTitle').val(sourceTag);
        modal.find('#idTag').val(idTag);
        modal.find('#disabledInput').val(audio);

    })


</script>
</body>
</html>
