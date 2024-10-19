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
                    <h5 class="card-title">Project</h5>
                    <div>
                        <a href="{{ route('project.create') }}" class="btn btn-primary">Create</a>
                    </div>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Agenda SPI</th>
                                <th>NO.SPI</th>
                                <th>Tanggal</th>
                                <th>Pemohon / Perusahaan</th>
                                <th>Project</th>
                                <th>Divisi</th>
                                <th>Status</th>
                                <th>Spesifikasi / Detali Lingkup Pekerjaan</th>
                                <th>No.PO</th>
                                <th>Tanggal</th>
                                <th>Nilai Kontrak</th>
                                <th>Kontrak PO</th>
                                <th>Durasi Kontrak</th>
                                <th>Sisa Waktu</th>
                                <th>Lampiran</th>
                                <th>Kode Fike</th>
                                <th>Keterangan / Alamat</th>
                                <th>Lokasi Pekerjaan</th>
                                <th>Personal Kontak</th>
                                <th>No. Telepon</th>
                                <th>FAX</th>
                                <th>Manager Proyek</th>
                                <th>Anggota Team</th>
                                <th>CRM</th>
                                <th>Order No.</th>
                                <th>SAP</th>
                                <th>Nomor SO</th>
                                <th>No. WBS</th>
                                <th>Sikom</th>
                                <th>ID NO.</th>
                                <th>Anggaran</th>
                                <th>Rencana Keterangan</th>
                                <th>Progres Realisasi Pekerjaan</th>
                                <th>Progress</th>
                                <th>Schedule Invoice</th>
                                <th>Keterangan</th>
                                <th>Penerbitan Laporan</th>
                                <th>Produksi</th>
                                <th>Fortofolio</th>
                                <th>List</th>
                                <th></th>
                                <th>Kompetensi</th>
                                <th>Pasar</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project as $prj)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prj->no_employe }}</td>
                                    <td>{{ $prj->name }}</td>
                                    <td>{{ $prj->position }}</td>
                                    <td>{{ Carbon\Carbon::parse($prj->dob)->format('d M Y') }}</td>
                                    <td>{{ $prj->gender }}</td>
                                    <td>{{ Carbon\Carbon::parse($prj->dob)->age }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered{{$prj->id}}">
                                            <i class="fas fa-eye"></i>
                                          </button>
                                          <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $prj->id }}">
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

    @foreach ($employes as $prj)
    <div class="modal fade" id="verticalycentered{{$prj->id}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vertically Centered</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{route('project.update',$prj->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group mb-3">
                                    <label for="">Nomor Karyawan</label>
                                    <input type="text" class="form-control" name="no_employe" value="{{$prj->no_employe}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$prj->name}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Position</label>
                                    <input type="text" class="form-control" name="position" value="{{$prj->position}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Contract" {{$prj->status == 'Contract' ? 'selected':''}}>Permanent</option>
                                        <option value="Contract" {{$prj->status == 'Contract' ? 'selected':''}}>Contract</option>
                                        <option value="Contract" {{$prj->status == 'Trainer' ? 'selected':''}}>Trainer</option>
                                        <option value="Contract" {{$prj->status == 'Intern' ? 'selected':''}}>Intern</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="Male" {{$prj->status == 'Male' ? 'selected':''}}>Male</option>
                                        <option value="Female" {{$prj->status == 'Female' ? 'selected':''}}>Female</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">DOB</label>
                                    <input type="date" class="form-control" name="dob" value="{{$prj->dob}}">
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
                                        <img src="{{asset('employee-photo/' .$prj->photo)}}" alt="" class="img-fluid">
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
