@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Edit Adult </h1>
        <div class="row">
            <div class="col-lg-5">
                <h2>Contact</h2>

                <form method="POST" action="{{ route('adults.update', [$adult]) }}">
                    @method('PUT')
                    @include('adults.fields')
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" id ="role_id" name="adult_role_id">
                            @foreach($adult_roles as $role_id => $role_name)
                                <option value="{{ $role_id }}" {{( isset($role_id) && $role_id === $adult->adult_role_id) ? 'selected' : ''}} > {{ $role_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" value="Save" class="btn btn-success">
                    <a href="{{ route('adults.index') }}" class="btn btn-dark">Back</a>
                    @csrf
                </form>

            </div>
            <div class="col-lg-7">
                <div>
                    <h2 class="mt-3">Account</h2>
                    @if($adult->adult_role_id === 1)
                        <table class="table">
                            <tr>
                                <th>Current Balance</th>
                                <td>{{ centsToDollars($adult->account->balance) }}</td>
                            </tr>
                        </table>
                    @endif
                </div>
                <div>
                    <h2>Children</h2>
                    <ul class="list-group">
                        @foreach($adult->children as $child)
                            <li class="list-group-item"><a href="{{ action([App\Http\Controllers\ChildController::class, 'show'],['child' => $child->id]) }}"> {{ $child->first_name . ' ' . $child->last_name }} </a></li>
                        @endforeach
                        <li class="list-group-item">
                            <p class="mb-0">
                                <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> <i class="fa fa-plus"></i> Add child</a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                  <form method="POST" action="{{ route('children.store') }}" enctype="multipart/form-data">
                                    <input type="hidden" value="{{ $adult->id }}" name="adult_id" />
                                    @include('children.fields')
                                    <input type="submit" value="Add" class="btn btn-success" />
                                    @csrf
                                  </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
