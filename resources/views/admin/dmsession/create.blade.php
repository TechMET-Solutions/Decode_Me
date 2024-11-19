@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />
                <form action="{{ route('admin.storedmsession') }}" method="post" style="margin-left: 10px;"
                    enctype="multipart/form-data">
                    @csrf
                    <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Add DM Session</p>
                    <div class="card" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">

                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">
                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="date" placeholder="dd-mm-yyyy" class="form-control"
                                        id="date" style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ex_id" class="form-label">Expert Name
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="ex_id" id="ex_id" required>
                                        <option value="">Select Expert</option>
                                        @foreach ($expert as $ex)
                                            <option value="{{ $ex->id }}">{{ $ex->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @php
                                    $mode = ['Online', 'Offline'];
                                @endphp
                                <div class="mb-3">
                                    <label for="mode" class="form-label">Mode
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="mode" id="modeSelect" required>
                                        <option value="">Select Mode</option>
                                        @foreach ($mode as $single)
                                            <option value="{{ $single }}">{{ $single }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3" id="venueInput" style="display:none;">
                                    <label for="venue" class="form-label">Venue
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="venue" id="venue" required>
                                        <option value="">Select Venue</option>
                                        @foreach ($venue as $v)
                                            <option value="{{ $v->venue }}">{{ $v->venue }}</option>
                                        @endforeach
                                    </select>
                                    {{--  <input type="text" name="venue" placeholder="Enter Venue" class="form-control"
                                        id="venue" style="font-size:14px;color:#95949E;" required>  --}}
                                </div>

                                <div class="mb-3">
                                    <label for="time" class="form-label">Time
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="row">
                                        @if (!is_null($dmtimeslot) && count($dmtimeslot) > 0)
                                            @foreach ($dmtimeslot as $dmts)
                                                <div class="col-4">
                                                    <input type="checkbox" name="time[]" value="{{ $dmts->slot }}"
                                                        style="margin-left:5px; transform: scale(1.5);">
                                                    {{ $dmts->slot }}
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-12">
                                                <p>No time slots available.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text text-center mt-4">
                        <button type="submit" style="background:#EEC714;width: 160px;border-radius:10px; border:none;">
                            <p style="font-family: Rubik;font-size: 38px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                Save</p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('modeSelect').addEventListener('change', function() {
            var venueInputDiv = document.getElementById('venueInput');
            var venueInput = document.getElementById('venue');

            if (this.value === 'Offline') {
                venueInputDiv.style.display = 'block';
                venueInput.setAttribute('required', 'required');
            } else {
                venueInputDiv.style.display = 'none';
                venueInput.removeAttribute('required');
            }
        });

        document.getElementById('date').addEventListener('change', function() {
            let selectedDate = this.value;
            let dmsessions = @json($dmsession);

            // Get the select element and all its options
            let expertSelect = document.getElementById('ex_id');
            let options = expertSelect.options;

            // Enable all options first
            for (let i = 0; i < options.length; i++) {
                options[i].style.display = 'block';
            }

            // Loop through the sessions and hide the experts already booked for the selected date
            dmsessions.forEach(session => {
                if (session.date === selectedDate) {
                    for (let i = 0; i < options.length; i++) {
                        if (options[i].value == session.ex_id) {
                            options[i].style.display = 'none';
                        }
                    }
                }
            });
        });

        document.getElementById('date').addEventListener('change', function() {
            let selectedDate = this.value;
            let dmsessions = @json($dmsession);

            // Get the select element and all its options
            let venueSelect = document.getElementById('venue');
            let options = venueSelect.options;

            // Enable all options first
            for (let i = 0; i < options.length; i++) {
                options[i].style.display = 'block';
            }

            // Loop through the sessions and hide the venues already booked for the selected date
            dmsessions.forEach(session => {
                if (session.date === selectedDate) {
                    for (let i = 0; i < options.length; i++) {
                        if (options[i].value == session.venue) {
                            options[i].style.display = 'none';
                        }
                    }
                }
            });

            // Show the venue dropdown if not already visible
            document.getElementById('venueInput').style.display = 'block';
        });
    </script>
@endsection
