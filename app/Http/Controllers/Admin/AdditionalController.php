<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdditionalController extends Controller
{
    public function faqUpdate(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);
        DB::table('additional')->updateOrInsert(['page' => 'faq'], ['content' => $request->content]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }

    public function how_zdelat_zakazUpdate(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);
        DB::table('additional')->updateOrInsert(['page' => 'how_zdelat_zakaz'], ['content' => $request->content]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }

    public function terms_of_useUpdate(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);
        DB::table('additional')->updateOrInsert(['page' => 'terms_of_use'], ['content' => $request->content]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }

    public function code_of_ethicsUpdate(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);
        DB::table('additional')->updateOrInsert(['page' => 'code_of_ethics'], ['content' => $request->content]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }

    public function privacy_policyUpdate(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);
        DB::table('additional')->updateOrInsert(['page' => 'privacy_policy'], ['content' => $request->content]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }

    public function warrantyUpdate(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);
        DB::table('additional')->updateOrInsert(['page' => 'warranty'], ['content' => $request->content]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }

    public function delivery_termsUpdate(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);
        DB::table('additional')->updateOrInsert(['page' => 'delivery_terms'], ['content' => $request->content]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }

    public function return_conditionsUpdate(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);
        DB::table('additional')->updateOrInsert(['page' => 'return_conditions'], ['content' => $request->content]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }

    public function vacanciesUpdate(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);
        DB::table('additional')->updateOrInsert(['page' => 'vacancies'], ['content' => $request->content]);
        return redirect()->back()->with(['success' => 'Успешно изменено']);
    }

    public function faqDelete(Request $request) {
        DB::table('additional')->where('page', 'faq')->delete();
        return redirect()->back()->with(['success' => 'Успешно удалено']);
    }

    public function how_zdelat_zakazDelete(Request $request) {
        DB::table('additional')->where('page', 'how_zdelat_zakaz')->delete();
        return redirect()->back()->with(['success' => 'Успешно удалено']);
    }

    public function terms_of_useDelete(Request $request) {
        DB::table('additional')->where('page', 'terms_of_use')->delete();
        return redirect()->back()->with(['success' => 'Успешно удалено']);
    }

    public function code_of_ethicsDelete(Request $request) {
        DB::table('additional')->where('page', 'code_of_ethics')->delete();
        return redirect()->back()->with(['success' => 'Успешно удалено']);
    }

    public function privacy_policyDelete(Request $request) {
        DB::table('additional')->where('page', 'privacy_policy')->delete();
        return redirect()->back()->with(['success' => 'Успешно удалено']);
    }

    public function warrantyDelete(Request $request) {
        DB::table('additional')->where('page', 'warranty')->delete();
        return redirect()->back()->with(['success' => 'Успешно удалено']);
    }

    public function delivery_termsDelete(Request $request) {
        DB::table('additional')->where('page', 'delivery_terms')->delete();
        return redirect()->back()->with(['success' => 'Успешно удалено']);
    }

    public function return_conditionsDelete(Request $request) {
        DB::table('additional')->where('page', 'return_conditions')->delete();
        return redirect()->back()->with(['success' => 'Успешно удалено']);
    }

    public function vacanciesDelete(Request $request) {
        DB::table('additional')->where('page', 'vacancies')->delete();
        return redirect()->back()->with(['success' => 'Успешно удалено']);
    }
}
