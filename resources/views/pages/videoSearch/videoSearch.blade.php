@extends('layouts.layout')

@section('content')

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
                {{-- <form action="{{route('search')}}" method="post"> --}}
                <form action="{{route('ajax-search')}}" method="get">
                    {{csrf_field()}}
                     <div class="input-group">
                        <input name="searchWords" id="search-words" type="search" class="form-control" aria-label="..." placeholder="search">
                        <div class="input-group-btn">
                          <button id="search" type="button" class="btn btn-success">Search</button>
                        </div><!-- /btn-group -->
                    </div><!-- /input-group -->
                </form>
            </div>

            {{-- table --}}
            <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Keywords</th>
                                    <th>Thumbnails</th>
                                    <th>Description</th>
                                    <th>Title</th>
                                    <th>Channel Title</th>
                                </tr>
                            </thead>
                            <tbody id="youtubeList">
                                {{-- @if (isset($youtubeList))
                                    @foreach ($youtubeList as $items)
                                        <tr>
                                            <td>{{$items['id']['videoId']}}</td>
                                            <td>{{$q}}</td>
                                            <td>
                                                <a href={{"https://www.youtube.com/watch?v=".$items['id']['videoId']}} target="_blank">
                                                    <img src="{{$items['snippet']['thumbnails']['default']['url']}}" alt="">
                                                </a>
                                            </td>
                                            <td>{{$items['snippet']['title']}}</td>
                                            <td>{{$items['snippet']['channelTitle']}}</td>
                                        </tr>
                                    @endforeach
                                @endif --}}
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                <div id="showMore" class="input-group-btn">
                    <button id="btnShow" type="button" class="btn btn-primary">Show More</button>
                </div><!-- /btn-group -->
              </div>  
            </div>
            {{-- end-table --}}


          </div>
        </div>
    </div>

@endsection

@push('ajax')
    <script type="text/javascript">
            $(document).ready(function(){
                $('#showMore').hide();
                
                var nextPageToken = '';

                $("#search").on("click", function(){

                    var words = $("#search-words").val();

                    if (words = $("#search-words").val()) {
                        $('#showMore').show();
                    }

                    $.ajax({
                        method: "GET",
                        url: "/ajax-even-search",
                        data: {
                                searchWords:words,
                                pageToken:nextPageToken,
                            },
                        success: function(data) {
                            nextPageToken = data.nextPageToken;
                            // console.log(nextPageToken);
                            var res = '';
                            $.each(data.items, function(key, value){
                                res +=
                                `<tr>
                                    <td>${words}</td>
                                    <td>
                                        <a href="https://www.youtube.com/watch?v=${value.id.videoId}" target="_blank">
                                            <img src="${value.snippet.thumbnails.default.url}">
                                        </a>
                                    </td>
                                    <td>${value.snippet.description}</td>
                                    <td>${value.snippet.title}</td>
                                    <td>${value.snippet.channelTitle}</td>
                                </tr>`
                            });
                            $('#youtubeList').html(res);
                        }
                    });
                });

                $('#btnShow').click(function(){
                    alert('hallo');
                });

            });
    </script>
@endpush
