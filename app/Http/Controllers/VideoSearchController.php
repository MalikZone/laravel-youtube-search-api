<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metaTittle = "Video Search";
        

        return view ('pages.videoSearch.videoSearch', compact('metaTittle'));
    }

    public function search(Request $request)
    {
        // $check = $request->search_words;
        // dd($check);
        // dd(!is_null($request->search_words));

        // $search_words = $request->get('search_words');

        $DEVELOPER_KEY = 'AIzaSyBUieriVAZMamfwnNq6oZva60xb9a5qWd0';
        // dd($DEVELOPER_KEY);
        $this->validate($request,
        [
            'searchWords' => 'required|max:255',
        ]);
        
        $searchWords    = $request->searchWords;
        $nextPageToken  = $request->pageToken;
        $prevPageToken  = $request->prevToken;
        $q              = Str_slug($searchWords);
        $link = "https://www.googleapis.com/youtube/v3/search?part=snippet&key=$DEVELOPER_KEY&type=video&maxResults=5&q=$q&pageToken=$nextPageToken&prevPageToken=$prevPageToken";

        if (isset($searchWords)) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            // echo $response
            // dd(json_encode(json_decode($response, true)));
            // $response = '{"kind":"youtube#searchListResponse","etag":"QvVXxKMD76YDxg3-wBf-qD6hXlo","nextPageToken":"CAUQAA","regionCode":"ID","pageInfo":{"totalResults":1000000,"resultsPerPage":5},"items":[{"kind":"youtube#searchResult","etag":"Hyy83YvB46QQ7UirPv_nxc7cWPk","id":{"kind":"youtube#video","videoId":"Vy1OoSVoaSE"},"snippet":{"publishedAt":"2020-06-16T06:32:24Z","channelId":"UCRBgZ9ondGvlcR-E_snJY2Q","title":"[Dota 2 Live] T1 vs TNC | BTS Pro Series SEA #2 | Group Stage BO2 | Yudikupattahu","description":"Bracket : https:\/\/liquipedia.net\/dota2\/BTS\/Pro_Series\/2\/Southeast_Asia Saweria : https:\/\/saweria.co\/justincase512 Follow our social media IG ...","thumbnails":{"default":{"url":"https:\/\/i.ytimg.com\/vi\/Vy1OoSVoaSE\/default.jpg","width":120,"height":90},"medium":{"url":"https:\/\/i.ytimg.com\/vi\/Vy1OoSVoaSE\/mqdefault.jpg","width":320,"height":180},"high":{"url":"https:\/\/i.ytimg.com\/vi\/Vy1OoSVoaSE\/hqdefault.jpg","width":480,"height":360}},"channelTitle":"WxC Indonesia","liveBroadcastContent":"none","publishTime":"2020-06-16T06:32:24Z"}},{"kind":"youtube#searchResult","etag":"EIbWbxTy72lFa4GEc6WUKwebgM4","id":{"kind":"youtube#video","videoId":"Qci8cd2J7hI"},"snippet":{"publishedAt":"2020-06-15T09:40:38Z","channelId":"UCfsOfLvadg89Bx8Sv_6WERg","title":"FNATIC vs GEEK FAM - SEA Groups - BTS PRO Series 2 DOTA 2","description":"Commentary by @MLPDota & @johnxfire FNATIC vs GEEK FAM - SEA Groups - BTS PRO Series 2 DOTA 2 BTS Twitch: https:\/\/www.twitch.tv\/beyondthesummit ...","thumbnails":{"default":{"url":"https:\/\/i.ytimg.com\/vi\/Qci8cd2J7hI\/default.jpg","width":120,"height":90},"medium":{"url":"https:\/\/i.ytimg.com\/vi\/Qci8cd2J7hI\/mqdefault.jpg","width":320,"height":180},"high":{"url":"https:\/\/i.ytimg.com\/vi\/Qci8cd2J7hI\/hqdefault.jpg","width":480,"height":360}},"channelTitle":"NoobFromUA","liveBroadcastContent":"none","publishTime":"2020-06-15T09:40:38Z"}},{"kind":"youtube#searchResult","etag":"23UJ4j4m10ZrBx6tlKW4ktXhmsg","id":{"kind":"youtube#video","videoId":"f9w9_pwWz6c"},"snippet":{"publishedAt":"2020-06-13T19:29:09Z","channelId":"UCfsOfLvadg89Bx8Sv_6WERg","title":"SECRET vs OG - GRAND FINAL - BLAST Bounty Hunt DOTA 2","description":"Watch LIVE: https:\/\/www.twitch.tv\/blastdota Commentary by ODPixel Fogged About BLASTDota https:\/\/twitter.com\/BLASTDota http:\/\/www.blastdota.com\/ ...","thumbnails":{"default":{"url":"https:\/\/i.ytimg.com\/vi\/f9w9_pwWz6c\/default.jpg","width":120,"height":90},"medium":{"url":"https:\/\/i.ytimg.com\/vi\/f9w9_pwWz6c\/mqdefault.jpg","width":320,"height":180},"high":{"url":"https:\/\/i.ytimg.com\/vi\/f9w9_pwWz6c\/hqdefault.jpg","width":480,"height":360}},"channelTitle":"NoobFromUA","liveBroadcastContent":"none","publishTime":"2020-06-13T19:29:09Z"}},{"kind":"youtube#searchResult","etag":"t2vHny_9G9HIjXQnqlcxw338sPc","id":{"kind":"youtube#video","videoId":"oRR6659OMHk"},"snippet":{"publishedAt":"2020-06-16T02:54:59Z","channelId":"UC0ulTTSZlN8D2SnOXV9tkzA","title":"Neon vs Fnatic - BTS Pro Series S2: Southeast Asia - DOTA 2 LIVE INDONESIA","description":"Bracket: https:\/\/liquipedia.net\/dota2\/BTS\/Pro_Series\/2\/Southeast_Asia Jadwal: 11.00 - TNC Predator vs T1 (BO2) Caster : Vino \"Veenomon\" Christian ...","thumbnails":{"default":{"url":"https:\/\/i.ytimg.com\/vi\/oRR6659OMHk\/default_live.jpg","width":120,"height":90},"medium":{"url":"https:\/\/i.ytimg.com\/vi\/oRR6659OMHk\/mqdefault_live.jpg","width":320,"height":180},"high":{"url":"https:\/\/i.ytimg.com\/vi\/oRR6659OMHk\/hqdefault_live.jpg","width":480,"height":360}},"channelTitle":"Ligagame Esports TV","liveBroadcastContent":"live","publishTime":"2020-06-16T02:54:59Z"}},{"kind":"youtube#searchResult","etag":"57Y57apHSrKsR0DoW4PkiiK8c18","id":{"kind":"youtube#video","videoId":"XDD2scPnvo0"},"snippet":{"publishedAt":"2020-06-15T20:20:20Z","channelId":"UCRBgZ9ondGvlcR-E_snJY2Q","title":"[Dota 2 Live] Liquid vs Ninjas in Pyjamas | BEYOND EPIC Europe\/CIS | Yudijustincase","description":"Bracket : https:\/\/liquipedia.net\/dota2\/BEYOND_EPIC\/1\/Europe_CIS Saweria : https:\/\/saweria.co\/justincase512 Follow our social media IG ...","thumbnails":{"default":{"url":"https:\/\/i.ytimg.com\/vi\/XDD2scPnvo0\/default.jpg","width":120,"height":90},"medium":{"url":"https:\/\/i.ytimg.com\/vi\/XDD2scPnvo0\/mqdefault.jpg","width":320,"height":180},"high":{"url":"https:\/\/i.ytimg.com\/vi\/XDD2scPnvo0\/hqdefault.jpg","width":480,"height":360}},"channelTitle":"WxC Indonesia","liveBroadcastContent":"none","publishTime":"2020-06-15T20:20:20Z"}}]}';
            
            // $array = json_decode($response, true);
            // dd($array);
            // $youtubeList = $array['items'];
            // dd($youtubeList);
            // $metaTittle = "Video Search";
            // $q            = $searchWords;

            // return view('pages.videoSearch.videoSearch', compact('youtubeList', 'metaTittle','q'));

            // dd($response);
            // return $response;

            $array = json_decode($response, true);
            $items = $array;
            
            return response()->json($items);
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
