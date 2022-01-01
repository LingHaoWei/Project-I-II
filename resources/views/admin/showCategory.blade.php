@extends('layout')
@section('content')
<style>
</style>

<!--Page topic-->
<!--Page topic-->

    <div id="pwrapper1">
        <div class="productRow1"> 
            <div class="col-sm-10">
                <div class="pageTopic"><h2>Product Category</h2></div>
            </div>
            <div class="addProBtn">
                <div class="p-3">
                    <Button type="button" class="addButton">
                        <a href="{{ route('insertCategory') }}" class="addProduct" title="New" data-toggle="tooltip">+Add Category</a>
                    </Button>
                </div>
            </div>
        </div>
        
        <div class="iq-search-bar device-search">
            <form method="POST" action="{{route('search.category')}}" class="searchbox">
            @csrf
                Search:<a class="search-link" href="#"><i class="ri-search-line"></i></a>
                <input type="text" name="keyword" type="search" placeholder="Search" aria-label="Search">
                <button type="submit"></button>
            </form>
        </div>
    </div>

    <div class="row" id="pwrapper2"> 
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col"></th>
                    <th>CategoryID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($category as $categories)
                    <tr>
                    <td width="60"> 
                    </td>
                    <td>{{$categories->categoryID}}</td>
                    <td>{{$categories->name}}</td>
                    <td>{{$categories->status}}</td>
                    <td>
                        <Button type="button" class="addButton">
                            <a href="{{ route('editCategory',['id'=>$categories->id]) }}" class="editCategory" title="Edit" data-toggle="tooltip">Edit</a>
                        </Button>

                        <button type="button" class="deleteBtn">
                            <a href="{{ route('deleteCategory',['id'=>$categories->id]) }}" class="deleteCategory" title="Delete" data-toggle="tooltip" onclick="return confirm('Are you sure?')">Delete</a> 
                        </button>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
    {{$category->links()}}
@endsection