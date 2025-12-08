<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body {
        font-family: sans-serif;
    }

    .gpb_title {
        margin-bottom: 40px;
    }

    .gpb_title h2 {
        margin: 0;
        padding-right: 3px;
        color: red;
    }

    .gpb_title p {
        margin: 0;
        text-align: start;
        padding-left: 3px;
        color: red;
    }
</style>
@php
    $grandTotal = $checkoutCartItems->sum('total_costs');
@endphp

<body>
    {{-- prms details --}}
    <section>
        <div class="gpb_title">
            <table>
                <tr>
                    <th style=" border-right: 5px solid red;">
                        <h2>PRMS</h2>
                    </th>
                    <th>
                        <p>Procurement and Receiving <br> Management System</p>
                    </th>
                </tr>
            </table>
        </div>

        <table style="width:100%; border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td style="vertical-align: top; padding: 10px;">
                    <h5 style="margin:0; font-size: 16px;">Created By: </h5>
                    <p style="margin:0; font-size: 15px;">{{ $PurchaseRequestCheckout->user->name }}</p>
                </td>
                <td style="vertical-align: top; padding: 10px;">
                    <h5 style="margin:0; font-size: 16px;">Organization:</h5>
                    <p style="margin:0; font-size: 15px;">
                        {{ $PurchaseRequestCheckout->user->organization->organization_name }}</p>
                </td>
                <td style="vertical-align: top; padding: 10px;">
                    <h5 style="margin:0; font-size: 16px;">Purchase Request No:</h5>
                    <p style="margin:0; font-size: 15px;">{{ $PurchaseRequestCheckout->pr_no }}</p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding: 10px;" colspan="2">
                    <h5 style="margin:0; font-size: 16px;">Purpose:</h5>
                    <p style="margin:0; font-size: 15px;">{{ $PurchaseRequestCheckout->purpose }}</p>
                </td>
                <td style="vertical-align: top; padding: 10px;">
                    <h5 style="margin:0; font-size: 16px;">Total Items:</h5>
                    <p style="margin:0; font-size: 15px;">{{ $totalcheckoutItems }}</p>
                </td>
            </tr>
        </table>

    </section>

    <section style="border-top: 2px solid black">
        <table
            style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 15px; margin: 20px 0;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">No</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: left;">Item Name</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">OUM</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: right;">Price</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Qty</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: right;">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($checkoutCartItems as $checkoutCartItem)
                    <tr>
                        <td style="border: 1px solid #000; padding: 8px; text-align: center;">{{ $checkoutCartItem->id }}</td>
                        <td style="border: 1px solid #000; padding: 8px;">{{ $checkoutCartItem->item->item_name }}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: center;">{{ $checkoutCartItem->item->item_uom }}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: right;">₱ {{ $checkoutCartItem->item->price }}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: center;">{{ $checkoutCartItem->cart_requested_qty }}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: right;">₱ {{ number_format($checkoutCartItem->total_costs, 2) }}</td>
                    </tr>
                @empty

                @endforelse
                <tr>
                    <th colspan="5" style="border: 1px solid #000; padding: 8px; text-align: start;"><span>Total Cost : </span></th>
                    <td colspan="5" style="border: 1px solid #000; padding: 8px; text-align: right;"><span>₱ {{ number_format( $grandTotal, 2) }} </span></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </section>

    {{-- gpb signatory --}}
    <section style="border-top: 2px solid black">
        <table
            style="width: 100%; border-collapse: collapse; margin: 20px 0; font-family: Arial, sans-serif; font-size: 17px;">
            <tr>
                <td style="width: 33%; vertical-align: top; padding: 10px;">
                    <p style="font-weight: 600; color: black; margin-bottom: 5px;">Prepared By:</p>
                    <p style="color: black; font-weight: 500; margin: 0;">Bienes, Richard</p>
                    <p style="color: black; font-size: 13px; margin: 0;">Information System Analyst I</p>
                </td>

                <td style="width: 33%; vertical-align: top; padding: 10px;">
                    <p style="font-weight: 600; color: black; margin-bottom: 5px;">Approved By:</p>
                    <p style="color: black; font-weight: 500; margin: 0;">Ibana, Chano</p>
                    <p style="color: black; font-size: 13px; margin: 0;">Computer Programmer III</p>
                </td>

                <td style="width: 33%; vertical-align: top; padding: 10px;">
                    <p style="font-weight: 600; color: black; margin-bottom: 5px;">Date:</p>
                    <p style="color: black; font-weight: 500; margin: 0;">{{ $checkoutCartItem->created_at->format('M d, Y') }}</p>
                </td>
            </tr>
        </table>

    </section>
</body>

</html>
