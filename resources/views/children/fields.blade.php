
            <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="first_name" class="form-control"  />
            </div>
            <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="last_name" class="form-control"  />
            </div>
            <div class="form-group">
                <label for="">DOB</label>
                <input type="text" name="dob" class="form-control"  />
            </div>
            <div class="form-group">
                <label for="">Gender</label>
                <input type="text" name="gender" class="form-control"  />
            </div>
            <div class="form-group">
                <label for="">Group</label>
                <select class="form-control" name="group_id">
                    @foreach($groups as $group_id => $group_name)
                        <option value="{{ $group_id }}" > {{ $group_name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Rate</label>
                <input type="text" name="rate" class="form-control"  />
            </div>
            <div class="form-group">
                <label>Allergies?</label>
                <div class="form-check">
                    <input type="radio" name="is_allergic" class="form-check-input" value="0" checked />
                    <label for="" class="form-check-label">No</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="is_allergic" class="form-check-input" value="1" />
                    <label for="" class="form-check-label">Yes</label>
                </div>
            </div>
            <div class="form-group">
                <label>Notes</label>
                <textarea class="form-control" name="notes" rows="4"  ></textarea>
            </div>
            <div class="form-group">
                <label>Upload Image</label>
                <input type="file" class="form-control-file" name="picture" />
            </div>
