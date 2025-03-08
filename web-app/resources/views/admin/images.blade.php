<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Image Approvals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div id="status-message" class="alert 
                            {{ session('success') == 'Image approved!' ? 'alert-success' : 'alert-danger' }}">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($images->isEmpty())
                        {{ __("No pending images!") }}
                    @else
                        <!-- Grid View for Images -->
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach($images as $image)
                                <div class="col mb-4">
                                    <div class="card shadow-sm">
                                        <!-- Clickable Image for Viewing -->
                                        <a href="#" data-toggle="modal" data-target="#imageModal{{ $image->id }}">
                                            <img src="{{ asset('storage/' . $image->file_path) }}" class="card-img-top img-fluid" alt="Uploaded Image" style="height: 200px; object-fit: cover;">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>Uploaded By: </strong>{{ $image->user->name }}</h5>
                                            <p class="card-text">
                                                <strong>Status:</strong>
                                                <span class="badge 
                                                    @if($image->status == 'approved') badge-success 
                                                    @elseif($image->status == 'denied') badge-danger 
                                                    @else badge-warning @endif">
                                                    {{ ucfirst($image->status) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <form action="{{ url('/admin/images/' . $image->id . '/approved') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>

                                            <form action="{{ url('/admin/images/' . $image->id . '/denied') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Deny</button>
                                            </form>
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

    <!-- JavaScript to Hide Message After 10 Seconds -->
    <script>
        setTimeout(function() {
            let message = document.getElementById('status-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 10000); // 10 seconds
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
