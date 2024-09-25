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
                    <h5 class="card-title">Performance Invoice</h5>
                    <div>
                        <a href="{{ route('create.invoice   w   3') }}" class="btn btn-primary">Create</a>
                    </div>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nomor Surat/Performa Invoice</th>
                                <th>Tanggal</th>
                                <th>Nama Perusahaan</th>
                                <th>Nama Pekerjaan</th>
                                <th>Nilai Pekerjaan</th>
                                <th>Penerbit</th>
                                <th>SPI</th>
                                <th>Pelunasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice as $inv)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $inv->no_invoice }}</td>
                                    <td>{{ $inv->date }}</td>
                                    <td>{{ $inv->company_name }}</td>
                                    <td>{{ $inv->job_name }}</td>
                                    <td>{{ $inv->value }}</td>
                                    <td>{{ $inv->penerbitan }}</td>
                                    <td>{{ $inv->spi }}</td>
                                    <td>{{ $inv->pelunasan }}</td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$emp->id}}">
                                            <i class="fas fa-eye"></i>
                                          </button>
                                          <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $inv->id }}">
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

    @foreach ($invoice as $inv)
    <div class="modal fade" id="verticalycentered{{$inv->id}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vertically Centered</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{route('employee.update',$inv->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group mb-3">
                                    <label for="">No surat/Performance invoice</label>
                                    <input type="text" class="form-control" name="no_employe" value="{{$inv->no_invoice}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Tanggal</label>
                                    <input type="date" class="form-control" name="name" value="{{$inv->date}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Nama Perusahaan</label>
                                    <input type="text" class="form-control" name="position" value="{{$inv->company_name}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Nama Pekerjaan</label>
                                    <input type="text" class="form-control" name="position" value="{{$inv->job_name}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Nilai pekerjaan</label>
                                    <input type="text" class="form-control" name="position" value="{{$inv->value}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Penerbitan</label>
                                    <input type="text" class="form-control" name="position" value="{{$inv->penerbitan}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">SPI</label>
                                    <input type="text" class="form-control" name="position" value="{{$inv->spi}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Pelunasan</label>
                                    <input type="text" class="form-control" name="position" value="{{$inv->pelunasan}}">
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
