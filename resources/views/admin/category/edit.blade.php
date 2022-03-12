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
                            <form class="row g-3" action="{{ url('category/update/'.$category->id) }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <label for="category" class="form-label">Update Category Name</label>
                                    <input type="text" class="form-control" id="category" name="category_name" value="{{$category->category_name}}">
                                </div>
                                @if ($errors->has('category_name'))
                                    <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                @endif
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
