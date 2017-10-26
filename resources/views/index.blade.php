@extends('layouts.user')

@section('content')
<!--<div id="owl-main-slider" class="owl-carousel enable-owl-carousel" data-single-item="true" data-pagination="false" data-auto-play="true" data-main-slider="true" data-stop-on-hover="true">
                <div class="item">
                    <img src="{{ asset('/frontend/assets/media/main-slider/1.jpg') }}" alt="slider">
                   
                    <div class="container-fluid">
                        <div class="slider-content col-md-6 col-lg-6">
                            <div style="display:table;">
                                <div style="display:table-cell; width:100px; vertical-align:top;">
                                    <a class="prev"><i class="fa fa-angle-left"></i></a>
                                    <a class="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                                <div style="display:table-cell;">
                                    <h1>LARGE NUMBER OF FREIGHT WAYS MAKES US POWERFUL</h1>
                                </div>
                            </div>
                            <p>Nunc accumsan metus quis metus. Sed luctus. Mauris eu enim quisque dignissim nequesudm consectetuer dapibus wn eu leo integer varius erat.<br><a class="btn btn-success" href="#">LEARN MORE</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('/frontend/assets/media/main-slider/2.jpg') }}" alt="slider">
                    
                    <div class="container-fluid">
                        <div class="slider-content col-md-6 col-lg-6">
                            <div style="display:table;">
                                <div style="display:table-cell; width:100px; vertical-align:top;">
                                    <a class="prev"><i class="fa fa-angle-left"></i></a>
                                    <a class="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                                <div style="display:table-cell;">
                                    <h1>LARGE NUMBER OF FREIGHT WAYS MAKES US POWERFUL</h1>
                                </div>
                            </div>
                            <p>Nunc accumsan metus quis metus. Sed luctus. Mauris eu enim quisque dignissim nequesudm consectetuer dapibus wn eu leo integer varius erat.<br><a class="btn btn-success" href="#">LEARN MORE</a></p>
                        </div>
                    </div>
                </div>
            </div>-->

<!--
 <video autoplay="" loop="" muted="">
        <source src="{{asset('/frontend/assets/video/01.mp4')}}" type="video/mp4">
        <source src="{{asset('/frontend/assets/video/01.mov')}}" type="video/webm">
    </video>-->


<div class="homepage-hero-module">
    <div class="video-container">
        <div class="title-container">
            <!--            <div class="headline">
                                    <h1>Welcome to our Company</h1>
            
                        </div>-->
            <div class="description text-center">
                
                <div class="inner">
                    <h2>WELCOME TO AUSTRANS LOGISTICS</h2>
                    <p>DELIVERING GREAT CUSTOMER SERVICE</p>
                    <p>"PEOPLE PARTNERSHIP PERFORMANCE."</p></div>
                    <button class="btn btn-success">GET A FREE QUOTE</button>
            </div>
        </div>
        <div class="filter"></div>
        <video autoplay loop class="fillWidth">
            <source src="{{asset('/frontend/assets/video/01.mp4')}}" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.</video>

    </div>
</div>





<div class="container-fluid">
    <div class="row column-info block-content">
        <div class="col-sm-4 col-md-4 col-lg-4 wow fadeInLeft" data-wow-delay="3.3s">
            <img src="{{ asset('/frontend/assets/media/3-column-info/1.jpg') }}" alt="slider">

            <span></span>
            <h3>SAFE & SECURE DELIVERY</h3>
            <p>Integer congue, elit non semper laoreet sed lectus orci posuh nisl tempor lacus felis ac mauris. Pellentesque in urna. Intege vitae felis vel magna posuere vestibulum.</p>
            <a class="btn btn-default btn-sm" href="11_blog-details.html">READ MORE</a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 wow fadeInUp" data-wow-delay="3.3s">
            <img src="{{ asset('/frontend/assets/media/3-column-info/2.jpg') }}" alt="slider">

            <span></span>
            <h3>SAFE & SECURE DELIVERY</h3>
            <p>Integer congue, elit non semper laoreet sed lectus orci posuh nisl tempor lacus felis ac mauris. Pellentesque in urna. Intege vitae felis vel magna posuere vestibulum.</p>
            <a class="btn btn-default btn-sm" href="11_blog-details.html">READ MORE</a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 wow fadeInRight" data-wow-delay="3.3s">
            <img src="{{ asset('/frontend/assets/media/3-column-info/3.jpg') }}" alt="slider">

            <span></span>
            <h3>SAFE & SECURE DELIVERY</h3>
            <p>Integer congue, elit non semper laoreet sed lectus orci posuh nisl tempor lacus felis ac mauris. Pellentesque in urna. Intege vitae felis vel magna posuere vestibulum.</p>
            <a class="btn btn-default btn-sm" href="11_blog-details.html">READ MORE</a>
        </div>
    </div>
