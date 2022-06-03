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
                        <a href="#" target="_blank"><img alt="banner" src="{{asset('front-assets/images/logo.png')}}"></a>
                    </td>
                </tr>
                <!-- end table row   -->
                <tr>
                    <td>
                        <table style="border-collapse: collapse; margin: 0 auto;">
                            <tbody>
                                <tr>
                                    <td style=" padding: 15px 15px 0 15px;">
                                        Hello there,
                                    </td>
                                </tr>
                                <tr>
                                    <td style=" padding: 15px;">
                                        A new query has been recieved from 
                                        {{ $contact_data['customer_name'] ?? $contact_data['customer_name'] ?? '' }}. Please contact customer if required as soon as possible.
                                        The customer query details shown in the table below.
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
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ $contact_data['customer_name'] ?? '' }} </td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Email
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ $contact_data['customer_email'] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Phone
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">
                                    {{ $contact_data['customer_phone'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Subject
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ $contact_data['subject'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">Message
                                </td>
                                <td style="width: 50%; text-align: left; padding: 10px; border: 1px solid #eee;">{{ $contact_data['message'] ?? '' }}</td>
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