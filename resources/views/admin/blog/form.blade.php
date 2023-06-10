<div class="row">
	<div class="col-md-6">
		<div class="form-group">
      <label>Blog Category : <span class="text-danger">*</span></label>
      @if(isset($blog) && !empty($blog))
        <select name="blog_category_id[]" multiple="multiple" class="form-control">
          @foreach($blogCategoryList as $key => $value)
            <option value="{{ $key }}" {{ in_array ( $key, $blogCategoryConnect) ? 'selected' : '' }}>{{ $value }}</option>
          @endforeach
        </select>
      @else
        {!! Form::select('blog_category_id[]',$blogCategoryList, old('blog_category_id'), array('class' => 'form-control','multiple'=>'multiple')) !!}
      @endif
      @error('blog_category_id')
          <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>		
	</div>
	<div class="col-md-6">
		<div class="form-group">
      <label>Title : <span class="text-danger">*</span></label>
      {!! Form::text('title', old('title'), array('placeholder' => 'Enter Title','class' => 'form-control')) !!}
      @error('title')
          <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>		
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
      <?php
        if(isset($blog)){
            $body = str_replace('&lt;', '&amp;lt;', $blog->body);
            $blog->body = str_replace('&gt;', '&amp;gt;', $body);
        }
      ?>
      <label>Body : <span class="text-danger">*</span></label>
      {!! Form::textarea('body', isset($blog->body) ? $blog->body:old('body'), array('placeholder' => 'Enter Body','class' => 'form-control','rows'=>'10')) !!}
      @error('body')
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
      <label>Featured Image:</label>
      <input type="file" name="image" placeholder="Enter Image" class="form-control">
      <!-- {!! Form::file('image', old('image'), array('placeholder' => 'Enter Image Path','class' => 'form-control','rows'=>'3')) !!} -->
      @error('image')
          <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>		
	</div>
</div>

<div class="row">
<!--   @if(Auth::user()->is_admin == 1)
  <div class="col-md-3">
    <div class="form-group">
      <label for="">Is Featured:</label><br>
       @if(isset($blog) && $blog->is_featured == 1)
        <input class="form-control" name="is_featured" data-id="" data-size="mini" data-value="1" type="checkbox" data-on="Yes" name="is_default" data-off="No" data-onstyle="success" data-offstyle="danger" checked data-toggle="toggle">
      @else
        <input class="form-control" name="is_featured" data-id="" data-size="mini" data-value="1" type="checkbox" data-on="Yes" name="is_default" data-off="No" data-onstyle="success" data-offstyle="danger" data-toggle="toggle">
      @endif
    </div>
  </div>
  @endif -->
  @if(auth()->user()->is_admin != 0)
	<div class="col-md-3">
		<div class="form-group">
          @if(isset($blog))
  		          <label>Publish :</label><br>
                <input type="checkbox" name="is_publish" data-size="large" data-toggle="toggle" data-id="" class="active-btn onoffswitch-checkbox is-publish" data-on="Yes" data-off="No" data-onstyle="info" data-offstyle="danger" {{ $blog->is_publish == 1 || old('is_publish') ? 'checked' : '' }}>
          @else
            <label>Publish :</label><br>
		        <input type="checkbox" name="is_publish" data-size="large" data-toggle="toggle" data-id="" class="active-btn onoffswitch-checkbox is-publish" data-on="Yes" data-off="No" data-onstyle="info" data-offstyle="danger" @if(old('is_publish') == 'on') checked @elseif($errors->has('publish_date')) '' @else checked @endif>
          @endif
	    </div>		
	</div>
    <div class="col-md-6 {{ old('publish_date') || $errors->has('publish_date') || (isset($blog) && $blog->is_publish == 0) ? 'display-block' : 'display-none' }} publish-date">
      <div class="form-group">
          @if(isset($blog))
              <label>Publish Date :</label>
              {!! Form::text('publish_date', isset($blog) && !empty($blog->publish_date) ? \Carbon\Carbon::createFromFormat('Y-m-d', $blog->publish_date)->format('m/d/Y') : null, array('placeholder' => 'Enter Publish Date','class' => 'form-control publish-date-input', 'id' => 'datepicker')) !!}
          @else
            <label>Publish Date :</label>
            {!! Form::text('publish_date', isset($blog) && !empty($blog->publish_date) ? \Carbon\Carbon::createFromFormat('Y-m-d', $blog->publish_date)->format('m/d/Y') : null, array('placeholder' => 'Enter Publish Date','class' => 'form-control publish-date-input', 'id' => 'datepicker')) !!}
          @endif
          @error('publish_date')
            <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>    
    </div>
  @endif
</div>
@if(isset($blog->image))
<div class="row">
  <div class="col-md-6">
    <img src="{!! !empty($blog->image) ? route('image.asset.storage.file',['folder' => 'blog', 'file' => $blog->image]) : asset('/blog/default/default.png') !!}" class="img-thumbnail" style="height: 300px; width: 400px;">
  </div>
</div>
@endif
<div class="row">
	<div class="col-md-12 text-center">
    <a href="{{ route('blogs.index') }}" class="btn btn-danger btn-flat" style="width:77px;">Back</a>
		<button type="submit" class="btn btn-success btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Submit">Submit</button>
	</div>
</div>


<!-- The Modal -->
<div class="modal" id="infoModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4>Blog Style Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <tr>
            <th>Code Box</th>
            <td>
            &lt;pre class="prettyprint"&gt;<br>
              --Code--<br>
            &lt;/pre&gt;
            </td>
          </tr>
          <tr>
            <th>Step Box</th>
            <td>
              &lt;strong class="step"&gt;<br>
                --step title --<br>
              &lt;/strong&gt;
            </td>
          </tr>
          <tr>
            <th>Image Display Path & Class</th>
            <td>&lt;img src="https://rvsolutionstuff.com/image/asset/file/blog/your-image-name" class="blog-article"&gt; </td>
          </tr>
           <tr>
            <th>Phone View</th>
            <td>&lt;div class="smartphone"&gt;<br> ---your content--- <br>&lt;/div&gt;</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>