@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">


        <div class="row">
           

                <div class="card">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title d-sm-flex align-items-center justify-content-between">
                            <h2 class="fw-bolder">{{ $group->name }} Transactions
                            </h2>
                            <a class='btn btn-secondary' href='/airtime_group'>←Back</a>
                        </div>
        
                    </div>
                    <div class="card-body">
                        <div style='overflow-x:auto;max-width: 100%'>
                            <table style='width:100%' class="datatable table table-responsive mb-0 fixed-solution">
                                <thead>
                                    <tr>

                                        <th scope="col">Title </th>
                                        <th scope="col">Amount </th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Before/After</th>
                                        <th scope="col">Status</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>

                                @foreach($transactions as $key => $tranx)
                                @if($tranx->status == 2)
                                <tr class='alert alert-warning'>

                                    <td>{{ $tranx->title }} <br>
                                        @if($tranx->title == "Data Purchase" && $tranx->status == 1 && $tranx->redo == 1
                                        || $tranx->title ==
                                        "Airtime Purchase" && $tranx->status == 1 && $tranx->redo == 1 || $tranx->title
                                        == "Electricity
                                        Payment" && $tranx->status == 1 && $tranx->redo == 1 )
                                        {{-- @if($tranx->title == "Data Purchase" && $tranx->status == 1 ||
                                        $tranx->title == "Airtime
                                        Purchase" && $tranx->status == 1 || $tranx->title =='Electricity Payment' &&
                                        $tranx->status == 1 ||
                                        $tranx->title == 'Cable Subscription' && $tranx->status == 1 ) --}}
                                        <a data-transaction_id="{{ $tranx->id }}" data-title="{{ $tranx->title }}"
                                            data-amount="{{ $tranx->amount }}"
                                            data-description='{{ $tranx->description }}' data-id='{{ $tranx->id }}'
                                            class='redo btn btn-secondary btn-sm'>Redo</a>
                                        @endif
                                    </td>
                                    <td>₦{{ number_format($tranx->amount) }}</td>

                                    <td>{{ $tranx->description }}</td>
                                    <td>Pending Schedule Purchase</td>
                                    <td><a class='btn btn-warning btn-sm'>Pending</a></td>
                                    <td> <a class='btn btn-success'>Verify</a></td>

                                </tr>
                                @elseif($tranx->status == 0)

                                <tr class='alert alert-danger'>
                                    <td>{{ $tranx->user->name }}<br>
                                        <a href='https://wa.me/234{{ substr($tranx->user->phone,1) }}'>{{
                                            $tranx->user->phone }}</a>
                                    </td>
                                    <td>{{ $tranx->title }}</td>
                                    <td>₦{{ number_format($tranx->amount,2) }}</td>
                                    <td>{{ $tranx->description }}</td>
                                    <td>₦{{ number_format($tranx->admin_before) }} / ₦{{
                                        number_format($tranx->admin_after) }}</td>
                                    <td>
                                        @if($tranx->status == 1)
                                        <span class='btn-sm btn btn-success'>Success</span>
                                        @else
                                        <span class='btn-sm btn btn-danger'>Failed</span>
                                        @endif
                                    </td>
                                    <td><a class='btn btn-success'>Verify</td>
                                </tr>



                                @else
                                <tr class='alert alert-success'>
                                    <td>{{ $tranx->user->name }}<br>
                                        <a href='https://wa.me/234{{ substr($tranx->user->phone,1) }}'>{{
                                            $tranx->user->phone }}</a>
                                    </td>
                                    <td>{{ $tranx->title }}</td>
                                    <td>₦{{ number_format($tranx->amount,2) }}</td>
                                    <td>{{ $tranx->description }}</td>
                                    <td>₦{{ number_format($tranx->admin_before) }} / ₦{{
                                        number_format($tranx->admin_after) }}</td>
                                    <td>
                                        @if($tranx->status == 1)
                                        <span class='btn-sm btn btn-success'>Success</span>
                                        @else
                                        <span class='btn-sm btn btn-danger'>Failed</span>
                                        @endif
                                    </td>
                                    <td><a class='btn btn-success'>Verify</td>
                                </tr>
                                @endif


                                @endforeach



                            </table>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
          

        </div>
        <!-- end row -->


    
</div>
@section('script')

@endsection

@endsection