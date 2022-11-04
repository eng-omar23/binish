<?php
    require'db.php';
    include("home.php");

        //Declaration For Members
        $allMembers = "";
        $activeMembers = "";
        $inactiveMembers = "";
        
        //Declaration For Fees
        $allFees = "";
        $paidFees = "";
        $dueFees = "";
        
        //Declaration For Sales
        $allSales = "";
        $paidSales = "";
        $dueSales = "";
        
        //Declaration For Payrolls
        $allPayroll = "";
        $paidPayroll = "";
        $duePayroll = "";
        
        //Declaration For Expenses
        $allExpenses = "";
        $paidExpenses = "";
        $dueExpenses = "";
        
        //Declaration For Expenses
        $allItems = "";
        $allcost = "";
?>
<?php
        
       // **********%*%*%*%*%*%*%*%*%*%*%*Logic for Fees
        //**********************Getting Total Amount
            $query=mysqli_query($conn,"SELECT sum(amount) as Total FROM fees");
            if($rows=mysqli_fetch_assoc($query)){
                $allFees = $rows['Total'];
            }
            else{
                $allFees = "0";
            }
        //**********************Getting Paid Amount
 
        $query = mysqli_query($conn,"SELECT sum(amountPaid) as TotalPaid FROM fees;");
        if($rows=mysqli_fetch_assoc($query)){
                $paidFees = $rows['TotalPaid'];
            }
            else{
                $paidFees = "0";
            }
        //**********************Getting Due Amount
            $query = mysqli_query($conn,"SELECT sum(amountDue) as TotalDue FROM fees;");
            if($rows=mysqli_fetch_assoc($query)){
                    $dueFees  = $rows['TotalDue'];
               }
            else{
                $dueFees = "0";
            }         
    

    ?>

<?php
        
        // **********%*%*%*%*%*%*%*%*%*%*%*Logic for Members
         //**********************Getting Total members
             $query=mysqli_query($conn,"SELECT count(*) as Total FROM members;");
             if($rows=mysqli_fetch_assoc($query)){
                 $allMembers = $rows['Total'];
             }
             else{
                 $allMembers = "0";
             }
         //**********************Getting active members
  
         $query = mysqli_query($conn,"SELECT count(*) as Total FROM members  where mem_status = 'Enabled'");
         if($rows=mysqli_fetch_assoc($query)){
                 $activeMembers = $rows['Total'];
             }
             else{
                 $activeMembers = "0";
             }
         //**********************Getting inactive members
             $query = mysqli_query($conn,"SELECT count(*) as Total FROM members  where mem_status = 'Disabled'");
             if($rows=mysqli_fetch_assoc($query)){
                     $inactiveMembers  = $rows['Total'];
                }
             else{
                 $inactiveMembers = "0";
             }         
     
 
     ?>

<?php
        
            // **********%*%*%*%*%*%*%*%*%*%*%*Logic for Sales
            //**********************Getting Total Sales
             $query=mysqli_query($conn,"SELECT sum(amount) as Total FROM sales");
             if($rows=mysqli_fetch_assoc($query)){
                 $allSales = $rows['Total'];
             }
             else{
                 $allSales = "0";
             }
         //**********************Getting paid sales
  
         $query = mysqli_query($conn,"SELECT sum(amountPaid) as TotalPaid FROM sales");
         if($rows=mysqli_fetch_assoc($query)){
                 $paidSales = $rows['TotalPaid'];
             }
             else{
                 $paidSales = "0";
             }
         //**********************Getting Sales Due
             $query = mysqli_query($conn,"SELECT sum(amonutDue) as TotalDue FROM sales");
             if($rows=mysqli_fetch_assoc($query)){
                     $dueSales  = $rows['TotalDue'];
                }
             else{
                 $dueSales = "0";
             }         
     
 
     ?>


<?php
    //**********%*%*%*%*%*%*%*%*%*%*%*Logic for Payroll
    //**********************Getting Total Amount
    $query=mysqli_query($conn,"select count(*) as Totalemployee from employee;");
    if($rows=mysqli_fetch_assoc($query)){
    
            $allPayroll = $rows['Totalemployee'];
        
    }
    else{
        $allPayroll = "0";
    }
    //**********************Getting Paid Amount
    $query=mysqli_query($conn,"SELECT sum(amount) as Paid FROM employee_payroll;");
    if($rows=mysqli_fetch_assoc($query)){
    
            $paidPayroll =  $rows['Paid'];
        
    }
    else{
        $paidPayroll = "0";
    }

