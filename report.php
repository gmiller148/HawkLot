<?php
  include "header/header-control.php";
?>

<head>
  <title>Report-Hawklot</title>
  <?php include "header/header-head.php"; ?>
</head>

<body>
<?php include "header/header-body.php"; ?>

<form  method="post">

<div class="form-group">
  <label class="col-md-6"><legend>Report an Issue</legend></label>
</div>

<div class="form-group">
  <td class="col-md-6">This form is</td>
</div>

<div class="form-group">
  <label class="col-md-4" for="spot_num">Spot Number</label>
  <div class="col-md-4">
  <input id="spot_num" name="basicdetails_duration" type="text" placeholder="Number" class="form-control input-md">
  </div>
</div>


<div class="form-group">
  <label class="col-md-4" for="description">Description of Car (optional)</label>
  <div class="col-md-4">
    <textarea id="description" name="basicdetails_duration" class="form-control" rows="4" placeholder="Description"></textarea>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="submitpage_submitvalid"></label>
  <div class="col-md-4">
    <button id="submitpage_submitvalid" name="submitpage_submitvalid" class="btn btn-primary">Submit Report</button>
  </div>
</div>

</form>
</body>
