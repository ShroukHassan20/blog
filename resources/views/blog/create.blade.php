@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-radius: 16px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        input, textarea {
            transition: all 0.3s ease;
        }
        input:focus, textarea:focus {
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        .upload-label {
            transition: all 0.3s ease;
        }
        .upload-label:hover {
            background-color: #eef2ff;
        }
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.15);
        }
    </style>
</head>
<body class="flex items-center justify-center py-12 px-4">
    <div class="w-full m-auto max-w-5xl">
        <!-- Header -->
        <div class="text-center mb-10 mt-10">
            <h1 class="text-4xl font-bold text-indigo-700 mb-3">
                <i class="fas fa-pencil-alt mr-3"></i>Create New Post
            </h1>
            <p class="text-gray-600">Share your thoughts and ideas with the community</p>
        </div>
        
        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-8 p-5 bg-red-50 border-l-4 border-red-500 rounded-lg">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    <h3 class="text-lg font-medium text-red-800">Please fix the following errors</h3>
                </div>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-700">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Container -->
        <div class="card bg-white p-8">
            <form action="/blog" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Title Field -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-800 mb-2" for="title">
                        <i class="fas fa-heading text-indigo-500 mr-2"></i>Post Title:
                    </label>
                    <input 
                        type="text"
                        name="title"
                        placeholder="Enter a catchy title..."
                        class="w-full p-4 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-lg">
                </div>

                <!-- Description Field -->
                <div class="mb-8">
                    <label class="block text-lg font-medium text-gray-800 mb-2" for="description">
                        <i class="fas fa-align-left text-indigo-500 mr-2"></i>Post Content:
                    </label>
                    <textarea 
                        name="description"
                        placeholder="Write your post content here..."
                        rows="6"
                        class="w-full p-4 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-lg"></textarea>
                </div>

                <!-- Image Upload -->
                <div class="mb-10">
                    <label class="block text-lg font-medium text-gray-800 mb-2">
                        <i class="fas fa-image text-indigo-500 mr-2"></i>Post Image:
                    </label>
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-xl">
                        <div class="space-y-1 text-center">
                            <div class="flex justify-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-indigo-500"></i>
                            </div>
                            <div class="flex text-sm text-gray-600">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload an image</span>
                                    <input type="file" name="image" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn bg-indigo-600 text-white text-lg font-bold py-4 px-10 rounded-2xl hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                        <i class="fas fa-paper-plane mr-2"></i>Publish Post
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Additional Info -->
        <div class="mt-8 text-center text-gray-600">
            <p>Your post will be visible to the community after approval</p>
        </div>
    </div>
</body>
</html>

@endsection