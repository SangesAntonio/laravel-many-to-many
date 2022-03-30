@extends('layouts.app')
@section('content')

<div class="container mt-4 ">
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{route('admin.posts.store')}}" method="post" class="w-75">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" placeholder="Titolo post" name="title" value=" {{old('title')}}">
          </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenuto post</label>
            <textarea class="form-control" id="content" placeholder="A cosa stai pensando?" name="content"></textarea>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Carica immagine</label>
            <input type="text" class="form-control" id="image" placeholder="Inserisci url immagine" name="imag">
          </div>
          <div class="form-group w-25">
            <label for="exampleFormControlSelect1">Scegli la categoria</label>
            <select class="form-control" id="exampleFormControlSelect1" name='category_id'>
                <option value="">Nessuna categoria</option>
                @foreach($categories as $category)
              <option @if(old('category_id') == $category->id) selected  @endif value="{{$category->id}}">{{$category->label}}</option>
              @endforeach
              
            </select>
          </div>
          <button type="submit" class='btn btn-primary'>Aggiungi Post</button>
    </form>
</div>
@endsection

