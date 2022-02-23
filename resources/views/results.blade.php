@extends('layouts.app')
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-light-100  sm:items-center py-1 sm:pt-0  px-3">
        @if (session('status'))
            <div class="alert alert-primary" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        @if (session('errors'))
            <div class="alert alert-success" role="alert">
                {{ session('errors') }}
            </div>
        @endif
    </div>
    <div class="container">
        <div class="row">
            @if ($member != '')
                <div class="col-md col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-success text-bold">Maa Shaa Allah, Umesajiliwa Kushiriki
                            Dawrah Hii
                        </div>
                        <hr>
                        <br>
                        <div class="panel-body">
                            <p class="lead text-center text-bold ">Hakiki Taarifa Zako</p>
                        </div>
                        <div class="px-2" style="border-radius: 7px; background-color:rgb(207, 235, 211)">
                            <div class="card-body">
                                <div class="row my-0">
                                    <div class="col-6">
                                        <p> Jina Kamili: </p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>{{ $member->fullname }}</b></p>
                                    </div>
                                </div>
                                <div class="row my-0">
                                    <div class="col-6">
                                        <p> Namba ya Utambulisho:</p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>{{ $member->id_number }}</b></p>
                                    </div>
                                </div>
                                <div class="row my-0">
                                    <div class="col-6">
                                        <p> Chuo:</p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>{{ $member->university }}</b></p>
                                    </div>
                                </div>

                                <div class="row my-0">
                                    <div class="col-6">
                                        <p> Namba ya Simu ya Mshiriki:</p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>{{ $member->phone1 }}</b></p>
                                    </div>
                                </div>
                                <div class="row my-0">
                                    <div class="col-6">
                                        <p> Namba ya Simu ya Nyumbani:</p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>{{ $member->phone2 }}</b></p>
                                    </div>
                                </div>
                                <div class="row my-0">
                                    <div class="col-6">
                                        <p> Kiasi:</p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>{{ number_format($member->amount, 0) }} Tsh </b></p>
                                    </div>
                                </div>
                                <div class="row my-0">
                                    <div class="col-6">
                                        <p> Mfumo wa Malipo:</p>
                                    </div>
                                    <div class="col-6">
                                        <p><b>{{ $member->type }} </b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p class="text-center text-bold " style="font-size: 12">Kama Kuna Makosa Katika Taarifa Zako, Wasiliana na Namba Zifuatazo: </p>
                            <p class="lead text-center"><a href="tel:0718221263">0718221263</a></p>
                            <p class="lead text-center"><a href="tel:0676470611">0676470611</a></p>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-danger">'Afwan, Hujasajiliwa Kushiriki Dawrah Hii au Namba ya Kitambulisho Uliyoingiza Sio Sahihi, Jaribu Tena.
                        </div>
                        <hr>
                        <br>
                        <div class="panel-body">
                            <p class="lead text-center">Tafadhali, Fanya Mawasiliano Kupitia Namba Zifuatazo, Ili Kujisajili
                                kwa Ajili ya Dawrah Hii.</p>
                            <p class="lead text-center"><a href="tel:0718221263">0718221263</a></p>
                            <p class="lead text-center"><a href="tel:0676470611">0676470611</a></p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <div class="row text-center">
        <div class="col">
            <a href="{{ route('welcome') }}" class="btn btn-success btn-outline"> Sawa
            </a>
        </div>
    </div>
    </div>
@endsection
