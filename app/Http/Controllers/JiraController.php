<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JiraController extends Controller
{


    public function store(Request $request){

        $request->validate([

           'summary' => 'required',
           'description' => 'required',
           'issuetype' => 'required',
           'priority' => 'required'
        ]);


       $jsonBuild =  ['fields' => ["project" => ["key" => "BAR"],
            'summary' => $request->get('summary'),
            'description' => $request->get('description'),
            'issuetype' => ["name" => $request->get('issuetype')],
            'priority' => ['name' => $request->get('priority')]]];


        $response =  Http::withBasicAuth(env('jira_username'),env('jira_api_token'))->post(env('JIRA_REST_API'),
            $jsonBuild
        );
        if($response->successful()) {
            $responseFromJira  = json_decode($response->body(),true);
            $msg = '<a target="_blank" href="https://labtwodevs.atlassian.net/browse/'. $responseFromJira['key'] . '"> <strong>kliko këtu </strong></a>';
            session()->flash('success', $request->only('issuetype'). ' është regjistruar në Jira ! , ' .$msg . " për të kaluar te Jira.".
            '<br>' . '<strong>Kënaqësi për developerin!</strong> kështu u dergua kërkësa në API <br>' .  json_encode($jsonBuild));
            return redirect()->action([DashboardController::class, 'index']);
        }else{
            session()->flash('error', 'Gabim gjatë dërgimit të të dhënave!');
            return redirect()->action([DashboardController::class, 'index']);
        }


    }
}
