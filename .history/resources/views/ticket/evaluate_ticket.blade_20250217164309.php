@extends('layout.header')
@section('content')

<div class="d-flex justify-content-center">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Evaluate Ticket for #{{ $ticket->t_control_no }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('ticket_evaluate_save', $ticket->t_id) }}" method="POST">
                    @csrf
                    
                    <!-- Work Quality -->
                    <div class="form-group">
                        <label>Work Quality</label>
                        <div class="radio">
                            @for ($i = 5; $i >= 1; $i--)
                            <input id="work-quality-{{ $i }}" type="radio" name="work_quality" value="{{ $i }}" required />
                            <label for="work-quality-{{ $i }}" title="{{ $i }} stars">
                                <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path>
                                </svg>
                            </label>
                            @endfor
                        </div>
                    </div>

                    <!-- Response Delivery -->
                    <div class="form-group mt-4">
                        <label>Response Delivery</label>
                        <div class="radio">
                            @for ($i = 5; $i >= 1; $i--)
                            <input id="res-delivery-{{ $i }}" type="radio" name="res_delivery" value="{{ $i }}" required />
                            <label for="res-delivery-{{ $i }}" title="{{ $i }} stars">
                                <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path>
                                </svg>
                            </label>
                            @endfor
                        </div>
                    </div>

                    <!-- Personnel Quality -->
                    <div class="form-group mt-4">
                        <label>Personnel Quality</label>
                        <div class="radio">
                            @for ($i = 5; $i >= 1; $i--)
                            <input id="personnells-quality-{{ $i }}" type="radio" name="personnels_quality" value="{{ $i }}" required />
                            <label for="personnells-quality-{{ $i }}" title="{{ $i }} stars">
                                <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path>
                                </svg>
                            </label>
                            @endfor
                        </div>
                    </div>

                    <!-- Overall Rating -->
                    <div class="form-group mt-4">
                        <label>Overall Rating</label>
                        <div class="radio">
                            @for ($i = 5; $i >= 1; $i--)
                            <input id="overall-{{ $i }}" type="radio" name="overall" value="{{ $i }}" required />
                            <label for="overall-{{ $i }}" title="{{ $i }} stars">
                                <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path>
                                </svg>
                            </label>
                            @endfor
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label for="comments">Additional Comments</label>
                        <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection