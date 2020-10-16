@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>{{ $adult->first_name . ' ' . $adult->last_name }}</h2>
            <table class="table">
                <tr>
                    <th>Contact Info</th>
                    <td>
                        <p>Email: {{ $adult->email }}</p>
                        <p>Phone: {{ $adult->phone }}</p>
                        <p>Address: {{ $adult->address }}</p>
                    </td>
                </tr>
                @if($adult->adult_role_id === 1)
                <tr>
                    <th>Current Balance</th>
                    <td>{{ centsToDollars($adult->account->balance) }}

                    </td>
                </tr>
                @endif
                <tr>
                    <th>Children</th>
                    <td>
                    @foreach($adult->children as $child)
                        <a href="{{ action([App\Http\Controllers\ChildController::class, 'show'],['child' => $child->id]) }}"> {{ $child->first_name . ' ' . $child->last_name }} </a>
                    @endforeach
                    </td>
                </tr>

            </table>


        </div>
        <div class="col-md-4">
            <img width="50px"  src="" />
        </div>
    </div>
    <a href="{{ action([App\Http\Controllers\AdultController::class, 'index']) }}" class="btn btn-dark">Back</a>
</div>
@endsection('content')
