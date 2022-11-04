<?php
require 'nav.php';
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gym Plan Form</title>
  </head>

  <body>

  <div class="container my-3">
    <div class="d-flex justify-content-between m-2">
      <h1 class="text-center">Binish Expense Details Form</h1>
      <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal"> Add New Gym Plan</button>
    </div>
    <div id="displayDataTable"></div>
  </div>

  <!-- insert modal -->
    <div class="modal fade" id="completeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="completeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Create New Gym Plan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              <div class="form-group">
                <label for="pname">Plan Name</label>
                <input type="text" class="form-control" id="pname" placeholder="Enter your Name">
              </div> 
          
              <div class="form-group">
                <label for="pperiod">Plan Period</label>
                <input type="text" class="form-control" id="pperiod" placeholder="Enter Plan Period">
              </div> 
          
              <div class="form-group">
                <label for="pprice">Plan Price</label>
                <input type="text" class="form-control" id="pprice" placeholder="Enter Plan Price">
              </div> 
          
              <div class="form-group">
                <label for="pdiscount">Plan Discount</label>
                <input type="text" class="form-control" id="pdiscount" onchange="total()" placeholder="Enter Plan Discount">
              </div> 
          
              <div class="form-group">
                <label for="pamount">Total Amount</label>
                <input type="text" class="form-control" id="pamount" placeholder="Enter Total Amount">
              </div> 
        </div>
        <div class="modal-footer">
          <button type="button" id="btnsave" class="btn btn-dark" onclick="addplan()" >Submit</button>
          <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


      <!--Update modal-->
  <div class="modal fade" id="updatemodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatemodel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Gym Plan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="updatename">Name</label>
            <input type="text" class="form-control" id="updatename" placeholder="Enter your Name">
          </div> 
          <div class="form-group">
            <label for="updateperiod">Plan Period</label>
            <input type="text" class="form-control" id="updateperiod">
          </div> 
    
          <div class="form-group">
            <label for="updateprice">Price</label>
            <input type="text" class="form-control" id="updateprice" placeholder="Enter your Name">
          </div> 
            
          <div class="form-group">
            <label for="updatediscount">Discount</label>
            <input type="text" class="form-control" id="updatediscount" onchange="total()" placeholder="Enter your Name">
          </div> 
        
          <div class="form-group">
            <label for="updateamount">Total amount</label>
            <input type="text" class="form-control" id="updateamount" placeholder="Enter your Name">
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
          url:"gym_plan_process.php",
          type:'post',
          data:{displaysend:displayData},
          success:function(data,status){
            $('#displayDataTable').html(data);
          }
        });
      }


  //insert function 
    function addplan(){
      var pname=$('#pname').val();
      var pperiod=$('#pperiod').val();
      var pprice=$('#pprice').val();
      var pdiscount=$('#pdiscount').val();
      var pamount=$('#pamount').val();
      var psave=$('#btnsave').val(); 
      $.ajax({
      url:"gym_plan_process.php",
      type:'post',
      data:{
          pname:pname,
          pperiod:pperiod,
          pprice:pprice,
          pdiscount:pdiscount,
          pamount:pamount,
          psave:psave,
      },
      success:function(data,status){
          alert("successfully inserted a new record");
          displayData();
          $('#completeModal').modal("hide");
        }
      });
    }

  //delete record
  function deleteplan(id){
    $.ajax({
      url:"gym_plan_process.php",
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
      $.post("gym_plan_process.php",{updateid:id},
      function(data,status){
        var planid=JSON.parse(data);
        $('#updatename').val(planid.planName);
        $('#updateperiod').val(planid.planperiod);
        $('#updateprice').val(planid.PlanPrice);
        $('#updatediscount').val(planid.PlanDiscount);
        $('#updateamount').val(planid.totalAmount);
        $('#hiddendata').val(planid.gmp_id);
      });
      $('#updatemodel').modal("show");
  }
  //onclick update event
  function updateDetails(){
    var updatename=$('#updatename').val();
    var updateperiod=$('#updateperiod').val();
    var updateprice=$('#updateprice').val(); 
    var updatediscount=$('#updatediscount').val();
    var updateamount=$('#updateamount').val();
    var hiddendata=$('#hiddendata').val();
     $.post("gym_plan_process.php",{
      name:updatename,
      period:updateperiod,
      price:updateprice,
      discount:updatediscount,
      amount:updateamount,
      hiddendata:hiddendata,

     },function(data,status){
      alert("changes has been applied");
      displayData();
      $('#updatemodel').modal("hide");
     });
  }

    function total(){

    var period=parseInt(document.getElementById("pperiod").value);
    var price=parseInt(document.getElementById("pprice").value);
    var discount=parseInt(document.getElementById("pdiscount").value);

    var newprice=(period*price);
    var discountprice=(discount/100)*newprice;
    var total=newprice-discountprice;

    document.getElementById("pamount").value = total;
  }

</script>