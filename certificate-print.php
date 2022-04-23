<?php 
include('include/dbconfig.php');

$regNo = htmlspecialchars($_GET['id'], ENT_QUOTES);
$sql   = "SELECT `pursuing_course`.*,`student_info`.*, `marks`.`course_info`, `franchises`.`franchise_name`,`franchises`.`address` FROM `pursuing_course`
        LEFT JOIN `student_info` ON `student_info`.`slno` = `pursuing_course`.`student_id`
        LEFT JOIN `marks` ON `marks`.`admission_id` = `pursuing_course`.`pusuing_id`
        LEFT JOIN `franchises` ON `franchises`.`id` = `pursuing_course`.`franchise_id`
        WHERE `pursuing_course`.`regno` ='{$regNo}' LIMIT 1" ;
$ress  = mysqli_query($conn, $sql) ;
if(mysqli_num_rows($ress) > 0){
    $data = mysqli_fetch_array($ress);
    $course = json_decode($data['course_info'], true);
}else{
    echo '<h2 align="center">No Records Found</h2>';
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Certificate Print</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet">
<!-- google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
  <style>
    body, html {
    height: 100%;
    width:100%;
    margin: 0;
    }
    .certificate-bg {
    background-image: url("images/certificate.jpg");
    height: 655px; 
    width:500px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
    margin:auto;
    overflow:auto;
    }
    .content{
    width:420px;
    margin:auto;
    padding-top:48px;
    }
    h6{
        font-size: 11px;
    }
    .reg-no{
        margin-left: 70px;
        font-size: 10px;
    }
    .name{
        margin-top:231px;
        font-weight: 700;
        font-size: 12px;
    }
    .father-name{
        margin-top: 10px;
        /*margin-left: 99px;*/
        font-weight: 700;
        font-size: 12px;
    }
    .from-div{
        margin-top: 9px;
    }
    .from{
        font-weight: 700;
    }
    .div1{
        width: 67px; 
        float: right;
    }
    .div2{
        min-width: 55px; 
        max-width: 55px; 
        float: right;
    }
    .div3{
        width: 218px; 
        float: right;
    }
    .ins-name{
        padding-left: 8px;
    }
    .pic-div-container{
        width:377px; 
        margin:auto; 
        margin-top: 20px;
    }
    .pic-div-2{
        width: 79px; 
        height: 80px; 
        float: right;
    }
    .pic-div-1{
        width: 77px; 
        height: 80px;
    }
    .pic-2{
        width: 79px; 
        height: 80px;
    }
    .pic-1{
        width: 77px; 
        height: 80px;
    }
    .issue-date{
        font-size: 11px; 
        font-weight: 500; 
        padding-left: 5px;
    }
    .chairman{
        font-size: 11px; 
        font-weight: 500;
    }

@media print{
    html, body {
        height: 99%;    
    }
    .certificate-bg {
    background-image: url("images/certificate.jpg");
    height: 100%; 
    width:100%;
    margin-top:10px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    overflow: visible;
    }
    .content{
        width:91%;
        margin:auto;
        padding-top:75px;
    }
    h6{
        font-size: 18px;
    }
    .reg-no{
        margin-left: 110px;
        font-size: 15px;
    }
    .name{
        padding-left: 10px;
        margin-top: 362px;
        font-size: 19px;
    }
    .father-name{
        margin-top: 12px;
        font-size: 19px;
    }
    .from-div{
        margin-top: 15px;
        margin-bottom: 6px;
    }
    .div1{
        width: 101px; 
        float: right;
    }
    .div2{
        min-width: 88px;
        max-width: 88px; 
        float: right;
    }
    .div3{
        width: 342px; 
        float: right;
    }
    .ins-div{
        margin-top: 42px;
    }
    .ins-name{
        padding-left: 19px;
    }
    .grade-div{
        margin-top: 6px;
    }
    .at{
        padding-left: 5px;
    }
    .pic-div-container{
        width:589px; 
        margin:auto; 
        margin-top: 33px;
    }
    .pic-div-2{
        width: 119px; 
        height: 123px; 
        float: right;
    }
    .pic-div-1{
        width: 118px; 
        height: 123px;
    }
    .pic-2{
        width: 119px; 
        height: 123px;
    }
    .pic-1{
        width: 118px; 
        height: 123px;
    }
    .bottom-div{
        margin-top: 45px;
    }
    .issue-date{
        font-size: 15px; 
        font-weight: 500; 
        padding-left: 15px;
    }
    .chairman{
        font-size: 15px; 
        font-weight: 500;
    }
}
</style>
</head>
<body>
<div class="certificate-bg">         
        <div class="content">
			<h6 class="reg-no"><?php echo $data[7];?></h6>
            <h6 class="name" align="center">SUVENDU SEKHAR JANA<?php //echo $data['St_Name'];?></h6>
            <h6 class="father-name" align="center">SUVENDU SEKHAR JANA<?php //echo $data['Fathers_Name'];?></h6>
            <div class="container-fluid from-div">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5" align="center">
                        <h6 class="from">JAN 2021<?php //echo $data['starting_month'].'-'.$data['starting_year']; ?></h6>
                    </div>
                    <div class="col-4" align="center">
                        <h6 class="from">DEC 2021<?php //echo $data['complete_month'].'-'.$data['complete_year']; ?></h6>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
            <div class="div1"><h6 align="center"><?php echo $course['duration']; ?></h6></div>
            <div class="div2">&nbsp;</div>
            <div class="div3"><h6><?php echo $course['course_name']; ?></h6></div>
            <div class="container-fluid ins-div" style="clear: both;">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-9">
                        <h6 class="ins-name">JYBCE JATIYA YUVA COMPUTER TRAINING CENTRE <?php //echo $data['franchise_name']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="container-fluid grade-div">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-2">
                        <h6>A+</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="at"><?php echo $data['address']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="pic-div-container">
                <div class="pic-div-2">
                    <img src="images/ms.png" class="pic-2">
                </div>
                <div class="pic-div-1">
                    <img src="images/ms.png" class="pic-1">
                </div>
            </div>
            <div class="container bottom-div">
                <div class="clearfix mt-4">
                  <p class="float-start issue-date">19-04-2022</p>
                  <p class="float-end chairman">Sri Biman Ghosh</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>