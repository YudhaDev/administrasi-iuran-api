<?php
namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MembersController extends Controller
{
    private $TABLE_VAR_NAME = 'name';
    private $TABLE_VAR_JENIS_KELAMIN = 'jenis_kelamin';
    private $TABLE_VAR_STATUS_AKTIF = 'status_aktif';
    private $TABLE_VAR_STATUS_IURAN = 'status_iuran';

    public function index() {
        return Members::all();
    }

    public function addMembership(Request $request){
        $request->validate([
            // 'nomor_induk' => 'required',
            'name' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        return Members::create($request->all());
        // return Members::create ([
        //     'nomor_induk' => $request->nomor,
        //     'name' => 'nugraha',
        //     'jenis_kelamin' => 'pria'
        // ]);
    }

    public function findMemberById($id){
        return Members::find($id);
    }

    public function findMemberByName($name){
        return Members::where($this->TABLE_VAR_NAME,'LIKE', '%'.$name.'%')->get();
    }

    public function findMemberByJenisKelamin($index_gender){ //0 - pria, 1 - wanita
        $select = 'null';
        switch ($index_gender) {
            case '0':
                // $select = strtolower('Pria');
                $select = 'pria';
                break;
            case '1':
                // $select = strtolower('Wanita');
                $select = 'wanita';
                break;
            default:
                // $select = strtolower('pria');
                $select = 'pria';
                break;
        }
        return Members::where($this->TABLE_VAR_JENIS_KELAMIN, $select)->get();
    }

    public function findMemberByStatusAktif($index_status_aktif){ //0 - aktif, 1 - tidak aktif
        $select = 'null';
        switch ($index_status_aktif) {
            case '0':
                $select = 'aktif';
                break;
            case '1':
                $select = 'tidak aktif';
                break;
            default:
                $select = 'aktif';
                break;
        }
        return Members::where($this->TABLE_VAR_STATUS_AKTIF, $select)->get();
        // return gettype($index_status_aktif);
    }

    public function findMemberByStatusIuran($index_status_iuran){ //0 - belum lunas, 1 - lunas, 2 - terlambat
        $select = 'null';
        switch ($index_status_iuran) {
            case '0':
                $select = 'belum lunas';
                break;
            case '1':
                $select = 'lunas';
                break;
            case '2':
                $select = 'terlambat';
                break;
            default:
                $select = 'belum lunas';
                break;
        }
        // return $select.$index_status_iuran;
        return Members::where($this->TABLE_VAR_STATUS_IURAN, $select)->get();
    }

    public function updateMemberData(Request $request, $id){
        $member = Members::find($id);
        $member->update($request->all());
        return $member;
    }

    public function deleteMember($id){
        return Members::destroy($id);
    }
}
