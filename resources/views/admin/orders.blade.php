@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Products</th>
                <th>Order Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->products }}</td>
                <td>{{ $order->order_status }}</td>
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="order_status" class="form-control">
                            <option value="waiting" {{ $order->order_status == 'waiting' ? 'selected' : '' }}>Waiting</option>
                            <option value="accepted" {{ $order->order_status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ $order->order_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
