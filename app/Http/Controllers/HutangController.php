<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hutang;

class HutangController extends Controller
{
    public function all()
    {
      $htgs = Hutang::all();

      $crumbs = [	'title'=>'Data Hutang',
  						['text'=>'Finance','link'=>url('item/list')],
  						['text'=>'Data Hutang','link'=>url('hutang/all')]];

      return view('hutang.list')
      ->with('crumbs', $crumbs)
      ->with('hutangs', $htgs);
    }

    public function done()
    {
      $htgs = Hutang::where('status',1)->get();

      $crumbs = [	'title'=>'Data Hutang Lunas',
  						['text'=>'Finance','link'=>url('item/list')],
  						['text'=>'Data Hutang Lunas','link'=>url('hutang/done')]];

      return view('hutang.list')
      ->with('crumbs', $crumbs)
      ->with('hutangs', $htgs);
    }

    public function pending()
    {
      $htgs = Hutang::where('status',0)->get();

      $crumbs = [	'title'=>'Data Hutang Belum Lunas',
  						['text'=>'Finance','link'=>url('item/list')],
  						['text'=>'Data Belum Lunas','link'=>url('hutang/pending')]];

      return view('hutang.list')
      ->with('crumbs', $crumbs)
      ->with('hutangs', $htgs);
    }

    public function check($id)
    {
      $ptg = Hutang::find($id);
      $ptg->status = true;
      $ptg->save();

      return redirect(url('hutang/all'));
    }
}
