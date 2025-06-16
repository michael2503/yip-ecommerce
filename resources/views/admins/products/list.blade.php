<x-admin-app-layout>


        <h5>Products</h5>
        <hr>

        <div class="card card-body">

            <div class="table-responsive-sm">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sold</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $curr.number_format($item->sales_price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->sold }}</td>
                            <td>
                                <a href="{{ route('adminproduct.single', $item->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" onclick="deleteProduct({{ $item->id }})"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="5">No product</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>

        </div>



        <!-- The Modal -->
        <div class="modal fade" id="delModal">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">

                    <form action="{{ route('adminproduct.destroy') }}" method="post">
                        @csrf
                        @method('Delete')

                        <!-- Modal body -->
                        <div class="modal-body text-center">
                            <p class="mt-3">Are you sure you want to delete this product?</p>
                            <input type="hidden" id="delInputID" name="id">

                            <div class="mt-4 mb-3">
                                <button class="btn btn-success btn-sm mr-4">Yes</button>
                                <button class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <script>
            function deleteProduct(imgId) {
                document.getElementById('delInputID').value = imgId;
                $('#delModal').modal();
            }
        </script>
</x-admin-app-layout>
