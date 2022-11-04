<?php
require 'db.php';
$SNO=1;
if(isset($_POST['displaysend'])){
  ?>

<table class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">#SNO</th>
       <th scope="col">ID</th>
        <th scope="col">Name</th>    
       
            <th scope="col">Operation</th>
      </tr>
    </thead>
    <?php

    $query=mysqli_query($conn,"select * from initial_items;");
    while($rows=mysqli_fetch_array($query)){
  
       ?>

        <td scope="row"><?php echo $SNO ?></td>
        <td><?php echo $rows['id'];?></td>
        <td><?php echo $rows['Name'];?></td>
       
       <td>
<button class="btn btn-dark" onclick="GetDetails('<?php echo $rows['id'];?>')"><i class="fas fa-edit"></i></button>
<button class="btn btn-danger" onclick="deleteProduct('<?php echo $rows['id'];?>')"><i class="fas fa-trash"></i></button>
</td>
      </tr>
      <?php
      $SNO++;

    }
}


///==================================insert
    extract($_POST);
    if(isset($_POST['nameSend'])){
        $name=$_POST['nameSend'];
        $id=mysqli_insert_id($conn);
        $query=mysqli_query($conn,"insert into initial_items (ID,Name)
        values('$id','$nameSend')");
    }


///========================================delete
    if(isset($_POST['deleteid'])){
        $id =$_POST['deleteid'];
        $q=mysqli_query($conn,"delete from initial_items where id='$id'");
    }

///=========================================================update

    if(isset($_POST['updateid'])){
        $pid=$_POST['updateid'];
        $q=mysqli_query($conn,"select * from initial_items where id='$pid'");
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
        $id=$_POST['hiddendata'];
        $name=$_POST['updatename'];
        $q=mysqli_query($conn,"update initial_items set Name='$name'
        where id='$id'");
    }


?>
