@extends('layouts.layout')

@section('content')

    {{-- <div id="content">
        <ul class="nav navbar-nav search-nav" style="margin-top: 20px">
            <li>
                <div class="search">
                    <div class="form-group form-animate-text">
                        <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                        <input type="text" class="form-text" required>
                        <span class="bar"></span>
                        <label class="label-search">Type anywhere to <b>Search</b> </label>
                    </div>
                </div>
            </li>
        </ul>
    </div> --}}

    <div id="content" class="search-v1">
        <div class="panel">
            <div class="panel-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
            <div class="col-md-12">
                <form action="{{route('search')}}" method="post">
                    {{csrf_field()}}
                     <div class="input-group">
                        <input name="search_words" type="search" class="form-control" aria-label="...">
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-success">Search</button>
                        </div><!-- /btn-group -->
                    </div><!-- /input-group -->
                </form>
            </div>

            {{-- table --}}
            <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    {{-- <div class="panel-heading"><h3>Data Tables</h3></div> --}}
                    <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Video Id</th>
                                    <th>Keywords</th>
                                    <th>thumbnail</th>
                                    <th>Title</th>
                                    <th>Channel Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($youtubeList))
                                    @foreach ($youtubeList as $items)
                                        <tr>
                                            <td>{{$items['id']['videoId']}}</td>
                                            <td>{{$q}}</td>
                                            <td><a href={{"https://www.youtube.com/watch?v=".$items['id']['videoId']}} target="_blank"><img src="{{$items['snippet']['thumbnails']['default']['url']}}" alt=""></a></td>
                                            <td>{{$items['snippet']['title']}}</td>
                                            <td>{{$items['snippet']['channelTitle']}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>  
              </div>
            {{-- end-table --}}


          </div>
        </div>
    </div>

@endsection