<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Shots</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://rawgithub.com/darkskyapp/skycons/master/skycons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <script>

        $(document).ready(function () {
            document.getElementById("cat").value = '<?php
echo $tag;
?>';
            document.getElementById("own").value = '<?php
echo $tag2;
?>';
        });
    </script>
    <script>
        $(document).ready(function () {
            var user = localStorage.getItem('user');
            if (user == "content_admin") {
                $('#setId').show();
                $('#accept').show();
                $('#reject').show();

            }
            else {
                $('#setId').hide();
                $('#accept').hide();
                $('#reject').hide();
            }
            if (user == "" || user == "null" || user == "undefined" || user == undefined) {
                window.location.href = "loginAdmin"
            }
        });
    </script>
</head>


<body>
<style type="text/css">
    #feedContent {
        word-wrap: break-word;
    }

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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-list"
                                                                               aria-hidden="true"></span></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li id="Mikrolearn" style="font-size: 1.8em"><a href="addFeed"> Mikrolearn</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="loginAdmin"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log Out</a>
                </li>
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
                    <a href="addFeed"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;&nbsp;
                        Add feeds</a>
                </li>
                <li id="setId" style="font-size: 1.2em">
                    <a href="setFeed"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; &nbsp;Set
                        Today's Feeds</a>
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


    <div class="container">
        <h2>Filter
        </h2>
        <br>
        <br>

        <div class="row">
            <form method="post" action="viewFeed"
                  enctype="multipart/form-data"
                  accept-charset="UTF-8">
                <input type="hidden" value="first" name="first">
                <input type="hidden" value="<?= $user ?>" name="user">

                <div class="col-sm-2">
                    <label>Category
                    </label>

                    <div class="input-group">
                        <div class="">
                            <select name="Category" class="form-control" id="cat">
                                <option value="All">All
                                </option>
                                <option value="Product Management">Product Management
                                </option>
                                <option value="Agile Planning">Agile Planning
                                </option>
                                <option value="Product Marketing">Product Marketing
                                </option>
                                <option value="User Experience Design">User Experience Design
                                </option>
                                <option value="Growth Hacking">Growth Hacking
                                </option>
                                <option value="Career Management">Career Management
                                </option>
                                <option value="Emerging Technologies">Emerging Technologies
                                </option>
                                <option value="Leadership">Leadership
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
                                <?php
                                foreach ($tag1 as $item):
                                ?>
                                <option value="<?= $item ?>"><?= $item ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <button style="line-height: 207%" type="submit" class="btn btn-default" name="button"
                        value="filter">Filter
                </button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <button style="line-height: 207%" type="submit" class="btn btn-default" name="button" value="sort">
                    Sort by likes
                </button>
            </form>
        </div>
        <div class="second">

        </div>
        <br>
        <br>
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">Add new
            feed
            item
        </button>
        <br>

        <br>
        <?php
        foreach ($feed as $page):
        ?>
        <div class="panel-group">
            <div class="panel panel-default" style="width:94%">
                <div class="panel-heading">
                    <h4 class="panel-title">

                        <a style="text-align: center;font-weight: bolder;color:lightseagreen" data-toggle="collapse"
                           href="#<?= $page['_id'] ?>">
                            <?= $page['feedTitle'] ?>
                        </a>
                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $page['likeCount'] ?></span>
							<span style="color:grey" class="glyphicon glyphicon-thumbs-up" aria-hidden="true">
                  </span>
                        &nbsp;&nbsp;
                        <span style="font-size: 72%">&nbsp;&nbsp;&nbsp;<b>Status :</b>&nbsp;&nbsp;<small><?= $page['feedStatus'] ?></small></span>


                        <p style="color: grey;margin-top: -1.5%;font-size: 60%;margin-left:69%">
                            <?= $page['category'] ?>
                        </p>

                        <p style="font-size: 60%;color: grey;margin-top: -1.9%;float: right;">
                            <strong>Added
                                date:
                            </strong>
                            <?= $page['updated_at'] ?>
                        </p>
                    </h4>
                </div>
                <div id="<?= $page['_id'] ?>" class="panel-collapse collapse">
                    <div class="panel-body" style="word-wrap: break-word">
                        <?= $page['feedContent'] ?>
                        <img src="<?= $page["feedImage"] ?>" class="img-rounded" alt="Cinque Terre" width="60"
                             height="60" style="float:right">
                    </div>
                    <div class="panel-footer">
                        <a style="margin-left: 0%"
                           href="<?= $page['feedSource'] ?>">Source
                        </a>
                        <a style="margin-left: 4%"
                           href="<?= $page['feedAudio'] ?>">Audio
                        </a>


                        <?php
                        if ($user != "content_admin") {
                        ?>

                        <?php
                        if ($user == $page['feedOwner']) {
                        ?>

                        <?php
                        $id = $page['_id']?>
                        <a style="margin-left: 54%;margin-top: 1%" href="#<?php
                        echo '' . $id . '';
                        ?>"
                           class="btn btn-primary"
                           role="button" data-toggle="modal" data-target="#myModal2"
                           data-title="<?= $page['feedTitle'] ?>" data-image="<?= $page['feedImage'] ?>"
                           data-source="<?= $page['feedSource'] ?>" data-content="<?= $page['feedContent'] ?>"
                           data-sourcetag="<?= $page['feedSourceTag'] ?>"
                           data-image_lw="<?= $page['feedImage_lw'] ?>"
                           data-audio="<?= $page['feedAudio'] ?>"
                           data-cat="<?= $page['category'] ?>"
                           data-trend="<?= $page['trending'] ?>"
                           data-type="<?= $page['feedType'] ?>"
                           data-loc="<?= $page['location'] ?>"
                           data-date="<?= $page['feedDate'] ?>"
                           data-summ="<?= $page['summarised'] ?>"
                           data-added="<?= $page['addedBy'] ?>"
                           data-schedule="<?= $page['feedSchedule'] ?>"
                           data-idtag="<?= $page['_id'] ?>">Edit feed
                        </a>
                        <a style="margin-left: 77%;margin-top: -5%"
                           href="deleteFeed?action=<?= $page['_id'] ?>&user=<?= $user ?>"
                           class="btn btn-danger" role="button" onclick="return confSubmit2();">Delete feed
                        </a>
                        <button style="margin-left: 89%;margin-top: -8.5%;" type="button"
                                class="btn btn-info"
                                data-toggle="modal" data-title="<?= $page['feedTitle'] ?>"
                                data-image="<?= $page['feedImage'] ?>"
                                data-source="<?= $page['feedSource'] ?>" data-content="<?= $page['feedContent'] ?>"
                                data-sourcetag="<?= $page['feedSourceTag'] ?>"
                                data-image_lw="<?= $page['feedImage_lw'] ?>"
                                data-audio="<?= $page['feedAudio'] ?>"
                                data-cat="<?= $page['category'] ?>"
                                data-trend="<?= $page['trending'] ?>"
                                data-type="<?= $page['feedType'] ?>"
                                data-loc="<?= $page['location'] ?>"
                                data-date="<?= $page['feedDate'] ?>"
                                data-summ="<?= $page['summarised'] ?>"
                                data-added="<?= $page['addedBy'] ?>"
                                data-schedule="<?= $page['feedSchedule'] ?>"
                                data-idtag="<?= $page['_id'] ?>"
                                data-status="<?= $page['feedStatus'] ?>"
                                data-remark="<?= $page['feedRemark'] ?>"
                                data-target="#myModal3">Preview
                        </button>

                        <?php
                        } else {
                        ?>
                        <a style="margin-left: 54%;margin-top: 1%" href="#"
                           class="btn btn-primary disabled"
                           role="button" data-toggle="modal" data-target="#myModal2"
                        >Edit feed
                        </a>
                        <a style="margin-left: 77%;margin-top: -5%"
                           href="#?>"
                           class="btn btn-danger disabled" role="button" onclick="return confSubmit2();">Delete feed
                        </a>
                        <button style="margin-left: 89%;margin-top: -8.5%" type="button"
                                class="btn btn-info"
                                data-toggle="modal" data-title="<?= $page['feedTitle'] ?>"
                                data-image="<?= $page['feedImage'] ?>"
                                data-source="<?= $page['feedSource'] ?>" data-content="<?= $page['feedContent'] ?>"
                                data-sourcetag="<?= $page['feedSourceTag'] ?>"
                                data-image_lw="<?= $page['feedImage_lw'] ?>"
                                data-audio="<?= $page['feedAudio'] ?>"
                                data-cat="<?= $page['category'] ?>"
                                data-trend="<?= $page['trending'] ?>"
                                data-type="<?= $page['feedType'] ?>"
                                data-loc="<?= $page['location'] ?>"
                                data-date="<?= $page['feedDate'] ?>"
                                data-summ="<?= $page['summarised'] ?>"
                                data-added="<?= $page['addedBy'] ?>"
                                data-schedule="<?= $page['feedSchedule'] ?>"
                                data-idtag="<?= $page['_id'] ?>"
                                data-status="<?= $page['feedStatus'] ?>"
                                data-remark="<?= $page['feedRemark'] ?>"
                                data-target="#myModal3">Preview
                        </button>

                        <?php
                        }
                        ?>


                        <?php
                        } else {
                        ?>
                        <?php
                        $id = $page['_id']?>
                        <a style="margin-left: 54%;margin-top: 1%" href="#<?php
                        echo '' . $id . '';
                        ?>"
                           class="btn btn-primary"
                           role="button" data-toggle="modal" data-target="#myModal2"
                           data-title="<?= $page['feedTitle'] ?>" data-image="<?= $page['feedImage'] ?>"
                           data-source="<?= $page['feedSource'] ?>" data-content="<?= $page['feedContent'] ?>"
                           data-sourcetag="<?= $page['feedSourceTag'] ?>"
                           data-image_lw="<?= $page['feedImage_lw'] ?>"
                           data-audio="<?= $page['feedAudio'] ?>"
                           data-cat="<?= $page['category'] ?>"
                           data-trend="<?= $page['trending'] ?>"
                           data-type="<?= $page['feedType'] ?>"
                           data-loc="<?= $page['location'] ?>"
                           data-date="<?= $page['feedDate'] ?>"
                           data-summ="<?= $page['summarised'] ?>"
                           data-added="<?= $page['addedBy'] ?>"
                           data-schedule="<?= $page['feedSchedule'] ?>"
                           data-idtag="<?= $page['_id'] ?>">Edit feed
                        </a>
                        <a style="margin-left: 77%;margin-top: -5%"
                           href="deleteFeed?action=<?= $page['_id'] ?>&user=<?= $user ?>"
                           class="btn btn-danger" role="button" onclick="return confSubmit2();">Delete feed
                        </a>
                        <button style="margin-left: 89%;margin-top: -8.5%;" type="button"
                                class="btn btn-info "
                                data-toggle="modal" data-title="<?= $page['feedTitle'] ?>"
                                data-image="<?= $page['feedImage'] ?>"
                                data-source="<?= $page['feedSource'] ?>" data-content="<?= $page['feedContent'] ?>"
                                data-sourcetag="<?= $page['feedSourceTag'] ?>"
                                data-image_lw="<?= $page['feedImage_lw'] ?>"
                                data-audio="<?= $page['feedAudio'] ?>"
                                data-cat="<?= $page['category'] ?>"
                                data-trend="<?= $page['trending'] ?>"
                                data-type="<?= $page['feedType'] ?>"
                                data-loc="<?= $page['location'] ?>"
                                data-date="<?= $page['feedDate'] ?>"
                                data-summ="<?= $page['summarised'] ?>"
                                data-added="<?= $page['addedBy'] ?>"
                                data-schedule="<?= $page['feedSchedule'] ?>"
                                data-idtag="<?= $page['_id'] ?>"
                                data-status="<?= $page['feedStatus'] ?>"
                                data-remark="<?= $page['feedRemark'] ?>"
                                data-target="#myModal3">Preview
                        </button>

                        <?php
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
        <?php
        endforeach;
        ?>
        <div class="modal fade" id="myModal" role="dialog">

            <script type="text/javascript">
                function check() {
                    var r = confirm('Are you sure you want to save??');
                    return r;
                }
                $(document).ready(function () {
                    var user = localStorage.getItem('user');

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
                              accept-charset="UTF-8" onsubmit="return confSubmit(); check();">
                            <div class="form-group">
                                <label for="usr">Feed title:
                                </label>
                                <input type="text" class="form-control" id="feedTitles" name="feedTitle"
                                       placeholder="Feed Title"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Feed Image:&nbsp;
                                    <small>File should be less than 1MB</small>
                                </label>
                                <input type="file" class="form-control" accept="image/*" name="image[]" id="image">
                            </div>


                            <div class="form-group">
                                <label for="usr">Send Notifications:
                                </label>
                                <input type="checkbox" class="" name="gcm" style="margin-left:4%">
                            </div>
                            <div class="form-group">
                                <label for="usr">Feed Audio:&nbsp;
                                    <small>File should be less than 2MB of MP3 format</small>
                                </label>
                                <input type="file" accept="audio/*" class="form-control" name="images[]" id="audioSave">
                            </div>


                            <h3>OR</h3>
                            <input type="hidden" value="<?= $user ?>" name="user">

                            <div class="form-group">
                                <label for="usr">Feed Audio URL:
                                </label>
                                <input type="text" class="form-control" name="feedaudio" accept="audio/*"
                                       id="feedaudio"
                                       placeholder="Fedd Audio URL">
                            </div>
                            <div class="form-group">
                                <label for="usr">Feed Publishing Date:
                                </label>
                                <input type="date" class="form-control" name="feedSchedule" id="feedSchedule"
                                       placeholder="YYYY/MM/DD" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="feedOwner" id="owner">
                            </div>

                            <br>
                            <label for="sel1"
                                   class="">Category
                            </label>

                            <div class="">
                                <select name="Category" class="form-control" id="categories">
                                    <option value="Product Management">Product Management
                                    </option>
                                    <option value="Agile Planning">Agile Planning
                                    </option>
                                    <option value="Product Marketing">Product Marketing
                                    </option>
                                    <option value="User Experience Design">User Experience Design
                                    </option>
                                    <option value="Growth Hacking">Growth Hacking
                                    </option>
                                    <option value="Career Management">Career Management
                                    </option>
                                    <option value="Emerging Technologies">Emerging Technologies
                                    </option>
                                    <option value="Leadership">Leadership
                                    </option>
                                    <option value="Data Science">Data Science
                                    </option>
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="comment">Feed content:
                                </label>
                      <textarea class="form-control" rows="5" name="feedContent" maxlength="400" id="contents">
                      </textarea>
                            </div>
                            <div class="form-group">
                                <label for="usr">Feed Source URL:
                                </label>
                                <input type="text" class="form-control" name="sourceUrl"
                                       placeholder="Source of the field">
                            </div>

                            <a href="#demo" class="btn btn-info" data-toggle="collapse">Advanced Options</a>

                            <div id="demo" class="collapse">
                                <br>

                                <div class="form-group">
                                    <label for="usr">Feed Expiry date:
                                    </label>
                                    <input type="date" class="form-control" name="feedDate"
                                           placeholder="YYYY/MM/DD">
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
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Summarised By:
                                    </label>
                                    <input type="text" class="form-control" name="summarised">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Added By:
                                    </label>
                                    <input type="text" class="form-control" name="addedBy" id="addedBy">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Source Tag:
                                    </label>
                                    <input type="text" class="form-control" name="sourceTitle"
                                           placeholder="Source Name" id="title">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" onsubmit="return check();">Save
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                            </button>
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#myModal5">Preview
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
                    var user = localStorage.getItem('user');

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
                              accept-charset="UTF-8" onsubmit="return editSubmit(); check();">
                            <div class="form-group">
                                <label for="usr">Feed title:
                                </label>
                                <input type="text" class="form-control" name="feedTitle" id="feedTitle"
                                       placeholder="Title of the feed" required>
                            </div>

                            <input type="hidden" value="<?= $user ?>" name="user">

                            <div class="form-group">
                                <label for="usr">Feed Image:&nbsp;
                                    <small>File should be less than 1MB</small>
                                </label>
                                <input type="file" class="form-control" accept="image/*" name="image[]" id="imaged">
                            </div>


                            <h3>OR</h3>

                            <div class="form-group">
                                <label for="usr">Feed Image URL:
                                </label>
                                <input type="text" class="form-control" id="feedImages" name="feedImage"
                                       placeholder="Feed Image URL">
                            </div>

                            <div class="form-group">
                                <label for="usr">Feed Publishing Date:
                                </label>
                                <input type="date" class="form-control" name="feedSchedule" id="feedSchedule"
                                       placeholder="YYYY/MM/DD" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Send Notifications:
                                </label>
                                <input type="checkbox" class="" name="gcm" style="margin-left:4%">
                            </div>

                            <br>
                            <label for="sel1"
                                   class="">Category
                            </label>

                            <div class="">
                                <select name="Category" class="form-control" id="category">
                                    <option value="Product Management">Product Management
                                    </option>
                                    <option value="Agile Planning">Agile Planning
                                    </option>
                                    <option value="Product Marketing">Product Marketing
                                    </option>
                                    <option value="User Experience Design">User Experience Design
                                    </option>
                                    <option value="Growth Hacking">Growth Hacking
                                    </option>
                                    <option value="Career Management">Career Management
                                    </option>
                                    <option value="Emerging Technologies">Emerging Technologies
                                    </option>

                                    <option value="Leadership">Leadership
                                    </option>
                                    <option value="Data Science">Data Science
                                    </option>
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="usr">Feed Audio:&nbsp;
                                    <small>File should be less than 2MB of MP3 format</small>
                                </label>
                                <input type="file" class="form-control" name="images[]" accept="audio/*" id="audioTag">
                            </div>


                            <h3>OR</h3>

                            <div class="form-group">
                                <label for="inputPassword">Audio
                                </label>
                                <input class="form-control" name="feedaudio" id="feedaudio" type="text"
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
                                <input type="text" class="form-control" name="sourceUrl" id="sourceUrl"
                                       placeholder="Source URL of the feed">
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
                                    <input type="date" class="form-control" name="feedDate" id="feedDate"
                                           placeholder="YYYY/MM/DD">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Summarised By:
                                    </label>
                                    <input type="text" class="form-control" name="summarised" id="summarised">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Added By:
                                    </label>
                                    <input type="text" class="form-control" name="addedBy" id="added">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Feed Source Tag:
                                    </label>
                                    <input type="text" class="form-control" name="sourceTitle" id="sourceTitle"
                                           placeholder="Feed source name">
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id" id="idTag">
                            </div>
                            <button type="submit" class="btn btn-primary">Save
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                            </button>
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#myModal4">Preview
                            </button>

                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- First Preview -->
        <div class="modal fade" id="myModal3" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Preview of the feed</h4>
                    </div>
                    <div class="modal-body" style="border-radius: 2%;height: 500px;border: 1px solid black; width: 47%; margin: 0 auto;padding: 0px;
">

                        <img id="feedImage" src="" style=" width: 100%;  height: 230px;">

                        <div class="pa" style="padding: 5%;">
                            <article>
                                <h4 id="feedTitle"
                                    style=" margin-bottom: 4px;color:black;margin-top:-1%;font-weight:400"></h4>

                                <p id="feedContent" style="font-size:0.7em"></p>
                            </article>
                        </div>
                        <div class="tag"
                             style="float: right;padding-right: 0%;position: fixed;bottom:142px;padding-left:27% ">
                            <span style="font-size: 0.7em;">More At</span>&nbsp;<span id="source"
                                                                                      style=" font-size: 0.75em;color: skyblue;"></span>
                        </div>
                        <div id="bottom "
                             style="margin-top: 7%;padding-left: 5%;position: fixed;bottom:99px;margin-left: -16px">
                            <span id="category" style="color: black;font-size: 0.9em;font-weight:400"></span><br>
                            <span id="added" style=" font-size: 0.7em;color: black;"></span>
                        </div>
                        <img id="btimg"
                             style="width:28%;float:right;margin-top:16%;padding-right: 3%;position: absolute;margin-left: 70%;bottom:8px"
                             src="https://files.slack.com/files-pri/T04T20JQR-F2J6XQKS7/feedscreen.png?pub_secret=e393cfab42">
                        <input type="hidden" id="previewHidden"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="accept" data-toggle="modal"
                                onclick="accept()" ; data-target="#acceptModal">Accept
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#acceptModal" id="reject"
                                onclick="reject()" ;> Reject
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Edit Preview -->
        <div class="modal fade" id="myModal4" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Preview of the feed</h4>
                    </div>
                    <div class="modal-body" style="border-radius: 2%;height: 500px;border: 1px solid black; width: 47%; margin: 0 auto;padding: 0px;
">

                        <img id="feedImage" src="" style=" width: 100%;  height: 230px;">

                        <div class="pa" style="padding: 5%;">
                            <article>
                                <h4 id="feedTitle"
                                    style=" margin-bottom: 4px;color:black;margin-top:-1%;font-weight:400"></h4>

                                <p id="feedContent" style="font-size:0.7em"></p>
                            </article>
                        </div>
                        <div class="tag"
                             style="float: right;padding-right: 0%;position: fixed;bottom:142px;padding-left:27% ">
                            <span style="font-size: 0.7em;">More At</span>&nbsp;<span id="source"
                                                                                      style=" font-size: 0.75em;color: skyblue;"></span>
                        </div>
                        <div id="bottom "
                             style="margin-top: 7%;padding-left: 5%;position: fixed;bottom:99px;margin-left: -16px">
                            <span id="category" style="color: black;font-size: 0.9em;font-weight:400"></span><br>
                            <span id="added" style=" font-size: 0.7em;color: black;"></span>
                        </div>
                        <img id="btimg"
                             style="width:28%;float:right;margin-top:16%;padding-right: 3%;position: absolute;margin-left: 70%;bottom:8px"
                             src="https://files.slack.com/files-pri/T04T20JQR-F2J6XQKS7/feedscreen.png?pub_secret=e393cfab42">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Save Preview -->
        <div class="modal fade" id="myModal5" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Preview of the feed</h4>
                    </div>
                    <div class="modal-body" style="border-radius: 2%;height: 500px;border: 1px solid black; width: 47%; margin: 0 auto;padding: 0px;
">

                        <img id="feedImage" src="" style=" width: 100%;  height: 230px;">

                        <div class="pa" style="padding: 5%;">
                            <article>
                                <h4 id="feedTitle"
                                    style=" margin-bottom: 4px;color:black;margin-top:-1%;font-weight:400"></h4>

                                <p id="feedContent" style="font-size:0.7em"></p>
                            </article>
                        </div>
                        <div class="tag"
                             style="float: right;padding-right: 0%;position: fixed;bottom:142px;padding-left:27% ">
                            <span style="font-size: 0.7em;">More At</span>&nbsp;<span id="source"
                                                                                      style=" font-size: 0.75em;color: skyblue;"></span>
                        </div>
                        <div id="bottom "
                             style="margin-top: 7%;padding-left: 5%;position: fixed;bottom:99px;margin-left: -16px">
                            <span id="category" style="color: black;font-size: 0.9em;font-weight:400"></span><br>
                            <span id="added" style=" font-size: 0.7em;color: black;"></span>
                        </div>
                        <img id="btimg"
                             style="width:28%;float:right;margin-top:16%;padding-right: 3%;position: absolute;margin-left: 70%;bottom:8px"
                             src="https://files.slack.com/files-pri/T04T20JQR-F2J6XQKS7/feedscreen.png?pub_secret=e393cfab42">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade" id="acceptModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="head" class="modal-title">Remark</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="accept" id="form-id">
                            <span>Remarks</span>
                            <textarea id="remarkArea" class="form-control" rows="3" name="remarks"
                                      placeholder="Leave remarks here" required></textarea>
                            <input type="hidden" class="form-control" name="id" id="acceptId">
                            <input type="hidden" class="form-control" name="clickedType" id="clickedType">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info"
                                onclick="document.getElementById('form-id').submit();">Submit
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <!-- /#page-content-wrapper -->
</div>
</div>
<!-- /#wrapper -->

<script type="text/javascript">
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
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
                var summ = button.data('summ');
                var added = button.data('added');
                // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('#feedTitle').val(title);
                modal.find('#feedImages').val(image);
                modal.find('#feedImage_lw').val(image_lw);
                modal.find('#sourceUrl').val(source);
                modal.find('#feedContent').val(content);
                modal.find('#sourceTitle').val(sourceTag);
                modal.find('#idTag').val(idTag);
                modal.find('#category').val(cat);
                modal.find('#type').val(type);
                modal.find('#trend').val(trend);
                modal.find('#loc').val(loc);
                modal.find('#feedaudio').val(audio);
                modal.find('#feedDate').val(date);
                modal.find('#feedSchedule').val(schedule);
                modal.find('#summarised').val(summ);
                modal.find('#added').val(added);
                var user = localStorage.getItem('user');
                modal.find('#owner').val(user);

            }
    )
</script>
<script>
    $('#myModal3').on('show.bs.modal', function (event) {
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
                var status = button.data('status');
                var remark = button.data('remark');
				var added = button.data('added');
                localStorage.setItem('remark', remark);
                localStorage.setItem('id', idTag);


                // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('#feedTitle').text(title);
                modal.find('#accept').data('remark', remark);
                modal.find('#feedImage').attr('src', image);
                modal.find('#feedContent').text(content);
                modal.find('#source').text(sourceTag + " >");
                modal.find('#category').text(cat);
                modal.find('#added').text("Shot by  " + added + "  1 day ago");

            }
    )
</script>
<script>

    $('#myModal4').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                // Button that triggered the modal
                var title = $('#feedTitle').val();
                var image = $('#feedImages').val();
                var content = $('#feedContent').val();
                var added = $('#added').val();
                var sourceTag = $('#sourceTitle').val();
                var cata = $('#category option:selected').text()
                var modal = $(this);
                modal.find('#feedTitle').text(title);
                modal.find('#feedImage').attr('src', image);
                modal.find('#feedContent').text(content);
                modal.find('#source').text(sourceTag + " >");
                modal.find('#category').text(cata);
                modal.find('#added').text("Shot by  " + added + "  1 day ago");
            }
    );
