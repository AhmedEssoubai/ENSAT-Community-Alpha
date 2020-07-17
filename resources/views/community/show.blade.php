@extends('layouts.class')

@section('content-2')
<div class="container px-0">
    <div class="row">
        <div class="col-md-8">
            <div id="newPost">
                <div class="bg-white shadow-sm border mb-5 d-flex align-items-center p-4 div_link" onclick="openPostForm()">
                    <img src="{{ Auth::user()->image }}" alt="profile image" class="avatare img-fluid rounded-circle mr-3"/>
                    <span class="font-weight-light">Share a post with your class...</span>
                </div>
            </div>
            <div id="postForm" class="bg-white p-3 shadow-sm border mb-5 d-none">
                <form method="POST" enctype="multipart/form-data" action="#">
                    @csrf
                    <h3 class="mb-3">
                        Share post
                    </h3>
                    <input id="titre" type="text" name="titre" class="form-control my-2 @error('titre') is-invalid @enderror" value="{{ old('titre') }}" placeholder="Titre du post" required />
                    @error('titre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <textarea id="content" class="form-control my-2 @error('content') is-invalid @enderror" name="content" rows="4" placeholder="Partager vos idées" required>{{ old('content') }}</textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="custom-file my-2 @error('image') is-invalid @enderror">
                        <input id="image" type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" value="{{ old('image') }}" id="postImage">
                        <label class="custom-file-label" for="postImage">Choisir image</label>
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <select id="cours" name="cours" class="custom-select my-2">
                        <option selected value="0">General</option>
                        <option value="1">Python</option>
                        <option value="2">Cloud</option>
                        <option value="3">Java</option>
                    </select>
                    <input type="hidden" name="class" value="{{ $class->id }}" />
                    <div class="my-2 d-flex justify-content-end">
                        <button type="button" class="btn btn-os form-control w-25 mr-3" onclick="closePostForm()">Annuler</button>
                        <button type="submit" class="btn btn-primary form-control w-25">Publier</button>
                    </div>
                </form>
            </div>
            <!-- POSTS -->
                
        </div>
        <!--Side-->
        <div class="col-md-4">
            <!--Description-->
            <div class="bg-white p-3 shadow-sm border mb-5">
                <h5>Description</h5>
                <p class="py-3 text-muted">
                    
                </p>
            </div>
        </div>
        <div class="modal fade" id="delete_post" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <input id="d-post-id" type="hidden" />
                    <h5 class="modal-title" id="dp-modalLabel">Supprimer le post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    êtes-vous sûr de cela
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deletePost()">Supprimer</button>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset("js/post-scripts.js") }}"></script>
</div>
@endsection