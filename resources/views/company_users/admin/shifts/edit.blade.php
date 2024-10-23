@extends('layouts.company_users.companyDashboardLayout')

@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)

@section('content')
    <div class="container">
        <h1>Edit Shift</h1>
        <form action="{{ route('shifts.update', encrypt($shift->id)) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="shift_type">Shift Type</label>
                <select id="shift_type" name="shift_type" class="form-control" required>
                    <option value="General" {{ $shift->shift_type === 'General' ? 'selected' : '' }}>General</option>
                    <option value="Liberal" {{ $shift->shift_type === 'Liberal' ? 'selected' : '' }}>Liberal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="shift_name">Shift Name</label>
                <input type="text" name="shift_name" class="form-control" value="{{ $shift->shift_name }}" required>
            </div>
            <div class="form-group">
                <label for="shift_start_time">Start Time</label>
                <input type="time" name="shift_start_time" class="form-control" value="{{ $shift->shift_start_time }}"
                    required>
            </div>
            <div class="form-group">
                <label for="shift_end_time">End Time</label>
                <input type="time" name="shift_end_time" class="form-control" value="{{ $shift->shift_end_time }}"
                    required>
            </div>
            <div class="form-group" id="liberal_hrs_container"
                style="{{ $shift->shift_type === 'Liberal' ? '' : 'display:none;' }}">
                <label for="shift_liberal_hrs">Liberal Hours</label>
                <input type="number" name="shift_liberal_hrs" id="shift_liberal_hrs" class="form-control"
                    value="{{ $shift->shift_liberal_hrs }}" step="0.01" min="0" max="24">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('assets/js/shifts/shifts_edit.js') }}"></script>
@endsection
