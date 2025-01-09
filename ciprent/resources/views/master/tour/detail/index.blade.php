@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="text-center mb-4">
        <h1 class="display-4 fw-bold">Detail Tour Data</h1>
    </div>

    <!-- Display Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <!-- Action Buttons: Back to Home, Maintenance, BOP, Daily Report, Order Report, Add New Car -->
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
                    <th>Gallery</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $tourDetail)
                <tr class="bg-white">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $tourDetail[$loop->index]['tour_title'] }}</td>
                    <td>{{ $tourDetail[$loop->index]->master_tour }}</td>
                    <td>{{ $tourDetail[$loop->index]['start_date'] }}</td>
                    <td>{{ $tourDetail[$loop->index]['end_date'] }}</td>
                    <td>{{ $tourDetail[$loop->index]['pickup'] }}</td>
                    <td>{{ $tourDetail[$loop->index]['pickup_name'] }}</td>
                    <td>
                        <a href="{{ $tourDetail[$loop->index]['map_location'] }}">
                            Link Map Location
                        </a>
                    </td>
                    <td>{!! $tourDetail[$loop->index]['fasilities'] !!}</td>
                    <td>
                        <form class="d-inline">
                            <input type="hidden" value=" {{ $tourDetail[$loop->index]['fasilities'] }}"/>
                            <input type="file" name="gallery" id="gallery" class="form-control" required>
                            <button type="submit" class="btn btn-primary btn-sm my-2">
                                <i class="bi bi-save"></i> upload
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('tour-detail.edit', $tourDetail[$loop->index]['id']) }}" class="btn btn-primary btn-sm my-2">
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
                @empty
                <tr>
                    <td colspan="7" class="text-center">No Detail TOur Available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection