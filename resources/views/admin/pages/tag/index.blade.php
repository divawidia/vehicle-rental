@extends('layouts.admin.master')
@section('title')
    Tag Blog
@endsection
@section('page-title')
    Tag Blog
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('status') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tag Artikel Blog</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{  route('tags.create') }}" class="btn btn-primary mb-3">
                            + Tambah Tag Baru
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="tagTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Tag</th>
                                    <th>Slug</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    @endsection
    @push('addon-script')
        <script>
            // AJAX DataTable
            var datatable = $('#tagTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'tag_name', name: 'tag_name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'user.name', name: 'user.name' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%'
                    },
                ]
            });
        </script>
    @endpush
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
