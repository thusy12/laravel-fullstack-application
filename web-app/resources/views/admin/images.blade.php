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
                                <div class="col mb-4"> <!-- Add margin-bottom to each column -->
                                    <div class="card shadow-sm">
                                        <img src="{{ asset('storage/' . $image->file_path) }}" class="card-img-top img-fluid" alt="Uploaded Image" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>Uploaded By:</strong>{{ $image->user->name }}</h5>
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
</x-app-layout>
