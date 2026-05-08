<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
class HomeController extends Controller
{
  public function __construct()
  {
   $this->middleware('can:home');
  }
    public function index(){
        $chart_options = [
    'chart_title' => 'Posts by months',
    'report_type' => 'group_by_date',
    'model' => 'App\Models\Post',
    'group_by_field' => 'created_at',
    'group_by_period' => 'day',
    'chart_type' => 'line',
      'filter_field' => 'created_at',
    'filter_days' => 30, 
];
$chart1 = new LaravelChart($chart_options);
        $chart_options_users = [
    'chart_title' => 'Users by Month',
    'report_type' => 'group_by_date',
    'model' => 'App\Models\User',
    'group_by_field' => 'created_at',
    'group_by_period' => 'month',
    'chart_type' => 'bar',
      'filter_field' => 'created_at',
    'filter_days' => 360, 
];
$chart_users = new LaravelChart($chart_options_users);
        $chart_comment = [
    'chart_title' => 'comment by Month',
    'report_type' => 'group_by_date',
    'model' => 'App\Models\Comment',
    'group_by_field' => 'created_at',
    'group_by_period' => 'month',
    'chart_type' => 'pie',
      'filter_field' => 'created_at',
    'filter_days' => 360, 
];
$chart_comment = new LaravelChart($chart_comment);
        $chart_contatct = [
    'chart_title' => 'Contatct by Month',
    'report_type' => 'group_by_date',
    'model' => 'App\Models\Contact',
    'group_by_field' => 'created_at',
    'group_by_period' => 'day',
    'chart_type' => 'line',
      'filter_field' => 'created_at',
    'filter_days' => 30, 
];
$chart_contatct = new LaravelChart($chart_contatct);


        return view('admin.index', compact('chart1','chart_users','chart_comment','chart_contatct'));
    }
}
