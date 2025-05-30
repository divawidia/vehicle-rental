@extends('client.layouts.app')

@section('title')
    Contact Us | Batur Sari Rental Bali
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
                            <h1>Contact Us</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->


        <section aria-label="section">
            <div class="container">
                <div class="row g-custom-x">

                    <div class="col-lg-8 mb-sm-30">

                        <h3>Do you have any question?</h3>

                        <form name="contactForm" id="contact_form" class="form-border" method="post" action="#">
                            <div class="row">
                                <div class="col-md-4 mb10">
                                    <div class="field-set">
                                        <input type="text" name="Name" id="name" class="form-control" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb10">
                                    <div class="field-set">
                                        <input type="text" name="Email" id="email" class="form-control" placeholder="Your Email" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb10">
                                    <div class="field-set">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" required>
                                    </div>
                                </div>
                            </div>

                            <div class="field-set mb20">
                                <textarea name="message" id="message" class="form-control" placeholder="Your Message" required></textarea>
                            </div>
                            <div class="g-recaptcha" data-sitekey="copy-your-site-key-here"></div>
                            <div id='submit' class="mt20">
                                <input type='submit' id='send_message' value='Send Message' class="btn-main">
                            </div>

                            <div id="success_message" class='success'>
                                Your message has been sent successfully. Refresh this page if you want to send more
                                messages.
                            </div>
                            <div id="error_message" class='error'>
                                Sorry there was an error sending your form.
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4">

                        <div class="de-box mb30">
                            <h4>Our Office</h4>
                            <address class="s1">
                                <span><i class="id-color fa fa-map-marker fa-lg"></i>Jl. Kayu Aya, Gg, Beji No. 60x, Seminyak, Kec. Kuta, Kabupaten Badung, Bali</span>
                                <span><i class="id-color fa fa-phone fa-lg"></i>+62 822-3659-2085</span>
                                <span><i class="id-color fa fa-envelope-o fa-lg"></i><a href="mailto:contact@example.com">batursarirental@gmail.com</a></span>
                                <span><i class="id-color fa fa-file-pdf-o fa-lg"></i><a href="#">Download Brochure</a></span>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection
