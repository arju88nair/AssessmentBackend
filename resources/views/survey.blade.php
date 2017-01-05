<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Added Links</title>
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
    ul#ul {
        height: auto;
        margin-top: 5%;
        list-style-type: none;
    }

    li.li {
        border: thin solid lightgray;
        /* padding-bottom: 1%; */
        box-shadow: 0px 1px 1px #bbbbbb;
        height: auto;
        margin-bottom: 1%;
        padding-left: 3%;
        padding-bottom: 1%;
        padding-top: 2%;
        padding-right: 3%;
    }

    span#status {
        float: right;
        color: lightcoral;;
        font-size: 1.1em;
        font-weight: bold;;
    }

    span.added {
        font-weight: bold;
        font-size: 1.1em;
        color:grey;
    }
    span.addedD {
        font-weight: bold;
        font-size: 1.1em;
        color:grey;

    }
    .comments{
        word-wrap: break-word;
    }
    .description{
        word-wrap: break-word;
        color: #737373;
        font-size: 13px;
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

.container .survey-form{
    width: 100%;
    padding: 3% 20% 0 20%;
}
.container .survey-form {

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
                <li id="setId" style="font-size: 1.2em">
                     <a href="survey"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span>&nbsp; &nbsp;Survey</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">

          <div class="survey-form">
            {{ Form::open(['url'=>'addSurvey']) }}

                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
                  </div>
                  <div class="form-group">
                    <label for="pass1">Text</label>
                    <input type="text" class="form-control" id="pass1" name="text" placeholder="Enter Text" required>
                  </div>
                  <div class="form-group">
                    <label for="surveyid">Survey ID</label>
                    <input type="text" class="form-control" id="surveyid" name="surveyID" placeholder="Enter Survey ID" required>
                    <small id="surveyid" class="form-text text-muted"><b style="color: #ff0000">*</b> Survey Id will be same as it is.</small>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Submit">
                    <span style="font-size: 13px; color: #06B53C;"> <?php echo Session::get('message'); ?> </span>
                  </div>

            {{ Form::close() }}
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

</body>
</html>

