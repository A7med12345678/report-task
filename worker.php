<?php
include("connect.php");
?>
<html>
<title>تسحيل دخول موظف</title>
<style>
  .custom-file-upload {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background-color: #d9534f;
    color: #fff;
    border-radius: 4px;
  }

  input[type="file"] {
    display: none;
  }
</style>

<body>
  <div class="container">

    <div class="m-5">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
          <label for="text">UserName :</label>
          <input type="text" class="form-control" placeholder="" name="user" required>
        </div>
        <div class="form-group">
          <label for="passwork">password :</label>
          <input type="password" class="form-control" placeholder="" name="pass" required>
        </div>
        <button type="submit" class="btn btn-primary">نسجيل دخول</button>
      </form>
    </div>
    <div class='text-center mx-auto'><a class='btn btn-success mt-2' href='http://localhost/Report/index.php'> رجوع</a></div>
 
    
<div class='m-5'>
<hr>
<?php
if (isset($_REQUEST['user']) && isset($_REQUEST['user'])) {
  $user = $_REQUEST['user'];
  $pass = $_REQUEST['pass'];
  $sql_2 = "SELECT e_user,e_pass from worker where e_user='$user' and e_pass='$pass'";
  $params = array(1, "some data");
  $stmt_2 = sqlsrv_query($conn, $sql_2, $params);
  $row_2 = sqlsrv_fetch_array($stmt_2, SQLSRV_FETCH_ASSOC);
  if ($user == $row_2['e_user'] && $pass == $row_2['e_pass']) {

    // echo "<meta http-equiv='refresh' content='0;url=./connect.php'>";
    $sql_get_name = "SELECT e_name from worker where e_user='$user'";
    $stmt_get_name = sqlsrv_query($conn, $sql_get_name, $params);
    $row_get_name = sqlsrv_fetch_array($stmt_get_name, SQLSRV_FETCH_ASSOC);
    $name = $row_get_name['e_name'];
    // echo $name;
    // Get the current page URL
    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // echo $currentUrl;
    $sql_show1 = "SELECT r_content,r_done,submit_time from report where worker1_sta ='$name'";
    $stmt_show1 = sqlsrv_query($conn, $sql_show1, $params);
    echo "
        <div class='p-3 font-weight-bold h5 text-right mt-2 text-right'>
        : لديك وظيفة إنشاء التقارير الآتية
        </div>
        "
    ;
    while ($row_show1 = sqlsrv_fetch_array($stmt_show1, SQLSRV_FETCH_ASSOC)) {

      if ($row_show1['r_done'] === "review" || $row_show1['r_done'] === "done") {
      } else if (is_dir('./reports-content/' . $row_show1['r_content'])) {
        // echo $row_show1['r_content']."    ";
        echo "
            <div class='p-3 bg-primary font-weight-bold h5 text-center mt-2 text-right' style='color:White;'>
            $row_show1[r_content]
            </div>
            ";
        echo "
            <div>
            <form method='POST' enctype='multipart/form-data'>
            <input type='file' accept='.doc,.docx,.pdf' id='file-upload' class='btn btn-danger' name='fileToUpload'>
            <label for='file-upload' class='custom-file-upload'>اختيار ملف</label>
            <input type='submit' value='تسليم' name='submit'>

            </form>
            </div>";
        if (isset($_FILES["fileToUpload"])) {

          $target_dir = "C:\\xampp\\htdocs\\Report\\reports-content\\$row_show1[r_content]\\creation\\";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // full path of uploaded file
          // echo $target_file . "<br>";
          // echo $_FILES['fileToUpload']['name'];
          // echo "Error uploading file: ".$_FILES['fileToUpload']['error'];

          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<div class='font-weight-bold text-center'> تم رفع الملف بنجاح </div>";
            $sql_del = "UPDATE report SET r_done = 'review' WHERE r_content = '$row_show1[r_content]'";
            $stmt_del = sqlsrv_query($conn, $sql_del, $params);
            // Redirect to the same page
            header("Location: $currentUrl");
            exit;
          } else {
            echo ".حدث خطأ ما, يرجى رفع الملف الصحيح أو المحاولة لاحقًا";
          }
        }

      }
    }




    $sql_show2 = "SELECT r_content,submit_time,r_done from report where worker2_sta ='$name'";
    $stmt_show2 = sqlsrv_query($conn, $sql_show2, $params);
    echo "
        <div class='p-3 font-weight-bold h5 text-right mt-2 text-right'>
        : لديك وظيفة مراجعة التقارير الآتية
        </div>
        "
    ;
    while ($row_show2 = sqlsrv_fetch_array($stmt_show2, SQLSRV_FETCH_ASSOC)) {
      if ($row_show2['r_done'] === "done") {
      } else if (is_dir('./reports-content/' . $row_show2['r_content'])) {

        // echo $row_show1['r_content']."    ";
        echo "
            <div class='p-3 bg-primary font-weight-bold h5 text-center mt-2 text-right' id='worker2' style='color:White;'>
            $row_show2[r_content]
            </div>
            ";
        echo "
            <div>
            <form method='POST' enctype='multipart/form-data'>
            <input type='file' accept='.doc,.docx,.pdf' id='file-upload' class='btn btn-danger' name='fileToUpload'>
            <label for='file-upload' class='custom-file-upload'>اختيار ملف</label>
            <input type='submit' value='تسليم' name='submit'>

            </form>
            </div>";

        if (isset($_FILES["fileToUpload"])) {

          $target_dir = "C:\\xampp\\htdocs\\Report\\reports-content\\$row_show2[r_content]\\review\\";
          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // full path of uploaded file
          // echo $target_file . "<br>";
          // echo $_FILES['fileToUpload']['name'];
          // echo "Error uploading file: ".$_FILES['fileToUpload']['error'];

          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<div class='font-weight-bold text-center'> تم رفع الملف بنجاح </div>";
            // $sql_del = "UPDATE report SET r_done = 'done' WHERE r_content = '$row_show2[r_content]'";
            $sql_del = "UPDATE report SET r_done = 'done' WHERE r_content = '$row_show2[r_content]'";
            $stmt_del = sqlsrv_query($conn, $sql_del, $params);
            header("Location: $currentUrl");
            exit;
          } else {
            echo ".حدث خطأ ما, يرجى رفع الملف الصحيح أو المحاولة لاحقًا";
          }
        }

      }
    }
  }


}
?>
</div>
</div>


</body>


</html>