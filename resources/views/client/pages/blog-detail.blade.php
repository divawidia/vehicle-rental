@extends('client.layouts.app')

@section('title')
    Blog | Batur Sari Rental Bali
@endsection

@section('content')
    <!-- content begin -->
    <div class="no-bottom space-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="/images/background/16.jpg" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>{{ $blog->title }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <!-- section begin -->
        <section aria-label="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="blog-read">

                            <img alt="" src="{{ Storage::url($blog->thumbnail_photo ?? '') }}" class="img-fullwidth mb30">

                            <div class="post-text">
                                @php echo $blog->body @endphp
                            </div>
                        </div>

                        <div class="spacer-single"></div>

                        {{--                        <div id="blog-comment">--}}
                        {{--                            <h4>Comments (5)</h4>--}}

                        {{--                            <div class="spacer-half"></div>--}}

                        {{--                            <ol>--}}
                        {{--                                <li>--}}
                        {{--                                    <div class="avatar">--}}
                        {{--                                        <img src="images/misc/avatar-2.jpg" alt=""></div>--}}
                        {{--                                    <div class="comment-info">--}}
                        {{--                                        <span class="c_name">Merrill Rayos</span>--}}
                        {{--                                        <span class="c_date id-color">15 January 2020</span>--}}
                        {{--                                        <span class="c_reply"><a href="#">Reply</a></span>--}}
                        {{--                                        <div class="clearfix"></div>--}}
                        {{--                                    </div>--}}

                        {{--                                    <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</div>--}}
                        {{--                                    <ol>--}}
                        {{--                                        <li>--}}
                        {{--                                            <div class="avatar">--}}
                        {{--                                                <img src="images/misc/avatar-2.jpg" alt=""></div>--}}
                        {{--                                            <div class="comment-info">--}}
                        {{--                                                <span class="c_name">Jackqueline Sprang</span>--}}
                        {{--                                                <span class="c_date id-color">15 January 2020</span>--}}
                        {{--                                                <span class="c_reply"><a href="#">Reply</a></span>--}}
                        {{--                                                <div class="clearfix"></div>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt--}}
                        {{--                                                explicabo.</div>--}}
                        {{--                                        </li>--}}
                        {{--                                    </ol>--}}
                        {{--                                </li>--}}

                        {{--                                <li>--}}
                        {{--                                    <div class="avatar">--}}
                        {{--                                        <img src="images/misc/avatar-2.jpg" alt=""></div>--}}
                        {{--                                    <div class="comment-info">--}}
                        {{--                                        <span class="c_name">Sanford Crowley</span>--}}
                        {{--                                        <span class="c_date id-color">15 January 2020</span>--}}
                        {{--                                        <span class="c_reply"><a href="#">Reply</a></span>--}}
                        {{--                                        <div class="clearfix"></div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</div>--}}
                        {{--                                    <ol>--}}
                        {{--                                        <li>--}}
                        {{--                                            <div class="avatar">--}}
                        {{--                                                <img src="images/misc/avatar-2.jpg" alt=""></div>--}}
                        {{--                                            <div class="comment-info">--}}
                        {{--                                                <span class="c_name">Lyndon Pocekay</span>--}}
                        {{--                                                <span class="c_date id-color">15 January 2020</span>--}}
                        {{--                                                <span class="c_reply"><a href="#">Reply</a></span>--}}
                        {{--                                                <div class="clearfix"></div>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt--}}
                        {{--                                                explicabo.</div>--}}
                        {{--                                        </li>--}}
                        {{--                                    </ol>--}}
                        {{--                                </li>--}}

                        {{--                                <li>--}}
                        {{--                                    <div class="avatar">--}}
                        {{--                                        <img src="images/misc/avatar-2.jpg" alt=""></div>--}}
                        {{--                                    <div class="comment-info">--}}
                        {{--                                        <span class="c_name">Aleen Crigger</span>--}}
                        {{--                                        <span class="c_date id-color">15 January 2020</span>--}}
                        {{--                                        <span class="c_reply"><a href="#">Reply</a></span>--}}

                        {{--                                        <div class="clearfix"></div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</div>--}}
                        {{--                                </li>--}}
                        {{--                            </ol>--}}

                        {{--                            <div class="spacer-single"></div>--}}

                        {{--                            <div id="comment-form-wrapper">--}}
                        {{--                                <h4>Leave a Comment</h4>--}}
                        {{--                                <div class="comment_form_holder">--}}
                        {{--                                    <form id="contact_form" name="form1" class="form-border" method="post" action="#">--}}

                        {{--                                        <label>Name</label>--}}
                        {{--                                        <input type="text" name="name" id="name" class="form-control" />--}}

                        {{--                                        <label>Email <span class="req">*</span></label>--}}
                        {{--                                        <input type="text" name="email" id="email" class="form-control" />--}}
                        {{--                                        <div id="error_email" class="error">Please check your email</div>--}}

                        {{--                                        <label>Message <span class="req">*</span></label>--}}
                        {{--                                        <textarea cols="10" rows="10" name="message" id="message" class="form-control"></textarea>--}}
                        {{--                                        <div id="error_message" class="error">Please check your message</div>--}}
                        {{--                                        <div id="mail_success" class="success">Thank you. Your message has been sent.</div>--}}
                        {{--                                        <div id="mail_failed" class="error">Error, email not sent</div>--}}

                        {{--                                        <p id="btnsubmit">--}}
                        {{--                                            <input type="submit" id="send" value="Send" class="btn-main" /></p>--}}



                        {{--                                    </form>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                    </div>

                    <div id="sidebar" class="col-md-4">
                        <div class="widget">
                            <h4>Share With Friends</h4>
                            <div class="small-border"></div>
                            <div class="de-color-icons">
                                <span><i class="fa fa-twitter fa-lg"></i></span>
                                <span><i class="fa fa-facebook fa-lg"></i></span>
                                <span><i class="fa fa-reddit fa-lg"></i></span>
                                <span><i class="fa fa-linkedin fa-lg"></i></span>
                                <span><i class="fa fa-pinterest fa-lg"></i></span>
                                <span><i class="fa fa-stumbleupon fa-lg"></i></span>
                                <span><i class="fa fa-delicious fa-lg"></i></span>
                                <span><i class="fa fa-envelope fa-lg"></i></span>
                            </div>
                        </div>

                        <div class="widget widget-post">
                            <h4>Recent Posts</h4>
                            <div class="small-border"></div>
                            <ul class="de-bloglist-type-1">
                                @foreach($blogs as $blog)
                                    <li>
                                        <div class="d-image">
                                            <img src="{{ Storage::url($blog->thumbnail_photo ?? '') }}" alt="">
                                        </div>
                                        <div class="d-content">
                                            <a href="{{ route('blog-detail', $blog->slug) }}">
                                                <h4>{{ $blog->title }}</h4></a>
                                            @php $created_date = strtotime($blog->created_at) @endphp
                                            <div class="d-date">{{ date('D, M d, Y',$created_date) }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="widget widget-text">
                            <h4>About Us</h4>
                            <div class="small-border"></div>
                            <p class="small no-bottom">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                                architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                                sit aspernatur aut odit aut fugit, sed quia consequuntur magni
                            </p>
                        </div>
                        <div class="widget widget_tags">
                            <h4>Tags</h4>
                            <div class="small-border"></div>
                            <ul>
                                @foreach($tags as $tag)
                                    <li><a href="#">{{ $tag->tag_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection
