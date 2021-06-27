<?php
session_start();
if(isset($_SESSION['login_user'])){
    $semail=$_SESSION['login_user'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aitmis";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "select * from register where email='$semail'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
         $name= $row['name']; 
         $picture= $row['user_image'];
         $resume= $row['resume'];
         $mobile=$row['c_no'];
         $email=$row['email'];
         $address=$row['address'];
         $college=$row['college/institute'];
         $pass=$row['password'];
        }
    }
    if(isset($_POST['register'])){
        $namee=$_POST['name'];
        $numberr=$_POST['number'];
        $emaill=$_POST['email'];
        $passs=$_POST['pass'];
        $addresss=$_POST['address'];
        $collegee=$_POST['college'];
        //$courses=$_POST['course'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["imageupload"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $file=$target_dir.basename( $_FILES["resume"]["name"]);
        if($imageFileType!=''){
            if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                echo '<script>alert("Only JPG, JPEG, PNG  files are allowed.")</script>';
            }
            else{
                if (move_uploaded_file($_FILES["imageupload"]["tmp_name"], $target_file)) {
                    $picture=basename( $_FILES["imageupload"]["name"],".jpg");
                    $image= $target_dir.$picture.".".$imageFileType;
                } 
                else {
                    echo '<script>alert("Sorry, there was an error uploading your file.")</script>'; 
                }
            }
            if($namee=='' || $numberr=='' || $emaill=='' || $passs=='' || $addresss=='' || $collegee==''  ){
                echo '<script>alert("Fill the whole from")</script>'; 
            }
            if($namee!='' && $numberr!='' && $emaill!='' && $passs!='' && $addresss!='' && $collegee!='' ){
                $semail=$_SESSION['login_user'];
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "aitmis";
                $conn = new mysqli($servername, $username, $password, $dbname);
                $sql = "update register set name='$namee',c_no='$numberr',password='$passs',address='$addresss',`college/institute`='$collegee',user_image='$image' where email='$semail'";
                if ($conn->query($sql)) {
                    echo '<script>alert("Updated Successfully!")</script>'; 
                    echo '<script>
                        window.location="profile.php";
                    </script>';
                } 
                else 
                {
                    echo '<script>alert("Error occured !!Please try again later!")</script>'; 
                }
            }
        }
        else
        {
            if($namee=='' || $numberr=='' || $emaill=='' || $passs=='' || $addresss=='' || $collegee==''  ){
                echo '<script>alert("Fill the whole from")</script>'; 
            }
            if($namee!='' && $numberr!='' && $emaill!='' && $passs!='' && $addresss!='' && $collegee!='' ){
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "aitmis";
                $conn = new mysqli($servername, $username, $password, $dbname);
                $sql = "update register set name='$namee',c_no='$numberr',password='$passs',address='$addresss',`college/institute`='$collegee' where email='$semail'";
                if ($conn->query($sql)) {
                    echo '<script>alert("Updated Successfully!")</script>'; 
                    echo '<script>
                            window.location="profile.php";
                        </script>';
                } 
                else 
                {
                    echo '<script>alert("Error occured !!Please try again later!")</script>'; 
                }
            }
        }
    }
    $conn->close();
}
else{
    echo '<script>
            window.location="index.php";
         </script>';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>AITMIS | Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Build whatever layout you need with our Architect framework.">
    <meta name="msapplication-tap-highlight" content="no">
   
<link href="./main.css" rel="stylesheet"></head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    
            <div class="app-header__content">
                <div class="app-header-right">
                     <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <?php
                                                 echo "<img width='52'  src='".$picture."' alt=''> "; 
                                            ?>
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="profile.php" style="text-decoration:none"><button type="button" tabindex="0" class="dropdown-item">User Account</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo $name?>
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>        
        <div class="ui-theme-settings">
            <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
            </button>
            <div class="theme-settings__inner">
                <div class="scrollbar-container">
                    <div class="theme-settings__options-wrapper">
                        <h3 class="themeoptions-heading">
                            <div>
                                Header Options
                            </div>
                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
                                Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Choose Color Scheme
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light" id="head" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light" id="head1" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark" id="head2" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark" id="head3" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark" id="head4" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light" id="head5" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark" id="head6" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light" id="head7" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light" id="head8" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light" id="head9" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light" id="head10" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light" id="head11" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light" id="head12" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light" id="head13" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light" id="head14" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light" id="head15" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark" id="head16" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark" id="head17" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark" id="head18" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark" id="head19" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark " id="head20" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark" id="head21" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark" id="head22" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light" id="head23" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark" id="head24" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light" id="head25" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light" id="head26" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light" id="head27" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark" id="head28" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light" id="head29" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light" id="head30" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light" id="head31" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light" id="head32" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light" id="head33" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light" id="head34" onclick="getcolor(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light" id="head35" onclick="getcolor(this.id)">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>Sidebar Options</div>
                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
                                Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Choose Color Scheme
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light" id="head" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light" id="head1" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark" id="head2" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark" id="head3" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark" id="head4" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light" id="head5" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark" id="head6" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light" id="head7" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light" id="head8" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light" id="head9" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light" id="head10" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light" id="head11" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light" id="head12" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light" id="head13" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light" id="head14" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light" id="head15" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark" id="head16" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark" id="head17" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark" id="head18" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark" id="head19" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark " id="head20" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark" id="head21" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark" id="head22" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light" id="head23" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark" id="head24" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light" id="head25" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light" id="head26" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light" id="head27" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark" id="head28" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light" id="head29" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light" id="head30" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light" id="head31" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light" id="head32" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light" id="head33" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light" id="head34" onclick="getcolorr(this.id)">
                                        </div>
                                        <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light" id="head35" onclick="getcolorr(this.id)">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>Main Content Options</div>
                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Page Section Tabs
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div role="group" class="mt-2 btn-group">
                                            <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line">
                                                Line
                                            </button>
                                            <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow">
                                                Shadow
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                             <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">AITMIS</li>
                                <li>
                                    <a href="dashboard.php" class="mm-active">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                        Account Dasboard
                                    </a>
                                </li>
                                <li>
                                    <a href="profile.php">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Your Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="lecture.php">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Video Lectures
                                    </a>
                                </li>
                                <li>
                                    <a href="course.php">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Courses Offered
                                    </a>
                                </li>
                                <li>
                                    <a href="logout.php">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-graph text-success">
                                        </i>
                                    </div>
                                    <div>Avalanche Dashboard
                                        <div class="page-title-subheading">Welcome to Avalanche family..
                                        </div>
                                    </div>
                                </div>
                                   </div>
                        </div>           
                         <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                            
                            <li class="nav-item">
                                <a role="tab" class="nav-link " id="tab-1" data-toggle="tab" href="#tab-content-1">
                                    <span>EDIT PROFILE</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            
                            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                                <div class="main-card mb-3 card">
                                    <div class="card-body"><h5 class="card-title">Edit profile</h5>
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input name="name" id="exampleEmail" type="text" class="form-control" value="<?php echo $name ?>">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">Mobile</label>
                                                <div class="col-sm-10">
                                                    <input name="number" id="exampleEmail"  type="text" class="form-control" value="<?php echo $mobile ?>">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input name="email" id="exampleEmail"  type="email" class="form-control" value="<?php echo $email ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="examplePassword" class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input name="pass" id="examplePassword" type="password" class="form-control" value="<?php echo $pass ?>">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="exampleText" class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-10">
                                                    <input name="address" id="examplePassword" type="text" class="form-control" value="<?php echo $address ?>">
                                                </div>
                                            </div>
                                             <div class="position-relative row form-group"><label for="exampleText" class="col-sm-2 col-form-label">College</label>
                                                <div class="col-sm-10">
                                                    <input name="college" id="examplePassword" type="text" class="form-control" value="<?php echo $college ?>">
                                                </div>
                                            </div>
                                             <div class="position-relative row form-group"><label for="exampleText" class="col-sm-2 col-form-label">Course</label>
                                                <div class="col-sm-10">
                                                    <input name="course" type="text" class="form-control" value="
                                                    <?php 
                                                        if(isset($_SESSION['login_user'])){
                                                            $semail=$_SESSION['login_user'];
                                                            $servername = "localhost";
                                                            $username = "root";
                                                            $password = "";
                                                            $dbname = "aitmis";
                                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                                            if ($conn->connect_error) {
                                                                die("Connection failed: " . $conn->connect_error);
                                                            }
                                                            $sql = "select * from register where email='$semail'";
                                                            $result = $conn->query($sql);
                                                            if ($result->num_rows > 0) {
                                                                while($row = $result->fetch_assoc()) { 
                                                                    $U_ID= $row['U_ID']; 
                                                                    $CheckSQL = "select * from user_course where U_ID='$U_ID'";
                                                                    $results = mysqli_query($conn,$CheckSQL);
                                                                    $response["course"]=array();
                                                                    if (mysqli_num_rows($results) > 0) {
                                                                        $i=0;
                                                                        while ($rows = mysqli_fetch_array($results)) {
                                                                            $sql= "select * from course where C_ID='$rows[1]'";
                                                                            $result = mysqli_query($conn,$sql);
                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                while ($rowl = mysqli_fetch_array($result)) {
                                                                                    echo $rowl[1];
                                                                                    if($i<(mysqli_num_rows($results)-2))
                                                                                        echo ",";
                                                                                }
                                                                            }
                                                                            $i++;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            $conn->close();
                                                        }
                                                        else{
                                                            header("location: index.php");
                                                        }
                                                    ?>
                                                    " readonly>
                                                </div>
                                            </div>
                                            <!--<div class="position-relative row form-group"><label for="exampleFile" class="col-sm-2 col-form-label">Resume</label>-->
                                            <!--    <div class="col-sm-10">-->
                                            <!--        <input name="resume" type="file" class="form-control-file">-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                             <div class="position-relative row form-group"><label for="exampleFile" class="col-sm-2 col-form-label">Profile Picture</label>
                                                <div class="col-sm-10">
                                                    <input name="imageupload" id="imageupload" type="file" class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-check">
                                                <div class="col-sm-10 offset-sm-2">
                                                    <button class="btn btn-secondary" name="register">Submit</button>
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
    <script type="text/javascript">
        var emp1={};
        function getcolor(d){
            emp1.color = document.getElementById(d).className;
            console.log(emp1);
        }
       $.ajax({
                url:"readcolor.php",
                method="post",
                data:emp1,
                success:function(res){
                    console.log(res);
                }
            })
        function getcolorr(d){
            var y = document.getElementById(d).className;
        }
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>
</html>
