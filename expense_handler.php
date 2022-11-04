<?php
  include("db.php"); 

///======================================insert
      if(isset($_POST['save'])){
        $type=$_POST['type'];
        $amount=$_POST['amount'];
        $date=$_POST['date'];
        $usr_id= 1; //$_SESSION['userid'];
        $q=mysqli_query($conn,"insert into expenses values(null,'$type','$amount','$date','$usr_id')");
      }



      ///=====================================delete
      if(isset($_POST['deleteid'])){

          $id=$_POST['deleteid'];
          $q=mysqli_query($conn,"delete from expenses where exp_id='$id'");
      }



      ///===============================================read
      if(isset($_POST['displaysend'])){
          $SNO=1;
          ?>
        <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">#SNO</th>
              <th scope="col">Expense Type</th>
                <th scope="col">Amount</th>    
                <th scope="col">Date</th>
                <th scope="col">Transacted By</th> 
              <th scope="col">Operation</th>
              </tr>
            </thead>
            <?php
        
            $query=mysqli_query($conn,"select * from expenses_view");
            while($rows=mysqli_fetch_array($query)){
              ?>
        
                <td scope="row"><?php echo $SNO ?></td>
                <td><?php echo $rows['Expense_Type'];?></td>
                <td><?php echo $rows['amount'];?></td>
                <td><?php echo $rows['ExpenseDate'];?></td>
                <td><?php echo $rows['username'];?></td>
              
              <td>
        <button class="btn btn-dark" onclick="GetDetails('<?php echo $rows['ExpenseID'];?>')"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" onclick="delExpense('<?php echo $rows['ExpenseID'];?>')"><i class="fas fa-trash"></i></button>
        </td>
              </tr>
              <?php
              $SNO++;
        
            }
        }

        ///============================================update
  if(isset($_POST['updateid'])){
    $id=$_POST['updateid'];
    $response=array();
     $q=mysqli_query($conn,"select * from expenses_view where ExpenseID='$id'");
        if($rows=mysqli_fetch_array($q))
        {
            $response=$rows;
        }
     echo json_encode($response);
    
    }
    
    else{
        $response['status']=200;
        $response['message']="no data has been found";
    }
    
    if(isset($_POST['update'])){
      $id=$_POST['id'];
      $type=$_POST['type'];
      $amount=$_POST['amount'];
      $date=$_POST['date'];
      $usr_id= 1; //$_SESSION['userid'];
      
    $query=mysqli_query($conn," update expenses set 
    expense_type='$type',
    amount='$amount',
    date='$date',
    userid='$usr_id' 
    where exp_id='$id' ");

    }
?>

