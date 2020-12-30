@extends('layouts.app')

@section('content')
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h4>New Post</h4>
                </div>

                <div class="card-body">
                
                    <form action="/p/" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="caption" class="col-md-4 col-form-label text-md-right"><strong>Caption</strong></label>
                            
                            <div class="col-md-6">
                                <textarea type="caption" id="caption" name="caption" 
                                        autocomplete="caption"  cols="30" rows="3" placeholder="Write a caption..."
                                        class="form-control @error('caption') is-invalid @enderror"
                                >{{ old('caption') }}</textarea>

                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                
                            <label for="image" class="col-md-4 col-form-label text-md-right"><strong>Photo</strong></label> 

                            <div class="col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="image" onchange="preview_image(event)">  
                                    <label class="custom-file-label" for="image">{{ old('image') ?? "Select Photo..." }}</label> 
                                    <div style ="padding-top:20px">
                                    <img id="output_image" style="width:200px; height:100px"/>
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            
                        <div class="form-group row mb-0" style = "margin-top:50px">
                            <div class="col-md-6 offset-md-4">
                                <button  type="submit" class="btn btn-primary">
                                    Share
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection
