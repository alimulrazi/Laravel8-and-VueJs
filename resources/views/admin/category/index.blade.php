<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">All Category</div>
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($categories as $category)
                                <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->user->name}}</td>
                                <td>{{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                                <td>
                                    <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('category/delete/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                                </tr>
                                @php($i++)
                                @endforeach
                            </tbody>
                                </table>
                        {{ $categories->links()}}
                        </div>
                        <hr />
                        <div class="card">
                            <div class="card-header">All Deleted Category</div>
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($trashCategories as $trashCategory)
                                <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$trashCategory->category_name}}</td>
                                <td>{{$trashCategory->user->name}}</td>
                                <td>{{Carbon\Carbon::parse($trashCategory->created_at)->diffForHumans()}}</td>
                                <td>
                                    <a href="{{ url('category/restore/'.$trashCategory->id) }}" class="btn btn-info">Restore</a>
                                    <a href="{{ url('category/permanent-delete/'.$trashCategory->id) }}" class="btn btn-danger">Permanent Delete</a>
                                </td>
                                </tr>
                                @php($i++)
                                @endforeach
                            </tbody>
                                </table>
                        {{ $trashCategories->links()}}
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
                            <form class="row g-3" action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <label for="category" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category" name="category_name">
                                </div>
                                @if ($errors->has('category_name'))
                                    <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                @endif
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
