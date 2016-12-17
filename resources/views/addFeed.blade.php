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
    <link href="{!! asset('css/star-rating.css') !!}" media="all" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="{!! asset('script/star-rating.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('script/main.js') !!}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <script>

        $(document).ready(function () {

            document.getElementById("cat").value = '<?php
echo $tag;
?>';
            document.getElementById("own").value = '<?php
echo $tag2;
?>';
            document.getElementById("statusTag").value = '<?php
echo $tag3;
?>';
        });
    </script>
    <script>
        $(document).ready(function () {
            var user = localStorage.getItem('user');
            if (user == "ssharma@clearlyblue.in") {
                $('#setId').hide();
            }
            if (user == "content_admin") {
//                $('#setId').show();

                $('#reject').show();

            }
            else {

//                $('#setId').hide();

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
    div#acceptModal{
        top:-4%;
        left:50%;
        outline: none;
    }
    .modal { overflow: auto !important; }

    div#firstPreview{
        top:-4%;
        right:50%;
        outline: none;
    }
    img#play {
        width: 40px;
        margin-top: -37%;
        float: right;
        position :relative;
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
                <li id="Mikrolearn" style="font-size: 1.8em"><a href="addFeed"> Mikrolearn Content Portal</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li onclick=localStorage.clear();><a href="loginAdmin"><span class="glyphicon glyphicon-off"
                                                                             aria-hidden="true"></span> Log Out</a>
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
                        Add Shots</a>
                </li>
                <li id="setId" style="font-size: 1.2em">
                    <a href="setFeed"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; &nbsp;Publish
                        Shots</a>
                </li>
                <li id="setId" style="font-size: 1.2em">
                    <a href="comments"><span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp; &nbsp;User
                        Suggestions</a>
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
                                <option value="All">All</option>
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
                                <option value="CISCO Channel">CISCO Channel
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
                <div class="col-sm-2" id="statusId">
                    <label>Status
                    </label>

                    <div class="input-group">
                        <div class="">
                            <select name="statusTags" class="form-control" id="statusTag">
                                <option value="All">All</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Published">Published</option>
                                <option value="Major Pending Edits"> Major Pending Edits</option>
                                <option value="Minor Pending Edits"> Minor Pending Edits</option>
                                <option value="Waiting for Approval">Waiting for Approval</option>

                            </select>
                        </div>
                    </div>
                </div>
                <br>
                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                <button style="line-height: 207%" type="submit" class="btn btn-primary" name="button"
                        value="filter">Filter
                </button>
                &nbsp;&nbsp;

                <button style="line-height: 207%" type="submit" class="btn btn-info" name="button" value="sort">
                    Sort by likes
                </button>
                &nbsp;&nbsp

                {{--<button style="line-height: 207%" type="button" class="btn btn-default"--}}
                {{--onclick="location.href='addFeed'">--}}
                {{--Reset--}}
                {{--</button>--}}
            </form>
        </div>
        <div class="second">

        </div>
        <br>
        <h4><?= count($feed)?> shot(s) below</h4>
        <br>
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addFeed"
                data-backdrop="static" data-keyboard="false">Add new
            shot
            item
        </button>
        <br>

        <br>


        <div class="panel-group" id="accordion">

        </div>

        <hr id="hr" style="border:1px solid grey;">


        <ul class="pager">
            <li class="previous"><a href="" onclick="prevPage(); return false;">Previous</a></li>
            <li class="next"><a href="" onclick="nextPage(); return false;">Next</a></li>
        </ul>
        <div class="modal fade" id="addFeed" role="dialog">

            <script type="text/javascript">
                function check() {
                    var r = confirm('Are you sure you want to save??');
                    return r;
                }
                $(document).ready(function () {
                    $('#contents').val('');
                    var user = localStorage.getItem('user');

                    document.getElementById('owner').value = user;
                });

            </script>
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" >&times;
                        </button>
                        <h4 class="modal-title">Add New Shot
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ action('DashboardController@saveFeed') }}"
                              enctype="multipart/form-data"
                              accept-charset="UTF-8" onsubmit="return confSubmit(); check();">
                            <div class="form-group">
                                <label for="usr">Shot title:
                                </label>
                                <input type="text" class="form-control" id="feedTitles" name="feedTitle"
                                       placeholder="Shot Title"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Shot Image:&nbsp;
                                    <small>File should be less than 1MB</small>
                                </label>
                                <input type="file" class="form-control" accept="image/*" name="image[]" id="image"
                                       onchange='openFile(event)'>
                            </div>
                            <img id='output'>


                            <div class="form-group">
                                <label for="usr">Send Notifications:
                                </label>
                                <input type="checkbox" class="" name="gcm" style="margin-left:4%">
                            </div>
                            <div class="form-group">
                                <label for="usr">Shot Audio:&nbsp;
                                    <small>File should be less than 2MB of MP3 format</small>
                                </label>
                                <input type="file" accept="audio/*" class="form-control" name="images[]" id="audioSave">
                            </div>


                            <h3>OR</h3>
                            <input type="hidden" value="<?= $user ?>" name="user">

                            <div class="form-group">
                                <label for="usr">Shot Audio URL:
                                </label>
                                <input type="text" class="form-control" name="feedaudio" accept="audio/*"
                                       id="feedAudio"
                                       placeholder="Fedd Audio URL" disabled>
                            </div>
                            <div class="form-group">
                                <label for="usr">Shot Publishing Date:
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
                                    <option value="CISCO Channel">CISCO Channel
                                    </option>
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="comment">Shot content:
                                </label>
                      <textarea class="form-control" rows="5" name="feedContent" maxlength="400" id="contents">
                      </textarea>
                            </div>
                            <div class="form-group">
                                <label for="usr">Shot Summarised By:
                                </label>
                                <input type="text" class="form-control" name="summarised" placeholder="Summarised by" id="addedtext" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Shot Source URL:
                                </label>
                                <input type="text" class="form-control" name="sourceUrl"
                                       placeholder="Source of the field" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Shot Source Tag:
                                </label>
                                <input type="text" class="form-control" name="sourceTitle"
                                       placeholder="Source Name" id="title" required>
                            </div>

                            <a href="#demo" class="btn btn-info" data-toggle="collapse">Advanced Options</a>

                            <div id="demo" class="collapse">
                                <br>

                                <div class="form-group">
                                    <label for="usr">Shot Expiry date:
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
                                       class="">Shot Type
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
                                    <label for="usr">Shot Added By:
                                    </label>
                                    <input type="text" class="form-control" name="addedBy" id="added">
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary" onsubmit="return check();">Save
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="localStorage.removeItem('val')">Close
                            </button>
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#savePreview" data-backdrop="static" data-keyboard="false">Preview
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!--Modal2-->
        <div class="modal fade" id="editFeed" role="dialog">
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
                        <h4 class="modal-title">Edit Shot
                        </h4> <span id="feedId" style="font-size: 72%;color:grey">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ action('DashboardController@saveEditFeed') }}"
                              enctype="multipart/form-data"
                              accept-charset="UTF-8" onsubmit="return editSubmit(); check();">
                            <div class="form-group">
                                <label for="usr">Shot title:
                                </label>
                                <input type="text" class="form-control" name="feedTitle" id="feedTitle"
                                       placeholder="Title of the shot" required>
                            </div>

                            <input type="hidden" value="<?= $user ?>" name="user">

                            <div class="form-group">
                                <label for="usr">Shot Image:&nbsp;
                                    <small>File should be less than 1MB</small>
                                </label>
                                <input type="file" class="form-control" accept="image/*" name="image[]" id="imaged"
                                       onchange='openFile(event)'>
                            </div>


                            <h3>OR</h3>

                            <div class="form-group">
                                <label for="usr">Shot Image URL:
                                </label>
                                <input type="text" class="form-control" id="feedImages" name="feedImage"
                                       placeholder="Shot Image URL">
                            </div>

                            <div class="form-group">
                                <label for="usr">Shot Publishing Date:
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
                                    <option value="CISCO Channel">CISCO Channel
                                    </option>
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="usr">Shot Audio:&nbsp;
                                    <small>File should be less than 2MB of MP3 format</small>
                                </label>
                                <input type="file" class="form-control" name="images[]" accept="audio/*" id="audioTag">
                            </div>


                            <h3>OR</h3>

                            <div class="form-group">
                                <label for="inputPassword">Audio
                                </label>
                                <input type="text" class="form-control" name="feedaudio" id="feedAudioTag"
                                disabled>
                            </div>
                            <div class="form-group">
                                <label for="comment">Shot content:
                                </label>
								<textarea class="form-control" rows="5" name="feedContent" id="feedContent"
                                          maxlength="400" >
						</textarea>
                            </div>

                            <div class="form-group">
                                <label for="comment">Shot Remarks:
                                </label>
								<textarea class="form-control" rows="5" name="feedRemark" id="feedRemarks"
                                          id="feedRemarks" disabled>
						</textarea>
                            </div>
                            <div class="form-group">
                                <label for="comment">Add Remark:
                                </label>
								<textarea class="form-control" rows="4" name="feedShotRemark"
                                >
						</textarea>
                            </div>
                            <div class="form-group">
                                <label for="usr">Shot Summarised By:
                                </label>
                                <input type="text" class="form-control" name="summarised" id="summarised" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Shot Source URL:
                                </label>
                                <input type="text" class="form-control" name="sourceUrl" id="sourceUrl"
                                       placeholder="Source URL of the shot" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Shot Source Tag:
                                </label>
                                <input type="text" class="form-control" name="sourceTitle" id="sourceTitle"
                                       placeholder="Shot source name" required>
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
                                       class="">Shot Type
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
                                    <label for="usr">Shot Expiry date:
                                    </label>
                                    <input type="date" class="form-control" name="feedDate" id="feedDate"
                                           placeholder="YYYY/MM/DD">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Shot Added By:
                                    </label>
                                    <input type="text" class="form-control" name="addedBy" id="added">
                                </div>

                            </div>

                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id" id="idTag">
                            </div>
                            <button type="submit" class="btn btn-primary">Save
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="localStorage.removeItem('val')">Close
                            </button>
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#editPreview" data-backdrop="static" data-audio="" data-keyboard="false">Preview
                            </button>

                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- First Preview -->
        <div class="modal fade" id="firstPreview" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload();">&times;</button>
                        <h4 class="modal-title">Shot Preview</h4>
                    </div>
                    <div class="modal-body" style="border-radius: 2%;height: 500px;border: 1px solid black; width: 47%; margin: 0 auto;padding: 0px;
