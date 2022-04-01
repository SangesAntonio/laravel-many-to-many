<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\facades\Storage;
//use Illuminate\Validation\Rule;
use App\Post;
use App\Tag;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $post = Post::all();
        $tags = Tag::orderBy('label', 'ASC')->get();

        $categories = Category::all();
        return view('admin.posts.create', compact('tags', 'post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required|max:100|min:2',
            'content' => 'required',
            'imag' => 'nullable | image',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'

        ], [
            'required' => 'Il campo :attribute è obbligatorio',
            'content.min' => 'La lunghezza minima è :min',
            'unique' => "L \'immagine $request->image è già presente!",
            'tags.exists' => 'Il tag è già selezionato'
        ]);
        $data = $request->all();
        $post = new Post();

        if (array_key_exists('image', $data)) {
            $image_url = Storage::put('post_images', $data['image']);
            $data['image'] = $image_url;
        }
        $post->fill($data);


        $post->slug = Str::slug($post->title, '-');

        $post->save();

        if (array_key_exists('tags', $data))  $post->tags()->attach($data['tags']);


        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $posts, $id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.posts.show', compact('tags', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Category $category, Tag $tag)
    {
        $categories = Category::all();

        $tags = Tag::orderBy('label', 'ASC')->get();

        $post_tags_ids = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', compact('tags', 'post', 'categories', 'post_tags_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required| min:2',
            'image' => 'nullable | image',




        ], [
            'required' => 'Il campo :attribute è obbligatorio',
            'unique' => "L \'immagine $request->image è già presente!"
        ]);
        $request->slug = Str::slug($request->title, '-');
        $data = $request->all();
        if (array_key_exists('image', $data)) {
            $image_url = Storage::put('post_images', $data['image']);
            $data['image'] = $image_url;
            if ($post->image) Storage::delete($post->image);
        }

        $post->update($data);


        if (array_key_exists('tags', $data)) $post->tags()->sync($data['tags']);
        else $post->tags()->detach();
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {


        if ($post->image) Storage::delete($post->image);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
