<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LeechContentController extends Controller
{
    //
    public function leechImage()
    {
        # code...
        // $fileName = Str::random(12).'.jpg';
        // $image_url = 'http://youtube.com/get_video_info?video_id=Q2AUH9w9XaA';
        // $ch = curl_init($image_url);
        // curl_setopt($ch, CURLOPT_HEADER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US)");
        // $raw_data = curl_exec($ch);
        // curl_close($ch);
        // dd($raw_data);
        // Storage::disk('public')->put('test.html',$raw_data);

        // e+Zlgr.1RkvM
        // MoK6MdH55$B*
        return view('youtube');
    }
    public function getlink(Request $request)
    {
        # code...
        $link = $request->youtube_link;
        $video_id = $this->getVideoid($link);
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,'https://youtube.com/get_video_info?video_id='.$video_id);
        // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl_handle, CURLOPT_POST, 1);
        // curl_setopt($curl_handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US)");
        $query = curl_exec($curl_handle);
        Storage::disk('public')->put('test.html',$query);
        dd($query);
        parse_str($query, $video_data);

        $streams = $video_data['url_encoded_fmt_stream_map'];
        $streams = explode(',',$streams);
        $quly = 1;
        foreach ($streams as $streamdata) {
            parse_str($streamdata,$streamdata);
            dd($streamdata);
            // foreach ($streamdata as $key => $value) {
            //     if ($key == "url") {
            //         $value = urldecode($value);
            //         $link = $value;
            //     }
            //     if ($key == "quality"){
            //         $quality = $value;
            //         if ($quality == "hd720"){
            //             $quality = "720p";
            //             $quly = $quly+ 1;
            //         } elseif ($quality == "medium"){
            //             $quality = "480p";
            //             $quly = $quly+ 1;
            //             if ($quly == 4){
            //                  $quality = "360p";
            //             }
            //         }
            //      }
            // }
            // if ($quality == "720p" or $quality == "480p" or  $quality == "360p"){
            //      echo "<a href ='".$link."' target = '_blank'>".$quality."</a> &ensp;";
            // }

        }

    }
    function getVideoid($url)
    {
        $video_id = false;
        $url = parse_url($url);
        if (strcasecmp($url['host'], 'youtu.be') === 0) {
            $video_id = substr($url['path'], 1);
        } elseif (strcasecmp($url['host'], 'www.youtube.com') === 0) {
            if (isset($url['query'])) {
                parse_str($url['query'], $url['query']);
                if (isset($url['query']['v'])) {
                    $video_id = $url['query']['v'];
                }
            }
            if ($video_id == false) {
                $url['path'] = explode('/', substr($url['path'], 1));
                if (in_array($url['path'][0], array('e', 'embed', 'v'))) {
                    $video_id = $url['path'][1];
                }
            }
        } else {
            return false;
        }
        return $video_id;
    }
    public function processVideo($vid) {
        parse_str(file_get_contents("https://youtube.com/get_video_info?video_id=".$vid),$info);


        $playabilityJson = json_decode($info['player_response']);
        $formats = $playabilityJson->streamingData->formats;
        $adaptiveFormats = $playabilityJson->streamingData->adaptiveFormats;

        //Checking playable or not
        $IsPlayable = $playabilityJson->playabilityStatus->status;

        //writing to log file
        if(strtolower($IsPlayable) != 'ok') {
            $log = date("c")." ".$info['player_response']."\n";
            file_put_contents('./video.log', $log, FILE_APPEND);
        }

        $result = array();

        if(!empty($info) && $info['status'] == 'ok' && strtolower($IsPlayable) == 'ok') {
            $i=0;
            foreach($adaptiveFormats as $stream) {

                $streamUrl = $stream->url;
                $type = explode(";", $stream->mimeType);

                $qualityLabel='';
                if(!empty($stream->qualityLabel)) {
                    $qualityLabel = $stream->qualityLabel;
                }

                $videoOptions[$i]['link'] = $streamUrl;
                $videoOptions[$i]['type'] = $type[0];
                $videoOptions[$i]['quality'] = $qualityLabel;
                $i++;
            }
            $j=0;
            foreach($formats as $stream) {

                $streamUrl = $stream->url;
                $type = explode(";", $stream->mimeType);

                $qualityLabel='';
                if(!empty($stream->qualityLabel)) {
                    $qualityLabel = $stream->qualityLabel;
                }

                $videoOptionsOrg[$j]['link'] = $streamUrl;
                $videoOptionsOrg[$j]['type'] = $type[0];
                $videoOptionsOrg[$j]['quality'] = $qualityLabel;
                $j++;
            }
            $result['videos'] = array(
                'info'=>$info,
                'adapativeFormats'=>$videoOptions,
                'formats'=>$videoOptionsOrg
            );


            return $result;
        }
        else {
            return;
        }
    }

    public function images()
    {

        $output = null;
        exec('~/Shell.sh',$output);
        // /home/crm/public_html/public/backend/assets/img
        // carousel-2.jpg
    //    $process = new Process(['~/Shell.sh']);
    //    $process->disableOutput();
    //    $process->run();

    //    if (!$process->isSuccessful()) {
    //     throw new ProcessFailedException($process);
    //     }

        echo $output;

    }
}
