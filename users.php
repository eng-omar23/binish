<?php
include("nav.php");
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Users Form</title>
  </head>
  <body>
 <div class="container my-3">
    <div class="d-flex justify-content-between m-2">
      <h1 class="text-center">Binish Expense Details Form</h1>
      <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal"> Add New User</button>
    </div>
    <div id="displayDataTable"></div>
  </div>
    <!-- Insert Model -->
    <div class="modal fade" id="completeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Create user</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label for="completename">Name</label>
                <input type="text" class="form-control" id="completename" placeholder="Enter your Name">
              </div> 
              <div class="form-group">
                <label for="completepass">passowrd</label>
                <input type="password" class="form-control" id="completepass" placeholder="Enter your Email">
              </div> 
              <div class="form-group">
                <label for="completetype">Type</label>
                <select class="form-control" id="completetype">
                  <option> Choose user Type<option>
                  <option> Admin<option>
                  <option> User<option>
                </select>
              </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" onclick="adduser()" >Submit</button>
            <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>





<!--update modal-->
<div class="modal fade" id="updatemodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="form-group">
              <label for="updatename">User Name</label>
              <input type="text" class="form-control" id="updatename" placeholder="Enter your Email">
            </div> 
            <div class="form-group">
              <label for="updatepass">Password</label>
              <input type="password" class="form-control" id="updatepass" placeholder="Enter your phone">
            </div> 
            <div class="form-group">
              <label for="updatetype">Type</label>
              <select class="form-control" id="updatetype">
              <option> Admin<option>
              <option> User<option>
          </select>
            </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" onclick="updateDetails()" >Update</button>
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
    url:"users_process.php",
    type:'post',
    data:{
      displaysend:displayData

    },
    success:function(data,status){
      $('#displayDataTable').html(data);

     }
  });
}



  function adduser(){

    var nameAdd=$('#completename').val();
    var emailAdd=$('#completepass').val();
    var mobileAdd=$('#completetype').val();
    $.ajax({
     url:"users_process.php",
     type:'post',
    data:{
      completename:nameAdd,
      completepass:emailAdd,
      completetype:mobileAdd,
     },
   success:function(data,status){
      alert("successfully inserted a new record");
      displayData();
      $('#completeModal').modal("hide");
     }
    });
  }
    
  //delete record
  function deleteuser(id){
    $.ajax({
      url:"users_process.php",
      type:"post",
      data:{
        Sendid:id

      },
      success:function(data,status){
        alert("successfull deleted ");
      displayData();
      
    }
    });
 


  }
  //get details function
  function GetDetails(id){
    $('#hiddendata').val(id);
    $.post("users_process.php",{updateid:id},
    function(data,status){
   var userid=JSON.parse(data);
      $('#updatename').val(userid.username);
      $('#updatepass').val(userid.userpass);
      $('#updatetype').val(userid.usertye);
    });
  $('#updatemodel').modal("show");
  }
  
  //onclick update event
  function updateDetails(){
    var updatename=$('#updatename').val();
    var updatepass=$('#updatepass').val();
    var updatetype=$('#updatetype').val();
    var hiddendata=$('#hiddendata').val();
     $.post("users_process.php",{
      updatename:updatename,
      updatepass:updatepass,
      updatetype:updatetype,
      hiddendata:hiddendata

     },function(data,status){
      $('#updatemodel').modal("hide");
      displayData();


     });

  }

  

  </script>

</body>
</html>