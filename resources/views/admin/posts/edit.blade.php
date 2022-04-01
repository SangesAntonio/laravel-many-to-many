@extends('layouts.app')
@section('content')

<div class="container mt-4 ">
    
    <form action="{{route('admin.posts.update', $post)}}" method="post" class="w-75" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" placeholder="Titolo post" name="title" value=" {{old('title', $post->title)}}">
          </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto post</label>
            <textarea class="form-control" id="content" placeholder="A cosa stai pensando?" name="content" >{{ old('content', $post->content) }}</textarea>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Carica immagine</label>
            <input type="file" class="form-control" id="image" placeholder="Inserisci url immagine" name="image" value="{{old('image', $post->image)}}">
          </div>
          <div class="form-group w-25">
            <label for="exampleFormControlSelect1">Scegli la categoria</label>
            <select class="form-control" id="exampleFormControlSelect1" name='category_id'>
                <option value="">Nessuna categoria</option>
                @foreach($categories as $category)
              <option @if(old('category_id', $post->category_id) == $category->id) selected @endif value="{{$category->id}}">{{$category->label}}</option>
              @endforeach
              
            </select>
          </div>
          <!--checkbox-->
          <div class="col-12 mt-4  rounded mb-4 align-items-center">
            <h5 class="color-white">Scegli i tag</h5>
            @foreach($tags as $tag)
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="tag-{{$tag->id}}" value="{{$tag->id}}" name="tags[]"
              @if (in_array($tag->id, old('tags', $post_tags_ids ?? []))) checked @endif>
              <label class="form-check-label" for="tag-{{$tag->id}}">{{$tag->label}}</label>
            </div>
            @endforeach
          </div>
          <button type="submit" class='btn btn-primary'>Salva modifiche</button>
    </form>
</div>

@endsection
<style >
  h5{
    color: white;
  }
</style>
