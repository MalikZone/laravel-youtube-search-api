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

        $DEVELOPER_KEY = 'AIzaSyDiphYcEBSw0Ls-d-OH_WGmxrSVgjiANCk';
        // dd($DEVELOPER_KEY);
        $this->validate($request,
        [
            'search_words' => 'required|max:255',
        ]);
        
        $search_words =  $request->search_words;
        $q            = Str_slug($search_words);
        
        if (!is_null($search_words)) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.googleapis.com/youtube/v3/search?part=snippet&key=".$DEVELOPER_KEY."&type=video&maxResults=25&q=".$q,
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
            // echo $response;
            // dd(json_decode($response, true));
            
            $array = json_decode($response, true);
            // dd($array);
            $youtubeList = $array['items'];
            // dd($youtubeList);
            $metaTittle = "Video Search";
            $q            = $search_words;

            return view('pages.videoSearch.videoSearch', compact('youtubeList', 'metaTittle','q'));
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
