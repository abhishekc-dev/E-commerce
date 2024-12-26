@extends('layouts.main-layout')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg d-flex justify-content-center">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <!-- <h4 class="title nk-block-title">Category</h4>
                            <div class="nk-block-des">
                                <p>Total Category</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="card card-bordered w-50 align-items-center">
                        <div class="card-inner">
                            <div class="card-head d-flex justify-content-center">
                                <h5 class="card-title">
                                    @if(count($single) > 0)
                                        Edit Category
                                    @else
                                        Add Category
                                    @endif
                                </h5>
                            </div>
                            @if(count($single) > 0)
                                <form action="{{route('update.category', $single[0]->CATEGORY_ID)}}"
                                    class="is-alter form-validate" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="txt_cat">Category Name <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="txt_cat" name="txt_cat"
                                                        placeholder="Enter Category name"
                                                        value="{{$single[0]->CATEGORY_NAME}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="txt_file">Image</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-file">
                                                        <input type="file" class="form-file-input" accept=".jpg,.png,.jpeg"
                                                            id="txt_file" name="txt_file">
                                                        <label class="form-file-label" for="txt_file">Choose file</label>
                                                        <input type="hidden" class="form-file-input" id="txt_old_image"
                                                            name="txt_old_image" value="{{$single[0]->CATEGORY_IMAGE}}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-secondary">Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="d-flex justify-content-center">
                                    <form action={{route('create.category')}} class="is-alter form-validate" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-4 ">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="txt_cat">Category Name<span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="txt_cat" name="txt_cat"
                                                            placeholder="Enter Category name" required
                                                            value="{{old('txt_cat')}}">
                                                        @error('txt_cat')
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="txt_file">Image<span
                                                            class="text-danger">*</span></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input"
                                                                accept=".jpg,.png,.jpeg" id="txt_file" name="txt_file"
                                                                required>
                                                            <label class="form-file-label" for="txt_file">Choose
                                                                file</label>
                                                            @error('txt_file')
                                                                <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-secondary">Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            @endif

                        </div>
                    </div>
                </div><!-- .nk-block -->

                <div class="nk-block nk-block-lg">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nowrap table">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Category Name</th>
                                        <th>image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($all_cat) > 0)
                                        @foreach ($all_cat as $key => $value)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->CATEGORY_NAME }}</td>
                                                <td> <em class="icon ni ni-eye fs-4"
                                                        onclick="imgModal('{{asset('images/' . $value->CATEGORY_IMAGE)}}')"></em>
                                                </td>
                                                <td
                                                    class="{{ $value->CATEGORY_STATUS == 'ACTIVE' ? 'text-success' : 'text-danger' }}">
                                                    <strong>{{ $value->CATEGORY_STATUS }}</strong>
                                                </td>
                                                <td>
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                                data-bs-toggle="dropdown"><em
                                                                    class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a
                                                                            href="{{ route('category.status', $value->CATEGORY_ID) }}">
                                                                            <em class="icon ni ni-reload"></em><span>Change
                                                                                Status</span></a></li>
                                                                    <li><a
                                                                            href="{{ route('edit.category', $value->CATEGORY_ID) }}">
                                                                            <em class="icon ni ni-edit"></em>
                                                                            <span>Edit</span></a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->

            </div><!-- .components-preview -->
        </div>
    </div>
</div>


@endsection