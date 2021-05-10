@extends('layouts.master')
@section('content')
<div class="container">
    <h4 style="margin-top: 100px;">Image table</h4>


    <div class="row">
        <div class="col-md-5">


        </div>
        <div class="col-md-7">

            @php
                  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                  $urls = "https://";
             else
                  $urls = "http://";
                  $urls.= $_SERVER['HTTP_HOST'];
            @endphp

                <div class="panel panel-primary">
                  <div class="panel-heading"><h2>Link Make</h2></div>
                  <div class="panel-body">
                    <input class="form-control" style="width:500px;" type="text" value="{{ Session::get('fake_link') }}">

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>


                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/create/link') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-12">
                                <input type="hidden" placeholder="Fake Link" value=" @php
                                   echo (time())
                                @endphp " name="fake_link" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <input type="text" placeholder="Enter A name link" name="title" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <input type="text" placeholder="Enter Your Link" name="real_link" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Create link</button>
                            </div>

                        </div>
                    </form>

                  </div>
                </div>




        </div>
    </div>
</div>
@stop
