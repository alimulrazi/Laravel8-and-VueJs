@extends('admin.admin_layout')
@section('content')
    <div class="py-12">
            <div class="container">
                <div class="row">
                    
                <div class="col-md-8">
                    <div class="card">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                        <div class="card-header">
                            <form class="row g-3" action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="brand_name" class="form-label">Update Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{$brand->brand_name}}">
                                </div>
                                @if ($errors->has('brand_name'))
                                    <span class="text-danger">{{ $errors->first('brand_name') }}</span>
                                @endif
                                <div class="col-md-12">
                                    <input type="hidden" name="old_image" value="{{$brand->brand_image}}" /> 
                                    <label for="brand_image" class="form-label">Brand Logo</label>
                                    <input type="file" class="form-control" id="brand_image" name="brand_image">
                                </div>
                                @if ($errors->has('brand_image'))
                                    <span class="text-danger">{{ $errors->first('brand_image') }}</span>
                                @endif
                                <div class="col-md-12">
                                <img src="{{ asset('uploads/images/brand/'.$brand->brand_image) }}" alt="{{$brand->brand_name}}" width="200" />
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Brand</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
