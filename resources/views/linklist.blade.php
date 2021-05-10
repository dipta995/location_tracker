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

                    <th scope="col">Create at</th>

                     
                  </tr>
                </thead>
                <tbody>
@php
      if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $urls = "https://";
   else
        $urls = "http://";
        $urls.= $_SERVER['HTTP_HOST'];
@endphp
@foreach ($getdata as $a=>$links)


                  <tr>
                    <th scope="row">{{ $a=1+$a }}</th>
                    <td>{{ $links->title }}</td>
                    <td>{{ $urls }}/{{ $links->fake_link }}</td>
                    <td>{{ $links->real_link }}</td>

                    <td>{{ $links->created_at }}</td>


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
