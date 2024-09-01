<?php 
    session_start();
    include 'includes/dbconnection.php';
    if (strlen($_SESSION['aid'] == 0))
    {
        header('location:logout.php');
    }else{
        if(isset($_GET['del']))
        {
            $courseid = $_GET['del'];
            $query = mysqli_query($con, "DELETE from tbl_course where cid = '$courseid'");
            echo '<script>alert("Course deleted")</script>';
            echo '<script>window.location.href=manage-course.php</script>';
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
         <?php include('leftbar.php') ?>;
         <nav>
         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header"><?php echo strtoupper("Welcome"." ".htmlentities($_SESSION['login']));?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Courses
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Short Name</th>
                                            <th>Full Name</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = mysqli_query($con, "SELECT * FROM tbl_course");
                                            $sn = 1;
                                                while($res = mysqli_fetch_array($query)){?>
                                                <tr class="odd gradex">
                                                    <td><?php echo $sn ?></td>
                                                    <td><?php echo htmlentities(strtoupper($res['cshort'])); ?></td>
                                                    <td><?php echo htmlentities(strtoupper($res['cfull'])); ?></td>
                                                    <td><?php echo htmlentities($res['cdate']); ?></td>
                                                    <td>
                                                        &nbsp;&nbsp;<a href="edit-course.php?cid=<?php echo htmlentities($res['cid']); ?>" class="btn btn-primary">Edit</a>
                                                        &nbsp; <a href="manage-course.php?del=<?php echo htmlentities($res['cid']); ?>" class="btn btn-danger" onclick="return confirm('Do you really wan to delete')">Delete</a>
                                                    </td>
                                                </tr> 
                                                 
                                       <?php $sn++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>
<?php } ?>