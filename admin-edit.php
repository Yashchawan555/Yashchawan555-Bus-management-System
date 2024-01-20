<?php 
     session_start(); 

     $adminprofile = $_SESSION['admin_name'];

     if ($adminprofile == true) {
          # code...
     }
     else {
          header('Location: home.php');
     }

     // Search/Filter Student
     if (isset($_POST['search_admin'])) {
          $search_for_admin = $_POST['search_for_admin'];
          $query = "SELECT * FROM `admin_data` WHERE CONCAT(`admin_name`) LIKE '%".$search_for_student."%'";
          $search_result = filterTable($query);
          
     }
     else{
          $query = "SELECT * FROM `admin_data`";
          $search_result = filterTable($query);
               
     }
          
     function filterTable($query){
          $con = mysqli_connect("localhost", "root", "", "bus_management_system");
          $filter_result = mysqli_query($con, $query);
          return $filter_result;
     }    

?>


<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

     <title>Admin-Panel</title>
</head>

<body>
     <div class="container mt-5 mb-5 p-0">
          <!-- <div class="container mb-2 p-0"> -->
          <h3 class="px-2 my-5">Welcome '<?php echo($_SESSION['admin_name']); ?>'
          <a href="admin.php" name="logout_btn" class="btn btn-danger float-end">Back</a>
          </h3>
          <!-- </div> -->
          <?php include('create_message.php'); ?>
          <div class="row p-0">
               <div class="col-md-12">
                    <div class="card p-0">
                         <div class="card-header">
                              <h4>Admin Details:
                                  <a href="admin_create_page.php" class="btn btn-primary float-end">Add Admin</a>
                              </h4>
                         </div>
                         <div class="card-body table-responsive">
                              <form action="admin-edit.php" method="POST" class="d-inline">
                                   <input type="text" required placeholder="Search/Filter Admin" class="form-check-input px-2 py-3 w-25 my-3" name="search_for_admin">
                                   <input  type="submit" name="search_admin" value="Filter" class="btn btn-primary py-1 my-3">
                                   <a href="admin-edit.php" class="btn btn-danger py-1 my-3">Back</a>
                              </form>
                              <table class="table table-bordered table-hover">
                                   <thead>
                                        <tr>
                                             <th>ID</th>
                                             <th>Admin Name</th>
                                             <th>Password</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                   <?php while($student = mysqli_fetch_array($search_result)): ?>
                                       <tr>
                                             <td><?php echo $student['id']; ?></td>
                                             <td><?php echo $student['admin_name']; ?></td>
                                             <td><?php echo $student['admin_password']; ?></td>
                                             <td>
                                                  <a href="#?id=<?php echo $student['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                  <form action="backend_code.php" method="POST">
                                                       <button  type="submit" name="delete_student" value="<?php echo $student['id']; ?>" href="" class="btn btn-danger btn-sm mt-2">Delete</button>
                                                  </form>
                                             </td>
                                        </tr>
                                   <?php  endwhile; ?>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>



     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
     </script>

     <script src="login.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     <?php
     if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
          
     ?>
     <script>
     swal({
          title: "<?php echo $_SESSION['status']; ?>",
          icon: "<?php echo $_SESSION['status_code']; ?>",
          button: "OK.",
     });
     </script>

     <?php
          unset($_SESSION['status']);
     }
     ?>



</body>

</html>