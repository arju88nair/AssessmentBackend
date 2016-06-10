<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <title><?=$tests['testName']?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"/>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://localhost/Laravel/Assessment/public/dashboardAction">Asessment</a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="http://localhost/Laravel/Assessment/public/dashboardAction">Home</a></li>
            <li><a href="http://localhost/Laravel/Assessment/public/addTest">Add tests</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">

            <li>*<a href="http://localhost/Laravel/Assessment/public/loginAdmin"><span
                            class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">

    <h1><?=$tests['testName']?></h1>
    <hr>
    <hr>
    <form class="form-horizontal" role="form"  method="post" action="{{ action('userController@saveEdit') }}" accept-charset="UTF-8">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Test Name:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="tName" placeholder="Enter Test Name"
                       value="<?=$tests['testName']?>">
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Image URL:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="ImageUrl" placeholder="Enter Image URL"
                       value="<?=$tests['ImageUrl']?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">ID</label>

            <div class="col-sm-10">
                <input type="hidden" class="form-control" name="_id" placeholder="Enter Image URL"
                       value="<?=$tests['_id']?>">
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Test Duration:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="tDuration" placeholder="Enter Test Duration"
                       value="<?=$tests['testDuration']?>">
            </div>
        </div>



        <div class="form-group">
            <label for="sel1" >Skip Flag:</label>
            <select name="flag"  class="form-control">
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
                       value="<?=$tests['corporateUrl']?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Weightage</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="Weightage" placeholder="Enter Weightage"
                       value="<?=$tests['corporateUrl']?>">
            </div>
        </div>


        <div class="form-group">
            <label for="comment">Summary:</label>
            <textarea class="form-control" rows="5" name="Summary"><?=$tests['shortDescription']?></textarea>
        </div>


        <div class="form-group">
            <label for="comment">Description:</label>
            <textarea class="form-control" rows="5" name="description"><?=$tests['testDescription']?></textarea>
        </div>


        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Expiry Date:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="date" placeholder="Enter Expiry Date"
                       value="<?=$tests['expiryDate']?>">
            </div>
        </div>

        <hr>
        <hr>
        <br>
        <br>
        <h3>Questions </h3>
        <br>

        <?php foreach( $tests['questions'] as $item ): ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Question Title:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Qtitle[]" placeholder="Enter question title"
                       value="<?=$item['questiontitle']?>">
            </div>
        </div>

        <div class="form-group">
            <label for="sel1" >Multiple-choice:</label>
            <select name="Mflag[]"  class="form-control">
                <option vale="False">False</option>
                <option value="True">True</option>

            </select>
        </div>
        <br>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Question Image URL:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="QURL[]" placeholder="Enter Question Image URL"
                       value="<?=$item['questionImageUrl']?>">
            </div>
        </div>
        <br>

        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Question weightage:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="weightage[]" placeholder="Enter Question weightage"
                       value="<?=$item['weightage']?>">
            </div>
        </div>

        <br>
        <?php foreach ($item['options'] as $items): ?>
        <br>

        <div class="form-group">
            <div class="col-sm-10">
                <label class="control-label col-sm-2" for="email">Option:</label>
                <input type="text" class="form-control" name="qOption[]" placeholder="Enter options"
                       value="<?=$items?>">
            </div>
        </div>
        <br>
        <?php endforeach ?>
        <?php foreach ($item['solutionkey'] as $keys): ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Answer key:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="qAnswer[]" placeholder="Enter answer key"
                       value="<?=$keys?>">
            </div>
        </div>
        <hr>
        <br>
        <br>

        <?php endforeach ?>
        <?php endforeach ?>



        <button type="submit" class="btn btn-primary">Save</button>


        <a href="http://localhost/Laravel/Assessment/public/testDetails?action=<?=$tests['_id']?>"class="btn btn-default" role="button">Cancel</a>

    </form>

    <br>
    <br>


</div>

</body>
</html>
