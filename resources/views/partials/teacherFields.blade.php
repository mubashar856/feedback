<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="teacherName">Teacher's Name</label>
    <input type="text" name="teacher_name" class="form-control" id="teacherName" placeholder="Enter teacher name" value="{{ isset($teacher)? $teacher->teacher_name:'' }}">
</div>
<div class="form-group">
    <label for="teacherEmail">Teacher's Email</label>
    <input type="email" name="teacher_email" class="form-control" id="teacherEmail" placeholder="Enter teacher email address" value="{{ isset($teacher)? $teacher->teacher_email:'' }}">
</div>
<div class="form-group">
    <label for="teacherDepartment">Teacher's Department</label>
    <select name="department_id" class="form-control" id="teacherDepartment">
        @if(isset($teacher))
            <option value="{{ $teacher->department->id }}">{{ $teacher->department->department_name }}</option>
        @endif
        @if(count($departments))
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->department_name }}</option>
            @endforeach
        @else
            <option value="0">No department found</option>
        @endif
    </select>
</div>
<div class="form-group">
    <label for="teacherPicture">Teacher's Picture</label>
    <input type="file" name="teacher_picture" class="form-control" id="teacherPicture">
</div>
<div class="form-group">
    <label for="teacherInformation">Teacher's Information</label>
    <textarea name="teacher_information" class="form-control" rows="3" id="teacherInformation">{{ isset($teacher)?$teacher->teacher_information:'' }}</textarea>
</div>
<button type="submit" class="btn btn-primary">{{ isset($teacher)?'Edit teacher':'Add teacher' }}</button>