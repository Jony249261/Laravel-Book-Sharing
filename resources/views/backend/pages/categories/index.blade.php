@extends('backend.layouts.app')

@section('content')
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Manage Category</h1>

      <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus-circle fa-sm text-white-50" ></i> Add Category</a>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('admin.categories.store') }}" method="post">
              @csrf

              <div class="row">
                <div class="col-md-6">
                  <label for="">Category Name</label>
                  <br>
                  <input type="text" class="form-control" name="name" placeholder="Category Name">
                </div>
                <div class="col-md-6">
                  <label for="">Category URL Text</label>
                  <br>
                  <input type="text" class="form-control" name="slug" placeholder="Category Slug, e.g, c-programming">
                </div> 

                <div class="col-md-12">
                <br>
                  <label for="parent_id">Parent Category</label>
                  <br>
                  <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">Select a category</option>
                    @foreach ($parent_categories as $parent)
                      <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="col-12">
                <br>
                  <label for="">Category Details</label>
                  <br>
                  <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Category Description"></textarea>
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
              <h6 class="m-0 font-weight-bold text-primary">Category Lists</h6>
            </div>
            <div class="card-body">
              
              <table class="table" id="dataTable">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Parent Category</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->slug }}</td>
                    <td>@if (!is_null($row->parent_category($row->parent_id)))
                        {{ $row->parent_category($row->parent_id)->name }}
                        @else
                        --
                      @endif</td>
                    @if($row->description  == NULL)
                    <td></td>
                    @else
                    <td>{{ $row->description }}</td>
                    @endif
                    <td>
                      <a href="#editModal{{ $row->id }}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>

                      <a href=" {{ route('admin.categories.delete', $row->id) }}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                  </tr>



                  <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                          <form action="{{ route('admin.categories.update', $row->id) }}" method="post">
                            @csrf

                            <div class="row">
                              <div class="col-md-6">
                                <label for="">Category Name</label>
                                <br>
                                <input type="text" class="form-control" name="name" placeholder="Category Name" value="{{ $row->name }}">
                              </div>
                              <div class="col-md-6">
                                <label for="">Category URL Text</label>
                                <br>
                                <input type="text" class="form-control" name="slug" placeholder="Category Slug, e.g, c-programming"  value="{{ $row->slug }}">
                              </div> 

                              <div class="col-md-12">
                                <label for="parent_id">Parent Category</label>
                                <br>
                                <select name="parent_id" id="parent_id" class="form-control">
                                  <option value="">Select a category</option>
                                  @foreach ($parent_categories as $parent)
                                    <option value="{{ $parent->id }}" {{ $row->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              
                              <div class="col-12">
                                <label for="">Category Details</label>
                                <br>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Category Description">{!! $row->description !!}</textarea>
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
                          
                          <form action="{{ route('admin.categories.delete', $row->id) }}" method="post">
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