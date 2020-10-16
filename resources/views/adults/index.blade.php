@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center">Adults</h1>
    <a href="{{ action([App\Http\Controllers\AdultController::class, 'create']) }}" class="btn btn-success mb-3">Add Adult</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Role Id</th>
                <th>Actions<th>
            </tr>
        </thead>
        <tbody>
            @foreach($adults as $adult)
                <tr>
                    <td>{{ $adult->id }}</td>
                    <td>{{ $adult->last_name . ', ' . $adult->first_name }}</td>
                    <td>{{ $adult->phone }}</td>
                    <td>{{ $adult->email }}</td>
                    <td>
                    @if($adult->adult_role_id === 1)
                        {{ centsToDollars($adult->account->balance)}}
                    @else
                        <span>None</span>
                    @endif
                    </td>
                    <td>{{ $adult->adultRole->name }}</td>
                    <td>
                        <a href="{{ action([App\Http\Controllers\AdultController::class, 'show'],
                                    ['adult' => $adult->id]
                                ) }}">View</a>
                        <a href="{{ action([App\Http\Controllers\AdultController::class, 'edit'],
                                ['adult' => $adult->id]
                        ) }}">Edit</a>
                        <a>Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $adults->links('pagination::bootstrap-4') }}
    </div>
@endsection('content')
