<x-admin-app-layout>


        <h5>Product Category</h5>
        <hr>




        <div class="row">
            <div class="col-xl-6">
                <div class="card card-body p-2">
                    <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">ADD CATEGORY</p>

                    <form action="{{ route('admincategory.post') }}" method="post" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group mt-4">
                            <label for="">category <span class="text-danger">*</span></label>
                            <input type="text" class="form-control proName" name="category" value="{{ old('category') }}">
                            <p class="text-danger mb-0"><small>{{ $errors->first('category') }}</small></p>
                        </div>

                        <div class="mt-4 text-center mb-3">
                            <button class="btn btn-primary btn-sm">Submit Category</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card card-body p-2">
                    <p class="bg-secondary text-white pt-2 pr-3 pb-2 pl-3">ALL CATEGORIES</p>

                    @forelse ($categories as $cat)
                    <div class="d-flex justify-content-between">
                        <p>{{ $cat->category }}</p>
                    </div>
                    @empty

                    @endforelse
                </div>


            </div>
        </div>


</x-admin-app-layout>