</script>
<script>

    $('#myModal5').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                // Button that triggered the modal
                var title = $('#feedTitles').val();
                var image = $('#feedImaged').val();
                var content = $('#contents').val();
                var added = $('#addedBy').val();
                var sourceTag = $('#title').val();
                var cata = $('#category option:selected').text()
                var modal = $(this);
                modal.find('#feedTitle').text(title);
                modal.find('#feedImage').attr('src', image);
                modal.find('#feedContent').text(content);
                modal.find('#source').text(sourceTag + " >");
                modal.find('#category').text(cata);
                modal.find('#added').text("Shot by  " + added + "  1 day ago");
            }
    );
</script>
<script>

    $('#acceptModal').on('show.bs.modal', function (event) {
//                var button = $(event.relatedTarget);
//                // Button that triggered the modal
//                 var remark = button.data('remark');
//                // Extract info from data-* attributes
//                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
//                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
//                var modal = $(this);
//                modal.find('#head').text(remark);
                var remark = localStorage.getItem('remark');
                var id = localStorage.getItem('id');
                var type = localStorage.getItem('clicked');
                $('#clickedType').val(type);
                $('#acceptId').val(id);
                $('#remarkArea').val(remark);


            }
    )
</script>

<script type="text/javascript">
    function confSubmit2() {
        var li = confirm('Are you sure you want to delete??');
        return r;
    }
    function confSubmit() {
        var input = document.getElementById("audioSave");

        // check for browser support (may need to be modified)
        if(input.files && input.files.length == 1)
        {

            if (input.files[0].size > 2097152)
            {
                alert("The file must be less than 2 MB");
                return false;
            }
        }

        if (document.getElementById("image").files.length == 0) {
            alert("Please add an image file ");
            return false;


        }
        else {
            var r = confirm('Are you sure you want to save??');
            return r;
        }


    }
    function editSubmit() {
        var input = document.getElementById("audioTag");

        // check for browser support (may need to be modified)
        if(input.files && input.files.length == 1)
        {

            if (input.files[0].size > 2097152)
            {
                alert("The file must be less than 2 MB");
                return false;
            }
        }
        if (document.getElementById("imaged").files.length == 0) {
            if ($("#feedImages").val().length == 0) {
                alert("Please add an image file");
                return false;
            }
            else {
                var r = confirm('Are you sure you want to save??');
                return r;
            }

        }
        else {

            var r = confirm('Are you sure you want to save??');
            return r;
        }


    }

    function accept() {
        localStorage.setItem('clicked', 'Accept');
    }
    function reject() {
        localStorage.setItem('clicked', 'Reject');
    }


</script>

</body>
</html>