@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />
                <form action="{{ route('admin.updatedmsession', $dms->id) }}" method="post" style="margin-left: 10px;"
                    enctype="multipart/form-data">
                    @csrf
                    <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Edit DM Session</p>
                    <div class="card" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">

                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">
                            <div class="col-lg-12 col-sm-12">

                                <div class="mb-3">
                                    <label for="ex_id" class="form-label">Expert Name
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="ex_id" required>
                                        <option value="{{ $dms->ex_id }}">
                                            @foreach ($expert as $exn)
                                                @if ($dms->ex_id == $exn->id)
                                                    {{ $exn->name }}
                                                @endif
                                            @endforeach
                                        </option>
                                        @foreach ($expert as $ex)
                                            <option value="{{ $ex->id }}">{{ $ex->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="date" placeholder="dd-mm-yyyy" class="form-control"
                                        value="{{ $dms->date }}" id="date" style="font-size:14px;color:#95949E;"
                                        required>
                                </div>
                                {{--  @php
                                    $mode = ['Online', 'Offline'];
                                @endphp
                                <div class="mb-3">
                                    <label for="mode" class="form-label">Mode
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="mode" id="modeSelect" required>
                                        <option value="{{ $dms->mode }}">{{ $dms->mode }}</option>
                                        @foreach ($mode as $single)
                                            @if ($single !== $dms->mode)
                                                <option value="{{ $single }}">{{ $single }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>  --}}
                                @php
                                    $mode = ['Online', 'Offline'];
                                @endphp
                                <div class="mb-3">
                                    <label for="mode" class="form-label">Mode
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select class="form-control" name="mode" id="modeSelect" required>
                                        <option value="{{ $dms->mode }}">{{ $dms->mode }}</option>
                                        @foreach ($mode as $single)
                                            @if ($single !== $dms->mode)
                                                <option value="{{ $single }}">{{ $single }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                {{--  <div class="mb-3" id="venueInput" style="display:none;">
                                    <label for="venue" class="form-label">Venue
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="venue" value="{{ $dms->venue }}"
                                        placeholder="Enter Venue" class="form-control" id="venue"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>  --}}
                                <div class="mb-3" id="venueInput" style="display:none;">
                                    <label for="venue" class="form-label">Venue
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="venue" value="{{ $dms->venue }}"
                                        placeholder="Enter Venue" class="form-control" id="venue"
                                        style="font-size:14px;color:#95949E;">
                                </div>
                                @php
                                    $times = json_decode($dms->time);
                                    //print_r($times);
                                @endphp
                                <div class="mb-3">
                                    <label for="time" class="form-label">Time
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <div class="row">
                                        @foreach ($dmtimeslot as $dmts)
                                            <div class="col-4">
                                                <input type="checkbox" name="time[]"
                                                    value="{{ $dmts->slot }}"{{ in_array($dmts->slot, $times) ? 'checked' : '' }}
                                                    style="margin-left:5px; transform: scale(1.5);"> {{ $dmts->slot }}
                                            </div>
                                        @endforeach
                                        {{--  <div class="col-4">
                                            <input type="checkbox" name="time[]"
                                                value=" 09:45 am to 10:30 am"{{ in_array('09:45 am to 10:30 am', $times) ? 'checked' : '' }}
                                                style="margin-left:5px; transform: scale(1.5);"> 09:45 am to 10:30 am
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" name="time[]"
                                                value=" 10:30 am to 11:15 am "{{ in_array('10:30 am to 11:15 am', $times) ? 'checked' : '' }}
                                                style="margin-left:5px; transform: scale(1.5);">
                                            10:30 am to 11:15 am
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" name="time[]"
                                                value="11:15 am to 12:00 pm "{{ in_array('11:15 am to 12:00 pm', $times) ? 'checked' : '' }}
                                                style="margin-left:5px; transform: scale(1.5);">
                                            11:15 am to 12:00 pm
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" name="time[]" value=" 12:00 pm to 12:45 pm "
                                                {{ in_array('12:00 pm to 12:45 pm', $times) ? 'checked' : '' }}
                                                style="margin-left:5px; transform: scale(1.5);">
                                            12:00 pm to 12:45 pm
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" name="time[]"
                                                value=" 12:45 pm to 01:30 pm "{{ in_array('12:45 pm to 01:30 pm', $times) ? 'checked' : '' }}
                                                style="margin-left:5px; transform: scale(1.5);">
                                            12:45 pm to 01:30 pm
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" name="time[]"
                                                value="01:30 pm to 02:15 pm "{{ in_array('01:30 pm to 02:15 pm', $times) ? 'checked' : '' }}
                                                style="margin-left:5px; transform: scale(1.5);">
                                            01:30 pm to 02:15 pm
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" name="time[]"
                                                value=" 02:15 pm to 03:00 pm "{{ in_array('02:15 pm to 03:00 pm', $times) ? 'checked' : '' }}
                                                style="margin-left:5px; transform: scale(1.5);">
                                            02:15 pm to 03:00 pm
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" name="time[]"
                                                value=" 03:00 pm to 03:45 pm "{{ in_array('03:00 pm to 03:45 pm', $times) ? 'checked' : '' }}
                                                style="margin-left:5px; transform: scale(1.5);">
                                            03:00 pm to 03:45 pm
                                        </div>  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text text-center mt-4">
                        <button type="submit" style="background:#EEC714;width: 160px;border-radius:10px; border:none;">
                            <p style="font-family: Rubik;font-size: 38px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                Update</p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function toggleVenueInput() {
            var modeSelect = document.getElementById('modeSelect');
            var venueInputDiv = document.getElementById('venueInput');
            var venueInput = document.getElementById('venue');

            if (modeSelect.value === 'Offline') {
                venueInputDiv.style.display = 'block';
                venueInput.setAttribute('required', 'required');
            } else {
                venueInputDiv.style.display = 'none';
                venueInput.removeAttribute('required');
                venueInput.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleVenueInput(); // Run on page load to set initial state

            document.getElementById('modeSelect').addEventListener('change', function() {
                toggleVenueInput(); // Handle changes dynamically
            });
        });
    </script>
@endsection