">

                        <img id="feedImage" src="" style=" width: 100%;  height: 40%;">

                        <div class="pa" style="padding: 5%;">
                            <article>
                                <h4 id="feedTitle"
                                    style=" margin-bottom: 4px;color:black;margin-top:-1%;font-weight:bold;font-size: 110%;"></h4>
                                <audio id="myAudio">
                                <source src=""
                                        type='audio/mpeg' id="sourcetag">
                                Your user agent does not support the HTML5 Audio element.
                                </audio>
                                <img src="https://files.slack.com/files-pri/T04T20JQR-F3DBP4WH1/mediaplay.png" id="play" onclick="aud_play_pause()">

                                <p id="feedContent" style="font-size:0.78em;line-height:157%;word-spacing:4px"></p>
                            </article>
                        </div>

                        <div class="tag"

                             style="float: right;padding-right: 0%;position: fixed;bottom:142px;padding-left:20% ">
                            <span style="font-size: 0.7em;">More At</span>&nbsp;<span id="source"
                                                                                      style=" font-size: 0.55em;color: skyblue;"></span>
                        </div>
                        <div id="bottom "
                             style="margin-top: 7%;padding-left: 5%;position: fixed;bottom:76px;margin-left: -16px">
                            <span id="category" style="font-size: 0.8em;font-weight:400"></span><br>
                            <span id="added" style=" font-size: 0.68em;color: black;"></span>
                        </div>
                        <img id="btimg"
                             style="width:28%;float:right;margin-top:16%;padding-right: 3%;position: absolute;margin-left: 70%;bottom:8px"
                             src="https://files.slack.com/files-pri/T04T20JQR-F2J6XQKS7/feedscreen.png?pub_secret=e393cfab42">
                        <input type="hidden" id="previewHidden"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="acceptRate" data-toggle="modal"
                                onclick="accept()" ; data-target="#acceptModal" data-backdrop="static"
                                data-keyboard="false">Rate
                        </button>

                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload();">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Edit Preview -->
        <div class="modal fade" id="editPreview" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="cleared()">&times;</button>
                        <h4 class="modal-title">Shot Preview</h4>
                    </div>
                    <div class="modal-body" style="border-radius: 2%;height: 500px;border: 1px solid black; width: 47%; margin: 0 auto;padding: 0px;
