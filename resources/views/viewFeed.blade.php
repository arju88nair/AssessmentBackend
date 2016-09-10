<!DOCTYPE html>
<html lang="en">
<head>
    <title>Active Feeds
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
    </script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
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
    <script>
        $(document).ready(function () {
            document.getElementById("cat").value = '<?php echo $tag;?>';
            document.getElementById("own").value = '<?php echo $tag2;?>';

        });
    </script>
    <script>
        var user = localStorage.getItem('user');
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
                    Active Feeds
                </div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li>
                    <i class="fa fa-home">
                    </i>&nbsp;
                    <a
                            href="dashboardAction">Home
                    </a>&nbsp;&nbsp;
                    <i
                            class="fa fa-angle-right">
                    </i>&nbsp;&nbsp;
                </li>
                <li class="hidden">
                    <a href="#">Active Feeds
                    </a>&nbsp;&nbsp;
                    <i class="fa fa-angle-right">
                    </i>&nbsp;&nbsp;
                </li>
                <li class="active">Active Feeds
                </li>
            </ol>
            <div class="clearfix">
            </div>
        </div>
        <!--END TITLE & BREADCRUMB PAGE-->
        <!--BEGIN CONTENT-->
        <div class="container">
            <h2>Filter
            </h2>
            <br>
            <br>

            <div class="row">
                <form method="post" action="viewFeed"
                      enctype="multipart/form-data"
                      accept-charset="UTF-8">
                    <div class="col-sm-2">
                        <label>Channel
                        </label>

                        <div class="input-group">
                            <div class="">
                                <select name="Category" class="form-control" id="cat">
                                    <option value="All">All
                                    </option>
                                    <option value="Product Management">Product Management
                                    </option>
                                    <option value="Agile">Agile
                                    </option>
                                    <option value="Product Marketing">Product Marketing
                                    </option>
                                    <option value="UX">UX
                                    </option>
                                    <option value="Growth Hacking">Growth Hacking
                                    </option>
                                    <option value="Road Mapping">Road Mapping
                                    </option>
                                    <option value="Sales Enablement">Sales Enablement
                                    </option>
                                    <option value="Career">Career
                                    </option>
                                    <option value="Leadership">Leadership
                                    </option>
                                    <option value="Executive Presence">Executive Presence
                                    </option>
									 <option value="Data Science">Data Science
                                        </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label>Owner
                        </label>

                        <div class="input-group">
                            <div class="">
                                <select name="owner" class="form-control" id="own">
                                    <option value="All">All</option>
                                    <?php foreach( $tag1 as $item ): ?>
                                    <option value="<?=$item?>"><?=$item?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button style="line-height: 207%" type="submit" class="btn btn-default">Filter
                    </button>
                </form>
            </div>
            <br>
            <br>
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">Add new
                feed
                item
            </button>
            <br>
            <br>
            <?php foreach( $feed as $page ): ?>
            <div class="panel-group">
                <div class="panel panel-default" style="width:94%">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a style="text-align: center;font-weight: bolder;color:lightseagreen" data-toggle="collapse"
                               href="#<?= $page['_id']?>">
                                <?= $page['feedTitle']?>
                            </a>
							<span><?= count($page['likeCount'])?></span>
							<span style="color:black" class="glyphicon glyphicon-thumbs-up" aria-hidden="true">
                  </span>
                            
                            <p style="color: grey;margin-top: -1.5%;font-size: 60%;margin-left:69%">
                                <?= $page['category']?>
                            </p>

                            <p style="font-size: 60%;color: grey;margin-top: -1.9%;float: right;">
                                <strong>Added
                                    date:
                                </strong>
                                <?= $page['updated_at']?>
                            </p>
                        </h4>
                    </div>
                    <div id="<?= $page['_id']?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <?= $page['feedContent']?>
                            <img src="<?=$page["feedImage"]?>" class="img-rounded" alt="Cinque Terre" width="60"
                                 height="60" style="float:right">
                        </div>
                        <div class="panel-footer">
                            <a style="margin-left: 0%"
                               href="<?= $page['feedSource']?>">Source
                            </a>
                            <a style="margin-left: 4%"
                               href="<?= $page['feedAudio']?>">Audio
                            </a>
                            <?php $id = $page['_id']?>
                            <a style="margin-left: 54%;margin-top: 1%" href="#<?php echo '' . $id . '';?>"
                               class="btn btn-primary"
                               role="button" data-toggle="modal" data-target="#myModal2"
                               data-title="<?= $page['feedTitle']?>" data-image="<?= $page['feedImage']?>"
                               data-source="<?= $page['feedSource']?>" data-content="<?= $page['feedContent']?>"
                               data-sourcetag="<?= $page['feedSourceTag']?>" data-image_lw="<?= $page['feedImage_lw']?>"
                               data-audio="<?= $page['feedAudio']?>"
                               data-cat="<?= $page['category']?>"
                               data-trend="<?= $page['trending']?>"
                               data-type="<?= $page['feedType']?>"
                               data-loc="<?= $page['location']?>"
							   data-summ="<?= $page['summarised']?>"
							   data-added="<?= $page['addedBy']?>"
                               data-schedule="<?= $page['feedSchedule']?>"
                               data-date="<?= $page['feedDate']?>"
                               data-idtag="<?= $page['_id']?>">Edit feed
                            </a>
                            <a style="margin-left: 77%;margin-top: -5%"
                               href="deleteFeed?action=<?=$page['_id']?>"
                               class="btn btn-danger" role="button" onsubmit="return confSubmit();">Delete feed
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            <div class="modal fade" id="myModal" role="dialog">
                <script type="text/javascript">
                    $(document).ready(function () {
                        document.getElementById('owner').value = user;
                    });
                </script>
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;
                            </button>
                            <h4 class="modal-title">Add new feed
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ action('DashboardController@saveFeed') }}"
                                  enctype="multipart/form-data"
                                  accept-charset="UTF-8" >
                                <div class="form-group">
                                    <label for="usr">Feed title:
                                    </label>
                                    <input type="text" class="form-control" name="feedTitle" placeholder="Feed Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Image:
                                    </label>
                                    <input type="text" class="form-control" name="feedImage" placeholder="Feed Image URL"  required>
                                </div>

                                <div class="form-group">
                                    <label for="usr">Send Notifications:
                                    </label>
                                    <input type="checkbox" class="" name="gcm" style="margin-left:4%">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Audio:
                                    </label>
                                    <input type="file" class="form-control" name="images[]">
                                </div>


                                <h3>OR</h3>

                                <div class="form-group">
                                    <label for="usr">Feed Audio URL:
                                    </label>
                                    <input type="text" class="form-control" name="feedaudio" id="feedaudio" placeholder="Fedd Audio URL">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Schedule Date:
                                    </label>
                                    <input type="text" class="form-control" name="feedSchedule" id="feedSchedule" placeholder="YYYY/MM/DD" required>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="feedOwner" id="owner">
                                </div>

                                <br>
                                <label for="sel1"
                                       class="">Channel
                                </label>

                                <div class="">
                                    <select name="Category" class="form-control" id="cat">
                                        <option value="Product Management">Product Management
                                        </option>
                                        <option value="Agile">Agile
                                        </option>
                                        <option value="Product Marketing">Product Marketing
                                        </option>
                                        <option value="UX">UX
                                        </option>
                                        <option value="Growth Hacking">Growth Hacking
                                        </option>
                                        <option value="Road Mapping">Road Mapping
                                        </option>
                                        <option value="Sales Enablement">Sales Enablement
                                        </option>
                                        <option value="Career">Career
                                        </option>
                                        <option value="Leadership">Leadership
                                        </option>
                                        <option value="Executive Presence">Executive Presence
                                        </option>
										 <option value="Data Science">Data Science
                                        </option>
                                    </select>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="comment">Feed content:
                                    </label>
                      <textarea class="form-control" rows="5" name="feedContent" maxlength="400" >
                      </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Source URL:
                                    </label>
                                    <input type="text" class="form-control" name="sourceUrl" placeholder="Source of the field">
                                </div>

                                <a href="#demo" class="btn btn-info" data-toggle="collapse">Advanced Options</a>

                                <div id="demo" class="collapse">
                                    <br>

                                    <div class="form-group">
                                        <label for="usr">Feed Expiry date:
                                        </label>
                                        <input type="text" class="form-control" name="feedDate" placeholder="YYYY/MM/DD">
                                    </div>
                                    <label for="sel1"
                                           class="">Trending
                                    </label>

                                    <div class="">
                                        <select name="trending" class="form-control" id="trend">
                                           <option value="No">No
                                            </option>
											 <option value="Yes">Yes
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <label for="sel1"
                                           class="">Location
                                    </label>

                                    <div class="">
                                        <select name="loc" class="form-control" id="loc">
                                            <option value="All">All
                                            </option>
                                            <option value="Bangalore">Bangalore
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <label for="sel1"
                                           class="">Feed Type
                                    </label>

                                    <div class="">
                                        <select name="type" class="form-control" id="type">
                                            <option value="Normal">Normal
                                            </option>
                                            <option value="Promotional">Promotional
                                            </option>
                                        </select>
                                    </div> <div class="form-group">
                                        <label for="usr">Feed Summarised By:
                                        </label>
                                        <input type="text" class="form-control" name="summarised" >
                                    </div>
									  <div class="form-group">
                                        <label for="usr">Feed Added By:
                                        </label>
                                        <input type="text" class="form-control" name="addedBy" >
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Feed Source Tag:
                                        </label>
                                        <input type="text" class="form-control" name="sourceTitle" placeholder="Source Name">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                </button>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal2-->
            <div class="modal fade" id="myModal2" role="dialog">
                <script type="text/javascript">
                    $(document).ready(function () {
                        document.getElementById('owner').value = user;
                    });
                </script>
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;
                            </button>
                            <h4 class="modal-title">Edit feed
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ action('DashboardController@saveEditFeed') }}"
                                  enctype="multipart/form-data"
                                  accept-charset="UTF-8">
                                <div class="form-group">
                                    <label for="usr">Feed title:
                                    </label>
                                    <input type="text" class="form-control" name="feedTitle" id="feedTitle" placeholder="Title of the feed" required>
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Image Large:
                                    </label>
                                    <input type="text" class="form-control" name="feedImage" id="feedImage" placeholder="Feed image URL" required>
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Schedule Date:
                                    </label>
                                    <input type="text" class="form-control" name="feedSchedule" id="feedSchedule" placeholder="YYYY/MM/DD" required>
                                    </div>
                                <div class="form-group">
                                    <label for="usr">Send Notifications:
                                    </label>
                                    <input type="checkbox" class="" name="gcm" style="margin-left:4%">
                                </div>

                                <br>
                                <label for="sel1"
                                       class="">Channel
                                </label>

                                <div class="">
                                    <select name="Category" class="form-control" id="cat">
                                        <option value="Product Management">Product Management
                                        </option>
                                        <option value="Agile">Agile
                                        </option>
                                        <option value="Product Marketing">Product Marketing
                                        </option>
                                        <option value="UX">UX
                                        </option>
                                        <option value="Growth Hacking">Growth Hacking
                                        </option>
                                        <option value="Road Mapping">Road Mapping
                                        </option>
                                        <option value="Sales Enablement">Sales Enablement
                                        </option>
                                        <option value="Career">Career
                                        </option>
                                        <option value="Leadership">Leadership
                                        </option>
                                        <option value="Executive Presence">Executive Presence
                                        </option>
										 <option value="Data Science">Data Science
                                        </option>
                                    </select>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="inputPassword">Audio
                                    </label>
                                    <input class="form-control" name="disabledInput" id="disabledInput" type="text"
                                           >
                                </div>
                                <div class="form-group">
                                    <label for="comment">Feed content:
                                    </label>
                      <textarea class="form-control" rows="5" name="feedContent" id="feedContent"
                                maxlength="400" id="feedContent">
                      </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Source URL:
                                    </label>
                                    <input type="text" class="form-control" name="sourceUrl" id="sourceUrl" placeholder="Source URL of the feed">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="feedOwner" id="owner">
                                </div>
                                <a href="#demo2" class="btn btn-info" data-toggle="collapse">Advanced Options</a>
                                <div id="demo2" class="collapse">
                                    <label for="sel1"
                                           class="">Trending
                                    </label>

                                    <div class="">
                                        <select name="trending" class="form-control" id="trend">
                                             <option value="No">No
                                            </option>
											 <option value="Yes">Yes
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <label for="sel1"
                                           class="">Location
                                    </label>

                                    <div class="">
                                        <select name="loc" class="form-control" id="loc">
                                            <option value="All">All
                                            </option>
                                            <option value="Bangalore">Bangalore
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <label for="sel1"
                                           class="">Feed Type
                                    </label>

                                    <div class="">
                                        <select name="type" class="form-control" id="type">
                                            <option value="Normal">Normal
                                            </option>
                                            <option value="Promotional">Promotional
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Feed Expiry date:
                                        </label>
                                        <input type="text" class="form-control" name="feedDate" id="feedDate" placeholder="YYYY/MM/DD">
                                    </div>
									 <div class="form-group">
                                        <label for="usr">Feed Summarised By:
                                        </label>
                                        <input type="text" class="form-control" name="summarised" id="summarised" >
                                    </div>
									  <div class="form-group">
                                        <label for="usr">Feed Added By:
                                        </label>
                                        <input type="text" class="form-control" name="addedBy"  id="added">
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Feed Source Tag:
                                        </label>
                                        <input type="text" class="form-control" name="sourceTitle" id="sourceTitle" placeholder="Feed source name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" id="idTag">
                                </div>
                                <button type="submit" class="btn btn-primary">Save
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                </button>
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
<script src="script/jquery-1.10.2.min.js">
</script>
<script src="script/jquery-migrate-1.2.1.min.js">
</script>
<script src="script/jquery-ui.js">
</script>
<script src="script/bootstrap.min.js">
</script>
<script src="script/bootstrap-hover-dropdown.js">
</script>
<script src="script/html5shiv.js">
</script>
<script src="script/respond.min.js">
</script>
<script src="script/jquery.metisMenu.js">
</script>
<script src="script/jquery.slimscroll.js">
</script>
<script src="script/jquery.cookie.js">
</script>
<script src="script/icheck.min.js">
</script>
<script src="script/custom.min.js">
</script>
<script src="script/jquery.news-ticker.js">
</script>
<script src="script/jquery.menu.js">
</script>
<script src="script/pace.min.js">
</script>
<script src="script/holder.js">
</script>
<script src="script/responsive-tabs.js">
</script>
<script src="script/jquery.flot.js">
</script>
<script src="script/jquery.flot.categories.js">
</script>
<script src="script/jquery.flot.pie.js">
</script>
<script src="script/jquery.flot.tooltip.js">
</script>
<script src="script/jquery.flot.resize.js">
</script>
<script src="script/jquery.flot.fillbetween.js">
</script>
<script src="script/jquery.flot.stack.js">
</script>
<script src="script/jquery.flot.spline.js">
</script>
<script src="script/zabuto_calendar.min.js">
</script>
<script src="script/index.js">
</script>
<!--LOADING SCRIPTS FOR CHARTS-->
<script src="script/highcharts.js">
</script>
<script src="script/data.js">
</script>
<script src="script/drilldown.js">
</script>
<script src="script/exporting.js">
</script>
<script src="script/highcharts-more.js">
</script>
<script src="script/charts-highchart-pie.js">
</script>
<script src="script/charts-highchart-more.js">
</script>
<!--CORE JAVASCRIPT-->
<script src="script/main.js">
</script>
<script>        (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }
                , i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-145464-12', 'auto');
    ga('send', 'pageview');
</script>
<script>
    $('#myModal2').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                // Button that triggered the modal
                var title = button.data('title');
                var image = button.data('image');
                var image_lw = button.data('image_lw');
                var source = button.data('source');
                var content = button.data('content');
                var sourceTag = button.data('sourcetag');
                var idTag = button.data('idtag');
                var audio = button.data('audio');
                var cat = button.data('cat');
                var trend = button.data('trend');
                var type = button.data('type');
                var loc = button.data('loc');
                var schedule = button.data('schedule');
                var date = button.data('date');
				var summ=button.data('summ');
				var added=button.data('added');
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
                modal.find('#cat').val(cat);
                modal.find('#type').val(type);
                modal.find('#trend').val(trend);
                modal.find('#loc').val(loc);
                modal.find('#disabledInput').val(audio);
                modal.find('#feedDate').val(date);
                modal.find('#feedSchedule').val(schedule);
				modal.find('#summarised').val(summ);
				modal.find('#added').val(added);


            }
    )
</script>
<script type="text/javascript">
    function confSubmit() {
        var r=confirm('Are you sure you want to delete??');
        return r;
    }
</script>
</body>
</html>
