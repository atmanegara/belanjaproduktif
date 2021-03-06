<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div id="page-container">
        <!-- BEGIN #about-us-cover -->
        <div id="about-us-cover" class="has-bg section-container">
            <!-- BEGIN cover-bg -->
            <div class="cover-bg">
                <img src="../assets/img/cover/cover-13.jpg" alt="" />
            </div>
            <!-- END cover-bg -->
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN breadcrumb -->
                <ul class="breadcrumb m-b-10 f-s-12">
                    <li><a href="#">Home</a></li>
                    <li class="active">Tentang Kami</li>
                </ul>
                <!-- END breadcrumb -->
                <!-- BEGIN about-us -->
                <div class="about-us text-center">
                    <h1>Belanja Produktif</h1>
                    <p>
                        <?=$detailTentangKami['tag_line']?>
                    </p>
                </div>
                <!-- END about-us -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #about-us-cover -->
        
        <!-- BEGIN #about-us-content -->
        <div id="about-us-content" class="section-container bg-white">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN about-us-content -->
                <div class="about-us-content">
                    <h2 class="title text-center">Siapa Kami</h2>
                    <p class="desc text-center">
                           <?=$detailTentangKami['header']?>
                    </p>
                    
<!--                     BEGIN row 
                    <div class="row">
                        <div class="product-tab">
                         BEGIN #product-tab 
                        <ul id="product-tab" class="nav nav-tabs">
                            <li class="active"><a href="#product-desc" data-toggle="tab">Kegiatan Kami</a></li>
                            <li class=""><a href="#product-reviews" data-toggle="tab">Testimoni</a></li>
                        </ul>
                         END #product-tab 
                         BEGIN #product-tab-content 
                        <div id="product-tab-content" class="tab-content">
                             BEGIN #product-desc 
                            <div class="tab-pane fade active in" id="product-desc">
                                 BEGIN product-desc 
                                <div class="product-desc">
                                    <div class="image">
                                        <img src="../assets/img/product/product-main.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h4>iPhone 6s</h4>
                                        <p>
                                            The moment you use iPhone 6s, you know you???ve never felt anything like it. With a single press, 3D Touch lets you do more than ever before. Live Photos bring your memories to life in a powerfully vivid way. And that???s just the beginning. Take a deeper look at iPhone 6s, and you???ll find innovation on every level.
                                        </p>
                                    </div>
                                </div>
                                 END product-desc 
                                 BEGIN product-desc 
                                <div class="product-desc right">
                                    <div class="image">
                                        <img src="../assets/img/product/product-3dtouch.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h4>3D Touch</h4>
                                        <p>
                                            The original iPhone introduced the world to Multi-Touch, forever changing the way people experience technology. With 3D Touch, you can do things that were never possible before. It senses how deeply you press the display, letting you do all kinds of essential things more quickly and simply. And it gives you real-time feedback in the form of subtle taps from the all-new Taptic Engine.
                                        </p>
                                    </div>
                                </div>
                                 END product-desc 
                                 BEGIN product-desc 
                                <div class="product-desc">
                                    <div class="image">
                                        <img src="../assets/img/product/product-cameras.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h4>Cameras</h4>
                                        <p>
                                            The 12-megapixel iSight camera captures sharp, detailed photos. It takes brilliant 4K video, up to four times the resolution of 1080p HD video. iPhone 6s also takes selfies worthy of a self-portrait with the new 5-megapixel FaceTime HD camera. And it introduces Live Photos, a new way to relive your favorite memories. It captures the moments just before and after your picture and sets it in motion with just the press of a finger.
                                        </p>
                                    </div>
                                </div>
                                 END product-desc 
                                 BEGIN product-desc 
                                <div class="product-desc right">
                                    <div class="image">
                                        <img src="../assets/img/product/product-technology.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h4>Technology</h4>
                                        <p>
                                            iPhone 6s is powered by the custom-designed 64-bit A9 chip. It delivers performance once found only in desktop computers. You???ll experience up to 70 percent faster CPU performance, and up to 90 percent faster GPU performance for all your favorite graphics-intensive games and apps.
                                        </p>
                                    </div>
                                </div>
                                 END product-desc 
                                 BEGIN product-desc 
                                <div class="product-desc">
                                    <div class="image">
                                        <img src="../assets/img/product/product-design.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h4>Design</h4>
                                        <p>
                                            Innovation isn???t always obvious to the eye, but look a little closer at iPhone 6s and you???ll find it???s been fundamentally improved. The enclosure is made from a new alloy of 7000 Series aluminum ??? the same grade used in the aerospace industry. The cover glass is the strongest, most durable glass used in any smartphone. And a new rose gold finish joins space gray, silver, and gold.
                                        </p>
                                    </div>
                                </div>
                                 END product-desc 
                            </div>
                             END #product-desc 
                             BEGIN #product-info 
                            
                             END #product-info 
                             BEGIN #product-reviews 
                            <div class="tab-pane fade" id="product-reviews">
                                 BEGIN row 
                                <div class="row row-space-30">
                                     BEGIN col-7 
                                    <div class="col-md-7">
                                         BEGIN review 
                                        <div class="review">
                                            <div class="review-info">
                                                <div class="review-icon"><img src="../assets/img/user/user-1.jpg" alt=""></div>
                                                <div class="review-rate">
                                                    <ul class="review-star">
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class=""><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    (4/5)
                                                </div>
                                                <div class="review-name">Terry</div>
                                                <div class="review-date">24/05/2016 7:40am</div>
                                            </div>
                                            <div class="review-title">
                                                What does ???SIM-free??? mean?
                                            </div>                        
                                            <div class="review-message">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi in imperdiet augue. Integer non aliquam eros. Cras vehicula nec sapien pretium sagittis. Pellentesque feugiat lectus non malesuada aliquam. Etiam id tortor pretium, dictum leo at, malesuada tortor.
                                            </div>
                                        </div>
                                         END review 
                                         BEGIN review 
                                        <div class="review">
                                            <div class="review-info">
                                                <div class="review-icon"><img src="../assets/img/user/user-2.jpg" alt=""></div>
                                                <div class="review-rate">
                                                    <ul class="review-star">
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class=""><i class="fa fa-star-o"></i></li>
                                                        <li class=""><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    (3/5)
                                                </div>
                                                <div class="review-name">George</div>
                                                <div class="review-date">24/05/2016 8:40am</div>
                                            </div>                     
                                            <div class="review-title">
                                                When I buy iPhone from apple.com, is it tied to a carrier or does it come ???unlocked????
                                            </div>                
                                            <div class="review-message">
                                                In mauris leo, maximus at pellentesque vel, pharetra vel risus. Aenean in semper velit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi volutpat mattis neque, at molestie tellus ultricies quis. Ut lobortis odio nec nunc ullamcorper, vitae faucibus augue semper. Sed luctus lobortis nulla ac volutpat. Mauris blandit scelerisque sem.
                                            </div>
                                        </div>
                                         END review 
                                         BEGIN review 
                                        <div class="review">
                                            <div class="review-info">
                                                <div class="review-icon"><img src="../assets/img/user/user-3.jpg" alt=""></div>
                                                <div class="review-rate">
                                                    <ul class="review-star">
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    (5/5)
                                                </div>
                                                <div class="review-name">Steve</div>
                                                <div class="review-date">23/05/2016 8:40am</div>
                                            </div>                     
                                            <div class="review-title">
                                                Where is the iPhone Upgrade Program available?
                                            </div>                
                                            <div class="review-message">
                                                Duis ut nunc sem. Integer efficitur, justo sit amet feugiat hendrerit, arcu nisl elementum dui, in ultricies erat quam at mauris. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec nec ultrices tellus. Mauris elementum venenatis volutpat.
                                            </div>
                                        </div>
                                         END review 
                                         BEGIN review 
                                        <div class="review">
                                            <div class="review-info">
                                                <div class="review-icon"><img src="../assets/img/user/user-4.jpg" alt=""></div>
                                                <div class="review-rate">
                                                    <ul class="review-star">
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class=""><i class="fa fa-star-o"></i></li>
                                                        <li class=""><i class="fa fa-star-o"></i></li>
                                                        <li class=""><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    (2/5)
                                                </div>
                                                <div class="review-name">Alfred</div>
                                                <div class="review-date">23/05/2016 10.02am</div>
                                            </div>                     
                                            <div class="review-title">
                                                Can I keep my current service plan if I choose the iPhone Upgrade Program?
                                            </div>                
                                            <div class="review-message">
                                                Donec vel fermentum quam. Vivamus scelerisque enim eget tristique auctor. Vivamus tempus, turpis iaculis tempus egestas, leo augue hendrerit tellus, et efficitur neque massa at neque. Aenean efficitur eleifend orci at ornare.
                                            </div>
                                        </div>
                                         END review 
                                         BEGIN review 
                                        <div class="review">
                                            <div class="review-info">
                                                <div class="review-icon"><img src="../assets/img/user/user-5.jpg" alt=""></div>
                                                <div class="review-rate">
                                                    <ul class="review-star">
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    (5/5)
                                                </div>
                                                <div class="review-name">Edward</div>
                                                <div class="review-date">22/05/2016 9.30pm</div>
                                            </div>                     
                                            <div class="review-title">
                                                I have an existing carrier contract or installment plan. Can I purchase with the iPhone Upgrade Program
                                            </div>                
                                            <div class="review-message">
                                                Aliquam consequat ut turpis non interdum. Integer blandit erat nec sapien sollicitudin, a fermentum dui venenatis. Nullam consequat at enim et aliquet. Cras mattis turpis quis eros volutpat tristique vel a ligula. Proin aliquet leo mi, et euismod metus placerat sit amet.
                                            </div>
                                        </div>
                                         END review 
                                    </div>
                                     END col-7 
                                     BEGIN col-5 
                                    <div class="col-md-5">
                                         BEGIN review-form 
                                        <div class="review-form">
                                            <form action="product_detail.html" name="review_form" method="POST">
                                                <h2>Write a review</h2>
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Title <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="review">Review <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" rows="8" id="review"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Rating  <span class="text-danger">*</span></label>
                                                    <div class="rating rating-selection" data-rating="true" data-target="rating">
                                                        <i class="fa fa-star-o" data-value="2"></i>
                                                        <i class="fa fa-star-o" data-value="4"></i>
                                                        <i class="fa fa-star-o" data-value="6"></i>
                                                        <i class="fa fa-star-o" data-value="8"></i>
                                                        <i class="fa fa-star-o" data-value="10"></i>
                                                        <span class="rating-comment">
                                                            <span class="rating-comment-tooltip">Click to rate</span>
                                                        </span>
                                                    </div>
                                                    <select name="rating" class="hide">
                                                        <option value="2">2</option>
                                                        <option value="4">4</option>
                                                        <option value="6">6</option>
                                                        <option value="8">8</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>            
                                                <button type="submit" class="btn btn-inverse btn-lg">Submit Review</button>
                                            </form>
                                        </div>
                                         END review-form  
                                    </div>
                                     END col-5 
                                </div>
                                 END row 
                            </div>
                             END #product-reviews 
                        </div>
                         END #product-tab-content 
                    </div>
                    </div>
                     END row -->
                </div>
                <!-- END about-us-content -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #about-us-content -->
        
    
</div>
