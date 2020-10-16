@extends('layouts.app')
@section('content')

<div class="container">
    <h1 class="text-center">Edit Child</h1>
    <form method="POST" action="{{ route('children.update', [$child]) }}" enctype="multipart/form-data">
        @method('PUT')
        <div class="form-group">
            <label for="">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ $child->first_name ?? '' }}" />
        </div>
        <div class="form-group">
            <label for="">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ $child->last_name ?? '' }}" />
        </div>
        <div class="form-group">
            <label for="">DOB</label>
            <input type="text" name="dob" class="form-control" value="{{ $child->dob ?? '' }}" />
        </div>
        <div class="form-group">
            <label for="">Gender</label>
            <input type="text" name="gender" class="form-control" value="{{ $child->gender ?? '' }}" />
        </div>
        <div class="form-group">
            <label for="">Group</label>
            <select class="form-control" name="group_id">
                @foreach($groups as $group_id => $group_name)
                    <option value="{{ $group_id }}" {{ (isset($child->group_id) && ($group_id === $child->group_id )) ? 'selected' : '' }} > {{ $group_name }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Rate</label>
            <input type="text" name="rate" class="form-control" value="{{ $child->rate ?? '' }}" />
        </div>
        <div class="form-group">
            <label>Allergies?</label>
            <div class="form-check">
                <input type="radio" name="is_allergic" class="form-check-input" value="0" {{ (isset($child->is_allergic) && (!$child->is_allergic)) ? 'checked' : '' }} />
                <label for="" class="form-check-label">No</label>
            </div>
            <div class="form-check">
                <input type="radio" name="is_allergic" class="form-check-input" value="1" {{ (isset($child->is_allergic) && ($child->is_allergic)) ? 'checked' : '' }} />
                <label for="" class="form-check-label">Yes</label>
            </div>
        </div>
        <div class="form-group">
            <label>Notes</label>
            <textarea class="form-control" name="notes" rows="4" value="{{ $child->notes ?? '' }}" ></textarea>
        </div>
        <div class="form-group">
            @if(!empty($child->picture))
               <p> <img src="@php echo \Illuminate\Support\Facades\Storage::url($child->picture) @endphp" style="max-width:50px" /></p>
               <label>Replace image</label>
            @else
                <label>Add Image</label>
            @endif
            <input type="file" class="form-control-file" name="picture" />
        </div>
        <input type="submit" value="Save" class="btn btn-success" />
        @csrf
    </form>
</div>
@endsection('comtent')
