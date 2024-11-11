<?php 
require('top.php');

$resBanner=mysqli_query($con,"select * from banner where status='1' order by order_no asc");

?>
<div class="body__overlay"></div>
        <?php if(mysqli_num_rows($resBanner)>0){?>
        <!-- Start Slider Area -->
        <div class="slider__container slider--one bg__cat--3">
            <div class="slide__container slider__activation__wrap owl-carousel">
                <?php while($rowBanner=mysqli_fetch_assoc($resBanner)){?>
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h1><?php echo $rowBanner['heading1']?></h1>
                                        <h2><?php echo $rowBanner['heading2']?></h2>
                                        <br/>
                                        <?php
                                        if($rowBanner['btn_txt'] !='' && $rowBanner['btn_link']!=''){
                                            ?>
                                            <div class="cr__btn">
                                                <a href="<?php echo $rowBanner['btn_link']?>"><?php echo $rowBanner['btn_txt']?></a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img width='150px' src="<?php echo BANNER_SITE_PATH.$rowBanner['image']?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- Start Slider Area -->
        <?php } ?>
        <!-- Start Category Area -->
        <section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Best Deals For You</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
                            <?php 
                       $get_product=get_product($con);
                        foreach($get_product as $list){
                            ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                            <div class="ht__cat__thumb ">
                                   <a href="product.php?ID=<?php echo $list['ID']?>">

                                 <img class="image-resize" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list ['image']?>" alt="product images">
                                </a>
                            </div>
                    
                         <div class="fr__product__inner">
                            
             <h4><a href="product.php"><div> <?php echo $list ['name']?></div></a></h4>
                       <ul class="fr__pro__prize">
                   
                        <li><?php echo $list['price']?></li>
                            </ul>
                                   </div>
                                </div>
                            </div>
                            <!-- End Single Category -->
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
                     
                      
                              
                   
        <?php require('footer.php') ?>