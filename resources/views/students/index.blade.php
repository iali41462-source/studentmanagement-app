{{-- @extends('layouts.layout')
@section('content')

                @if(session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            var alert = document.getElementById('success-alert');
                            if (alert) {
                                alert.style.display = 'none';
                            }
                        }, 5000);
                    </script>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h2>Student Application</h2>
                    </div>
                    <div class="card-body">
                       @can('create', App\Models\Student::class)
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        Add Student
    </a>
@endcan
                        <br/>
                        <br/>
                        <form action="{{ route('students.index') }}" method="GET" class="mb-3">

    <div class="input-group">

        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search Student..."
               value="{{ request('search') }}">

        <button class="btn btn-primary">
            Search
        </button>

    </div>
     <div class="col-md-3">
            <select name="sort" class="form-select">

                <option value="">Sort By</option>

                <option value="name_asc"
                    {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                    Name A-Z
                </option>

                <option value="name_desc"
                    {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                    Name Z-A
                </option>

                <option value="latest"
                    {{ request('sort') == 'latest' ? 'selected' : '' }}>
                    Latest
                </option>

                <option value="oldest"
                    {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                    Oldest
                </option>

            </select>
        </div>

</form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->mobile }}</td>
                                        <td>
                                            @if($item->photo)
                                                <img src="{{ Storage::url($item->photo) }}" alt="Student Photo" style="width: 100px; height: auto;">
                                            @else
                                                No Photo
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ url('/students/' . $item->id) }}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @can('update', $item)
    <a href="{{ route('students.edit', $item->id) }}" class="btn btn-warning">
        Edit
    </a>
@endcan

     @can('delete', $item)

<form method="POST" action="{{ route('students.destroy', $item->id) }}">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger btn-sm">
        Delete
    </button>
</form>

@endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
    {{ $students->appends(request()->query())->links() }}
</div>
                        </div>

                    </div>
                </div>

@endsection --}}
<!DOCTYPE html>
<html>
<head>
    <title>Students</title>

    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
</head>

<body>

    <div id="react-app"></div>

</body>
</html>
