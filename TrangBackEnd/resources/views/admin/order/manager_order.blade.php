@extends('layouts.admin')

@section('title')
    <title>Trang chủ </title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' =>'Order','key'=> 'List'])


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Mã khách hàng</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Hiển thị</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order as $order_item)

                                <tr>
                                    <th scope="row">{{$order_item->id}}</th>
                                    <td>{{($order_item->customer)->name}}</td>
                                    <td>SP00{{$order_item->order_total }}</td>
                                    <td>{{$order_item->order_status}}</td>
                                    <td>

                                            <a href="{{route('view.order',['id'=> $order_item->id ])}}"
                                               class="btn btn-default">Chi tiết đơn</a>


                                            <a onclick="return confirm('Bạn có muốn xoá danh mục này không ?')" href="{{route('delete.order',['id'=> $order_item->id ])}}"
                                               class="btn btn-danger">Xoá</a>

                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                <!-- -->
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" accept=".xlsx"><br>
                            <input type="submit" value="Import CSV" name="import_csv" class="btn btn-warning">
                        </form>

                        <form action="" method="post">
                            @csrf
                            <input type="submit" value="Export CSV" name="export_csv" class="btn btn-success">
                        </form>
                    </div>
                    <div class="col-md-12">
                        {{$order->links()}}
                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection


