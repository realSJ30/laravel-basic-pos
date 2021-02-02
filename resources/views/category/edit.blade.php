@extends('layouts.appbar')

@section('title')
    ArtCafe POS
@endsection

@section('nav-title')
    Update Category
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Category Details</h4>                            
                        </div>
                        <div class="card-body">
                            <form action='/category/{{$category->CategoryID}}' method="POST" enctype="multipart/form-data" id="createform">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Category ID:</label>
                                    <input type="text" class="form-control" disabled value="{{$category->CategoryID}}">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Category Name</label>
                                    <input type="text" class="form-control" id="CategoryName" name="CategoryName" value="{{$category->CategoryName}}">
                                    @error('CategoryName')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="dropdownMenuButton" class="col-form-label">Active:</label>
                                        <div class="dropdown">
                                            <select name="isActive" id="isActive" class="form-control" >
                                                <option value="1"
                                                    {{ count($errors) > 0 ? (old('isActive') == '1' ? 'selected' : '') : ($category->isActive == 1 ? 'selected' : '') }}>
                                                    Yes
                                                </option>
                                                <option value="0"
                                                    {{ count($errors) > 0 ? (old('isActive') == '0' ? 'selected' : '') : ($category->isActive == 0 ? 'selected' : '') }}>
                                                    No
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
