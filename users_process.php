<?php
include("db.php");
$SNO=1;
if(isset($_POST['displaysend'])){
  ?>

<table class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">#SNO</th>
        <th scope="col">Username</th>
        <th scope="col">User Password</th>
        <th scope="col">User Type</th>    
            <th scope="col">Operation</th>
      </tr>
    </thead>
    <?php

    $query=mysqli_query($conn,"select * from users");
    while($rows=mysqli_fetch_array($query)){
  
       ?>

        <td scope="row"><?php echo $SNO ?></td>
        <td><?php echo $rows['username'];?></td>
        <td><?php echo $rows['userpass']?></td>
       <td><?php echo $rows['usertye']?></td>
       <td>
<button class="btn btn-dark" onclick="GetDetails('<?php echo $rows['usr_id'];?>')"><i class="fas fa-edit"></i></button>
<button class="btn btn-danger"  onclick="deleteuser('<?php echo $rows['usr_id'];?>')"><i class="fas fa-trash"></i></button>
</td>
      </tr>
      <?php
      $SNO++;

    }
}
///======================================insert
extract($_POST);
if(isset($_POST['completename']) && isset($_POST['completepass']) 
 && isset($_POST['completetype'])){
   $query=mysqli_query($conn," insert into users (username,userpass,
   usertye)
    values('$completename','$completepass','$completetype')");
}

///======================================delete
if(isset($_POST['Sendid'])){
    
  $unique=$_POST['Sendid'];

  $q=mysqli_query($conn,"delete from users where usr_id='$unique'");
}

//============================-==========update
if(isset($_POST['updateid'])){
  $user_id=$_POST['updateid'];
  $q=mysqli_query($conn,"select * from users where usr_id='$user_id'");
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
  $pass=$_POST['updatepass'];
  $type=$_POST['updatetype'];
   $query=mysqli_query($conn,"update users set username='$name',
   userpass='$pass',usertye='$type' where usr_id='$id' ");
}
?>