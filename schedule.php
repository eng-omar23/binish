<?php
include("nav.php");
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Schedule Form</title>
  </head>
  <body>
  <div class="container my-3">
    <div class="d-flex justify-content-between m-2">
      <h1 class="text-center">Binish Expense Details Form</h1>
      <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal"> Add New Shift</button>
    </div>
    <div id="displayDataTable"></div>
  </div>

    <!-- insert modal -->
    <div class="modal fade" id="completeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Create New Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="completshift">Shift</label>
            <input type="text" class="form-control" id="completshift" placeholder="Enter SHIFT Name">
          </div> 
          <div class="form-group">
            <label for="completestart">Start Time</label>
            <input type="text" class="form-control" id="completestart" placeholder="Enter START Time">
          </div> 
          <div class="form-group">
            <label for="completend">End Time</label>
            <input type="text" class="form-control" id="completend" placeholder="Enter END Time ">
          </div> 
          <div class="form-group">
            <label for="completedate">Date</label>
            <input type="date" class="form-control" id="completedate">
          </div> 
        </div>
        <div class="modal-footer">
          <button type="button" id="btnsave" class="btn btn-dark" onclick="addshift()" >Submit</button>
          <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<!--update modal-->
<div class="modal fade" id="updatemodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatemodel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Schedule</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="shift">SHIFT Name</label>
          <input type="text" class="form-control" id="shift">
        </div> 
        <div class="form-group">
          <label for="start">SHIFT Start</label>
          <input type="text" class="form-control" id="start">
        </div> 
        <div class="form-group">
          <label for="end">SHIFT End</label>
          <input type="text" class="form-control" id="end" >
        </div>
        <div class="form-group">
          <label for="date">DATE</label>
          <input type="date" class="form-control" id="date" placeholder="Enter your phone">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnupdate" class="btn btn-dark" onclick="updateDetails()" >Update</button>
        <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
        <input type="hidden" id="hiddendata">
      </div>
    </div>
  </div>
</div>
  
<script>
  $(document).ready(function(){
    displayData();
  });

  //display data
  function displayData(){
      var displayData="true";
    $.ajax({
      url:"schedule_process.php",
      type:'post',
      data:{
        displaysend:displayData

      },
      success:function(data,status){
        $('#displayDataTable').html(data);

      }
    });
  }



  function addshift(){
      var shiftAdd=$('#completshift').val();
      var starAdd=$('#completestart').val();
      var endAdd=$('#completend').val();
      var dateAdd=$('#completedate').val();
      var btnsave=$('#btnsave').val();
      $.ajax({
      url:"schedule_process.php",
      type:'post',
        data:{
          shift:shiftAdd,
          start:starAdd,
          end:endAdd,
          date:dateAdd,
          save:btnsave,
        },
      success:function(data,status){
        alert("successfully inserted a new record");
        displayData();
        $('#completeModal').modal("hide");
      }
    });
  }
    
  //delete record
  function deleteschedule(id){
    $.ajax({
      url:"schedule_process.php",
      type:"post",
      data:{deleteid:id},
      success:function(data,status){
        alert("successfull deleted ");
        displayData();
    }
    });
  }
  //get details function
  function GetDetails(id){
    $('#hiddendata').val(id);
    $.post("schedule_process.php",{updateid:id},
    function(data,status){
        var sch_id=JSON.parse(data);
        $('#shift').val(sch_id.SHIFT);
        $('#start').val(sch_id.START_TIME);
        $('#end').val(sch_id.END_TIME);
        $('#date').val(sch_id.DATE);
    });
  $('#updatemodel').modal("show");
  }
  
  //onclick update event
  function updateDetails(){
    var shift=$('#shift').val();
    var start=$('#start').val();
    var end=$('#end').val();
    var date=$('#date').val();
    var hiddendata=$('#hiddendata').val();
    var update=$('#btnupdate').val();
     $.post("schedule_process.php",{
      shift:shift,
      start:start,
      end:end,
      date:date,
      hiddendata:hiddendata,
     },function(data,status){
        $('#updatemodel').modal("hide");
        displayData();
     });
  }
  </script>

</body>
</html>