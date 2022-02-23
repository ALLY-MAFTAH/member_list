@extends('layouts.app')
@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-light-100  sm:items-center py-1 sm:pt-0  px-3">


        <div class="text-center">

            <h3 style="font-size: 20px; color:rgb(44, 11, 189);">Washiriki wa Dawrah ya Kielimu ya Wanafunzi wa Vyuo Vikuu
                Tanzania - 2022</h3>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md col-md-offset-4">
                @if ($errors->has('msg'))
                    <div class="alert alert-warning">
                        {{ $errors->first('msg') }}
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span
                                aria-hidden="true">X</span></button>
                    </div>
                @endif
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading text-center text-success">Markaz Shaykhil Islaam Ibn Taymiyyah, Pongwe - Tanga
                    </div>

                    <hr>
                    <br>
                    <div class="panel-body">
                        <p style="font-size: 15px" class="lead text-center">Kuhakiki Taarifa Zako za Ushiriki, Tafadhali Ingiza Namba Yako ya
                            Kitambulisho Ulichojisajilia kwa Ajili ya Dawrah</p>
                    </div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('search') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="id_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Namba ya Kitambulisho') }}</label>

                                <div class="col-md-6">
                                    <input id="id_number" type="id_number" class="form-control @error('id_number') is-invalid @enderror"
                                        name="id_number" value="{{ old('id_number') }}" required autocomplete="id_number" autofocus>

                                    @error('id_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0 text-center">
                                <div class="">
                                    <button type="submit" class="btn btn-outline-primary">
                                        {{ __('TUMA') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
