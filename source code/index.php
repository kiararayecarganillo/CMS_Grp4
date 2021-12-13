<!DOCTYPE html>
<html lang="en">
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');?>

 <?php 
 include('connect.php');
  $sql = "select * from admin where id = '".$_SESSION["id"]."'";
        $result=$conn->query($sql);
        $row1=mysqli_fetch_array($result);

 ?>   


<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper full-calender">
<div class="page-body">
<div class="row">
<?php
$sql_manage = "select * from manage_website"; 
$result_manage = $conn->query($sql_manage);
$row_manage = mysqli_fetch_array($result_manage);
?>

<?php if($_SESSION['user'] == 'admin'){ ?>
<div class="col-xl-3 col-md-6">
<div class="card bg-c-green update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
    <?php
    $sql = "SELECT * FROM patient WHERE status='Active' and delete_status='0'";
    $qsql = mysqli_query($conn,$sql);
    echo mysqli_num_rows($qsql);
    ?>
</h4>
<h6 class="text-white m-b-0">Total Patients</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-2" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-pink update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
<?php
    $sql = "SELECT * FROM doctor WHERE status='Active' and delete_status='0'";
    $qsql = mysqli_query($conn,$sql);
    echo mysqli_num_rows($qsql);
?>
</h4>
<h6 class="text-white m-b-0">Total Nurses</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-3" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-lite-green update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
<?php
    $sql = "SELECT * FROM admin WHERE delete_status='0'";
    $qsql = mysqli_query($conn,$sql);
    echo mysqli_num_rows($qsql);
?>
</h4>
<h6 class="text-white m-b-0">Performing Admin
</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-4" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<!-- <div class="col-xl-3 col-md-6">
<div class="card bg-c-yellow update-card">
<div class="card-block">
<div class="row align-items-end"> -->

<div class="col-4 text-right">
<canvas id="update-chart-1" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>



<?php }else if($_SESSION['user'] == 'doctor'){ ?>
<div class="row col-sm-12"><h3>Welcome <?php echo 'Nurse, '.$_SESSION['fname']; ?></h3><br><br></div>
<div class="col-xl-3 col-md-6">
<div class="card bg-c-green update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="total-consultation" class="text-white">
    1
</h4>
<h6 class="text-white m-b-0">Total Consultation</h6>


</div>
<div class="col-4 text-right">
<canvas id="update-chart-2" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-pink update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
<?php
  $sql = "SELECT * FROM patient WHERE status='Active' and delete_status='0'";
  $qsql = mysqli_query($conn,$sql);
  echo mysqli_num_rows($qsql);
?>
</h4>
<h6 class="text-white m-b-0">Number of Patients</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-3" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-lite-green update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
<?php
  $sql = "SELECT * FROM appointment WHERE status='Active' AND `doctorid`=1 AND appointmentdate=' ".date("Y-m-d")."' and delete_status='0'" ;
  $qsql = mysqli_query($conn,$sql);
  echo mysqli_num_rows($qsql);
?>
</h4>
<h6 class="text-white m-b-0">Today's Consultation
</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-4" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<!-- <div class="col-xl-3 col-md-6">
<div class="card bg-c-yellow update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8"> -->
 </div>
<div class="col-4 text-right">
<canvas id="update-chart-1" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<?php }else if($_SESSION['user'] == 'patient'){ 

    $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
    $qsqlpatient = mysqli_query($conn,$sqlpatient);
    $rspatient = mysqli_fetch_array($qsqlpatient);

    $sqlpatientappointment = "SELECT * FROM appointment WHERE patientid='$_SESSION[patientid]' ";
    $qsqlpatientappointment = mysqli_query($conn,$sqlpatientappointment);
    $rspatientappointment = mysqli_fetch_array($qsqlpatientappointment);
    
?>
  <div class="row col-lg-12"><h3><b>Dashboard</b></h3></div>
  <div class="row col-lg-12">Welcome to QCU Clinic Management System<br><br></div>
  <div class="card row col-lg-12">
    <div class="card-block">
      <!-- Row start -->
      <div class="row">
        <div class="col-lg-12">
          <div class="sub-title"><h2>Welcome ,!!</h2></div>
          <!-- hea tabs -->
          <ul class="nav nav-tabs md-tabs" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Registration History</a>
                  <div class="slide"></div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Consultation</a>
                  <div class="slide"></div>
              </li>
          </ul>
          <!-- Tab panes -->

          <div class="tab-content card-block">
              <div class="tab-pane active" id="home3" role="tabpanel">
                  <p class="m-0"><b>Registration History</b>
                        <h3>You are with us from <?php echo $rspatient['admissiondate']; ?>
                            <?php echo $rspatient['admissiontime']; ?></h3></p>
              </div>
              <div class="tab-pane" id="profile3" role="tabpanel">
                  <p class="m-0">
                    <b>Consultation</b>
                      <?php
                        if(mysqli_num_rows($qsqlpatientappointment) == 0)
                        {
                            ?>
                        <h3>Consultation records not found.. </h3>
                        <?php
                        }
                        else
                        {
                            ?>
                        <h3>Last Consultation taken on - <?php echo $rspatientappointment['appointmentdate']; ?>
                            <?php echo $rspatientappointment['appointmenttime']; ?> </h3>
                        <?php
                        }
                      ?>
                  </p>
              </div>
          </div>
      </div>
      </div>
      <!-- Row end -->
  </div>
  </div>
<?php } ?>

