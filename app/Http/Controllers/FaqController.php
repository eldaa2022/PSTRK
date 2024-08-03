<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\User;
use App\Models\Pesan;
use App\Models\Kontak;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::join('users', 'faqs.admin_id', '=', 'users.id')
                    ->select('faqs.*');

        if ($request->has('search')) {
            $query->where('faqs.pertanyaan', 'like', '%'.$request->search.'%');
        }

        $faqs = $query->paginate(5);
        $users = User::all();

        return view('admin.faq.list-faq', compact('faqs','users'));
    }



     //pengguna
     public function faqPengunjung(Request $request)
     {

         $faqs = Faq::all();
         $kontaks = Kontak::all();
         $pesans = Pesan::all();

         return view('pengunjung.faq-pengunjung', compact('faqs', 'kontaks', 'pesans'));
     }
}
