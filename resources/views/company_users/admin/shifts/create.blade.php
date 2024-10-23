@extends('layouts.company_users.companyDashboardLayout')
@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)
@section('content')
@section('content')
    <div class="container">
        <h1>Add Shift</h1>
        <form action="{{ route('shifts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="shift_type">Shift Type</label>
                <select id="shift_type" name="shift_type" class="form-control" required>
                    <option value="General">General</option>
                    <option value="Liberal">Liberal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="shift_name">Shift Name</label>
                <input type="text" name="shift_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="shift_start_time">Start Time</label>
                <input type="time" name="shift_start_time" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="shift_end_time">End Time</label>
                <input type="time" name="shift_end_time" class="form-control" required>
            </div>
            <div class="form-group" id="liberal_hrs_container" style="display:none;">
                <label for="shift_liberal_hrs">Liberal Hours</label>
                <input type="number" name="shift_liberal_hrs" id="shift_liberal_hrs" class="form-control" step="0.01"
                    min="0" max="24">

            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('assets/js/shifts/shifts_create.js') }}"></script>
@endsection
