<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center;font-size: 26px;font-family: 'Raleway', sans-serif;">Profile
    </div>
    <div class="panel-body">


        <div class="table-responsive">
            <table class="table" style="border: hidden">
                <tbody>

                <tr>
                    <td width="40%" style="text-align: right; font-size: large; vertical-align: middle">User ID :</td>
                    <td width="60%" style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->uid }}</td>
                </tr>

                <tr>
                    <td width="40%" style="text-align: right; font-size: large; vertical-align: middle">Name :</td>
                    <td width="60%" style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->name }}</td>
                </tr>

                <tr>
                    <td style="text-align: right; font-size: large; vertical-align: middle">Email :</td>
                    <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->email }}</td>
                </tr>

                <tr>
                    <td style="text-align: right; font-size: large; vertical-align: middle">Role :</td>
                    <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->role }}</td>
                </tr>
                @if( $user->role == 'customer')
                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Address :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $customer->address }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Taluka :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $customer->taluka }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">District :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $customer->district }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Pin :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $customer->pin }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Mobile :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->mobile }}</td>
                    </tr>

                @elseif ( $user->role == 'consultant')
                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Address :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $consultant->address }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Taluka :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $consultant->taluka }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">District :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $consultant->district }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Pin :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $consultant->pin }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Mobile :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $user->mobile }}</td>
                    </tr>

                @elseif ( $user->role == 'employee')
                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Address :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $employee->address }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Taluka :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $employee->taluka }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">District :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $employee->district }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Pin :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $employee->pin }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; font-size: large; vertical-align: middle">Mobile :</td>
                        <td style="text-align: left; font-size: larger; vertical-align: middle">{{ $employee->mobile }}</td>
                    </tr>

                @endif

                <tr>
                    <td style="text-align: right; font-size: large; vertical-align: middle">
                        <a class="btn btn-default" href="{{ route('user.account.edit_profile') }}">Edit Profile</a>
                    </td>
                    <td style="text-align: left; font-size: large; vertical-align: middle">
                        <a class="btn btn-default" href="{{ route('user.account.edit_password') }}">Change Password</a>
                    </td>

                </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>