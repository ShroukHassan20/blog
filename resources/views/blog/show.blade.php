@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-left">
    <div class="py-10 text-center">
        {{-- عنوان البوست --}}
        <h1 class="text-5xl font-extrabold text-gray-800 leading-snug border-b-4 border-blue-500 inline-block pb-2">
            {{ $post->title }}
        </h1>
    </div>
</div>

<div class="w-4/5 m-auto pt-10">
    {{-- بيانات الكاتب والتاريخ --}}
    <div class="text-gray-600 mb-6 text-lg">
        By <span class="font-bold italic text-gray-900">{{ $post->user->name }}</span> 
        <span class="mx-2">•</span>
        <span class="text-sm">Updated on {{ date('jS M Y', strtotime($post->updated_at)) }}</span>
    </div>

    {{-- صورة البوست لو موجودة --}}
    @if ($post->image_path)
        <div class="mb-8">
            <img src="{{ asset('images/' . $post->image_path) }}" 
                 alt="Post Image" 
                 class="w-full max-h-[500px] object-cover rounded-2xl shadow-md">
        </div>
    @endif

    {{-- وصف البوست --}}
    <div class="bg-white p-8 rounded-2xl shadow-lg">
        <p class="text-xl text-gray-700 leading-8 font-light">
            {{ $post->description }}
        </p>
    </div>
</div>
@endsection
