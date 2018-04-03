<div class="main-pdf">

    <div class="pdf-hd">
        <h2>Entrance Pass</h2>


        <p>{{$dataToTicket['company_display_name']}}</p>


        <p>{{$dataToTicket['company_address']}}</p>
        <p style="font-size: 8px !important;">Copy of Original</p>
    </div>


    <div class="date-both">

            <span class="eng-date">
                {{$dataToTicket['ad-date']}}
            </span>
        <span class="npl-date">
                {{$dataToTicket['bs-date']}}
            </span>
    </div>
    <div class="ticket-info">
        <p class="ticket-top">
            <span>{{$dataToTicket['screen_name']}} {{$dataToTicket['seat_category']}}</span>
            <span>Seat Info : {{$dataToTicket['seat_name']}}</span>
        </p>
        <p>{{$dataToTicket['movie_name']}}</p>
        <p>{{date('d M Y', strtotime($dataToTicket['show_date']))}} {{$dataToTicket['show_day']}} {{$dataToTicket['show_time']}}</p>

    </div>
    <div class="qr-code">
        <div class="qr-content">
            <p style="text-transform: uppercase">{{strtoupper($dataToTicket['ticket_id'])}}</p>
            <p>{{$dataToTicket['ad-date']}}</p>
            <p><span>Sales Person :</span>{{$dataToTicket['sales-person']}}</p>
        </div>
        <div class="qrcode-thumb">
            <div class="qr-img">
                <img src="data:image/png;base64,{{\Milon\Barcode\DNS2D::getBarcodePNG($dataToTicket['qr_code'], 'QRCODE')}}"
                     alt="qrcode"/>
            </div>
            <span>{{strtoupper($dataToTicket['qr_code'])}}</span>
        </div>
    </div>
    <div class="tkt-footer">
        @if($dataToTicket['movie-genre'] == '3D')
            <p>All glasses <span>have to be returned</span> after the show. Rs. 250 will be fined for
                <span>Damaged</span>
                or
                <span>lost </span> glasses. </p>
        @else
            <p>Keep the ticket until the end of the show! Please follow the internal rules of Theatre. Please check the Date and Time of the show.</p>
        @endif
    </div>
    <div class="tktft-bottom"> Enjoy your movie experience at {{$dataToTicket['company_display_name']}}</div>
</div>