</div>

<?php if($_SESSION['user'] == 'admin'){ ?>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Consultation</h5>

            </div>
            <div class="card-block">
                <div class="ct-chart1 ct-perfect-fourth"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Patient</h5>
            </div>
            <div class="card-block">
                <div class="ct-chart1-patient ct-perfect-fourth"></div>
            </div>
        </div>
    </div>
  </div>


  <div class="card">
  <div class="card-header">
        <h2>Consultations</h2>
  <!-- <h5>DOM/Jquery</h5>
  <span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span> -->
  </div>

  </div>
<?php } ?>
<div class="card-block">
<div class="table-responsive dt-responsive">
<table id="dom-jqry" class="table table-striped table-bordered nowrap">
<thead>
<tr>
    <th>Patient Details</th>
    <th>Date & Time Consulted</th>
    <th>Clinic Staff</th>
    <th>Consultation Information</th>
    <th>Treatment Information</th>
    <th>Remarks</th>
</tr>
</thead>
<tbody>
<?php
    
        $sql ="SELECT * FROM appointment WHERE (status='Approved' OR status='Active') and delete_status = '0'";
        if(isset($_SESSION['patientid']))
        {
          $sql  = $sql . " AND patientid='$_SESSION[patientid]'";
        }
        $qsql = mysqli_query($conn,$sql);
    

    
        while($rs = mysqli_fetch_array($qsql))
        {
          $sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
          $qsqlpat = mysqli_query($conn,$sqlpat);
          $rspat = mysqli_fetch_array($qsqlpat);


          $sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
          $qsqldept = mysqli_query($conn,$sqldept);
          $rsdept = mysqli_fetch_array($qsqldept);


          $sqlmed= "SELECT * FROM appointment WHERE medicine='$rs[medicine]'";
          $qsqlmed = mysqli_query($conn,$sqlmed);
          $rsmed = mysqli_fetch_array($qsqlmed);

          $sqlrem= "SELECT * FROM appointment WHERE remarks='$rs[remarks]'";
          $qsqlrem = mysqli_query($conn,$sqlrem);
          $rsrem = mysqli_fetch_array($qsqlrem);

          $sqldoctor= "SELECT * FROM appointment WHERE doctorid='$rs[doctorid]'";
          $qsqldoctor = mysqli_query($conn,$sqldoctor);
          $rsdoctor=mysqli_fetch_array($qsqldoctor);
         
          
    
 
          echo "<tr class='resultCount'>

          <td>&nbsp;$rspat[patientname]<br>&nbsp;$rspat[loginid]</td>     
          <td>&nbsp;" . date("d-M-Y",strtotime($rs['appointmentdate'])) . " &nbsp; " . date("H:i A",strtotime($rs['appointmenttime'])) . "</td> 
          <td>&nbsp; $rsdoctor[doctorid] </td>
          <td>&nbsp;$rs[app_reason]</td>
          <td>&nbsp;$rsmed[medicine]</td>
          <td>&nbsp;$rsrem[remarks]</td>
          
          <td>";
     
          echo "</td></tr>";
        }

        $sql ="SELECT * FROM doctor where delete_status='0'";
        $qsql = mysqli_query($conn,$sql);
        while($rs = mysqli_fetch_array($qsql))
        {
      
          $sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
          $qsqldept = mysqli_query($conn,$sqldept);
          $rsdept = mysqli_fetch_array($qsqldept);
          echo "
       
          </script>

          ";
        
        
        } 
        
        ?>

       
