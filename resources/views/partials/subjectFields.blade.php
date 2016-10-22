<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="subjectName">Subject's Name</label>
    <input type="text" name="subject_name" class="form-control" id="subjectName" placeholder="Enter subject name" value="{{ isset($subject) ? $subject->subject_name : '' }}">
</div>
<div class="form-group">
    <label for="subjectLogo">Subject's logo</label>
    <input type="file" name="subject_logo" class="form-control" id="subjectLogo">
</div>
<button type="submit" class="btn btn-primary">{{ isset($subject) ? 'Edit subject' : 'Add subject' }}</button>