</div>

<hr>
<div class="big-hr color-1 wow zoomInUp" data-wow-delay="0.3s">
    <div class="text-left" style="margin-right:40px;">
        <h2>WE PROVIDE FASTEST & AFFORDABLE CARGO SERVICES</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
    </div>
    <div><a class="btn btn-success btn-lg" href="#">REQUEST A FREE QUOTE</a></div>
</div>

<div class="container-fluid block-content">
    <div class="text-center hgroup wow zoomInUp" data-wow-delay="0.3s">
        <h1>OUR SERVICES</h1>
        <h2>We have wide network of offices in all major locations to help you with <br> the services we offer</h2>
    </div>
    <div class="row our-services">
        <div class="col-sm-6 col-md-4 col-lg-4 wow zoomInLeft" data-wow-delay="0.3s">
            <a href="11_blog-details.html">
                <span><i class="glyph-icon flaticon-boats4"></i></span>
                <h4>SEA FREIGHT</h4>
                <p>Integer congue elit non semper laore lectus orci posuer nisl tempor lacus mauris led ipsum.</p>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4 wow zoomInUp" data-wow-delay="0.3s">
            <a href="11_blog-details.html">
                <span><i class="glyph-icon flaticon-flying"></i></span>
                <h4>SEA FREIGHT</h4>
                <p>Integer congue elit non semper laore lectus orci posuer nisl tempor lacus mauris led ipsum.</p>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4 wow zoomInRight" data-wow-delay="0.3s">
            <a href="11_blog-details.html">
                <span><i class="glyph-icon flaticon-garage1"></i></span>
                <h4>SEA FREIGHT</h4>
                <p>Integer congue elit non semper laore lectus orci posuer nisl tempor lacus mauris led ipsum.</p>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4 wow zoomInLeft" data-wow-delay="0.3s">
            <a href="11_blog-details.html">
                <span><i class="glyph-icon flaticon-package7"></i></span>
                <h4>SEA FREIGHT</h4>
                <p>Integer congue elit non semper laore lectus orci posuer nisl tempor lacus mauris led ipsum.</p>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4 wow zoomInUp" data-wow-delay="0.3s">
            <a href="11_blog-details.html">
                <span><i class="glyph-icon flaticon-railway1"></i></span>
                <h4>SEA FREIGHT</h4>
                <p>Integer congue elit non semper laore lectus orci posuer nisl tempor lacus mauris led ipsum.</p>
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4 wow zoomInRight" data-wow-delay="0.3s">
            <a href="11_blog-details.html">
                <span><i class="glyph-icon flaticon-traffic-signal"></i></span>
                <h4>SEA FREIGHT</h4>
                <p>Integer congue elit non semper laore lectus orci posuer nisl tempor lacus mauris led ipsum.</p>
            </a>
        </div>
    </div>
</div>

<div class="fleet-gallery block-content bg-image inner-offset">
    <div class="container-fluid inner-offset">
        <div class="text-center hgroup wow zoomInUp" data-wow-delay="0.3s">
            <h1>THE FLEETS GALLERY</h1>
            <h2>we always use best & fastest fleets</h2>
        </div>
        <div id="fleet-gallery" class="owl-carousel enable-owl-carousel" data-pagination="false" data-navigation="true" data-min450="2" data-min600="2" data-min768="4">
            <div class="wow rotateIn" data-wow-delay="0.3s">  <img src="{{ asset('/frontend/assets/media/fleet-gallery/1.png') }}" alt="Img"></div>
            <div class="wow rotateIn" data-wow-delay="0.3s"><img src="{{ asset('/frontend/assets/media/fleet-gallery/2.png') }}" alt="Img"></div>
            <div class="wow rotateIn" data-wow-delay="0.3s"><img src="{{ asset('/frontend/assets/media/fleet-gallery/3.png') }}" alt="Img"></div>
            <div class="wow rotateIn" data-wow-delay="0.3s"><img src="{{ asset('/frontend/assets/media/fleet-gallery/4.png') }}" alt="Img"></div>
            <div class="wow rotateIn" data-wow-delay="0.3s"><img src="{{ asset('/frontend/assets/media/fleet-gallery/1.png') }}" alt="Img"></div>
            <div class="wow rotateIn" data-wow-delay="0.3s"><img src="{{ asset('/frontend/assets/media/fleet-gallery/2.png') }}" alt="Img"></div>
        </div>
    </div>
