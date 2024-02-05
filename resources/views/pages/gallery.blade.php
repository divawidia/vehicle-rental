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
            <img src="/images/background/16.jpg" class="jarallax-img" alt="">
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
                <div id="nanogallery2"
                     data-nanogallery2 = '{
                        "thumbnailHeight":  auto,
                        "thumbnailWidth":   auto,
                        "galleryMosaic" :   [
                              { "c": 1, "r": 1, "w": 2, "h": 2 },
                              { "c": 3, "r": 1, "w": 1, "h": 1 },
                              { "c": 3, "r": 2, "w": 1, "h": 1 },
                              { "c": 1, "r": 3, "w": 1, "h": 1 },
                              { "c": 3, "r": 3, "w": 2, "h": 1 }
                          ]
                        "thumbnailDisplayTransition": "scaleUp",
                        "thumbnailDisplayTransitionDuration": 1000,
                        "thumbnailDisplayInterval": 100
                      }'>
                    @foreach($galleries as $gallery)
                        <a href = "{{ Storage::url($gallery->photo_url) }}"   data-ngThumb = "{{ Storage::url($gallery->photo_url) }}" ></a>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
@endsection
