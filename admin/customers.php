<?php include_once "../assets/config.php";
session_start();
if(!isset($_SESSION['admin'])):
  echo"<script>window.open('admin_login.php','_self')</script>";
endif;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>foodstuff | online Dairy products available Here</title>
    <link rel="stylesheet" href="..\bootstrap\bootstrap.min.css">
    <link rel = "icon" href = "..\image\ico.gif" type = "image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/v4-shims.css">

  </head>

  <body>
  <?php include"include/header.php"?>


  <div class="container-fluid mt-3">
    <div class="row">
      <div class="col-lg-3">
        <?php include"include/side.php"?>
      </div>

      <div class="col-lg-9">
        <div class="row">
                <div class="col-8">
                    <blockquote class="blockquote"><h2 class="font-weight-bold h5 my-4">Manage Customers </h2></blockquote>
</div>
          <div class="col-4">

            <form action="customers.php"  method="get" class="form-inline mt-3">
                <input type="search" placeholder="Search Employee" class="form-control" name="c_search" value="<?php if(isset($_GET['c_search'])){echo $_GET['c_search'];}?>">
                  <?php
                  if(isset($_GET['c_search'])): ?>
                    <a href="customers.php" class="btn btn-danger">X</a>

                  <?php else: ?>
                  <input type="submit" value="Go" name="find" class="btn btn-success">
                  <?php endif;?>


            </form>


</div>
          </div>
        <table class="table table-bordered">
          <tr>
            <th>Serial no.</th>
            <th>Name</th>
            <th>Action</th>

          </tr>

          <?php

              if(isset($_GET['find'])):
                $search=$_GET['c_search'];
                $calling = mysql_query("SELECT * from customer where c_f_name like '%$search%' or c_l_name like '%$search%' or c_code= '$search' or c_email like '%$search%'");
                $count=mysql_num_rows($calling);
                        if($count==0):
                          echo"<h1>No Customer of this name</h1>";

                        endif;
            else:
              $calling=mysql_query("SELECT * from customer ");
            endif;

              $count=mysql_num_rows($calling);
            if($count>0):
              $c=0;
              while($row=mysql_fetch_array($calling)):
                $c++;

                  $q=mysql_query("SELECT * FROM orders where c_id='".$row['c_id']."'");
                  $n=0;
                  while($check=mysql_fetch_array($q)){
                    $n++;
                  }



              ?>
              <tr>

                <td><?=$c?></td>
                <td><?=$row['c_f_name'];?>&nbsp;<?=$row['c_L_name'];?></td>
                <td>



                  <a type="button"  href="#viewCust<?= $row['c_id'];?>" class="btn btn-success" data-toggle="modal"><i class="fas fa-eye" name="view"></i></a>



                  <!--  View Modal -->


                  <div class="modal fade" id="viewCust<?= $row['c_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <strong >CUSTOMERS</strong>
                            <strong >Total Orders <span style="color:blue"><?= $n?></span></strong>

                        </div>
                        <div class="modal-body">
                          <table class="table table-bordered mt-5">
                                <tr>
                                  <th> Customer Id No.</th>
                                  <td><?= $row['c_code']?></td>

                                </tr>
                                <tr>
                                  <th> name</th>
                                  <td><?= $row['c_f_name'];?> <?= $row['c_L_name'];?></td>

                                </tr>
                                <tr>
                                  <th> age</th>
                                  <td><?= $row['c_age'];?></td>

                                </tr>
                                  <tr>
                                    <th>Image</th>
                                    <td> <img src="../image/<?= $row['c_img'];?>" alt="" height="70px" width="70px"></td>
                                  </tr>
                                <tr>
                                  <th> Phone No.</th>
                                  <td><?= $row['c_phn'];?></td>

                                </tr>

                                <tr>
                                  <th> email</th>
                                  <td><?= $row['c_email'];?></td>

                                </tr>

                                <tr>
                                  <th> Address</th>
                                  <td><?= $row['c_add'];?></td>

                                </tr>

                                <tr>
                                  <th> City</th>
                                  <td><?= $row['c_city'];?></td>

                                </tr>

                                <tr>
                                  <th> State</th>
                                  <td><?= $row['c_state'];?></td>

                                </tr>

                                <tr>
                                  <th> Pin Code</th>
                                  <td><?= $row['c_pin'];?></td>

                                </tr>

                              <u><h5 class="text-center mt-3 mb-4 text-uppercase"><?=$row['c_f_name']?><span class="text-lowercase">'s complete details here</span></h></u>


                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                        </div>
                      </div>
                    </div>
                  </div>



                </td>
              </tr>
    <?php endwhile;
endif;?>
        </table>
      </div>
    </div>
  </div>
  </body>
</html>
