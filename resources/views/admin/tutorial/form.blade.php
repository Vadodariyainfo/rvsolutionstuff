<div class="box-body">
  	<div class="row">
  		<div class="col-md-6">
  			<div class="form-group">
      <label>MLanguage : <span class="text-danger">*</span></label>
        {!! Form::select('language_id', [''=>'Select Language']+$language, null, array('class' => 'form-control')) !!}
        @error('language_id')
          <span class="text-danger">{{ $message }}</span>
        @enderror
		    </div>		
  		</div>
  		<div class="col-md-6">
  			<div class="form-group">
      <label>Topic Name : <span class="text-danger">*</span></label>
        {!! Form::text('topic_name', old('topic_name'), array('placeholder' => 'Enter Topic Name','class' => 'form-control')) !!}
        @error('topic_name')
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
      <label>Example Demo :</label>
        {!! Form::textarea('example_demo', old('example_demo'), array('placeholder' => 'Enter Example Demo','class' => 'form-control','rows'=>'3')) !!}
        @error('example_demo')
          <span class="text-danger">{{ $message }}</span>
        @enderror
		    </div>		
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-6">
  			<div class="form-group">
      <label>Html Code :</label>
        {!! Form::textarea('html_code', old('html_code'), array('placeholder' => 'Enter Html Code','class' => 'form-control','rows'=>'3')) !!}
        @error('html_code')
          <span class="text-danger">{{ $message }}</span>
        @enderror
		    </div>		
  		</div>
  		<div class="col-md-6">
  			<div class="form-group">
      <label>Css Code :</label>
        {!! Form::textarea('css_code', old('css_code'), array('placeholder' => 'Enter Css Demo','class' => 'form-control','rows'=>'3')) !!}
        @error('css_code')
          <span class="text-danger">{{ $message }}</span>
        @enderror
		    </div>		
  		</div>
  	</div>   
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
      <label>Js Code :</label>
        {!! Form::textarea('js_code', old('js_code'), array('placeholder' => 'Enter Js Code','class' => 'form-control','rows'=>'3')) !!}
        @error('js_code')
          <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>    
      </div>
      <div class="col-md-6">
        <div class="form-group">
       <label>Sort : <span class="text-danger">*</span></label>
        {!! Form::text('sort', old('sort'), array('placeholder' => 'Enter Sort','class' => 'form-control')) !!}
        @error('sort')
          <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>    
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
      <label>Meta Title : <span class="text-danger">*</span></label>
        {!! Form::text('meta_title', old('meta_title'), array('placeholder' => 'Enter Meta Title','class' => 'form-control')) !!}
        @error('meta_title')
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
    </div>
</div>
<!-- /.box-body -->
<div class="box-footer text-center">
<a href="{{ route('tutorials.index') }}" class="btn btn-danger btn-flat" style="width:77px;">Back</a>
<button type="submit" class="btn btn-success btn-flat">Submit</button>
</div>