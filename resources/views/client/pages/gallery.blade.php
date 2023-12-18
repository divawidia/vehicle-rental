@extends('client.layouts.app')

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
                <div id="nanogallery2">
                </div>
            </div>
        </section>
    </div>
    {{--    @php--}}Z--}}
    <!-- content close -->
@endsection
@push('addon-script')
    <script>
        jQuery(document).ready(function () {

            jQuery("#nanogallery2").nanogallery2({
                // ### gallery content ###
                items: @json($items),
                galleryMosaic: [                       // default layout
                    {w: 2, h: 2, c: 1, r: 1},
                    {w: 1, h: 1, c: 3, r: 1},
                    {w: 1, h: 1, c: 3, r: 2},
                    {w: 1, h: 2, c: 4, r: 1},
                    {w: 2, h: 1, c: 5, r: 1},
                    {w: 2, h: 2, c: 5, r: 2},
                    {w: 1, h: 1, c: 4, r: 3},
                    {w: 2, h: 1, c: 2, r: 3},
                    {w: 1, h: 2, c: 1, r: 3},
                    {w: 1, h: 1, c: 2, r: 4},
                    {w: 2, h: 1, c: 3, r: 4},
                    {w: 1, h: 1, c: 5, r: 4},
                    {w: 1, h: 1, c: 6, r: 4}
                ],
                galleryMosaicXS: [                     // layout for XS width
                    {w: 2, h: 2, c: 1, r: 1},
                    {w: 1, h: 1, c: 3, r: 1},
                    {w: 1, h: 1, c: 3, r: 2},
                    {w: 1, h: 2, c: 1, r: 3},
                    {w: 2, h: 1, c: 2, r: 3},
                    {w: 1, h: 1, c: 2, r: 4},
                    {w: 1, h: 1, c: 3, r: 4}
                ],
                galleryMosaicSM: [                     // layout for SM width
                    {w: 2, h: 2, c: 1, r: 1},
                    {w: 1, h: 1, c: 3, r: 1},
                    {w: 1, h: 1, c: 3, r: 2},
                    {w: 1, h: 2, c: 1, r: 3},
                    {w: 2, h: 1, c: 2, r: 3},
                    {w: 1, h: 1, c: 2, r: 4},
                    {w: 1, h: 1, c: 3, r: 4}
                ],
                galleryMaxRows: 1,
                galleryDisplayMode: 'rows',
                gallerySorting: 'random',
                thumbnailDisplayOrder: 'random',

                thumbnailHeight: '180', thumbnailWidth: '220',
                thumbnailAlignment: 'scaled',
                thumbnailGutterWidth: 0, thumbnailGutterHeight: 0,
                thumbnailBorderHorizontal: 0, thumbnailBorderVertical: 0,

                thumbnailToolbarImage: null,
                thumbnailToolbarAlbum: null,
                thumbnailLabel: {display: false},

                // DISPLAY ANIMATION
                // for gallery
                galleryDisplayTransitionDuration: 1500,
                // for thumbnails
                thumbnailDisplayTransition: 'imageSlideUp',
                thumbnailDisplayTransitionDuration: 1200,
                thumbnailDisplayTransitionEasing: 'easeInOutQuint',
                thumbnailDisplayInterval: 60,

                // THUMBNAIL HOVER ANIMATION
                thumbnailBuildInit2: 'image_scale_1.15',
                thumbnailHoverEffect2: 'thumbnail_scale_1.00_1.05_300|image_scale_1.15_1.00',
                touchAnimation: true,
                touchAutoOpenDelay: 500,

                // LIGHTBOX
                viewerToolbar: {display: false},
                viewerTools: {
                    topLeft: 'label',
                    topRight: 'shareButton, rotateLeft, rotateRight, fullscreenButton, closeButton'
                },

                // GALLERY THEME
                galleryTheme: {
                    thumbnail: {background: '#111'},
                },

                // DEEP LINKING
                locationHash: true
            });
        });
    </script>
@endpush
