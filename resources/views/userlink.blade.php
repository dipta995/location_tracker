@extends('layouts.master')
@section('content')
<div class="container">
    <h4 style="margin-top: 100px;">Track table table</h4>


    <div class="row">
        <div class="col-md-2"></div>

        <div class="col-md-10">

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Link Name</th>
                    <th scope="col">Fake link</th>
                    <th scope="col">real link</th>
                    <th scope="col">long</th>
                    <th scope="col">lat</th>
                    <th scope="col">Create at</th>
                    <th scope="col-1">Map</th>
                    <th scope="col">Remove</th>
                  </tr>
                </thead>
                <tbody>

@foreach ($getdata as $a=>$links)


                  <tr>
                    <th scope="row">{{ $a=1+$a }}</th>
                    <td>{{ $links->title }}</td>
                    <td>{{ $links->fake_link }}</td>
                    <td>{{ $links->real_link }}</td>
                    <td>{{ $links->long }}</td>
                    <td>{{ $links->lat }}</td>
                    <td>{{ $links->created_at }}</td>
                    <td>
                    <?php
        $latitude =  $links->lat;
        $longitude =  $links->long;
        ?>
        <iframe width="100%" height="100" src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed"></iframe>
    </td>
    <td><form action="{{ url('remove/track') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $links->id }}">
        <button class="btn btn-danger">delete</button>
    </form></td>
    </tr>
    @endforeach
                </tbody>
                <div class="d-flex justify-content-center">


                {{ $getdata->links() }}
            </div>

        <style>.w-5 {
          width: 10px;
        }
        .pl-4{
          display: none;
        }



        </style>
              </table>
            </div>
        </div>


<div>

        </div>
    </div>
</div>
@stop
