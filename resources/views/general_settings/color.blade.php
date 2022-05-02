@extends('layouts.app')

@section('content')

    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Footer color')}}</h3>
            </div>
@php
    $colors = \App\Color::get();
@endphp
            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('generalsettings.color.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="row">
                        @foreach ($colors as $a => $b)
                            <div class="color-radio col-sm-3">
                                <label>
                                    <input type="radio" name="frontend_color" class="color-control-input" value="{{$b->id}}" @if(\App\GeneralSetting::first()->frontend_color == $b->id) checked @endif>
                                    <span class="color-control-box" style="background:{{$b->code}}"></span>
                                </label>
                            </div> 
                        @endforeach
                        
                        {{-- <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="1" @if(\App\GeneralSetting::first()->frontend_color == '1') checked @endif>
                                <span class="color-control-box" style="background:#1abc9c;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="2" @if(\App\GeneralSetting::first()->frontend_color == '2') checked @endif>
                                <span class="color-control-box" style="background:#007bff;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="3" @if(\App\GeneralSetting::first()->frontend_color == '3') checked @endif>
                                <span class="color-control-box" style="background:#72bf40;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="4" @if(\App\GeneralSetting::first()->frontend_color == '4') checked @endif>
                                <span class="color-control-box" style="background:#F79F1F;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="5" @if(\App\GeneralSetting::first()->frontend_color == '5') checked @endif>
                                <span class="color-control-box" style="background:#2e2e54;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="6" @if(\App\GeneralSetting::first()->frontend_color == '6') checked @endif>
                                <span class="color-control-box" style="background:#dc3545;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="7" @if(\App\GeneralSetting::first()->frontend_color == '7') checked @endif>
                                <span class="color-control-box" style="background:#ED4C67;"></span>
                            </label>
                        </div> --}}
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('save')}}</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->

        </div>
    </div>

@endsection
