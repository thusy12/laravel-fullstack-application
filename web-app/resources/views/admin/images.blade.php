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
                    @if($images->isEmpty())
                        {{ __("No pending images!") }}
                    @else
                        <table>
                            <tr>
                                <th>Image</th>
                                <th>Uploader</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($images as $image)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $image->file_path) }}" width="100"></td>
                                    <td>{{ $image->user->name }}</td>
                                    <td>
                                        <form action="{{ url('/admin/images/' . $image->id . '/approved') }}" method="POST">
                                            @csrf
                                            <button type="submit">Approve</button>
                                        </form>

                                        <form action="{{ url('/admin/images/' . $image->id . '/denied') }}" method="POST">
                                            @csrf
                                            <button type="submit">Deny</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

        
