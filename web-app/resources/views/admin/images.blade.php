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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Image</th>
                                        <th>Uploader</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($images as $image)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $image->file_path) }}" class="img-thumbnail" width="100">
                                            </td>
                                            <td>{{ $image->user->name }}</td>
                                            <td>
                                                <form action="{{ url('/admin/images/' . $image->id . '/approved') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>

                                                <form action="{{ url('/admin/images/' . $image->id . '/denied') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Deny</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="pagination-wrapper">
                                {{ $images->links() }} <!-- Display pagination links -->
                            </div>
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
