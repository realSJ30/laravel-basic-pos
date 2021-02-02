@extends('layouts.appbar')

@section('title')
    ArtCafe POS
@endsection

@section('nav-title')
    Menu
@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <input id='sessiontype' type="hidden" value="{{session()->get('data')}}" disabled>
            
                
            {{-- MENU TABLE --}}
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <h4 class="card-title">Menu List</h4>                                                        
                        </div>
                        <div class="card-body table-responsive">
                            <div class="col-4 p-2">
                                <input type="text" class="form-control" id='search' placeholder="Search">
                            </div>
                            <table class="table table-hover" id="mytable">
                                <thead class="text-warning">
                                    <th style="display: none">ID</th>
                                    <th>Menu</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $menu)                                    
                                            <form action="">
                                                <tr>
                                                    <td style="display: none">{{ $menu->MenuID }}</td>                                            
                                                    <td>{{ $menu->MenuName }}</td>
                                                    <td>{{ $menu->MenuDescription }}</td>
                                                    <td>{{ $menu->MenuPrice }}</td>
                                                    <td>{{ $menu->CategoryName }}</td>                                                    
                                                    <td>                                                        
                                                        @if ($menu->isActive)
                                                            Yes
                                                        @else
                                                            No
                                                        @endif
                                                    </td>
                                                    <td style="display: none">{{ $menu->CategoryID }}</td>
                                                    <td style="display: none">{{ $menu->isActive }}</td>                                                    
                                                    <th><a class="btn btn-warning update" onclick="updateView(this)">Update</a></th>
                                                    
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
        </div>
    </div>

    
{{--UPDATE MODAL --}}
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Menu Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action='/menu/' method="POST" enctype="multipart/form-data" id="editform">

            @csrf
            @method('PATCH')

            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Menu ID:</label>
                    <input type="text" id='MenuID' class="form-control" value="" disabled>
                </div>
                <div class="form-group">
                    <label class="bmd-label-floating">Menu Name</label>
                    <input type="text" class="form-control" id='MenuName' name="MenuName" value="{{ count($errors) > 0 ? old('MenuName') : null }}">
                    @error('MenuName')
                        <strong class="warning">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="bmd-label-floating">Description</label>
                    <textarea class="form-control" id='MenuDescription' name="MenuDescription">{{ count($errors) > 0 ? old('MenuDescription') : null}}</textarea>
                    @error('MenuDescription')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="bmd-label-floating">Price</label>
                    <input type="text" class="form-control" id='MenuPrice' name="MenuPrice" value="{{ count($errors) > 0 ? old('MenuPrice') : null}}">
                    @error('MenuPrice')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <label for="dropdownMenuButton" class="col-form-label">Category:</label>
                        <div class="dropdown">
                            <select name="CategoryID" id="CategoryID" class="form-control" >
                                <option selected disabled>Please select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->CategoryID}}" {{ count($errors) > 0 ? old('CategoryID') == $category->CategoryID ? 'selected' : '' : '' }}>{{$category->CategoryName}}</option>
                                @endforeach
                            </select>
                            @error('CategoryID')
                                <strong>{{ $message }}</strong>
                            @enderror                                
                        </div>                                
                    </div>
                    <div class="col">
                        <label for="dropdownMenuButton" class="col-form-label">Active:</label>
                        <div class="dropdown">
                            <select name="isActive" id="isActive" class="form-control"> 
                                <option value="1" {{ count($errors) > 0 ? old('isActive') == '1' ? 'selected' : '' : '' }}>Yes</option>                                        
                                <option value="0" {{ count($errors) > 0 ? old('isActive') == '0' ? 'selected' : '' : '' }}>No</option>                                        
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
        $('#updateModal').modal('show');                        
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
<script type="text/javascript">
    function updateView(button) {
        var tr = button.parentElement.parentElement;
        // alert(tr.cells[0].innerText);
        document.getElementById('sessiontype').value = 'update';
        document.getElementById('MenuID').value = tr.cells[0].innerText;
        document.getElementById('MenuName').value = tr.cells[1].innerText;
        document.getElementById('MenuDescription').value = tr.cells[2].innerText;
        document.getElementById('MenuPrice').value = tr.cells[3].innerText;
        document.getElementById('CategoryID').value = tr.cells[6].innerText;
        document.getElementById('isActive').value = tr.cells[7].innerText;        
        
        $('#updateModal').modal('show');                
        $('#editform').attr('action','/menu/'+tr.cells[0].innerText);
    }        
</script>



@endsection

