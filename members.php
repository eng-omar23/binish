<?php
include("nav.php");

    $id = '';
    $ids = '';
    $str = ''; 

    $query=mysqli_query($conn,"SELECT mbr_id as id from members;");
    while($rows=mysqli_fetch_assoc($query)){
        $ids = $rows['id'];
    }

    function increament($string){
        $string = preg_split('/(\d+)/', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $str = $string[0];
        $num = $string[1];
        $num++;
        if($num>999){
            $str++;
            $num = 000;
        }
        return $str.$num;
    }

    $id = increament($ids);
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
      <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal"> Add New Member</button>
    </div>
    <div id="displayDataTable"></div>
  </div>

<!-- insert modal -->
<div class="modal fade" id="completeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="completeModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">New Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row m-1 ">
                    <div class="form-group col-md-4">
                        <label class="form-lable">Memberid</label>
                        <input class="form-control " type="text" name="memberid" id="memberid">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-lable ">First Name</label>
                        <input class="form-control" type="text" name="fname" id="fname" placeholder="First Name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-lable ">Last Name</label>
                        <input class="form-control" type="text" name="lname" id="lname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="row m-1 ">
                    <div class="form-group col-md-4">
                        <label class="form-lable">phone</label>
                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-lable">Address</label>
                        <input class="form-control" type="text" name="address" id="address" placeholder="Address" required>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label><input type="radio" name="gender" id="gender" value="male">Male</label> 
                        <label><input type="radio" name="gender" id="gender" value="female">Female</label>
                    </div>
                </div>
                <div class="row m-1 ">
                    
                <div class="form-group col-md-6">
                        <label class="form-lable">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status" id="status" required>
                            <option value="">--Select Status--</option>
                            <option value="Enabled">Enabled</option>
                            <option value="Disabled">Disabled</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-lable">Plan</label>
                        <select name="PlanName" class="form-select" required name ="plan"  id="plan">
                            <option value="">--select Plan for member--</option>
                            <?php
                            $query=mysqli_query($conn,"SELECT planName FROM binish.gym_plan order by gmp_id");
                            if($query){
                                $query=mysqli_query($conn,"SELECT planName FROM binish.gym_plan order by gmp_id");
                                while($rows=mysqli_fetch_assoc($query))
                                {
                            ?>
                            <option value='<?php echo $rows['planName']; ?>'><?php echo $rows['planName'];?></option>
                            <?php 
                                }
                                    }
                                    else{
                                        ?>
                            <option>No Data Available here</option>
                            <?php
                                        }
                                    ?>
                        </select>
                    </div>
                </div>

                <div class="row m-1 ">
                    <div class="form-group col-md-4">
                        <label class="form-lable">Schedule</label>
                        <select name="SceduleName" class="form-select" required id="keep">
                            <option value="">--select schedule for member--</option>
                            <?php
                                $query=mysqli_query($conn,"SELECT shift FROM binish.Schedule order by id");
                                if($query){
                                    $query=mysqli_query($conn,"SELECT shift FROM binish.Schedule order by id");
                                    while($rows=mysqli_fetch_assoc($query))
                                    {
                            ?>
                            <option value='<?php echo $rows['shift']; ?>'><?php echo $rows['shift'];?></option>
                            <?php }
                                }
                                else{
                                    ?>
                            <option>No Data Available here</option>
                                <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-lable">Join Date</label>
                        <input class="form-control" type="date" name="joinDate" id="joinDate" onchange="fillDate();">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-lable">Expiry Date</label>
                        <input class="form-control disabled" type="date" name="ExpDate" id="expDate" readonly>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnsave" class="btn btn-dark" onclick="addMember()" >Submit</button>
        <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- update modal -->
<div class="modal fade" id="updatemodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatemodel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Member Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    <div class="row m-1 ">
                        <div class="form-group col-md-4">
                            <label class="form-lable">Memberid</label>
                            <input class="form-control disabled" type="text" name="memberid" id ="memberid" readonly="true" style="background-color: #cacdcf;">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-lable ">First Name</label>
                            <input class="form-control" type="text" name="fname" id="fname" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-lable ">Last Name</label>
                            <input class="form-control" type="text" name="lname" id ="lname" required>
                        </div>
                    </div>
                    <div class="row m-1 ">
                        <div class="form-group col-md-4">
                            <label class="form-lable">phone</label>
                            <input class="form-control" type="text" name="phone" id="phone" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-lable">Address</label>
                            <input class="form-control" type="text" name="address" id="address" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label><input type="radio" name="gender" id="gender" value="male">Male</label> 
                            <label><input type="radio" name="gender" id="gender" value="female">Female</label>
                        </div>
                    </div>
                    <div class="row m-1 ">
                        <div class="form-group col-md-6">
                            <label class="form-lable">Status</label>
                            <select class="form-select" aria-label="Default select example" name="status" id="status" required>
                                <option value="Enabled">Enabled</option>
                                <option value="Disabled">Disabled</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-lable">Plan</label>
                            <select name="PlanName" class="form-select" required id="plan">
                                <?php
                                $query=mysqli_query($conn,"SELECT planName FROM binish.gym_plan order by gmp_id");
                                if($query){
                                    $query=mysqli_query($conn,"SELECT planName FROM binish.gym_plan order by gmp_id");
                                    while($rows=mysqli_fetch_assoc($query))
                                    {
                                ?>
                                <option value='<?php echo $rows['planName']; ?>'><?php echo $rows['planName'];?></option>
                                <?php 
                                    }
                                        }
                                        else{
                                            ?>
                                <option>No Data Available here</option>
                                <?php
                                            }
                                        ?>
                            </select>
                        </div>
                    </div>

                    <div class="row m-1 ">
                        <div class="form-group col-md-4">
                            <label class="form-lable">Schedule</label>
                            <select name="SceduleName" class="form-select" required id="shift">
                                <?php
                                    $query=mysqli_query($conn,"SELECT shift FROM binish.Schedule order by id");
                                    if($query){
                                        $query=mysqli_query($conn,"SELECT shift FROM binish.Schedule order by id");
                                        while($rows=mysqli_fetch_assoc($query))
                                        {
                                ?>
                                <option value='<?php echo $rows['shift']; ?>'><?php echo $rows['shift'];?></option>
                                <?php }
                                    }
                                    else{
                                        ?>
                                <option>No Data Available here</option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-lable">Join Date</label>
                            <input class="form-control" type="date" name="joinDate" id="joinDate" onchange="fillDate();">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-lable">Expiry Date</label>
                            <input class="form-control disabled" type="date" name="ExpDate" id="expDate" readonly>
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
            url:"members_process.php",
            type:'post',
            data:{
            displaysend:displayData

            },
            success:function(data,status){
            $('#displayDataTable').html(data);
            }
        });
    }
 
  function addMember(){
      var memberid=$('#memberid').val();
      var fname=$('#fname').val();
      var lname=$('#lname').val();
      var phone=$('#phone').val();
      var address=$('#address').val();
      var gender= $("input[name='gender']:checked").val();
      var status=$('#status').val();
      var plan=$('#plan').val();
      var shift=$('#shift').val();
      var joinDate=$('#joinDate').val();
      var expDate=$('#expDate').val();
      var btnsave=$('#btnsave').val();
      $.ajax({
      url:"members_process.php",
      type:'post',
      data:{
        memberid:memberid,
        fname:fname,
        lname:lname,
        phone:phone,
        address:address,
        gender:gender,
        status:status,
        shift:shift,
        plan:plan,
        joinDate:joinDate,
        expDate:expDate,
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
  function DeleteMember(id){
    $.ajax({
      url:"members_process.php",
      type:"post",
      data:{deleteid:id},
      success:function(data,status){
            alert("successfull deleted ");
            displayData();
        }
    });
  }

  function GetDetails(id){
        $('#hiddendata').val(id);
        $.post("members_process.php",{updateid:id},
        function(data,status){
            var medit=JSON.parse(data);
            $('#memberid').val(medit.mbr_id);
            $('#fname').val(medit.first_name);
            $('#lname').val(medit.last_name);
            $('#phone').val(medit.phone);
            $('#address').val(medit.mem_address);
            if(medit.gender==='male'){
                $('input:radio[name=gender]')[0].checked = true;
            }
            else{
                $('input:radio[name=gender]')[1].checked = true;
            }
            $('#status').val(medit.mem_status);
            $('#Plan').val(medit.PlanName);
            $('#shift').val(medit.Shift);
            $('#joinDate').val(medit.join_Date);
            $('#expDate').val(medit.exp_Date);
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




    function fillDate() {
        var plan = document.getElementById("plan").value;
        var JoinDate = document.getElementById("joinDate").value;
        var ExpDate = document.getElementById("expDate");

        jdate = new Date(JoinDate);

        if (plan === "Premium") {

            ExpDate.value = addMonths(jdate, 12);
        } else if (plan === "Gold") {
            ExpDate.value = addMonths(jdate, 6);
        } else if (plan === "Silver") {
            ExpDate.value = addMonths(jdate, 3);
        } else if (plan === "Bronze") {
            ExpDate.value = addMonths(jdate, 1);
        } else {
            alert("Choose a membership Plan");
        }

        function addMonths(date, months) {
            var d = date.getDate();
            date.setMonth(date.getMonth() + +months);
            if (date.getDate() !== d) {
                date.setDate(0);
            }
            date = new Date(date);
            date = date.toLocaleDateString()

            parts = date.split("/");
            year = parts[2];
            day = parts[1];
            months = parts[0];

            if (day < 10) day = "0" + day;
            if (months < 10) months = "0" + months;
            finalDate = year + "-" + months + "-" + day;
            return finalDate;
        }
    }
  </script>

</body>
</html>