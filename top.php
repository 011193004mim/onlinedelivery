<?php 
ob_start();
   require('connection.inc.php');
   require('function.inc.php');
   require('add_to_cart.inc.php');
  $cat_res=mysqli_query($con,"SELECT * FROM admin_categorie  WHERE status=1 ");
  $cat_arr=array();
  while($row=mysqli_fetch_assoc($cat_res)){
$cat_arr[]=$row;
  }

  $obj=new add_to_cart();
$totalProduct=$obj->totalProduct();
 ?>


<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FoodStory</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
  
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <header id="htc__header" class="htc__header__area header--one">
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5"> 
                                <div class="logo">
                                     <a href="index.php"><img src="images/FoodStory.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-7 col-sm-5 col-xs-4">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <?php
                                        foreach($cat_arr as $list){
                                            ?>
                                            <li class="drop"><a href="index_categories.php?ID=<?php echo $list['ID']?>"><?php echo $list['categories']?></a>
                                            <?php
                                            $cat_id=$list['ID'];
                                            $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
                                            if(mysqli_num_rows($sub_cat_res)>0){
                                            ?>
                                            
                                               <ul class="dropdown">
                                                    <?php
                                                    while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
                                                        echo '<li><a href="index_categories.php?ID='.$list['ID'].'&sub_categories='.$sub_cat_rows['ID'].'">'.$sub_cat_rows['sub_categories'].'</a></li>
                                                    ';
                                                    }
                                                    ?>
                                                </ul>
                                                <?php } ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <?php
                                            foreach($cat_arr as $list){
                                                ?>
                                                <li class="drop"><a href="index_categories.php?ID=<?php echo $list['ID']?>"><?php echo $list['categories']?></a>
                                            <?php
                                            $cat_id=$list['ID'];
                                            $sub_cat_res=mysqli_query($con,"select * from sub_categories where status='1' and categories_id='$cat_id'");
                                            if(mysqli_num_rows($sub_cat_res)>0){
                                            ?>
                                            
                                               <ul class="dropdown">
                                                    <?php
                                                    while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
                                                        echo '<li><a href="index_categories.php?ID='.$list['ID'].'&sub_categories='.$sub_cat_rows['ID'].'">'.$sub_cat_rows['sub_categories'].'</a></li>
                                                    ';
                                                    }
                                                    ?>
                                                </ul>
                                                <?php } ?>
                                            </li>
                                                <?php
                                            }
                                            ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                                <div class="header__right">
                                    <?php 
                                    $class="mr15";
                                    if(isset($_SESSION['USER_LOGIN'])){
                                        $class="";
                                    }
                                    ?>
                                    <div class="header__search search search__open <?php echo $class?>">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    
                                    <div class="header__account">
                                        <?php if(isset($_SESSION['USER_LOGIN'])){
                                            ?>
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span>
                                              </button>

                                              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                <ul class="navbar-nav mr-auto">
                                                  <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Account
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                      <a class="dropdown-item" href="my_order.php">&nbsp Order</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="profile.php"> &nbsp Profile</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a class="dropdown-item" href="logout.php"> &nbsp Logout</a>
                                                    </div>
                                                  </li>
                                                  
                                                </ul>
                                              </div>
                                            </nav>
                                            <?php
                                        }else{
                                            echo '<a href="login.php" class="mr15">Login/Register</a>';
                                        }
                                        ?>
                                    
                                        
                                        
                                    </div>
                                    <div class="htc__shopping__cart">
                                      
                                        <a href="cart.php"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
        </header>
        <div class="body__overlay"></div>
        <div class="offset__wrapper">
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>