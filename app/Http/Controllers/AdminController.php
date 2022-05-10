<?php
/**
 * Created by PhpStorm.
 * User: Aniket
 * Date: 2/5/2016
 * Time: 11:58 AM
 */

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Consultant;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Package;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Base
{

    public function getAccount()
    {
        return view('pages.admin.account', ['user' => Auth::user()]);
    }

    public function getProfile($id)
    {
        $user = User::find($id);

        return view('');
    }


    /*
     * Notification Management tasks
     *
     */
    public function getNotificationsAdd()
    {
        return view('pages.admin.notifications.post');
    }

    public function getNotificationsList()
    {
        $notifications = DB::table('notifications')->paginate(20);
        return view('pages.admin.notifications.list', [
            'notifications' => $notifications,
        ]);
    }

    public function postNotificationsAdd(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'notification' => 'required',
        ]);

        Notification::create([
            'title' => $request->title,
            'type' => $request->type,
            'notification' => $request->notification,
        ]);

        return redirect()->route('admin.notifications.list')->with('info', 'Notification posted');

    }

    public function getNotificationEdit($id)
    {
        $notification = Notification::find($id);
        return view('pages.admin.notifications.edit', [
            'notification' => $notification,
        ]);
    }

    public function postNotificationEdit(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'notification' => 'required',
        ]);

        $notification = Notification::find($id);

        $notification->title = $request->input('title');
        $notification->type = $request->input('type');
        $notification->notification = $request->input('notification');

        $notification->save();

        return redirect()->route('admin.notifications.list')->with('info', 'Notification updated');
    }

    public function postNotificationDelete(Request $request, $id)
    {

        $notification = Notification::find($id);

        $notification->delete();

        return redirect()->route('admin.notifications.list')->with('info', 'Notification deleted');
    }


    /*
     * Order Management tasks
     *
     */

    public function getOrdersPage()
    {
        $orders = DB::table('order_items')
            ->where('status', 'active')
            ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->leftJoin('users', 'users.id', '=', 'orders.customer_id')
            ->orderBy('order_id', 'DES')
            ->select('order_id', 'uid', 'name', 'role', 'orders.created_at as order_date', 'mobile', 'taluka', 'district', 'product_name', 'status')
            ->paginate(20);

        return view('pages.admin.orders.orders', ['orders' => $orders]);
    }

    public function getOrdersIssuedPageSearch(Request $request)
    {
        $orders = DB::table('order_items')
            ->select('order_id', 'uid', 'name', 'role', 'orders.created_at as order_date', 'mobile', 'taluka', 'district', 'product_name', 'status')
            ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->leftJoin('users', 'users.id', '=', 'orders.customer_id')
            ->where('orders.status', 'issued')
            ->orderBy('order_id', 'DES');

        if ($request->input('name') != '') {
            $orders->where('users.name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->input('dateFrom') != '' && $request->input('dateTo') != '') {
            $orders->whereBetween('orders.created_at', [$request->input('dateFrom'), $request->input('dateTo')]);
        }
        if ($request->input('type') != 'any') {
            $orders->where('users.role', '=', $request->input('type'));
        }
        if ($request->input('taluka') != '') {
            $orders->where('orders.taluka', 'like', '%' . $request->input('taluka') . '%');
        }
        if ($request->input('district') != '') {
            $orders->where('orders.district', 'like', '%' . $request->input('district') . '%');
        }
        if ($request->input('mobile') != '') {
            $orders->where('users.mobile', '=', $request->input('mobile'));
        }
        if ($request->input('product_name') != '') {
            $orders->where('order_items.product_name', 'like', '%' . $request->input('product_name') . '%');
        }

        if ($request->input('action') == 'print') {
            DB::setFetchMode(\PDO::FETCH_ASSOC);
            $orders_get = $orders->get();


            Excel::create('Orders ' . date('d-m-Y'), function ($excel) use ($orders_get) {

                $excel->sheet('Sheetname', function ($sheet) use ($orders_get) {

                    $sheet->fromArray($orders_get);
                });
            })->export('xls');
        }

        $orders = $orders->paginate(20);

        Input::flash();

        return view('pages.admin.orders.orders_completed', ['orders' => $orders]);
    }

    public function getOrdersPageSearch(Request $request)
    {
        $orders = DB::table('order_items')
            ->select('order_id', 'uid', 'name', 'role', 'orders.created_at as order_date', 'mobile', 'taluka', 'district', 'product_name', 'status')
            ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->leftJoin('users', 'users.id', '=', 'orders.customer_id')
            ->where('orders.status', 'active')
            ->orderBy('order_id', 'DES');

        if ($request->input('name') != '') {
            $orders->where('users.name', 'like', '%' . $request->input('name') . '%');
        }


        if ($request->input('dateFrom') != '' && $request->input('dateTo') != '') {
            $orders->whereBetween('orders.created_at', [$request->input('dateFrom'), $request->input('dateTo')]);
        }


        if ($request->input('type') != 'any') {
            $orders->where('users.role', '=', $request->input('type'));
        }
        if ($request->input('taluka') != '') {
            $orders->where('orders.taluka', 'like', '%' . $request->input('taluka') . '%');
        }
        if ($request->input('district') != '') {
            $orders->where('orders.district', 'like', '%' . $request->input('district') . '%');
        }
        if ($request->input('mobile') != '') {
            $orders->where('users.mobile', '=', $request->input('mobile'));
        }
        if ($request->input('product_name') != '') {
            $orders->where('order_items.product_name', 'like', '%' . $request->input('product_name') . '%');
        }


        if ($request->input('action') == 'print') {
            DB::setFetchMode(\PDO::FETCH_ASSOC);
            $orders_get = $orders->get();


            Excel::create('Orders ' . date('d-m-Y'), function ($excel) use ($orders_get) {

                $excel->sheet('Sheetname', function ($sheet) use ($orders_get) {

                    $sheet->fromArray($orders_get);
                });
            })->export('xls');
        }

        $orders = $orders->paginate(20);

        Input::flash();

        return view('pages.admin.orders.orders', ['orders' => $orders]);
    }


    public function getOrdersIssuedPage()
    {
        $orders = DB::table('order_items')
            ->select('order_id', 'uid', 'name', 'role', 'orders.created_at as order_date', 'mobile', 'taluka', 'district', 'product_name', 'status')
            ->where('status', 'issued')
            ->leftJoin('orders', 'orders.id', '=', 'order_items.order_id')
            ->leftJoin('users', 'users.id', '=', 'orders.customer_id')
            ->orderBy('order_id', 'DES')
            ->paginate(20);

        return view('pages.admin.orders.orders_completed', ['orders' => $orders]);
    }

    public function postOrderIssue(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        $order->status = 'issued';
        $order->save();
        return redirect()->route('admin.orders')->with('info', 'Order with ID = ' . $order_id . ' issued.');
    }

    public function postOrderActivate(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        $order->status = 'active';
        $order->save();
        return redirect()->route('admin.issued_orders')->with('info', 'Order with ID = ' . $order_id . ' activated.');
    }

    /*
     * Employee Management tasks
     *
     */
    public function getEmployeePage()
    {

        $emp_req = Employee::where('status', '0')->lists('employee_id')->toArray();

        $emp = Employee::where('status', '1')->lists('employee_id')->toArray();

        $employees = User::whereIn('id', $emp)->get();

        $employee_requests = User::whereIn('id', $emp_req)->get();

        return view('pages.admin.employee.employees', [
            'employees' => $employees,
            'employee_requests' => $employee_requests,
        ]);
    }

    public function getEmployeeProfile($id)
    {

        $user = User::find($id);
        $employee = Employee::find($id);

        return view('pages.admin.employee.view_profile', ['user' => $user, 'employee' => $employee]);

    }

    public function postEmployeeApprove($id)
    {

        $employee = Employee::find($id);
        $employee->status = 1;

        $employee->save();

        return redirect()->route('admin.employees')->with('info', 'Employee approved.');

    }

    public function postEmployeeDelete($id)
    {

        Employee::destroy($id);
        User::destroy($id);

        return redirect()->route('admin.employees')->with('info-warning', 'Employee deleted');

    }

    public function postEmployeeDisable($id)
    {

        $employee = Employee::find($id);

        $employee->status = 0;

        $employee->save();

        return redirect()->route('admin.employees')->with('info-warning', 'Employee disabled');

    }


    /*
     * Customer Management tasks
     *
     */
    public function getCustomerPage()
    {
        $customers = DB::table('customers')
            ->leftJoin('users', 'id', '=', 'customers.customer_id')
            ->paginate(20);
        return view('pages.admin.customer.customers', ['customers' => $customers]);
    }

    public function getCustomerSearchPage(Request $request)
    {
        $customers = DB::table('customers')
            ->leftJoin('users', 'id', '=', 'customers.customer_id');

        if ($request->input('name') != '') {
            $customers->where('users.name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->input('uid') != '') {
            $customers->where('users.uid', '=', $request->input('uid'));
        }
        if ($request->input('taluka') != '') {
            $customers->where('customers.taluka', 'like', '%' . $request->input('taluka') . '%');
        }
        if ($request->input('district') != '') {
            $customers->where('customers.district', 'like', '%' . $request->input('district') . '%');
        }
        if ($request->input('mobile') != '') {
            $customers->where('users.mobile', '=', $request->input('mobile'));
        }

        $customers = $customers->paginate(20);
        return view('pages.admin.customer.customers', ['customers' => $customers]);
    }

    public function getCustomerProfile($id)
    {

        $user = User::find($id);
        $customer = Customer::find($id);
        $crops = $customer->crops;

        return view('pages.admin.employee.view_profile', ['user' => $user, 'customer' => $customer, 'crops' => $crops]);

    }


    /*
     * Consultant Management tasks
     *
     */
    public function getConsultantPage()
    {
        $customers = DB::table('consultants')
            ->leftJoin('users', 'id', '=', 'consultants.consultant_id')
            ->paginate(20);
        return view('pages.admin.consultant.consultants', ['customers' => $customers]);
    }

    public function getConsultantProfile($id)
    {

        $user = User::find($id);
        $consultant = Consultant::find($id);

        return view('pages.admin.employee.view_profile', ['user' => $user, 'consultant' => $consultant]);

    }

    public function getConsultantSearchPage(Request $request)
    {
        $customers = DB::table('consultants')
            ->leftJoin('users', 'id', '=', 'consultants.consultant_id');

        if ($request->input('name') != '') {
            $customers->where('users.name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->input('uid') != '') {
            $customers->where('users.uid', '=', $request->input('uid'));
        }
        if ($request->input('taluka') != '') {
            $customers->where('consultants.taluka', 'like', '%' . $request->input('taluka') . '%');
        }
        if ($request->input('district') != '') {
            $customers->where('consultants.district', 'like', '%' . $request->input('district') . '%');
        }
        if ($request->input('mobile') != '') {
            $customers->where('users.mobile', '=', $request->input('mobile'));
        }

        $customers = $customers->paginate(20);
        return view('pages.admin.consultant.consultants', ['customers' => $customers]);
    }

    /*
     * Product Management tasks
     *
     */
    public function getAddProduct($type)
    {
        $categories = Category::where('available', 1)->get();
        if ($type == 'Raw')
            return view('pages.admin.product.addRaw', ['categories' => $categories]);
        else if ($type == 'Crop')
            return view('pages.admin.product.addCrop', ['categories' => $categories]);
        else if ($type == 'Product')
            return view('pages.admin.product.addProduct', ['categories' => $categories]);
    }

    public function postAddProduct(Request $request, $type)
    {
        if ($type == 'Crop') {
            $this->validate($request, [
                'name' => 'required',
                'category' => 'required',
                'img' => 'required|mimes:jpg,jpeg,bmp,png',
                'description' => 'required',
                'available' => 'required',
            ]);

            $img = Input::file('img');

            $img->move('images/products', $img->getClientOriginalName());

            $category = Category::find($request->input('category'));

            Product::create([
                'name' => $request->input('name'),
                'img' => $img->getClientOriginalName(),
                'category_id' => $request->input('category'),
                'category' => $category->name,
                'description' => $request->input('description'),
                'type' => $type,
                'available' => $request->input('available'),
            ]);

            return redirect()->route(
                'admin.account'
            )->with('info', 'Crop added.');


        } else {
            $this->validate($request, [
                'name' => 'required',
                'contents' => 'required',
                'category' => 'required',
                'img' => 'required|mimes:jpg,jpeg,bmp,png',
                'usage' => 'required',
                'description' => 'required',
                'available' => 'required',
            ]);

            $img = Input::file('img');

            $img->move('images/products', $img->getClientOriginalName());

            $category = Category::find($request->input('category'));

            $id = Product::create([
                'name' => $request->input('name'),
                'contents' => $request->input('contents'),
                'img' => $img->getClientOriginalName(),
                'category_id' => $request->input('category'),
                'category' => $category->name,
                'description' => $request->input('description'),
                'usage' => $request->input('usage'),
                'type' => $type,
                'available' => $request->input('available'),
            ])->id;

            $product = Product::find($id);
            $packages = $product->packages;

            return redirect()->route(
                'admin.product.packages',
                ['product' => $product, 'packages' => $packages]
            )->with('info', $type . ' added now add packages.');
        }


    }

    public function getEditProduct()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('pages.admin.product.editProduct', [
            'products' => $products,
            'categories' => $categories,
        ]);

    }

    public function getEditProductSingle($id)
    {

        $product = Product::find($id);

        if ($product->type == 'Crop') {
            return view('pages.admin.product.editCropSingle', [
                'product' => $product,
                'categories' => Category::all(),
            ]);
        } else {
            return view('pages.admin.product.editProductSingle', [
                'product' => $product,
                'categories' => Category::all(),
            ]);
        }

    }

    public function postEditProductSingle(Request $request, $id)
    {
        if ($request->input('action') == 'save' && $request->input('type') == 'Crop') {

            $this->validate($request, [
                'name' => 'required',
                'category' => 'required',
                'description' => 'required',
                'available' => 'required',
            ]);

            $cat = Category::find($request->input('category'));
            $product = Product::find($id);
            $product->name = $request->input('name');
            $product->category_id = $request->input('category');
            $product->category = $cat->name;
            $product->description = $request->input('description');
            $product->available = $request->input('available');

            if (Input::hasFile('img')) {

                $this->validate($request, [
                    'img' => 'required|mimes:jpg,jpeg,bmp,png',
                ]);

                $img = Input::file('img');
                $img->move('images/products', $img->getClientOriginalName());

                File::delete('images/products/' . $product->img);

                $product->img = $img->getClientOriginalName();
            }

            $product->save();

            return redirect()->route('admin.product.edit')->with('info', 'Successfully updated');

        } elseif ($request->input('action') == 'save' && $request->input('type') != 'Crop') {

            $this->validate($request, [
                'name' => 'required',
                'contents' => 'required',
                'category' => 'required',
                'usage' => 'required',
                'description' => 'required',
                'available' => 'required',
            ]);

            $product = Product::find($id);
            $cat = Category::find($request->input('category'));

            $product->name = $request->input('name');
            $product->contents = $request->input('contents');
            $product->category_id = $request->input('category');
            $product->category = $cat->name;
            $product->description = $request->input('description');
            $product->usage = $request->input('usage');
            $product->available = $request->input('available');

            if (Input::hasFile('img')) {

                $this->validate($request, [
                    'img' => 'required|mimes:jpg,jpeg,bmp,png',
                ]);

                $img = Input::file('img');
                $img->move('images/products', $img->getClientOriginalName());

                File::delete('images/products/' . $product->img);

                $product->img = $img->getClientOriginalName();
            }

            $product->save();

            return redirect()->route('admin.product.edit')->with('info', 'Successfully updated');
        } elseif ($request->input('action') == 'cancel') {
            return redirect()->route('admin.product.edit');
        } elseif ($request->input('action') == 'delete') {

            $product = Product::find($id);
            File::delete('images/products/' . $product->img);
            $product->delete();
            return redirect()->route('admin.product.edit')->with('info', 'Successfully deleted.');
        } else
            return redirect()->back()->with('info', 'Invalid action.');

    }

    public function postProductStatusToggle($id)
    {

        $product = Product::find($id);

        if ($product->available == 1) {
            $product->available = 0;
            $actionName = 'disabled';
        } else {
            $product->available = 1;
            $actionName = 'enabled';
        }

        $product->save();

        return redirect()->back()->with('info', $product->name . ' status ' . $actionName);

    }

    public function getEditProductSearch(Request $request)
    {

        if ($request->input('category') == 'any') {

            $products = Product::where('name', 'like', '%' . $request->input('name') . '%')->get();
            $categories = Category::all();

            return view('pages.admin.product.editProduct', [
                'products' => $products,
                'categories' => $categories,
            ]);
        } else {

            $products = Product::where('name', 'like', '%' . $request->input('name') . '%')
                ->where('category_id', $request->input('category'))->get();
            $categories = Category::all();

            return view('pages.admin.product.editProduct', [
                'products' => $products,
                'categories' => $categories,
            ]);
        }
    }


    /*
    * Category Management tasks
    *
    */

    public function getCategories()
    {
        $categories = Category::all();

        return view('pages.admin.product.categories', ['categories' => $categories]);
    }

    public function postCategoryAdd(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
        ]);

        Category::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'available' => 0,
        ]);

        return redirect()->back()->with('info', $request->input('name') . ' added successfully ');

    }

    public function postCategoryToggle($id)
    {

        $category = Category::find($id);

        if ($category->available == 1) {
            $category->available = 0;
            $actionName = 'disabled';
        } else {
            $category->available = 1;
            $actionName = 'enabled';
        }

        $category->save();

        return redirect()->back()->with('info', $category->name . ' status ' . $actionName);

    }

    public function postCategoryDelete($id)
    {

        $category = Category::find($id);

        $category->delete();

        return redirect()->back()->with('info', 'Category deleted');

    }


    /*
    * Package Management tasks
    *
    */
    public function getProductPackages($id)
    {
        $product = Product::find($id);
        $packages = $product->packages;

        return view('pages.admin.product.Packages', ['product' => $product, 'packages' => $packages]);
    }

    public function postProductPackagesToggle($id)
    {
        $package = Package::find($id);

        if ($package->available == 1) {
            $package->available = 0;
            $actionName = 'disabled';
        } else {
            $package->available = 1;
            $actionName = 'enabled';
        }

        $package->save();

        return redirect()->back()->with('info', $package->package . ' package ' . $actionName);
    }

    public function postProductPackagesDelete($id)
    {
        $package = Package::find($id);
        $package->delete();
        return redirect()->back()->with('info', 'Package deleted.');
    }

    public function postProductPackagesAdd(Request $request, $id)
    {

        $this->validate($request, [
            'package' => 'required',
            'price' => 'required|numeric',
        ]);

        Package::create([
            'package' => $request->input('package'),
            'price' => $request->input('price'),
            'product_id' => $id,
            'product_name' => Product::find($id)->name,
            'available' => 0,
        ]);

        $product = Product::find($id);
        $packages = $product->packages;

        return redirect()->route('admin.product.packages', ['product' => $product, 'packages' => $packages]);
    }


}