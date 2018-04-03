<html>
<head>
    <title>Print ticket</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        *{
            margin:0;
            padding:0;
        }
        body{
            padding:30px;
        }
        .main-pdf{
            padding:0;
            margin:0;
        }
        p{
            line-height:1.5;
            padding:0;
            margin:0;
        }
        .pdf-hd{
            text-align:center;
        }
        .pdf-hd p{
            font-size:9px;
            text-align:center;
        }
        .pdf-hd h2{
            text-align:center;
            padding:0;
            margin:0;
            font-size:10px;
        }
        .date-both{
            clear:both;
            float:left;
            width:100%;
            padding-top:15px;
        }
        .date-both span.eng-date{
            float:left;
        }
        .date-both span.npl-date{
            float: right;
            font-size:10px;
        }
        .date-both span{
            font-size:10px;
        }
        .ticket-info{
            clear:both;
            display:inline-block;
            width:100%;
            padding-top:10px;
        }
        .ticket-info p.ticket-top{
            float:left;
            width:100%;
            clear:both;
        }
        .invoice-detail{
            float:left;
            width:100%;
            clear:both;
            padding:15px 0;
        }
        .invoice-detail .invoice_num{
            margin-bottom:10px;
            float:left;
            width:100%;
        }
        .invoice-detail .invoice_num span{
            font-size:10px;
            line-height:1.5;
            margin-bottom:0;
        }
        .invoice-detail .invoice_num,
        .invoice-detail .invoice_date{
            width:100%;
            clear:both;
            display: block;
        }
        .invoice-detail .invoice_date span, .customer span, .customer-pan span,
        .invoice-footer .invoice-ft-btm span{
            font-size:8px;
            line-height:1.5;
        }
        .invoice-footer .invoice-ft-btm{
            margin-top:8px;
        }

        .ticket-info p.ticket-top span:first-child, .invoice-detail .invoice_date span:first-child,
        .invoice-detail .invoice_num span:first-child, .invoice-footer .invoice-ft-btm span:first-child{
            float:left;
        }
        .ticket-info p.ticket-top span:last-child, .invoice-detail .invoice_date span:last-child,
        .invoice-detail .invoice_num span:last-child, .invoice-footer .invoice-ft-btm span:last-child{
            float:right;
        }
        .customer, .customer-pan{
            width:100%;
            margin-bottom:5px;
            clear:both;
        }
        .customer span,
        .customer-pan span{
            display: block;
            float:none
        }
        .ticket-info p{
            margin-bottom:0;
            font-size:12px;
            line-height:1.5;
            clear:both;
            width:100%;
        }
        .qr-code{
            padding:15px 0;
            width:100%;
            display:inline-block;
            clear:both;
        }
        .qr-code .qr-content{
            float:left;
            width:70%;
        }
        .qrcode-thumb{
            float:right;
            text-align:center;
            width:30%;
        }
        .qrcode-thumb span{
            font-size:10px;
        }

        .qrcode-thumb .qr-img{
            width:30px;
            height:30px;
            margin:0 auto;
            margin-bottom:10px;

        }
        .qrcode-thumb img{
            max-width: 100%;
        }
        .qr-content p{
            font-size:10px;
            margin-bottom:0;
        }
        .tkt-footer{
            padding:15px 0;
            width:100%;
            clear:both;
        }
        .tkt-footer p, .invoice-footer p, .invoice-footer .invoice-ft-btm span{
            font-size:10px;
        }
        .tkt-footer span{
            text-transform:uppercase;
            font-size:10px;
        }
        .tktft-bottom{
            text-align:center;
            font-size:10px;
        }
        .invoice-info table{
            max-width:100%;
            width:100%;
            clear:both;
            border:1px solid #ccc;
            float:left;
            margin-top:10px;
            text-align:center;
        }
        .invoice-info table tr{
            border-bottom:1px solid #CCCCCC;
        }
        .invoice-info table td{
            padding:5px;
            font-size:10px;
        }

        .invoice-info table th{
            font-size:8px;
        }
        .invoice-info table td.gross-total{
            text-align:right;
            font-weight:bold;
        }

    </style>
</head>

<body>