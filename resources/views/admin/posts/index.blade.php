@extends('layouts.app')
@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center">
    
      <h1>I tuoi post</h1>
      <a href="{{route('admin.posts.create')}}" class="btn btn-success"> <i class="fas fa-plus"></i> Nuovo Post</a>

    
  </div>
    
    <table class="table mt-4">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Contenuto</th>
            <th scope="col">Category</th>
          </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
          <tr>
            <th scope="row">{{$post->id}}</td>

            <td colspan="1">{{$post->title}}</th>
            <td colspan="1">{{$post->content}}</td>
            <td colspan='1'>
              @if($post->category)
              <span class="badge badge-pill badge-{{$post->category->color}}">{{$post->category->label}}</span>
              @endif
            </td>
            <td><a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-info">Info</a></td>
            <td><a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-light"><i class="fa fa-pencil"></i></a></td>
            <td>
                      <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PostModal-{{ $post->id }}">
                      <i class="fa fa-trash  pe-3"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade modal-cs" id="PostModal-{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Elimina il post {{$post->title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <h4>Sei sicuro di voler eliminare questo post?</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Annulla</button>
                            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                              @method('DELETE')
                              @csrf
                              <button class="btn btn-danger" type="submit">Conferma</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    </td>
                  </tr>
                  @endforeach
        </tbody>
      </table>
      @if($posts->hasPages())
        {{$posts->links()}}
      
      @endif
     
</div>

@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

@endsection

<style>
</style>