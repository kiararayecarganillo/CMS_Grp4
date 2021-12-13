<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_POST['btn_submit']))
{

  if(isset($_GET['editid']))
  {
    $sql ="UPDATE appointment SET patientid='$_POST[patient]',departmentid='$_POST[department]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[appointmenttime]',doctorid='$_POST[doctor]',status='$_POST[status]' WHERE appointmentid='$_GET[editid]'";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Success 
                </h3>
                <p>Appointment Record Updated Successfully</p>
                <p>
                 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                 <?php echo "<script>setTimeout(\"location.href = 'appointment.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        }
        else
        {
            echo mysqli_error($conn);
        }   
    }
    else
    {
       $sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[patient]'";
       $qsql=mysqli_query($conn,$sql);

       $checkbox1=$_POST['medicine'];  
        $chk="";  
        foreach($checkbox1 as $chk1)  
        {  
            $chk .= $chk1.",";  
         
       $sql ="INSERT INTO appointment(patientid, temperature, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason, medicine, treatment, remarks) values('$_POST[patient]','$_POST[temperature]','$_POST[department]','$_POST[appointmentdate]','$_POST[appointmenttime]','$_POST[doctor]','$_POST[status]','$_POST[reason]','$chk','$_POST[treatment]','$_POST[remarks]')";
        if($qsql = mysqli_query($conn,$sql))
        {

            //include("insertbillingrecord.php"); 
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Success 
                </h3>
                <p>Appointment Record Inserted Successfully</p>
                <p>
                 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                 <?php echo "<script>setTimeout(\"location.href = 'appointment.php?patientid=$_POST[patient]';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
  }
}
if(isset($_GET['editid']))
{
    $sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
    $qsql = mysqli_query($conn,$sql);
    $rsedit = mysqli_fetch_array($qsql);
    
}

?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Consultation</h4>
<!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="dashboard.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Consultation</a>
</li>
<li class="breadcrumb-item"><a href="add_user.php">Consultation</a>
</li>
</ul>
</div>
</div>
</div>
</div>


<div class="page-body">
<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">
<!-- <h5>Basic Inputs Validation</h5>
<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span> -->
</div>
<div class="card-block">
<form id="main" method="post" action="" enctype="multipart/form-data">
    <?php
        if(isset($_GET['patid']))
        {
            $sqlpatient= "SELECT * FROM patient WHERE patientid='".$_GET['patid']."'";
            $qsqlpatient = mysqli_query($con,$sqlpatient);
            $rspatient=mysqli_fetch_array($qsqlpatient);
            echo  "$rspatient[patientname] (Patient ID - $rspatient[patientid])";
            echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
        }
    ?>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Patient</label>
        <div class="col-sm-4">
            <select class="form-control" name="patient" id="patient" required="">
                <option>-- Select One--</option>
    <?php
        $sqlpatient= "SELECT * FROM patient WHERE status='Active'";
        $qsqlpatient = mysqli_query($conn,$sqlpatient);
        while($rspatient=mysqli_fetch_array($qsqlpatient))
        {
            if($rspatient["patientid"] == $rsedit["patientid"])
            {
             echo "<option value='$rspatient[patientid]' selected>$rspatient[patientid] - $rspatient[patientname]</option>";
            }
            else
            {
                echo "<option value='$rspatient[patientid]'>$rspatient[patientid] - $rspatient[patientname]</option>";
            }

        }
    ?>
            </select>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Temperature</label>
        <div class="col-sm-4">
            <input class="form-control" name="temperature" id="temperature" placeholder="Temperature...." required=""><?php if(isset($_GET['patid']))
        { echo $rsedit['temperature']; } ?></input>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Date</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" name="appointmentdate" id="appointmentdate" placeholder="Enter firstname...." required="">
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Time</label>
        <div class="col-sm-4">
            <input type="time" class="form-control" name="appointmenttime" id="appointmenttime" placeholder="Enter lastname...." required="">
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nurse on Duty</label>
        <div class="col-sm-4">
            <select class="form-control show-tick" name="select2" id="select2">
                <option value="">Select Nurse</option>
                <?php
            $arr = array("Athena George", "Irithel Cavill", "Bastian Cruz");
            foreach($arr as $val)
            {
                if($val == $rsedit['doctor'])
                {
                    echo "<option value='$val' selected>$val</option>";
                }
                else
                {
                    echo "<option value='$val'>$val</option>";            
                }
            }
            ?>
            </select>
            <span class="messages"></span>
        </div>

        <label class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-4">
            <select name="status" id="status" class="form-control" required="">
                <option value="">-- Select One -- </option>
                <option value="Active" <?php if(isset($_GET['patid']))
        { if($rsedit["status"] == 'Active') { echo 'selected'; } } ?>>Active</option>
                <option value="Inactive" <?php if(isset($_GET['patid']))
        { if($rsedit["status"] == 'Inactive') { echo 'selected'; } } ?>>Inactive</option>
            </select>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Medicine</label>
        <div class="col-sm-4">
        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Select Medicines...
  </button>
  <div class="dropdown-menu" style="width:600px;" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">
        <div class="d-flex">
        <div class="input-group mr-3" style="margin:0;">
            <div class="input-group-prepend">
                <div class="input-group-text" style="padding:5px;padding-bottom:2px;background:#DDDDDD;border-radius:5px;">
                <input name="medicine[]" value="BetadineGargle" id= "BetadineGargle" type= "checkbox" aria-label="Checkbox for following text input">
                </div>  
            </div>
            <label class = "pl-2 py-1 border w-100 h-100 ml-2" for = "BetadineGargle">Betadine Gargle</label>
            </div>
            <div class="input-group" style="margin:0;">
            <div class="input-group-prepend">
                <div class="input-group-text" style="padding:5px;padding-bottom:2px;background:#DDDDDD;border-radius:5px;">
                <input name="medicine[]" value="Biogesic" id= "Biogesic" type= "checkbox" aria-label="Checkbox for following text input">
                </div>  
            </div>
            <label class = "pl-2 py-1 border w-100 h-100 ml-2" for = "Biogesic">Biogesic</label>
            </div>
        </div>
    </a>

    <a class="dropdown-item" href="#">
        <div class="d-flex">
        <div class="input-group mr-3" style="margin:0;">
            <div class="input-group-prepend">
                <div class="input-group-text" style="padding:5px;padding-bottom:2px;background:#DDDDDD;border-radius:5px;">
                <input name="medicine[]" value="BuscopanVenus" id= "BuscopanVenus" type= "checkbox" aria-label="Checkbox for following text input">
                </div>  
            </div>
            <label class = "pl-2 py-1 border w-100 h-100 ml-2" for = "BuscopanVenus">Buscopan Venus</label>
            </div>
        <div class="input-group" style="margin:0;">
        <div class="input-group-prepend">
                <div class="input-group-text" style="padding:5px;padding-bottom:2px;background:#DDDDDD;border-radius:5px;">
                <input name="medicine[]" value="Decolgen" id= "Decolgen" type= "checkbox" aria-label="Checkbox for following text input">
                </div>  
            </div>
            <label class = "pl-2 py-1 border w-100 h-100 ml-2" for = "Decolgen">Decolgen</label>
            </div>
        </div>
    </a>

    <a class="dropdown-item" href="#">
    <div class="d-flex">
        <div class="input-group mr-3" style="margin:0;">
            <div class="input-group-prepend">
            <div class="input-group-text" style="padding:5px;padding-bottom:2px;background:#DDDDDD;border-radius:5px;">
                <input name="medicine[]" value="Diatabs" id= "Diatabs" type= "checkbox" aria-label="Checkbox for following text input">
                </div>  
            </div>
            <label class = "pl-2 py-1 border w-100 h-100 ml-2" for = "Diatabs">Diatabs</label>
            </div>
            <div class="input-group" style="margin:0;">
            <div class="input-group-prepend">
                <div class="input-group-text" style="padding:5px;padding-bottom:2px;background:#DDDDDD;border-radius:5px;">
                <input name="medicine[]" value="Loperamide" id= "Loperamide" type= "checkbox" aria-label="Checkbox for following text input">
                </div>  
            </div>
            <label class = "pl-2 py-1 border w-100 h-100 ml-2" for = "Loperamide">Loperamide</label>
            </div>
        </div>
    </a>

    <a class="dropdown-item" href="#"> 
    <div class="d-flex">
    <div class="input-group mr-3" style="margin:0;">
            <div class="input-group-prepend">
            <div class="input-group-text" style="padding:5px;padding-bottom:2px;background:#DDDDDD;border-radius:5px;">
                <input name="medicine[]" value="Mefenamic" id= "Mefenamic" type= "checkbox" aria-label="Checkbox for following text input">
                </div>  
            </div>
            <label class = "pl-2 py-1 border w-100 h-100 ml-2" for = "Mefenamic">Mefenamic</label>
            </div>
            <div class="input-group" style="margin:0;">
            <div class="input-group-prepend">
                <div class="input-group-text" style="padding:5px;padding-bottom:2px;background:#DDDDDD;border-radius:5px;">
                <input name="medicine[]" value="ORSSolution" id= "ORSSolution" type= "checkbox" aria-label="Checkbox for following text input">
                </div>  
            </div>
            <label class = "pl-2 py-1 border w-100 h-100 ml-2" for = "ORSSolution">ORS Solution</label>
            </div>
        </div>
    </a>                       
        </div>
        </div>
            <span class="messages"></span>
        </div>
        </div>


    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Chief Complaint</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="reason" id="reason" placeholder="Reason of Consultation...." required=""><?php if(isset($_GET['patid']))
        { echo $rsedit['app_reason']; } ?></textarea>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Treatment</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="treatment" id="treatment" placeholder="Treatment Information...." required=""><?php if(isset($_GET['patid']))
        { echo $rsedit['treatment']; } ?></textarea>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Remarks</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks...." required=""><?php if(isset($_GET['patid']))
        { echo $rsedit['remarks']; } ?></textarea>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="btn_submit" class="btn btn-primary m-b-0">Submit</button>
        </div>
    </div>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php');?>