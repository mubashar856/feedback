<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="departmentName">Department's Name</label>
    <input type="text" name="department_name" class="form-control" id="departmentName" placeholder="Enter department name" value="{{ isset($department) ? $department->department_name : '' }}">
</div>
<div class="form-group">
    <label for="departmentLogo">Department's logo</label>
    <input type="file" name="department_logo" class="form-control" id="departmentLogo">
</div>
<button type="submit" class="btn btn-primary">{{ isset($department)? 'Edit department' : 'Add department' }}</button>