</div>

<div class="container-fluid block-content">
    <div class="row">
        <div class="col-md-6 col-lg-6 wow fadeInLeft" data-wow-delay="0.3s">
            <div class="hgroup">
                <h1>TRUSTED CLIENTS</h1>
                <h2>Lorem ipsum dolor sit amet consectetur</h2>
            </div>
            <div id="testimonials" class="owl-carousel enable-owl-carousel" data-single-item="true" data-pagination="false" data-navigation="true" data-auto-play="true">
                <div>
                    <div class="testimonial-content">
                        <span><i class="fa fa-quote-left"></i></span>
                        <p>Integer congue elit non semper laoreet sed lectus orci posuer nisl tempor se felis ac mauris. Pelentesque inyd urna. Integer vitae felis vel magna posu du vestibulum. Nam rutrum congue diam. Aliquam malesuada maurs etug met Curabitur laoreet convallis nisal pellentesque bibendum.</p>
                    </div>
                    <div class="text-right testimonial-author">
                        <h4>JOHN DEO</h4>
                        <small>Managing Director</small>
                    </div>
                </div>
                <div>
                    <div class="testimonial-content">
                        <span><i class="fa fa-quote-left"></i></span>
                        <p>Integer congue elit non semper laoreet sed lectus orci posuer nisl tempor se felis ac mauris. Pelentesque inyd urna. Integer vitae felis vel magna posu du vestibulum. Nam rutrum congue diam. Aliquam malesuada maurs etug met Curabitur laoreet convallis nisal pellentesque bibendum.</p>
                    </div>
                    <div class="text-right testimonial-author">
                        <h4>JOHN DEO</h4>
                        <small>Managing Director</small>
                    </div>
                </div>
                <div>
                    <div class="testimonial-content">
                        <span><i class="fa fa-quote-left"></i></span>
                        <p>Integer congue elit non semper laoreet sed lectus orci posuer nisl tempor se felis ac mauris. Pelentesque inyd urna. Integer vitae felis vel magna posu du vestibulum. Nam rutrum congue diam. Aliquam malesuada maurs etug met Curabitur laoreet convallis nisal pellentesque bibendum.</p>
                    </div>
                    <div class="text-right testimonial-author">
                        <h4>JOHN DEO</h4>
                        <small>Managing Director</small>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6 col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
            <div class="hgroup">
                <h1>WHY CHOOSE US</h1>
                <h2>Lorem ipsum dolor sit amet consectetur</h2>
            </div>
            <ul class="why-us">
                <li>
                    Dui ac hendrerit elementum quam ipsum auctor lorem
                    <p>Integer congue elit non semper laoreet sed lectus orci posuer nisl tempor se felis ac mauris. Pelentesque inyd urna. Integer vitae felis vel magna posu du vestibulum. Nam rutrum congue diam. Aliquam malesuada maurs etug met Curabitur laoreet convallis nisal pellentesque bibendum.</p>
                    <span>+</span>
                </li>
                <li>
                    Mauris vel magna a est lobortis volutpat
                    <p>Integer congue elit non semper laoreet sed lectus orci posuer nisl tempor se felis ac mauris. Pelentesque inyd urna. Integer vitae felis vel magna posu du vestibulum. Nam rutrum congue diam. Aliquam malesuada maurs etug met Curabitur laoreet convallis nisal pellentesque bibendum.</p>
                    <span>+</span>
                </li>
                <li>
                    Sed bibendum ornare lorem mauris feugiat suspendisse neque
                    <p>Integer congue elit non semper laoreet sed lectus orci posuer nisl tempor se felis ac mauris. Pelentesque inyd urna. Integer vitae felis vel magna posu du vestibulum. Nam rutrum congue diam. Aliquam malesuada maurs etug met Curabitur laoreet convallis nisal pellentesque bibendum.</p>
                    <span>+</span>
                </li>
                <li>
                    Nulla scelerisque dul hendrerit elementum quam
                    <p>Integer congue elit non semper laoreet sed lectus orci posuer nisl tempor se felis ac mauris. Pelentesque inyd urna. Integer vitae felis vel magna posu du vestibulum. Nam rutrum congue diam. Aliquam malesuada maurs etug met Curabitur laoreet convallis nisal pellentesque bibendum.</p>
                    <span>+</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<hr>

