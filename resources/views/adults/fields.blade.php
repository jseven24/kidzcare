<div class="form-group">
    <label>First name</label>
    <input class="form-control" type="text" name="first_name"
    value="{{ $adult->first_name ?? '' }}" />
</div>
<div class="form-group">
    <label>Last name</label>
    <input class="form-control" type="text" name="last_name"
    value="{{ $adult->last_name ?? '' }}" />
</div>
<div class="form-group">
    <label>Phone</label>
    <input class="form-control" type="text" name="phone"
    value="{{ $adult->phone ?? '' }}" />
</div>
<div class="form-group">
    <label>Email</label>
    <input class="form-control" type="text" name="email"
    value="{{ $adult->email ?? '' }}" />
</div>
<div class="form-group">
    <label>Address</label>
    <input class="form-control" type="text" name="address"
    value="{{ $adult->address ?? '' }}" />
</div>

