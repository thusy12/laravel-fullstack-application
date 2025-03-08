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

                            <div class="card-header bg-dark text-white">
                                <h3 class="m-0">Your Uploaded Images</h3>
                            </div>
                            <div class="card-body">
                                @if($images->isEmpty())
                                    <p>No images uploaded yet.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($images as $image)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset('storage/' . $image->file_path) }}" class="img-fluid rounded" alt="Uploaded Image" width="150">
                                                        </td>
                                                        <td>
                                                            <span class="badge 
                                                                @if($image->status == 'approved') badge-success
                                                                @elseif($image->status == 'denied') badge-danger
                                                                @else badge-warning @endif">
                                                                {{ ucfirst($image->status) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- Pagination Links -->
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
</x-app-layout>
