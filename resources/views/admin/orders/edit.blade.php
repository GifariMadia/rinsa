@extends('layouts.app')
@section('title', 'Edit Order')

@section('content')
    @livewire('order-form', ['orderId' => $order->id])
@endsection
