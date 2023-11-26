@extends('layouts.app')

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
                            <h1>Blogs</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section id="section-content" aria-label="section">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-8">
                        @foreach($blogs as $blog)
                            <div class="de-post-type-1">
                                <div class="d-image">
                                    <img alt="" src="{{ Storage::url($blog->thumbnail_photo) }}" class="lazy">
                                </div>
                                <div class="d-content">
                                    <div class="d-meta">
                                        <span class="d-by">By {{ $blog->user->name }}</span>
                                        @php $created_date = strtotime($blog->created_at) @endphp
                                        <span class="d-date">{{ date('D, M d, Y',$created_date) }}</span>
                                        @foreach($blog->tags as $tag)
                                            <span class="d-tags">{{ $tag->tag_name }}</span>
                                        @endforeach
                                    </div>
                                    <h4><a href="{{ route('blog-detail', $blog->slug) }}">{{ $blog->title }}<span></span></a></h4>
                                    <p>@php echo \Illuminate\Support\Str::limit($blog->body, 200); @endphp</p>
                                    <a href="{{ route('blog-detail', $blog->slug) }}" class="btn-main">Read More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-lg-4">
                        <div class="widget widget-post">
                            <h4>Recent Posts</h4>
                            <div class="small-border"></div>
                            <ul class="de-bloglist-type-1">
                                @foreach($blogs as $blog)
                                    <li>
                                        <div class="d-image">
                                            <img src="{{ Storage::url($blog->thumbnail_photo) }}" alt="">
                                        </div>
                                        <div class="d-content">
                                            <a href="{{ route('blog-detail', $blog->slug) }}"><h4>{{ $blog->title }}</h4></a>
                                            @php $created_date = strtotime($blog->created_at) @endphp
                                            <div class="d-date">{{ date('D, M d, Y',$created_date) }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="widget widget_tags">
                            <h4>Popular Tags</h4>
                            <div class="small-border"></div>
                            <ul>
                                @foreach($tags as $tag)
                                    <li><a href="#">{{ $tag->tag_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>

{{--                        <div class="widget">--}}
{{--                            <h4>Testimonials</h4>--}}
{{--                            <div class="small-border"></div>--}}
{{--                            <div class="owl-carousel owl-theme" id="testimonial-carousel-1-col">--}}
{{--                                <div class="item">--}}
{{--                                    <div class="de_testi type-2">--}}
{{--                                        <blockquote>--}}
{{--                                            <h4>Excellent Service!</h4>--}}
{{--                                            <p>Great support, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.--}}
{{--                                            </p>--}}
{{--                                            <div class="de_testi_by">--}}
{{--                                                <img alt="" class="rounded-circle" src="images/people/1.jpg"> <span>John, Pixar Studio</span>--}}
{{--                                            </div>--}}
{{--                                        </blockquote>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="de_testi type-2">--}}
{{--                                        <blockquote>--}}
{{--                                            <h4>Excellent Service!</h4>--}}
{{--                                            <p>Great support, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>--}}
{{--                                            <div class="de_testi_by">--}}
{{--                                                <img alt="" class="rounded-circle" src="images/people/2.jpg"> <span>Sarah, Microsoft</span>--}}
{{--                                            </div>--}}
{{--                                        </blockquote>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="de_testi type-2">--}}
{{--                                        <blockquote>--}}
{{--                                            <h4>Excellent Service!</h4>--}}
{{--                                            <p>Great support, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>--}}
{{--                                            <div class="de_testi_by">--}}
{{--                                                <img alt="" class="rounded-circle" src="images/people/3.jpg"> <span>Michael, Apple</span>--}}
{{--                                            </div>--}}
{{--                                        </blockquote>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="de_testi type-2">--}}
{{--                                        <blockquote>--}}
{{--                                            <h4>Excellent Service!</h4>--}}
{{--                                            <p>Great support, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>--}}
{{--                                            <div class="de_testi_by">--}}
{{--                                                <img alt="" class="rounded-circle" src="images/people/4.jpg"> <span>Thomas, Samsung</span>--}}
{{--                                            </div>--}}
{{--                                        </blockquote>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="de_testi type-2">--}}
{{--                                        <blockquote>--}}
{{--                                            <h4>Excellent Service!</h4>--}}
{{--                                            <p>Great support, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>--}}
{{--                                            <div class="de_testi_by">--}}
{{--                                                <img alt="" class="rounded-circle" src="images/people/1.jpg"> <span>John, Pixar Studio</span>--}}
{{--                                            </div>--}}
{{--                                        </blockquote>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="de_testi type-2">--}}
{{--                                        <blockquote>--}}
{{--                                            <h4>Excellent Service!</h4>--}}
{{--                                            <p>Great support, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>--}}
{{--                                            <div class="de_testi_by">--}}
{{--                                                <img alt="" class="rounded-circle" src="images/people/2.jpg"> <span>Sarah, Microsoft</span>--}}
{{--                                            </div>--}}
{{--                                        </blockquote>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="de_testi type-2">--}}
{{--                                        <blockquote>--}}
{{--                                            <h4>Excellent Service!</h4>--}}
{{--                                            <p>Great support, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>--}}
{{--                                            <div class="de_testi_by">--}}
{{--                                                <img alt="" class="rounded-circle" src="images/people/3.jpg"> <span>Michael, Apple</span>--}}
{{--                                            </div>--}}
{{--                                        </blockquote>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="de_testi type-2">--}}
{{--                                        <blockquote>--}}
{{--                                            <h4>Excellent Service!</h4>--}}
{{--                                            <p>Great support, like i have never seen before. Thanks to the support team, they are very helpfull. This company provide customers great solution, that makes them best.</p>--}}
{{--                                            <div class="de_testi_by">--}}
{{--                                                <img alt="" class="rounded-circle" src="images/people/4.jpg"> <span>Thomas, Samsung</span>--}}
{{--                                            </div>--}}
{{--                                        </blockquote>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}



                    </div>
                </div>

                <div class="spacer-single"></div>

{{--                <div class="col-md-12">--}}
{{--                    <ul class="pagination">--}}
{{--                        <li><a href="#">Prev</a></li>--}}
{{--                        <li class="active"><a href="#">1</a></li>--}}
{{--                        <li><a href="#">2</a></li>--}}
{{--                        <li><a href="#">3</a></li>--}}
{{--                        <li><a href="#">4</a></li>--}}
{{--                        <li><a href="#">5</a></li>--}}
{{--                        <li><a href="#">Next</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection
