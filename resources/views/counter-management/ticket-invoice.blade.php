<div class="main-pdf">

    <div class="pdf-hd">
        <h2>Abbreviated Tax Invoice</h2>


        <p>{{$dataToInvoice['company_name']}}</p>


        <p>{{$dataToInvoice['company_address']}}</p>
        <p>PAN: {{$dataToInvoice['pan_number']}}</p>
        <p style="font-size: 8px !important;">Copy of Original</p>
    </div>

    <div class="invoice-detail">
        <div class="invoice_num">
            <span >
                Invoice No: {{$dataToInvoice['invoice_number']}}
            </span>
            <span class="payment-mode">
                Payment Mode: {{$dataToInvoice['payment_method']}}
            </span>
        </div>
        <div class="invoice_date">
            <span>
                Invoice Date: {{$dataToInvoice['invoice_date']}}
            </span>
            <span class="invoice-miti">
                Invoice Miti: {{$dataToInvoice['invoice_miti']}}
            </span>

        </div>

    </div>
    <div class="customer">
            <span class="customer_name">
                Customer Name: {{$dataToInvoice['customer_name']}}
            </span>
    </div>
    <div class="customer-pan">
            <span class="customer_pan_num">
                Customer PAN No: {{$dataToInvoice['customer_pan_num']}}
            </span>
    </div>
    <div class="invoice-info">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
            </thead>


            <tbody>
            @php $tableLoop = array_count_values($dataToInvoice['seat_prices']); @endphp
            @foreach($tableLoop as $key=>$value)
                <tr>
                    <td>{{$dataToInvoice['movie_name']}}</td>
                    <td>{{$value}}</td>
                    <td>{{$key}}</td>
                    <td>{{$value*$key}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="gross-total">Gross Total: {{$dataToInvoice['gross_total']}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="invoice-footer">
        <p>(Sales amount is inclusive of 13% VAT and 15% FDT on foreign movies)</p>
        <div class="invoice-ft-btm">
            <span>Sales Point: {{$dataToInvoice['sales_point']}}</span>
            <span>Sales Person: {{$dataToInvoice['sales-person']}}</span>
        </div>
    </div>
</div>