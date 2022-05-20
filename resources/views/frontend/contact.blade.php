
@extends('frontend.layouts.app')

@section('content')

<!-- Breadcrumb -->
<section id="breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Contact Us</a></li>
        </ol>
    </nav>
</section>
<!-- Breadcrumb Ends -->
<!-- Whole Body Wrapper Starts -->
<section id="contact-us-wrapper" class="p-4 bg-light">
    <div class="container">
        <div class="row padding px-xl-5 px-lg-5 px-md-4">
            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                <!-- CONTACT INFO -->
                <div class="contact-info d-flex flex-column justify-content-center h-100">
                    <div class="title mb-3">
                        <h1 class="contact-us-heading">Love To Hear From You</h1>

                        <p class="pt-3">{{$info->description}}</p>

                    </div>
                    <div class="address-info">
                        <ul>
                            <li class="p-2">
                                <p class="m-0"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i> <a
                                        href=""><span>
                                            {{$info->address}}</span></a> </p>
                            </li>
                            <li class="p-2">
                                <p class="m-0"><i class="fa fa-envelope mr-1" aria-hidden="true"></i> <a
                                        href="mailto:{{$info->email}}"><span> {{$info->email}}</span></a></p>
                            </li>
                            <li class="p-2">
                                <p class="m-0"><i class="fa fa-phone mr-1" aria-hidden="true"></i><a
                                        href="tel:{{$info->phone}}"> {{$info->phone}}</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-6 col-12 mx-auto mt-lg-0 mt-2 bg-white">
                <!-- CONTACT FORM HERE -->
                <form class="p-md-4 p-2" id="contact-form" method="post" action="{{route('send-mail')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="Your Name" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Your Email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Phone" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Subject" class="form-control" name="subject" id="subject">
                    </div>
                    <div class="form-group">
                        <textarea rows="6" placeholder="Message" class="form-control" name="message" id="message"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" id="contact-submit" class="btn px-5 anchor-btn2" value="Send Message">
                    </div>
                </form>


            </div>
        </div>
    </div>
</section>

@endsection


