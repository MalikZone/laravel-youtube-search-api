@extends('layouts.layout')

@section('content')

    <style>
        div.ex1 {
            height: 500px;
            width: 100%;
            overflow-y: scroll;
        }
    </style>
    <div id="content" class="search-v1">
        <div class="panel">
            <div class="panel-body">
                {{-- @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif --}}
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

            <div class="col-md-12">
                
            </div>

            {{-- table --}}
            <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                        Get Link
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Video Link</h4>
                                </div>
                                <div class="ex1">
                                    <div class="modal-body" id="getLink">
                                        Get Link
                                    </div>
                                </div>
                                <button class="btn" data-clipboard-action="cut" data-clipboard-target="#bar">
                                    Cut to clipboard
                                </button>
                            </div>
                        </div>
                    </div>
                  <div class="panel">
                    <div class="panel-body">
                    <div class="responsive-table">
                        <table class="table table-hover" width="100%" cellspacing="0">
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
                                {{-- @if (isset($items))
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
                    <button id="loadMore" type="button" class="btn btn-primary">Show More</button>
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
            var res             = '';
            var link            = ''
            var nextPageToken   = '';
            var prevPageToken   = '';

            function getData(){
                var words = $("#search-words").val();

                $.ajax({
                    method: "GET",
                    url: "/ajax-even-search",
                    data: {
                            searchWords : words,
                            pageToken   : nextPageToken,
                            prevToken   : prevPageToken,
                        },
                    beforeSend: function() {
                        $('#loadMore').html('Loading...');
                        $('#search').html('Loading...');
                    },
                    success: function(data) {
                        nextPageToken = data.nextPageToken;
                        prevPageToken = data.prevPageToken;
                        // console.log(nextPageToken);
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
                            </tr>`;
                            link += 
                            `<ul>
                                <li>https://www.youtube.com/watch?v=${value.id.videoId}</li>
                            </ul>`;
                        });
                        $('#youtubeList').html(res);
                        $('#getLink').html(link);
                        $('#showMore').show();
                    },
                    complete: function() {
                        $('#loadMore').html('Show More');
                        $('#search').html('Search');
                    },
                });        
            }

            $("#search").on("click", function(){
                getData();
            });

            $('#loadMore').on('click',function(){
                // $('#loadMore').html('Loading...');
                // document.getElementById('loadMore').innerHTML = "Loading..."
                // document.querySelector('#loadMore').innerHTML = ""
                getData();
                // $('#loadMore').html('Show More');
            });

        });
    </script>
@endpush
