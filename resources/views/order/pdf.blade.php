<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Invoice</title>
  <link href="{{ base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'css/pdf.css' }}" rel="stylesheet" media="all">
</head>
<body>
  <div class="modal fade show d-block" id="invoiceModal" tabindex="1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="invoiceModalLabel">Invoice #{{$data['invoice_id']}}</h5>
        </div>
        <div class="modal-body">
            <div class="mb-3 text-center">
                <img src="{{ base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images/logo.png' }}" alt="">
            </div>
            <div class="client-info mb-2">
            <p class="info-label mb-1"><span class="mr-3">Client name:</span> {{$data['client_name'] }}</p>
                <p class="info-label mb-1"><span class="mr-3">Phone number:</span> {{$data['client_phone'] }} </p>
            </div>
            <table class="invoice-table">
              <tr>
                  <th>Item Code</th>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Price</th>
              </tr>
              @foreach($data['items'] as $item)
              <tr>
                <td>{{$item->getItemID()}}</td>
                <td>{{ $item->item_name }}</td>
                <td>{{ $item->order_details->quantity }}</td>
                <td>${{ $item->price }}</td>
              </tr>
              @endforeach
              <tr>
                  <td class="border-0"></td>
                  <td class="border-0"></td>
                  <td class="text-right">Total</td>
                  <td class="">${{$data['total']}}</td>
              </tr>
            </table>
          <table class="invoice-table mb-2">
            <tr>
                <td>Service</td>
                @foreach($data['services'] as $service)
                <td>{{ $service->service_name }}</td>
                @endforeach
            </tr>
          </table>
        <p class="text-right small font-italic">Date: {{date('Y-m-d')}}</p>
        </div>
        
      </div>
    </div>
  </div>
</body>
</html>