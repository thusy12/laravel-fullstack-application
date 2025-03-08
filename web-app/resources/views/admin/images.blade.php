@extends('layouts.app')  {{-- Extends the app layout --}}

@section('content')  {{-- Defines the main content section --}}
    <h1>Pending Images</h1>

    @if($images->isEmpty())
        <p>No pending images.</p>
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
@endsection  {{-- Ends the content section --}}
