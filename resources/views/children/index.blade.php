@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Children</h1>
    <a href="{{ route('children.create') }}" class="btn btn-success mb-3">Add Child</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Group</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($children as $child)
                <tr>
                    <td>{{ $child->id }}</td>
                    <td>{{ $child->last_name . ', ' . $child->first_name }}</td>
                    <td>{{ $child->dob }}</td>
                    <td>{{ $child->gender }}</td>
                    <td>{{ $child->group->name }}</td>
                    <td>
                        <a href="{{ action(
                                    [App\Http\Controllers\ChildController::class, 'show'],
                                    ['child' => $child->id]
                                ) }}">View</a>

                        <a href="{{ action([App\Http\Controllers\ChildController::class, 'edit'],
                        ['child' => $child->id]
                        ) }}">Edit</a>
                        <a>Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $children->links('pagination::bootstrap-4') }}
</div>
@endsection('content')
