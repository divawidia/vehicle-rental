<div class="table-responsive">
    <table class="table table-hover w-100" id="{{ $tableId }}">
        <thead>
        <tr>
            @foreach ($headers as $header)
                <th class="text-capitalize">{{ $header }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
