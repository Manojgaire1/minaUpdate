<html>
<head>
</head>
<style>
    td {
        vertical-align: top;
        font-size: 14px;
    }
    @media (max-width: 767px) {
        table,center {
            width: 100% !important;
        }
    }
</style>

<body style="margin: 0px; font-family: Arial, sans-serif; font-size: 14px; background-color: rgba(0, 0, 0, 0); ">
    <center style="width: 650px;margin: 0 auto;">
        <table style="border-collapse: collapse; width: 650px;margin: 0 auto;">
            <tbody>
                <tr>
                    <td style="padding: 15px; text-align: center;">
                        <a href="#" target="_blank"><img alt="banner" src="{{asset('front-assets/images/logo.png')}}" height="65px" width="135px"></a>
                    </td>
                </tr>
                <!-- end table row   -->
                <tr>
                    <td>
                        <table style="border-collapse: collapse; margin: 0 auto;">
                            <tbody>
                                <tr>
                                    <td style=" padding: 15px 15px 0 15px;">
                                        Hello {{ $data['branch_name'] ?? $data['branch_name'] ?? '' }},
                                    </td>
                                </tr>
                                <tr>
                                    <td style=" padding: 15px;">
                                        A new registeration for {{$data['peoples'] ?? $data['peoples'] ?? '' }} peoples on {{ isset($data['reservation_date']) ? \Carbon\Carbon::parse($data['reservation_date'])->format('Y-m-d') : ''}}, {{ isset($data['reservation_date']) ? \Carbon\Carbon::parse($data['reservation_date'])->format('h:i A') : '' }} has been received
                                        from {{ $data['customer_name'] ?? $data['customer_name'] ?? '' }}. Please call the customer to confirm the reservation.
                                        The reservation details is shown in the table below.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <!-- end table row -->

                <tr>
                    <td>
                        <table style="border-collapse: collapse; margin: 0 auto; border: 1px solid #eee;">
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">
                                    Customer Name</td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ $data['customer_name'] ?? '' }} </td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Email
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ $data['customer_email'] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Phone
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">
                                    {{ $data['customer_phone'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Branch
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ $data['branch_name'] ?? '' }}</td>
                            </tr>

                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Date
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">
                                    {{ isset($data['reservation_date']) ? Carbon\Carbon::parse($data['reservation_date'])->format('Y-m-d') : '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Time
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ isset($data['reservation_date']) ? Carbon\Carbon::parse($data['reservation_date'])->format('h:i A') : '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Peoples
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ $data['peoples'] ?? '' }}
                                    Persons</td>
                            </tr>

                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Message
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ $data['message'] ?? '' }}</td>
                            </tr>
                        </table>

                    </td>
                </tr>
                <!-- end table row   -->

            </tbody>
        </table>
    </center>
</body>

</html>