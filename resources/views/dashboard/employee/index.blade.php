@extends('partials.header')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Employee</h5>
                    <div>
                        <a href="{{ route('employee.create') }}" class="btn btn-primary">Create</a>
                    </div>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nomor Karyawan</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employes as $emp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $emp->no_employe }}</td>
                                    <td>{{ $emp->name }}</td>
                                    <td>{{ $emp->position }}</td>
                                    <td>{{ Carbon\Carbon::parse($emp->dob)->format('d M Y') }}</td>
                                    <td>{{ $emp->gender }}</td>
                                    <td>{{ Carbon\Carbon::parse($emp->dob)->age }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$emp->id}}">
                                            <i class="fas fa-eye"></i>
                                          </button>
                                          <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $emp->id }}">
                                            Delete
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>

    <!-- Vertically centered Modal -->

    @foreach ($employes as $emp)
    <div class="modal fade" id="verticalycentered{{$emp->id}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vertically Centered</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{route('employee.update',$emp->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group mb-3">
                                    <label for="">Nomor Karyawan</label>
                                    <input type="text" class="form-control" name="no_employe" value="{{$emp->no_employe}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$emp->name}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Position</label>
                                    <input type="text" class="form-control" name="position" value="{{$emp->position}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Contract" {{$emp->status == 'Contract' ? 'selected':''}}>Permanent</option>
                                        <option value="Contract" {{$emp->status == 'Contract' ? 'selected':''}}>Contract</option>
                                        <option value="Contract" {{$emp->status == 'Trainer' ? 'selected':''}}>Trainer</option>
                                        <option value="Contract" {{$emp->status == 'Intern' ? 'selected':''}}>Intern</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="Male" {{$emp->status == 'Male' ? 'selected':''}}>Male</option>
                                        <option value="Female" {{$emp->status == 'Female' ? 'selected':''}}>Female</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">DOB</label>
                                    <input type="date" class="form-control" name="dob" value="{{$emp->dob}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        Photo
                                        <div class="mb-3">
                                            <input name="photo" type="file" class="form-control" id="fileInput">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{asset('employee-photo/' .$emp->photo)}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Vertically centered Modal-->
    @endforeach

@endsection
@push('js')
    <script>
        document.getElementById('fileInput').onchange = function(event) {
            var reader = new FileReader();

            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
            };

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const dataId = this.getAttribute('data-id');
                    const deleteUrl = `{{ route('employee.delete', ':id') }}`
                        .replace(':id', dataId);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You will not able to recover this data!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Delete it!',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Aksi penghapusan dengan redirect ke route Laravel
                            window.location.href = deleteUrl;
                        }
                    });
                });
            });
        });
    </script>
@endpush
