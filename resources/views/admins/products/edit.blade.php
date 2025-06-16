<x-admin-app-layout>


        <h5>Edit product</h5>
        <hr>

        <form action="{{ route('adminproduct.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-body p-2">
                        <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">PRODUCT INFO</p>

                        <div class="form-group mt-4">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control proName" name="name" value="{{ old('name', $pro->name) }}">
                            <input type="hidden" class="form-control proName" name="id" value="{{ $pro->id }}">
                            <p class="text-danger mb-0"><small>{{ $errors->first('name') }}</small></p>
                        </div>

                        <div class="form-group">
                            <label for="">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control custom-select">
                                <option label="Select category" hidden></option>
                                @forelse ($categories as $cat)
                                    <option @if($pro->category == $cat->slug) selected @endif value="{{ $cat->slug }}">{{ $cat->category }}</option>
                                @empty

                                @endforelse
                            </select>
                            <p class="text-danger mb-0"><small>{{ $errors->first('category') }}</small></p>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="">Old Price</label>
                                    <input type="number" class="form-control" name="old_price" value="{{ old('old_price', $pro->old_price) }}">
                                    <p class="text-danger mb-0"><small>{{ $errors->first('old_price') }}</small></p>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="">Sales Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="sales_price" value="{{ old('sales_price', $pro->sales_price) }}">
                                    <p class="text-danger mb-0"><small>{{ $errors->first('sales_price') }}</small></p>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="">SKU <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" readonly class="form-control" id="skuInput" readonly value="{{ old('sku', $pro->sku) }}" name="sku" placeholder="Click on generate button to generate SKU">
                                        {{-- <div class="input-group-prepend">
                                        <button class="btn btn-primary" onclick="generateSku()" type="button">Generate</button>
                                        </div> --}}
                                    </div>
                                    <p class="text-danger mb-0"><small>{{ $errors->first('sku') }}</small></p>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="">Brand</label>
                                    <input type="text" class="form-control" name="brand" value="{{ old('brand', $pro->brand) }}">
                                    <p class="text-danger mb-0"><small>{{ $errors->first('brand') }}</small></p>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="">Quantity <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="quantity" value="{{ old('quantity', $pro->quantity) }}">
                                    <p class="text-danger mb-0"><small>{{ $errors->first('quantity') }}</small></p>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="fileUpload">
                                    <div class="row">
                                        @foreach ($images as $pimg)
                                        <div class="col-xl-4">
                                            <div class="imgWrap">
                                                <img class='uploadedImg' src='{{ $pimg->image }}' />
                                                <span onclick="delProImg({{ $pimg->id }})" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="document">Click or Drop your image in the box below</label>
                                    <div class="needsclick dropzone" id="document-dropzone">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card-body p-2">
                        <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">PRODUCT DETAILS</p>
                        <div class="form-group">
                            <textarea name="description" id="elm1">{{ old('description', $pro->description) }}</textarea>
                            <p class="text-danger mb-0"><small>{{ $errors->first('description') }}</small></p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary btn-sm">Update Product</button>
                    </div>
                </div>
            </div>
        </form>


        <!-- The Modal -->
        <div class="modal fade" id="delModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form action="{{ route('adminDeleteProductImage') }}" method="post">
                        @csrf
                        @method('Delete')
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Warning</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Are you sure you want to delete this image?
                            <input type="hidden" id="delInputID" name="id">
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


</x-admin-app-layout>

<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{ route('adminUploadProImg') }}',
        maxFilesize: 5, // MB
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
            name = file.file_name
            } else {
            name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($project) && $project->document)
            var files =
                {!! json_encode($project->document) !!}
            for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }

    function delProImg(imgId) {
        document.getElementById('delInputID').value = imgId;
        $('#delModal').modal();
    }
</script>
