@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Account Dashboard</h1>
    @if(!empty($children))
        <user-home-component :initial-children="{{ $children }}" :account-holder="{{ $account_holder }}">
        </user-home-component>
    @else
        <h4>There are no children linked to your account</h4>
        <h5>Link a child</h5>
        <form method="POST" action="{{ route('link.store') }}">

            <div class="form-group">
                <label>Child's code (given to you by the child's care facility)</label>
                <input type="text" name="code" class="form-control">
            </div>
            <div class="form-group">
                <label>Child's first name</label>
                <input type="text" name="first_name" class="form-control">
            </div>
            <div class="form-group">
                <label>Child's last name</label>
                <input type="text" name="last_name" class="form-control">
            </div>
            <div class="form-group">
                <label>Child's date of birth</label>
                <input type="text" name="dob" class="form-control">
            </div>
            <input type="submit" value="Add child" class="btn btn-success">
            @csrf
        </form>

        @if(session()->has('child_linked'))
        <div class="alert {{ (session()->get('child_linked')['success']) ?  ' alert-success' : ' alert-danger' }}">
            {{ session()->get('child_linked')['msg'] }}
        </div>
    @endif
    @endif

</div>
@endsection
