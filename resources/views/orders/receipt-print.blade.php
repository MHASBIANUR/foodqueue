<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Receipt {{ $order->queue_number }}</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{
font-family:"Segoe UI",Tahoma,Verdana,sans-serif;
background:#f5f5f5;
display:flex;
justify-content:center;
padding:24px;
color:#111827;
}
.receipt{
width:320px;
background:#fff;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,.12);
overflow:hidden;
}
.header{
padding:24px;
text-align:center;
border-bottom:1px dashed #d1d5db;
}
.header h1{
font-size:34px;
font-weight:800;
letter-spacing:6px;
margin-bottom:6px;
}
.header p{
font-size:12px;
color:#6b7280;
}
.section{
padding:18px 22px;
border-bottom:1px dashed #d1d5db;
}
.info{width:100%;border-collapse:collapse;font-size:13px}
.info td{padding:4px 0}
.label{color:#6b7280}
.value{text-align:right;font-weight:600}
.date{
margin-top:12px;
text-align:center;
font-size:12px;
color:#6b7280;
}
.items-title{
font-size:11px;
letter-spacing:1px;
text-transform:uppercase;
color:#6b7280;
margin-bottom:10px;
}
.item{
padding:10px 0;
border-bottom:1px dashed #ececec;
}
.item:last-child{border-bottom:none}
.item-name{
font-weight:600;
margin-bottom:6px;
}
.item-detail{
display:flex;
justify-content:space-between;
font-size:12px;
color:#6b7280;
}
.item-price{
font-weight:700;
color:#111827;
}
.total{
display:flex;
justify-content:space-between;
align-items:center;
padding:18px 22px;
border-top:2px solid #111827;
border-bottom:2px solid #111827;
}
.total-label{
font-size:15px;
font-weight:700;
letter-spacing:.5px;
}
.total-value{
font-size:22px;
font-weight:800;
}
.footer{
padding:22px;
text-align:center;
}
.footer h3{
margin-bottom:8px;
font-size:18px;
}
.footer p{
font-size:12px;
line-height:1.8;
color:#6b7280;
}
.printed{
margin-top:16px;
padding-top:16px;
border-top:1px dashed #d1d5db;
font-size:11px;
color:#9ca3af;
}
@media print{
body{background:#fff;padding:0}
.receipt{
width:80mm;
box-shadow:none;
border-radius:0;
}
@page{
size:80mm auto;
margin:5mm;
}
}
</style>
</head>
<body>

<div class="receipt">

<div class="header">
<h1>FOODQUEUE</h1>
<p>Restaurant Management System</p>
</div>

<div class="section">

<table class="info">

<tr>
<td class="label">Queue</td>
<td class="value">{{ $order->queue_number }}</td>
</tr>

<tr>
<td class="label">Customer</td>
<td class="value">{{ $order->customer_name }}</td>
</tr>

<tr>
<td class="label">Cashier</td>
<td class="value">{{ $order->creator->name }}</td>
</tr>

</table>

<div class="date">
{{ $order->created_at->format('d M Y') }} • {{ $order->created_at->format('H:i') }}
</div>

</div>

<div class="section">

<div class="items-title">
Order Items
</div>

@foreach($order->items as $item)

<div class="item">

<div class="item-name">
{{ $item->menu->name }}
</div>

<div class="item-detail">

<span>
{{ $item->qty }} × Rp {{ number_format($item->price,0,',','.') }}
</span>

<span class="item-price">
Rp {{ number_format($item->subtotal,0,',','.') }}
</span>

</div>

</div>

@endforeach

</div>

<div class="total">

<div class="total-label">
TOTAL PAYMENT
</div>

<div class="total-value">
Rp {{ number_format($order->total_price,0,',','.') }}
</div>

</div>

<div class="footer">

<h3>Thank You!</h3>

<p>Please Come Again</p>

<div class="printed">

Receipt No.<br>
<strong>{{ $order->queue_number }}</strong>

<br><br>

Printed<br>

{{ now()->format('d M Y H:i') }}

</div>

</div>

</div>

<script>
window.onload=function(){
setTimeout(function(){
window.print();
},300);
};
window.onafterprint=function(){
window.close();
};
</script>

</body>
</html>