<x-admin-app-layout>


        <h2>Dashboard</h2>
        <hr>


        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-body p-2 rounded mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="icon">
                            <h2 class="bg-success p-3 mt-1 rounded-circle text-white"><i class="fa fa-users"></i></h2>
                        </div>
                        <div>
                            <p class="mb-0 mt-2 text-muted">Total Users</p>
                            <h4 class="mb-0 mt-2 text-right">{{ $allUsers }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-body p-2 rounded mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="icon">
                            <h2 class="bg-success p-3 mt-1 rounded-circle text-white"><i class="fa fa-shopping-cart"></i></h2>
                        </div>
                        <div>
                            <p class="mb-0 mt-2 text-muted">All Orders</p>
                            <h4 class="mb-0 mt-2 text-right">{{ $allOrders }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-body p-2 rounded mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="icon">
                            <h2 class="bg-success p-3 mt-1 rounded-circle text-white"><i class="fa fa-gem"></i></h2>
                        </div>
                        <div>
                            <p class="mb-0 mt-2 text-muted">All Products</p>
                            <h4 class="mb-0 mt-2 text-right">{{ $allproducts }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-body p-2 rounded mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="icon">
                            <h2 class="bg-success p-3 mt-1 rounded-circle text-white"><i class="fa fa-shopping-cart"></i></h2>
                        </div>
                        <div>
                            <p class="mb-0 mt-2 text-muted">Processing Order</p>
                            <h4 class="mb-0 mt-2 text-right">{{ $processingOrder }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</x-admin-app-layout>
