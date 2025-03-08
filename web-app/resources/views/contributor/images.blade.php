<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Image Upload') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div id="status-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h3 class="m-0">Upload Image</h3>
                        </div>
                        <div class="card-body">
                            <!-- Image Upload Form -->
                            <form action="{{ route('images.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row align-items-center">
                                    <label for="image" class="col-sm-2 col-form-label font-weight-bold">Choose an image</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="image" class="form-control-file d-inline-block" id="image" required>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <!-- Upload Button -->
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                        <!-- Cancel Button with Darker Grey Color -->
                                        <button type="button" id="cancelButton" class="btn btn-secondary ml-2">Cancel</button>
                                    </div>
                                </div>
                            </form>

                            <div class="container py-5">
                                <div class="card-header bg-dark text-white">
                                    <h3 class="m-0">Your Uploaded Images</h3>
                                </div>
                                @if($images->isEmpty())
                                    <p>No images uploaded yet.</p>
                                @else
                                    <!-- Grid View for Images -->
                                    <div class="row">
                                        @foreach($images as $image)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <!-- Clickable Image for Viewing -->
                                                    <a href="#" data-toggle="modal" data-target="#imageModal{{ $image->id }}">
                                                        <img src="{{ asset('storage/' . $image->file_path) }}" class="card-img-top img-thumbnail" alt="Uploaded Image" style="height: 150px; object-fit: cover;">
                                                    </a>
                                                    <div class="card-body">
                                                        <p><strong>Status:</strong> 
                                                            <span class="badge 
                                                                @if($image->status == 'approved') badge-success 
                                                                @elseif($image->status == 'denied') badge-danger 
                                                                @else badge-warning 
                                                                @endif">
                                                                {{ ucfirst($image->status) }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Fullscreen Modal for Image View -->
                                            <div class="modal fade modal-fullscreen" id="imageModal{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $image->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center p-0">
                                                            <img src="{{ asset('storage/' . $image->file_path) }}" class="img-fluid d-block mx-auto" alt="Full Image">
                                                            <button type="button" class="close-fullscreen" data-dismiss="modal" aria-label="Close">
                                                                &times;
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>

                                    <!-- Pagination Links -->
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $images->links() }}
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Hide Message After 10 Seconds -->
    <script>
        setTimeout(function() {
            let message = document.getElementById('status-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 10000); // 10 seconds

        // JavaScript to reset file input and cancel image selection
        document.getElementById('cancelButton').addEventListener('click', function() {
            // Reset the file input field
            document.getElementById('imageInput').value = '';
        });

        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const fileType = file ? file.type : '';

            // Check if the file is an image
            if (!fileType.startsWith('image/')) {
                alert('Only image files are allowed!');
                // Clear the selected file
                event.target.value = '';
            }
        });
    </script>

    <!-- Styles for Fullscreen Modal -->
    <style>
        /* Modal adjustments for full-screen image view */
        .modal-fullscreen {
            max-width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            max-width: none;
        }

        /* Ensures the modal body takes the full screen */
        .modal-body {
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.9); /* Dark background */
            height: 100vh; /* Full screen height */
            padding: 0;
        }

        /* The image takes up as much space as possible */
        .modal-body img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* Ensures the image maintains aspect ratio */
        }

        /* Close button styled to the top right */
        .close-fullscreen {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 40px;
            color: white;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .close-fullscreen:hover {
            color: red;
        }
    </style>
</x-app-layout>
