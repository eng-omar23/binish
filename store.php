<?php
require 'nav.php';
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Store Form</title>
  </head>

  <body>


  <div class="container my-3">
    <div class="d-flex justify-content-between m-2">
      <h1 class="text-center">Binish Expense Details Form</h1>
      <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal"> Add New Product</button>
    </div>
    <div id="displayDataTable"></div>
  </div>
      <!--Update modal-->
  <div class="modal fade" id="updatemodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatemodel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Product Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="updatename">Name</label>
            <input type="text" class="form-control" id="updatename" placeholder="Enter your Name">
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



    <!-- insert modal -->
    <div class="modal fade" id="completeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="completeModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="completeModal">New Product Name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="completename">Name</label>
              <input type="text" class="form-control" id="completename" placeholder="Enter your Name">
            </div> 
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-dark" onclick="addproduct()" >Submit</button>
              <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</body>

<script>
    //store_process.php
    //loads the data 
    $(document).ready(function(){
      displayData();
    });

  //data view function
  function displayData(){
    var displayData="true";
    $.ajax({
      url:"store_process.php",
      type:'post',
      data:{displaysend:displayData},
      success:function(data,status){
        $('#displayDataTable').html(data);
      }
    });
  }


  //insert function 
 function addproduct(){
    var nameAdd=$('#completename').val();
    $.ajax({
      url:"store_process.php",
      type:'post',
      data:{nameSend:nameAdd,},
      success:function(data,status){
        alert("successfully inserted a new record");
        displayData();
        $('#completeModal').modal("hide");
      }
    });
  }

  //delete record
  function deleteProduct(id){
    $.ajax({
      url:"store_process.php",
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
      $.post("store_process.php",{updateid:id},
      function(data,status){
    var Productid=JSON.parse(data);
        $('#updatename').val(Productid.Name);
        $('#hiddendata').val(Productid.id);
      });
    $('#updatemodel').modal("show");
  }
  //onclick update event
  function updateDetails(){
    var updatename=$('#updatename').val();
    var hiddendata=$('#hiddendata').val();
     $.post("store_process.php",{
      updatename:updatename,
      hiddendata:hiddendata

     },function(data,status){
      alert("changes has applied");
      displayData();
      $('#updatemodel').modal("hide");
     });
  }
</script>