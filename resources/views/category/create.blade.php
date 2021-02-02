@extends('layouts.appbar')
@section('title')
    ArtCafe POS
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
                            <form action='/c' method="POST" enctype="multipart/form-data" id="createform">
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Category ID:</label>
                                    <input type="text" class="form-control" disabled value="{{ $categoryID->count() != null ? $categoryID->first()->CategoryID + 1 : 1 }}">
                                </div>
                                <div class="form-group">
                                    <label class="bmd-label-floating">Category Name</label>
                                    <input type="text" class="form-control" id="CategoryName" name="CategoryName" value="{{old('CategoryName')}}">
                                    @error('CategoryName')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="dropdownMenuButton" class="col-form-label">Active:</label>
                                        <div class="dropdown">
                                            <select name="isactive" id="isactive" class="form-control">
                                                <option value="1"
                                                    {{ count($errors) > 0 ? (old('isactive') == '1' ? 'selected' : '') : '' }}>
                                                    Yes
                                                </option>
                                                <option value="0"
                                                    {{ count($errors) > 0 ? (old('isactive') == '0' ? 'selected' : '') : '' }}>
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
