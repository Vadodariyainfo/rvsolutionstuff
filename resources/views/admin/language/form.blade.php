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
          <label>Image : <span class="text-danger">*</span></label>  
          {!! Form::file('image', array('class' => 'form-control')) !!}
          @error('image')
            <span class="text-danger">{{ $message }}</span>
          @enderror
		    </div>		
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-6">
  			<div class="form-group">
          <label>Description : <span class="text-danger">*</span></label>  
          {!! Form::textarea('description', old('description'), array('placeholder' => 'Enter Description','class' => 'form-control','rows'=>'3')) !!}
          @error('description')
              <span class="text-danger">{{ $message }}</span>
          @enderror
		    </div>		
  		</div>
  		<div class="col-md-6">
  			<div class="form-group">
          <label>Meta Title : <span class="text-danger">*</span></label>  
          {!! Form::textarea('meta_title', old('meta_title'), array('placeholder' => 'Enter Meta Keywords','class' => 'form-control','rows'=>'3')) !!}
          @error('meta_title')
            <span class="text-danger">{{ $message }}</span>
          @enderror
		    </div>		
  		</div>
  	</div>   
    <div class="row">
      <div class="col-md-6">
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
<a href="{{ route('languages.index') }}" class="btn btn-danger btn-flat" style="width:77px;">Back</a>
<button type="submit" class="btn btn-success btn-flat">Submit</button>
</div>