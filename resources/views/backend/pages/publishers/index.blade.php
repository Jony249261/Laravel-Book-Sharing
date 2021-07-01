@extends('backend.layouts.app')

@section('content')
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Manage Publishers</h1>

      <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus-circle fa-sm text-white-50" ></i> Add Publisher</a>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Publishers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('admin.publishers.store') }}" method="post">
              @csrf

              <div class="row">
                <div class="col-6">
                  <label for="">Publisher Name</label>
                  <br>
                  <input type="text" class="form-control" name="name" placeholder="Publisher Name">
                  @error('name')
                            <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="col-6">
                  <label for="">Publisher Address</label>
                  <br>
                  <input type="text" class="form-control" name="address" placeholder="Publisher Address">
                  @error('address')
                            <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="col-6">
                <br>
                  <label for="">Publisher Outlet</label>
                  <br>
                  <input type="text" class="form-control" name="outlet" placeholder="Publisher Outlet">
                  @error('outlet')
                            <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="col-12">
                <br>
                  <label for="">Publisher Details</label>
                  <br>
                  
                  <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Publisher Description"></textarea>
                  @error('description')
                            <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>

          </div>
          
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">row Lists</h6>
            </div>
            <div class="card-body">
              
              <table class="table" id="dataTable">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Outlet</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($publishers as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->link }}</td>
                    <td>{{ $row->outlet }}</td>
                    <td>{{ $row->address }}</td>
                    @if($row->description  == NULL)
                    <td></td>
                    @else
                    <td>{{ $row->description }}</td>
                    @endif
                    <td>
                      <a href="#editModal{{ $row->id }}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>

                      <a href=" {{ route('admin.publishers.delete', $row->id) }}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                  </tr>


                  <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Publisher</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                          <form action="{{ route('admin.publishers.update', $row->id) }}" method="post">
                            @csrf

                            <div class="row">
                              <div class="col-6">
                                <label for="">Publisher Name</label>
                                <br>
                                <input type="text" class="form-control" name="name" placeholder="row Name" value="{{ $row->name }}">
                              </div>
                              <div class="col-6">
                                <label for="">Publisher Address</label>
                                <br>
                                <input type="text" class="form-control" name="name" placeholder="row Name" value="{{ $row->address }}">
                              </div>
                              <div class="col-6">
                              <br>
                                <label for="">Publisher Outlet</label>
                                <br>
                                <input type="text" class="form-control" name="name" placeholder="row Name" value="{{ $row->outlet }}">
                              </div>
                              <div class="col-12">
                              <br>
                                <label for="">Publisher Details</label>
                                <br>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="row Description">{!! $row->description !!}</textarea>
                              </div>
                            </div>

                            <div class="mt-4">
                              <button type="submit" class="btn btn-primary">Update</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          </div>
                          </form>

                        </div>
                        
                      </div>
                    </div>
                  </div>


                  <!-- Delete Modal -->
                  <!--
                  <div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete ?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                          <form action="{{ route('admin.publishers.delete', $row->id) }}" method="post">
                            @csrf

                            <div>
                              {{ $row->name }} will be deleted !!
                            </div>

                            <div class="mt-4">
                              <button type="submit" class="btn btn-primary">Ok, Confirm</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          </div>
                          </form>

                        </div>
                        
                      </div>
                    </div>
                  </div> -->
                  <!-- Delete Modal -->
              
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>


@endsection