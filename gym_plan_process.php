<?php
include("db.php");
$SNO=1;
if(isset($_POST['displaysend'])){
  ?>

    <table class="table table-hover">
        <thead class="table-dark">
        
            <th scope="col">#SNO</th>
            <th scope="col">Plan Name</th>
            <th scope="col">Plan Period</th>
            <th scope="col">Price</th>
            <th scope="col">Discount</th> 
            <th scope="col">Total Amount</th>     
                <th scope="col">Operation</th>
        
        </thead>
        <?php

        $query=mysqli_query($conn,"select * from gym_plan");
        while($rows=mysqli_fetch_array($query)){
    
        ?>
        <tr>

            <td scope="row"><?php echo $SNO ?></td>
            <td><?php echo $rows['planName'];?></td>
            <td><?php echo $rows['planperiod'];?></td>
            <td><?php echo $rows['PlanPrice']?></td>
            <td><?php echo $rows['PlanDiscount']?></td>
                <td><?php echo $rows['totalAmount']?></td>
            <td>
                <button class="btn btn-dark" onclick="GetDetails('<?php echo $rows['gmp_id'];?>')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger"  onclick="deleteplan('<?php echo $rows['gmp_id'];?>')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        
        <?php
        $SNO++;

        }
        ?>
        </table>
        <?php

}


///=======================================insert
    if(isset($_POST['psave'])){

        $name=$_POST['pname'];
        $period=$_POST['pperiod'];
        $price=$_POST['pprice'];
        $discount=$_POST['pdiscount'];
        $amount=$_POST['pamount'];
        // $query=mysqli_query($conn,"select * from gym_plan where PlanName='$name'");
        // if(mysqli_num_rows($query)>0){
        // }
        // else{
            $q=mysqli_query($conn,"insert into gym_plan values(null,'$name','$period','$price','$discount','$amount') ");
       // }
    }

///==========================================delete
    if(isset($_POST['deleteid'])){
        
        $id =$_POST['deleteid'];

        $q=mysqli_query($conn,"delete from gym_plan where gmp_id='$id'");
    }

///===========================================update

    if(isset($_POST['updateid']))
    {
    $id=$_POST['updateid'];

    $q=mysqli_query($conn,"select * from gym_plan where gmp_id='$id'");
    $response=array();
    if($rows=mysqli_fetch_array($q)){
        $response=$rows;
    }
    echo json_encode($response);

    }
    else{
        $response['status']=200;
        $response['message']="no data has been found";
    }

    if(isset($_POST['hiddendata'])){
        $name=$_POST['name'];
        $p=$_POST['period'];
        $price=$_POST['price'];
        $discount=$_POST['discount'];
        $amount=$_POST['amount'];
        $id=$_POST['hiddendata'];
        
        $query=mysqli_query($conn,"update gym_plan set 
        planName='$name',planperiod='$p',PlanPrice='$price',PlanDiscount='$discount',
        totalAmount='$amount' where gmp_id='$id' ");
    }
?>
