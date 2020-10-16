
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Child</h1>
         @if(!empty($adult))
            <h2> For {{ $adult->first_name . ' ' . $adult->last_name }}</h2>
         @endif
        <hr />
        <form method="POST" action="{{ route('children.store') }}" enctype="multipart/form-data">
            <input type="hidden" value="{{ $adult->id }}" name="adult_id" />
            @include('children.fields')
            <input type="submit" value="Create" class="btn btn-success" />
            @csrf
        </form>
    </div>
@endsection(content)
