@extends('templates.default')
@section('content')

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Account</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->

    <div class="row">

        <div class="hidden-lg col-md-2">
            <div class="container-fluid" style="display: inline; margin: 20px" id="cssmenu">
                <ul>
                    <li><a href='{{ route('admin.account') }}'><span>Profile</span></a></li>

                    <li class='active has-sub'><a href='#'><span>Manage Products</span></a>
                        <ul>
                            <li>
                                <a href='{{ route('admin.product.add', ['type' => 'Product']) }}'><span>Add Product</span></a>
                            </li>
                            <li><a href='{{ route('admin.product.add', ['type' => 'Raw']) }}'><span>Add Raw</span></a>
                            </li>
                            <li><a href='{{ route('admin.product.add', ['type' => 'Crop']) }}'><span>Add Crop</span></a>
                            </li>
                            <li><a href='{{ route('admin.product.edit') }}'><span>Edit</span></a></li>
                            <li><a href='{{ route('admin.product.categories') }}'><span>Categories</span></a></li>
                        </ul>
                    </li>

                    <li class='active has-sub'><a href='#'><span>Orders</span></a>
                        <ul>
                            <li><a href='{{ route('admin.orders') }}'><span>Active</span></a></li>
                            <li><a href='#'><span>Completed</span></a></li>
                        </ul>
                    </li>

                    <li class='active has-sub'><a href='#'><span>Manage Users</span></a>
                        <ul>
                            <li><a href='{{ route('admin.customers') }}'><span>Customers</span></a></li>
                            <li><a href='{{ route('admin.consultants') }}'><span>Consultants</span></a></li>
                            <li><a href='{{ route('admin.employees') }}'><span>Employees</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

        <div class="col-lg-2 hidden-md hidden-xs hidden-sm">
            <div class="container-fluid" id="cssmenu">
                <ul>
                    <li><a href='{{ route('admin.account') }}'><span>Profile</span></a></li>

                    <li class='active has-sub'><a href='#'><span>Manage Products</span></a>
                        <ul>
                            <li>
                                <a href='{{ route('admin.product.add', ['type' => 'Product']) }}'><span>Add Product</span></a>
                            </li>
                            <li><a href='{{ route('admin.product.add', ['type' => 'Raw']) }}'><span>Add Raw</span></a>
                            </li>
                            <li><a href='{{ route('admin.product.add', ['type' => 'Crop']) }}'><span>Add Crop</span></a>
                            </li>
                            <li><a href='{{ route('admin.product.edit') }}'><span>Edit</span></a></li>
                            <li><a href='{{ route('admin.product.categories') }}'><span>Categories</span></a></li>
                        </ul>
                    </li>

                    <li class='active has-sub'><a href='#'><span>Orders</span></a>
                        <ul>
                            <li><a href='{{ route('admin.orders') }}'><span>Active</span></a></li>
                            <li><a href='{{ route('admin.issued_orders') }}'><span>Completed</span></a></li>
                        </ul>
                    </li>

                    <li class='active has-sub'><a href='#'><span>Manage Users</span></a>
                        <ul>
                            <li><a href='{{ route('admin.customers') }}'><span>Customers</span></a></li>
                            <li><a href='{{ route('admin.consultants') }}'><span>Consultants</span></a></li>
                            <li><a href='{{ route('admin.employees') }}'><span>Employees</span></a></li>
                        </ul>
                    </li>
                    <li class='active has-sub'><a href='#'><span>Notifications</span></a>
                        <ul>
                            <li><a href='{{ route('admin.notifications.add') }}'><span>Post</span></a></li>
                            <li><a href='{{ route('admin.notifications.list') }}'><span>List</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

        @yield('adminpage')

    </div>

@stop
