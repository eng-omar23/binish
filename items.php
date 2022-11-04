<?php
include("nav.php");
include("db.php");
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product Details Form</title>
  </head>
  <body>
  <div class="container my-3">
    <div class="d-flex justify-content-between m-2">
      <h1 class="text-center">Binish Expense Details Form</h1>
      <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal"> Add New Prodct Details</button>
    </div>
    <div id="displayDataTable"></div>
  </div>
    <!-- Insert Modal  -->
    <div class="modal fade" id="completeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="completeModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Create New Item</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <select type="text" class="form-control" id="name">
                        <option>...Choose product Name..</option>
                        <?php
                            $q=mysqli_query($conn,"select * from initial_items");
                            if($q){
                                $q=mysqli_query($conn,"select * from initial_items");
                                while($data=mysqli_fetch_array($q)){
                                    ?>
                                      <option value='<?php echo $data['id'];?>'><?php echo $data["Name"];?></option>
                                      <?php
                                }  
                            }
                            else{
                            ?>
                            <option value='No data Available'>No data Available</option>
                            <?php
                        }
                        ?>
                  </select>
                  </div> 
                  <div class="form-group">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" id="unit" placeholder="Enter Unit">
                  </div> 
                  <div class="form-group">
                    <label for="cost">Cost</label>
                    <input type="text" class="form-control" id="cost" placeholder="Enter Cost  ">
                  </div> 
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter Price  ">
                  </div> 
                  <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date">
                  </div> 
          </div>
          <div class="modal-footer">
            <button type="button" id="btnsave" class="btn btn-dark" onclick="addProduct()">Submit</button>
            <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>

  <!-- Update modal -->

  <div class="modal fade" id="updatemodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatemodel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Update Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="updatename">Product Name</label>
            <select type="text" class="form-control" id="updatename">
            <?php
            $q=mysqli_query($conn,"select * from initial_items");
            if($q){
                $q=mysqli_query($conn,"select * from initial_items");
                while($data=mysqli_fetch_array($q)){
                    ?>
                      <option value='<?php echo $data['id'];?>'><?php echo $data["Name"];?></option>
                      <?php
                }  
            }
            else{
                ?>
                <option value='No data Available'>No data Available</option>
                <?php
            }
            ?>
            </select>
          </div> 
          <div class="form-group">
            <label for="updateunit"> Unit</label>
            <input type="text" class="form-control" id="updateunit">
          </div> 
          <div class="form-group">
            <label for="updatecost"> Cost</label>
            <input type="text" class="form-control" id="updatecost">
          </div> 
          <div class="form-group">
            <label for="updateprice">Price</label>
            <input type="text" class="form-control" id="updateprice" >
          </div>
          <div class="form-group">
            <label for="updatedate">DATE</label>
            <input type="date" class="form-control" id="updatedate" placeholder="Enter your phone">
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
      url:"item_process.php",
      type:'post',
      data:{displaysend:displayData},
      success:function(data,status){
        $('#displayDataTable').html(data);
      }
    });
  }

    //add product
  function addProduct(){
    var name=$('#name').val();
    var unit=$('#unit').val();
    var cost=$('#cost').val();
    var price=$('#price').val();
    var reg_date=$('#date').val();
    var btnsave=$('#btnsave').val();
    $.ajax({
    url:"item_process.php",
    type:'post',
    data:{
      name:name,
      unit:unit,
      cost:cost,
      price:price,
      date:reg_date,
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
  function deleteproduct(id){
    $.ajax({
      url:"item_process.php",
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
    $.post("item_process.php",{updateid:id},
    function(data,status){
    var itm=JSON.parse(data);
      $('#updatename').val(itm.item_name);
      $('#updateunit').val(itm.unit);
      $('#updatecost').val(itm.cost);
      $('#updateprice').val(itm.price);
      $('#updatedate').val(itm.date);
    });
    $('#updatemodel').modal("show");
  }
  
  //onclick update event
  function updateDetails(){
    var name=$('#updatename').val();
    var unit=$('#updateunit').val();
    var cost=$('#updatecost').val();
    var price=$('#updateprice').val();
    var date=$('#updatedate').val();
    var hiddendata=$('#hiddendata').val();
    var update=$('#btnupdate').val();
    $.post("item_process.php",{
      name:name,
      unit:unit,
      cost:cost,
      price:price,
      date:date,
      hiddendata:hiddendata,

    },function(data,status){
        alert("successfull updated");
        $('#updatemodel').modal("hide");
        displayData();
     });
  }
</script>

</body>
</html>