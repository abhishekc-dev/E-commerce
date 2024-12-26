@extends('layouts.main-layout')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg d-flex justify-content-center">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <!-- <h6 class="title nk-block-title">Sub Category</h6>
                            <div class="nk-block-des">
                                <p>Total Sub Category</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="card card-bordered w-50">
                        <div class="card-inner">
                            <div class="card-head d-flex justify-content-center">
                                <h5 class="card-title">
                                    @if(count($single) > 0)
                                        Edit Sub Category
                                    @else
                                        Add Sub Category
                                    @endif
                                </h5>
                            </div>
                            @if(count(value: $single) > 0)
                                <form action={{route('update.subcategory', $single[0]->SUBCAT_ID)}}
                                    class="is-alter form-validate" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Category</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select js-select2" data-search="on" id="dd_cat"
                                                        name="dd_cat" data-placeholder="Select Category" required>
                                                        <option value=""></option>
                                                        @foreach ($category as $value)
                                                            <option value="{{$value->CATEGORY_ID}}" {{ $single[0]->PARENT_ID == $value->CATEGORY_ID ? 'selected' : '' }}>
                                                                {{$value->CATEGORY_NAME}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="txt_subcategory">Sub
                                                    Category</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="txt_subcategory"
                                                        name="txt_subcategory" placeholder="Enter Sub Category"
                                                        value="{{$single[0]->SUBCAT_NAME}}">
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
                                                        <label class="form-file-label" for="txt_file">Choose
                                                            file</label>
                                                        <input type="hidden" class="form-file-input" id="txt_old_image"
                                                            name="txt_old_image" value="{{$single[0]->SUBCAT_IMAGE}}"
                                                            required>
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
                            @else
                                <form action={{route('create.subcategory')}} class="is-alter form-validate" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Category <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select js-select2" data-search="on" id="dd_cat"
                                                        name="dd_cat" data-placeholder="Select Category" required>
                                                        <option value=""></option>
                                                        @foreach ($category as $value)
                                                            <option value="{{$value->CATEGORY_ID}}" {{ old('dd_cat') == $value->CATEGORY_ID ? 'selected' : '' }}>
                                                                {{$value->CATEGORY_NAME}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="txt_subcategory">Sub Category<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="txt_subcategory"
                                                        name="txt_subcategory" value="{{old('txt_subcategory')}}"
                                                        placeholder="Enter Sub Category">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="txt_file">Image<span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <div class="form-file">
                                                        <input type="file" class="form-file-input" accept=".jpg,.png,.jpeg"
                                                            id="txt_file" name="txt_file" required>
                                                        <label class="form-file-label" for="txt_file">Choose file</label>
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
                                        <th>Category</th>
                                        <th>Sub Category </th>
                                        <th>image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($subcat) > 0)
                                        @foreach ($subcat as $key => $value)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->CATEGORY_NAME }}</td>
                                                <td>{{ $value->SUBCAT_NAME }}</td>
                                                <td> <em class="icon ni ni-eye fs-4"
                                                        onclick="imgModal('{{asset('images/' . $value->SUBCAT_IMAGE)}}')"></em>
                                                </td>
                                                <td
                                                    class="{{ $value->SUBCAT_STATUS == 'ACTIVE' ? 'text-success' : 'text-danger' }}">
                                                    <strong>{{ $value->SUBCAT_STATUS }}</strong>
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
                                                                            href="{{ route('category.status', $value->SUBCAT_ID) }}">
                                                                            <em class="icon ni ni-reload"></em><span>Change
                                                                                Status</span></a></li>
                                                                    <li><a
                                                                            href="{{ route('edit.subcategory', $value->SUBCAT_ID) }}">
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