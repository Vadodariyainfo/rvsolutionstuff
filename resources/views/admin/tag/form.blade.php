<div class="box-body">
  <div class="row">    
    <div class="col-md-6">
      <div class="form-group">
      <label>Tag : <span class="text-danger">*</span></label>  
        {!! Form::text('tag', old('tag'), array('placeholder' => 'Enter Tag','class' => 'form-control')) !!}
        @error('tag')
                <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>    
    </div>
    <div class="col-md-6">
      <div class="form-group">
      <label>Slug : <span class="text-danger">*</span></label>  
        {!! Form::text('slug', old('slug'), array('placeholder' => 'Enter Slug','class' => 'form-control')) !!}
        @error('slug')
                <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>    
    </div>
    <div class="col-md-12">
      <div class="form-group">
      <label>Meta Description : <span class="text-danger">*</span></label>
      {!! Form::textarea('meta_description', old('meta_description'), array('placeholder' => 'Enter Meta Description','class' => 'form-control','rows'=>'3')) !!}
        @error('meta_description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>    
    </div>
  </div>
</div>
<!-- /.box-body -->
<div class="box-footer text-center">
<a href="{{ route('tags.index') }}" class="btn btn-danger btn-flat" style="width:77px;">Back</a>
<button type="submit" class="btn btn-info btn-flat">Submit</button>
</div>