">

                        <img id="feedImage" src="" style=" width: 100%;  height: 40%;">

                        <div class="pa" style="padding: 5%;">
                            <article>
                                <h4 id="feedTitle"
                                    style=" margin-bottom: 4px;color:black;margin-top:-1%;font-weight:bold;font-size: 110%"></h4>
                                <audio id="myAudio">
                                    <source src=""
                                            type='audio/mpeg' id="sourcetag">
                                    Your user agent does not support the HTML5 Audio element.
                                </audio>
                                <img src="https://files.slack.com/files-pri/T04T20JQR-F3DBP4WH1/mediaplay.png" id="play" onclick="aud_play_pause()">

                                <p id="feedContent" style="font-size:0.77em;line-height:157%;word-spacing:4px"></p>
                            </article>
                        </div>
                        <div class="tag"
                             style="float: right;padding-right: 0%;position: fixed;bottom:142px;padding-left:20% ">
                            <span style="font-size: 0.7em;">More At</span>&nbsp;<span id="source"
                                                                                      style=" font-size: 0.55em;color: skyblue;"></span>
                        </div>
                        <div id="bottom "
                             style="margin-top: 7%;padding-left: 5%;position: fixed;bottom:76px;margin-left: -16px">
                            <span id="category" style="font-size: 0.8em;font-weight:400"></span><br>
                            <span id="added" style=" font-size: 0.68em;color: black;"></span>
                        </div>
                        <img id="btimg"
                             style="width:28%;float:right;margin-top:16%;padding-right: 3%;position: absolute;margin-left: 70%;bottom:8px"
                             src="https://files.slack.com/files-pri/T04T20JQR-F2J6XQKS7/feedscreen.png?pub_secret=e393cfab42">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                                onclick="cleared()" >Close
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Save Preview -->
        <div class="modal fade" id="savePreview" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="cleared()">&times;</button>
                        <h4 class="modal-title">Shot Preview</h4>
                    </div>
                    <div class="modal-body" style="border-radius: 2%;height: 500px;border: 1px solid black; width: 47%; margin: 0 auto;padding: 0px;