</tbody>
<tfoot>
</tfoot>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php include('footer.php');?>


<link rel="stylesheet" href="files/bower_components/chartist/css/chartist.css" type="text/css" media="all">
<!-- Chartlist charts -->
<script src="files/bower_components/chartist/js/chartist.js"></script>
<script src="files/assets/pages/chart/chartlist/js/chartist-plugin-threshold.js"></script>
<script type="text/javascript">
  /*Threshold plugin for Chartist start*/
  var appointment = [];
  <?php
    for ($i = 01; $i < 13; $i++) { 
    $count = 0;
    $sql ="SELECT * FROM appointment WHERE (status !='') and delete_status='0' and MONTH(appointmentdate) = '".$i."'";$qsql = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($qsql);
  ?>
        appointment.push(<?php echo $count; ?>);
  <?php } ?>
    new Chartist.Line('.ct-chart1', {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun','July','Oct','Sep','Oct','Nov','Dec'],
        series: [
            appointment
        ]
    }, {
        showArea: false,

        axisY: {
            onlyInteger: true
        },
        plugins: [
            Chartist.plugins.ctThreshold({
                threshold: 4
            })
        ]
    });

    var defaultOptions = {
        threshold: 0,
        classNames: {
            aboveThreshold: 'ct-threshold-above',
            belowThreshold: 'ct-threshold-below'
        },
        maskNames: {
            aboveThreshold: 'ct-threshold-mask-above',
            belowThreshold: 'ct-threshold-mask-below'
        }
    };

    //Second Chat
    var patient = [];
    <?php
      for ($i = 01; $i < 13; $i++) { 
      $count_patient = 0;
      $sql ="SELECT * FROM patient WHERE (status !='') and delete_status='0' and MONTH(admissiondate) = '".$i."'";
      $qsql = mysqli_query($conn,$sql);
      $count_patient = mysqli_num_rows($qsql);
    ?>
          patient.push(<?php echo $count_patient; ?>);
    <?php } ?>

    new Chartist.Line('.ct-chart1-patient', {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun','July','Oct','Sep','Oct','Nov','Dec'],
        series: [ patient
        ]
    }, {
        showArea: false,

        axisY: {
            onlyInteger: true
        },
        plugins: [
            Chartist.plugins.ctThreshold({
                threshold: 4
            })
        ]
    });

    var defaultOptions = {
        threshold: 0,
        classNames: {
            aboveThreshold: 'ct-threshold-above',
            belowThreshold: 'ct-threshold-below'
        },
        maskNames: {
            aboveThreshold: 'ct-threshold-mask-above',
            belowThreshold: 'ct-threshold-mask-below'
        }
    };


    const totalDiv = document.querySelector('.total-consultation')
    const resultCount = document.querySelectorAll('.resultCount')

    
    resultCount.forEach((index, item) => {
        item++
        totalDiv.innerHTML = item   
    })


</script>