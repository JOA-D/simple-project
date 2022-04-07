@extends('../welcome')
@section('title','index') 
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
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Created At</th>
                <th>Updated At</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($admins as $admin)
                <tr>
                  <td>{{$admin->id}}</td>
                  <td>{{$admin->email}}</td>
                  <td>{{$admin->user ? $admin->user->name:"NULL"}}</td>
                  <td>{{$admin->user ? $admin->user->mobile:"NULL"}}</td>
                  <td>{{$admin->created_at}}</td>
                  <td>{{$admin->updated_at}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('admins.edit',$admin->id) }}" type="button" class="btn btn-info btn-flat">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" onclick="performDestroy({{$admin->id}},this)" class="btn btn-danger btn-flat">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection
@section('script')
<script>
  function performDestroy(id,ref){
    confirmDestroy('/admins/'+id,ref)
  }
</script>
@endsection