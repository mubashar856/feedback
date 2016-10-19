@extends('admin.layout')


@section('title')
    admin | show semester
@endsection

@section('content')

    <table class="table table-bordered" style="background-color: #fff;">
        <thead>
            <tr>
                <th>
                    Semester Name
                </th>
                <th>
                    Semester Status
                </th>
                <th>
                    Change Status
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($semesters))
                @foreach($semesters as $semester)
                    <tr>
                        <td>{{ $semester->semester_name }}</td>
                        <td>
                            @if($semester->semester_status == '1')
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>
                            @if($semester->semester_status == '1')
                                <a href="/admin/semester/{{ $semester->id }}/new-status/0" class="btn btn-danger">Set as inactive</a>
                            @else
                                <a href="/admin/semester/{{ $semester->id }}/new-status/1" class="btn btn-success">Set as active</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <div class="alert alert-info">No semester added yet. <a href="/admin/semester/add">click here</a> to add one</div>
            @endif
        </tbody>
    </table>
@endsection