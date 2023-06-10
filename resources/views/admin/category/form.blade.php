<div class="box-body">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
          <label>Name : <span class="text-danger">*</span></label>
          {!! Form::text('name', old('name'), array('placeholder' => 'Enter Name','class' => 'form-control')) !!}
          @error('name')
            <span class="text-danger">{{ $message }}</span>
          @enderror
	    </div>		
		</div>
		<div class="col-md-6">
			<div class="form-group">
      <label>Meta Description : <span class="text-danger">*</span></label>
      {!! Form::textarea('meta_description', old('meta_description'), array('placeholder' => 'Enter Meta Description','class' => 'form-control','rows'=>'3')) !!}
        @error('meta_description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
	    </div>		
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Category Image : <span class="text-danger">*</span></label>
				<input type="file" name="image" class="form-control" placeholder="Category Image">
				@error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
			</div>
		</div>
	</div>
</div>
<!-- /.box-body -->
<div class="box-footer text-center">
<a href="{{ route('categorys.index') }}" class="btn btn-danger btn-flat" style="width:77px;">Back</a>
<button type="submit" class="btn btn-success btn-flat">Submit</button>
</div>