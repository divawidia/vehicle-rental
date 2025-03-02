<x-admin.modals.form id="addVehicleModal" formId="formAddVehicle" title="Tambah Kendaraan" :editForm="false" size="lg">
    <x-admin.forms.input type="text" name="vehicle_name" label="Nama Kendaraan" :modal="true"/>
    <div class="row">
        <div class="col-6">
            <x-forms.basic-input type="time" name="startTime" label="Match Start Time" placeholder="Input match start time ..." :modal="true"/>
        </div>
        <div class="col-6">
            <x-forms.basic-input type="time" name="endTime" label="Match End Time" placeholder="Input match end time ..." :modal="true"/>
        </div>
    </div>
    <x-forms.basic-input type="text" name="place" label="Match Venue" placeholder="Input match venue ..." :modal="true"/>
</x-admin.modals.form>

@push('addon-script')
    <script>
        $(document).ready(function (){
            const formId = '#formAddMatch';
            const modalId = '#addMatchModal';

            $('#add-match-btn').on('click', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('team-managements.all-teams') }}",
                    type: 'GET',
                    success: function(res) {
                        $(modalId).modal('show');
                        clearModalFormValidation(formId)
                        $(formId+' #homeTeamId').html('<option disabled selected>Select home team in this match</option>');
                        $.each(res.data, function (key, value) {
                            {{--$(formId+' #teamId').append('<option value=' + value.id + ' data-avatar-src={{ Storage::url('') }}'+value.logo+'>' + value.teamName + '</option>');--}}
                            $(formId+' #homeTeamId').append('<option value=' + value.id + '>' + value.teamName + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong when retrieving data!",
                            text: errorThrown,
                        });
                    }
                });
            });

            @if($competition->isInternal == 1)
            $(formId+' #homeTeamId').on('change', function () {
                const id = this.value;
                $.ajax({
                    url: "{{route('team-managements.all-teams') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        exceptTeamId: id
                    },
                    success: function (result) {
                        $(formId+' #awayTeamId').html('<option disabled selected>Select away team in this match</option>');
                        $.each(result.data, function (key, value) {
                            {{--$(formId+' #opponentTeamId').append('<option value=' + value.id + ' data-avatar-src={{ Storage::url('') }}'+value.logo+'>' + value.teamName + '</option>');--}}
                            $(formId+' #awayTeamId').append('<option value=' + value.id + '>' + value.teamName + '</option>');
                        });
                    }
                });
            });
            @endif

            processModalForm(formId, "{{ route('competition-managements.store-match', $competition->hash) }}", null, modalId);
        });
    </script>
@endpush
