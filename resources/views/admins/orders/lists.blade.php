<x-admin-app-layout>


        <h5>Orders</h5>
        <hr>

        <div class="card card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>User</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Created On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $item)
                        <tr>
                            <td>{{ strtoupper($item->order_number) }}</td>
                            <td>{{ ucwords($item->user->name) }}</td>
                            <td>{{ $curr.number_format($item->total_amount) }}</td>

                            <td>
                                @if($item->status == 'pending')
                                <span class="bg-gray text-info" style="font-size: 13px">Pending</span>
                                @elseif($item->status == 'delivered')
                                <span class="bg-gray text-success" style="font-size: 13px">Delivered</span>
                                @elseif($item->status == 'cancelled')
                                <span class="bg-gray text-danger" style="font-size: 13px">{{ $item->status}}</span>
                                @elseif($item->status == 'processing')
                                <span class="bg-gray text-warning" style="font-size: 13px">{{ $item->status}}</span>
                                @elseif($item->status == 'shipped')
                                <span class="bg-gray text-info" style="font-size: 13px">{{ $item->status}}</span>
                                @endif
                            </td>
                            <td>{{ date('d M, Y', strtotime($item->created_at)) }}</td>
                            <td>
                                <a href="{{ route('adminOrderDetails', [$item->id, $item->order_number]) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="6">No Order</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>



</x-admin-app-layout>
