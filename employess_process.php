<?php
require 'db.php';
$SNO=1;

///========================================read
if(isset($_POST['displaysend'])){
  ?>

<table class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">#SNO</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th> 
        <th scope="col">Address </th>
       <th scope="col">Gender</th>
        <th scope="col">Hired Date</th>       
        <th scope="col">Salary</th>
        <th scope="col">Position</th>
          <th scope="col">  Operation</th>
      </tr>
    </thead>
    <?php

    $query=mysqli_query($conn,"select * from employee");
    while($rows=mysqli_fetch_array($query)){
  
       ?>

        <td scope="row"><?php echo $SNO ?></td>
        <td><?php echo $rows['first_name'];?></td>
        <td><?php echo $rows['last_name'];?></td>
        <td><?php echo $rows['email'];?></td>
        <td><?php echo $rows['phone'];?></td>
        <td><?php echo $rows['emp_address'];?></td>
        <td><?php echo $rows['gender'];?></td>
        <td><?php echo $rows['hired_Date'];?></td>
        <td><?php echo $rows['basic_salary'];?></td>
        <td><?php echo $rows['jobTitle'];?></td>
       
        <td>
                <button class="btn btn-dark" onclick="GetEmp('<?php echo $rows['emp_id'];?>')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" onclick="delEmployee('<?php echo $rows['emp_id'];?>')"><i class="fas fa-trash"></i></button>
        </td>
      </tr>
      <?php
      $SNO++;

    }
}


    //====================================================insert
    //extract($_POST);
        
    if(isset($_POST['save'])){
        $first=$_POST['first'];
        $last=$_POST['last'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $gender=$_POST['gender'];
        $date=$_POST['date'];
        $salary=$_POST['salary'];
        $tittle=$_POST['tittle'];

        $q=mysqli_query($conn, "insert into employee values(null,'$first','$last','$email','$phone','$address','$gender', '$date','$salary','$tittle')");
    }

    ///=========================================delete
    if(isset($_POST['deleteid'])){
        $id=$_POST['deleteid'];
        $q=mysqli_query($conn,"delete from employee where emp_id='$id'");
    }


    ///==================================================================update
    if(isset($_POST['updateid'])){
        $id=$_POST['updateid'];
        $res=array();
        $q=mysqli_query($conn,"select * from employee where emp_id= '$id' ");
    
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
        $first=$_POST['first'];
        $last=$_POST['last'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $gender=$_POST['gender'];
        $date=$_POST['date'];
        $salary=$_POST['salary'];
        $position=$_POST['position'];

        $q=mysqli_query($conn,"update employee set 
        first_name='$first',
        last_name='$last',
        email='$email',
        phone='$phone',
        emp_address='$address',
        gender='$gender',
        hired_date='$date',
        basic_salary='$salary',
        jobTitle='$position' 
        where emp_id='$id' ");
    }
?>
