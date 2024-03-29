@extends('layouts.app', ['title' => 'HRI-HOTEL | Dashboard'])
@section('content')
    <div class="container-fluid">
        <div class="row second-chart-list third-news-update">
            <div class="col-xl-9 xl-100 chart_data_left box-col-12">
                <div class="card">
                    <div class="card-body p-0">
                        @role('customer')
                        <div class="row p-5">
                            <div class="col-md-12">
                                <h4>{{ $greeting }},</h4><span class="text-secondary">Hallo
                                    {{ Str::upper(auth()->user()->name) }} Have a nice day & choose the right room package
                                    and make you comfortable.</span>
                            </div>
                            <div class="col-md-12 mt-5">
                                <center>
                                    <h6><u>YOUR BOOKING HISTORY</u></h6>
                                </center>
                                @if ($booking_user)
                                    @if ($booking_user->status == 1)
                                        @php
                                            $check_in = date_create($booking_user['check_in']);
                                            $check_out = date_create($booking_user['check_out']);
                                            $calculate = date_diff($check_out, $check_in);
                                            $day = $calculate->format('%a');
                                            $price = $day * $booking_user->room->price;
                                        @endphp
                                        <center>
                                            <div class="mt-4 mb-1">
                                                <div class="mb-1">
                                                    <i class="fa fa-check-circle fa-3x"
                                                        style="color: rgb(30, 184, 38);"></i>
                                                </div>
                                                <h6 class="text-secondary">-- Booking Success --</h6>
                                            </div>
                                            <div>
                                                <small>Booking Code</small>
                                                <small>:</small>
                                                <small><strong>{{ $booking_user->booking_code }}</strong></small>
                                            </div>
                                            <div>
                                                <small>Room</small>
                                                <small>:</small>
                                                <small><strong>{{ $booking_user->room->name }}[ {{ $day }}
                                                    @if ($day == 1) Day @else Days
                                                        @endif]
                                                    </strong></small>
                                            </div>
                                            <div>
                                                <small>Total Payment</small>
                                                <small>:</small>
                                                <small><strong>{{ 'Rp. ' . number_format($price, 0, ',', '.') }}</strong></small>
                                            </div>
                                            <div>
                                                <small>Check In </small>
                                                <small>:</small>
                                                <small><strong>{{ $booking_user->check_in }}</strong></small>
                                            </div>
                                            <div>
                                                <small>Check Out</small>
                                                <small>:</small>
                                                <small><strong>{{ $booking_user->check_out }}</strong></small>
                                            </div>
                                        </center>
                                    @endif
                                @else
                                    <center>
                                        <img src="{{ asset('assets/images/notfound.svg') }}" alt="thumbnail" width="300"
                                            srcset="">
                                        <p class="text-danger">You haven't booked a room!</p>
                                    </center>
                                @endif
                            </div>
                        </div>
                        @endrole
                        @hasanyrole('admin|boss')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row p-3 pl-5 ml-5 mb-5">
                                            <div class="col-md-3 col-sm-12">
                                                <h5 class="mb-2"><u>{{ $customers }}</u></h5>
                                                <span>Customer </span>
                                                <h4 style="float: left; color: #31326f;" class="mr-2"><i
                                                        class="fa fa-user"></i></h4>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <h5 class="mb-2"><u>{{ $bookings }}</u></h5>
                                                <h4 style="float: left; color: #31326f;" class="mr-2"><i
                                                        class="fa fa-sign-in"></i></h4><span> Booking</span>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <h5 class="mb-2"><u>{{ $users }}</u></h5>
                                                <h4 style="float: left; color: #31326f;" class="mr-2"><i
                                                        class="fa fa-users"></i></h4><span> Account</span>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <h5 class="mb-2"><u>{{ $rooms }}</u></h5>
                                                <h4 style="float: left; color: #31326f;" class="mr-2"><i
                                                        class="fa fa-shopping-bag"></i></h4><span> Room</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-3">
                                                            <u>Room</u>
                                                        </h5>
                                                        <div>
                                                            <span class="badge badge-pill badge-success">&middot;</span>
                                                            <small class="text-secondary mr-2">Empty Room</small>
                                                            <span class="badge badge-pill badge-danger">&middot;</span>
                                                            <small class="text-secondary">Room Filled</small>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach ($check_room as $room)
                                                            @if ($room->status === 0)
                                                                <span style="margin: 0;"
                                                                    class="badge badge-danger mb-1">{{ $room->room_code }}</span>
                                                            @endif
                                                            @if ($room->status === 1)
                                                                <span style="margin: 0;"
                                                                    class="badge badge-success mb-1">{{ $room->room_code }}</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <div>
                                                        <h5 class="mb-3">
                                                            <u>Latest Transaction</u>
                                                        </h5>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            @forelse ($finances as $finance)
                                                                @php
                                                                    $check_out = date_create($finance['check_out']);
                                                                    $check_in = date_create($finance['check_in']);
                                                                    $calculate = date_diff($check_out, $check_in);
                                                                    $day = $calculate->format('%a');
                                                                    $price = $day * $finance->room->price;
                                                                    $total = ($total ?? 0) + $price;
                                                                @endphp
                                                                <tbody>
                                                                    <td>{{ $finance->booking_code }}</td>
                                                                    <td>
                                                                        <span
                                                                            class="badge badge-light">{{ 'Rp. ' . number_format($price, 0, ',', '.') }}<span>
                                                                    </td>
                                                                </tbody>
                                                            @empty
                                                                <tbody>
                                                                    <tr>
                                                                        <th colspan="2"
                                                                            style="color: red; text-align: center;">Data
                                                                            Empty!</th>
                                                                    </tr>
                                                                </tbody>
                                                            @endforelse
                                                            <tfoot>
                                                                <tr>
                                                                    <td></td>
                                                                    <th><a href="@role('admin'){{ route('admin.report.finance') }}@endrole @role('boss'){{ route('manager.report.finance') }}@endrole"
                                                                            class="btn badge-secondary"><i
                                                                                class="fa fa-money"></i> See all
                                                                            Transaction</a>
                                                                    </th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
        @role('customer')
        <div class="row">
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h6>Package and Description</h6><span>Here are the types of packages and
                                    the explanation</span>
                            </div>
                            <div class="card-body">
                                <div class="default-according" id="accordion1">
                                    @foreach ($categories as $category)
                                        <div class="card">
                                            <div class="card-header bg-primary" id="headingFour">
                                                <h5 class="mb-0 p-1">
                                                    <button class="btn btn-link text-white" data-toggle="collapse"
                                                        data-target="#{{ $category->name }}" aria-expanded="true"
                                                        aria-controls="{{ $category->name }}"><i
                                                            class="fa fa-sort-down"></i> {{ $category->name }}</button>
                                                </h5>
                                            </div>
                                            <div class="collapse" id="{{ $category->name }}" aria-labelledby="headingOne"
                                                data-parent="#accordion1">
                                                <div class="card-body">
                                                    <div class="mb-5">
                                                        <h6>Description : </h6>
                                                        <span class="text-secondary">{!! $category->description !!}</span>
                                                    </div>
                                                    <div>
                                                        <h6>Facility : </h6>
                                                        <span class="text-secondary">{{ $category->facility }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        @endrole
    </div>
@endsection
