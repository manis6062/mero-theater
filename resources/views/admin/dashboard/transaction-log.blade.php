@if(isset($transactionData) && $transactionData->count() > 0)
    @foreach($transactionData as $transactionDatum)
        <tr>
            <td>{{\App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->customer_name != null ? \App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->customer_name : 'N/A'}}</td>
            {{--<td>{{$transactionDatum->customer_pan_num != null ? $transactionDatum->customer_pan_num : 'N/A'}}</td>--}}
            <td>{{$transactionDatum->invoice_number}}</td>
            <td>{{\App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->payment_mode != null ? \App\BookingModel\CounterSellInvoice::where('invoice_number', $transactionDatum->invoice_number)->first()->payment_mode : 'N/A'}}</td>
            <td>{{\App\Screen\Screen::find($transactionDatum->screen_id)->name}}</td>
            <td>{{$transactionDatum->seat_category}}</td>
            <td>{{$transactionDatum->seat_name}}</td>
            <td>{{$transactionDatum->seat_price}}</td>
            <td>{{\App\MovieModel::find($transactionDatum->movie_id)->movie_title}}</td>
            <td>{{$transactionDatum->show_date}}</td>
            <td>{{$transactionDatum->show_time}}</td>
            <td>{{$transactionDatum->show_day}}</td>
            <td>{{date('d M, Y', strtotime($transactionDatum->created_at))}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="10">{{$transactionData->appends(\Illuminate\Support\Facades\Input::except('page'))}}</td>
    </tr>
@else
    <tr>
        <td colspan="10">No Reports Found !
        </td>
    </tr>
@endif