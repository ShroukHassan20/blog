@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-left">
    <div class="py-10">
        <h1 class="text-5xl font-bold text-gray-800 border-b-4 border-blue-500 inline-block pb-2">
            Update Post
        </h1>
    </div>
</div>

@if ($errors->any())
    <div class="w-4/5 m-auto mb-6">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="mb-3 px-4 py-3 bg-red-600 text-white font-semibold rounded-xl shadow-md">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="w-4/5 m-auto">
    <div class="bg-white p-10 rounded-2xl shadow-lg">
        <form 
            action="/blog/{{ $post->slug }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-8">
                <label class="block text-gray-700 font-semibold mb-2 text-lg">Title</label>
                <input 
                    type="text"
                    name="title"
                    value="{{ $post->title }}"
                    class="bg-gray-100 block w-full h-14 px-4 text-2xl rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- Description --}}
            <div class="mb-8">
                <label class="block text-gray-700 font-semibold mb-2 text-lg">Description</label>
                <textarea 
                    name="description"
                    rows="6"
                    class="bg-gray-100 block w-full px-4 py-3 text-lg rounded-xl outline-none focus:ring-2 focus:ring-blue-400">{{ $post->description }}</textarea> 
            </div>

            {{-- Image --}}
            <div class="mb-8">
                <label class="block text-gray-700 font-semibold mb-2 text-lg">Post Image</label>

                {{-- عرض الصورة القديمة لو موجودة --}}
                @if ($post->image_path)
                    <div class="mb-4">
                        <p class="text-gray-600 mb-2 text-sm">Current Image:</p>
                        <img src="{{ asset('images/' . $post->image_path) }}" 
                             alt="Post Image" 
                             class="w-48 h-32 object-cover rounded-xl shadow-md">
                    </div>
                @endif

                {{-- رفع صورة جديدة --}}
                <input 
                    type="file" 
                    name="image" 
                    class="block w-full text-gray-700 bg-gray-100 p-3 rounded-xl cursor-pointer focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- Submit --}}
            <div class="text-right">
                <button    
                    type="submit"
                    class="uppercase bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold py-3 px-10 rounded-2xl shadow-md transition duration-200">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
