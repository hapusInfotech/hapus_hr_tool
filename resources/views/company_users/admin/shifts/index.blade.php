@extends('layouts.company_users.companyDashboardLayout')

@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)

@section('content')
    <div class="container">
        <h1>Shifts</h1>
        <a href="{{ route('shifts.create') }}" class="btn btn-primary">Add New Shift</a>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Shift Type</th>
                    <th>Shift Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Liberal Hours</th> {{-- New column for Liberal Hours --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shifts as $index => $shift)
                    <tr>
                        <td>{{ $index + 1 }}</td> {{-- Serial Number --}}
                        <td>{{ $shift->shift_type }}</td>
                        <td>{{ $shift->shift_name }}</td>
                        <td>{{ $shift->shift_start_time }}</td>
                        <td>{{ $shift->shift_end_time }}</td>
                        <td>
                            @if ($shift->shift_type === 'Liberal')
                                {{ $shift->shift_liberal_hrs ? $shift->shift_liberal_hrs . ' hours' : '-' }}
                                {{-- Display Liberal Hours or hyphen --}}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('shifts.edit', encrypt($shift->id)) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('shifts.destroy', encrypt($shift->id)) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
