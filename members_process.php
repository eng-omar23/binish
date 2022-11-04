<?php
require 'db.php';
$userid = 1;//@$_SESSION['userid'];
$SNO=1;

///========================================read
    if(isset($_POST['displaysend'])){
        ?>
        <div class="table-responsive-md mt-2">
            <table class="table table-hover">
                <tr class="table-dark">
                    <th>Member ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Plan Name</th>
                    <th>Shift</th>
                    <th>Join Date</th>
                    <th>Expiry Date</th>
                    <th>User Name</th>
                    <th>Action</th>
                </tr>
                <?php

                    $query = mysqli_query($conn,"SELECT * FROM members_view order by mbr_id");
                    while($res=mysqli_fetch_assoc($query))
                    {
                ?>
                <tr>

                    <td> <?php echo $res['mbr_id'];?></td>
                    <td> <?php echo $res['first_name'];?></td>
                    <td> <?php echo $res['last_name'];?></td>
                    <td> <?php echo $res['phone'];?></td>
                    <td> <?php echo $res['mem_address'];?></td>
                    <td> <?php echo $res['gender'];?></td>
                    <td> <?php echo $res['mem_status'];?></td>
                    <td> <?php echo $res['planName'];?></td>
                    <td> <?php echo $res['Shift'];?></td>
                    <td> <?php echo $res['join_Date'];?></td>
                    <td> <?php echo $res['exp_Date'];?></td>
                    <td> <?php echo $res['username'];?></td>
                    <td class='action'>
                        <button class="btn btn-dark" onclick="GetDetails('<?php echo $res['mbr_id'];?>')"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="DeleteMember('<?php echo $res['mbr_id'];?>')"><i class="fas fa-trash"></i></button>
                    </td>

                </tr>
                <?php   
                    }
                ?>
            </table>
        </div>
        <?php
    }



    //====================================================insert
    //extract($_POST);
        
    if(isset($_POST['save'])){
        $memberid=$_POST['memberid'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $gender=$_POST['gender'];
        $status=$_POST['status'];
        $shift=$_POST['shift'];
        $plan=$_POST['plan'];
        $joinDate=$_POST['joinDate'];
        $expDate=$_POST['expDate'];

        ///==query to get planid using plan name
        $to_plan_id = mysqli_query($conn,"select gmp_id from gym_plan where planName = '$plan' ");
        if($rows=mysqli_fetch_array($to_plan_id)){
            $planid=$rows['gmp_id'];
        }

        ///==query to get schedule id using shift name
        $to_shift_id = mysqli_query($conn,"SELECT ID FROM `schedule` where SHIFT = '$shift' ");
        if($rows2=mysqli_fetch_array($to_shift_id)){
            $scheduleid = $rows2['ID'];
        }


        $query=mysqli_query($conn,"insert into members values('$memberid', '$fname','$lname', '$phone', '$address', '$gender','$status', '$planid','$scheduleid','$joinDate', '$expDate', '$userid')");
    }

    ///=========================================delete
    if(isset($_POST['deleteid'])){
        $id=$_POST['deleteid'];
        $q=mysqli_query($conn,"delete from members where mbr_id='$id'");
    }


    ///==================================================================update
    if(isset($_POST['updateid'])){
        $id=$_POST['updateid'];
        $res=array();
        $q=mysqli_query($conn,"select * from members_view where mbr_id= '$id' ");
    
        if($rows=mysqli_fetch_array($q)){
            $res=$rows;
        }
        echo json_encode($res);
    }
    else{
        $response['status']=200;
        $response['message']="no data has been found";
    }

    if(isset($_POST['hiddendata'])){
        $id=$_POST['hiddendata'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $phone=$_POST['phone'];
        $address=$_POST['mem_address'];
        $gender=$_POST['gender'];
        $status=$_POST['mem_status'];
        $plan=$_POST['planName'];
        $Shift=$_POST['Shift'];
        $jdate=$_POST['join_Date'];
        $edate=$_POST['exp_Date'];

         ///==query to get planid using plan name
        $to_plan_id = mysqli_query($conn,"select gmp_id from gym_plan where planName = '$plan' ");
        if($rows=mysqli_fetch_array($to_plan_id)){
            $planid=$rows['gmp_id'];
        }

        ///==query to get schedule id using shift name
        $to_shift_id = mysqli_query($conn,"SELECT ID FROM `schedule` where SHIFT = '$shift' ");
        if($rows2=mysqli_fetch_array($to_shift_id)){
            $scheduleid = $rows2['ID'];
        }

         
        $query=mysqli_query($conn,"update members set 
         first_name= '$fname', last_name = '$lname', 
         phone='$phone',mem_address= '$address',gender= '$gender', 
         mem_status = '$status', id ='$scheduleid ',  
         planid= '$planid', join_Date = '$jdate',
         exp_Date= '$edate',userid= '$userid' 
         where mbr_id = '$id'");

    }

    function getID($query){
        $get_id = mysqli_query($conn,$query);
        if($rows=mysqli_fetch_array($get_id)){
            $id=$rows['id'];
        }
        return $id;
    }
?>
