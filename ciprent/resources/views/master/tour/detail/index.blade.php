@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Detail Tour Data</h1>
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
            <a href="{{ route('tour-detail.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-car-front-fill"></i> Add Tour Detail
            </a>
        </div>
    </div>

    <!-- Car Details Table -->
    <div class="table-responsive shadow-sm rounded p-4">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Product Type</th>
                    <th>title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Pickup</th>
                    <th>Pickup Name</th>
                    <th>Map Location (longitude / latitude)</th>
                    <th>Facilities</th>
                    <th>Itenaries</th>
                    <th>Gallery</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $tourDetail)
                <tr class="bg-white">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $tourDetail->tour->product_name }}</td>
                    <td>{{ $tourDetail->tour_title }}</td>
                    <td>{{ $tourDetail->start_date }}</td>
                    <td>{{ $tourDetail->end_date }}</td>
                    <td>{{ $tourDetail->pickup }}</td>
                    <td>{{ $tourDetail->pickup_name }}</td>
                    <td>
                        <a href="{{ $tourDetail->map_location }}">
                            Link Map Location
                        </a>
                    </td>
                    <td>{!! $tourDetail->fasilities !!}</td>
                    <td>
                        <form class="d-inline" 
                            action="{{ route('itenary.store') }}" 
                            method="POST"
                            >
                            @csrf
                            <input type="hidden" name="tour_detail_id" value=" {{ $tourDetail->id }}"/>
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
                        @foreach ($tourDetail->itenary as $itenary)
                            <li>{{ $itenary->description }}</li>
                            @endforeach
                        </ol>
                    </td>
                    <td>
                        <form class="d-inline" 
                            action="{{ route('tour-gallery.store') }}" 
                            method="POST"
                            enctype="multipart/form-data"
                            >
                            @csrf
                            <input type="hidden" name="tour_detail_id" value=" {{ $tourDetail->id }}"/>
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
                            @foreach ($tourDetail->gallery as $gallery)
                            <img class="img-thumbnail" src="{{ $gallery->path }}" width="100"/>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('tour-detail.edit', $tourDetail->id) }}" class="btn btn-primary btn-sm my-2">
                            <i class="bi bi-save"></i> Update
                        </a>
                        <form  
                        method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this car?');">
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