@extends('layouts.app')
@php
    $sibligns =  $child->getSiblings($child->id, $account_holder->id);

    $account_holders = $contacts = array();

    foreach($child->adults as $adult){

        if($adult->adult_role_id === 1){
            array_push($account_holders, $adult);
        }elseif($adult->adult_role_id === 3){
            array_push($contacts, $adult);
        }
    }
@endphp

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img style="max-width: 300px"
                @if(!empty($child->picture))
                    src="@php echo \Illuminate\Support\Facades\Storage::url($child->picture) @endphp"
                @elseif($child->gender == 'm')
                    src="@php echo \Illuminate\Support\Facades\Storage::url('boy.jpg') @endphp"
                @else
                    src="@php echo \Illuminate\Support\Facades\Storage::url('girl.jpg') @endphp"
                @endif
            />
        </div>
        <div class="col-md-8">
            <h2>{{ $child->first_name . ' ' . $child->last_name }}
                <i class="fa fa-circle {{ ($child->is_active) ? 'text-success' : 'text-danger'}}"></i>
            </h2>
            <table class="table">
                <tr>
                    <th>Age</th>
                    <td>{{ $child->getAge($child->dob) }}</td>
                </tr>
                <tr>
                    <th>Date of birth</th>
                    <td>{{ $child->dob }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ ($child->gender == 'm') ? 'Male' : 'Female' }}</td>
                </tr>
                <tr>
                    <th>Group</th>
                    <td>{{ $child->group->name }}</td>
                </tr>
                <tr>
                    <th>Rate</th>
                    <td>{{ (!empty($child->rate)) ? centsToDollars($child->rate) : 0 }}</td>
                </tr>
                <tr>
                    <th>Member since</th>
                    <td>{{ $child->created_at }}</td>
                </tr>
                <tr>
                    <th>Allergies</th>
                    <td>{{ ($child->is_allergic) ? "Yes" : "No" }}</td>
                </tr>
                <tr>
                    <th>Notes</th>
                    <td>{{ $child->notes ?? '' }}</td>
                </tr>
                <tr>
                    <th>Account Holders</th>
                    <td>
                        @if(!empty($account_holders))
                            @foreach($account_holders as $account_holder)
                            <a href="{{ action([App\Http\Controllers\AdultController::class, 'show'],
                                                ['adult' => $account_holder->id]
                                        ) }}">
                            <span> {{ $account_holder->first_name . ' ' . $account_holder->last_name }}</span>
                            @endforeach
                        @else
                            <span>No account holders</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Emergency Contacts</th>
                    <td>
                        @if(!empty($contacts))
                            @foreach($contacts as $contact)
                            <span> {{ $contact->first_name . ' ' . $contact->last_name }}</span>
                            @endforeach
                        @else
                            <span>No contacts</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Siblign(s)</th>
                    <td>
                        @if($sibligns)
                            @foreach ($sibligns as $sibling)
                                <a href="{{ action([App\Http\Controllers\ChildController::class, 'show'],
                                                ['child' => $sibling->id]
                                        ) }}">
                                    {{$sibling->first_name  . ' ' . $sibling->last_name  }}
                                </a>
                            @endforeach
                        @else
                            <p>No Siblings</p>
                        @endif
                    </td>
                </tr>

            </table>

        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
</div>
@endsection('content')
