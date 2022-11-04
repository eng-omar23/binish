<?php
require 'db.php';
$SNO=1;
if(isset($_POST['displaysend'])){
  ?>

<table class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">#SNO</th>
        <th scope="col">shift</th>
       <th scope="col">Start</th>
        <th scope="col">End</th>    
        <th scope="col">Date</th>
       
            <th scope="col">Operation</th>
      </tr>
    </thead>
    <?php

    $query=mysqli_query($conn,"select * from schedule");
    while($rows=mysqli_fetch_array($query)){
  
       ?>

        <td scope="row"><?php echo $SNO ?></td>
        <td><?php echo $rows['SHIFT'];?></td>
        <td><?php echo $rows['START_TIME'];?></td>
        <td><?php echo $rows['END_TIME'];?></td>
        <td><?php echo $rows['DATE'];?></td>
       
       <td>
<button class="btn btn-dark" onclick="GetDetails('<?php echo $rows['ID'];?>')"><i class="fas fa-edit"></i></button>
<button class="btn btn-danger" onclick="deleteschedule('<?php echo $rows['ID'];?>')"><i class="fas fa-trash"></i></button>
</td>
      </tr>
      <?php
      $SNO++;

    }
}


///============================================insert
    if(isset($_POST['save'])){

        $id=mysqli_insert_id($conn);
        $shift=$_POST['shift'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        $date=$_POST['date'];
    $query=mysqli_query($conn,"insert into schedule values('$id',
    '$shift','$start','$end','$date')");
    }





///============================================delete
    if(isset($_POST['deleteid'])){
        
        $id =$_POST['deleteid'];

        $q=mysqli_query($conn,"delete from schedule where ID='$id'");
    }

//==============================================update
    if(isset($_POST['updateid'])){

        $id=$_POST['updateid'];
        $resp=array();
        $q=mysqli_query($conn,"select * from schedule where ID='$id'");
    if($rows=mysqli_fetch_array($q)){
        $resp=$rows;
    }
    echo json_encode($resp);
    }
    if(isset($_POST['hiddendata'])){

        $shift=$_POST['shift'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        $date=$_POST['date'];
        $id=$_POST['hiddendata'];
        $q=mysqli_query($conn,"update schedule set SHIFT='$shift',
        START_TIME='$start',END_TIME='$end',DATE='$date' where ID='$id'");
    }


?>
