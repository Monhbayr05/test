@extends('layouts.admin')
@section('content')
    <a href="{{ route('create') }}" class="btn btn-primary">Create</a>
    <table class="table table-bordered align-items-center">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">ID</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Нэр</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Товчлол</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үнэ</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Тайлбар</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Зураг</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Created at</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Updated at</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->slug }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <img src="{{ asset($item->image) }}" width="150px" alt="image">
                </td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                    <a href="{{ route('edit', $item->id) }}">
                        edit
                    </a>
                </td>
                <td>
                    <form action="{{ route('destroy', $item->id) }}" method="POST"
                         onsubmit="return confirm('Устгахдаа итгэлтэй байна уу?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary float-end">
                            delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
