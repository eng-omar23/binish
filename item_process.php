<?php
include("db.php");
$SNO=1;
if(isset($_POST['displaysend'])){
  ?>

<table class="table table-hover">
    <thead class="table-dark">
        <th scope="col">#SNO</th>
        <th scope="col">Item Name</th>
        <th scope="col">Unit</th>
        <th scope="col">Cost</th>
        <th scope="col">Price</th>  
        <th scope="col">Register Date</th>    
        <th scope="col">Operation</th>
    </thead>
        <?php

        $query=mysqli_query($conn,"select * from items_view");
        while($rows=mysqli_fetch_array($query)){
    
        ?>
        <tr>
            <td scope="row"><?php echo $SNO ?></td>
            <td><?php echo $rows['item_name'];?></td>
            <td><?php echo $rows['unit']?></td>
            <td><?php echo $rows['cost']?></td>
            <td><?php echo $rows['price']?></td>  
            <td><?php echo $rows['date']?></td>
            <td>
                <button class="btn btn-dark" onclick="GetDetails('<?php echo $rows['itm_id'];?>')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger"  onclick="deleteproduct('<?php echo $rows['itm_id'];?>')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
      <?php
      $SNO++;

    }
}

///================================================insert
    if(isset($_POST['save'])){
        $name=$_POST['name'];
        $unit=$_POST['unit'];
        $cost=$_POST['cost'];
        $price=$_POST['price'];
        $date=$_POST['date'];
        
        $id=mysqli_insert_id($conn);
        $query=mysqli_query($conn," select id from initial_items where Name = '$name' ");
        if($data=mysqli_fetch_array($query)){
            $in_id=$data['id'];
            $q=mysqli_query($conn,"insert into items values(null,'$in_id','$unit','$cost','$price','$date')");
        }     
    }
        
///======================================delete
    if(isset($_POST['deleteid'])){
        
        $id =$_POST['deleteid'];
        $q=mysqli_query($conn,"delete from items where itm_id='$id'");
    }

///========================================================update
    if(isset($_POST['updateid'])){
        $id=$_POST['updateid'];
        $response=array();
        $q=mysqli_query($conn,"select * from items_view where itm_id='$id' order by itm_id ");
        if($data=mysqli_fetch_array($q))
        {
            $response=$data;
        }
        echo json_encode($response);
    }
    if(isset($_POST['hiddendata'])){
        $id=$_POST['hiddendata'];
        $name=$_POST['name'];
        $unit=$_POST['unit'];
        $price=$_POST['price'];
        $cost=$_POST['cost'];
        $date=$_POST['date'];
        $query=mysqli_query($conn," select id from initial_items where Name = '$name' ");
    if($data=mysqli_fetch_array($query)){
        $in_id=$data['id'];
        $q=mysqli_query($conn,"update  items set id='$in_id',unit='$unit',cost='$cost',price='$price',reg_date='$date' where itm_id='$id' ");
    }
    }

?>
