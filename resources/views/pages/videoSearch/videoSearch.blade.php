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
                                    <th>Video Id</th>
                                    <th>Keywords</th>
                                    <th>thumbnail</th>
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
              </div>  
            </div>
            {{-- end-table --}}


          </div>
        </div>
    </div>

@endsection

@push('ajax')
    <script type="text/javascript">
            // $('#search').on('click', function(){
            // // alert("halo");
            //     $.get("{{URL::to('/ajax-even-search')}}", function(data){
            //         console.log(data);
            //     });
            // });

            // $("#search").click(function(){
            // // alert("halo");
            //     $.ajax({
            //         type:'GET',
            //         url:'/ajax-even-search',
            //         data:{
            //             '_token':$('input[name=_token]').val(),
            //             'searchWords':$('#searchWords').val()
            //         },
            //         success:function(data){
            //             console.log(data);
            //         }
            //     });
            // });

            $(document).ready(function(){
                
                // var nextPageToken = '';

                $("#search").on("click", function(){

                    var words = $("#search-words").val();
                    // var base_url = window.location.origin;
                    // console.log(base_url+"/ajax-even-search");
                    
                    console.log(words);
                    $.ajax({
                        method: "GET",
                        url: "/ajax-even-search",
                        data: {searchWords:words},
                        success: function(data) {
                            console.log(data);
                            // var data = result.data;
                            var res='';
                            $.each(data, function (key, value) {
                                res +=
                                // '<tr>'+
                                //     '<td>'+value.id.videoId+'</td>'+
                                //     '<td>'+words+'</td>'+
                                //     '<td>'+'<a href="https://www.youtube.com/watch?v="'>'+value.id.videoId+'</a>'+'</td>'+
                                //     '<td>'+value.snippet.title+'</td>'+
                                //     '<td>'+value.snippet.channelTitle+'</td>'+
                                // '</tr>'
                                `<tr>
                                    <td>${value.id.videoId}</td>
                                    <td>${words}</td>
                                    <td>
                                        <a href="https://www.youtube.com/watch?v=${value.id.videoId}" target="_blank">
                                            <img src="${value.snippet.thumbnails.default.url}">
                                        </a>
                                    </td>
                                    <td>${value.snippet.title}</td>
                                    <td>${value.snippet.channelTitle}</td>
                                </tr>`
                            });
                            $('#youtubeList').html(res);
                            // for(var i = 0; i <= data.length; i++)
                            // $('#youtubeList').append(''+

                            // );
                        }
                    });
                
                });

            });
    </script>
@endpush
