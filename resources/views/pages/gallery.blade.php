@extends('layouts.app')

@section('title')
    Gallery | Batur Sari Rental Bali
@endsection

@section('content')
    <!-- content begin -->
    <div class="no-bottom space-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="images/background/16.jpg" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Gallery</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->


        <section aria-label="section">
            <div class="container">
                <div id="gallery" class="row">

                    <div class="col-md-4 mb30 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/1.jpg" class="image-popup">
									<span class="dih-title-wrap">
										<span class="dih-title">Gallery Title</span>
									</span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/1.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb30 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/2.jpg" class="image-popup">
									<span class="dih-title-wrap">
										<span class="dih-title">Gallery Title</span>
									</span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/2.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb30 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/3.jpg" class="image-popup">
									<span class="dih-title-wrap">
										<span class="dih-title">Gallery Title</span>
									</span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/3.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb30 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/4.jpg" class="image-popup">
									<span class="dih-title-wrap">
										<span class="dih-title">Gallery Title</span>
									</span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/4.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb30 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/5.jpg" class="image-popup">
									<span class="dih-title-wrap">
										<span class="dih-title">Gallery Title</span>
									</span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/5.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4 mb30 item">
                        <div class="de-image-hover rounded">
                            <a href="images/gallery/6.jpg" class="image-popup">
									<span class="dih-title-wrap">
										<span class="dih-title">Gallery Title</span>
									</span>
                                <span class="dih-overlay"></span>
                                <img src="images/gallery/6.jpg" class="lazy img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection
