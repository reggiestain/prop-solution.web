<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
?>

<header>		
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navigation">
            <div class="container">					
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">
                        <a href="index.html"><h1><span>Prop</span>Solution</h1></a>
                    </div>
                </div>

                <div class="navbar-collapse collapse">							
                    <div class="menu">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"><a href="index.html" class="active">Home</a></li>
                            <li role="presentation"><a href="about.html">About Us</a></li>
                            <li role="presentation"><a href="services.html">Services</a></li>								
                            <li role="presentation"><a href="portfolio.html">Portfolio</a></li>
                            <li role="presentation"><a href="contact.html">Contact</a></li>
                            <li role="presentation"><a href="<?php echo \Cake\Routing\Router::Url('/users/login');?>" target="_blank">Register / Login</a></li>
                            						
                        </ul>
                    </div>
                </div>						
            </div>
        </div>	
    </nav>		
</header>

<section id="main-slider" class="no-margin">
    <div class="carousel slide">      
        <div class="carousel-inner">
            <div class="item active" style="background-image: url(webroot/img/slider/bg1.jpg)">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content">
                                <h2 class="animation animated-item-1">Welcome To <span>Prop - Solution</span></h2>
                                <p class="animation animated-item-2">Your all in one property management solution at your finger tips.</p>
                                <a class="btn-slide animation animated-item-3" href="#">Sign Up</a>
                            </div>
                        </div>

                        <div class="col-sm-6 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <!--<img src="images/slider/img3.png" class="img-responsive">-->
                                <?php echo $this->Html->image('slider/img3.png');?>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/.item-->             
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
</section><!--/#main-slider-->

<div class="feature">
    <div class="container">
        <div class="text-center">
            <div class="col-md-3">
                <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >
                    <i class="fa fa-money"></i>	
                    <h2>Tenant payment</h2>
                    <p>
                    Tenants love technology too! Why not give them the ability to see their statement any time it's convenient for them. After all, they have their own schedules.
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
                    <i class="fa fa-laptop"></i>	
                    <h2>Tenant Portal</h2>
                    <p>Tenants can view statements, make payments, or request maintenance and lodge complains.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" >
                    <i class="fa fa-bell-o"></i>	
                    <h2>Tenant Notification</h2>
                    <p>Property owners and managers need an affordable, easy to use and reliable method to reach tenants, employees, contractors and other stakeholders.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" >
                    <i class="fa fa-comment-o"></i>	
                    <h2>Tenant Communications</h2>
                    <p>Email or print statements, invoices, or personalized documents en masse or individually.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about">
    <div class="container">
        <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" >
            <h2>about us</h2>            
            <?php echo $this->Html->image('6.jpg',['class'=>'img-responsive']);?>     
            <p>Our goal is to meet and exceed your property management needs while providing unfaltering service and 
                dedication to your association. We do so with the utmost level of respect and appreciation for your business. 
                Our promise is to treat your assets like they were our own by protecting them, defending them and supporting 
                them from day one. At Property Management Solutions, we never lose site of the fact that homeowners have both a 
                financial and an emotional investment in their communities. Not only do we embrace their passions, we match it. 
                We only hire professionals that can demonstrate a genuine interest in serving the community. It is this commitment 
                and passion that differentiates us from our competition.
            </p>
        </div>

        <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" >
            <h2>We've got a lot to offer and we continue to add more</h2>
            <p>Our Smart Notification system allows property owners and managers to 
                communicate in real-time to send personal communications by phone call, text message, 
                email and more using an easy to use, Web-based interface. To ensure the right message reaches 
                the right contacts, the system has easy targeting tools to drill down and deliver messages to 
                contacts with certain characteristics. Because the system is intuitive and easy to use, little training 
                is required to operate the SmartNotice system making it an effective tool for emergency 
                calling and for routine announcements. To ensure accountability, the SmartNotice system 
                features message tracking reports to determine who receives the notification, at what time and their response.
            <p>
            </p>
            <p>Our goal is to meet and exceed your property management needs while providing unfaltering service and 
                dedication to your association. We do so with the utmost level of respect and appreciation for your business. 
                Our promise is to treat your assets like they were our own by protecting them, defending them and supporting 
                them from day one. At Property Management Solutions, we never lose site of the fact that homeowners have both a 
                financial and an emotional investment in their communities. Not only do we embrace their passions, we match it. 
                We only hire professionals that can demonstrate a genuine interest in serving the community. It is this commitment 
                and passion that differentiates us from our competition. </p>
        </div>
    </div>
</div>

<div class="lates">
    <div class="container">
        <div class="text-center">
            <h2>Lates News</h2>
        </div>
        <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <?php echo $this->Html->image('4.jpg',['class'=>'img-responsive']);?>
            <h3>Template built with Twitter Bootstrap</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat 
                libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
            </p>
        </div>

        <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <?php echo $this->Html->image('4.jpg',['class'=>'img-responsive']);?>
            <h3>Template built with Twitter Bootstrap</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat 
                libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
            </p>
        </div>

        <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms">				
            <?php echo $this->Html->image('4.jpg',['class'=>'img-responsive']);?>
            <h3>Template built with Twitter Bootstrap</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat 
                libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
            </p>
        </div>
    </div>
</div>

<section id="partner">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>Our Partners</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
        </div>    

        <div class="partners">
            <ul>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="webroot/img/partners/partner1.png"></a></li>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="webroot/img/partners/partner2.png"></a></li>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" src="webroot/img/partners/partner3.png"></a></li>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="webroot/img/partners/partner4.png"></a></li>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="webroot/img/partners/partner5.png"></a></li>
            </ul>
        </div>        
    </div><!--/.container-->
</section><!--/#partner-->

<section id="conatcat-info">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="pull-left">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="media-body">
                        <h2>Have a question or need a custom quote?</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation +0123 456 70 80</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.container-->    
</section><!--/#conatcat-info-->

<footer>
    <div class="footer">
        <div class="container">
            <div class="social-icon">
                <div class="col-md-4">
                    <ul class="social-network">
                        <li><a href="#" class="fb tool-tip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="twitter tool-tip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="gplus tool-tip" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="linkedin tool-tip" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#" class="ytube tool-tip" title="You Tube"><i class="fa fa-youtube-play"></i></a></li>
                    </ul>	
                </div>
            </div>

            <div class="col-md-4 col-md-offset-4">
                <div class="copyright">
                    &copy; June  2015 by <a target="_blank" href="#" title="">Judahtips</a>. All Rights Reserved.
                </div>
                <!-- 
                    All links in the footer should remain intact. 
                    Licenseing information is available at: http://bootstraptaste.com/license/
                    You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Company
                -->
            </div>						
        </div>

        <div class="pull-right">
            <a href="#home" class="scrollup"><i class="fa fa-angle-up fa-3x"></i></a>
        </div>		
    </div>
</footer>