">

                        <img id="feedImage" src="" style=" width: 100%;  height: 40%;">

                        <div class="pa" style="padding: 5%;">
                            <article>
                                <h4 id="feedTitle"
                                    style=" margin-bottom: 4px;color:black;margin-top:-1%;font-weight:bold;font-size: 110%"></h4>
                                <audio id="myAudio">
                                    <source src=""
                                            type='audio/mpeg' id="sourcetag">
                                    Your user agent does not support the HTML5 Audio element.
                                </audio>
                                <img src="https://files.slack.com/files-pri/T04T20JQR-F3DBP4WH1/mediaplay.png" id="play" onclick="aud_play_pause()">

                                <p id="feedContent" style="font-size:0.77em;line-height:157%;word-spacing:4px"></p>
                            </article>
                        </div>
                        <div class="tag"
                             style="float: right;padding-right: 0%;position: fixed;bottom:142px;padding-left:20% ">
                            <span style="font-size: 0.7em;">More At</span>&nbsp;<span id="source"
                                                                                      style=" font-size: 0.55em;color: skyblue;"></span>
                        </div>
                        <div id="bottom "
                             style="margin-top: 7%;padding-left: 5%;position: fixed;bottom:76px;margin-left: -16px">
                            <span id="category" style="font-size: 0.8em;font-weight:400"></span><br>
                            <span id="added" style=" font-size: 0.68em;color: black;"></span>
                        </div>
                        <img id="btimg"
                             style="width:28%;float:right;margin-top:16%;padding-right: 3%;position: absolute;margin-left: 70%;bottom:8px"
                             src="https://files.slack.com/files-pri/T04T20JQR-F2J6XQKS7/feedscreen.png?pub_secret=e393cfab42">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cleared()"
                                >Close
                        </button>
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
                        <h4 id="head" class="modal-title">Review the shot</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="accept" id="form-id">
                            <span><b>Remarks</b></span>
                            <textarea class="form-control" rows="3" name="remarks"
                                      placeholder="Leave remarks here" required></textarea>
                            <hr>
                            <div class="form-group">
                                <label for="comment">Remark History:
                                </label>
								<textarea class="form-control" rows="5" id="remarkArea"
                                          id="feedRemarks" disabled>
						</textarea>
                            </div>
                            <hr>
                            <p><b>Rate</b></p>
                            <input id="rating-input" type="number" name="star"/>

                            <input type="hidden" class="form-control" name="id" id="acceptId">
                            <input type="hidden" class="form-control" name="tag" id="tag">
                            <input type="hidden" class="form-control" name="tag2" id="tag2">
                            <input type="hidden" class="form-control" name="tag3" id="tag3">
                            <input type="hidden" class="form-control" name="feed" id="feed">
                            <input type="hidden" class="form-control" name="user" id="acceptUser">
                            <input type="hidden" class="form-control" name="clickedType" id="clickedType">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="modalSubmit" class="btn btn-info"
                                onclick="document.getElementById('form-id').submit();">Submit
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                                onclick="window.location.reload();">Close
                        </button>
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