?>
<?php
    //**********%*%*%*%*%*%*%*%*%*%*%*Logic for Items
    //**********************Getting Total Items
    $query=mysqli_query($conn,"select count(*) as totalItems from items");
    if($rows=mysqli_fetch_assoc($query)){
    
            $allItems = $rows['totalItems'];
        
    }
    else{
        $allItems = "0";
    }
    //**********************Getting Item cost
    $query=mysqli_query($conn,"SELECT sum(cost) as Paid FROM items");
    if($rows=mysqli_fetch_assoc($query)){
    
            $allcost =  $rows['Paid'];
        
    }
    else{
        $allcost = "0";
    }
    //**********************Getting Total Amount
    $query=mysqli_query($conn,"SELECT sum(amount) as Total FROM expenses;");
    if($rows=mysqli_fetch_assoc($query)){
            $allExpenses =$rows['Total'];
    }
    else{
        $allExpenses = "0";
    }
?>
<style>
    .parent {
        display: grid;
        height: 100%;
        margin: 2%;
        grid-column-gap: 2%;
        grid-row-gap: 3%;
        grid-template-areas:
            'topLeft topMiddle topRight'
            'centerLeft centerMiddle centerRight';
    }
    .customize{
        background-color: #3d3a3a;
        color: #eee;
        border-radius: 5%;
        padding: 3%;
    }
    .topLeft{
        grid-area: topLeft;
        padding: 3%;
    }
    .topRight{
        grid-area: topRight;
    }
    .topMiddle{
        grid-area: topMiddle;
    }

    .centerLeft{
        grid-area: centerLeft;
    }
    .centerMiddle{
        grid-area: centerMiddle;
    }
    .centerRight{
        grid-area: centerRight;
    }
    .readmore a{
        font-size: 20px;
        font-family: sans-serif;
        color: #f48282;
    }
</style>

<center>
    <div class="parent">
        
        <div class="topLeft customize" >
            <center>
            <div class="icon"><i class="fa-solid fa-people-line"></i></div>
            <h4>Members Info</h4>
            <hr>
            <br>
            Total members &Gg; <?php echo $allMembers; ?> <br><br><br>
            Active Members &Gg; <?php echo $activeMembers; ?> <br><br><br>
            Inactive members &Gg; <?php echo $inactiveMembers; ?> <br><br>
            <div class="readmore"><a href="mview.php">Read More &Rightarrow; </a></div>
            </center>

        </div>
        <div class="topMiddle customize">
            <center>
            <div class="icon"><i class="fa-solid fa-people-line"></i></div>
            <h4>Fees Info</h4>
            <hr><br>
            Total Fess &Gg; <?php echo $allFees; ?> <br><br><br>
            Amount Paid &Gg; <?php echo  $paidFees; ?> <br><br><br>
            Amount Due &Gg; <?php  echo $dueFees; ?><br><br>
            <div class="readmore"><a href="fview.php">Read More &Rightarrow; </a></div>
            </center>
        </div>
        <div class="topRight customize">
            <center> 
            <div class="icon"><i class="fa-solid fa-people-line"></i></div>
            <h4>Sales Info</h4>
            <hr><br>
            Total Sales &Gg; <?php echo $allSales; ?> <br><br><br>
            Amount Paid &Gg; <?php echo $paidSales; ?> <br><br><br>
            Amount Due &Gg; <?php echo $dueSales; ?><br><br>
            <div class="readmore"><a href="sales_view.php">Read More &Rightarrow; </a></div>
            </center>
        </div>
        <div class="centerLeft customize">
            <center>      
            <div class="icon"><i class="fa-solid fa-people-line"></i></div>
            <h4>Payroll Info</h4>
            <hr><br><br>
            Total Employees &Gg; <?php echo $allPayroll; ?> <br><br><br>
            Amount Paid &Gg; <?php echo $paidPayroll; ?> <br><br><br>
        <!-- Amount Due &Gg; <%= duePayroll %> -->
        <div class="readmore"><a href="payroll_view.php">Read More &Rightarrow; </a></div>
            </center>
        </div>
        <div class="centerMiddle customize">
            <center>
            <div class="icon"><i class="fa-solid fa-people-line"></i></div>
            <h4>Items Info</h4>
            <hr><br><br>
            Total Items &Gg; <?php echo  $allItems; ?> <br><br><br>
            Total Cost &Gg; <?php  echo $allcost; ?> <br><br><br>
            <div class="readmore"><a href="item_view.php">Read More &Rightarrow; </a></div>
            </center>
        </div>
        <div class="centerRight customize">
            <center>
                
            <div class="icon"><i class="fa-solid fa-people-line"></i></div>
            <h4>Expenses Info</h4>
            <hr><br>
            Total Expenses &Gg; <?php echo $allExpenses; ?> <br><br><br>
            <div class="readmore"><a href="exp_view.php">Read More &Rightarrow; </a></div>
            </center>
        </div>
    </div>
</center>
        
