<div class="modal fade" id="{{ $product->id }}Modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-shopping-cart"></span>Add to Cart</h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form role="form" method="post" action="{{ route('user.cart.add_to_cart') }}">
                    <select class="package-list-dropdown form-control" name="package_id">
                        @foreach($packages as $package)
                            @if($package->product_id == $product->id)
                                <option value="{{ $package->id }}">
                                    {{ $package->package }} for Rs.{{ $package->price }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <div class="container-fluid">
                        <div class="row" style="margin-top: 30px">
                            <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: center; padding: 5px;">
                                <button type="SUBMIT" class="btn-success btn btn-block" name="action" value="add">
                                    Add to Cart
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6" style="text-align: center; padding: 5px;">
                                <button class="btn-warning btn btn-block" data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 30px">
                            <div class="col-md-12" style="text-align: center; padding: 5px;">
                                <button type="SUBMIT" class="btn btn-success btn-block" name="action" value="checkout">
                                    Add to Cart & Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>
    </div>

</div>