<script type="text/javascript">

    function accept() {
        localStorage.setItem('clicked', 'Accept');
    }

    var openFile = function (event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            localStorage.setItem('val', dataURL);
        };
        reader.readAsDataURL(input.files[0]);
    };


    var items = '<?php echo json_encode($feed,JSON_HEX_APOS);  ?>';
        if(items.length<4)
        {

            $(".previous").hide();
            $(".next").hide();


            }
    var tag="<?php echo $tag ?>";
    var tag2="<?php echo $tag2 ?>";
    var tag3="<?php echo $tag3 ?>";
    items = items
            .replace(/\\'/g, "\\'")
            .replace(/\\"/g, '\\"')
            .replace(/\\&/g, "\\&")
            .replace(/\\r/g, "\\r")
            .replace(/\\t/g, "\\t")
            .replace(/\\b/g, "\\b")
            .replace(/\\/g, "\\\\")
            .replace(/\\f/g, "\\f")

            .replace(/\s+/g, ' ');
    var pager = {};
    //    for (var i = 0; i < JSON.parse(items).length; i++) {
    //        console.log(item[i]['_id']);
    //
    //    }

    // remove non-printable and other non-valid JSON chars
    pager.items = JSON.parse(items);
    pager.itemsPerPage = 10;
    pagerInit(pager);
    function bindList() {
        var pgItems = pager.pagedItems[pager.currentPage];
        $("#accordion").empty();
        for (var i = 0; i < pgItems.length; i++) {
            var b=pgItems[i]['category'].toString();
//            for (var key in pgItems[i]) {
//                console.log(pgItems[i]['_id'])
//                var option = $('<li class="ui-state-highlight"  ><div class="panel-group">');
////                option.html("<div class=\"panel-group\"> <div class=\"panel panel-default\" style=\"width:94%\"> <div class=\"panel-heading\"> <h4 class=\"panel-title\"> <span>" + pgItems[i]['feedRating'] + "</span> <span class=\"glyphicon glyphicon-star-empty\"></span> <span id=\"feedId\" style=\"font-size: 72%;color:grey\"> " + pgItems[i]['feedId'] + "   </span>   <a style=\"text-align: center;font-weight: bolder;color:lightseagreen;font-size: 85%\" data-toggle=\"collapse\" href=" + pgItems[i]['_id'] + ">" + pgItems[i]['feedTitle'] + "  </a> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " + pgItems[i]['likeCount'] + "   </span> <span style=\"color:grey\" class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"> </span>&nbsp;&nbsp;   <span style=\"font-size: 72%\">   <small>" + pgItems[i]['feedStatus'] + "</small></span><p style=\"color: grey;margin-top: -1.5%;font-size: 60%;margin-left:74%\">" + pgItems[i]['category'] + "  </p><p style=\"font-size: 60%;color: grey;margin-top: -1.9%;float: right;\"> " + pgItems[i]['created_at'] + " </p> </h4> </div> <div id=" + pgItems[i]['_id'] + " class=\"panel-collapse collapse\"> <div class=\"panel-body\" style=\"word-wrap: break-word\">" + pgItems[i]['feedContent'] + " <img src=" + pgItems[i]['feedImage'] + " class=\"img-rounded\" alt=\"Cinque Terre\" width=\"60\" height=\"60\" style=\"float:right\"> </div> <div class=\"panel-footer\"> <a style=\"margin-left: 0%\" href=" + pgItems[i]['feedSource'] + ">Source </a> <a style=\"margin-left: 4%\" href=" + pgItems[i]['feedAudio'] + ">Audio </a>  </div> </div> </div> </div></li> ");
//
//                option.html(' <div class=\"panel panel-default\"> <div class=\"panel-heading\"> <h4 class=\"panel-title\"> <a data-toggle=\"collapse\" href=" + pgItems[i]['_id'] + ">Collapsible panel</a> </h4> </div> <div id=" + pgItems[i]['_id'] + "  class=\"panel-collapse collapse\"> <div class=\"panel-body\">Panel Body</div> <div class=\"panel-footer\">Panel Footer</div> </div> </div> </li>');
//            }
            var feedId=pgItems[i]['feedId']
            if(pgItems[i]['feedId'] === "" || pgItems[i]['feedId'] ==undefined)
            {
                feedId="";
            };
            $("#accordion").append("<div class=\"panel panel-default\" style=\"width:94%\"> <div class=\"panel-heading\"> <h4 class=\"panel-title\"> <span>" + pgItems[i]['feedRating'] + "</span> <span class=\"glyphicon glyphicon-star-empty\"></span> <span id=\"feedId\" style=\"font-size: 72%;color:grey\"> " + feedId + "   </span>   <a style=\"text-align: center;font-weight: bolder;color:lightseagreen;font-size: 85%\" data-parent=\"#accordion\" data-toggle=\"collapse\" href=#"+pgItems[i]['_id']+">" + pgItems[i]['feedTitle'] + "  </a> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " + pgItems[i]['likeCount'] + "   </span> <span style=\"color:grey\" class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"> </span>&nbsp;&nbsp;   <span style=\"font-size: 72%\">   <small>" + pgItems[i]['feedStatus'] + "</small></span><p style=\"color: grey;margin-top: -1.5%;font-size: 60%;margin-left:74%\">" + pgItems[i]['category'] + "  </p><p style=\"font-size: 60%;color: grey;margin-top: -1.9%;float: right;\"> " + pgItems[i]['created_at'] + " </p> </h4> </div> <div id="+ pgItems[i]['_id'] + " class=\"panel-collapse collapse\"> <div class=\"panel-body\" style=\"word-wrap: break-word\">" + pgItems[i]['feedContent'] + " <img src=" + pgItems[i]['feedImage'] + " class=\"img-rounded\" alt=\"Cinque Terre\" width=\"60\" height=\"60\" style=\"float:right\"> </div> <div class=\"panel-footer\" style=\"line-height:50px\"> <a style=\"margin-left: 0%\" href=" + pgItems[i]['feedSource'] + ">Source </a> <a style=\"margin-left: 4%\" href=" + pgItems[i]['feedAudio'] + ">Audio </a><div class=\"buttonDiv\" style=\"float:right\"><button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#editFeed\" data-title=\""+pgItems[i]['feedTitle']+"\" data-image=\""+pgItems[i]['feedImage']+"\" data-source=\""+pgItems[i]['feedSource']+"\" data-content=\""+pgItems[i]['feedContent']+"\" data-sourcetag=\""+pgItems[i]['feedSourceTag']+"\"  data-audio=\""+pgItems[i]['feedAudio']+"\" data-cat=\""+pgItems[i]['category']+"\" data-trend=\""+pgItems[i]['trending']+"\" data-type=\""+pgItems[i]['feedType']+"\" data-loc=\""+pgItems[i]['location']+"\" data-date=\""+pgItems[i]['feedDate']+"\" data-summ=\""+pgItems[i]['summarised']+"\" data-added=\""+pgItems[i]['addedBy']+"\" data-remark=\""+pgItems[i]['feedRemark']+"\" data-schedule=\""+pgItems[i]['feedSchedule']+"\" data-idtag=\""+pgItems[i]['_id']+"\" data-uId=\""+feedId+"\" data-backdrop=\"static\">Edit Shot</button>&nbsp;&nbsp;<a  href=\"deleteFeed?action=" + pgItems[i]['_id'] + "\" class=\"btn btn-danger\" role=\"button\" onclick=\"return confSubmit2();\">Delete Shot</a>&nbsp;&nbsp;<button type=\"button\" class=\"btn btn-info\" data-toggle=\"modal\" data-title=\""+pgItems[i]['feedTitle']+"\" data-image=\""+pgItems[i]['feedImage']+"\" data-source=\""+pgItems[i]['feedSource']+"\" data-content=\""+pgItems[i]['feedContent']+"\" data-sourcetag=\""+pgItems[i]['feedSourceTag']+"\" data-image_lw=\""+pgItems[i]['feedImage']+"\" data-audio=\""+pgItems[i]['feedAudio']+"\" data-cat=\""+pgItems[i]['category']+"\" data-trend=\""+pgItems[i]['trending']+"\" data-type=\""+pgItems[i]['feedType']+"\" data-loc=\""+pgItems[i]['location']+"\" data-date=feedDate data-summ=\""+pgItems[i]['summarised']+"\" data-added=\""+pgItems[i]['addedBy']+"\" data-schedule=\""+pgItems[i]['feedSchedule']+"\" data-idtag=\""+pgItems[i]['_id']+"\" data-status=\""+pgItems[i]['feedStatus']+"\" data-remark=\""+pgItems[i]['feedRemark']+"\" data-rating=\""+pgItems[i]['feedRating']+"\" data-uId=\""+feedId+"\" data-tag=" +tag+ " data-tag2="+tag2+ " data-tag3="+tag3+" data-feed=" +pgItems+ " data-target=\"#firstPreview\" data-backdrop=\"static\">Preview</button></div>  </div> </div> </div>");
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

    function aud_play_pause() {
        var myAudio = document.getElementById("myAudio");

        if (myAudio.paused) {
            $('img#play').attr("src","https://files.slack.com/files-pri/T04T20JQR-F3E4FUN95/mediapause.png");

            console.log("ih");
            myAudio.play();
        } else {
            $('img#play').attr("src","https://files.slack.com/files-pri/T04T20JQR-F3DBP4WH1/mediaplay.png");

            myAudio.pause();
        }
    }


    function cleared(){
        var myAudio = document.getElementById("myAudio");
        $('img#play').attr("src","https://files.slack.com/files-pri/T04T20JQR-F3DBP4WH1/mediaplay.png");
        myAudio.pause();
    }

</script>

</body>
</html>

