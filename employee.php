<?php
include("nav.php");
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Binish Employees Form</title>
  </head>
  <body>

  <div class="container my-3">
    <div class="d-flex justify-content-between m-2">
      <h1 class="text-center">Binish Expense Details Form</h1>
      <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal"> Add New Employee</button>
    </div>
    <div id="displayDataTable"></div>
  </div>

<!-- insert modal -->
  <div class="modal fade" id="completeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="completeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">New Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="first">First Name</label>
          <input type="text" class="form-control" id="first" placeholder="Enter First  Name">
        </div> 
        <div class="form-group">
          <label for="last">Last Name</label>
          <input type="text" class="form-control" id="last" placeholder="Enter Last Name">
        </div> 
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" placeholder="Enter Email ">
        </div> 
        <div class="form-group">
          <label for="phone">phone</label>
          <input type="text" class="form-control" id="phone" placeholder="Enter Phone ">
        </div> 
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" placeholder="Enter Address  ">
        </div> 
        <div class="form-group">
          <label for="gender">Gender</label>
          <input type="text" class="form-control" id="gender" placeholder="Enter Gender  ">
        </div> 
        <div class="form-group">
          <label for="date">Date</label>
          <input type="date" class="form-control" id="date">
        </div> 
        <div class="form-group">
          <label for="salary">Salary</label>
          <input type="text" class="form-control" id="salary" placeholder="Enter Salary ">
        </div> 
        <div class="form-group">
          <label for="tittle">Tittle</label>
          <input type="text" class="form-control" id="tittle" placeholder="Enter Position">
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" id="btnsave" class="btn btn-dark" onclick="addemployee()" >Submit</button>
        <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- update modal -->
<div class="modal fade" id="updatemodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatemodel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="updatefirst">First Name</label>
            <input type="text" class="form-control" id="updatefirst">
          </div> 
          <div class="form-group">
            <label for="updatelast">Last Name</label>
            <input type="text" class="form-control" id="updatelast">
          </div> 
          <div class="form-group">
            <label for="updatemail">Email</label>
            <input type="text" class="form-control" id="updatemail" >
          </div>
        
          <div class="form-group">
            <label for="updatephone"> Phone</label>
            <input type="text" class="form-control" id="updatephone" >
            <div class="form-group">
            <label for="updateaddress">Address</label>
            <input type="text" class="form-control" id="updateaddress" >
          </div>
          <div class="form-group">
            <label for="updategender">Gender</label>
            <input type="text" class="form-control" id="updategender" >
          </div>
          <div class="form-group">
            <label for="updatedate">Hire DATE</label>
            <input type="date" class="form-control" id="updatedate">
          </div>
          <div class="form-group">
            <label for="updatesalary">Salary</label>
            <input type="text" class="form-control" id="updatesalary">
          </div>
          <div class="form-group">
            <label for="position">Position</label>
            <input type="text" class="form-control" id="position" >
          </div>
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
    url:"employess_process.php",
    type:'post',
    data:{
      displaysend:displayData

    },
    success:function(data,status){
      $('#displayDataTable').html(data);

     }
  });
}
    function addemployee(){
      var first=$('#first').val();
      var last=$('#last').val();
      var email=$('#email').val();
      var phone=$('#phone').val();
      var address=$('#address').val();
      var gender=$('#gender').val();
      var date=$('#date').val();
      var salary=$('#salary').val();
      var tittle=$('#tittle').val();
      var btnsave=$('#btnsave').val();
      $.ajax({
      url:"employess_process.php",
      type:'post',
      data:{
        first:first,
        last:last,
        email:email,
        phone:phone,
        address:address,
        gender:gender,
        date:date,
        salary:salary,
        tittle:tittle,
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
  function delEmployee(id){
    $.ajax({
      url:"employess_process.php",
      type:"post",
      data:{
        deleteid:id

      },
      success:function(data,status){
        alert("successfull deleted ");
      displayData();
      
    }
    });
 


  }
  //get details function
  function GetEmp(id){
    $('#hiddendata').val(id);
    $.post("employess_process.php",{updateid:id},
    function(data,status){
    var emp=JSON.parse(data);
      $('#updatefirst').val(emp.first_name);
      $('#updatelast').val(emp.last_name);
      $('#updatemail').val(emp.email);
      $('#updatephone').val(emp.phone);
      $('#updateaddress').val(emp.emp_address);
      $('#updategender').val(emp.gender);
      $('#updatedate').val(emp.hired_Date);
      $('#updatesalary').val(emp.basic_salary);
      $('#position').val(emp.jobTitle);
    });
  $('#updatemodel').modal("show");
  }
  
  //onclick update event
  function updateDetails(){
    var first= $('#updatefirst').val();
    var last=   $('#updatelast').val();
    var email=  $('#updatemail').val();
    var phone= $('#updatephone').val();
    var address= $('#updateaddress').val();
    var gender= $('#updategender').val();
    var date=$('#updatedate').val();
    var salary=$('#updatesalary').val();
    var position=$('#position').val();
    var hiddendata=$('#hiddendata').val();
     $.post("employess_process.php",{
      first:first,
      last:last,
      email:email,
      address:address,
      phone:phone,
      gender:gender,
      date:date,
      salary:salary,
      position:position,
      hiddendata:hiddendata
     },function(data,status){
      $('#updatemodel').modal("hide");
      alert("updated successfully");
      displayData();
     });
  }
  </script>

</body>
</html>