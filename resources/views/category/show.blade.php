@extends('layouts.appbar')
@section('title')
    ArtCafe POS
@endsection

@section('nav-title')
    Category
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <a type="button" class="btn btn-success" href="/category/create">Add New
                Category</a>
            {{-- CATEGORY TABLE --}}
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-success">
                            <h4 class="card-title">Category List</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="col-4 p-2">
                                <input type="text" class="form-control" id='search' placeholder="Search">
                            </div>
                            <table class="table table-hover" id="mytable">
                                <thead class="text-warning">
                                    <th>Category Name</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <form action="/category/{{$category->CategoryID}}" method="POST" enctype="multipart/form-data">
                                            @method('delete')
                                            @csrf
                                            <tr>
                                                <td style="display: none">{{ $category->CategoryID }}</td>
                                                <td>{{ $category->CategoryName }}</td>
                                                <td>
                                                    @if ($category->isActive)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                <td style="display: none">{{ $category->isActive }}</td>
    
                                                <th>                                                
                                                    <a class="btn btn-warning" href="/{{ $category->CategoryID }}/edit">Update</a>                                                
                                                    <button class="btn btn-danger">Remove</button></th>
                                            </tr>                                        
                                        </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END OF CATEGORY TABLE --}}


        </div>
    </div>


@endsection

@section('scripts')
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
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
