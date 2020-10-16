@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center">New Registration</h1>
        <h2>Add primary account holder</h2>
        <form method="POST" action="{{ route('adults.store') }}">
            @include('adults.fields')
            <div class="form-group">
                <label>Role</label>
                <select class="form-control" id ="role_id" name="adult_role_id">
                    @foreach($adult_roles as $role_id => $role_name)
                        @if($role_id == 1)
                            <option value="{{ $role_id }}" selected> {{ $role_name }} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Create" class="btn btn-success" />
            @csrf
        </form>
    </div>
@endsection('content')
