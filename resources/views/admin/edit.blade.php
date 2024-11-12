@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center p-2">
            <h6 class="m-2 font-weight-bold text-primary d-inline fs-5">Бүтээгдэхүүн Засах</h6>
            <a href="{{ route('index') }}" class="btn btn-primary float-end">Буцах</a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')



                <div class="mb-3">
                    <label>name</label>
                    <input type="text" name="name" class="form-control" placeholder="name" value="{{ old('name', $product->name) }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="slug" value="{{ old('slug', $product->slug) }}">
                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>price</label>
                    <input type="number" name="price" class="form-control" placeholder="price" value="{{ old('price', $product->price) }}">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>description</label>
                    <input type="text" name="description" class="form-control" placeholder="description" value="{{ old('description', $product->name) }}">
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" width="100">
                    @endif
                </div>


                <div class="mt-3">
                    <button type="submit" class="btn btn-primary float-end">Хадгалах</button>
                </div>

            </form>
        </div>
    </div>
@endsection
