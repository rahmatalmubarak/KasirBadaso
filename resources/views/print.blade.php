<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Invoice Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div class="container-fluid col-6">
    <!-- Main content -->
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-globe"></i> KasirKU
                    <small class="float-right">Date: {{date('Y-m-d')}}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>


        <!-- Table row -->
        <div class="row my-3">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    @php
                    $jum = 0;
                    @endphp
                    @foreach ($modal as $modals => $item)
                    <tbody>
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->sell_price}}</td>
                            <td>{{$item->total}}</td>
                            <td>{{$item->total_price}}</td>
                        </tr>
                        @php
                        $jum += $item->total_price;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Senang bisa melayani anda dengan baik!!
                </p>
            </div>
            <!-- /.col -->
            <div class="col-6">
                <p class="lead">Detail Belanja</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Total:</th>
                                <td>@php
                                    echo "Rp. ". number_format($jum) . "-";
                                    @endphp</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

       
    </div>
    <!-- /.invoice -->
</div>
</body>
</html>