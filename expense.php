<?php
require 'nav.php';
require 'db.php';
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Expense Details Form</title>
  </head>
 
  <body> 
    <div class="container my-3">
    <div class="d-flex justify-content-between m-2">
      <h1 class="text-center">Binish Expense Details Form</h1>
      <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal"> Add New Expense</button>
    </div>
    <div id="displayDataTable"></div>
  </div>
<!-- Update Modal -->
<div class="modal fade" id="updatemodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="compupdatemodelleteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Expense Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="updatetype">Type</label>
          <input type="text" class="form-control" id="updatetype">
        </div> 
        
        <div class="form-group">
          <label for="updateamount">Amount</label>
          <input type="text" class="form-control" id="updateamount">
        </div> 
      
        <div class="form-group">
          <label for="updatedate">Date </label>
          <input type="date" class="form-control" id="updatedate" >
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" id="btnupdate" onclick="updateDetails()" >Update</button>
        <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
        <input type="hidden" id="hiddendata">
      </div>
    </div>
  </div>
</div>

<!-- Insert Modal -->
<div class="modal fade" id="completeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="completeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">New Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="type">Expense Type</label>
          <input type="text" class="form-control" id="type" placeholder="Enter your Name">
        </div> 
      
        <div class="form-group">
          <label for="amount">Amount</label>
          <input type="text" class="form-control" id="amount" placeholder="Enter your Name">
        </div> 

        <div class="form-group">
          <label for="date">Expense date</label>
          <input type="date" class="form-control" id="date">
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" id="btnsave" class="btn btn-dark" onclick="addExpense()" >Submit</button>
        <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 
    </body>

<script>
  //loads the data 
  $(document).ready(function(){
    displayData();
  });

  //data view function
  function displayData(){
    var displayData="true";
    $.ajax({
      url:"expense_handler.php",
      type:'post',
      data:{displaysend:displayData},
      success:function(data,status){
        $('#displayDataTable').html(data);
      }
    });
  }


//insert function 
 function addExpense(){
    var type=$('#type').val();
    var amount=$('#amount').val();
    var date=$('#date').val();
    var btnAdd=$('#btnsave').val();   
    $.ajax({
      url:"expense_handler.php",
      type:'post',
      data:{
          type:type,
          amount:amount,
          date:date,
          save:btnAdd,
      
      },
      success:function(data,status){
        alert("successfully inserted a new record");
        displayData();
        $('#completeModal').modal("hide");
      }
    });
  }
  //delete record
  function delExpense(id){
    $.ajax({
      url:"expense_handler.php",
      type:"post",
      data:{deleteid:id},
      success:function(data,status){
      displayData();
    }
    });
  }

//Get details of the form
function GetDetails(id){
    $('#hiddendata').val(id);
    $.post("expense_handler.php",{updateid:id},
    function(data,status){
    var Exp=JSON.parse(data);
      $('#updatetype').val(Exp.Expense_Type);
      $('#updateamount').val(Exp.amount);
      $('#updatedate').val(Exp.ExpenseDate);
    });
    $('#updatemodel').modal("show");
}
  //onclick update event
  function updateDetails(){
    var id=$('#hiddendata').val();
    var type=$('#updatetype').val();
    var amount=$('#updateamount').val(); 
    var date=$('#updatedate').val();
    var update=$('#btnupdate').val();

     $.post("expense_handler.php",{
      type:type,
      amount:amount,
      date:date,
      id:id,
      update:update,

     },function(data,status){
      alert("changes has been applied");
      displayData();
      $('#updatemodel').modal("hide");
     });
  }

      </script>