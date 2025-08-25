@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mohamed Gamal's Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        scroll-behavior: smooth;
    }

    .background-image {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
    }

    .bg_button {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .bg_button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #3B82F6, #1D4ED8);
        border-radius: 3px;
    }

    .skill-item {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .skill-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.6s ease;
    }

    .skill-item:hover::before {
        left: 100%;
    }

    .skill-item:hover {
        transform: scale(1.05);
    }

    .gradient-bg {
        background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);
    }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Hero Section -->
    <div class="background-image grid grid-cols-1 m-auto"
        style="background-image: url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90oy1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1772&q=80');">
        <div class="absolute inset-0 gradient-bg opacity-85"></div>
        <div class="flex text-gray-100 pt-10 z-10 relative">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-4xl md:text-5xl lg:text-6xl uppercase font-bold pb-10 leading-tight">
                    Welcome Eng. Mohamed Gamal
                </h1>
                <p class="text-xl mb-10 text-gray-200">Software Engineer & Full Stack Developer</p>
                <a href="/blog"
                    class="bg_button inline-block bg-yellow-400 text-gray-900 border-0 rounded-full py-3 px-8 font-bold text-lg uppercase hover:bg-yellow-500">
                    See Blogs <i class="ml-2 fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Posts Section -->
    <div class="text-center py-16 px-4">
        <h2 class="text-3xl md:text-4xl font-bold pb-3 section-title">
            Recent Posts
        </h2>

        <p class="text-gray-600 max-w-2xl mx-auto mt-6">Discover the latest articles and insights</p>
        {{-- زرار الكرييت بوست --}}
        @if(Auth::check())
        <a href="{{ route('posts.create') }}"
            class="mt-6 inline-block bg-blue-600 text-white text-sm font-bold py-3 px-6 rounded-full shadow-lg hover:bg-blue-700 transition-all">
            + Create Post
        </a>
        @else
        <a href="{{ route('login') }}"
            class="mt-6 inline-block bg-blue-600 text-white text-sm font-bold py-3 px-6 rounded-full shadow-lg hover:bg-blue-700 transition-all">
            + Create Post
        </a>
        @endif
    </div>


    <div class="grid md:grid-cols-3 gap-8 w-4/5 mx-auto mb-20">
        @foreach ($posts as $post)
        <div class="bg-white rounded-2xl shadow-lg card-hover overflow-hidden">
            <img src="{{ asset('images/' . $post->image_path) }}" alt="{{ $post->title }}"
                class="w-full h-48 object-cover">
            <div class="p-6 text-left">
                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $post->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->description, 100) }}</p>
                <a href="/blog/{{ $post->id }}"
                    class="inline-flex items-center uppercase bg-blue-600 text-gray-100 text-sm font-bold py-2 px-4 rounded-full hover:bg-blue-700">
                    Read More <i class="ml-2 fas fa-arrow-right"></i>
                </a>

                {{-- لو المستخدم هو صاحب البوست يظهر له أزرار التعديل والحذف --}}
                @if(Auth::check() && Auth::id() === $post->user_id)
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('posts.edit', $post->id) }}"
                        class="inline-flex items-center uppercase bg-yellow-500 text-white text-xs font-bold py-2 px-3 rounded-full hover:bg-yellow-600">
                        Edit <i class="ml-1 fas fa-edit"></i>
                    </a>

                    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center uppercase bg-red-600 text-white text-xs font-bold py-2 px-3 rounded-full hover:bg-red-700">
                            Delete <i class="ml-1 fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center py-16 px-4">
        <h2 class="text-3xl md:text-4xl font-bold pb-3 section-title"> Posts </h2>
        <p class="text-gray-600 max-w-2xl mx-auto mt-6">Discover the latest articles and insights about web development,
            programming, and technology</p>
    </div> <!-- Featured Post -->
    <div class="sm:grid grid-cols-2 w-4/5 m-auto gap-10 mb-20">
        <div
            class="flex bg-gradient-to-r from-blue-800 to-blue-600 border-0 rounded-2xl text-gray-100 pt-10 card-hover">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block"> <span
                    class="uppercase text-sm tracking-wider bg-blue-500 py-1 px-3 rounded-full"> PHP </span>
                <h3 class="text-xl font-bold py-8 leading-relaxed"> Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Voluptas necessitatibus dolorum error culpa laboriosam. Enim voluptas earum repudiandae
                    consequuntur ad? Expedita labore aspernatur facilis quasi ex? </h3> <a href=""
                    class="inline-flex items-center uppercase bg-transparent border-2 border-gray-100 text-gray-100 text-sm font-bold py-3 px-6 rounded-full hover:bg-white hover:text-blue-700 transition-all">
                    Find Out More <i class="ml-2 fas fa-arrow-right"></i> </a>
            </div>
        </div>
        <div class="mt-10 sm:mt-0"> <img src="https://cdn.pixabay.com/photo/2014/05/03/01/03/laptop-336704_960_720.jpg"
                alt="PHP Development" class="rounded-2xl shadow-lg w-full h-full object-cover"> </div>
    </div> <!-- Second Post -->
    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
        <div class="mb-10 sm:mb-0"> <img src="/images/6034f2b4ac8f1-This is my title.jpg" width="700"
                alt="Web Development" class="rounded-2xl shadow-lg"> </div>
        <div class="m-auto sm:m-auto text-left w-4/5 block">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-6"> Struggling to be a better web developer? </h2>
            <p class="py-4 text-gray-600 text-md leading-relaxed"> Lorem, ipsum dolor sit amet consectetur adipisicing
                elit. Voluptatibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum. </p>
            <p class="font-bold text-gray-700 text-md pb-9 leading-relaxed"> Lorem ipsum, dolor sit amet consectetur
                adipisicing elit. Sapiente magnam vero nostrum! Perferendis eos molestias porro vero. Vel alias. </p> <a
                href="/blog"
                class="inline-flex items-center uppercase bg-blue-600 text-gray-100 text-sm font-bold py-3 px-8 rounded-full hover:bg-blue-700">
                Find Out More <i class="ml-2 fas fa-arrow-right"></i> </a>
        </div>
    </div> <!-- Skills Section -->
    <div class="text-center p-15 gradient-bg text-white">
        <h2 class="text-2xl pb-5 text-l"> I'm an expert in... </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto mt-10">
            <div
                class="skill-item bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 border border-white border-opacity-20">
                <i class="fas fa-pencil-ruler text-4xl mb-4"></i> <span class="font-bold block text-2xl py-1"> Front-End
                </span> </div>
            <div
                class="skill-item bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 border border-white border-opacity-20">
                <i class="fas fa-tasks text-4xl mb-4"></i> <span class="font-bold block text-2xl py-1"> Project
                    Management </span> </div>
            <div
                class="skill-item bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 border border-white border-opacity-20">
                <i class="fas fa-chart-line text-4xl mb-4"></i> <span class="font-bold block text-2xl py-1"> Digital
                    Strategy </span> </div>
            <div
                class="skill-item bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 border border-white border-opacity-20">
                <i class="fas fa-server text-4xl mb-4"></i> <span class="font-bold block text-2xl py-1"> Backend
                    Development </span> </div>
        </div>
    </div> <!-- Footer -->
   
</body>

</html>

@endsection