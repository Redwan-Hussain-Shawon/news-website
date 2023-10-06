<?php include 'header.php'; 
      include 'config.php';
      $user_id = $_GET['id'];
      // Value Update
      if(isset($_POST['submit'])) {
        $f_name = mysqli_real_escape_string($conn,$_POST['f_name']);
        $l_name = mysqli_real_escape_string($conn,$_POST['l_name']);
        $user_name = mysqli_real_escape_string($conn,$_POST['username']);
        $role = mysqli_real_escape_string($conn,$_POST['role']);

        $sql1 = "SELECT * FROM users WHERE username ='{$user_name}' and user_id != '{$user_id}'";
        $result1 = mysqli_query($conn,$sql1);
          if(mysqli_fetch_assoc($result1)){
          echo "<p style='color:red;text-align:center;margin:10px 0;'>User Name already Exists</p>";
      }else{
        $sql2 = "UPDATE users SET first_name ='{$f_name}',last_name='{$l_name}',username='{$user_name}',role='{$role}' WHERE user_id='{$user_id}'" or die();
        $result2 = mysqli_query($conn,$sql2);
        header('location:users.php');
      }
          
        }


        // Value Set 
      $sql = "SELECT * FROM users WHERE user_id='{$user_id}'";
      $result = mysqli_query($conn,$sql);
      if (mysqli_num_rows($result)>0){
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                <?php while($row=mysqli_fetch_assoc($result)){ 
                ?>
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->

                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="">
                            <?php  if ($row['role']==1) {
                              echo "<option selected value='1'>Admin</option>";
                              echo "<option value='0'>normal</option>";
                            }else{
                              echo "<option selected value='0'>normal</option>";
                              echo "<option value='1'>Admin</option>";
                            }
                            ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                <?php }

              }?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