<div class="container-fluid block-content percent-blocks" data-waypoint-scroll="true">
    <div class="row stats">
        <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="chart" data-percent="230">
                <span><i class="fa fa-folder-open"></i></span>
                <span class="percent"></span>Projects Done
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="chart" data-percent="68">
                <span><i class="fa fa-users"></i></span>
                <span class="percent"></span>Clients Worldwide
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="chart" data-percent="147">
                <span><i class="fa fa-truck"></i></span>
                <span class="percent"></span>Owned Vehicles
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="chart" data-percent="105">
                <span><i class="fa fa-male"></i></span>
                <span class="percent"></span>People In Team
            </div>
        </div>
    </div>
</div>

<div class="block-content bg-image blog-section inner-offset">
    <div class="container-fluid">
        <div class="hgroup wow fadeInLeft" data-wow-delay="0.3s">
            <h1>LATEST NEWS</h1>
            <h2>READ our latest blog news</h2>
        </div>
        <a class="btn btn-danger pull-right read-all-news wow fadeInRight" data-wow-delay="0.3s" href="09_blog.html">READ ALL NEWS</a>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6 one-news wow fadeInLeft" data-wow-delay="0.3s">
                <div style="background-image:url({{ asset('/frontend/assets/media/news-images/1.jpg') }});">
                    <div>
                        <a href="11_blog-details.html"><h3>Duis vel tellus vitae ante tincidunt tincidun</h3></a>
                        <small class="news-author">BY JOHN DEO</small>
                        <small>JUN 29, 2015</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 two-news wow fadeInRight" data-wow-delay="0.3s">
                <div class="news-item row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div style="background-image:url({{ asset('/frontend/assets/media/news-images/2.jpg') }});"></div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div>
                            <a href="11_blog-details.html"><h3>Duis vel tellus vitae ante tincidunt tincidun</h3></a>
                            <small class="news-author">BY JOHN DEO</small>
                            <small>JUN 29, 2015</small>
                        </div>
                    </div>
                </div>
                <div class="news-item row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div style="background-image:url({{ asset('/frontend/assets/media/news-images/3.jpg') }});"></div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div>
                            <a href="11_blog-details.html"><h3>Duis vel tellus vitae ante tincidunt tincidun</h3></a>
                            <small class="news-author">BY JOHN DEO</small>
                            <small>JUN 29, 2015</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid partners block-content">
    <div class="hgroup title-space wow fadeInLeft" data-wow-delay="0.3s">
        <h1>TRUSTED partners</h1>
        <h2>Lorem ipsum dolor sit amet consectetur</h2>
    </div>
    <div id="partners" class="owl-carousel enable-owl-carousel" data-pagination="false" data-navigation="true" data-min450="2" data-min600="2" data-min768="4">
        <div class="wow rotateIn" data-wow-delay="0.3s"><a href="#"><img src="{{ asset('/frontend/assets/media/partners/1.png') }}" alt="Img"></a></div>
        <div class="wow rotateIn" data-wow-delay="0.3s"><a href="#"><img src="{{ asset('/frontend/assets/media/partners/2.png') }}" alt="Img"></a></div>
        <div class="wow rotateIn" data-wow-delay="0.3s"><a href="#"><img src="{{ asset('/frontend/assets/media/partners/3.png') }}" alt="Img"></a></div>
        <div class="wow rotateIn" data-wow-delay="0.3s"><a href="#"><img src="{{ asset('/frontend/assets/media/partners/4.png') }}" alt="Img"></a></div>
        <div class="wow rotateIn" data-wow-delay="0.3s"><a href="#"><img src="{{ asset('/frontend/assets/media/partners/1.png') }}" alt="Img"></a></div>
        <div class="wow rotateIn" data-wow-delay="0.3s"><a href="#"><img src="{{ asset('/frontend/assets/media/partners/2.png') }}" alt="Img"></a></div>
    </div>
</div>
@endsection
