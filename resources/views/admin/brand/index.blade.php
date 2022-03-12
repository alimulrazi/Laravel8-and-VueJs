@extends('admin.admin_layout')
@section('content')

    <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">All Brand</div>
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                <td>{{$brand->brand_name}}</td>
                                <td><img src="{{ asset('uploads/images/brand/'.$brand->brand_image) }}" alt="{{$brand->brand_name}}" width="150" /></td>
                                <td>{{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}</td>
                                <td>
                                    <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-danger" onclick="return confirm('Do you want to delete?')">Delete</a>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                                </table>
                        {{ $brands->links()}}
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="card-header">
                            <form class="row g-3" action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="brand" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name">
                                </div>
                                
                                @if ($errors->has('brand_name'))
                                    <span class="text-danger">{{ $errors->first('brand_name') }}</span>
                                @endif
                                <div class="col-md-12">
                                    <label for="brand_image" class="form-label">Brand Logo</label>
                                    <input type="file" class="form-control" id="brand_image" name="brand_image">
                                </div>
                                @if ($errors->has('brand_image'))
                                    <span class="text-danger">{{ $errors->first('brand_image') }}</span>
                                @endif
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Add Brand</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
