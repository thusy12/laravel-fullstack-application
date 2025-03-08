<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Image Upload') }}
        </h2>

        <div class="py-12">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h3>Upload Image</h3>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Image Upload Form -->
                                <form action="{{ route('images.upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="image">Choose an image</label>
                                        <input type="file" name="image" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>

                                <hr>

                                <h4>Your Uploaded Images</h4>
                                @foreach($images as $image)
                                    <div class="row my-3">
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/' . $image->file_path) }}" class="img-fluid" alt="Uploaded Image">
                                        </div>
                                        <div class="col-md-8">
                                            <p><strong>Status:</strong> {{ $image->status }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    
</x-app-layout>
