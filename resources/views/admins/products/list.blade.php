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
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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


</x-admin-app-layout>
