




@extends('layouts.appbar')
@section('title')
    ArtCafe POS
@endsection

@section('nav-title')
    Dashboard
@endsection

@section('content')

    {{-- MENU AND CATEGORY COUNT --}}
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">fastfood</i>
                    </div>
                    <p class="card-category">Menu</p>
                    <h3 class="card-title pb-3">
                        {{$menuCount->count()}}
                    </h3>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">menu_book</i>
                    </div>
                    <p class="card-category">Categories</p>
                    <h3 class="card-title pb-3">{{$categories->count()}}</h3>
                </div>
            </div>
        </div>
    </div>
    {{-- END OF MENU AND CATEGORY COUNT --}}    
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal">New Menu</button>               
    {{-- MENU TABLE --}}
    <div class="row">
        
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <h4 class="card-title">Available Menu</h4>

                </div>
                <div class="col-4 p-4">
                    <input type="text" class="form-control" id='search' placeholder="Search">
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover" id="mytable">
                        <thead class="text-warning">
                            <th>Menu</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <form action="/menu/{{$menu->MenuID}}" method="POST" enctype="multipart/form-data">
                                    @method('delete')
                                    @csrf
                                    <tr>
                                        <td>{{ $menu->MenuName }}</td>
                                        <td>{{ $menu->MenuDescription }}</td>
                                        <td>{{ $menu->MenuPrice }}</td>
                                        <td>{{ $menu->CategoryName }}</td>
                                        <td><button class="btn btn-danger update">Remove</button></td>
                                    </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- END OF MENU TABLE --}}
{{--CREATE MODAL --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Menu Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action='/m' method="POST" enctype="multipart/form-data" id="createform">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Menu ID:</label>
                    <input type="text" id='menuid' class="form-control" value="{{ $menuID->count() != null ? $menuID->first()->MenuID + 1 : 1 }}" disabled>
                </div>
                <div class="form-group">
                    <label class="bmd-label-floating">Menu Name</label>
                    <input type="text" class="form-control" id='menuname' name="menuname" value="{{ count($errors) > 0 ? old('menuname') : null }}">
                    @error('menuname')
                        <strong class="warning">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="bmd-label-floating">Description</label>
                    <textarea class="form-control" id='menudescription' name="menudescription">{{ count($errors) > 0 ? old('menudescription') : null}}</textarea>
                    @error('menudescription')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="bmd-label-floating">Price</label>
                    <input type="text" class="form-control" id='price' name="price" value="{{ count($errors) > 0 ? old('price') : null}}">
                    @error('price')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <label for="dropdownMenuButton" class="col-form-label">Category:</label>
                        <div class="dropdown">
                            <select name="categoryid" id="categoryid" class="form-control" >
                                <option selected disabled>Please select category</option>
                                @foreach ($categoriesActive as $category)
                                    <option value="{{$category->CategoryID}}" {{ count($errors) > 0 ? old('categoryid') == $category->CategoryID ? 'selected' : '' : '' }}>{{$category->CategoryName}}</option>
                                @endforeach
                            </select>
                            @error('categoryid')
                                <strong>{{ $message }}</strong>
                            @enderror                                
                        </div>                                
                    </div>
                    <div class="col">
                        <label for="dropdownMenuButton" class="col-form-label">Active:</label>
                        <div class="dropdown">
                            <select name="isactive" id="isactive" class="form-control"> 
                                <option value="1" {{ count($errors) > 0 ? old('isactive') == '1' ? 'selected' : '' : '' }}>Yes</option>                                        
                                <option value="0" {{ count($errors) > 0 ? old('isactive') == '0' ? 'selected' : '' : '' }}>No</option>                                        
                            </select>
                        </div>
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
{{-- END OF MODAL --}}

@endsection

@section('scripts')


<script type="text/javascript">
    @if (count($errors) > 0)        
        $('#createModal').modal('show');                    
    @endif                
</script>
<script>
    var $rows = $('#mytable tr');
    $('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
    });
</script>



@endsection

















