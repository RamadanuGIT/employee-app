@extends('partials.header')
@section('content')
<div class="row">
    <div class="mb-3 text-end">
        <a href="{{route('employee')}}" class="btn btn-primary"> <i class="fas fa-arrow-left"> </i>Back</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="">Nomor Karyawan</label>
                    <input type="text" class="form-control" name="no_employe" value="{{old('no_employe')}}">
                    @error('no_employe')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Position</label>
                    <input type="text" class="form-control" name="position" value="{{old('position')}}">
                    @error('position')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" value="{{old('dob')}}">
                    @error('dob')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Gender</label>
                    <select name="gender" class="form-control" id="">
                        <option value="" disabled selected>-- Select --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @error('gender')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="" disabled selected>-- Select --</option>
                        <option value="Permanent">Permanent</option>
                        <option value="Contract">Contract</option>
                        <option value="Contract">Trainer</option>
                        <option value="Contract">Intern</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="">Photo</label>
                    <input id="fileInput" type="file" accept="jpeg,png" class="form-control" name="photo">
                </div>
                <div class="mb-3">
                    <div class="col-lg-4">
                        <img src="" id="preview" alt="" class="img-fluid" style="height: 100px">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>


            </form>
        </div>
    </div>
</div>
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
@endpush
