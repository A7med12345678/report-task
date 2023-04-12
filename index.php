<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <title>الرئيسية</title>
    <!-- <link rel="shortcut icon" type="image/x-icon" href="./photo/favicon.ico"> -->
</head>

<body>
    <!-- <script src="./js/index.js"></script> -->
    <div class="container">
        <div class="row bg-primary m-5 p-4 font-weight-bold" style="color:White;">
            <div class="col-10 mx-auto text-center row">
                <div class="col-6 mx-auto" style="cursor:pointer;" href="index.php">
                    <a href="worker.php" class="text-decoration-none text-center" style="color:White;">
                        <!-- onclick="AppearAdmin()"     -->
                        Admin
                    </a>
                </div>
                <div class="col-6 mx-auto" style="cursor:pointer;" href="worker.php">
                    <a href="worker.php" class=" text-decoration-none text-center" style="color:White;">
                        Worker
                    </a>
                </div>
            </div>
        </div>

        <div id="admin" class="">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="email">Project name :</label>
                    <input type="text" class="form-control" placeholder="Enter report name" name="report" required>
                </div>
                <div class="form-group">
                    <label for="email">Verfication Code :</label>
                    <input type="text" class="form-control" placeholder="Verfication" name="Verfication" value="12345"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <?php

        if (isset($_REQUEST['report']) && isset($_REQUEST['Verfication'])) {
            if ($_REQUEST['Verfication'] == "12345") {

                $report = $_REQUEST['report'];
                // echo $report;
        
                //select minumum to worker has tasks :
                $sql = "SELECT top 2 e_done,e_name FROM worker order by e_done";
                $params = array(1, "some data");
                $stmt = sqlsrv_query($conn, $sql, $params);

                $report_num = array(); // Initialize the array variable
                $report_name = array(); // Initialize the array variable
        
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    //but previous names and tasks nm. in arraies :
                    array_push($report_num, $row['e_done']);
                    array_push($report_name, $row['e_name']);
                }
                // task assgin exact time :
                $submit_time = date("Y-m-d h:i:s");
                //temporary status for current task :
                $sql2 = "insert into report (worker1_sta, worker2_sta, r_done, submit_time, r_content) values('$report_name[0]' , '$report_name[1]', 'still work' ,'$submit_time', '$report')";
                $stmt2 = sqlsrv_query($conn, $sql2, $params);
                if ($stmt2 === false) {
                    die(print_r(sqlsrv_errors(), true)); // handle query errors
                } else {
                    $_SESSION['report'] = $report;
                    $_SESSION['report_review'] = $report . "(مراجعة)";
                    //Create report folder :
                    $reportsFolder = "./reports-content/"; // reports folder path
                    $folderPath = $reportsFolder . $report . "/"; // folder path to create the report folder
                    $creationFolder = "creation"; // subfolder name for creation
                    $reviewFolder = "review"; // subfolder name for review        
                    if (!file_exists($folderPath)) {
                        // create the report folder
                        mkdir($folderPath, 0777, true);
                        // echo "Report folder created successfully. ";
                        mkdir($folderPath . $creationFolder, 0777, true);
                        // echo "Creation folder created successfully. ";
                        mkdir($folderPath . $reviewFolder, 0777, true);
                        // echo "Review folder created successfully. ";
                    }
                    // Inform Admin that review task is asssigned :
                    echo "<div class='p-3 bg-primary font-weight-bold h5 text-center mt-5' id='echo' style='color:White;'>$report_name[0] : تم إسناد إنشاء التقرير إلى";
                    echo "<div class='p-3 bg-primary font-weight-bold h5 text-center' id='echo' style='color:White;'>$report_name[1] : تم إسناد مراجعة التقرير إلى";
                    // update done tasks for each worker : 
                    $sql3 = "UPDATE worker SET e_done = e_done + 1 where e_name = '$report_name[0]' OR e_name = '$report_name[1]'";
                    $stmt3 = sqlsrv_query($conn, $sql3, $params);
                    if ($stmt3 === false) {
                        die(print_r(sqlsrv_errors(), true)); // handle query errors
                    } else {
                        echo "<br>";
                        echo "<a class='btn btn-success mt-5' href='http://localhost/Report/index.php'> تقرير آخر</a>";
                    }
                }
                // print_r($report_num); // Print the array for testing
                // print_r($report_name); // Print the array for testing
            }else{
                echo"<div class='text-center font-weight-bold text-danger'> رجاء إدخال كود تأكيد صحيح </div>";
            }
        }
        ?>
    </div>
</body>
</html>