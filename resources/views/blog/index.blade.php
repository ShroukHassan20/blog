@extends('layouts.app')

@section('content')
<div class="w-11/12 lg:w-4/5 m-auto">

    {{-- العنوان --}}
    <div class="text-center py-12">
        <h1 class="text-5xl font-extrabold text-gray-800">
            Blog Posts
        </h1>
    </div>

    {{-- رسائل النجاح --}}
    @if (session()->has('message'))
        <div class="mb-8">
            <p class="w-full md:w-2/5 mx-auto text-center text-white bg-green-500 rounded-xl py-3 font-semibold shadow-md">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif

    {{-- زرار إنشاء بوست --}}
    @if (Auth::check())
        <div class="mb-10 text-right">
            <a 
                href="/blog/create"
                class="bg-blue-600 hover:bg-blue-700 transition text-white uppercase text-sm font-bold py-3 px-6 rounded-xl shadow-md">
                + Create Post
            </a>
        </div>
    @endif

    {{-- البوستات --}}
    <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($posts as $post)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 flex flex-col">
                
                {{-- صورة البوست --}}
                <img src="{{ asset('images/' . $post->image_path) }}" 
                     alt="Post image" 
                     class="w-full h-56 object-cover">

                {{-- تفاصيل البوست --}}
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-2xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition">
                        {{ $post->title }}
                    </h2>

                    <p class="text-gray-500 text-sm mb-4">
                        By <span class="font-semibold text-gray-800">{{ $post->user->name }}</span> 
                        • {{ date('jS M Y', strtotime($post->updated_at)) }}
                    </p>

                    <p class="text-gray-700 leading-relaxed mb-6 line-clamp-3">
                        {{ $post->description }}
                    </p>

                    <div class="mt-auto flex justify-between items-center">
                        <a href="/blog/{{ $post->slug }}" 
                           class="bg-blue-600 hover:bg-blue-700 transition text-white text-sm font-bold py-2 px-5 rounded-lg shadow">
                            Keep Reading
                        </a>

                        {{-- أزرار التحكم لصاحب البوست --}}
                        @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                            <div class="flex items-center space-x-3">
                                <a href="/blog/{{ $post->id }}/edit"
                                   class="text-gray-600 hover:text-gray-900 text-sm font-medium border-b border-transparent hover:border-gray-800 transition">
                                    Edit
                                </a>
                                
                                <form action="/blog/{{ $post->slug }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-700 text-sm font-medium transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
