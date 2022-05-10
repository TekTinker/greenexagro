<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/3/2016
 * Time: 5:54 PM
 */

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Consultant;
use App\Models\Contact;
use App\Models\Crop;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Base
{


    public function postContactMessage(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'name' => 'required|string|max:60',
            'message' => 'required',
        ]);

        $msg = "Message : " . $request->input('message') . "<br />";
        $msg .= "Name : " . $request->input('name') . "<br />";
        $msg .= "Mobile : " . $request->input('mobile') . "<br />";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: ' . $request->input('email') . "\r\n";

        mail("support@greenexagro.com","Contact",$msg,$headers);


        return redirect()
            ->route('contact_us')
            ->with('info', 'Thank you for contacting us, We will get in touch with you as soon as possible.');

    }

    /*
     * User profile tasks
     */
    public function getAccount()
    {
        $user = Auth::user();
        if ($user->role == 'customer') {
            $customer = Customer::find($user->id);
            return view('pages.customer.account', [
                'user' => $user,
                'customer' => $customer,
                'cart' => Auth::user()->cart,
            ]);
        } elseif ($user->role == 'consultant') {
            $consultant = Consultant::find($user->id);
            return view('pages.consultant.account', [
                'user' => $user,
                'consultant' => $consultant,
                'cart' => Auth::user()->cart,
            ]);
        }
    }

    public function getAddFarmsOnSignUp()
    {
        $user = Auth::user();

        if ($user->role == 'customer') {
            $customer = Customer::find($user->id);
            return view('pages.customer.add_farms', [
                'user' => $user,
                'customer' => $customer,
                'cart' => Auth::user()->cart,
                'crops' => Customer::find($user->id)->crops,
            ]);
        } else {
            return redirect()->route('home');
        }

    }

    public function getAccountEditProfile()
    {
        $user = Auth::user();
        if ($user->role == 'customer') {
            $customer = Customer::find($user->id);
            return view('pages.customer.edit_profile', [
                'user' => $user,
                'customer' => $customer,
                'cart' => Auth::user()->cart,
            ]);
        } elseif ($user->role == 'consultant') {
            $consultant = Consultant::find($user->id);
            return view('pages.consultant.edit_profile', [
                'user' => $user,
                'customer' => $consultant,
                'cart' => Auth::user()->cart,
            ]);
        } elseif ($user->role == 'employee') {
            $employee = Employee::find($user->id);
            return view('pages.employee.edit_profile', [
                'user' => $user,
                'employee' => $employee,
            ]);
        } elseif ($user->role == 'admin') {
            return view('pages.admin.edit_profile', [
                'user' => $user,
            ]);
        }
    }

    public function postAccountEditProfile(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $this->validate($request, [
                'name' => 'string|max:30',
            ]);

            $user->name = $request->input('name');
            $user->mobile = $request->input('mobile');

            $user->save();

            return redirect()->route('admin.account')->with('info', 'Profile saved.');

        } else {
            $this->validate($request, [
                'name' => 'string|max:30',
                'address' => 'required|string',
                'taluka' => 'required|alpha',
                'district' => 'required|alpha',
                'pin' => 'required|digits:6',
                'mobile' => 'required|digits:10',
            ]);

            if ($user->mobile != $request->input('mobile')) {
                $this->validate($request, [
                    'mobile' => 'required|digits:10|unique:users',
                ]);
                $user->mobile = $request->input('mobile');
            }
            $user->name = $request->input('name');


            $user->save();

            if ($user->role == 'customer') {
                $customer = Customer::find($user->id);
                $customer->address = $request->input('address');
                $customer->taluka = $request->input('taluka');
                $customer->district = $request->input('district');
                $customer->pin = $request->input('pin');
                $customer->save();
            } elseif ($user->role == 'consultant') {
                $consultant = Consultant::find($user->id);
                $consultant->address = $request->input('address');
                $consultant->taluka = $request->input('taluka');
                $consultant->district = $request->input('district');
                $consultant->pin = $request->input('pin');
                $consultant->save();
            } elseif ($user->role == 'employee') {
                $employee = Employee::find($user->id);
                $employee->address = $request->input('address');
                $employee->taluka = $request->input('taluka');
                $employee->district = $request->input('district');
                $employee->pin = $request->input('pin');
                $employee->save();
            }
            return redirect()->route('user.account')->with('info', 'Profile saved.');
        }

    }

    public function getAccountEditPassword()
    {
        $user = Auth::user();
        if ($user->role == 'customer') {
            $customer = Customer::find($user->id);
            return view('pages.customer.edit_password', [
                'user' => $user,
                'customer' => $customer,
                'cart' => Auth::user()->cart,
            ]);
        } elseif ($user->role == 'consultant') {
            $consultant = Consultant::find($user->id);
            return view('pages.consultant.edit_password', [
                'user' => $user,
                'customer' => $consultant,
                'cart' => Auth::user()->cart,
            ]);
        } elseif ($user->role == 'employee') {
            $employee = Employee::find($user->id);
            return view('pages.employee.edit_password', [
                'user' => $user,
                'employee' => $employee,
            ]);
        } elseif ($user->role == 'admin') {
            return view('pages.admin.edit_password', [
                'user' => $user,
            ]);
        }
    }

    public function postAccountEditPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'retype' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (Hash::check($request->input('password'), $user->password)) {
            $user->password = bcrypt($request->input('new_password'));
            $user->save();
            if ($user->role == 'admin') {
                return redirect()->route('admin.account')->with('info', 'Password changed successfully.');
            } elseif ($user->role == 'customer') {
                return redirect()->route('user.account')->with('info', 'Password changed successfully.');
            } elseif ($user->role == 'consultant') {

            } elseif ($user->role == 'employee') {

            }
            return redirect()->route('user.account')->with('info', 'Password changed successfully.');
        } else {
            return redirect()->back()->with('info-danger', 'Entered current password is wrong');
        }
    }


    /*
     * Customer profile tasks
     */
    public function getFarms()
    {
        $user = Auth::user();
        $crops = Customer::find($user->id)->crops;
        return view('pages.customer.manage_farms', [
            'crops' => $crops,
            'user' => $user,
            'cart' => Auth::user()->cart,
        ]);
    }

    public function getOrders()
    {
        $user = Auth::user();
        $orders = Order::where('customer_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($user->role == 'customer') {
            return view('pages.customer.orders', [
                'orders' => $orders,
                'user' => $user,
                'cart' => Auth::user()->cart,
            ]);
        } elseif ($user->role == 'consultant') {
            return view('pages.consultant.orders', [
                'orders' => $orders,
                'user' => $user,
                'cart' => Auth::user()->cart,
            ]);
        }

    }

    public function getOrderDetails($order_id)
    {
        $user = Auth::user();
        $order = Order::find($order_id);

        $order_items = $order->orderitems;

        if ($user->role == 'customer') {
            return view('pages.order_details', [
                'order' => $order,
                'order_items' => $order_items,
                'user' => $user,
                'details' => Customer::find($user->id),
                'cart' => Auth::user()->cart,
            ]);
        } elseif ($user->role == 'consultant') {
            return view('pages.order_details', [
                'order' => $order,
                'order_items' => $order_items,
                'details' => Consultant::find($user->id),
                'user' => $user,
                'cart' => Auth::user()->cart,
            ]);
        }

    }
    
    

    public function postFarmDelete($signUp, $id)
    {

        $crop = Customer::find(Auth::user()->id)->crops()->where('id', $id)->first();

        $crop->delete();

        if ($signUp == 1) {
            return redirect()->route('customer.sign_up.add_farms')->with('info', 'Crop deleted successfully');
        }

        return redirect()->route('customer.account.farms')->with('info', 'Crop deleted successfully');
    }

    public function postFarmAdd(Request $request, $signUp)
    {

        $this->validate($request, [
            'crop' => 'required|alpha',
            'area' => 'required|numeric',
        ]);

        $user = Auth::user();
        Crop::create([
            'customer_id' => $user->id,
            'crop_name' => $request->input('crop'),
            'area' => $request->input('area'),
        ]);
        if ($signUp == 1) {
            return redirect()->route('customer.sign_up.add_farms')->with('info', 'Crop added successfully');
        }


        return redirect()->route('customer.account.farms')->with('info', 'Crop added successfully');
    }


    /*
     * Shopping tasks
     */

    public function getProductDetails($id)
    {
        $product = Product::find($id);
        $packages = Package::where('product_id', $product->id)
            ->where('available', 1)
            ->get();
        $contents = explode(",", $product->contents);

        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                return view('pages.single_product_detail', [
                    'cart' => Auth::user()->cart,
                    'product' => $product,
                    'packages' => $packages,
                    'contents' => $contents,
                ]);
            } else
                return view('pages.single_product_detail', [
                    'product' => $product,
                    'packages' => $packages,
                    'contents' => $contents,
                ]);
        } else
            return view('pages.single_product_detail', [
                'product' => $product,
                'packages' => $packages,
                'contents' => $contents,
            ]);
    }

    public function getCropDetails($id)
    {
        $product = Product::find($id);

        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                return view('pages.single_crop_detail', [
                    'cart' => Auth::user()->cart,
                    'product' => $product,
                ]);
            } else
                return view('pages.single_crop_detail', [
                    'product' => $product,
                ]);
        } else
            return view('pages.single_crop_detail', [
                'product' => $product,
            ]);
    }

    public function getProducts($cat)
    {
        $categories = Category::where('type', 'product')
            ->where('available', 1)
            ->get();

        if ($cat == 'all') {
            $products = Product::where('type', 'product')
                ->where('available', 1)
                ->paginate(9);
        } else {
            $category = Category::find($cat);
            $products = Product::where('type', 'product')
                ->where('category_id', $category->id)
                ->where('available', 1)
                ->paginate(9);
        }

        $product_ids = Product::where('type', 'product')
            ->where('available', 1)
            ->lists('id')
            ->toArray();


        $packages = Package::whereIn('product_id', $product_ids)
            ->where('available', 1)
            ->get();

        $cart = null;

        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                $cart = Auth::user()->cart;
            }
        }

        return view('pages.products', [
            'products' => $products,
            'packages' => $packages,
            'categories' => $categories,
            'cart' => $cart,
        ]);
    }

    public function getCrops($cat)
    {
        $categories = Category::where('type', 'Crop')
            ->where('available', 1)
            ->get();

        if ($cat == 'all') {
            $products = Product::where('type', 'Crop')
                ->where('available', 1)
                ->paginate(9);
        } else {
            $category = Category::find($cat);
            $products = Product::where('type', 'Crop')
                ->where('category_id', $category->id)
                ->where('available', 1)
                ->paginate(9);
        }


        $cart = null;

        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                $cart = Auth::user()->cart;
            }
        }

        return view('pages.crops', [
            'products' => $products,
            'categories' => $categories,
            'cart' => $cart,
        ]);
    }

    public function getRaw($cat)
    {
        $categories = Category::where('type', 'raw')
            ->where('available', 1)
            ->get();

        if ($cat == 'all') {
            $products = Product::where('type', 'raw')
                ->where('available', 1)
                ->paginate(9);
        } else {
            $category = Category::find($cat);
            $products = Product::where('type', 'raw')
                ->where('category_id', $category->id)
                ->where('available', 1)
                ->paginate(9);
        }

        $product_ids = Product::where('type', 'raw')
            ->where('available', 1)
            ->lists('id')
            ->toArray();


        $packages = Package::whereIn('product_id', $product_ids)
            ->where('available', 1)
            ->get();

        $cart = null;

        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                $cart = Auth::user()->cart;
            }
        }

        return view('pages.raw', [
            'products' => $products,
            'packages' => $packages,
            'categories' => $categories,
            'cart' => $cart,
        ]);
    }

    public function getSearchByName(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $cart = null;

        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                $cart = Auth::user()->cart;
            }
        }

        $products = Product::where('name', 'like', '%' . $request->input('name') . '%')
            ->where('available', 1)
            ->paginate(9);

        $product_ids = $products->lists('id')->toArray();

        $packages = Package::whereIn('product_id', $product_ids)
            ->where('available', 1)->get();

        Session::put('search', count($product_ids));

        return view('pages.search', [
            'products' => $products,
            'packages' => $packages,
            'cart' => $cart,
        ]);
    }


    public function getCart()
    {
        $user = Auth::user();
        if ($user->role == 'customer') {
            $customer = Customer::find($user->id);
            return view('pages.cart', [
                'user' => $user,
                'user_details' => $customer,
                'cart' => Auth::user()->cart,
                'cart_items' => Auth::user()->cart->cart_items,
            ]);
        } elseif ($user->role == 'consultant') {
            $consultant = Consultant::find($user->id);
            return view('pages.cart', [
                'user' => $user,
                'user_details' => $consultant,
                'cart' => Auth::user()->cart,
                'cart_items' => Auth::user()->cart->cart_items,
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function postAddToCart(Request $request)
    {

        if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
            $actionType = $request->input('action');
            $package = Package::where('id', $request->input('package_id'))
                ->where('available', 1)->first();

            if (count($package) > 0) {

                $cart = Auth::user()->cart;

                $item_present = 0;

                $cart_items = $cart->cart_items;

                foreach ($cart_items as $item) {
                    if ($item->package_id == $package->id) {
                        $item->quantity++;
                        $item->save();
                        $item_present = 1;
                        break;
                    }
                }

                if ($item_present == 0) {
                    CartItem::create([
                        'cart_id' => $cart->cart_id,
                        'package_id' => $package->id,
                        'product_name' => $package->product_name,
                        'package' => $package->package,
                        'quantity' => 1,
                        'price' => $package->price,
                    ]);
                }

                $this->updateCart($cart->cart_id);

                if ($actionType == 'add')
                    return redirect()->back()->with('info', 'Added to cart');
                else
                    return redirect()->route('user.cart');

            } else
                return redirect()->back()->with('info-warning', 'Product not available');
        } else {
            return redirect()->back();
        }
    }

    protected function updateCart($cart_id)
    {
        $cart = Cart::find($cart_id);

        $cart->total_items = DB::table('cart_items')
            ->where('cart_id', $cart_id)
            ->sum('quantity');

        if ($cart->total_items > 0) {
            $cart_items = DB::table('cart_items')
                ->where('cart_id', $cart_id)->get();

            $cart_total_price = 0;

            foreach ($cart_items as $item) {
                $cart_total_price = $cart_total_price + ($item->quantity * $item->price);
            }
            $cart->total_price = $cart_total_price;
        } else
            $cart->total_price = 0;


        $cart->save();
    }

    public function postCheckout(Request $request, $action)
    {

        if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {

            $cart = Auth::user()->cart;

            DB::table('cart_items')->where('cart_id', $cart->cart_id)->delete();

            if (count($request->input('package_id')) > 0) {

                $package_id = $request->input('package_id');
                $package_quantity = $request->input('quantity');

                for ($i = 0; $i < count($request->input('package_id')); $i++) {
                    $package = Package::find($package_id[$i]);
                    CartItem::create([
                        'cart_id' => $cart->cart_id,
                        'package_id' => $package_id[$i],
                        'product_name' => $package->product_name,
                        'package' => $package->package,
                        'quantity' => $package_quantity[$i],
                        'price' => $package->price,
                    ]);
                }
                $this->updateCart($cart->cart_id);

                if ($action == 'update') {
                    return redirect()->route('user.cart')->with('info', 'Cart updated.');
                } else if ($action == 'checkout') {
                    return redirect()->route('user.checkoutpage');
                }


            } else {

                $cart->total_items = 0;
                $cart->total_price = 0;
                $cart->save();

                if ($action == 'update') {
                    return redirect()->route('user.cart')->with('info', 'Cart updated.');
                } else if ($action == 'checkout') {
                    return redirect()->route('user.checkoutpage');
                }

            }

        } else {
            return redirect()->back();
        }
    }

    public function getCheckoutPage()
    {
        $user = Auth::user();
        if ($user->role == 'customer') {
            $cart = $user->cart;
            $cart_items = $cart->cart_items;
            $details = Customer::find($user->id);


            return view('pages.checkout', [
                'user' => $user,
                'cart' => $cart,
                'cart_items' => $cart_items,
                'details' => $details,
            ]);
        } elseif ($user->role == 'consultant') {
            $cart = $user->cart;
            $cart_items = $cart->cart_items;
            $details = Consultant::find($user->id);

            return view('pages.checkout', [
                'user' => $user,
                'cart' => $cart,
                'cart_items' => $cart_items,
                'details' => $details,
            ]);
        } else {
            return redirect()->back()->with('info-warning', 'Please login as customer or consultant.');
        }
    }

    public function postCheckoutPage(Request $request)
    {
        $user = Auth::user();
        $details = null;
        if ($user->role == 'customer') {
            $details = Customer::find($user->id);
        } elseif ($user->role == 'consultant') {
            $details = Consultant::find($user->id);
        } else {
            return redirect()->back()->with('info-danger', 'Failed to place an order.');
        }
        if (!$user->cart->total_items > 0) {
            return redirect()->back()->with('info-danger', 'Cart empty');
        } elseif ($request->input('payment') == 'cod') {


            $order_id = Order::create([
                'customer_id' => $user->id,
                'customer_uid' => $user->uid,
                'address' => $details->address,
                'taluka' => $details->taluka,
                'district' => $details->district,
                'status' => 'active',
                'total_price' => $user->cart->total_price,
                'total_items' => $user->cart->total_items,
            ])->id;

            $package = null;
            foreach ($user->cart->cart_items as $item) {
                $package = Package::find($item->package_id);

                OrderItem::create([
                    'order_id' => $order_id,
                    'product_id' => $package->product_id,
                    'package_id' => $item->package_id,
                    'product_name' => $item->product_name,
                    'package' => $item->package,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
                $item->delete();
            }

            $user->cart->total_items = 0;
            $user->cart->total_price = 0;

            $user->cart->save();

            return redirect()->route('home')->with('info', 'Successfully placed the order.');

        } elseif ($request->input('payment') == 'online') {
            return redirect()->back()->with('info', 'Online payment not available at the moment');
        } else {

        }
    }

    public function index()
    {
        $news = DB::table('notifications')
            ->where('type', 'news')
            ->orderBy('updated_at')
            ->paginate(5);
        
        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                return view('home', [
                    'news' => $news,
                    'cart' => Auth::user()->cart,
                ]);
            } else
                return view('home', [
                    'news' => $news,
                ]);
        }
        return view('home', [
            'news' => $news,
        ]);
    }

    public function career()
    {
        $news = DB::table('notifications')
            ->where('type', 'career')
            ->orderBy('updated_at')
            ->paginate(20);

        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                return view('career', [
                    'news' => $news,
                    'cart' => Auth::user()->cart,
                ]);
            } else
                return view('career', [
                    'news' => $news,
                ]);
        }
        return view('career', [
            'news' => $news,
        ]);
    }

    public function aboutUs()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                return view('about', [
                    'cart' => Auth::user()->cart,
                ]);
            } else
                return view('about');
        }
        return view('about');
    }

    public function contactUs()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                return view('contact', [
                    'cart' => Auth::user()->cart,
                ]);
            } else
                return view('contact');
        }
        return view('contact');
    }

    public function getNewsDetails($id)
    {
        $news = $news = DB::table('notifications')
            ->where('type', 'news')
            ->orderBy('updated_at')
            ->paginate(5);
        $single = Notification::find($id);

        if (Auth::check()) {
            if (Auth::user()->role == 'customer' || Auth::user()->role == 'consultant') {
                return view('news_details', [
                    'news' => $news,
                    'single' => $single,
                    'cart' => Auth::user()->cart,
                ]);
            } else
                return view('news_details', [
                    'news' => $news,
                    'single' => $single,
                ]);
        }
        return view('news_details', [
            'news' => $news,
            'single' => $single,
        ]);
    }


}