<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Piutang;

class PiutangController extends Controller
{
    public function all()
    {
      $ptgs = Piutang::all();

      $crumbs = [	'title'=>'Data Piutang',
  						['text'=>'Finance','link'=>url('item/list')],
  						['text'=>'Data Piutang','link'=>url('piutang/all')]];

      return view('piutang.list')
      ->with('crumbs', $crumbs)
      ->with('piutangs', $ptgs);
    }

    public function done()
    {
      $ptgs = Piutang::where('status',1)->get();

      $crumbs = [	'title'=>'Data Piutang Lunas',
  						['text'=>'Finance','link'=>url('item/list')],
  						['text'=>'Data Piutang Lunas','link'=>url('piutang/done')]];

      return view('piutang.list')
      ->with('crumbs', $crumbs)
      ->with('piutangs', $ptgs);
    }

    public function pending()
    {
      $ptgs = Piutang::where('status',0)->get();

      $crumbs = [	'title'=>'Data Piutang Belum Lunas',
  						['text'=>'Finance','link'=>url('item/list')],
  						['text'=>'Data Belum Lunas','link'=>url('piutang/pending')]];

      return view('piutang.list')
      ->with('crumbs', $crumbs)
      ->with('piutangs', $ptgs);
    }

    public function check($id)
    {
      $ptg = Piutang::find($id);
      $ptg->status = true;
      $ptg->save();

      return redirect(url('piutang/all'));
    }
}
