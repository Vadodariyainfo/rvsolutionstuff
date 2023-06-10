<div class="box-body">
  	<div class="row">
  		<div class="col-md-6">
  			<div class="form-group">
      <label>Title : <span class="text-danger">*</span></label>
          {!! Form::text('title', old('title'), array('placeholder' => 'Enter Title','class' => 'form-control')) !!}
          @error('title')
              <span class="text-danger">{{ $message }}</span>
            @enderror
		    </div>		
  		</div>
  		<div class="col-md-6">
  			<div class="form-group">
      <label>Seo Title : <span class="text-danger">*</span></label>
        {!! Form::text('seo_title', old('seo_title'), array('placeholder' => 'Enter Seo Title','class' => 'form-control')) !!}
        @error('seo_title')
            <span class="text-danger">{{ $message }}</span>
          @enderror
		    </div>		
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-6">
  			<div class="form-group">
      <label>Content : <span class="text-danger">*</span></label>
        {!! Form::textarea('body', old('body'), array('placeholder' => 'Enter Content','class' => 'form-control','rows'=>'3')) !!}
        @error('body')
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
  		<div class="col-md-6">
  			<div class="form-group">
      <label>Meta Keywords : <span class="text-danger">*</span></label>
        {!! Form::textarea('meta_keywords', old('meta_keywords'), array('placeholder' => 'Enter Meta Keywords','class' => 'form-control','rows'=>'3')) !!}
        @error('meta_keywords')
            <span class="text-danger">{{ $message }}</span>
          @enderror
		    </div>		
  		</div>
  	</div>   
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
        <label>Body Html :</label>
        {!! Form::textarea('body_html', old('body_html'), array('placeholder' => 'Enter Body Html','class' => 'form-control','rows'=> 3)) !!}
        @error('body_html')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>    
      </div>
      <div class="col-md-6">
        <div class="form-group">
        <label>Body Css :</label>
        {!! Form::textarea('body_css', old('body_css'), array('placeholder' => 'Enter Body Css','class' => 'form-control','rows'=> 3)) !!}
        @error('body_css')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>    
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
        <label>Body Js :</label>
        {!! Form::textarea('body_js', old('body_js'), array('placeholder' => 'Enter Body js','class' => 'form-control','rows'=> 3)) !!}
        @error('body_js')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>    
      </div>
      @if(isset($posts))
      <div class="col-md-6">
        <div class="form-group">
              <label>Image</label>
            {!! Form::file('image',['class'=>'form-control']) !!}
          </div>    
      </div>
      @endif
    </div>
@if(isset($posts))
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
        <label>Upload Snippet Zip</label>
        {!! Form::file('uploadzip',['class'=>'form-control']) !!}
        @if($posts->is_download == 1)
          <span class="text-success">Zip Uploaded</span>
        @else
          Zip Not Uploaded
        @endif
      </div>    
  </div>
  <div class="col-md-6">
    <div class="form-group">
          <label>is_demo Check</label><br>
      {{ Form::checkbox('is_demo',$posts->is_demo,null,['class'=>'is-demo-checkbox']) }}
      </div>    
  </div>
</div>
@endif
</div>
<!-- /.box-body -->
<div class="box-footer text-center">
<a href="{{ route('users.index') }}" class="btn btn-danger btn-flat" style="width:77px;">Back</a>
<button type="submit" class="btn btn-success btn-flat">Submit</button>
</div>