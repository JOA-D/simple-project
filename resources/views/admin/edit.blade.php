@extends('../welcome')
@section('title','create')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form id="create_form">
            @csrf
            <div class="card-body">
                <div class="form-group col-md-4">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" name="email" id="email" value="{{$admins->email}}" placeholder="Enter email">
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$admins->user->name}}"placeholder="name">
              </div>
            
              <div class="form-group col-md-4">
                <label for="mobile">Mobile</label>
                <input type="tel" class="form-control" name="mobile" id="mobile" value="{{$admins->user->mobile}}"placeholder="mobile">
              </div>
             
            
              {{-- <div class="form-group col-md-4">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div>
            </div> --}}
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="button" onclick="performUpdate({{$admins->id}})" class="btn btn-primary">update</button>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
@section('script')
<script>
  function performUpdate(id ){
    let data = {
      email: document.getElementById('email').value,
      name: document.getElementById('name').value,
      mobile: document.getElementById('mobile').value,
    }
    let redirectUrl = '/admins';
    update('/admins/'+id,data ,redirectUrl );
  }
  </script>
@endsection

