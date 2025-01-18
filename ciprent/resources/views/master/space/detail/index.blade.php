@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Detail Space Data</h1>
    </div>

    <!-- Display Validation Errors -->
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <!-- Back to Welcome Button -->
        <a href="{{ route('master.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>

        <!-- Other Buttons -->
        <div class="d-flex gap-3">
            <a href="{{ route('space-detail.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-car-front-fill"></i> Add Space Detail
            </a>
        </div>
    </div>

    <!-- Car Details Table -->
    <div class="table-responsive shadow-sm rounded p-4">
        <table class="table table-hover align-start table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>title</th>
                    <th>location</th>
                    <th>Google Map Location (longitude / latitude)</th>
                    <th>Description</th>
                    <th>Facilities</th>
                    <th>Min Pax</th>
                    <th>Max Pax</th>
                    <th>Available</th>
                    <th>Days</th>
                    <th>Price</th>
                    <th>Itenaries</th>
                    <th>Gallery</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $spaceDetail)
                <tr class="bg-white">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $spaceDetail->space_title }}</td>
                    <td>{{ $spaceDetail->location }}</td>
                    <td>
                        <a href="{{ $spaceDetail->google_location }}">
                            Link Map Location
                        </a>
                    </td>
                    <td>{!! $spaceDetail->description !!}</td>
                    <td>{!! $spaceDetail->fasilities !!}</td>
                    <td>{{ $spaceDetail->min_pax }}</td>
                    <td>{{ $spaceDetail->max_pax }}</td>
                    <td>
                        <span class="badge {{ $spaceDetail->available ? 'bg-success' : 'bg-danger' }}">
                            {{ $spaceDetail->available ? 'Yes' : 'No' }}
                        </span>
                    </td>             
                    <td>{{ $spaceDetail->days }}</td>
                    <td>{{ $spaceDetail->price }}</td>
                    <td>
                        <form class="d-inline" 
                            action="{{ route('space-itenary.store') }}" 
                            method="POST"
                            >
                            @csrf
                            <input type="hidden" name="space_detail_id" value=" {{ $spaceDetail->id }}"/>
                            <textarea  name="description" id="description" class="form-control" required></textarea>
                            @if(isset($errors->path))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->path as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary btn-sm my-2">
                                Add Itenary
                            </button>
                        </form>
                        <ol>
                        @foreach ($spaceDetail->itenary as $itenary)
                            <li>{{ $itenary->description }}</li>
                        @endforeach
                        </ol>
                    </td>
                    <td>
                        <form class="d-inline" 
                            action="{{ route('space-gallery.store') }}" 
                            method="POST"
                            enctype="multipart/form-data"
                            >
                            @csrf
                            <input type="hidden" name="space_detail_id" value=" {{ $spaceDetail->id }}"/>
                            <input type="file" name="path" id="path" class="form-control" required>
                            @if(isset($errors->path))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->path as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary btn-sm my-2">
                                <i class="bi bi-save"></i> upload
                            </button>
                        </form>
                        
                        <div class="flex">
                            @foreach ($spaceDetail->gallery as $gallery)
                            <img class="img-thumbnail" src="{{ $gallery->path }}" width="100"/>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('space-detail.edit', $spaceDetail->id) }}" class="btn btn-primary btn-sm my-2">
                            <i class="bi bi-save"></i> Update
                        </a>
                        <form  
                        action="{{ route('space-detail.destroy', $spaceDetail->id) }}" 
                        method="POST" class="d-inline"  onsubmit="return confirm('Are you sure you want to delete this space?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection